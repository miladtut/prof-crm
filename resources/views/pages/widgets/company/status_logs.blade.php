{{-- List Widget 9 --}}
<style>
    .timeline.timeline-6:before{
        left: 91px;
    }
    .timeline.timeline-6 .timeline-item .timeline-label {
        width: 90px;
    }
</style>
<div class="card card-custom {{ @$class }}">
    {{-- Header --}}
    <div class="card-header align-items-center border-0 mt-4">
        <h3 class="card-title align-items-start flex-column">
            <span class="font-weight-bolder text-dark">Inquiry Activities</span>
            <span class="text-muted mt-3 font-weight-bold font-size-sm">Here You Can Track You Inquiry Changes</span>
        </h3>

    </div>

    {{-- Body --}}
    <div class="card-body pt-4">
        <div class="timeline timeline-6 mt-3">
            <!--begin::Item-->
            @foreach($data->status_logs as $log)
                <div class="timeline-item align-items-start">
                    <!--begin::Label-->
                    <div class="timeline-label text-muted">
                        {{$log->created_at}}
                    </div>
                    <!--end::Label-->
                    <!--begin::Badge-->
                    <div class="timeline-badge">
                        <i class="fa fa-genderless text-{{$log->status_class}} icon-xl"></i>
                    </div>
                    <!--end::Badge-->
                    <!--begin::Text-->
                    <div class="font-weight-mormal font-size-lg timeline-content pl-3">
                        <div>
                            <b>{{$log->status}}</b>
                            @if($log->rejection_reason)
                                <a class="ml-17 text-danger reason" data-txt="{{$log->rejection_reason}}"  href="javascript:;">
                                    <small>view modification reason</small>
                                </a>
                            @endif
                        </div>

                        <div class="font-weight-mormal font-size-lg timeline-content text-muted pl-3">
                            <small>by {{$log->creator_type}}</small>
                        </div>

                    </div>
                    <!--end::Text-->
                </div>
            @endforeach
            <!--end::Item-->
        </div>
    </div>
</div>
