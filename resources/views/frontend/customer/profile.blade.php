@php
   //dd($listProvince);
   $listProvince = app('App\Http\Controllers\AddressController')->get_province();
@endphp
@extends('frontend.layouts.app')

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-4 d-none d-lg-block">
                    <div class="card mr-2">
                    @if(Auth::user()->user_type == 'seller')
                        @include('frontend.inc.seller_side_nav')
                    @else
                        @include('frontend.inc.customer_side_nav')
                    @endif
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header bg-transparent ">
                            <div class="p-3">
                                <span class="head-card-akun__">Profil</span>
                            </div>
                        </div>
                        <div class="card-body mx-4 px-0">
                            <form id="update-profile" action="{{ route('customer.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="d-flex head-akuku-profil__ align-items-center ">
                                    <div class="img-akun__ widget-profile-box mr-3">
                                        @if (Auth::user()->avatar_original != null)
                                            <div class="image" style="background-image:url('{{ my_asset(Auth::user()->avatar_original) }}')"></div>
                                        @else
                                            <img src="{{ my_asset('frontend/images/user.png') }}" class="image rounded-circle">
                                        @endif
                                    </div>
                                    <div class="text-choose">
                                            <div class="form-group m-0">
                                                <input type="file" name="photo" class="form-control-file">
                                                <p class="commend-sz-img mt-2">Ukuran gambar: maks. 1 MB
                                                    Format gambar: .JPEG, .PNG</p>
                                            </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="form-group row">
                                        <label for="inputnama__" class="col-sm-3 col-form-label text-right pr-4">Nama</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" placeholder="{{ translate('Your Name') }}" name="name" value="{{ Auth::user()->name }}" id="inputnama__">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-3 col-form-label text-right pr-4">Jenis
                                            Kelamin</label>
                                        <div class="form-check form-check-inline col-sm-3 pl-3">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="1" {{Auth::user()->gender == 1 ? "checked":''}}  required>
                                            <label class="form-check-label" for="inlineRadio1">Laki-Laki</label>
                                        </div>
                                        <div class="form-check form-check-inline col-sm-4">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="2" {{Auth::user()->gender == 2 ? "checked":''}} required>
                                            <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label text-right pr-4">Tanggal Lahir</label>
                                        <div class="col-sm-9">
                                            <input type="hidden" class="dropdate" name="birth" id="birth" value="{{Auth::user()->birth}}">
                                            <!-- 
                                                        <select class="custom-select my-1"  id="date">
                                                        <option selected="">Hari</option>
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
                                                        <option selected="">Bulan</option>
                                                        <option value="1">One</option>
                                                        <option value="2">Two</option>
                                                        <option value="3">Three</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3 ">
                                                    <select class="custom-select my-1 mr-sm-2 w-100" id="inlineFormCustomSelectPref">
                                                        <option selected="">Tahun</option>
                                                        <option value="1">One</option>
                                                        <option value="2">Two</option>
                                                        <option value="3">Three</option>
                                                    </select>
                                            -->
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputemail__" class="col-sm-3 col-form-label text-right pr-4">Email</label>
                                        <div class="col-sm-9 mt-2">
                                            @if (Auth::user()->email == null)
                                            <input type="email" name="email" class="form-control" id="inputemail__" value="{{Auth::user()->email}}" autocomplete="off">
                                            @else
                                            <span>{{ Auth::user()->email }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputpassword__" class="col-sm-3 col-form-label text-right pr-4">Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" name="password" class="form-control" id="inputpassword__">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputnama__" class="col-sm-3 col-form-label text-right pr-4">Telepon</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" placeholder="{{ translate('No Telepon') }}" name="phone" value="{{ Auth::user()->phone }}" id="inputnomor__">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-3">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div class="modal fade" id="new-address-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-zoom" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{ translate('New Address') }}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-default" id="form_address" role="form" action="{{ route('addresses.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="add-id">
                        <div class="p-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <label>{{ translate('Address') }}</label>
                                </div>
                                <div class="col-md-10">
                                    <textarea class="form-control textarea-autogrow mb-3" id="txtaddress" placeholder="{{ translate('Your Address') }}" rows="1" name="address" required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label>{{ translate('Province') }}</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="mb-3">
                                        <select class="form-control mb-3 selectpicker" id="selectprovince" data-placeholder="{{translate('Select your province')}}" name="province" required>
                                                <option value="0" disabled>province</option>
                                                {{-- @foreach($listProvince->original as $key => $value)
                                                <option value="{{$value->province_id}}">{{$value->province}}</option>
                                                @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label>{{ translate('City') }}</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="mb-3">
                                        <div id="select_city">
                                            <input type="hidden" id="city_id" value="0">
                                            <select class="form-control mb-3 selectpicker" id="selectcity" data-placeholder="{{translate('Select your city')}}" name="city" required>
                                                    <option value="0" disabled>city</option>
                                            </select>
                                        </div>
                                        <!-- <a href="#" id="btncity" class="btn btn-primary" data-id="city-id"></a> -->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label>{{ translate('Postal code')}}</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="number" class="form-control mb-3" id="fieldpostalcode" disabled placeholder="{{ translate('Your Postal Code')}}" name="postal_code" value="" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label>{{ translate('Phone')}}</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="number" class="form-control mb-3" id="fieldphone" placeholder="{{ translate('Your phone number')}}" name="phone" value="" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="display:none" id="div-postcode"></div>
                    <div class="modal-footer">
                        <button type="submit" id="submit-fa" class="btn btn-base-1">{{  translate('Save') }}</button>
                        <a id="update-fa" style="display:none" class="btn btn-success">{{  translate('Update') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script src="{{my_asset('js/jdd.min.js')}}"></script>
<script type="text/javascript">
    $(function () {
        $("#birth").dropdownDatepicker({
            dayLabel:'Hari',
            monthLabel:'Bulan',
            yearLabel:'Tahun',
            defaultDateFormat:'dd-mm-yyyy',
            displayFormat:'dmy',
            submitFormat:'yyyy-mm-dd',
            monthLongValues: ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
            wrapperClass:'date-dropdowns',
            dropdownClass:null,
            daySuffixes:false,
            monthSuffixes:true,
            required:true,
            sortYear:'asc'

        });
    })
</script>
<script type="text/javascript">

    $(document).ready(function () {
        
        $(".year").addClass("custom-select my-1").css("width","150px")
        $(".month").addClass("custom-select my-1").css("width","150px").css("margin-right","25px")
        $(".day").addClass("custom-select my-1").css("width","150px").css("margin-right","27px")

        $("#new-address-modal").on('hidden.bs.modal', function (e) {
            clearFA()
            $("#exampleModalLabel").html("New Address")
            $("#city_id").val("0")
        })

        $("#all-address").on("click","#btnedit", function (e) {
            e.preventDefault()

            let titleCity = $(this).data("title-city")
            let id = $(this).data("city")
            $("#city_id").val(id)

            let postalCode = $(this).data("postal-code")
            let phone = $(this).data("phone")
            let province = $(this).data("province")
            let address = $(this).data("address")
            let addid = $(this).data("addid")

            $("#txtaddress").html(address)
            $("#fieldphone").val(phone)
            $("#fieldpostalcode").val(postalCode)
            $("#add-id").val(addid)
            $("#selectprovince").val(province).change()
            $("#submit-fa").hide()
            $("#update-fa").show()
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
            let update = {
                _token:"{{csrf_token()}}",
                address:$("#txtaddress").val(),
                phone:$("#fieldphone").val(),
                city: city,
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

        $("#selectprovince").change(function () {
            let id = $(this).val()
            if (id != null) {
                getCity(id)
            }
        })

        $("#selectcity").change(function () {
            let id = $(this).val()
            let postcode = $("#postalcode-"+id).val()
            $("#fieldpostalcode").val(postcode)
            // console.log(postcode)
        })

        $(document).on("click", "#setDefault", function (e) {
            e.preventDefault()
            $("#all-address #defaulted").html("")
            let key = $(this).data("key")
            let urL = $(this).attr("href")
            let setthis = $(this)
            $.get(urL,function (data) {
                // if (data == "removed") {
                //     showFrontendAlert("success","Default address has removed")
                //     setthis.show()
                // }else{
                //     showFrontendAlert("success","Default address added successfully")
                //     setthis.hide()
                //     $("#card"+key+" #defaulted").html(`
                //         <div class="position-absolute right-0 bottom-0 pr-2 pb-3">
                //             <span class="badge badge-primary bg-base-1">{{ translate('Default') }}</span>
                //         </div>
                //     `)
                // }
                // console.log(data)
                if (data == "sukses") {
                    location.reload()
                }
            })
        })
    })

    function getCity(id) {  
        $.get("{{route('addresses.get_city','idct')}}".replace('idct',id),function (data) {
            let city = ''
            let postcode = ''
            let selected = $("#city_id").val()
            data = JSON.parse(data)
            data.forEach(el => {
                if (selected != "0") {
                    elselected = ""
                    if (el.city_id == selected) {
                        var elselected = "selected"
                        $("#fieldpostalcode").val(el.postal_code)
                    }
                }

                city += `<option value="`+el.city_id+`" `+elselected+`>`+el.type+` `+el.city_name+`</option>`
                postcode += '<input type="hidden" id="postalcode-'+el.city_id+'" value="'+el.postal_code+'">'
            });
            $("#selectcity").html(city)
            $("#div-postcode").html(postcode)

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
