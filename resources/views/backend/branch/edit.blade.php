@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4 class="header-title">{{ _lang('Update Branch') }}</h4>
			</div>
			<div class="card-body">
				<form method="post" class="validate" autocomplete="off" action="{{ action('BranchController@update', $id) }}" enctype="multipart/form-data">
					{{ csrf_field()}}
					<input name="_method" type="hidden" value="PATCH">
					<div class="row">
						<div class="col-md-12">
							    <div class="form-group">
								   <label class="control-label">{{ _lang('Market Name') }}</label>
								   <input type="text" class="form-control" name="name" value="{{ $branch->name }}">
							    </div>
							</div>

							<!--<div class="col-md-12">-->
							<!--    <div class="form-group">-->
							<!--	   <label class="control-label">{{ _lang('Contact Email') }}</label>-->
							<!--	   <input type="text" class="form-control" name="contact_email" value="{{ $branch->contact_email }}">-->
							<!--    </div>-->
							<!--</div>-->

							<!--<div class="col-md-12">-->
							<!--    <div class="form-group">-->
							<!--	   <label class="control-label">{{ _lang('Contact Phone') }}</label>-->
							<!--	   <input type="text" class="form-control" name="contact_phone" value="{{ $branch->contact_phone }}">-->
							<!--    </div>-->
							<!--</div>-->

							<div class="col-md-12">
							    <div class="form-group">
								   <label class="control-label">{{ _lang('Market Area') }}</label>
								   <input class="form-control" name="address" value="{{ $branch->address }}">
							    </div>
							</div>

							<div class="col-md-12">
							    <div class="form-group">
								   <label class="control-label">{{ _lang('Market State') }}</label>
								   <input class="form-control" name="descriptions" value="{{ $branch->descriptions }}">
							    </div>
							</div>


						<div class="col-md-12">
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-lg"><i class="icofont-check-circled"></i> {{ _lang('Update') }}</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection


