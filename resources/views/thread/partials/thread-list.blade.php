<div class="list-group">

	@forelse($threads as $thread)
		<div  class="list-group-item list-group-item-action" >
			<a href="{{route('thread.show',$thread->id)}}"> <h3 class="list-group-heading">{{$thread->subject}}</h3> </a>
			
			<p class="list-group-item-text"> {{str_limit($thread->thread,100) }}</p>
		</div>
	@empty

	<h5>No Threads</h5>

	@endforelse
</div>