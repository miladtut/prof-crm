@extends('layout.default')
@section('content')

    <div class="card card-custom card-stretch">
            <!--begin::Header-->
            <div class="card-header py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">Company Profile</h3>
                </div>
                <div class="card-toolbar">
                    <a href="{{route('admin.companies.edit',$company->id)}}" class="btn btn-success mr-2">Edit</a>
                    <button class="btn btn-secondary" onclick="window.history.back()">Cancel</button>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <form class="form">
                <!--begin::Body-->
                <div class="card-body">
                    <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                            <h5 class="font-weight-bold mb-6">Customer Info</h5>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Logo</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="image-input image-input-outline" id="kt_profile_avatar22" style="background-image: url({{asset('media/users/blank.png')}})">
                                <div class="image-input-wrapper" style="background-image: url({{asset('uploads/'.@$company->logo_img)}})"></div>

                            </div>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Company Name</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" disabled type="text" value="{{@$company->company_name}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Contact Person Name</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" disabled value="{{@$company->contact_person_name}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Type</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" disabled value="{{@$company->account_type}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Register Type</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" disabled value="{{@$company->register_type}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Number Of Inquiries</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" disabled value="{{@$company->inquiries()->count()}}">
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                            <h5 class="font-weight-bold mt-10 mb-6">Contact Info</h5>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Contact Phone</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <div class="input-group-prepend">
																	<span class="input-group-text">
																		<i class="la la-phone"></i>
																	</span>
                                </div>
                                <input type="text" class="form-control form-control-lg form-control-solid" disabled value="{{@$company->phone_key}}{{@$company->phone}}" placeholder="Phone">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <div class="input-group-prepend">
																	<span class="input-group-text">
																		<i class="la la-at"></i>
																	</span>
                                </div>
                                <input type="text" class="form-control form-control-lg form-control-solid" disabled value="{{@$company->email}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Active</label>
                        <div class="col-lg-9 col-xl-6">

                            <span class="switch">
                                <label>
                                    <input type="checkbox" {{$company->blocked == 0?'checked':''}} name="select" data-href="{{route('admin.company.block',$company->id)}}" id="switch">
                                    <span></span>
                                </label>
                            </span>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Country</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <input type="text" class="form-control form-control-lg form-control-solid" disabled  value="{{@$company->country_name}}">
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Body-->
            </form>
            <!--end::Form-->
        </div>


@endsection
