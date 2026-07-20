<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NotificationController extends Controller
{
    public function page(): View
    {
        return view('admin.notifikasi.index');
    }

    public function index(Request $request): JsonResponse
    {
        $notifications = Notification::query()
            ->where('notifiable_type', \App\Models\User::class)
            ->where('notifiable_id', auth()->id())
            ->orderByDesc('created_at')
            ->paginate(15);

        return response()->json($notifications);
    }

    public function markAsRead(Notification $notification): JsonResponse
    {
        abort_unless(
            $notification->notifiable_type === \App\Models\User::class && $notification->notifiable_id === auth()->id(),
            403
        );
        $notification->markAsRead();

        return response()->json(['message' => 'Notifikasi ditandai sudah dibaca.']);
    }

    public function markAllAsRead(): JsonResponse
    {
        Notification::unread()
            ->where('notifiable_type', \App\Models\User::class)
            ->where('notifiable_id', auth()->id())
            ->update(['read_at' => now()]);

        return response()->json(['message' => 'Semua notifikasi ditandai sudah dibaca.']);
    }

    public function unreadCount(): JsonResponse
    {
        $count = Notification::unread()
            ->where('notifiable_type', \App\Models\User::class)
            ->where('notifiable_id', auth()->id())
            ->count();

        return response()->json(['count' => $count]);
    }
}
