<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use App\Services\ChatBotService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ChatController extends Controller
{
    public function __construct(
        protected ChatBotService $bot
    ) {}

    private function isOperationalHours(): bool
    {
        $timezone = config('services.chat.timezone', 'Asia/Makassar');
        $jamMulai = config('services.chat.jam_mulai', 8);
        $jamSelesai = config('services.chat.jam_selesai', 17);

        $now = Carbon::now($timezone);

        return $now->hour >= $jamMulai && $now->hour < $jamSelesai;
    }

    public function index(Request $request): JsonResponse
    {
        $user = Auth::user();
        $conversation = Conversation::where('user_id', $user->id)
            ->where('status', 'open')
            ->with('latestMessage')
            ->first();

        $messages = [];
        if ($conversation) {
            $messages = $conversation->messages()
                ->orderBy('created_at', 'asc')
                ->limit(50)
                ->get()
                ->map(fn ($m) => [
                    'id' => $m->id,
                    'sender_type' => $m->sender_type,
                    'body' => $m->body,
                    'created_at' => $m->created_at->toISOString(),
                ]);
        }

        $jamMulai = config('services.chat.jam_mulai', 8);
        $jamSelesai = config('services.chat.jam_selesai', 17);

        return response()->json([
            'conversation' => $conversation ? [
                'id' => $conversation->id,
                'status' => $conversation->status,
                'bot_active' => $conversation->bot_active,
            ] : null,
            'messages' => $messages,
            'is_operational' => $this->isOperationalHours(),
            'jam_mulai' => $jamMulai,
            'jam_selesai' => $jamSelesai,
        ]);
    }

    public function send(Request $request): JsonResponse
    {
        $request->validate(['message' => 'required|string|max:2000']);

        $user = Auth::user();
        $conversation = Conversation::where('user_id', $user->id)
            ->where('status', 'open')
            ->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'user_id' => $user->id,
                'status' => 'open',
                'bot_active' => true,
                'last_message_at' => now(),
            ]);
        }

        $userMessage = $conversation->messages()->create([
            'sender_type' => 'user',
            'sender_id' => $user->id,
            'body' => $request->message,
            'is_read' => false,
        ]);

        $conversation->update(['last_message_at' => now()]);

        $botReply = null;
        if ($this->bot->isEnabled() && $conversation->bot_active) {
            $recentMessages = $conversation->messages()
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get()
                ->reverse()
                ->map(fn ($m) => [
                    'sender_type' => $m->sender_type,
                    'body' => $m->body,
                ])
                ->toArray();

            $botReply = $this->bot->getReply($request->message, $recentMessages);

            if ($botReply) {
                $conversation->messages()->create([
                    'sender_type' => 'bot',
                    'body' => $botReply,
                    'is_read' => false,
                ]);
                $conversation->update(['last_message_at' => now()]);
            }
        }

        return response()->json([
            'user_message' => [
                'id' => $userMessage->id,
                'sender_type' => 'user',
                'body' => $userMessage->body,
                'created_at' => $userMessage->created_at->toISOString(),
            ],
            'bot_message' => $botReply ? [
                'id' => $conversation->messages()->where('sender_type', 'bot')->latest()->first()->id,
                'sender_type' => 'bot',
                'body' => $botReply,
                'created_at' => now()->toISOString(),
            ] : null,
        ]);
    }

    public function markRead(): JsonResponse
    {
        $user = Auth::user();
        $conversation = Conversation::where('user_id', $user->id)
            ->where('status', 'open')
            ->first();

        if ($conversation) {
            $conversation->messages()
                ->whereIn('sender_type', ['admin', 'bot'])
                ->where('is_read', false)
                ->update(['is_read' => true]);
        }

        return response()->json(['ok' => true]);
    }

    public function unreadCount(): JsonResponse
    {
        $user = Auth::user();
        $count = Message::whereHas('conversation', fn ($q) => $q->where('user_id', $user->id)->where('status', 'open'))
            ->whereIn('sender_type', ['admin', 'bot'])
            ->where('is_read', false)
            ->count();

        return response()->json(['count' => $count]);
    }

    public function escalate(Request $request): JsonResponse
    {
        $user = Auth::user();
        $conversation = Conversation::where('user_id', $user->id)
            ->where('status', 'open')
            ->first();

        if (!$conversation) {
            return response()->json(['error' => 'Tidak ada percakapan aktif'], 404);
        }

        $conversation->update(['bot_active' => false]);

        if ($this->isOperationalHours()) {
            $reply = 'Baik, permintaan Anda telah diteruskan ke admin. Mohon tunggu sebentar, admin akan segera merespon. 🙏';
        } else {
            $jamMulai = config('services.chat.jam_mulai', 8);
            $jamSelesai = config('services.chat.jam_selesai', 17);
            $reply = "Baik, permintaan Anda telah diteruskan ke admin. Namun saat ini di luar jam operasional (Jam {$jamMulai}.00 – {$jamSelesai}.00 WITA). Admin akan merespon pada jam kerja berikutnya. 🙏";
        }

        $conversation->messages()->create([
            'sender_type' => 'bot',
            'body' => $reply,
            'is_read' => false,
        ]);

        return response()->json(['ok' => true]);
    }
}
