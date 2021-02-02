
                                                        <div class="modal-body">

                                                            <div class="col-md-6 col-12 p-1">
                                                                <div style="border: 1px solid #C4C4C4;"
                                                                    class="text-center">
                                                                    <img src="{{ my_asset($voucher->thumbnail)}}" alt=""
                                                                        class="img-fluid"
                                                                        style="width: auto; max-height: 180px;">
                                                                </div>
                                                            </div>
                                                            <div class=" col-12 p-1">
                                                                <h4>{{$voucher->judul}}</h4>
                                                                <table class="w-100">
                                                                    <tr>
                                                                        <td class="py-1 anormal">Potongan</td>
                                                                        <td class="text-right anormal" style="font-size: 14px;">Rp <span class=" anormal" style="font-size: 20px;">{{$voucher->potongan}}</span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="py-1 anormal">Koin Ditukarkan</td>
                                                                        <td class="text-right anormal">{{$voucher->point}}</td>
                                                                    </tr>
                                                                    @php
                                                                    \Carbon\Carbon::setLocale('id');
                                                                    $tgl = \Carbon\Carbon::parse($voucher->start_date);
                                                                    $tgl_akhir = \Carbon\Carbon::parse($voucher->end_date);

                                                                    @endphp
       
                                                                    <tr>
                                                                        <td class="py-1 font-weight-bold" style="color: #464646;">Berlaku</td>
                                                                        <td class="text-right font-weight-bold"style="color: #464646;">{{$tgl->isoFormat('D MMMM')}} - {{$tgl_akhir->isoFormat('D MMMM Y')}}</td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="col-12 mt-3 p-1">
                                                                <div class="mt-md-3 mt-2">
                                                                    <h5>Syarat & Ketentuan</h5>
                                                                    <ul class="a-syarat">
                                                                    {!! $voucher->syarat !!}
                                                                    </ul>
                                                                </div>

                                                                <div class="mt-md-3 mt-2">
                                                                    <h5>Cara Pemaikaian</h5>
                                                                    <ul class="a-syarat">
                                                                    {!! $voucher->cara !!}
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer border-0">
                                                            <button type="button" class="btn btn-danger mr-3"
                                                                data-dismiss="modal">Close</button>
                                                                <a href="javascript:void(0)" onclick="addvoucher(event,{{$voucher->id}});">
                                                            <button type="button" class="btn btn-primary1">Tukar
                                                                Poin</button></a>

                                                        </div>

<script>
    function addvoucher(e,key){
        e.preventDefault()
        $.post('{{ route('tukar.voucher') }}', {_token:'{{ csrf_token() }}',id:key}, function(data){
            if (data.stts === false) {
            showFrontendAlert('success', 'Voucher berhasil ditukar');
           rekom();
            }else{
                showFrontendAlert('warning', 'Poin tidak mencukupi');
           rekom(); 
            }
        });
                
    }
</script>
                                               