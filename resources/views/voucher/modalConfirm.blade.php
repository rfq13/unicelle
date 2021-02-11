 <div class="modal-body">
        <div class="col-md-12">
            <div class="text-center">
                <h4>Apakah anda yakin akan menukarkan poin yang anda miliki?<h4>
            </div>
        </div>
        <div class="modal-footer border-0" style="display:block">
            <div style="display: flex;justify-content: space-between;">
                <button type="button" class="btn btn-danger mr-3" data-dismiss="modal">Close</button>
                <a href="javascript:void(0)" onclick="addvoucher(event,{{$voucher->id}});">
                    <button class="btn btn-primary1 w-100">Tukar Poinku</button>
                 </a>
            </div>
        </div>

<script>
function addvoucher(e,key){
e.preventDefault()
$.post('{{ route('tukar.voucher') }}', {_token:'{{ csrf_token() }}',id:key}, function(data){
if (data.stts === false) {
showFrontendAlert('success', 'Voucher berhasil ditukar');
location.reload();
}else{
showFrontendAlert('warning', 'Poin tidak mencukupi');
location.reload();
}
});

}
</script>
