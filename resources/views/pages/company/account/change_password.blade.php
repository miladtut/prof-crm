@extends('layout.default')
@section('content')
    @php($data = auth()->user())
    <div class="card">
        <div class="card-header">
            Edit Account
        </div>
        <div class="card-body">

            <form class="form" action="{{route('company-change-password')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <h3 class="font-size-lg text-dark font-weight-bold mb-6">2. Account Info:</h3>
                    <div class="mb-3 ml-17">

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Current Password:</label>
                            <div class="col-lg-4">
                                <input name="old_password" type="password" class="form-control"  placeholder="Enter required Current Password"/>
                                <span class="form-text text-muted">Please Enter required Current Password</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">New Password:</label>
                            <div class="col-lg-4">
                                <input name="new_password" type="password" class="form-control"  placeholder="Enter required New Password"/>
                                <span class="form-text text-muted">Please Enter required New Password</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Confirm New Password:</label>
                            <div class="col-lg-4">
                                <input name="confirm_new_password" type="password" class="form-control"  placeholder="Enter required confirm new password"/>
                                <span class="form-text text-muted">Please Enter required confirm new password</span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-success mr-2">Submit</button>
                            <button class="btn btn-secondary" onclick="window.history.back()">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

