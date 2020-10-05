@extends('frontend.layouts.app')
@section('content')
<section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row">
                    <div class="col-lg-4">
                        <div class="card"></div>
                    </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header  bg-transparent mb-0">
                            <div class="row align-items-center">
                                <div class="col-lg-6 ">
                                    <p class="head-dropshipper">Komplain</p>
                                </div>
                            </div>
                        </div>
                    
                        <div class="card-body mt-3 px-3 pt-0 mb-2">
                            <div class="card card-pesanan__ ">
                                    <div class="container card-header pb-2 pt-2">
                                        <span class="mb-0">Order ID</span><span> #20200917-10304746</span>
                                    </div>
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <p class="code-dropshipper ml-4 mt-2 mb-0">Produk</p>
                                        <p class="code-dropshipper ml-4 mb-2">Silahkan pilih produk yang akan di komplain</p>
                                               

                                        <div class="col">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="ml-4">
                                                    <label class="mt-3 cb-pengiriman">
                                                        <input type="checkbox" id="myCheck" onclick="myFunction()">
                                                        <span class="cb-checkmark"></span>
                                                    </label>
                                                </div>
                                                <img class="produk-complaint" src="{{my_asset('/images/icon/obat.png')}}" alt="">
                                                <div class="col-3 pl-0 ml-2">
                                                    <p class="text-dropshipper" style="margin-bottom: 0%;">CTM 4 Mg 12 Tablet</p>
                                                    <p class="info-dropshipper" style="margin-bottom: 0%;">Jumlah Pesanan</p>
                                                    <p class="text-dropshipper" style="margin-bottom: 0%;">2</p>
                                                    <p class="info-dropshipper" style="margin-bottom: 0%;">Harga</p>
                                                    <p class="text-dropshipper" style="margin-bottom: 0%;">Rp.5.900</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--HIDE BAR-->

                                        <!--CONTENT HIDE BAR-->
                                        <div class="show-hide mb-4" id="form_dropshipper" style="display:none;">
                                            <div class="container">
                                                <div class="d-flex align-items-center ml-5 mb-3">
                                                    <div class="conainer">
                                                        <img class=" produk-detail-complaint " src="{{my_asset('/images/icon/obat.png')}}" alt="">
                                                    </div>
                                                    <div class="conainer">
                                                        <img class="ml-4 produk-detail-complaint" src="{{my_asset('/images/icon/obat.png')}}" alt="">
                                                    </div>
                                                    <div class="conainer">
                                                        <img class="ml-4 produk-detail-complaint" src="{{my_asset('/images/icon/obat.png')}}" alt="">
                                                    </div>
                                                    <div class="ml-4 produk-detail-complaint ">
                                                        <i class="fa fa-plus add-image-produk" aria-hidden="true" style="display:block"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="col-12" style="margin-left: 45px;">
                                                        <p class="receiver-dropshipper">Alasan</p>
                                                        <div class="col-8 pl-0">
                                                            <div class="card">
                                                                <p class="ml-2">
                                                                    Bungkus rusak, obanya keluar semua, tidak hygenis, dan kemasan tidak sesuai standart
                                                                </p>
                                                            </div>
                                                        </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <!--CONTENT HIDE BAR-->


                                        <!--HIDE BAR-->
                                        <div class="col">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="ml-4">
                                                    <label class="mt-3 cb-pengiriman">
                                                        <input type="checkbox" id="myCheck" onclick="myFunction()">
                                                        <span class="cb-checkmark"></span>
                                                    </label>
                                                </div>
                                                <img class="produk-complaint" src="{{my_asset('/images/icon/obat.png')}}" alt="">
                                                <div class="col-3 pl-0 ml-2">
                                                    <p class="text-dropshipper" style="margin-bottom: 0%;">CTM 4 Mg 12 Tablet</p>
                                                    <p class="info-dropshipper" style="margin-bottom: 0%;">Jumlah Pesanan</p>
                                                    <p class="text-dropshipper" style="margin-bottom: 0%;">2</p>
                                                    <p class="info-dropshipper" style="margin-bottom: 0%;">Harga</p>
                                                    <p class="text-dropshipper" style="margin-bottom: 0%;">Rp.5.900</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--HIDE BAR-->
                                         
                                    </div>
                                </div>
                                <button style="width:100px; left:80%; margin-bottom:20px" class="btn btn-default">Kirim</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')

<script>
    function myFunction() {
  var checkBox = document.getElementById("myCheck");
  var text = document.getElementById("form_dropshipper");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}

</script>
@endsection
