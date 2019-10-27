<div class="list-group">

    @forelse($threads as $thread)

		{{--  <div  class="list-group-item list-group-item-action" >
			<a href="{{route('thread.show',$thread->id)}}"> <h3 class="list-group-heading">{{$thread->subject}}</h3> </a>

            <p class="list-group-item-text"> {{str_limit($thread->thread,100) }}</p>
            <span class="badge badge-success"> By <a href="{{ route('user_profile', $thread->user['name']) }}"> {{ $thread->user['name'] }} </a> </span>
        </div>  --}}



        <div class="panel panel-success ">
            <div class="panel panel-heading">
			<a href="{{route('thread.show',$thread->id)}}"> <h3 class="list-group-heading">{{$thread->subject}}</h3> </a>

            </div>
            <div class="panel panel-body">

            <p class="list-group-item-text"> {{str_limit($thread->thread,100) }}</p>
            <span > By <a href="{{ route('user_profile', $thread->user['name']) }}"> {{ $thread->user['name'] }} </a> </span>  {{ $thread->created_at->diffForHumans() }}

            </div>

        </div>

	@empty

	<h5>No Threads</h5>

	@endforelse
</div>
