@extends('_main')

@section('title', 'user')

@section('content')
	This is <strong>USER HOME</strong>
	<a href="{{ route('user.logout') }}" class="btn btn-outline-primary">登出</a>
@stop
