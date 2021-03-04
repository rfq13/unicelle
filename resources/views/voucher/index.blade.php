@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <a href="{{ route('voucher.create')}}" class="btn btn-rounded btn-info pull-right">{{translate('Tambah Kupon Voucher')}}</a>
        </div>
    </div><br>
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{translate('Informasi Kupon')}}</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{translate('Thumbnail')}}</th>
                        <th>{{translate('Merchant')}}</th>
                        <th>{{translate('Nama Voucher')}}</th>
                        <th>{{translate('Poin')}}</th>
                        <th>{{translate('Mulai Tanggal')}}</th>
                        <th>{{translate('Selesai Tanggal')}}</th>
                        <th>{{__('Aktif')}}</th>
                        <th width="10%">{{translate('Pilihan')}}</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($coupons_voucher as $key => $coupon)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td> <img loading="lazy"  class="img-md" src="{{ my_asset($coupon->thumbnail)}}" alt="Image">
</td>
                            <td>{{$coupon->merchant}}</td>
                            <td>{{$coupon->judul}}</td>
                            <td>{{$coupon->point}}</td>

                            <td>{{ date('d-m-Y', $coupon->start_date) }}</td>
                            <td>{{ date('d-m-Y', $coupon->end_date) }}</td>
                            <td><label class="switch">
                                <input onchange="update_activation(this,'visibility')" value="{{ $coupon->id }}"type="checkbox"
                                    <?php
                                        if($coupon->is_active == 1) echo "checked";
                                    ?>
                                >
                                <span class="slider round"></span></label>
                            </td>
                            <td>
                                <div class="btn-group dropdown">
                                    <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                        {{translate('Aksi')}} <i class="dropdown-caret"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="{{route('voucher.edit', encrypt($coupon->id))}}">{{translate('Ubah')}}</a></li>
                                        <li><a onclick="confirm_modal('{{route('voucher.delete', $coupon->id)}}');">{{translate('Hapus')}}</a></li>
                                        <li><a href="{{ route('admin.voucher.usage', $coupon->id) }}">{{translate('Download List User')}}</a></li>

                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
@section('script')
<script>
    function update_activation(ini,command=false) {
        let data = {
            _token:"{{ csrf_token() }}",
            id:$(ini).val()
        }
        let urL = command && command == "visibility" ? "{{ route('coupon.visibility') }}" : "";
        $.post(urL,data, function (respon) {
            if (respon.st === "sukses") {
                showAlert('success',respon.msg)
            } else {
                showAlert('danger',"ada kesalahan")
            }
        })
    }

</script>
    
@endsection