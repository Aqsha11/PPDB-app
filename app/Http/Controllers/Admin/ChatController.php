<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ChatController extends Controller
{
    public function index(): View
    {
        $conversations = Conversation::with('user', 'latestMessage')
            ->where('status', 'open')
            ->orderBy('last_message_at', 'desc')
            ->get()
            ->map(fn ($c) => [
                'id' => $c->id,
                'user' => $c->user,
                'subject' => $c->subject ?? $c->user->name,
                'status' => $c->status,
                'bot_active' => $c->bot_active,
                'last_message' => $c->latestMessage?->body,
                'last_message_at' => $c->last_message_at?->diffForHumans(),
                'unread_count' => $c->unreadForAdmin(),
            ]);

        $closedConversations = Conversation::with('user', 'latestMessage')
            ->where('status', 'closed')
            ->orderBy('last_message_at', 'desc')
            ->limit(20)
            ->get()
            ->map(fn ($c) => [
                'id' => $c->id,
                'user' => $c->user,
                'subject' => $c->subject ?? $c->user->name,
                'last_message' => $c->latestMessage?->body,
                'last_message_at' => $c->last_message_at?->diffForHumans(),
            ]);

        return view('admin.chat.index', compact('conversations', 'closedConversations'));
    }

    public function show(Conversation $conversation): View|JsonResponse
    {
        if (request()->expectsJson()) {
            $conversation->load('user');

            $messages = $conversation->messages()
                ->orderBy('created_at', 'asc')
                ->limit(100)
                ->get()
                ->map(fn ($m) => [
                    'id' => $m->id,
                    'sender_type' => $m->sender_type,
                    'sender_id' => $m->sender_id,
                    'body' => $m->body,
                    'created_at' => $m->created_at->toISOString(),
                    'time' => $m->created_at->format('H:i'),
                ]);

            $conversation->messages()
                ->whereIn('sender_type', ['user'])
                ->where('is_read', false)
                ->update(['is_read' => true]);

            return response()->json([
                'conversation' => [
                    'id' => $conversation->id,
                    'user' => $conversation->user,
                    'status' => $conversation->status,
                    'bot_active' => $conversation->bot_active,
                ],
                'messages' => $messages,
            ]);
        }

        $conversation->load('user', 'messages');
        return view('admin.chat.show', compact('conversation'));
    }

    public function reply(Request $request, Conversation $conversation): JsonResponse
    {
        $request->validate(['message' => 'required|string|max:2000']);

        $conversation->messages()->create([
            'sender_type' => 'admin',
            'sender_id' => Auth::id(),
            'body' => $request->message,
            'is_read' => false,
        ]);

        $conversation->update(['last_message_at' => now()]);

        return response()->json([
            'message' => [
                'id' => $conversation->messages()->latest()->first()->id,
                'sender_type' => 'admin',
                'sender_id' => Auth::id(),
                'body' => $request->message,
                'created_at' => now()->toISOString(),
                'time' => now()->format('H:i'),
            ],
        ]);
    }

    public function close(Conversation $conversation): JsonResponse
    {
        $conversation->update(['status' => 'closed']);

        $conversation->messages()->create([
            'sender_type' => 'bot',
            'body' => 'Percakapan telah ditutup oleh admin. Jika ada pertanyaan lain, silakan buka chat baru. Terima kasih! 😊',
            'is_read' => false,
        ]);

        return response()->json(['ok' => true]);
    }

    public function reopen(Conversation $conversation): JsonResponse
    {
        $conversation->update(['status' => 'open', 'last_message_at' => now()]);

        $conversation->messages()->create([
            'sender_type' => 'bot',
            'body' => 'Percakapan telah dibuka kembali oleh admin. Silakan sampaikan pertanyaan Anda.',
            'is_read' => false,
        ]);

        return response()->json(['ok' => true]);
    }

    public function toggleBot(Conversation $conversation): JsonResponse
    {
        $conversation->update(['bot_active' => !$conversation->bot_active]);

        $state = $conversation->bot_active ? 'diaktifkan' : 'dinonaktifkan';
        $conversation->messages()->create([
            'sender_type' => 'bot',
            'body' => "Bot otomatis telah {$state} oleh admin.",
            'is_read' => false,
        ]);

        return response()->json(['bot_active' => $conversation->bot_active]);
    }

    public function unreadCount(): JsonResponse
    {
        $count = Message::where('sender_type', 'user')
            ->where('is_read', false)
            ->count();

        return response()->json(['count' => $count]);
    }
}
