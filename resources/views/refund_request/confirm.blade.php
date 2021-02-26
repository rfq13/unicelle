
<div class="modal-body">

<div class="col-md-12">
    <div>
       <h4>Apakah anda yakin?</h4>
      
    </div>
</div>

</div>
<div class="modal-footer border-0">
<button type="button" class="btn btn-danger mr-3"
    data-dismiss="modal">Batal</button>
    <a href="javascript:void(0)" onclick="refund_request_money('{{ $refund2->id }}')">
                    <button style="    background-color: #008000;color: #ffffff;" class="btn btn-primary1 w-100">Kembalikan Dana</button>
                 </a>

</div>
<script>
function refund_request_money(el){
            $.post('{{ route('refund_request_money_by_admin') }}',{_token:'{{ @csrf_token() }}', el:el}, function(data){
                if (data == 1) {
                    location.reload();
                    showAlert('success', 'Pengembalian dana telah berhasil dikirim');
                }
                else {
                    showAlert('danger', 'Ada yang salah');
                }
            });
        }
</script>

