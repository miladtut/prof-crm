<style>
    .my-t:before {
        content: "";
        position: absolute;
        left: 12.5%;
        width: 3px;
        top: 0;
        bottom: 0;
        background-color: #EEF0F8;
        z-index: 1;
    }
    .my-t-title{
        border: white;
        padding: 0!important;
    }
    .my-t-title{
        z-index: 2;
    }
    .my-badge-success{
        background-color: #3ac893;
        border-radius: 50%;
        padding: 10px;
        font-size: 15px;
        color: white;
        z-index: 2;

    }
    .my-badge-danger{
        background-color: #be2626;
        border-radius: 50%;
        padding: 10px;
        font-size: 15px;
        color: white;
    }
    .my-badge-secondary{
        background-color: grey;
        border-radius: 50%;
        padding: 10px;
        font-size: 15px;
        color: white;
    }
    .mt-t-text{
        padding-top: 10px;
        font-size: 15px;
        z-index: 2;
    }
    .tex-success{
        color: #3ac893;
    }
    .tex-secondary{
        color: grey;
    }
    .tex-danger{
        color: #be2626;
    }
</style>


<div class="card my-t-title">
    <div class="card-body text-center" style="padding-left: 0!important;padding-right: 0!important;">
        <div>
            @if(isset($status_class))
                @if($status_class == 'danger')
                    <i class="fa fa-times my-badge-{{@$status_class}}"></i>
                @elseif($status_class == 'secondary')
                    <i class="fa fa-check my-badge-{{@$status_class}}"></i>
                @else
                    <i class="fa fa-check my-badge-{{@$status_class}}"></i>
                @endif
            @endif
        </div>
        <div>
            <span class="mt-t-text tex-{{@$txt_class}}">
                {{@$text}}
            </span>
        </div>
    </div>
</div>
