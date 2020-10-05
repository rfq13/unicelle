@extends('frontend.regis_dan_login.regis_dan_login')
@section('content')

<section class="bg-img-login">
        <div class="container">
            <div class="row">

                <div class="col-lg-12" style="margin-top: 10%;">
                    <div class="card bg-form">
                        <div class="bg-reg-phy">
                            <form class="p-5">
                                <div class="d-flex mb-4 align-items-center">
                                    <div class="p-2"><img class="img-reg-phy" src="{{my_asset('\images\logo.png')}}" alt=""></div>
                                    <div class="p-2">
                                        <span class="head-reg-phy">
                                            Pendaftaran Physician</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="exampleRadios"
                                                id="exampleRadios1" value="option1" checked>
                                            <label class="form-check-label font-weight-bold" for="exampleRadios1">
                                                Regular Physician
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="exampleRadios"
                                                id="exampleRadios2" value="option2">
                                            <label class="form-check-label font-weight-bold" for="exampleRadios2">
                                                Partner Physician
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <!--  -->
                                <div class="row mb-4">
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="Nama Depan">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="Nama Belakang">
                                    </div>
                                </div>
                                <!--  -->
                                <div class="row mb-4">
                                    <div class="col">
                                        <input type="text" class="form-control"
                                            placeholder="Nama Klinik / Rumah Sakit / Intitusi">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control"
                                            placeholder="Alamat Klinik / Praktek Dokter">
                                    </div>
                                </div>
                                <!--  -->
                                <div class="row mb-4 align-items-center">
                                    <div class="col">
                                        <input type="text" class="form-control"
                                            placeholder="Nomer Klinik/Surat Izin Praktek Dokter ">
                                    </div>
                                    <div class="col">
                                        <label for="exampleFormControlFile1" class="font-weight-light">Pilih File Foto</label>
                                        <input type="file" class="form-control-file" id="exampleFormControlFile1">
                                    </div>
                                </div>
                                <!--  -->
                                <div class="row mb-4">
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="No Telepon">
                                    </div>
                                    <div class="col">
                                        <input type="email" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                                <!--  -->
                                <div class="row mb-4">
                                    <div class="col">
                                        <input type="password" class="form-control" placeholder="Kata Sandi">
                                    </div>
                                    <div class="col">
                                        <input type="password" class="form-control" placeholder="Konfirmasi Kata Sandi">
                                    </div>
                                </div>
                                <!--  -->
                                <div class="text-center">
                                    <div class="capcha">
                                        <!-- ----monggo di garap jhon. Semangat--- -->
                                    </div>
                                    <button type="submit" class="btn btn-secondary1 my-2" style="width: 50%;"><a
                                            href="#"></a>Daftar</button>
                                </div>
                            </form>
                            <div class="card-footer text-center mt-2 mb-0">
                                <span class="bpa">Sudah Punya Akun? <a href="login.html" class="ba">Login </a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
