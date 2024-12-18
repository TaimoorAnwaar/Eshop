<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function showNotification()
    {
        $notifications = auth()->user()->notifications;
        Log::info('Notifications for user: ' . auth()->user()->name, $notifications->toArray()); 
    
        return view('manager.notification', compact('notifications'));
    }
    public function markAsRead(DatabaseNotification $notification)
    {
        
        $notification->markAsRead();

        // Redirect back to the notifications page
        return redirect()->route('manager.products.index');
    }
    public function clearAll()
    {
        Auth::user()->notifications()->delete();

        return redirect()->back()->with('success', 'All notifications cleared successfully.');
    }
    
    
    
    
}
