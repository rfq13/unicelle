@extends('doctor.sidebar_dr')

@section('sidebar')

<div class="card">
    <div class="card-header  bg-transparent mb-0">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-4 col-sm-4 col-6 p-3">
                <span class="head-card-akun__">Membership</span>
            </div>
        </div>
    </div>
    <div class="card-body mt-2 mb-2">
        <section class="bg-rank-membership-now m-0 p-3">
            <div class="mt-4">
                <span class="head-tag-membership">Username</span>
                <div class="dr-membership">
                    <span class="name-membership">Rudi Hiya</span>
                </div>
            </div>
            <div class="mt-3">
                <span class="head-tag-membership">Berlaku Hingga</span>
                <div class="dr-membership">
                    <span class="name-membership">30/06/2021</span>
                </div>
            </div>
        </section>

        <div class="progres-membership mt-3">
            <span class="text-comment-member">Selesaikan <span class="font-weight-bold">Rp2.500.000</span> Total Belanja untuk menjadi <span class="font-weight-bold">Platinum
                    Membership</span> </span>
            <div class="progress my-1">
                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                    aria-valuemin="0" aria-valuemax="100">25%</div>
            </div>
            <div class="text-right">
                <span class="nominal-range-membership">Rp3.500.000 / Rp6.000.000</span>
            </div>
        </div>


        <table class="table table-hover text-center mt-3">
            <thead class="table-riwayat-poin__">
                <tr>
                    <th  scope="col"></th>
                    <th  scope="col">Gold</th>
                    <th  scope="col">Platinum</th>
                    <th  scope="col">Ambasador</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row" class="text-left">Total Belanja</th>
                    <td scope="row">Rp3.000.000</td>
                    <td scope="row">Rp6.000.000</td>
                    <td scope="row">Rp10.000.000</td>
                </tr>
                <tr>
                    <th scope="row" class="text-left">Poin Afiliate Pendaftaran</th>
                    <td scope="row">100 Poin</td>
                    <td scope="row">200 Poin</td>
                    <td scope="row">1.500 Poin</td>
                </tr>
                <tr>
                    <th scope="row" class="text-left">Diskon Belanja</th>
                    <td scope="row"><i class="fas fa-check"></i></td>
                    <td scope="row"><i class="fas fa-times"></i></td>
                    <td scope="row"><i class="fas fa-check"></i></td>
                </tr>
            </tbody>
        </table>

    </div>
</div>

    
@endsection