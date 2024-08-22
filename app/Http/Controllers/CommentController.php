<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate(['text' => 'string|required']);
        $request->user()->comments()->create($validated);

        return back();
    }

    public function index()
    {
        $comments = Comment::with('user')
            ->where('id', '>', session('last_comment_read', 0))
            ->latest()
            ->get();

        if ($comments->isEmpty()) {
            return response()->noContent();
        }

        session(['last_comment_read' => $comments->first()->id]);

        return view('stream', ['comments' => $comments])->fragment('comments');
    }
}
