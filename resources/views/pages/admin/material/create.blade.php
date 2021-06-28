@extends('layout.default')
@section('content')
    <div class="card">
        <div class="card-header">
            Create New Material
        </div>
        <div class="card-body">

            <form class="form" action="{{route('admin.materials.create')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <h3 class="font-size-lg text-dark font-weight-bold mb-6">1. Basic Info:</h3>
                    <div class="mb-15 ml-17">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Material Name:</label>


                            <div class="col-lg-3 ">
                                <input name="name" value="{{old('name')}}" required type="text" class="form-control" placeholder="Please Enter country name"/>
                                <span class="form-text text-muted">Please Enter country name</span>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Suppliers:</label>
                            <div class="col-lg-6">
                                <div class="checkbox-inline">
                                    @foreach(\App\Models\Supplier::all() as $supplier)
                                        <label class="checkbox ml-5 w-70px">
                                            <input name="suppliers[]" type="checkbox" value="{{$supplier->id}}"/>
                                            <span></span>
                                            {{$supplier->supplier_name}}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-success mr-2">Submit</button>
                            <a class="btn btn-secondary" onclick="window.history.back()">Cancel</a>
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
