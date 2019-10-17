@extends('layouts.front')

@section('heading')
<h4> <a class="btn btn-primary pull-right" href="{{route('thread.create')}}"  > Create Thread</a> </h4>

@endsection

@section('content')


@include('thread.partials.thread-list')

@endsection
