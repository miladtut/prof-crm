@php
    switch ($data->acount_type){
        case 'regular':
            $class = 'label-light-info';
        break;
        case 'logistic':
            $class = 'label-light-success';
            break;
        default:
            $class = 'label-light-info';
}
@endphp
<span style="width: 137px;">
    <span class="label label-lg font-weight-bold {{$class}} label-inline">
        {{$data->account_type}}
    </span>
</span>
