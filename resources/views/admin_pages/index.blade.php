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
			 	@foreach($profiles as $pv)
			 		<tr>
				      	<td>{{ $pv->user->name }}</td>     	
					    <td>{{ $pv->user->email }}</td>
					    <td><a href="{{ route('admin.show', $pv->id) }}" class="btn btn-outline-primary">View</a></td>
				    </tr>
			 	@endforeach

			</table>
		</div>
	</div>
@stop