@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="offset-md-2 col-md-8">
		<div class="row">
			<div class="col-md-6">
				<dl class="row">
				  	<dt class="col-md-6 text-truncate">Name : </dt>
				  	<dd class="col-md-6">{{ $profile->name }}</dd>
				</dl>
				<dl class="row">
				  	<dt class="col-md-6 text-truncate">Sex : </dt>
				  	<dd class="col-md-6"><?php echo $profile->sex == 1 ? "男" : "女"; ?>
				  	</dd>
				</dl>
				<dl class="row">
				  	<dt class="col-md-6 text-truncate">ID No. : </dt>
				  	<dd class="col-md-6">{{ $profile->identity_card_number }}</dd>
				</dl>
				<dl class="row">
				  	<dt class="col-md-6 text-truncate">Phone : </dt>
				  	<dd class="col-md-6">{{ $profile->phone }}</dd>
				</dl>
				<dl class="row">
				  	<dt class="col-md-6 text-truncate">E-mail : </dt>
				  	<dd class="col-md-6">{{ $profile->email }}</dd>
				</dl>
				<dl class="row">
				  	<dt class="col-md-6 text-truncate">Address : </dt>
				  	<dd class="col-md-6">{{ $profile->address }}</dd>
				</dl>
				<dl class="row">
				  	<dt class="col-md-6 text-truncate">Marital Status : </dt>
				  	<dd class="col-md-6"><?php echo $profile->married == 0 ? "未婚" : "已婚"; ?></dd>
				</dl>
				<dl class="row">
				  	<dt class="col-md-6 text-truncate">Date of Birth : </dt>
				  	<dd class="col-md-6">{{ date('M j, Y', strtotime($profile->birthday)) }}</dd>
				</dl>
				<dl class="row">
				  	<dt class="col-md-6 text-truncate">On Board : </dt>
				  	<dd class="col-md-6">{{ date('M j, Y', strtotime($profile->on_board)) }}</dd>
				</dl>
				<dl class="row">
				  	<dt class="col-md-6 text-truncate">Off Board : </dt>
				  	<dd class="col-md-6"><?php echo empty($profile->off_board)?"":date('M j, Y', strtotime($profile->off_board)) ?></dd>
				</dl>
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						Transaction
					</div>
					<div class="card-body">
						<dl class="row">
						  	<dt class="col-md-4">Created at : </dt>
						  	<dd class="col-md-8">{{ date('M j, Y h:ia', strtotime($profile->created_at)) }}
						  	</dd>
						</dl>
						<dl class="row">
						  	<dt class="col-md-4">Updated at : </dt>
						  	<dd class="col-md-8">{{ date('M j, Y h:ia', strtotime($profile->updated_at)) }}
						  	</dd>
						</dl>
						<hr>
						<div class="row">
							<div class="col-md-6">
								<a href="#" class="btn btn-outline-primary btn-block">Edit</a>
							</div>
							<div class="col-md-6">
								<a href="#" class="btn btn-outline-danger btn-block">Delete</a>
							</div>
						</div>
						<div class="row" style="margin-top: 15px;">
							<a href="{{ route('admin.index') }}" class="btn btn-light btn-block"><< Show All Profiles</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop




