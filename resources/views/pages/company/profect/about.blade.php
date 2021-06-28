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
                        @if($data = \App\Models\Profect::first())
                            {!! $data->about_us !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
