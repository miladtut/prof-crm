@extends('layout.default')
@section('content')
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">


        <div class="d-flex flex-column-fluid">

            <div class="container-fluid">

                <div class="card card-custom">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">About {{config('app.name')}}
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                       <form action="{{route('admin.about-profect.edit')}}" method="post">
                           @csrf
                           <div class="form-group">
                               <textarea name="about_us" id="kt-ckeditor-1">
                                    @if($data = \App\Models\Profect::first())
                                       {!! $data->about_us !!}
                                    @else
                                        {!! old('about_us') !!}
                                    @endif
                                </textarea>
                               <input type="submit" class="btn btn-light-success mt-7" value="Save">
                           </div>
                       </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script src="{{asset('plugins/custom/ckeditor/ckeditor-classic.bundle.js')}}"></script>
    <script src="{{asset('js/pages/crud/forms/editors/ckeditor-classic.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            KTCkeditor.init();
        });

    </script>
@endsection
