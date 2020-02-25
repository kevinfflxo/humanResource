@extends('layouts.admin')

@section('content')
	<div class="row">
		<div class="offset-md-2 col-md-8">
			<h1>All Profiles</h1>
		</div>
	</div>

	<div class="row">
		<div class="offset-md-2 col-md-8">
			<table class="table">
				<thead>
				    <tr>
				      	<th scope="col">name</th>
				      	<th scope="col">email</th>
				      	<th></th>
				    </tr>
			  	</thead>
			 	@foreach($users as $user)
			 		<tr>
				      	<td>{{ $user->name }}</td>     	
					    <td>{{ $user->email }}</td>
					    <td><a href="{{ route('admin.show', $user->id) }}" class="btn btn-outline-primary">View</a></td>
				    </tr>
			 	@endforeach

			</table>
		</div>
	</div>
@stop