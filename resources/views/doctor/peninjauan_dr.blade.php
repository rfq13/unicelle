@extends('customer_side_nav')

@section('sidebar')

<div class="card">
    <div class="card-header bg-transparent ">
        <div class="p-3">
            <span class="head-card-akun__">Profil</span>
        </div>
    </div>
    <div class="card-body" style="min-height: 500px;">
        <div class="note-peninjauan__  text-center p-5">
            <span class="text-peninjauan__">Data Anda Sedang Ditinjau oleh Admin</span>
            <div class="mt-5">
                <img class="img-peninjauan__" src="assets/images/time-peninjauan.png" alt="">
            </div>
        </div>
    </div>
</div>

@endsection