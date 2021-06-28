
@if(isset($data->status_name))
    @if(preg_match('#waiting#',strtolower($data->status_name)))
        @php $class = 'label-light-warning' @endphp
    @elseif(preg_match('#rejected#',strtolower($data->status_name)))
        @php $class = 'label-light-danger' @endphp
    @else
        @php $class = 'label-light-success' @endphp
    @endif


    <span style="width: 137px;">
        <span class="label label-lg font-weight-bold {{$class}} label-inline">
            {{$data->status_name}}
        </span>
    </span>

@endif

