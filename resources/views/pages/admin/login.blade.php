@extends('layout.login.master')
@section('login_content')
    <div class="login-content d-flex flex-column pt-lg-0 pt-12">
        <!--begin::Logo-->
        <a href="#" class="login-logo pb-xl-20 pb-15">
            <img src="{{asset('media/logos/logo-4.png')}}" class="max-h-90px" alt="" />
        </a>
        <!--end::Logo-->
        <!--begin::Signin-->
            <div class="login-form">
        <!--begin::Form-->
        <form class="form" id="kt_login_singin_form" action="{{route('admin.login')}}" method="post">
            @csrf
            <!--begin::Title-->
            <div class="pb-5 pb-lg-15">
                <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Sign In</h3>

            </div>
            <!--begin::Title-->
            <!--begin::Form group-->
            <div class="form-group">
                <label class="font-size-h6 font-weight-bolder text-dark">Email</label>
                <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0" type="text" name="email" autocomplete="off" />
            </div>
            <!--end::Form group-->
            <!--begin::Form group-->
            <div class="form-group">
                <div class="d-flex justify-content-between mt-n5">
                    <label class="font-size-h6 font-weight-bolder text-dark pt-5">Password</label>
                </div>
                <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0" type="password" name="password" autocomplete="off" />
            </div>
            <!--end::Form group-->
            <!--begin::Action-->
            <div class="pb-lg-0 pb-5">
                <input type="submit"  class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3" value="Sign In"/>

            </div>
            <!--end::Action-->
        </form>
        <!--end::Form-->
    </div>
        <!--end::Signin-->
    </div>
@endsection
