@extends('layouts.user')

@section('content')
<div class="row">
	<div class="offset-md-2 col-md-8">
		@if (isset($statusRequest))
		<div class="gray-title">
			Your updated request is being verified！
		</div>
			
		@else
		<div class="row">
			<div class="col-md-7">
				<dl class="row">
				  	<dt class="col-md-4 text-truncate">Name : </dt>
				  	<dd class="col-md-8">{{ $profile->user->name }}</dd>
				</dl>
				<dl class="row">
				  	<dt class="col-md-4 text-truncate">Photo : </dt>
				  	@if (isset($profile->image))
				  	<dd class="col-md-8"><img src="{{ route('image.displayImage', $profile->image) }}" alt="" title=""></dd>
				  	@endif
				</dl>
				<dl class="row">
				  	<dt class="col-md-4 text-truncate">Sex : </dt>
				  	<dd class="col-md-8">
				  		@if (!isset($profile->sex))
				  		@elseif ($profile->sex == 1)
							男
						@else
							女
				  		@endif
				  	</dd>
				</dl>
				<dl class="row">
				  	<dt class="col-md-4 text-truncate">ID No. : </dt>
				  	<dd class="col-md-8">{{ $profile->identity_card_number }}</dd>
				</dl>
				<dl class="row">
				  	<dt class="col-md-4 text-truncate">Phone : </dt>
				  	<dd class="col-md-8">{{ $profile->phone }}</dd>
				</dl>
				<dl class="row">
				  	<dt class="col-md-4 text-truncate">E-mail : </dt>
				  	<dd class="col-md-8">{{ $profile->user->email }}</dd>
				</dl>
				<dl class="row">
				  	<dt class="col-md-4 text-truncate">Address : </dt>
				  	<dd class="col-md-8">{{ $profile->address }}</dd>
				</dl>
				<dl class="row">
				  	<dt class="col-md-4 text-truncate">Marital Status : </dt>
				  	<dd class="col-md-8">
				  		@if (!isset($profile->married))
				  		@elseif ($profile->married == 0)
							未婚
						@else
							已婚
				  		@endif
				  	</dd>
				</dl>
				<dl class="row">
				  	<dt class="col-md-4 text-truncate">Date of Birth : </dt>
				  	<dd class="col-md-8"><?php echo empty($profile->birthday)?"":date('M j, Y', strtotime($profile->birthday)) ?></dd>
				</dl>
				<dl class="row">
				  	<dt class="col-md-4 text-truncate">On Board : </dt>
				  	<dd class="col-md-8"><?php echo empty($profile->on_board)?"":date('M j, Y', strtotime($profile->on_board)) ?></dd>
				</dl>
				<dl class="row">
				  	<dt class="col-md-4 text-truncate">Off Board : </dt>
				  	<dd class="col-md-8"><?php echo empty($profile->off_board)?"":date('M j, Y', strtotime($profile->off_board)) ?></dd>
				</dl>
			</div>
			<div class="col-md-5">
				<div class="card">
					<div class="card-header">
						Transaction
					</div>
					<div class="card-body">
						<dl class="row">
						  	<dt class="col-md-4">Created:</dt>
						  	<dd class="col-md-8">{{ date('M j, Y h:ia', strtotime($profile->created_at)) }}
						  	</dd>
						</dl>
						<dl class="row">
						  	<dt class="col-md-4">Updated:</dt>
						  	<dd class="col-md-8">{{ date('M j, Y h:ia', strtotime($profile->updated_at)) }}
						  	</dd>
						</dl>
						<hr>
						<div class="row" style="margin-top: 15px;">
							<div class="col-md-12">
								<a href="{{ route('user.edit', $profile->id) }}" class="btn btn-outline-primary btn-block">Edit</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif
	</div>
</div>
@stop




