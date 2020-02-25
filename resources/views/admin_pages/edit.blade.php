@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="offset-md-2 col-md-8">
		<h1>Update</h1>
	</div>
</div>

<div class="row">
	<div class="offset-md-2 col-md-8">
		<form action="{{ route('admin.update', $profile->id) }}" method="post" enctype="multipart/form-data" >
			@csrf
			<input name="_method" type="hidden" value="PUT">
			<div class="row">
			    <label for="name" class="col-md-4 col-form-label">Name</label>
			    <label for="phone" class="col-md-4 offset-md-2 col-form-label">Phone</label>
			</div>
			<div class="row">
				<input type="text" class="col-md-4 form-control" placeholder="Ex:王小明" name="name" value="{{ $profile->user->name }}"/>
				<input type="text" class="col-md-4 offset-md-2 form-control" placeholder="Ex:0912345678" name="phone" value="{{ $profile->phone }}"/>
			</div>

			<div class="row">
			    <label for="birthday" class="col-md-4 col-form-label">Date of Birth</label>
			    <label for="identity_card_number" class="col-md-4 offset-md-2 col-form-label">ID No.</label>
			</div>
			<div class="row">
				<input type="date" class="col-md-4 form-control" name="birthday" value="{{ $profile->birthday }}"/>
				<input type="text" class="col-md-4 form-control offset-md-2" placeholder="Ex:A123456789" name="identity_card_number" value="{{ $profile->identity_card_number }}"/>
			</div>
			
			<div class="row">
			    <label for="sex" class="col-md-4 col-form-label">Sex</label>
			    <label for="married" class="col-md-4 offset-md-2 col-form-label">Marital Status</label>
			</div>
			<div class="row">
				<div class="col-md-4">
					@if ($profile->sex == null)
					<div class="form-check form-check-inline">
					  	<input class="form-check-input" type="radio" name="sex" value="1" />
					  	<label class="form-check-label" for="sex">男</label>
					</div>
					<div class="form-check form-check-inline">
					  	<input class="form-check-input" type="radio" name="sex" value="2" />
					  	<label class="form-check-label" for="sex">女</label>
					</div>
					@elseif ($profile->sex == 1)
					<div class="form-check form-check-inline">
					  	<input class="form-check-input" type="radio" name="sex" value="1" checked />
					  	<label class="form-check-label" for="sex">男</label>
					</div>
					<div class="form-check form-check-inline">
					  	<input class="form-check-input" type="radio" name="sex" value="2" />
					  	<label class="form-check-label" for="sex">女</label>
					</div>
					@else
					<div class="form-check form-check-inline">
					  	<input class="form-check-input" type="radio" name="sex" value="1" />
					  	<label class="form-check-label" for="sex">男</label>
					</div>
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="sex" value="2 /" checked>
					  <label class="form-check-label" for="sex">女</label>
					</div>
					@endif
				</div>
				<div class="col-md-4 offset-md-2">
					@if ($profile->married == null)
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="married" value="1" />
						<label class="form-check-label" for="married">已婚</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="married" value="0" />
						<label class="form-check-label" for="married">未婚</label>
					</div>
					@elseif ($profile->married == 1)
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="married" value="1" checked />
						<label class="form-check-label" for="married">已婚</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="married" value="0" />
						<label class="form-check-label" for="married">未婚</label>
					</div>
					@else
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="married" value="1" />
						<label class="form-check-label" for="married">已婚</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="married" value="0" checked />
						<label class="form-check-label" for="married">未婚</label>
					</div>
					@endif
				</div>
			</div>

			<div class="row">
			    <label for="image" class="col-md-4 col-form-label">Photo</label>
			    <label for="email" class="col-md-4 offset-md-2 col-form-label">E-mail</label>
			</div>
			<div class="row">
				<div class="custom-file col-md-4">
				  <input type="file" class="custom-file-input" name="image">
				  <label class="custom-file-label" for="customFile">Choose file</label>
				</div>

				<input type="text" class="col-md-4 form-control offset-md-2" placeholder='Ex:name@example.com' name="email" value="{{ $profile->user->email }}" />
			</div>

			<div class="row">
			    <label for="address" class="col-md-4 col-form-label">Address</label>
			    <label for="on_board" class="col-md-4 offset-md-2 col-form-label">On Board</label>
			</div>
			<div class="row">
				<input type="text" class="col-md-4 form-control" placeholder="Ex:臺北市北投區" name="address" value="{{ $profile->address }}"/>
				<input type="date" class="col-md-4 offset-md-2 form-control" name="on_board" value="{{ $profile->on_board }}"/>
			</div>

			<div class="row">
				<label for="off_board" class="col-md-4 col-form-label">Off Board</label>
			</div>
			<div class="row">
				<input type="date" class="col-md-4 form-control" name="off_board" value="{{ $profile->off_board }}"/>
				<a href="{{ route('admin.show', $profile->id) }}" class="btn btn-outline-secondary col-md-1 offset-md-2">Cancel</a>
				<button tpye="submit" class="btn btn-outline-primary col-md-1 offset-md-2">Submit</button>
			</div>
		</form>
	</div>
</div>
@stop

<!-- jquery -->
@section('javascript')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
	  	$(".custom-file-input").change(function () {
	    	$(this).next(".custom-file-label").html($(this).val().split("\\").pop());
	  	});
	});
</script>
@stop