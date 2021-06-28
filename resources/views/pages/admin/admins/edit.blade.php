@extends('layout.default')
@section('content')
    <div class="card">
        <div class="card-header">
            Create New admin
        </div>
        <div class="card-body">

            <form class="form" action="{{route('admin.admins.edit',$data->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <input name="id" value="{{$data->id}}" type="hidden">
                <div class="card-body">
                    <h3 class="font-size-lg text-dark font-weight-bold mb-6">1. basic Info:</h3>
                    <div class="mb-15 ml-17">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">admin Name:</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="admin_name" value="{{$data->admin_name}}">
                                <span class="form-text text-muted">Please enter admin name</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">rule:</label>
                            <div class="col-lg-6">
                                <select class="form-control select2" name="role">
                                    <option value="super_admin" {{$data->role == 'super_admin'?'selected':''}}>super admin</option>
                                    <option value="admin" {{$data->role == 'admin'?'selected':''}}>admin</option>
                                    <option value="manager" {{$data->role == 'manager'?'selected':''}}>manager</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <h3 class="font-size-lg text-dark font-weight-bold mb-6">2. Account Info:</h3>
                    <div class="mb-3 ml-17">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Email:</label>
                            <div class="col-lg-4">
                                <input name="email" type="email" class="form-control" value="{{$data->email}}" placeholder="Enter required email"/>
                                <span class="form-text text-muted">Please Enter required email</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Password:</label>
                            <div class="col-lg-4">
                                <input name="password" type="text" class="form-control" placeholder="Enter required password"/>
                                <span class="form-text text-muted">Please Enter required password</span>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-success mr-2">Submit</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection
