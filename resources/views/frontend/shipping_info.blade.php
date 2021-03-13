@extends('frontend.layouts.app')
@section('title',"Pilih Pengiriman")

@section('style')
<style type="text/css">
.select2-container{
    background-color: red;
}
div.pac-container {
    z-index: 99999999999 !important;
}
.hide_form{
            display: none;
        }
</style>
@endsection

@section('content')
<section class="section-sub-head"></section>
    <section class="section-detail-produk">
    <div class="container">
        <div class="container mb-5">
             <nav aria-label="breadcrumb">
                <ul class="breadcrumb mb-5">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Keranjang Belanja</a></li>
                    <li class="breadcrumb-item active" style="color:#3BB6B1" aria-current="page">Checkout</li>
                </ul>
            </nav>
            <div class="container">
        <div class="container">
            <div class="row">
                <div class="card col-lg-6">
                    <p class="ml-2 mt-4 mb-0" style="font-size: 20px; font-weight:600; ">Checkout</p>
                    <hr>
                    <div class="card mb-4" style="padding-left: 2%; padding-right: 2%;" id="all-addr">
                        <div class="container" style="border-bottom:1px solid #C4C4C4">
                            <p class="mt-3 text-checkout">Pilih Alamat Pengiriman</p>
                        </div>
                        <form class="form-default" data-toggle="validator" action="{{ route('checkout.store_shipping_infostore') }}" role="form" method="POST">
                            @csrf
                                @if(Auth::check())
                                    @foreach (Auth::user()->addresses as $key => $address)
                                    <input type="radio" style="display:none" name="address_id" value="{{ $address->id }}" {{$address->set_default == 1 ? 'checked' : ''}} required>
                                        <div class="d-flex align-items-center {{$key == 0 ? 'mt-2':''}}" style="padding-left: 0%; border-bottom:1px solid #C4C4C4">
                                            <div class="col-8 py-2" style="overflow-x:auto;">
                                                <table style="width: 100%;font-size: medium;">
                                                    <tbody>
                                                        <tr>
                                                            <td class="w-50 pb-2" valign="top">Penerima</td>
                                                            <td valign="top" class="text-capitalize"><span style="font-weight: bold">@if($address->receiver) {{$address->receiver}} @else {{Auth::user()->name}} @endif</span></td>
                                                        </tr>
                                                         <tr>
                                                            <td class="w-50 pb-2" valign="top">No. Telepone</td>
                                                            <td valign="top">{{$address->phone}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="w-50 pb-2" valign="top">Alamat Pengiriman</td>
                                                            <td valign="top" class="text-capitalize">{{$address->address}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="w-50 pb-2" valign="top">Daerah Pengiriman</td>
                                                            <td valign="top">{{$address->province}}, {{$address->city}}, {{$address->subdistrict}}, {{$address->postal_code}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-4 p-3">
                                                <div class="address text-center"> 
                                                    <a id="setDefault" href="{{ route('addresses.set_default', $address->id) }}" data-key="{{$key}}" class="btn w-100 {{$address->set_default ? 'btn-default' : 'btn-secondary'}} " data-lat="{{ $address->lat }}" data-lng="{{ $address->lng }}">Pilih</a>
                                                </div>
                                                <div class="address text-center mt-3">
                                                    <a href="{{route('addresses.destroy', $address->id)}}"><i class="fa fa-trash mr-4" style="font-size: 24px;"></i></a>
                                                    <a id="btnedit" data-value="{{ json_encode($address) }}" href="#"><i class="fa fa-pencil" style="font-size: 24px;"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                <!-- blablbabla -->
                                @endif
                        </form>
                        <div class="btn-add-address mt-2" style="border-bottom:1px solid #C4C4C4; border-top: 1px solid#c4c4c4;">
                            <a href="#"  onclick="add_new_address()">
                                <li class="mb-2 mt-2" style="list-style-type: none; color: #006064;">+ Tambah</li>
                            </a>    
                        </div>
                    </div>
<!-- Metode Pengiriman-->
                    <div class="card mb-4" style="padding-left: 2%; padding-right: 2%;">
                        <div class="container" style="border-bottom:1px solid #C4C4C4">
                            <p class="mt-3 text-checkout">Metode Pengiriman</p>
                        </div>
                        <div id="data-ongkir" style="min-height: 150px;">
                            
                        </div>

                    </div>
<!--x Metode Pengiriman x-->
                        <div class="card mb-4 mt-2" style="padding-left: 2%; padding-right: 2%;">
                            <div class="row">
                                <div class="ml-3 col-10">
                                    <p class="mt-3 text-checkout">Kirim Sebagai Dropshipper</p>
                                </div>
                                <label class="mt-3 cb-pengiriman">
                                    <input type="checkbox" id="myCheck" onclick="myFunction()" @if(\Session::has('data_dropshiper')) checked @endif>
                                    <span style="margin-left:30px" class="cb-checkmark"></span>
                                </label>
                            </div>
                            <hr>
                            <div class="container"  id="form_dropshipper" @if(!\Session::has('data_dropshiper')) style="display:none;" @endif>
                                <form action="{{ route('checkout.dropshipper') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group ">
                                            <input type="text" name="nama" class="form-control" placeholder="Nama Pengirim" value="{{  \Session::has('data_dropshiper') ? \Session::get('data_dropshiper')['nama'] : '' }}" required>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group ">
                                            <input type="text" name="nomor_tlp" class="form-control" placeholder="No.Telepon Pengirim"  value="{{  \Session::has('data_dropshiper') ? \Session::get('data_dropshiper')['nomor_tlp'] : '' }}"  required>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group ">
                                            <input type="text" name="kota_pengirim" class="form-control" placeholder="kota asal Pengirim"  value="{{  \Session::has('data_dropshiper') ? \Session::get('data_dropshiper')['kota_pengirim'] : '' }}"  required>
                                        </div>
                                    </div>
                                    <div class="mx-auto">
                                        <button class="ml-5 btn btn-default">Simpan</button>
                                        <li class="date-ekspedisi ml-4 mb-2 mt-2" style="list-style-type: none; color: #424242;">
                                            <a style="color: #424242;" target="_blank" href="{{route('petunjuk.dropshipper')}}">Petunjuk Dropshipper</li></a>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-sm-5 summary" id="rincian_bayar" style="padding-bottom: 50%;">
                        @include('frontend.partials.cart_summary2')
                    </div>
            </div>
        </div>
    </div>
        </div>
    </div>
    </section>
    <!--X END X-->

<div class="modal fade" id="new-address-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">{{ translate('Alamat Baru')}}</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <div class="p-3">
                        <div class="form-group">
                            <input id="pac-input"  class="controls" type="text" placeholder="Cari Lokasi" hidden>
                            <div id="map" style="width: 100%;height: 350px;top: 8;font-size: 16pt;"></div>
                        </div>
                        <div id="form_pertama">
                        <form class="form-default" role="form" action="{{ route('addresses.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id">
                        <input type="hidden" name="lat">
                        <input type="hidden" name="lng">
                        <div class="row" style="margin-bottom: 15px;">
                            <div class="col-md-2">
                                <label>{{ translate('Provinsi')}}<sup style="color: #F3795C;">*</sup></label>
                            </div>
                            <div class="col-md-10">
                            <select class="form-control rounded my-2 p-2 select2" name="province" id="provinsi" aria-describedby="provinsiHelpId" required>
                                    <option></option>
                                </select>
                                <input type="hidden" name="province">
                                {{-- <input type="text" class="form-control mb-3" placeholder="{{ translate('Provinsi')}}" name="province" id="provinsi"  value=""> --}}
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 15px;">
                            <div class="col-md-2">
                                <label>{{ translate('Kota/Kabupaten')}}<sup style="color: #F3795C;">*</sup></label>
                            </div>
                            <div class="col-md-10">
                            <select class="form-control rounded my-2 p-2 select2" name="city" id="kota" aria-describedby="provinsiHelpId" style="border-color: #F3795C;" required>
                                    <option></option>
                                    <input type="hidden" name="city">

                                {{-- <input type="text" class="form-control mb-3" placeholder="{{ translate('Kota/Kabupaten')}}" name="city" id="Kota" value=""> --}}
                            </div>
                        </div>
                         <div class="row" style="margin-bottom: 15px;">
                            <div class="col-md-2">
                                <label>{{ translate('Kecamatan')}}<sup style="color: #F3795C;">*</sup></label>
                            </div>
                            <div class="col-md-10">
                            <select class="form-control rounded my-2 p-2 select2" name="subdistrict" id="kecamatan" aria-describedby="provinsiHelpId" style="border-color: #F3795C;" required>
                                    <option></option>
                                </select>
                                <input type="hidden" name="subdistrict">
                                {{-- <input type="text" class="form-control mb-3" placeholder="{{ translate('Kecamatan')}}" name="subdistrict" id="kecamatan" value="" readonly> --}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Kode Pos')}}<sup style="color: #F3795C;">*</sup></label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-3" placeholder="{{ translate('Kode Pos')}}" id="kode_pos_alamat" name="postal_code" value="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Nama')}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-3" placeholder="Nama penerima" name="receiver" value="" id="receiver" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Nomor telepon')}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-3" placeholder="Nomor telepon penerima" name="phone" value="" id="phone" required>
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Detail Alamat')}}<sup style="color: #F3795C;">*</sup></label>
                            </div>
                            <div class="col-md-10">
                                <textarea class="form-control textarea-autogrow mb-3" placeholder="{{ translate('detail alamat Pengiriman')}}" rows="3" name="address" id="txtaddress" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                        <button type="submit" class="btn btn-base-1">{{  translate('Simpan') }}</button>
                        </div>
                        </form>
                        </div>
                        <!-- batas -->
                        <div id="form_kedua" class="hide_form">
            <form class="form-default" role="form" action="{{ route('addresses.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <input type="hidden" name="lat">
                <input type="hidden" name="lng">
                        <div class="row" style="margin-bottom: 15px;">
                            <div class="col-md-2">
                                <label>{{ translate('Provinsi')}}<sup style="color: #F3795C;">*</sup></label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-3" placeholder="{{ translate('Provinsi')}}" name="province" id="provinsi2"  value="" readonly> 
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 15px;">
                            <div class="col-md-2">
                                <label>{{ translate('Kota/Kabupaten')}}<sup style="color: #F3795C;">*</sup></label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-3" placeholder="{{ translate('Kota/Kabupaten')}}" name="city" id="Kota2" value="" readonly> 
                            </div>
                        </div>
                         <div class="row" style="margin-bottom: 15px;">
                            <div class="col-md-2">
                                <label>{{ translate('Kecamatan')}}<sup style="color: #F3795C;">*</sup></label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-3" placeholder="{{ translate('Kecamatan')}}" name="subdistrict" id="kecamatan2" value="" readonly>
                            </div>
                        </div>
                        <div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Kode Pos')}}<sup style="color: #F3795C;">*</sup></label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-3" placeholder="{{ translate('Kode Pos')}}" id="kode_pos_alamat2" name="postal_code" value="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Nama')}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-3" placeholder="Nama penerima" name="receiver" value="" id="receiver" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Nomor telepon')}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-3" placeholder="Nomor telepon penerima" name="phone" value="" id="phone" required>
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Detail Alamat')}}<sup style="color: #F3795C;">*</sup></label>
                            </div>
                            <div class="col-md-10">
                                <textarea class="form-control textarea-autogrow mb-3" placeholder="{{ translate('detail alamat Pengiriman')}}" rows="3" name="address" id="txtaddress" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                        <button type="submit" class="btn btn-base-1">{{  translate('Simpan') }}</button>
                        </div>
                        </form>
                        </div>
                        <!-- batas -->
                    </div>
                </div>
                {{-- <div class="modal-footer">
                    <button type="submit" class="btn btn-base-1">{{  translate('Simpan') }}</button>
                </div> --}}
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_API') }}&libraries=drawing,places&callback=initMap" async defer></script>
<script type="text/javascript">
var drawingManager;
var lat =  -7.20455898888842;
var lng = 112.734314762056;
var map,marker,infoWindow;
function initMap() {
   
    map = new google.maps.Map(document.getElementById("map"), {
        center: {lat: lat, lng: lng},
        zoom: 6
    });

    marker = new google.maps.Marker({
        position: {lat: lat, lng: lng},
        map,
        title: "My addres"
    });

    infoWindow = new google.maps.InfoWindow();
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
          (position) => {
            const pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude,
            };
            lat = position.coords.latitude;
            lng = position.coords.longitude;
            // infoWindow.setPosition(pos);
            // infoWindow.setContent("Location found.");
            // infoWindow.open(map);
            // map.setCenter(pos);
            $('input[name="lat"]').val(lat);
            $('input[name="lng"]').val(lng);
            marker.setPosition(pos);
            getAddress(lat,lng).then(function(result){
                var place = result['address_components'];
                $('#kode_pos_alamat').val("");
                $.each(place,function(index,value){
                    // console.log(value);
                    if(value.types[0] == "administrative_area_level_1"){
                        $('#provinsi2').val(value.long_name);
                    }else if(value.types[0] == "administrative_area_level_2"){
                        $('#Kota2').val(value.long_name);
                    }else if(value.types[0] == "administrative_area_level_3"){
                        $('#kecamatan2').val(value.long_name);
                    }else if(value.types[0] === "postal_code"){
                        $('#kode_pos_alamat2').val(value.long_name);
                    }
                });
            });
          },
          () => {
            handleLocationError(true, infoWindow, map.getCenter());
          }
        );
      } else {
        // Browser doesn't support Geolocation
       handleLocationError(false, infoWindow, map.getCenter());
    }


    map.addListener('click', function(mapsMouseEvent) {
          // Close the current InfoWindow.

          $('#form_pertama').addClass('hide_form');
          $('#form_kedua').removeClass('hide_form');
        marker.setPosition(mapsMouseEvent.latLng);
        $('input[name="lat"]').val(mapsMouseEvent.latLng.lat());
        $('input[name="lng"]').val(mapsMouseEvent.latLng.lng());
        getAddress(mapsMouseEvent.latLng.lat(),mapsMouseEvent.latLng.lng()).then(function(result){
            var place = result['address_components'];
            $('#kode_pos_alamat').val("");
            $.each(place,function(index,value){
                // console.log(value);
                if(value.types[0] == "administrative_area_level_1"){
                    $('#provinsi2').val(value.long_name);
                }else if(value.types[0] == "administrative_area_level_2"){
                    $('#Kota2').val(value.long_name);
                }else if(value.types[0] == "administrative_area_level_3"){
                    $('#kecamatan2').val(value.long_name);
                }else if(value.types[0] === "postal_code"){
                    $('#kode_pos_alamat2').val(value.long_name);
                }
            });
        });
       
    });
   
    setsearchbox(map,marker);
}
function getProvisi(){
        blockui("#body-shiping");
        $.ajax({
           type:"GET",
           url:'{{ route('rajaongkir.provinsi') }}',
           success: function(data){
               $('#provinsi').select2({
                data: data,
                templateResult: function (repo) {
                    if (repo.loading) return repo.text;

                    var markup = "<div class='select2-result-repository clearfix'>" +
                        "<div class='select2-result-repository__title'>" + repo.text + "</div></div>";

                    return markup;
                },

                escapeMarkup: function (markup) {
                    return markup;
                },
                templateSelection: function (repo) {
                    return repo.TEXT || repo.text;
                },
                placeholder: "Pilih provinsi",
                allowClear: true,
                minimumInputLength : -1
            });
           }
       });
    }
    function getKabupaten(){
        var provinsi= $('#provinsi').val();
        $('#kota').html('<option></option>');
        // $("#kota_kabupaten").select2("destroy").select2();
        $.ajax({
           type:"GET",
           url:'{{ route('addresses.get_city') }}',
           data: {
                id_provinsi : provinsi
           },
           success: function(data){
                unblockui("#body-shiping");
               $('#kota').select2({
                data: data,
                templateResult: function (repo) {
                    if (repo.loading) return repo.text;

                    var markup = "<div class='select2-result-repository clearfix'>" +
                        "<div class='select2-result-repository__title'>" + repo.text + "</div></div>";

                    return markup;
                },

                escapeMarkup: function (markup) {
                    return markup;
                },
                templateSelection: function (repo) {
                    return repo.TEXT || repo.text;
                },
                placeholder: "Pilih kota/kabupaten",
                allowClear: true,
                minimumInputLength : -1
            });
           }
       });
    }
    function getKecamatan(){
        var kabupaten= $('#kota').val();
        $('#kecamatan').html('<option></option>');
        // $("#kota_kabupaten").select2("destroy").select2();
        $.ajax({
           type:"GET",
           url:'{{ route('addresses.get_subDistrict') }}',
           data: {
                id_kabupaten : kabupaten
           },
           success: function(data){
               $('#kecamatan').select2({
                data: data,
                templateResult: function (repo) {
                    if (repo.loading) return repo.text;

                    var markup = "<div class='select2-result-repository clearfix'>" +
                        "<div class='select2-result-repository__title'>" + repo.text + "</div></div>";

                    return markup;
                },

                escapeMarkup: function (markup) {
                    return markup;
                },
                templateSelection: function (repo) {
                    return repo.TEXT || repo.text;
                },
                placeholder: "Pilih kecamatan",
                allowClear: true,
                minimumInputLength : -1
            });
           }
       });
    }
    function getDetailCity(idKecamatan)
    {
        $.ajax({
            url: "{{ route('rajaongkir.detail') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                idCity: idKecamatan
            },
            dataType: "json",
            async: true,
            success: function(msgd) {
               
                console.log(msgd);
            }
        });
    }
    $(document).ready(function(){
    getProvisi();
    getKabupaten();
    getKecamatan();
    $('#provinsi').on('change', function() {
        var data = $('#provinsi').select2('data');
        $('input[name="province"]').val(data[0].text);
        getKabupaten();
    });
    $('#kota').on('change', function() {
        var data = $('#kota').select2('data');
        $('input[name="city"]').val(data[0].text);
        getKecamatan();
    });
    $('#kecamatan').on('change', function() {
         var data = $('#kecamatan').select2('data');
        $('input[name="subdistrict"]').val(data[0].text);
        //console.log(data[0]);
        getDetailCity(data[0].id);
    });
});
function getAddress (latitude, longitude) {
    return new Promise(function (resolve, reject) {
        var request = new XMLHttpRequest();

        var method = 'GET';
        var url = 'https://maps.googleapis.com/maps/api/geocode/json?key={{ env("MAP_API") }}&latlng=' + latitude + ',' + longitude + '&sensor=true';
        var async = true;

        request.open(method, url, async);
        request.onreadystatechange = function () {
            if (request.readyState == 4) {
                if (request.status == 200) {
                    var data = JSON.parse(request.responseText);
                    var address = data.results[0];
                    resolve(address);
                }
                else {
                    reject(request.status);
                }
            }
        };
        request.send();
    });
};

function setsearchbox(map,marker)
{
    var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        
        $("#pac-input").removeAttr('hidden');
        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
            $('#form_pertama').addClass('hide_form');
          $('#form_kedua').removeClass('hide_form');
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              // console.log("Returned place contains no geometry");
              return;
            }
             $('#kode_pos_alamat').val("");
            $.each(place.address_components,function(index,value){
                // console.log(value);
                if(value.types[0] == "administrative_area_level_1"){
                    $('#provinsi2').val(value.long_name);
                }else if(value.types[0] == "administrative_area_level_2"){
                    $('#Kota2').val(value.long_name);
                }else if(value.types[0] == "administrative_area_level_3"){
                    $('#kecamatan2').val(value.long_name);
                }else if(value.types[0] === "postal_code"){
                    $('#kode_pos_alamat2').val(value.long_name);
                }
            });
            // console.log(place.geometry.location.lat());
            $('input[name="lat"]').val(place.geometry.location.lat());
            $('input[name="lng"]').val(place.geometry.location.lng());
            marker.setPosition(place.geometry.location);

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });

}
</script>
<script type="text/javascript">
    function handle_ongkir(param){
        blockui("#rincian_bayar");
        $.post('{{ route('checkout.set_ongkir') }}', { _token:'{{ csrf_token() }}', param: param }, function(data){
            $('#rincian_bayar').html(data.cart_summary);
            unblockui("#rincian_bayar");
        });

    }
    function getCostAddress(lat,lng)
    {   blockui("#data-ongkir");
        $.post('{{ route('addresse.cost') }}', { _token:'{{ csrf_token() }}', lat: lat,lng: lng}, function(data){
            $('#data-ongkir').html(data.shiping_item);
            unblockui("#data-ongkir");
        });
    }
    $(document).ready(function () {
        $("#all-addr").on("click", "#setDefault", function (e) {
            e.preventDefault()
            let key = $(this).data("key")
            let urL = $(this).attr("href")
            let setDefault = $("#all-addr #setDefault")
            let _lat = $(this).data("lat");
            let _lng = $(this).data("lng");
            // alert(setDefault); return
            setDefault.removeClass("btn-default")
            setDefault.addClass("btn-secondary")
            let setthis = $(this)
            $.get(urL,function (data) {
                if (data[1] == "sukses") {
                    showFrontendAlert("success",data[0])
                    $("#defaulted"+key).html('')
                    setthis.removeClass("btn-secondary")
                    setthis.addClass("btn-default")
                    getCostAddress(_lat,_lng);
                }else{
                    showFrontendAlert("danger",data[0])
                }
            })
        });

        $("#all-addr").on("click","#btnedit", function (e) {
            e.preventDefault()
            var data = $(this).data("value");
            $('input[name="id"]').val(data.id);
            $('input[name="province"]').val(data.province);
            $('input[name="city"]').val(data.city);
            $('input[name="phone"]').val(data.phone);
            $('input[name="lat"]').val(data.lat);
            $('input[name="lng"]').val(data.lng);
            $('input[name="receiver"]').val(data.receiver);
            $('input[name="subdistrict"]').val(data.subdistrict);
            $("#txtaddress").html(data.address);
            const pos = {
              lat: parseFloat(data.lat),
              lng: parseFloat(data.lng)
            };
            marker.setPosition(pos);
            $("#exampleModalLabel").html("Edit Address")

            $("#new-address-modal").modal("show")
        });

        $('#new-address-modal').on('shown.bs.modal', function(){
           $("#pac-input").css("top","50px");   
        });

        @if(isset(Auth::user()->addresseDefault) && Auth::user()->addresseDefault != null)
        var lat = {{ Auth::user()->addresseDefault->lat }};
        var lng = {{ Auth::user()->addresseDefault->lng }};
        getCostAddress(lat,lng);
        @endif
        
    });

    function add_new_address(){
        $('#new-address-modal').modal('show');
    }
    $('.add').click(function () {
        if ($(this).prev().val() < 12) {
            $(this).prev().val(+$(this).prev().val() + 1);
        }
    });
    $('.sub').click(function () {
        if ($(this).next().val() > 1) {
            if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
        }
    });
    function myFunction() {
  var checkBox = document.getElementById("myCheck");
  var text = $("#form_dropshipper");
  if (checkBox.checked == true){
    text.slideDown();
  } else {
    text.slideUp();
  }
}
</script>
@endsection
