@extends('frontend.layouts.app')

@section('content')
@php
$bank_setting = \App\BusinessSetting::where('type', 'bank_setting')->first();
$config =  json_decode( $bank_setting->value);
@endphp
<div class="container my-lg-5 my-3">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-lg-8 col-12">
                <div class="card p-4">
                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col-10">

                            <div class="border-bottom pb-lg-3 pb-1">
                                <table>
                                    <tr>
                                        <td class="w-100" style="font-size: 18px;">Total Pembayaran</td>
                                        <th  style="color: #B71C1C; font-size: 18px;">{{ single_price($order->grand_total) }}</th>
                                    </tr>
                                </table>
                            </div>

                            <div class="d-flex mt-1 mt-lg-3">
                                <div class="img-konfimasi__ mx-2">
                                    <img src="{{ my_asset($config->LOGO) }}" alt="" style="width: 50px; height: 50px;">
                                </div>
                                <div class="name-bank-konfirmasi__ mx-2 p-0">
                                    <span class="font-weight-bold" style="font-size: 16px;">{{ $config->BANK_NAME }}</span><br>
                                    <span style="font-size: 12px; color: #424242;">Hanya menerima dari transfer {{ $config->BANK_NAME }}</span>
                                </div>
                            </div>

                            <div class="info-lanjut-konfirmasi__">
                                <div class="mt-3">
                                    <span style="font-size: 16px; color: #424242;">No. Rekening</span><br>
                                    <span class="font-weight-bold" style="font-size: 20px; color: #B71C1C;">{{ $config->BANK_NO_REK }}</span>
                                </div>
                                <div class="mt-3">
                                    <span style="font-size: 16px; color: #424242;">Nama Pemilik Rekening</span><br>
                                    <span class="font-weight-bold" style="font-size: 20px; color: #B71C1C;">{{ $config->BANK_ATAS_NAMA }}</span>
                                </div>
                                <div class="mt-2">
                                    <span style="font-size: 16px; color: #424242;">Jumlah yang Dibayar</span><br>
                                    <span class="font-weight-bold" style="font-size: 20px; color: #B71C1C;">{{ single_price($order->grand_total) }}</span>
                                </div>
                                <div class="mt-4">
                                    <span class="text-muted" style="font-size: 16px;">Pastikan kamu melakukan pembayaran dalam waktu 24 jam setelah pesanan dibuat
                                        untuk menghindari pembatalan otomatis dan silahkan lakukan konfirmasi pembayaran
                                        jika kamu sudah melakukan pembayaran jika kamu sudah melakukan pembayaran di
                                        halaman akun profil.</span>
                                </div>
                            </div>

                            <div class="text-center mt-5">
                                <a href="{{ route('payment.create',$order->id) }}" class="btn btn-primary1 mx-lg-5 mx-3">Konfirmasi Pembayaran</a>
                                <a href="{{ url('purchase_history') }}" class="btn btn-secondary1 mx-lg-5 mx-3">Cek Pesanan</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
