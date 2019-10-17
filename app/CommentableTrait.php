<?php

namespace App;


trait CommentableTrait
{
    public function addComment($body)
    {
        $comment = new Comment;
        $comment->body = $body;
        $comment->user_id = \Auth::id();
        $this->comments()->save($comment);
        return $comment;
    }
}
