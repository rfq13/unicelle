@extends('layouts.app')

@section('content')

@php
    $refund_time_config = \App\BusinessSetting::where('type', 'refund_request_time')->first();
    $refund_poin_config = \App\BusinessSetting::where('type', 'refund_request_poin')->first();
    $refund_stiker_config = \App\BusinessSetting::where('type', 'refund_sticker')->first();

@endphp
<div class="row">
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title text-center">{{__('Atur Waktu Pengembalian Dana')}}</h3>
            </div>
            <form class="form-horizontal" action="{{ route('refund_request_time_config') }}" method="POST" enctype="multipart/form-data">
            	@csrf
                <div class="panel-body">
                    <div class="form-group">
                        <input type="hidden" name="type" value="refund_request_time">
                        <label class="col-lg-3 control-label">{{__('Atur Waktu untuk batas Permintaan Pengembalian Dana')}}</label>
                        <div class="col-lg-5">
                            <input type="number" min="0" step="1" @if ($refund_time_config != null) value="{{ $refund_time_config->value }}" @endif placeholder="" name="value" class="form-control">
                        </div>
                        <div class="col-lg-2">
                            <option class="form-control">hari</option>
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-right">
                    <button class="btn btn-purple" type="submit">{{__('Simpan')}}</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title text-center">{{__('Setel Stiker Pengembalian Dana')}}</h3>
            </div>
            <form class="form-horizontal" action="{{ route('refund_sticker_config') }}" method="POST" enctype="multipart/form-data">
            	@csrf
                <div class="panel-body">
                    <div class="form-group">
                        <input type="hidden" name="type" value="refund_sticker">
                        @if($refund_stiker_config != null)
                        <div class="form-group">
                        <label class="col-lg-3 control-label" for="logo">{{__('Stiker saat ini')}}</label>
                        <div class="col-lg-5">
                        <img style="max-width:100%" src="{{my_asset($refund_stiker_config->value)}}"/>
                        </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <label class="col-lg-3 control-label" for="logo">{{__('Stiker')}}</label>
                            <div class="col-lg-5">
                                <input type="file" id="logo" name="logo" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-right">
                    <button class="btn btn-purple" type="submit">{{__('Simpan')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title text-center">{{__('Setel Jumlah Poin Untuk Refund')}}</h3>
            </div>
            <form class="form-horizontal" action="{{ route('refund_request_poin_config') }}" method="POST" enctype="multipart/form-data">
            	@csrf
                <div class="panel-body">
                    <div class="form-group">
                    <input type="hidden" name="type" value="refund_request_poin">
                        <div class="form-group">
                            <label class="col-lg-3 control-label" for="poin">{{__('Poin')}}</label>
                            <div class="col-lg-5">
                                <input type="number" id="poin"  @if ($refund_poin_config != null) value="{{ $refund_poin_config->value }}" @endif name="value" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-right">
                    <button class="btn btn-purple" type="submit">{{__('Simpan')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection
