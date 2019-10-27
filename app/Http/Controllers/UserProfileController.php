<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Thread;

use Auth;

class UserProfileController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $threads = Thread::where('user_id', $user->id)->latest()->get();
        $comments = Comment::where('user_id', $user->id)->where('commentable_type','App\Thread')->get();
        return view('profile.index', compact('threads','comments', 'user'));
    }
}
