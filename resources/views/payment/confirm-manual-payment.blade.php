<!DOCTYPE html>
<html lang="en">
@extends('frontend.layouts.app')
{{-- <style>

</style> --}}

@section('content')
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
                                        <th  style="color: #B71C1C; font-size: 18px;">Rp31.500</th>
                                    </tr>
                                </table>
                            </div>

                            <div class="d-flex mt-1 mt-lg-3">
                                <div class="img-konfimasi__ mx-2">
                                    <img src="bni-02.png" alt="" style="width: 50px; height: 50px;">
                                </div>
                                <div class="name-bank-konfirmasi__ mx-2 p-0">
                                    <span class="font-weight-bold" style="font-size: 16px;">BANK BNI</span><br>
                                    <span style="font-size: 12px; color: #424242;">Hanya menerima dari transfer BNI</span>
                                </div>
                            </div>

                            <div class="info-lanjut-konfirmasi__">
                                <div class="mt-3">
                                    <span style="font-size: 16px; color: #424242;">No. Rekening</span><br>
                                    <span class="font-weight-bold" style="font-size: 20px; color: #B71C1C;">8806 082 1441 9700 4</span>
                                </div>
                                <div class="mt-2">
                                    <span style="font-size: 16px; color: #424242;">Jumlah yang Dibayar</span><br>
                                    <span class="font-weight-bold" style="font-size: 20px; color: #B71C1C;">Rp31.500</span>
                                </div>
                                <div class="mt-4">
                                    <span class="text-muted" style="font-size: 16px;">Pastikan kamu melakukan pembayaran dalam waktu 24 jam setelah pesanan dibuat
                                        untuk menghindari pembatalan otomatis dan silahkan lakukan konfirmasi pembayaran
                                        jika kamu sudah melakukan pembayaran jika kamu sudah melakukan pembayaran di
                                        halaman akun profil.</span>
                                </div>
                            </div>

                            <div class="text-center mt-5">
                                <a href="" class="btn btn-primary1 mx-lg-5 mx-3">Konfirmasi Pembayaran</a>
                                <a href="" class="btn btn-secondary1 mx-lg-5 mx-3">Cek Pesanan</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function(){
    
}); 
</script>
@endsection
