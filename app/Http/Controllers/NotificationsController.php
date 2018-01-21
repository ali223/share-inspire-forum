<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if (!$request->expectsJson()) {
            return;
        }

        $notifications = auth()->user()->unreadNotifications;

        return $notifications;

    }

    public function destroy($notificationId)
    {
        auth()->user()
            ->unreadNotifications()
            ->find($notificationId)
            ->markAsRead();

        return response()->json(['message' => 'Notification marked as read']);
    }
}
