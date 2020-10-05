@extends('layouts.app')
@section('content')
<div class="container pt-5">
        <div class="col-lg-6 mx-auto">
            <div class="card deskripsi__produk">
                <table>
                    <td>
                    <span class="nama_produk-detail">Total Pembayaran</span>
                    </td>
                    <td>
                    <span class="price__produk float-right">Rp.15.000</span>
                    </td>
                </table>
                <div class="head-pembayaran">
                    <hr>
                    <a style="text-decoration: none;">
                        <div class="d-flex align-items-center mb-3">
                            <img class="img-serupa" src="assets\images\logo.png" alt="">
                            <div class="pl-3">
                                <div class="name-bank">
                                    <span>Bank BNI</span>
                                </div>
                                <span class="deskripsi_bank">Hanya menerima dari Transfer</span>
                            </div>
                        </div>
                        <span class="deskripsi_bank">No. Rekening</span>
                        <h5 class="no-rekening">8808 856 8444 8321 8</h5>
                        <div id="accordion" class="accordion">
                            <div class="head-pembayaran">
                              <div class="name-bank" id="hd-1">
                                <h5 class="mb-0">
                                  <button class="btn name-bank" data-toggle="collapse" data-target="#collapse-1" aria-expanded="false" aria-controls="collapseOne" style="width: 100%; text-align: left; padding: 0;">
                                    Petunjuk Transfer ATM
                                    <i class="fas fa-angle-down mr-5 mt-2" style="position: absolute; right: 10px;"></i>
                                  </button>
                                </h5>
                              </div>
                              <hr>
                              <div id="collapse-1" class="collapse" aria-labelledby="hd-1" data-parent="#accordion">
                                <div class="card-body">
                                  Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                </div>
                              </div>
                            </div>

                            <div class="head-pembayaran">
                                <div class="name-bank" id="hd-2">
                                  <h5 class="mb-0">
                                    <button class="btn name-bank" data-toggle="collapse" data-target="#collapse-2" aria-expanded="false" aria-controls="collapseOne" style="width: 100%; text-align: left; padding: 0;">
                                      Petunjuk Transfer iBanking
                                      <i class="fas fa-angle-down mr-5 mt-2" style="position: absolute; right: 10px;"></i>
                                    </button>
                                  </h5>
                                </div>
                                <hr>
                                <div id="collapse-2" class="collapse" aria-labelledby="hd-2" data-parent="#accordion">
                                  <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                  </div>
                                </div>
                              </div>

                              <div class="head-pembayaran">
                                <div class="name-bank" id="hd-3">
                                  <h5 class="mb-0">
                                    <button class="btn name-bank" data-toggle="collapse" data-target="#collapse-3" aria-expanded="false" aria-controls="collapseOne" style="width: 100%; text-align: left; padding: 0;">
                                      Petunjuk Transfer mBanking
                                      <i class="fas fa-angle-down mr-5 mt-2" style="position: absolute; right: 10px;"></i>
                                    </button>
                                  </h5>
                                </div>
                                <hr>
                                <div id="collapse-3" class="collapse" aria-labelledby="hd-3" data-parent="#accordion">
                                  <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                  </div>
                                </div>
                              </div>

                              <div class="head-pembayaran">
                                <div class="name-bank" id="hd-4">
                                  <h5 class="mb-0">
                                    <button class="btn name-bank" data-toggle="collapse" data-target="#collapse-4" aria-expanded="false" aria-controls="collapseOne" style="width: 100%; text-align: left; padding: 0;">
                                      Petunjuk Transfer SMS Banking
                                      <i class="fas fa-angle-down mr-5 mt-2" style="position: absolute; right: 10px;"></i>
                                    </button>
                                  </h5>
                                </div>
                                <hr>
                                <div id="collapse-4" class="collapse" aria-labelledby="hd-4" data-parent="#accordion">
                                  <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                  </div>
                                </div>
                            </div>
                    
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
