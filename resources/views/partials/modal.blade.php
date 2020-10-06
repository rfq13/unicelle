<script type="text/javascript">
    function confirm_modal(delete_url)
    {
        jQuery('#confirm-delete').modal('show', {backdrop: 'static'});
        document.getElementById('delete_link').setAttribute('href' , delete_url);
    }

    function addSubmember(url,id) {
        let subMember = $("#add-submember-modal")
        subMember.modal('show', {backdrop:'static'});
        subMember.find("form").attr("action",url)
    }
</script>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">{{translate('Confirmation')}}</h4>
            </div>

            <div class="modal-body">
                <p>{{translate('Delete confirmation message')}}</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{translate('Cancel')}}</button>
                <a id="delete_link" class="btn btn-danger btn-ok">{{translate('Delete')}}</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add-submember-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">

            <div class="modal-header">
                {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> --}}
                <h4 class="modal-title" id="myModalLabel">{{ translate('Tambah Sub-Member')}}</h4>
            </div>

            <div class="modal-body">
                <form action="#" method="POST">
                    @csrf
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="Title">Title</label>
                        <input type="text" class="form-control" id="Title" name="title">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="min">Min</label>
                        <input type="number" class="form-control" id="min" name="min">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary" style="float: right;margin-right:2px">Tambahkan</button>
                  </form>
            </div>

            <div class="modal-footer" style="margin-top: 43px">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ translate('Cancel')}}</button>
                <a id="delete_link" class="btn btn-danger btn-ok">{{ translate('Delete')}}</a>
            </div>
        </div>
    </div>
</div>
