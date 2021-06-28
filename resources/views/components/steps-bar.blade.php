<?php
$message = 'inquiry done';$length = 200;
$type = 'rejected';
?>

<?php
if($type == 'done'){
    $bg = 'bg-success';
    $mark = 'fa-check';
    $txt = 'text-success';
}elseif($type == 'rejected'){
    $bg = 'bg-danger';
    $mark = 'fa-check';
    $txt = 'text-danger';
}else{
    $bg = 'bg-secondary';
    $mark = 'fa-check';
    $txt = 'text-black-50';
}
?>

<div class="card col-2 bg-transparent" style="padding: 0 30px">

    <div class="card-body p-0 bg-white" style="border-radius: 10px">
        <!--begin::Timeline-->
        <div class="container p-0">
            @include('components.step')
        </div>
        <!--end::Timeline-->

    </div>
</div>
