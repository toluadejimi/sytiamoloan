@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<span class="panel-title">{{ _lang('Update Disbursment Request') }}</span>
			</div>
			<div class="card-body">
				@if($ma->status == 1)
					<div class="alert alert-warning">
						<strong>{{ _lang('Request has already approved.') }}</strong>
					</div>
				@endif
				<form method="post" class="validate" autocomplete="off" action="{{ action('LoanController@update', $id) }}" enctype="multipart/form-data">
					{{ csrf_field()}}
					<input name="_method" type="hidden" value="PATCH">
						<h6 class="control-label">{{ _lang('Request ID') }} <strong>{{ $ma->disbusment_id }}</strong></h6>
					<div class="row">

						<div class="col-md-6">
            			<div class="form-group">
            				<label class="control-label">{{ _lang('Location') }}</label>
            				<h6>
            				@foreach($locations as $location)
                            		{{ $location->name }},
                            @endforeach
                            </h6>
            			</div>
            		</div>
						
					<div class="col-md-6">
					    <div class="form-group">
								<label class="control-label">{{ _lang('Enter Amount') }}</label>
								<input type="text" class="form-control" name="amount"  value="{{$ma->amount }}" required >
							</div>
					</div>
						<div class="col-md-12">
							<div class="form-group">
								<button type="submit" class="btn btn-primary">{{ _lang('Update Changes') }}</button>
							</div>
							<div class="form-group">
							    
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection



