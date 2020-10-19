
@extends('layouts.app')

@section('content')

<br>
<div class="row">
    <div class="col-lg-8">
        <div class="panel">
            <div class="panel-heading bord-btm clearfix pad-all h-100">
                <h3 class="panel-title pull-left pad-no">{{translate('Member Dokter Reguler')}}</h3>
                <div class="pull-right clearfix">
                    <form class="" id="sort_flash_deals" action="" method="GET">
                        <div class="box-inline pad-rgt pull-left">
                            <div class="" style="min-width: 200px;">
                                <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type name & Enter') }}">
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
                            <th class="text-center">{{ translate('Diverifikasi') }}</th>
                            <th width="10%" style="text-right">{{translate('Opsi')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $users = \App\physician_verificationModel::with(["user"=> function ($u)
                            {
                              $u->where("email_verified_at","!=",null);
                            }])->paginate(10);
                            // dd($users);
                        @endphp
                        @foreach($users as $key => $user)
                            <tr id="row{{$user->id}}">
                                <td>{{ ($key+1) + ($users->currentPage() - 1)*$users->perPage() }}</td>
                                <td>
                                    <span id="title">{{isset($user->user) ? $user->user->name :""}}</span>
                                </td>
                                <td class="text-center">{{ isset($user->user) ? $user->user->email_verified_at :""}}</td>
                                <td>
                                    <div class="btn-group dropdown">
                                        <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                            {{translate('Aksi')}} <i class="dropdown-caret"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a id="btnEdit{{$user->id}}" {{$user->verify == 0 ? "" : 'class="btn btn-danger"'}} href="#" onclick="activation({{$user->id}})">
                                                    {{$user->verify == 0 ? translate('Aktifkan') : translate('Nonaktifkan')}}
                                                </a>
                                            </li>
                                            <li>
                                                <a onclick="confirm_modal(`{{route('admin.usermember.destroy', $user->id)}}`);" style="background-color:#428df5;color:white">{{translate('Hapus')}}</a>
                                            </li>
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
    <div class="col-lg-4">
        @include("Member.create")
    </div>
</div>

<!-- Basic Data Tables -->
<!--===================================================-->


@endsection


@section('script')
    <script type="text/javascript">
        
        function activation(id) {
          $.get("{{route('physician.activation','id')}}".replace('id',id), function (dat) {
            if (dat.stts=="sukses") {
              showAlert("success",`${dat.msg}`)
              $("#btnEdit"+id).text(dat.btn)
            }
          })
        }
    </script>
@endsection
