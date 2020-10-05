@extends('sidebar-dr')

@section('sidebar')

<div class="card">
    <div class="card-header bg-transparent ">
        <div class="p-3">
            <span class="head-card-akun__">Profil</span>
        </div>
    </div>
    <div class="card-body mx-4 px-0">
        <div class="hellow-dok my-2 mb-4">
            <span class="say-helo-dok">Hallo Selamat Datang Dok!</span>
        </div>
        <div class="d-flex head-akuku-profil__ align-items-center ">
            <div class="img-akun__ mr-3">
                <img class="pp-akun-dr-right__" src="assets/images/ic_dokter.jpg" alt="">
            </div>
            <div class="text-choose">
                <form>
                    <div class="form-group m-0">
                        <input type="file" class="form-control-file">
                        <p class="commend-sz-img mt-2">Ukuran gambar: maks. 1 MB
                            Format gambar: .JPEG, .PNG</p>
                    </div>
                </form>
            </div>
        </div>
        <form class="mt-3">
            <div class="form-group row">
                <label for="inputnama__"
                    class="col-sm-3 col-form-label text-right pr-4">Nama</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputnama__">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-3 col-form-label text-right pr-4">Jenis
                    Kelamin</label>
                <div class="form-check form-check-inline col-sm-3 pl-3">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions"
                        id="inlineRadio1" value="option1">
                    <label class="form-check-label" for="inlineRadio1">Laki-Laki</label>
                </div>
                <div class="form-check form-check-inline col-sm-4">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions"
                        id="inlineRadio2" value="option2">
                    <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-right pr-4">Tanggal Lahir</label>
                <div class="col-sm-3">
                    <select class="custom-select my-1 " id="inlineFormCustomSelectPref">
                        <option selected>Hari</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                    </select>
                </div>
                <div class="col-sm-3">
                    <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                        <option selected>Bulan</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="col-sm-3 ">
                    <select class="custom-select my-1 mr-sm-2 w-100"
                        id="inlineFormCustomSelectPref">
                        <option selected>Tahun</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputemail__"
                    class="col-sm-3 col-form-label text-right pr-4">Email</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" id="inputemail__">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputpassword__"
                    class="col-sm-3 col-form-label text-right pr-4">Password</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="inputpassword__">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputnotelp__" class="col-sm-3 col-form-label text-right pr-4">No.
                    Telepon</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputnotelp__">
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary1">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection