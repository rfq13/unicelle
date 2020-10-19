@extends('layouts.app')

@section('content')

    <div class="col-lg-8 col-lg-offset-2">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">{{translate('Informasi Penambahan Kuppin')}}</h3>
            </div>

            <form class="form-horizontal" action="{{ route('coupon.store') }}" method="POST" enctype="multipart/form-data">
            	@csrf
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="name">{{translate('Tipe Kupon')}}</label>
                        <div class="col-lg-9">
                            <select name="coupon_type" id="coupon_type" class="form-control demo-select2" onchange="coupon_form()" required>
                                <option value="">{{translate('Pilih Satu') }}</option>
                                <option value="product_base">{{translate('Untuk Produk')}}</option>
                                <option value="cart_base">{{translate('Untuk Semua Orderan')}}</option>
                            </select>
                        </div>
                    </div>

                    <div id="coupon_form">

                    </div>

                <div class="panel-footer text-right">
                    <button class="btn btn-purple" type="submit">{{translate('Simpan')}}</button>
                </div>
            </form>

        </div>
    </div>

@endsection
@section('script')

<script type="text/javascript">

    function coupon_form(){
        var coupon_type = $('#coupon_type').val();
		$.post('{{ route('coupon.get_coupon_form') }}',{_token:'{{ csrf_token() }}', coupon_type:coupon_type}, function(data){
            $('#coupon_form').html(data);

            $('#demo-dp-range .input-daterange').datepicker({
                startDate: '-0d',
                todayBtn: "linked",
                autoclose: true,
                todayHighlight: true
        	});
		});
    }

</script>

@endsection
