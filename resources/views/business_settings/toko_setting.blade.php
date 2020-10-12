@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title text-center">{{__('Lokasi Asal Pengiriman')}}</h3>
            </div>
            <form action="{{ route('toko_setup_store') }}" method="post">
            @csrf
            <input type="hidden" name="lat">
            <input type="hidden" name="lng">
            <div class="panel-body">
                <div class="form-group">
                    <input id="pac-input"  class="controls" type="text" placeholder="Cari Lokasi" hidden>
                    <div id="map" style="width: 100%;height: 350px;top: 8;font-size: 16pt;"></div>
                </div>
                <div class="form-group">
                    <div class="col-lg-12 text-right">
                        <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
                    </div>
                </div>
            </div>
            <form>
        </div>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
var drawingManager;
var lat =  parseFloat('{{ env('SWIFT_ORIGIN_LAT') }}');
var lng =  parseFloat('{{ env('SWIFT_ORIGIN_LNG') }}');
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
    @if(env('SWIFT_ORIGIN_LAT', false) == false)
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
                // console.log(result)
                // return
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
    @endif


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
<script type="text/javascript">
$(document).ready(function(){

   

});
</script>

@endsection



