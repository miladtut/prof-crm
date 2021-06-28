<div class="modal position-absolute" tabindex="-1" role="dialog" id="rejectModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="margin-top: 200px">
            <form action="" method="post" id="rejectForm">
                @csrf
            <div class="modal-header">
                <h5 class="modal-title text-warning">🔔 Warning</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <h4>please enter the modification needed</h4>
                <div class="form-group">
                    <textarea name="reason" class="form-control" placeholder="modification reason"></textarea>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                <input class="btn btn-danger" type="submit" value="Continue">


            </div>
            </form>
        </div>
    </div>
</div>








<div class="modal position-absolute" tabindex="-1" role="dialog" id="rejectSampleModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="margin-top: 200px">
            <form action="" method="post" id="rejectSampleForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title text-warning">🔔 Warning</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>please enter the rejection reason</h4>
                    <div class="form-group">
                        <textarea name="reason" class="form-control" placeholder="rejection reason"></textarea>
                    </div>
                    <h4>please upload the rejection report</h4>
                    <div class="form-group">
                        <input type="file" name="doc" class="form-control" required placeholder="rejection report">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                    <input class="btn btn-danger" type="submit" value="Continue">


                </div>
            </form>
        </div>
    </div>
</div>
