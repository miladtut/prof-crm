<div class="modal position-absolute" tabindex="-1" role="dialog" id="paymentModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="margin-top: 200px">
            <div class="modal-header">
                <h5 class="modal-title text-warning">🔔 Warning</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <h3>are you sure you want make this inquiry #{{mb_substr($data->company_name, 0, 3, "UTF-8").'-'.($data->id**2)}} as paid?</h3>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No & Cancel</button>
                <form action="{{route('admin.inquiry.close',$data->id)}}" method="get">
                    <input class="btn btn-danger" type="submit" value="Yes & Continue">
                </form>

            </div>
        </div>
    </div>
</div>
