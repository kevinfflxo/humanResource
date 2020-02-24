@extends('layouts.app')

@section("navbar-brand", "-ADMIN")

@section("navbar")
@if (Auth::guard('admin')->check())
<!-- Left Side Of Navbar -->
<ul class="navbar-nav mr-auto">
	<li class="nav-item"><a class="nav-link" href={{ route('admin.index') }} >index</a></li>
	<li class="nav-item"><a class="nav-link" href={{ route('register') }} >userRegister</a></li>
</ul>

<!-- Right Side Of Navbar -->
<ul class="navbar-nav ml-auto">
	<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Hello {{ Auth::guard('admin')->user()->name }}</a>
		<div class="dropdown-menu">
		    <a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a>
		</div>
	</li>
</ul>
@endif
@stop