@extends('layouts.front')
@section('heading','Create Thread')
@section('content')
<div class="row">

	<div class="well well-lg">
    @include('includes.messages')
	<form action="{{route('thread.update',$thread->id)}}" method="post" enctype="multipart/form-data">
    {{ method_field('PUT') }}
		@csrf
    <div class="form-group ">
      <label>Subject </label>
      <input type="text" name="subject" class="form-control form-control-lg"  value="{{ $thread->subject }}"  placeholder="Subject ">
    </div>

    <div class="form-group">
	  <label>Type</label>
	  <input type="text" name="type" class="form-control"  value="{{ $thread->type }}" placeholder="Type">
    </div>
    <div class="form-group">
      <label for="exampleTextarea">Thread</label>
      <textarea name="thread" class="form-control" rows="4">
        {{ $thread->thread }}
      </textarea>
    </div>

  <button type="submit" class="btn btn-primary">Submit</button>

</form>
</div>

</div>


@endsection

