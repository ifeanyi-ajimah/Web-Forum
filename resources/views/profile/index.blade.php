@extends('layouts.front')

@section('category')

    <div class="col-md-3">
        <div class="dp col-md-3">
            <img src="https://dummyimage.com/200x200/000/fff" alt="">
        </div>
        <h3>
            {{ $user->name }}
        </h3>

    </div>

@endsection

@section('content')

    <div >
        <h3> {{ $user->name }}s latest Threads </h3>
        @forelse($threads as $thread)
        <h5> {{ $thread->subject }}</h5>
        @empty
        <h5> No threads yet</h5>
        @endforelse

        <br>
        <hr>
        <h3> {{ $user->name }}s latest comments</h3>
        
        @forelse($comments as $comment)
            <h5> {{ $user->name }} commented on <a href="{{ route('thread.show',$comment->commentable_id) }}"> {{ $comment->commentable['subject'] }} </a>   </h5> <small> {{ $comment->created_at->diffForHumans() }} </small>
        @empty
            <h5> No comments yet </h5>
        @endforelse

    </div>
@endsection
























