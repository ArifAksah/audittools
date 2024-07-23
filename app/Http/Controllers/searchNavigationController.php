<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class SearchNavigationController extends Controller
{
    public function index()
    {
        return view('layouts.searchnavigation');
    }

    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->is_read = 1;
        $notification->save();

        return redirect()->back()->with('success', 'Notification marked as read.');
    }
}
