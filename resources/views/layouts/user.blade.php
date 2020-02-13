@extends('layouts.app')

@section("navbar-brand", "-USER")

@section("navbar")
@if (Auth::guard('web')->check())
<!-- Left Side Of Navbar -->
<ul class="navbar-nav mr-auto">
</ul>
<!-- Right Side Of Navbar -->
<ul class="navbar-nav ml-auto">
	<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Hello {{ Auth::guard('web')->user()->name }}</a>
		<div class="dropdown-menu">
		    <a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a>
		</div>
	</li>
</ul>
@endif
@stop