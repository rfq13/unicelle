@extends('layouts.app')

@section('content')
@php
    $club_point_convert_rate = \App\BusinessSetting::where('type', 'club_point_convert_rate')->first();
@endphp
    <div class="row">
        <div class="col-lg-6">
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
        </div>
    </div>

@endsection
