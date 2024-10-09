<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\History;
use App\Models\Episode;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    // Lưu lịch sử xem phim
    public function store($movieId, $episodeId)
    {
        // Kiểm tra xem tập phim có tồn tại không
        $episode = Episode::find($episodeId);
        if (!$episode || $episode->movie_id !== $movieId) {
            return response()->json(['message' => 'Episode not found.'], 404);
        }

        // Tạo mới lịch sử xem
        $history = History::create([
            'watched_at' => now(),
            'user_id' => Auth::id(),
            'episode_id' => $episodeId,
        ]);

        return response()->json(['message' => 'Watch history saved successfully.', 'history' => $history], 201);
    }

    // Xem lịch sử xem phim của người dùng
    public function index()
    {
        $userId = Auth::id();
        $histories = History::with('episode')->where('user_id', $userId)->get();

        return response()->json($histories);
    }
}