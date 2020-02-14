@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="offset-md-2 col-md-8">
		<h1>Information Form</h1>
	</div>
</div>

<div class="row">
	<div class="offset-md-2 col-md-8">
		<form action="{{ route('admin.store') }}" method="post" enctype="multipart/form-data" >
			@csrf
			<div class="row">
			    <label for="name" class="col-md-4 col-form-label">Name</label>
			    <label for="phone" class="col-md-4 offset-md-2 col-form-label">Phone</label>
			</div>
			<div class="form-group row">
				<input type="text" class="col-md-4 form-control" placeholder="Ex:王小明" name="name"/>
				<input type="text" class="col-md-4 offset-md-2 form-control" placeholder="Ex:0912345678" name="phone" />
			</div>

			<div class="row">
			    <label for="birthday" class="col-md-4 col-form-label">Date of Birth</label>
			    <label for="identity_card_number" class="col-md-4 offset-md-2 col-form-label">ID No.</label>
			</div>
			<div class="form-group row">
				<input type="date" class="col-md-4 form-control" name="birthday"/>
				<input type="text" class="col-md-4 form-control offset-md-2" placeholder="Ex:A123456789" name="identity_card_number" />
			</div>
			
			<div class="row">
			    <label for="sex" class="col-md-4 col-form-label">Sex</label>
			    <label for="married" class="col-md-4 offset-md-2 col-form-label">Marital Status</label>
			</div>
			<div class="form-group row">
				<div class="col-md-4">
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="sex" value="1">
					  <label class="form-check-label" for="sex">男</label>
					</div>
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="sex" value="2">
					  <label class="form-check-label" for="sex">女</label>
					</div>
				</div>
				<div class="col-md-4 offset-md-2">
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="married" value="1">
					  <label class="form-check-label" for="married">已婚</label>
					</div>
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="married" value="0">
					  <label class="form-check-label" for="married">未婚</label>
					</div>
				</div>
			</div>

			<div class="row">
			    <label for="image" class="col-md-4 col-form-label">Photo</label>
			    <label for="email" class="col-md-4 offset-md-2 col-form-label">E-mail</label>
			</div>
			<div class="form-group row">
				<div class="custom-file col-md-4">
				  <input type="file" class="custom-file-input" name="image">
				  <label class="custom-file-label" for="customFile">Choose file</label>
				</div>

				<input type="text" class="col-md-4 form-control offset-md-2" placeholder='Ex:name@example.com' name="email" />
			</div>

			<div class="row">
			    <label for="address" class="col-md-4 col-form-label">Address</label>
			    <label for="on_board" class="col-md-4 offset-md-2 col-form-label">On Board</label>
			</div>
			<div class="form-group row">
				<input type="text" class="col-md-4 form-control" placeholder="Ex:臺北市北投區" name="address"/>
				<input type="date" class="col-md-4 offset-md-2 form-control" name="on_board" />
			</div>

			<div class="row">
				<label for="off_board" class="col-md-4 col-form-label">Off Board</label>
			</div>
			<div class="form-group row">
				<input type="date" class="col-md-4 form-control" name="off_board" />
				<button tpye="submit" class="btn btn-outline-primary col-md-2 offset-md-4">Submit</button>
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