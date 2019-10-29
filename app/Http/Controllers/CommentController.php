<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Notifications\RepliedToThread;
use Illuminate\Http\Request;
use App\Thread;
use App\User;
class CommentController extends Controller
{


    public function addThreadComment(Request $request, Thread $thread)
    {
        $this->validate($request,[
            'body' => 'required'
        ]);

           $thread->addComment($request->body);
           $commentor = auth()->user();
           //dd($commentor);
            //dd($thread->user);
            $thread->user->notify(new RepliedToThread ($thread, $commentor));
            // $user = User::find(3);
            // $user->notify(new RepliedToThread());

        return back()->with('status','Comment Added');

    }


    // $this->validate($request,[
    //     'body' => 'required'
    // ]);

    //    $thread->addComment($request->body);
    //     // auth()->user()->notify(new RepliedToThread( $thread));  //creates a notification on the notifications database table
    //     //dd($thread->user);
    //     $thread->user->notify(new RepliedToThread ($thread));
    //     // $user = User::find(3);
    //     // $user->notify(new RepliedToThread());

    // return back()->with('status','Comment Added');


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
