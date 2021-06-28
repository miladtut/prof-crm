@extends('layout.login.master')
@section('login_content')
    <div class="login-content login-content-signup d-flex flex-column">

        <!--begin::Aside Top-->
        <div class="d-flex flex-column-auto flex-column px-10">
            <!--begin::Aside header-->
            <a href="#" class="login-logo pb-lg-4 pb-10">
                <img src="{{asset('media/logos/logo-4.png')}}" class="max-h-70px" alt="" />
            </a>
            <!--end::Aside header-->
        </div>
        <!--end::Aside Top-->
        <!--begin::Signin-->
        <div class="login-form">
        @include('flash::message')
            <!--begin::Form-->
            <form class="form px-10" novalidate="novalidate" action="{{route('register')}}" method="post">
                @csrf
                <!--begin: Wizard Step 1-->
                <div class="" data-wizard-type="step-content" data-wizard-state="current">
                    <!--begin::Title-->
                    <div class="pb-10 pb-lg-12">
                        <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Create Account</h3>
                        <div class="text-muted font-weight-bold font-size-h4">Already have an Account ?
                            <a href="{{route('login')}}" class="text-primary font-weight-bolder">Sign In</a></div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label class="font-size-h6 font-weight-bolder text-dark">Company Name</label>
                            <input type="text" class="form-control form-control-solid h-auto py-7 px-6 border-0 rounded-lg font-size-h6 {{$errors->has('company_name')?'is-invalid':''}}"
                                   name="company_name" value="{{old('company_name')}}" placeholder="Company Name"/>
                            @if($errors->has('company_name'))<span class="text-danger" role="alert">{{$errors->first('company_name')}}</span>@endif

                        </div>
                        <div class="col-lg-6">
                            <label class="font-size-h6 font-weight-bolder text-dark">Contact Person Name</label>
                            <input type="text" class="form-control form-control-solid h-auto py-7 px-6 border-0 rounded-lg font-size-h6 {{$errors->has('contact_person_name')?'is-invalid':''}}"
                                   name="contact_person_name" value="{{old('contact_person_name')}}" placeholder="Contact Person Name"/>
                            @if($errors->has('contact_person_name'))<span class="text-danger" role="alert">{{$errors->first('contact_person_name')}}</span>@endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label class="font-size-h6 font-weight-bolder text-dark">phone</label>
                            <div class="row">
                                <div class="col-4">

                                    <select name="phone_key" class="form-control form-control-solid h-auto py-7 px-5 border-0 rounded-lg font-size-h6">
                                        @include('layout.partials.extras.selectable.phone_keys')
                                    </select>
                                </div>
                                <div class="col-8">

                                    <input type="text" class="form-control form-control-solid h-auto py-7 px-6 border-0 rounded-lg font-size-h6 {{$errors->has('phone')?'is-invalid':''}}"
                                           name="phone" value="{{old('phone')}}" placeholder="phone"/>
                                    @if($errors->has('phone'))<span class="text-danger" role="alert">{{$errors->first('phone')}}</span>@endif

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="font-size-h6 font-weight-bolder text-dark">Country</label>
                            <select name="country" class="form-control form-control-solid h-auto py-7 px-5 border-0 rounded-lg font-size-h6">
                                @include('layout.partials.extras.selectable._countries')
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-size-h6 font-weight-bolder text-dark">Company Type</label>
                        <div class="radio-inline">
                            <label class="radio radio-lg font-size-h6 font-weight-bolder text-dark">
                                <input type="radio" checked="checked" name="account_type" value="regular">
                                <span></span>Regular
                            </label>
                            <label class="radio radio-lg font-size-h6 font-weight-bolder text-dark">
                                <input type="radio" name="account_type" value="logistic">
                                <span></span>Logistic
                            </label>
                        </div>
                        <span class="form-text text-muted">Please choose Company Type</span>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label class="font-size-h6 font-weight-bolder text-dark">Email</label>
                            <input type="email" class="form-control form-control-solid h-auto py-7 px-6 border-0 rounded-lg font-size-h6 {{$errors->has('email')?'is-invalid':''}}"
                                   name="email" value="{{old('email')}}" placeholder="First Name" />
                            @if($errors->has('email'))<span class="text-danger" role="alert">{{$errors->first('email')}}</span>@endif
                        </div>
                        <div class="col-lg-6">
                            <label class="font-size-h6 font-weight-bolder text-dark">Password</label>
                            <input type="password" class="form-control form-control-solid h-auto py-7 px-6 border-0 rounded-lg font-size-h6 {{$errors->has('password')?'is-invalid':''}}"
                                   name="password" placeholder="First Name" value="" />
                            @if($errors->has('password'))<span class="text-danger" role="alert">{{$errors->first('password')}}</span>@endif
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-success form-control" value="register">
                </div>

            </form>
            <!--end::Form-->
        </div>
        <!--end::Signin-->
    </div>
@endsection
