@php
    // dd(Auth::user()->addresses);
@endphp
@extends('frontend.layouts.app')
@section('title','Alamat')
@section('style')
    <style>
        .address-user{
            font-size:15px;
        }

        div.pac-container {
            z-index: 99999999999 !important;
        }

    </style>
@endsection

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="card col-lg-4 d-none d-lg-block">
                    @include('frontend.inc.customer_side_nav')
                </div>
                <div class="col-lg-8"  style="margin-top: 352px;">
                    <!-- Page title -->
                    {{--<div class="page-title">
                        <div class="row align-items-center">
                            <div class="col-md-6 col-12">
                                <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                    {{ translate('Dashboard') }}
                                </h2>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="float-md-right">
                                    <ul class="breadcrumb">
                                        <li><a href="{{ route('home') }}">{{ translate('Home') }}</a></li>
                                        <li class="active"><a href="{{ route('dashboard') }}">{{ translate('Dashboard') }}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>--}}

                    <!-- dashboard content -->
                    {{--<div class="">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="dashboard-widget text-center green-widget mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-shopping-cart"></i>
                                        @if(Session::has('cart'))
                                            <span class="d-block title">{{ count(Session::get('cart'))}} {{ translate('Product(s)') }}</span>
                                        @else
                                            <span class="d-block title">0 {{ translate('Product') }}</span>
                                        @endif
                                        <span class="d-block sub-title">{{ translate('in your cart') }}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="dashboard-widget text-center red-widget mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-heart"></i>
                                        <span class="d-block title">{{ count(Auth::user()->wishlists)}} {{ translate('Product(s)') }}</span>
                                        <span class="d-block sub-title">{{ translate('in your wishlist') }}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="dashboard-widget text-center yellow-widget mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-building"></i>
                                        @php
                                            $orders = \App\Order::where('user_id', Auth::user()->id)->get();
                                            $total = 0;
                                            foreach ($orders as $key => $order) {
                                                $total += count($order->orderDetails);
                                            }
                                        @endphp
                                        <span class="d-block title">{{ $total }} {{ translate('Product(s)') }}</span>
                                        <span class="d-block sub-title">{{ translate('you ordered') }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-box bg-white mt-4">
                                    <div class="form-box-title px-3 py-2 clearfix ">
                                        {{ translate('Default Shipping Address') }}
                                        <div class="float-right">
                                            <a href="{{ route('profile') }}" class="btn btn-link btn-sm">{{ translate('Edit') }}</a>
                                        </div>
                                    </div>
                                    <div class="form-box-content p-3">
                                        @if(Auth::user()->addresses != null)
                                            @php
                                                $address = Auth::user()->addresses->where('set_default', 1)->first();
                                            @endphp
                                            @if($address != null)
                                            @php
                                                $prov = json_decode($address->province);
                                                $province = isset($prov) ? $prov->province : "";
                                                $prov_id = isset($prov) ? $prov->id : "";
                                                $ct = json_decode($address->city);
                                                $city = isset($ct) ? $ct->city : "";
                                                $city_id = isset($ct) ? $ct->id : "";
                                            @endphp
                                                <table>
                                                    <tr>
                                                        <td>{{ translate('Address') }}:</td>
                                                        <td class="p-2">{{ $address->address }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ translate('Country') }}:</td>
                                                        <td class="p-2">
                                                            {{ $address->country }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ translate('Province') }}:</td>
                                                        <td class="p-2">{{ $province }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ translate('City') }}:</td>
                                                        <td class="p-2">{{ $city }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ translate('Postal Code') }}:</td>
                                                        <td class="p-2">{{ $address->postal_code }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ translate('Phone') }}:</td>
                                                        <td class="p-2">{{ $address->phone }}</td>
                                                    </tr>
                                                </table>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if (\App\BusinessSetting::where('type', 'classified_product')->first()->value)
                                <div class="col-md-6">
                                    <div class="form-box bg-white mt-4">
                                        <div class="form-box-title px-3 py-2 clearfix ">
                                            {{ translate('Purchased Package') }}
                                        </div>
                                        @php
                                            $customer_package = \App\CustomerPackage::find(Auth::user()->customer_package_id);
                                        @endphp
                                        <div class="form-box-content p-3">
                                            @if($customer_package != null)
                                                <div class="form-box-content p-2 category-widget text-center">
                                                    <center><img alt="Package Logo" src="{{ my_asset($customer_package->logo) }}" style="height:100px; width:90px;"></center>
                                                    <br>
                                                    <left> <strong><p>{{ translate('Product Upload') }}: {{ $customer_package->product_upload }} {{ translate('Times')}}</p></strong></left>
                                                    <strong><p>{{ translate('Product Upload Remaining') }}: {{ Auth::user()->remaining_uploads }} {{ translate('Times')}}</p></strong>
                                                    <strong><p><div class="name mb-0">{{ translate('Current Package') }}: {{ $customer_package->name }} <span class="ml-2"><i class="fa fa-check-circle" style="color:green"></i></span></div></p></strong>
                                                </div>
                                            @else
                                                <div class="form-box-content p-2 category-widget text-center">
                                                    <center><strong><p>{{ translate('Package Not Found')}}</p></strong></center>
                                                </div>
                                            @endif
                                            <div class="text-center">
                                                <a href="{{ route('customer_packages_list_show') }}" class="btn btn-styled btn-base-1 btn-outline btn-sm">{{ translate('Upgrade Package')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>--}}

                    <section class="section-akun-profil">
                    @if(Auth::user()->addresses != null)
                        @php
                            $address = Auth::user()->addresses
                        @endphp
                        
                            <!-- <div class="container"> -->
                                <div class="row">
                                    <div class="col">
                                        <div class="card">
                                            <div class="card-header  bg-transparent mb-0">
                                                <div class="row align-items-center">
                                                    <div class="col-lg-6 col-md-4 col-sm-4 col-6 p-3">
                                                        <span class="head-card-akun__ address-user">Alamat Saya</span>
                                                    </div>
                                                    <div class="col-lg-6 col-md-4 col-sm-4 col-6 text-right">
                                                        <a href="#" onclick="add_new_address()"><i style="color:#007bff;font-size:17px" class="fa fa-plus mr-1"></i> <span style="color:#007bff;font-size:17px" class="add-alamat-profil__">Tambah Alamat Baru</span></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body mx-4 px-0 pt-0 mb-2" id="all-address">
                                                @foreach (Auth::user()->addresses as $key => $address)
                                                        <div class="border-bottom row py-3">
                                                            <div class="col-lg-9 col-md-9 col-sm-9 head-akuku-profil__ ">
                                                                <div class="name-alamat-akun__ address-user">
                                                                    <span>{{ $address->receiver }}</span>
                                                                </div>
                                                                <div class="alamat-alamat-akun__ address-user">
                                                                    <span>{{$address->address}}</span>
                                                                </div>
                                                                <div class="alamat-alamat-akun__ address-user">
                                                                    <span>{{$address->province}}, {{$address->city}}, {{$address->subdistrict}}, {{ $address->postal_code }}</span>
                                                                </div>
                                                                <div class="alamat-alamat-akun__ address-user">
                                                                    <span>{{$address->phone}}</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-sm-3 text-right pt-3 pt-lg-0">
                                                                <div class="justify-content-start mb-2 mb-lg-3">
                                                                    <a id="setDefault" data-key="{{$key+1}}" href="{{ route('addresses.set_default', $address->id) }}" class="btn {{ $address->set_default == 1 ? 'btn-default' : 'btn-secondary'}}">Utama</a>
                                                                </div>
                                                                <div class="justify-content-end">
                                                                    <a href="{{route('addresses.destroy', $address->id)}}"class="text-secondary"><i style="font-size:24px" class="fa fa-trash mr-3"></i></a>
                                                                    <a id="btnedit" data-value="{{ json_encode($address) }}" href="#" class="text-secondary"><i style="font-size:24px" class="fa fa-edit"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                @endforeach                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- </div> -->
                    @endif
                    </section>

                </div>
            </div>
        </div>
    </section>


<div class="modal fade" id="new-address-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">{{ translate('New Address')}}</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-default" role="form" action="{{ route('addresses.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <input type="hidden" name="lat">
                <input type="hidden" name="lng">
                <div class="modal-body">
                    <div class="p-3">
                        <div class="form-group">
                            <input id="pac-input"  class="controls" type="text" placeholder="Cari Lokasi" hidden>
                            <div id="map" style="width: 100%;height: 350px;top: 8;font-size: 16pt;"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Provinsi')}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-3" placeholder="{{ translate('Provinsi')}}" name="province" id="provinsi"  value="" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Kota/Kabupaten')}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-3" placeholder="{{ translate('Kota/Kabupaten')}}" name="city" id="Kota" value="" readonly>
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Kecamatan')}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-3" placeholder="{{ translate('Kecamatan')}}" name="subdistrict" id="kecamatan" value="" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Kode Pos')}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-3" placeholder="{{ translate('Your Postal Code')}}" id="kode_pos_alamat" name="postal_code" value="" required>
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
                                <label>{{ translate('Nomor telepone')}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-3" placeholder="Nomor telepon penerima" name="phone" value="" id="phone" required>
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Detail Alamat')}}</label>
                            </div>
                            <div class="col-md-10">
                                <textarea class="form-control textarea-autogrow mb-3" placeholder="{{ translate('detail alamat Pengiriman')}}" rows="3" name="address" id="txtaddress" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-base-1">{{  translate('Simpan') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
    
@endsection
@section('script')

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
                        $('#provinsi').val(value.long_name);
                    }else if(value.types[0] == "administrative_area_level_2"){
                        $('#Kota').val(value.long_name);
                    }else if(value.types[0] == "administrative_area_level_3"){
                        $('#kecamatan').val(value.long_name);
                    }else if(value.types[0] === "postal_code"){
                        $('#kode_pos_alamat').val(value.long_name);
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

       
        marker.setPosition(mapsMouseEvent.latLng);
        $('input[name="lat"]').val(mapsMouseEvent.latLng.lat());
        $('input[name="lng"]').val(mapsMouseEvent.latLng.lng());
        getAddress(mapsMouseEvent.latLng.lat(),mapsMouseEvent.latLng.lng()).then(function(result){
            var place = result['address_components'];
            $('#kode_pos_alamat').val("");
            $.each(place,function(index,value){
                // console.log(value);
                if(value.types[0] == "administrative_area_level_1"){
                    $('#provinsi').val(value.long_name);
                }else if(value.types[0] == "administrative_area_level_2"){
                    $('#Kota').val(value.long_name);
                }else if(value.types[0] == "administrative_area_level_3"){
                    $('#kecamatan').val(value.long_name);
                }else if(value.types[0] === "postal_code"){
                    $('#kode_pos_alamat').val(value.long_name);
                }
            });
        });
       
    });
   
    setsearchbox(map,marker);
}
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
                    $('#provinsi').val(value.long_name);
                }else if(value.types[0] == "administrative_area_level_2"){
                    $('#Kota').val(value.long_name);
                }else if(value.types[0] == "administrative_area_level_3"){
                    $('#kecamatan').val(value.long_name);
                }else if(value.types[0] === "postal_code"){
                    $('#kode_pos_alamat').val(value.long_name);
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
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_API') }}&libraries=drawing,places&callback=initMap" async defer></script>
<script>
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
</script>

<script type="text/javascript">

    $(document).ready(function () {
            // getProvince();
        $("#new-address-modal").on('hidden.bs.modal', function (e) {
            clearFA()
            $("#exampleModalLabel").html("New Address")
            $("#city_id").val("0")
        })

        $("#all-address").on("click","#btnedit", function (e) {
            console.log(data)
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
        })

        $("#update-fa").click(function (e) {
            e.preventDefault()
            let id = $("#add-id").val()
            let province = {id: $("#selectprovince").val(), province: $("#selectprovince :selected").text()}
            province = JSON.stringify(province)
            let city = {id: $("#selectcity").val(), city: $("#selectcity :selected").text()}
            city = JSON.stringify(city)
            let subdistrict = {id: $("#selectsubdistrict").val(), subdistrict: $("#selectsubdistrict :selected").text()}
            subdistrict = JSON.stringify(subdistrict)
            let update = {
                _token:"{{csrf_token()}}",
                address:$("#txtaddress").val(),
                phone:$("#fieldphone").val(),
                receiver:$("#fieldreceiver").val(),
                city: city,
                subdistrict: subdistrict,
                postal_code:$("#fieldpostalcode").val(),
                province: province
            }
            $.ajax({
                url:"{{route('addresses.update', 'addid')}}".replace('addid',id),
                type:'put',
                data:update,
                success:function (data) {
                    if (data == "sukses") {
                        location.reload()
                    }
                }
            })
        })

        

        

        $(document).on("click", "#setDefault", function (e) {
            e.preventDefault()
            let key = $(this).data("key")
            let urL = $(this).attr("href")
            let setDefault = $("#all-address #setDefault")
            setDefault.removeClass("btn-default")
            setDefault.addClass("btn-secondary")
            let setthis = $(this)
            $.get(urL,function (data) {
                if (data[1] == "sukses") {
                    showFrontendAlert("success",data[0])
                    $("#defaulted"+key).html('')
                    setthis.removeClass("btn-secondary")
                    setthis.addClass("btn-default")
                }else{
                    showFrontendAlert("danger",data[0])
                }
            })
        })
    })

    function getCity(id) {
        $("#select_city").hide()
        $.get("{{route('addresses.get_city','idct')}}".replace('idct',id),function (data) {
            let city = ''
            let postcode = ''
            let selected = $("#city_id").val()
            
            data.forEach(el => {
                city += `<option value="`+el.city_id+`" >`+el.type+` `+el.city_name+`</option>`
                // city += `<option value="`+el.city_id+`" `+elselected+`>`+el.type+` `+el.city_name+`</option>`
                postcode += '<input type="hidden" id="postalcode-'+el.city_id+'" value="'+el.postal_code+'">'
            });
            $("#selectcity").html(city)
            $("#div-postcode").html(postcode)
            $("#selectcity").val(selected).change()
            $("#select_city").show()

        })
    }

    function getSubDistrict(id) {
        $("#select_subdistrict").hide()  
        $.get("{{route('addresses.get_subDistrict','idsd')}}".replace('idsd',id),function (data) {
            let subdistrict = ''
            let selected = $("#subdistrict_id").val()

            data.forEach(el => {
                if (selected != "0") {
                    elselected = ""
                    if (el.subdistrict_id == selected) {
                        var elselected = "selected"
                    }
                }

                subdistrict += `<option value="`+el.subdistrict_id+`" `+elselected+`>`+el.subdistrict_name+`</option>`
            });
            $("#selectsubdistrict").html(subdistrict)
            $("#select_subdistrict").show()
        })
    }

    function add_new_address(){
        $('#new-address-modal').modal('show');
        $("#submit-fa").show()
        $("#update-fa").hide()
    }

    function clearFA() {
        $("#txtaddress").html("")
        $("#fieldphone").val("")
        $("#fieldpostalcode").val("")
        $("#selectprovince").val("0").change()
        $("#selectcity").val("0").change()
    }

    $('.new-email-verification').on('click', function() {
        $(this).find('.loading').removeClass('d-none');
        $(this).find('.default').addClass('d-none');
        var email = $("input[name=email]").val();

        $.post('{{ route('user.new.verify') }}', {_token:'{{ csrf_token() }}', email: email}, function(data){
            data = JSON.parse(data);
            $('.default').removeClass('d-none');
            $('.loading').addClass('d-none');
            if(data.status == 2)
                showFrontendAlert('warning', data.message);
            else if(data.status == 1)
                showFrontendAlert('success', data.message);
            else
                showFrontendAlert('danger', data.message);
        });
    });
</script>
@endsection
