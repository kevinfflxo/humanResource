<!DOCTYPE html>
<html>
<head>
    @include('partials._head')
</head>
<body>
	@include('partials._nav')
	<div class="container">
		@yield('content')
	</div>
	@include('partials._javascript')
</body>
</html>