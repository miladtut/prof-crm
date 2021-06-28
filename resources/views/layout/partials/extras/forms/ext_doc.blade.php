<label class="checkbox" id="other_container">
    <input id="other" type="checkbox"/>
    <span></span>
    Other
</label>
<div class="con">
{{--    <input type="hidden" id="ext" name="document[]">--}}
</div>
<div class="form-group mt-5" id="ext_doc" style="display: none">
    <input name="et_docx" id="ext_doc_name" style="display: inline-flex" placeholder="inter document name" class="form-control w-200px" value="">
    <a class="btn btn-sm btn-success" id="med" href="javascript:;" data-href="{{route('company.document.create')}}">save</a>
    <i class="fa fa-spinner text-primary font-size-h2" id="waiting" style="display: none"></i>
    <i class="fa fa-check text-success font-size-h2" id="success" style="display: none"></i>
    <i class="fa fa-times text-danger font-size-h2" id="error" style="display: none"></i>
</div>

