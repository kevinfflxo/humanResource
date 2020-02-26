@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="offset-md-2 col-md-8">
		<div class="row">
			<div class="col-md-7">
				<dl class="row">
				  	<dt class="col-md-4 text-truncate">Name : </dt>
				  	<dd class="col-md-8">{{ $updatedRequest->name }}</dd>
				</dl>
				<dl class="row">
				  	<dt class="col-md-4 text-truncate">Photo : </dt>
				  	<dd class="col-md-8"><img src="{{ route('image.displayImage',$updatedRequest->image) }}" alt="" title=""></dd>
				</dl>
				<dl class="row">
				  	<dt class="col-md-4 text-truncate">Sex : </dt>
				  	<dd class="col-md-8">
				  		@if (!isset($updatedRequest->sex))
				  		@elseif ($updatedRequest->sex == 1)
							男
						@else
							女
				  		@endif
				  	</dd>
				</dl>
				<dl class="row">
				  	<dt class="col-md-4 text-truncate">ID No. : </dt>
				  	<dd class="col-md-8">{{ $updatedRequest->identity_card_number }}</dd>
				</dl>
				<dl class="row">
				  	<dt class="col-md-4 text-truncate">Phone : </dt>
				  	<dd class="col-md-8">{{ $updatedRequest->phone }}</dd>
				</dl>
				<dl class="row">
				  	<dt class="col-md-4 text-truncate">E-mail : </dt>
				  	<dd class="col-md-8">{{ $updatedRequest->email }}</dd>
				</dl>
				<dl class="row">
				  	<dt class="col-md-4 text-truncate">Address : </dt>
				  	<dd class="col-md-8">{{ $updatedRequest->address }}</dd>
				</dl>
				<dl class="row">
				  	<dt class="col-md-4 text-truncate">Marital Status : </dt>
				  	<dd class="col-md-8">
				  		@if (!isset($updatedRequest->married))
				  		@elseif ($updatedRequest->married == 0)
							未婚
						@else
							已婚
				  		@endif
				  	</dd>
				</dl>
				<dl class="row">
				  	<dt class="col-md-4 text-truncate">Date of Birth : </dt>
				  	<dd class="col-md-8"><?php echo empty($updatedRequest->birthday)?"":date('M j, Y', strtotime($updatedRequest->birthday)) ?></dd>
				</dl>
				<dl class="row">
				  	<dt class="col-md-4 text-truncate">On Board : </dt>
				  	<dd class="col-md-8"><?php echo empty($updatedRequest->on_board)?"":date('M j, Y', strtotime($updatedRequest->on_board)) ?></dd>
				</dl>
				<dl class="row">
				  	<dt class="col-md-4 text-truncate">Off Board : </dt>
				  	<dd class="col-md-8"><?php echo empty($updatedRequest->off_board)?"":date('M j, Y', strtotime($updatedRequest->off_board)) ?></dd>
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
						  	<dd class="col-md-8">{{ date('M j, Y h:ia', strtotime($updatedRequest->created_at)) }}
						  	</dd>
						</dl>
						<dl class="row">
						  	<dt class="col-md-4">Updated:</dt>
						  	<dd class="col-md-8">{{ date('M j, Y h:ia', strtotime($updatedRequest->updated_at)) }}
						  	</dd>
						</dl>
						<hr>
						<div class="row">
							<div class="col-md-6">
								<form action="{{ route('admin.notification.update', $updatedRequest->id) }}" method="post">
									@csrf
									@method('put')
								<input type="submit" class="btn btn-outline-primary btn-block" value="Update" />
								</form>
							</div>
							<div class="col-md-6">
								<form action="{{ route('admin.notification.destroy', $updatedRequest->id) }}" method="post">
									@csrf
									@method('delete')
									<input type="submit" class="btn btn-outline-danger btn-block" value="Delete" />
								</form>
							</div>
						</div>
						<div class="row" style="margin-top: 15px;">
							<div class="col-md-12">
								<a href="{{ route('admin.notification.index') }}" class="btn btn-btn btn-outline-secondary btn-block"><< Show All Requests</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop




