@if ($errors->any())
	    <div class="alert alert-danger" role="alert"">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li style="color:red" >{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
@endif


@if(session()->has('status'))
<div class="alert alert-success" role="alert">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<strong>{{ session('status')}}</strong>
</div>
<!-- <div class="alert alert-success">{{session('status')}}</div> -->
@endif