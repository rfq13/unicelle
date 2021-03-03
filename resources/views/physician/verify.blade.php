
@extends('layouts.app')

@section('content')
<style>
    .img-center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 80%;
}
</style>
<br>
<div class="row">
    {{-- <div class="col-lg-8"> --}}
        <div class="col">
        <div class="panel">
            <div class="panel-heading bord-btm clearfix pad-all h-100">
                <h3 class="panel-title pull-left pad-no">{{translate('Member Dokter')}}</h3>
                <div class="pull-right clearfix">
                <form class="" id="sort_users" action="" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="select" style="min-width: 300px;">
                        <select class="form-control demo-select2" name="user_type" id="user_type" onchange="sort_users()">
                            <option value="">{{translate('Filter Berdasarkan Type User')}}</option>
                            <option value="partner physician"  @isset($user_type) @if($user_type == 'partner physician') selected @endif @endisset>{{translate('Partner Physician')}}</option>
                            <option value="regular physician"  @isset($user_type) @if($user_type == 'regular physician') selected @endif @endisset>{{translate('Regular Physician')}}</option>
                        </select>
                    </div>
                </div>
                <div class="box-inline pad-rgt pull-left">
                    <div class="select" style="min-width: 300px;">
                        <select class="form-control demo-select2" name="sort_by" id="sort_by" onchange="sort_users()">
                            <option value="">{{translate('Urutkan')}}</option>
                            <option value="terbaru"  @isset($sort_by) @if($sort_by == 'terbaru') selected @endif @endisset>{{translate('Terbaru')}}</option>
                            <option value="terlama"  @isset($sort_by) @if($sort_by == 'terlama') selected @endif @endisset>{{translate('Terlama')}}</option>
                        </select>
                    </div>
                </div>
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="sort_search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Ketik Nama/Email') }}">
                    </div>
                </div>
                </form>
                </div>
            </div>
            <div class="panel-body" id="panel-body">
                <table class="table res-table table-responsive mar-no" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{translate('Nama')}}</th>
                            <th>{{translate('Email')}}</th>
                            <th>{{translate('Telepon')}}</th>
                            <th class="text-center">{{ translate('Diverifikasi') }}</th>
                            <th width="10%" style="text-right">{{translate('Opsi')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $key => $user)
                            <tr id="row{{$user->id}}">
                                <td>{{ ($key+1) + ($users->currentPage() - 1)*$users->perPage() }}</td>
                                <td>
                                    <span id="title">{{isset($user->user) ? $user->user->name :""}}</span>
                                </td>
                                <td>
                                    <span id="title">{{isset($user->user) ? $user->user->email :""}}</span>
                                </td>
                                <td>
                                    <span id="title">{{isset($user->user) ? $user->user->phone :""}}</span>
                                </td>
                                @php
                                $check_email=null;
                                if(isset($user->user)){
                                    $check_email=$user->user->email_verified_at;
                                }
                                
                                @endphp
                                <td class="text-center" id="verifiedat{{ $user->id }}">
                                @if($check_email != null)
                                    {{ isset($user->user) ? $user->user->email_verified_at : ""}}
                                @else 
                                    <span style="background-color:#ec4646" class="badge badge--2 mr-4">
                                        <i class="bg-red">{{ translate('User belum verifikasi email') }}</i>
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group dropdown">
                                        <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                            {{translate('Aksi')}} <i class="dropdown-caret"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a id="btnEdit{{$user->id}}" {{$user->verify == 0 ? "" : 'class="btn btn-danger"'}} href="#" onclick=" 
                                                @if($user->user != null) 
                                                    activation(event,{{$user->id}})
                                                @else 
                                                    showAlert('danger','user tidak ditemukan') 
                                                @endif">
                                                    {{$user->verify == 0 ? translate('Aktifkan') : translate('Nonaktifkan')}}
                                                </a>
                                            </li>
                                            <li>
                                                <a onclick="confirm_modal(`{{route('admin.usermember.destroy', $user->id)}}`);">{{translate('Hapus')}}</a>
                                            </li>
                                            <li><a href="#" id="btnDetail" onclick="@if($user->user != null) detail({{ json_encode($user->user) }},{{ json_encode($user->user->instansi) }})@else showAlert('danger','user tidak ditemukan') @endif">Detail</a></li>
                                            <li><a href="{{route('physician.edit', $user->user_id)}}">{{translate('Edit')}}</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="clearfix">
                    <div class="pull-right">
                        {{$users->appends(request()->input())->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-lg-4">
        @include("Member.create")
    </div> --}}
</div>

<div class="modal fade bd-example-modal-lg" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-body">
            <div class="container-fluid" style="margin-top: 25px">
                <h3>Detail Dokter</h3>
              <div class="row" id="row-image" style="margin-top: 55px">
                  <img src="https://www.publicdomainpictures.net/pictures/320000/velka/background-image.png"  class="img-center" alt="...">
              </div>
              <div class="row">
                  <div class="container panel panel-body" style="width: 840px">
                      <form>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="input-nama">Nama</label>
                              <input type="text" class="form-control" id="input-nama" placeholder="Nama">
                            </div>
                            <div class="form-group col-md-6">
                              <label for="input-email">Email</label>
                              <input type="email" class="form-control" id="input-email" placeholder="Email">
                            </div>
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="input-alamat">Alamat</label>
                              <input type="text" class="form-control" id="input-alamat" placeholder="alamat">
                            </div>
                            <div class="form-group col-md-6">
                            <label for="input-notelp">no.Telp</label>
                            <input type="text" class="form-control" id="input-notelp" placeholder="Nomor telephone">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="input-izin">Izin</label>
                            <input type="number" min="0" class="form-control" id="input-izin" placeholder="">
                          </div>
                      </form>
                  </div>
              </div>
            </div>
          </div>
    </div>
  </div>
</div


@endsection


@section('script')
    <script type="text/javascript">
        $('#btnDetail').click(function(e){
            e.preventDefault()
        })
        function sort_users(el){
            $('#sort_users').submit();
        }
        function detail(dokter,instansi){
            let src = "{{ my_asset('potro') }}".replace('potro',instansi.fhoto)
            console.log(dokter)
            $("#input-nama").val(dokter.name)
            $("#input-email").val(dokter.email)
            $("#input-izin").val(instansi.izin)
            $("#input-instansi").val(instansi.name)
            $("#input-alamat").val(instansi.address)
            $("#input-notelp").val(dokter.phone)
            $("#row-image").html(`<img src="`+src+`"  class="img-center" alt="...">`)
            $("#modal-detail").modal('show')
        }


        function activation(e,id) {
            e.preventDefault()
          $.get("{{route('physician.activation','upid')}}".replace('upid',id), function (dat) {
            if (dat.stts=="sukses") {
              showAlert("success",`${dat.msg}`)
              $("#btnEdit"+id).text(dat.btn)
              if(dat.btn == "Nonaktifkan") $("#verifiedat"+id).html(dat.time);
            }
          })
        }
    </script>
@endsection
