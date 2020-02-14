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
				      	<th scope="col">sex</th>
				      	<th scope="col">phone</th>
				      	<th scope="col">email</th>
				      	<th scope="col">on_board</th>
				      	<th></th>
				      	<th></th>
				    </tr>
			  	</thead>
			 	@foreach($profiles as $pv)
			 		<tr>
				      	<td>{{ $pv->name }}</td>     	
				      	<td>
				      		<?php echo $pv->sex == 1 ? "男" : "女"; ?>
				      	</td>
					    <td>{{ $pv->phone }}</td>
					    <td>{{ $pv->email }}</td>
					    <td>{{ $pv->on_board }}</td>
					    <td><a href="{{ route('admin.show', $pv->id) }}" class="btn btn-outline-primary">View</a></td>
				    </tr>
			 	@endforeach

			</table>
		</div>
	</div>
@stop