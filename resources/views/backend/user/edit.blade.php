@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">{{ _lang('Update User') }}</h4>
            </div>
            <div class="card-body">
                <form method="post" class="validate" autocomplete="off"
                    action="{{ action('UserController@update', $id) }}" enctype="multipart/form-data">
                    {{ csrf_field()}}
                    <input name="_method" type="hidden" value="PATCH">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('First Name') }}</label>
                                <div class="col-xl-9">
                                    <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Middle Name') }}</label>
                                <div class="col-xl-9">
                                    <input type="text" class="form-control" name="middle_name" value="{{ $user->middle }}"
                                        >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Last Name') }}</label>
                                <div class="col-xl-9">
                                    <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}"
                                        required>
                                </div>
                            </div>


                            {{-- <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Email') }}</label>
                                <div class="col-xl-9">
                                    <input type="text" class="form-control" name="email" value="{{ $user->email }}"
                                        >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Password') }}</label>
                                <div class="col-xl-9">
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div> --}}

                            <!--<div class="form-group row">-->
                            <!--    <label class="col-xl-3 col-form-label">{{ _lang('Country Code') }}</label>-->
                            <!--    <div class="col-xl-9">-->
                            <!--        <select class="form-control select2 auto-select" data-selected="{{ $user->country_code }}" name="country_code" required>-->
                            <!--            <option value="">{{ _lang('Select One') }}</option>-->
                            <!--            @foreach(get_country_codes() as $key => $value)-->
                            <!--            <option value="{{ $value['dial_code'] }}">{{ $value['country'].' (+'.$value['dial_code'].')' }}</option>-->
                            <!--            @endforeach-->
                            <!--        </select>-->
                            <!--    </div>-->
                            <!--</div>-->


                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Phone') }}</label>
                                <div class="col-xl-9">
                                    <input type="text" class="form-control" name="phone" value="{{ $user->phone }}" required>
                                </div>
                            </div>
                            
                             <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Home Address') }}</label>
                                <div class="col-xl-9">
                                    <input type="text" class="form-control" name="address" value="{{ $user->address }}"
                                        required></div>
                            </div>
                            
                             <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Nearest Bus Stop') }}</label>
                                <div class="col-xl-9">
                                    <input type="text" class="form-control" name="hbus_stop" value="{{ $user->hbus_stop }}"
                                        required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Branch') }}</label>
                                <div class="col-xl-9">
                                    <select class="form-control auto-select" data-selected="{{ $user->branch_id }}"
                                        name="branch_id" required>
                                        <option value="">{{ _lang('Select One') }}</option>
					                    {{ create_option('branches','id','name') }}
                                    </select>
                                </div>
                            </div>
                            
                             <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('BVN') }}</label>
                                <div class="col-xl-5">
                                    <input type="text" class="form-control" name="bvn" value="{{ $user->bvn }}" > 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('NIN') }}</label>
                                <div class="col-xl-5">
                                    <input type="text" class="form-control" name="nin" value="{{ $user->nin }}" > 
                                </div>
                               
                            </div>


                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Status') }}</label>
                                <div class="col-xl-9">
                                    <select class="form-control auto-select" data-selected="{{ $user->status }}"
                                        name="status" required>
                                        <option value="">{{ _lang('Select One') }}</option>
                                        <option value="1">{{ _lang('Active') }}</option>
                                        <option value="0">{{ _lang('In Active') }}</option>
                                    </select>
                                </div>
                            </div>
                            
                            
                             <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Profile Picture') }}</label>
                                <div class="col-xl-9">
                                    <input type="file" class="form-control dropify" name="profile_picture" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" data-default-file="{{ url('public/uploads/media/'.$user->profile_picture)}}">
                                </div>
                            </div>

                            <!--<div class="form-group row">-->
                            <!--    <label class="col-xl-3 col-form-label">{{ _lang('SMS Verified') }}</label>-->
                            <!--    <div class="col-xl-9">-->
                            <!--        <select class="form-control select2 auto-select" data-selected="{{ $user->sms_verified_at }}" name="sms_verified_at">-->
                            <!--            <option value="">{{ _lang('No') }}</option>-->
                            <!--            <option value="{{ $user->sms_verified_at != null ? $user->sms_verified_at : now() }}">{{ _lang('Yes') }}</option>-->
                            <!--        </select>-->
                            <!--    </div>-->
                            <!--</div>-->
                            
                            
                              <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Guarantor1') }}</label>
                                <div class="col-xl-9">
                                    <class="form-control select2 auto-select" data-selected="{{ $user->gname }}" name="gname">
                                       <input type="text" class="form-control" name="gname" value="{{ $user->gname }}" required>
                                </div>
                            </div>
                              <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Guarantor1p') }}</label>
                                <div class="col-xl-9">
                                    <class="form-control select2 auto-select" data-selected="{{ $user->gphone }}" name="gphone">
                                       <input type="text" class="form-control" name="gphone" value="{{ $user->gphone }}" required>
                                </div>
                            </div>
                            
                             <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Home Address') }}</label>
                                <div class="col-xl-9">
                                    <class="form-control select2 auto-select" data-selected="{{ $user->gaddress }}" name="gaddress">
                                       <input type="text" class="form-control" name="gaddress" value="{{ $user->gaddress }}" required>
                                </div>
                            </div>
                            
                              <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Nearest Bus Stop') }}</label>
                                <div class="col-xl-9">
                                    <input type="text" class="form-control" name="gbus_stop" value="{{ $user->gbus_stop }}"
                                        required>
                                </div>
                            </div>
                            
                            <!--<div class="form-group row">-->
                            <!--    <label class="col-xl-3 col-form-label">{{ _lang('Guarantor2') }}</label>-->
                            <!--    <div class="col-xl-9">-->
                            <!--        <class="form-control select2 auto-select" data-selected="{{ $user->gname2 }}" name="gname2">-->
                            <!--           <input type="text" class="form-control" name="gname2" value="{{ $user->gname2 }}" required>-->
                            <!--    </div>-->
                            <!--</div>-->
                            
                            <!--<div class="form-group row">-->
                            <!--    <label class="col-xl-3 col-form-label">{{ _lang('Guarantor2p') }}</label>-->
                            <!--    <div class="col-xl-9">-->
                            <!--        <class="form-control select2 auto-select" data-selected="{{ $user->gphone2 }}" name="gphone2">-->
                            <!--           <input type="text" class="form-control" name="gphone2" value="+234{{ $user->gphone2 }}" required>-->
                            <!--    </div>-->
                            <!--</div>-->
                            
                            <!--  <div class="form-group row">-->
                            <!--    <label class="col-xl-3 col-form-label">{{ _lang('Home Address') }}</label>-->
                            <!--    <div class="col-xl-9">-->
                            <!--        <textarea type="text" class="form-control" name="gaddress2" value="{{ old('gaddress2') }}"-->
                            <!--            required></textarea>-->
                            <!--    </div>-->
                            <!--</div>-->
                            
                            <!--  <div class="form-group row">-->
                            <!--    <label class="col-xl-3 col-form-label">{{ _lang('Nearest Bus Stop') }}</label>-->
                            <!--    <div class="col-xl-9">-->
                            <!--        <textarea type="text" class="form-control" name="g2bus_stop" value="{{ old('g2bus_stop') }}"-->
                            <!--            required></textarea>-->
                            <!--    </div>-->
                            <!--</div>-->
                            
                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Guarantor Picture') }}</label>
                                <div class="col-xl-9">
                                    <input type="file" class="form-control dropify" name="gpicture" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" data-default-file="{{ url('public/uploads/media/'.$user->gpicture)}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-xl-9 offset-xl-3">
                                    <button type="submit" class="btn btn-primary"><i class="icofont-check-circled"></i> {{ _lang('Update User') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection