<div class="modal position-absolute" tabindex="-1" role="dialog" id="statusModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="margin-top: 200px">
            <form action="{{route('admin.inquiry.back',[$data->id,$data->type])}}" method="post">
                @csrf
            <div class="modal-header">
                <h5 class="modal-title text-warning">🔔 Warning</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <div class="form-row">
                        <label>Change status</label>
                        @if($data->type == 'logistic')
                            <select name="step" class="form-control">
                                <option value="0">from beginning</option>
                                <option value="1">after quotation</option>
                                <option value="2">after sample</option>
                                <option value="3">after pilot</option>
                                <option value="4">after pi</option>
                                <option value="5">after po</option>
                                <option value="6">after supplier document</option>
                                <option value="7">after customer document</option>
                                <option value="8">after pcoa</option>
                                <option value="9">after original document</option>
                                <option value="10">after clearance documents</option>
                            </select>
                        @else
                            <select name="step" class="form-control">
                                <option value="0">from beginning</option>
                                <option value="1">after quotation</option>
                                <option value="2">after sample</option>
                                <option value="3">after pilot</option>
                                <option value="4">after pi</option>
                                <option value="5">after po</option>
                                <option value="6">after pcoa</option>
                                <option value="7">after draft</option>
                                <option value="8">after final</option>
                                <option value="9">after track</option>
                            </select>
                        @endif
                    </div>
                    <div class="form-row">
                        <a class="btn btn-light-danger btn-sm mt-7" href="{{route('admin.inquiry.decline',$data->id)}}">decline this inquiry</a>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No & Cancel</button>
                <input type="submit" class="btn btn-danger" value="Yes & Continue">
            </div>
            </form>
        </div>
    </div>
</div>
