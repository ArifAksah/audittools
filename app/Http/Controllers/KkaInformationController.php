<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Models\KkaInformation;
use App\Models\Audit;
use App\Models\User;
use App\Models\Auditor;
use App\Models\Lhap;
use Carbon\Carbon;
App::setLocale('id');

class KkaInformationController extends Controller
{
    public function index()
    {
        $loggedInUser = Auth::user();
        if ($loggedInUser->jabatan === 'General Manager') {
            $audits = Audit::all();
        } 
        elseif ($loggedInUser->jabatan === 'Senior Manager') {
            $bidangAuditUser = $loggedInUser->bidang;
            $audits = Audit::where('bidang_audit', $bidangAuditUser)->get();
        } 
        else {
            $audits = Audit::whereHas('auditors', function($query) use ($loggedInUser) {
                $query->where('id_user', $loggedInUser->id);
            })->get();
        }
        return view('dashboard.KKA.indexkka', compact('audits'));
    }
    public function create($id)
    {
        $audits = Audit::where('id', $id)->get();
        $audit = Audit::findOrFail($id);
        $loggedInUser = Auth::user();
        $auditors = [$loggedInUser];
        // Mengambil semua KKA yang terkait dengan audit yang dipilih
        $kkas = KkaInformation::where('id_audit', $id)->get();
        return view('dashboard.KKA.formaddkka', compact('audit','audits','loggedInUser','kkas'));
    }
    public function show($id){
        $loggedInUser = Auth::user();
        $kkas = KkaInformation::where('id_audit', $id)->get();
        $audits = Audit::whereHas('auditors', function($query) use ($loggedInUser, $id) {
            $query->where('id_user', $loggedInUser->id)->where('id_audit', $id);
        })->findOrFail($id);

        $auditors = [$loggedInUser];
        // Mengambil semua KKA yang terkait dengan audit yang dipilih
        $kkas = KkaInformation::where('id_audit', $id)->get();
        $audit = Audit::findOrFail($id);
        $mulai=$audit->mulai;
        $selesai=$audit->selesai;
        return view('dashboard.KKA.formaddkka',compact('audits','auditors','loggedInUser','kkas'));
    }

    public function store(Request $request)
    {
        // Mendapatkan informasi terkait judul audit, user login, dan jumlah KKA yang sudah ada
        $judulAudit = Audit::find($request->id_audit)->judul_audit;
        $userLogin = Auth::user()->name;
        $jumlahKkaSeluruh = KkaInformation::where('id_user', Auth::id())->count();
        $jumlahKkaSeluruhTotal = KkaInformation::count();
        // Membentuk nomor KKA dengan format yang diinginkan
        $nomorKka = $judulAudit . '/' . $userLogin . '/' . ($jumlahKkaSeluruh + 1) . '/' . $jumlahKkaSeluruhTotal;
        // Validasi data yang dikirimkan melalui form
        $validatedData = $request->validate([
            'id_audit' => 'required',
            'id_user' => 'required',
            'auditor_kka' => 'required',
            'audit_kka'=> 'required',
            'kondisi_teks' => 'required',
            'kriteria_teks' => 'required',
            'sebab' => 'required',
            'akibat' => 'required',
            'kondisi_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar kondisi
            'kriteria_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar kriteria
        ]);
        // Proses menyimpan data KKA ke dalam database
        $kka = new KkaInformation();
        $kka->id_audit = $request->id_audit;
        $kka->id_user = $request->id_user;
        $kka->auditor_kka = $request->auditor_kka;
        $kka->audit_kka = $request->audit_kka;
        $kka->kondisi_teks = $request->kondisi_teks;
        $kka->kriteria_teks = $request->kriteria_teks;
        $kka->sebab = $request->sebab;
        $kka->akibat = $request->akibat;
        $kka->rekomendasi = $request->rekomendasi;
        $kka->evidence = $request->evidence;
        $kka->dibuat_oleh = $userLogin;
        $kka->nomor_kka = $nomorKka; 
        // Mengisi kolom nomor_kka dengan nomor yang dibentuk
        // Simpan data KKA ke dalam database
        $kka->save();
        // Simpan gambar kondisi_images
        $kondisiImages = [];
        if ($request->hasFile('kondisi_images')) {
            foreach ($request->file('kondisi_images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('public/kondisi_images', $imageName);
                // Simpan nama gambar ke dalam array
                $kondisiImages[] = 'kondisi_images/' . $imageName;
            }
        }
        // Simpan gambar kriteria_images
        $kriteriaImages = [];
        if ($request->hasFile('kriteria_images')) {
            foreach ($request->file('kriteria_images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('public/kriteria_images', $imageName);
                // Simpan nama gambar ke dalam array
                $kriteriaImages[] = 'kriteria_images/' . $imageName;
            }
        }
        // Simpan nama file gambar dalam bentuk array ke dalam kolom JSON atau TEXT
        $kka->kondisi_images = $kondisiImages;
        $kka->kriteria_images = $kriteriaImages;
        $kka->save();
        // Redirect ke halaman tertentu atau tampilkan pesan berhasil sesuai kebutuhan
        return redirect()->route('kkas.index')->with('success', 'KKA berhasil dibuat.');
    }

    public function edit($id)
    {
        $kka = KkaInformation::findOrFail($id);
        return view('dashboard.KKA.formeditkka', compact('kka'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'auditor_kka' => 'required',
            'audit_kka' => 'required',
            'kondisi_teks' => 'required',
            'kriteria_teks' => 'required',
            'sebab' => 'required',
            'akibat' => 'required',
            'kondisi_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            'kriteria_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
    
        $kka = KkaInformation::findOrFail($id);
    
        $kka->update([
            'auditor_kka' => $request->auditor_kka,
            'audit_kka' => $request->audit_kka,
            'kondisi_teks' => $request->kondisi_teks,
            'kriteria_teks' => $request->kriteria_teks,
            'sebab' => $request->sebab,
            'akibat' => $request->akibat,
            'rekomendasi' => $request->rekomendasi,
            'evidence' => $request->evidence,
        ]);
    
        $kondisiImages = [];
        if ($request->hasFile('kondisi_images')) {
            foreach ($request->file('kondisi_images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('public/kondisi_images', $imageName);
                // Simpan nama gambar ke dalam array
                $kondisiImages[] = 'kondisi_images/' . $imageName;
            }
        }
    
        $kriteriaImages = [];
        if ($request->hasFile('kriteria_images')) {
            foreach ($request->file('kriteria_images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('public/kriteria_images', $imageName);
                // Simpan nama gambar ke dalam array
                $kriteriaImages[] = 'kriteria_images/' . $imageName;
            }
        }
    
        $kka->update([
            'kondisi_images' => $kondisiImages,
            'kriteria_images' => $kriteriaImages,
        ]);
    
        // Dapatkan ID audit dari $kka
        $idAudit = $kka->audit_id; // Sesuaikan dengan nama kolom yang tepat untuk ID audit
    
        // Redirect ke halaman detail KKA setelah berhasil update
        return redirect()->route('kkas.detail', ['id' => $kka->id_audit, 'kka' => $kka->id])
            ->with('success', 'KKA berhasil diperbarui.');
    }    

    public function destroy($id)
    {
        // Temukan KKA berdasarkan ID dan hapus
        $kka = KkaInformation::findOrFail($id);
        $kka->delete();
        // Redirect kembali ke halaman index atau halaman terkait
        return redirect()->route('kkas.index')
            ->with('success', 'KKA berhasil dihapus.');
    }
    public function showAuditKka($id)
    {
        $audit = Audit::findOrFail($id);
        $loggedInUser = Auth::user();
        if ($loggedInUser->jabatan === 'General Manager') {
            $auditKka = KkaInformation::where('id_audit', $id)->pluck('audit_kka')->toArray();
            $kkas = KkaInformation::where('id_audit', $id)->get();
        } 
        elseif ($loggedInUser->jabatan === 'Senior Manager' && $audit->bidang_audit === $loggedInUser->bidang) {
            $auditKka = KkaInformation::where('id_audit', $id)->pluck('audit_kka')->toArray();
            $kkas = KkaInformation::where('id_audit', $id)->get();
        } 
        else {
            $userId = Auth::id();
            $auditKka = KkaInformation::where('id_audit', $id)->pluck('audit_kka')->toArray();
            $kkas = KkaInformation::where('id_audit', $id)->where('id_user', $userId)->get();
        }
        return view('dashboard.KKA.indexsubkka', compact('auditKka', 'kkas','audit','loggedInUser'));
    }    
    public function showDetailKka($id, $kka)
    {
        // Mengambil data KKA berdasarkan ID
        $loggedInUser = Auth::user();
        $audit = Audit::findOrFail($id);
        $kka = KkaInformation::findOrFail($kka);
        // Mengirimkan data ke tampilan showdetailkka
        $mulai = Carbon::parse($audit->mulai)->translatedFormat('d F Y');
        $selesai = Carbon::parse($audit->selesai)->translatedFormat('d F Y');
        return view('dashboard.KKA.showdetailkka', compact('kka','mulai','selesai','loggedInUser','audit'));
    }
    public function reviewToKetuaTim(Request $request)
    {
        // Validasi bahwa KKA yang sedang terpilih ada
        $kkaId = $request->input('kka_id');
        $userId = auth()->id();
        $kkaInformation = KkaInformation::find($kkaId);
        if (!$kkaInformation) {
            return redirect()->back()->with('error', 'KKA yang dipilih tidak ditemukan.');
        }
    
        // Temukan auditor yang memiliki peran sebagai Ketua Tim pada id_audit yang sama dengan id_audit pada kka
        $ketuaTim = Auditor::where('jabatan', 'Ketua Tim')
                            ->where('id_audit', $kkaInformation->id_audit)
                            ->first();
    
        if (!$ketuaTim) {
            return redirect()->back()->with('error', 'Auditor sebagai Ketua Tim tidak ditemukan.');
        }
    
        // Temukan pengawas yang memiliki peran sebagai Pengawas pada id_audit yang sama dengan id_audit pada kka
        $pengawas = Auditor::where('jabatan', 'Pengawas')
                            ->where('id_audit', $kkaInformation->id_audit)
                            ->first();
    
        if (!$pengawas) {
            return redirect()->back()->with('error', 'Auditor sebagai Pengawas tidak ditemukan.');
        }
    
        // Membuat instance model Lhap
        $lhap = new Lhap();
    
        // Menyimpan data dari KKA yang sedang terpilih ke dalam model Lhap
        $lhap->id_kka = $kkaId;
        $lhap->id_user = $userId;
        $lhap->id_audit = $kkaInformation->id_audit; // Menambahkan id_audit ke model Lhap
        $lhap->nomor_kka = $kkaInformation->nomor_kka;
        $lhap->auditor_kka = $kkaInformation->auditor_kka;
        $lhap->audit_kka = $kkaInformation->audit_kka;
        $lhap->sebab = $kkaInformation->sebab;
        $lhap->akibat = $kkaInformation->akibat;
        $lhap->rekomendasi = $kkaInformation->rekomendasi;
        $lhap->evidence = $kkaInformation->evidence;
        $lhap->kondisi_teks = $kkaInformation->kondisi_teks;
        $lhap->kriteria_teks = $kkaInformation->kriteria_teks;
        $lhap->dibuat_oleh = $kkaInformation->auditor_kka;
    
        // Ambil nama ketua tim dan nama pengawas dari auditor
        $lhap->nama_ketuatim = $ketuaTim->nama;
        $lhap->nama_pengawas = $pengawas->nama;
    
        // Lanjutkan dengan menyimpan data lainnya sesuai kebutuhan
    
        // Simpan path atau URL gambar kondisi_images
        $kondisiImagesPaths = [];
        $kondisiImages = json_decode($kkaInformation->kondisi_images, true); // Dekode JSON menjadi array
        if (!empty($kondisiImages)) {
            foreach ($kondisiImages as $image) {
                $imagePath = 'kondisi_images/' . basename($image); // Misalnya, asumsi gambar disimpan di storage dengan prefix 'public/'
                $kondisiImagesPaths[] = $imagePath;
            }
        }
        $lhap->kondisi_images = json_encode($kondisiImagesPaths);
    
        // Simpan path atau URL gambar kriteria_images
        $kriteriaImagesPaths = [];
        $kriteriaImages = json_decode($kkaInformation->kriteria_images, true); // Dekode JSON menjadi array
        if (!empty($kriteriaImages)) {
            foreach ($kriteriaImages as $image) {
                $imagePath = 'kriteria_images/' . basename($image); // Misalnya, asumsi gambar disimpan di storage dengan prefix 'public/'
                $kriteriaImagesPaths[] = $imagePath;
            }
        }
        $lhap->kriteria_images = json_encode($kriteriaImagesPaths);
    
        // Simpan data ke dalam database Lhap
        $lhap->save();
    
        // Redirect atau tampilkan pesan berhasil jika berhasil disimpan
        return redirect()->back()->with('success', 'Data KKA berhasil dikirim untuk direview oleh Ketua Tim.');
    }
    
}
