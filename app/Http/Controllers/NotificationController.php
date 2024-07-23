<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markAsRead(Request $request)
    {
        $notification = Notification::find($request->id);

        if ($notification && $notification->user_id == Auth::id()) {
            $notification->is_read = 1;
            $notification->save();

            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error']);
    }
}
