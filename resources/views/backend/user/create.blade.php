@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">{{ _lang('Create User') }}</h4>
            </div>
            <div class="card-body">
                <form method="post" class="validate" autocomplete="off" action="{{ route('users.store') }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('First Name') }}</label>
                                <div class="col-xl-9">
                                    <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Middle Name') }}</label>
                                <div class="col-xl-9">
                                    <input type="text" class="form-control" name="middle_name" value="{{ old('middle_name') }}"
                                        >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Last Name') }}</label>
                                <div class="col-xl-9">
                                    <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Email') }}</label>
                                <div class="col-xl-9">
                                    <input type="text" class="form-control" name="email" >
                                </div>
                            </div>
                                    
                            
                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Home Address') }}</label>
                                <div class="col-xl-9">
                                    <textarea type="text" class="form-control" name="address" value="{{ old('address') }}"
                                        required></textarea>
                                </div>
                            </div>
                            
                             <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Nearest Bus Stop') }}</label>
                                <div class="col-xl-9">
                                    <textarea type="text" class="form-control" name="hbus_stop" value="{{ old('hbus_stop') }}"
                                        required></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Shop Address') }}</label>
                                <div class="col-xl-9">
                                    <textarea type="text" class="form-control" name="shop_address" value="{{ old('shop_address') }}"
                                        required></textarea>
                                </div>
                            </div>
                            
                                <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Nearest Bus Stop') }}</label>
                                <div class="col-xl-9">
                                    <textarea type="text" class="form-control" name="sbus_stop" value="{{ old('sbus_stop') }}"
                                        required></textarea>
                                </div>
                            </div>

                            {{-- <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Password') }}</label>
                                <div class="col-xl-9">
                                    <input type="password" class="form-control" name="password" value="" required>
                                </div>
                            </div> --}}

                            

                            {{-- <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Country Code') }}</label>
                                <div class="col-xl-9">
                                    <select class="form-control select2 auto-select" data-selected="{{ old('country_code') }}" name="country_code" required>
                                        <option value="">{{ _lang('Select One') }}</option>
                                        @foreach(get_country_codes() as $key => $value)
                                        <option value="{{ $value['dial_code'] }}">{{ $value['country'].' (+'.$value['dial_code'].')' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}


                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Phone') }}</label>
                                <div class="col-xl-9">
                                    <input type="text" class="form-control" name="phone" value="+234{{ old('phone') }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Branch') }}</label>
                                <div class="col-xl-9">
                                    <select class="form-control select2 auto-select"  multiple="" data-selected="{{ old('branch_id') }}"
                                        name="branch_id" required>
                                       
					                    {{ create_option('branches','id','name') }}
                                    </select>
                                </div>
                            </div>
                            
                            
                            
         <!--                   <div class="form-group row">-->
         <!--                       <label class="col-xl-3 col-form-label">{{ _lang('Location') }}</label>-->
         <!--                       <div class="col-xl-9">-->
         <!--                           <select  data-selected="{{ old('branch_id') }}" name="branch_id[]" multiple="" required>-->
					    <!--            @foreach(get_table('branches') as $loaction )-->
									<!--<option value="{{ $loaction->id }}">{{ $loaction->name  }}</option>-->
									<!--@endforeach-->
         <!--                           </select>-->
         <!--                       </div>-->
         <!--                   </div>-->
                            
                            
                            
                            
                            
                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('DOB') }}</label>
                                <div class="col-xl-9">
                                    <input type="date" class="form-control" name="dob" value="{{ old('dob') }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Gender') }}</label>
                                <div class="col-xl-9">
                                    <select class="form-control auto-select" data-selected="{{ old('gender') }}"
                                        name="gender" >
                                        <option value="male">{{ _lang('Male') }}</option>
                                        <option value="female">{{ _lang('Female') }}</option>
                                    </select>
                                </div>
                            </div>

                            <!--<div class="form-group row">-->
                            <!--    <label class="col-xl-3 col-form-label">{{ _lang('Email Verified') }}</label>-->
                            <!--    <div class="col-xl-9">-->
                            <!--        <select class="form-control select2 auto-select" name="email_verified_at">-->
                            <!--            <option value="">{{ _lang('No') }}</option>-->
                            <!--            <option value="{{ now() }}">{{ _lang('Yes') }}</option>-->
                            <!--        </select>-->
                            <!--    </div>-->
                            <!--</div>-->

                            <!--<div class="form-group row">-->
                            <!--    <label class="col-xl-3 col-form-label">{{ _lang('SMS Verified') }}</label>-->
                            <!--    <div class="col-xl-9">-->
                            <!--        <select class="form-control select2 auto-select" name="sms_verified_at">-->
                            <!--            <option value="">{{ _lang('No') }}</option>-->
                            <!--            <option value="{{ now() }}">{{ _lang('Yes') }}</option>-->
                            <!--        </select>-->
                            <!--    </div>-->
                            <!--</div>-->

                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('BVN') }}</label>
                                <div class="col-xl-5">
                                    <input type="text" class="form-control" name="bvn" value="{{ old('bvn') }}" > 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('NIN') }}</label>
                                <div class="col-xl-5">
                                    <input type="text" class="form-control" name="nin" value="{{ old('nin') }}" > 
                                </div>
                               
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Profile Picture') }}</label>
                                <div class="col-xl-9">
                                    <input type="file" class="form-control dropify" name="profile_picture">
                                </div>
                            </div>
                            
                            
                              <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Status') }}</label>
                                <div class="col-xl-9">
                                    <select class="form-control auto-select" data-selected="{{ old('status') }}"
                                        name="status" required>
                                        <option value="">{{ _lang('Select One') }}</option>
                                        <option value="1">{{ _lang('Active') }}</option>
                                        <option value="0">{{ _lang('In Active') }}</option>
                                    </select>
                                </div>
                            </div>
                            
                            
                            <div class="card-header">
                                <h4 class="header-title">{{ _lang('Guarantor 1 infomation') }}</h4>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Full Name') }}</label>
                                <div class="col-xl-9">
                                    <input type="text" class="form-control" name="gname" value="{{ old('gname') }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Phone Number') }}</label>
                                <div class="col-xl-9">
                                    <input type="text" class="form-control" name="gphone" value="+234{{ old('gphone') }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Home Address') }}</label>
                                <div class="col-xl-9">
                                    <textarea type="text" class="form-control" name="gaddress" value="{{ old('gaddress') }}"
                                        required></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Nearest Bus Stop') }}</label>
                                <div class="col-xl-9">
                                    <textarea type="text" class="form-control" name="gbus_stop" value="{{ old('gbus_stop') }}"
                                        required></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Garrantor ID') }}</label>
                                <div class="col-xl-9">
                                    <input type="file" class="form-control dropify" name="gpicture">
                                </div>
                            </div>

                            <!--<div class="card-header">-->
                            <!--    <h4 class="header-title">{{ _lang('Guarantor 2 infomation') }}</h4>-->
                            <!--</div>-->
                            <!--<div class="form-group row">-->
                            <!--    <label class="col-xl-3 col-form-label">{{ _lang('Full Name') }}</label>-->
                            <!--    <div class="col-xl-9">-->
                            <!--        <input type="text" class="form-control" name="gname2" value="{{ old('gname2') }}" required>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--<div class="form-group row">-->
                            <!--    <label class="col-xl-3 col-form-label">{{ _lang('Phone Number') }}</label>-->
                            <!--    <div class="col-xl-9">-->
                            <!--        <input type="text" class="form-control" name="gphone2" value="+234{{ old('gphone2') }}" required>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--<div class="form-group row">-->
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
                                <div class="col-xl-9 offset-xl-3">
                                    <button type="submit" class="btn btn-primary">{{ _lang('Submit Form') }}</button>
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