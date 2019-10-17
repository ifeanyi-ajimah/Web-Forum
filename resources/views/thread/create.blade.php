@extends('layouts.front')
@section('heading','Create Thread')
@section('content')
<div class="row">

	<div class="well well-lg">
    @include('includes.messages')
	<form action={{route('thread.store')}} method="post">
		@csrf
    <div class="form-group ">
      <label>Subject </label>
      <input type="text" name="subject" class="form-control form-control-lg"  value="{{old('subject')}}"  placeholder="Subject ">
    </div>

    <div class="form-group">
	  <label>Type</label>
	  <input type="text" name="type" class="form-control"  value="{{old('type')}}" placeholder="Type">
    </div>
    <div class="form-group">
      <label for="exampleTextarea">Thread</label>
      <textarea name="thread" class="form-control"   rows="8" cols="100"> {{old('thread')}}</textarea>
    </div>

  <button type="submit" class="btn btn-primary">Submit</button>

</form>
</div>

</div>


@endsection

