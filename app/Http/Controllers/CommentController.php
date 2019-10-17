<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Thread;

class CommentController extends Controller
{


    public function addThreadComment(Request $request, Thread $thread)
    {
        $this->validate($request,[
            'body' => 'required'
        ]);

        // $comment = new Comment;
        // $comment->body = $request->body;
        // $comment->user_id = \Auth::id();
        // $thread->comments()->save($comment);
        $thread->addComment($request->body);
        return back()->with('status','Comment Added');

    }


    public function addCommentReply(Request $request, Comment $comment)
    {
        $this->validate($request,[
            'body' => 'required'
        ]);
        $reply = new Comment;
        $reply->body = $request->body;
        $reply->user_id = \Auth::id();

        $comment->comments()->save($reply);

        return back()->with('status','Reply Added');

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $comment)
    {
        $comms = Comment::find($comment);
        if($comms->user->id !== auth()->user()->id)
        abort(403, 'Unauthorized action');

        $this->validate($request,[
            'body' => 'required'
        ]);

        $comm = Comment::find($comment);
        $comm->body = $request->body;
        $comm->save();
        return back()->with('status', 'Comment Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if($comment->user->id !== auth()->user()->id)
        abort(403, 'Unauthorized action');
        $comment->delete();
        return back()->with('status', 'Comment Deleted');
    }
}
