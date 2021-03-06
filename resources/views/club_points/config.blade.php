@extends('layouts.app')

@section('content')
@php
    $club_point_convert_rate = \App\BusinessSetting::where('type', 'club_point_convert_rate')->first();
    $club_point_pasien_reg_convert = \App\BusinessSetting::where('type', 'club_point_pasien_reg_convert')->first();
    $club_point_partner_physician_convert = \App\BusinessSetting::where('type', 'club_point_partner_physician_convert')->first();
    $pasien= \App\PoinUser::where('type_user','pasien reg')->first();
    $physician = \App\PoinUser::where('type_user','partner physician')->first();
@endphp
    <div class="row">
        {{-- <div class="col-lg-6">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">{{__('Ubah Poin ke Dompet')}}</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="{{ route('point_convert_rate_store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="type" value="club_point_convert_rate">
                        <div class="form-group">
                            <div class="col-lg-4">
                                <label class="control-label">{{__('Atur Nilai Poin ')}} {{ single_price(1) }}</label>
                            </div>
                            <div class="col-lg-5">
                                <input type="number" min="0" step="0.01" class="form-control" name="value" @if ($club_point_convert_rate != null) value="{{ $club_point_convert_rate->value }}" @endif placeholder="100" required>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">{{__('Poin')}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12 text-right">
                                <button class="btn btn-purple" type="submit">{{__('Simpan')}}</button>
                            </div>
                        </div>
                    </form>
                    <p class="h5 mt-2">{{ __('Catatan: Anda harus mengaktifkan opsi dompet terlebih dahulu sebelum menggunakan addon poin klub.') }}</p>
                </div>
            </div>
        </div> --}}
        <div class="col-lg-6">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">{{__('Poin dan Diskon Pasien Reguler')}}</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="{{ route('point_convert_rate_user') }}" method="POST">
                        @csrf
                        <input type="hidden" name="type" @if (isset($pasien))value="{{$pasien->type_user}}"@endif>
                        <div class="form-group">
                            <p style="font-weight:bold">Konfigurasi Poin</p>
                            <div class="row" style="margin-bottom:20px">
                            <div class="col-lg-4">
                                <label class="control-label">{{__('Minimal Belanja(Rp)')}}</label>
                            </div>
                            <div class="col-lg-5">
                                <input type="number" min="0" step="0.01" class="form-control" name="min_order_poin" @if (isset($pasien)) value="{{ $pasien->min_order_poin }}" @endif placeholder="" required>
                            </div>
                            </div>
                            <div class="row" style="margin-bottom:20px">
                            <div class="col-lg-4">
                                <label class="control-label">{{__('Poin Belanja')}}</label>
                            </div>
                            <div class="col-lg-5">
                                <input type="number" min="0" step="0.01" class="form-control" name="poin" @if (isset($pasien)) value="{{ $pasien->poin }}" @endif placeholder="" required>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">{{__('%')}}</label>
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <p style="font-weight:bold">Konfigurasi Discount</p>
                            <div class="row" style="margin-bottom:20px">
                            <div class="col-lg-4">
                                <label class="control-label">{{__('Minimal Belanja(Rp)')}}</label>
                            </div>
                            <div class="col-lg-5">
                                <input type="number" min="0" step="0.01" class="form-control" name="min_order_discount" @if (isset($pasien)) value="{{ $pasien->min_order_discount }}" @endif placeholder="" required>
                            </div>
                            </div>
                            <div class="row" style="margin-bottom:20px">
                            <div class="col-lg-4">
                                <label class="control-label">{{__('Discount Belanja')}}</label>
                            </div>
                            <div class="col-lg-5">
                                <input type="number" min="0" step="0.01" class="form-control" name="discount" @if (isset($pasien)) value="{{ $pasien->discount }}" @endif placeholder="" required>
                            </div>
                            <div class="col-lg-3">
                            <select class="demo-select2" name="type_discount">
                            <option value="amount" <?php if($pasien->type_discount == 'amount') echo "selected";?> >Rp</option>
	                                	<option value="percent" <?php if($pasien->type_discount == 'percent') echo "selected";?> >%</option>
									</select>                           
                             </div>
                             </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12 text-right">
                                <button class="btn btn-purple" type="submit">{{__('Simpan')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">{{__('Poin dan Diskon Partner Physician')}}</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="{{ route('point_convert_rate_user') }}" method="POST">
                        @csrf
                        <input type="hidden" name="type" @if (isset($physician))value="{{$physician->type_user}}"@endif>
                        <div class="form-group">
                            <p style="font-weight:bold">Konfigurasi Poin</p>
                            <div class="row" style="margin-bottom:20px">
                            <div class="col-lg-4">
                                <label class="control-label">{{__('Minimal Belanja(Rp)')}}</label>
                            </div>
                            <div class="col-lg-5">
                                <input type="number" min="0" step="0.01" class="form-control" name="min_order_poin" @if (isset($physician)) value="{{ $physician->min_order_poin }}" @endif placeholder="" required>
                            </div>
                            </div>
                            <div class="row" style="margin-bottom:20px">
                            <div class="col-lg-4">
                                <label class="control-label">{{__('Poin Belanja')}}</label>
                            </div>
                            <div class="col-lg-5">
                                <input type="number" min="0" step="0.01" class="form-control" name="poin" @if (isset($physician)) value="{{ $physician->poin }}" @endif placeholder="" required>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">{{__('%')}}</label>
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <p style="font-weight:bold">Konfigurasi Discount</p>
                            <div class="row" style="margin-bottom:20px">
                            <div class="col-lg-4">
                                <label class="control-label">{{__('Minimal Belanja(Rp)')}}</label>
                            </div>
                            <div class="col-lg-5">
                                <input type="number" min="0" step="0.01" class="form-control" name="min_order_discount" @if (isset($physician)) value="{{ $physician->min_order_discount }}" @endif placeholder="" required>
                            </div>
                            </div>
                            <div class="row" style="margin-bottom:20px">
                            <div class="col-lg-4">
                                <label class="control-label">{{__('Discount Belanja')}}</label>
                            </div>
                            <div class="col-lg-5">
                                <input type="number" min="0" step="0.01" class="form-control" name="discount" @if (isset($physician)) value="{{ $physician->discount }}" @endif placeholder="" required>
                            </div>
                            <div class="col-lg-3">
                            <select class="demo-select2" name="type_discount">
                            <option value="amount" <?php if($physician->type_discount == 'amount') echo "selected";?> >Rp</option>
	                                	<option value="percent" <?php if($physician->type_discount == 'percent') echo "selected";?> >%</option>
									</select>                           
                             </div>
                             </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12 text-right">
                                <button class="btn btn-purple" type="submit">{{__('Simpan')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
         
    </div>
    <div class="row">
    <div class="col-lg-6">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">{{__('Poin Potongan Belanja Regular & Partner Physician')}}</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="{{ route('point_convert_rate_store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="type" value="club_point_convert_rate">
                        <div class="form-group">
                            <div class="col-lg-4">
                                <label class="control-label">{{__('Atur Nilai Poin ')}} {{ single_price(1) }}</label>
                            </div>
                            <div class="col-lg-5">
                                <input type="number" min="0" step="0.01" class="form-control" name="value" @if ($club_point_convert_rate != null) value="{{ $club_point_convert_rate->value }}" @endif placeholder="100" required>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">{{__('Poin')}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12 text-right">
                                <button class="btn btn-purple" type="submit">{{__('Simpan')}}</button>
                            </div>
                        </div>
                    </form>
                    <p class="h5 mt-2">{{ __('Catatan: Anda harus mengaktifkan opsi dompet terlebih dahulu sebelum menggunakan addon poin klub.') }}</p>
                </div>
            </div>
        </div>
    </div>

@endsection
