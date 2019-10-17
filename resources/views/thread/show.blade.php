@extends('layouts.front')

@section('content')
<h4> <b> {{ $thread->subject }} </b> </h4>
<hr>
<div class="thread-details">
    {{ $thread->thread }}
    {{--  {!! \Michelf\Markdown::defaultTransform($thread->thread)  !!}  --}}
</div>
<br> <br>

@if(Auth::id() == $thread->user_id)

  <div class="actions">
    <a href="{{ route('thread.edit',$thread->id) }}" class="btn btn-info btn-xs"> Edit</a>

    <form action="{{ route('thread.destroy',$thread->id) }}" method="POST" class="inline-it">
            @csrf
            {{ method_field('DELETE')}}
    <input class="btn btn-xs btn-danger" type="submit" value="Delete">
    </form>
 </div>
@endif
<hr>
<br>
<h3>Comments</h3>
{{-- COMMENTS --}}
<hr>

    <div class="comment-list">
        @foreach($thread->comments as $comment)

         <h4> {{ $comment->body }}</h4>

        @if(!empty($thread->solution))

        @if($thread->solution == $comment->id)
            <button class="btn btn-success pull-right"> Solution</button>
        @endif

        @else
        @auth()
        @if( auth()->user()->id == $thread->user_id)

        {{-- <form action="{{ route('markAsSolution') }}" method="post">
                @csrf
                <input type="hidden" name="threadId" value="{{ $thread->id }}">
                <input type="hidden" name="solutionId" value="{{ $comment->id }}">
                <input type="submit" class="btn btn-success pull-right " id="{{ $comment->id }}" value=" Mark as solution">
        </form>
         --}}
         <button class="btn btn-success pull-right " onclick="markAsSolution('{{ $thread->id }}', '{{ $comment->id }}', this)"> Mark as solutionn</button>
        @endif
        @endauth
        @endif
        <br>
          <lead>Comment By</lead>:  <lead>  {{ $comment->user->name }}</lead>

                {{-- Action On Comment --}}
                {{-- -modal --}}
                <div class="actions">
                <a type="button" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#{{ $comment->id }}">
                    edit
                </a>

                <div class="modal fade" id="{{ $comment->id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $comment->id }}Title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Edit Comment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">

                                    <div class="comment-form">

                                        <form action="{{ route('comment.update',$comment->id) }}" method="post" role="form">
                                        {{ method_field('PUT') }}
                                        @csrf

                                            <div class="form-group">
                                                <label for=""></label>
                                                <input type="text" class="form-control" value="{{ $comment->body }}" required name="body" id="" placeholder="comment here...">
                                            </div>

                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                    </div>
                            </div>
                      </div>
                    </div>
                </div>
                  {{-- modal end --}}

                {{-- delete --}}

                        {{--  <a href="{{ route('thread.edit',$thread->id) }}" class="btn btn-info btn-xs"> Edit</a>  --}}

                        <form action="{{ route('comment.destroy',$comment->id) }}" method="POST" >
                                @csrf
                                {{ method_field('DELETE')}}
                        <input class="btn btn-xs btn-danger pull-right" type="submit" value="Delete">
                        </form>
                </div>
                <br> <hr>
            {{-- reply comment --}}

       @foreach ($comment->comments  as $reply )

        <div class="small well text-info reply-list" style="margin-left:40px;">
            <p>{{ $reply->body }}</p>
            <lead> by {{ $reply->user->name }}</lead>
            {{-- edit and delete --}}
            <div class="actions">
                <a type="button" class="btn btn-primary btn-xs pull-right " data-toggle="modal" data-target="#{{ $reply->id }}">
                    edit
                </a>

                <div class="modal fade" id="{{ $reply->id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $reply->id }}Title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Comment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">

                            <div class="comment-form">
                                <form action="{{ route('replycomment.update',$reply->id) }}" method="post" role="form">
                                {{ method_field('PUT') }}
                                    @csrf

                                    <div class="form-group">
                                        <label for=""></label>
                                        <input type="text" class="form-control" value="{{ $reply->body }}" required name="body" id="" placeholder="reply...">
                                    </div>

                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Reply</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                {{-- modal end --}}

                {{-- delete --}}

                        {{--  <a href="{{ route('thread.edit',$thread->id) }}" class="btn btn-info btn-xs"> Edit</a>  --}}
                        <form action="{{ route('replycomment.destroy',$reply->id) }}" method="POST" class="inline-itXX">
                                @csrf
                                {{ method_field('DELETE')}}
                        <input class="btn btn-xs btn-danger pull-right" type="submit" value="Delete">
                        </form>
            </div>

            {{-- end edit and delete --}}
        </div>
        <hr>
        @endforeach

        <button class="btn btn-xs btn-default " onclick="toggleReply('{{ $comment->id }}')"> Reply</button>
             <div style="margin-left:50px" class="reply-form-{{ $comment->id }} hidden">

                    <form action="{{ route('replycomment.store',$comment->id) }}" method="post" role="form">
                        @csrf

                        <div class="form-group">
                            <label for=""></label>
                            <input type="text" class="form-control" required name="body" id="" placeholder="reply...">
                        </div>

                        <button type="submit" class="btn btn-primary btn-xs"> reply.. </button>
                    </form>

            </div>
        @endforeach

    </div>
    <hr>
    <div class="comment-form">

        <form action="{{ route('threadcomment.store',$thread->id) }}" method="post" role="form">
            @csrf
            <legend> Create New Comment </legend>

            <div class="form-group">
                <label for=""></label>
                <input type="text" class="form-control" required name="body" id="" placeholder="comment here...">
            </div>

            <button type="submit" class="btn btn-primary"> Comment </button>
        </form>

    </div>
<br><br>





@endsection

@section('script')
<script>
     function toggleReply(id){
        $(`.reply-form-${id}`).toggleClass('hidden');
       // $('.reply-form-'+id).toggleClass('hidden');
     }

     function markAsSolution(threadId, commentId, thetext)
     {
            var csrfToken = '{{ csrf_token() }}';

            $.post( '{{ route('markAsSolution') }}',
            {
                threadId : threadId,
                solutionId : commentId,

                _token: csrfToken,
                })
            .done(( data ) => {
                console.log(data);
            alert( "Data Loaded: " + data.data );
            $(thetext).text('solution');
            });
     }

</script>


@endsection


