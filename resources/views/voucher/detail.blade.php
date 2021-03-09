@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12">
        <button style="background-color: #008000;" type="button" class="btn btn-primary1"><a style="color:#ffffff" href="{{ route('admin.voucher.usage', $coupon->id) }}">{{translate('Download List User')}}</a>        
        </button>
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
                        <th>{{translate('Nama User')}}</th>
                        <th>{{translate('Email')}}</th>
                        <th>{{translate('Nomor Telepon')}}</th>
                        <th>{{translate('Kode Voucher')}}</th>
                        <th>{{translate('Waktu Penukaran')}}</th>
                        <th>{{__('Sudah Terpakai')}}</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($detail as $key => $data)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$data->user->name}}</td>
                            <td>{{$data->user->email}}</td>
                            <td>{{$data->user->phone}}</td>
                            <td>{{$data->code}}</td>
                            <td>{{$data->created_at}}</td>
                            <td><label class="switch">
                                <input onchange="update_activation_kupon(this,'visibility')" value="{{ $data->id }}"type="checkbox"
                                    <?php
                                        if($data->is_active == 1) echo "checked";
                                    ?>
                                >
                                <span class="slider round"></span></label>
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
     function update_activation_kupon(ini,command=false) {
        let data = {
            _token:"{{ csrf_token() }}",
            id:$(ini).val()
        }
        let urL = command && command == "visibility" ? "{{ route('coupon.visibility.update') }}" : "";
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