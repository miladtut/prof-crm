<div class="modal position-absolute" tabindex="-1" role="dialog" id="logModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="margin-top: 200px">
            <div class="modal-header">
                <h5 class="modal-title">Choose Inquiry Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body text-center">
                <a href="{{route('company-inquiry-create')}}" class="btn btn-secondary">New Inquiry</a>
                <a href="{{route('company.from-po')}}" class="btn btn-success">Place PO</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
