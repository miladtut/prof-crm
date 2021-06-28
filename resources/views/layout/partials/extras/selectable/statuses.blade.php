<select name="status_name" class="btn btn-light-danger form-control">
    <option value="">all</option>
    <option value="po_sent" {{request('status_name')=='po_sent'?'selected':''}}>po sent </option>
    <option value="declined" {{request('status_name')=='declined'?'selected':''}}>declined</option>
    <option value="closed" {{request('status_name')=='closed'?'selected':''}}>closed</option>
</select>
