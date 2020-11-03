@php
    // dd($refferal_users);
@endphp
@extends('layouts.app')

@section('content')
    <!-- Basic Data Tables -->
    <!--===================================================-->
    <div class="panel">
        <div class="panel-heading bord-btm clearfix pad-all h-100">
            <h3 class="panel-title pull-left pad-no">{{__('Refferal Users')}}</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Nama')}}</th>
                    <th>{{__('No. Telepon')}}</th>
                    <th>{{__('Alamat Email')}}</th>
                    <th>{{__('Rujukan Oleh')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($refferal_users as $key => $refferal_user)
                    @if ($refferal_user != null)
                        <tr>
                            <td>{{ ($key+1) + ($refferal_users->currentPage() - 1)*$refferal_users->perPage() }}</td>
                            <td>{{$refferal_user->name}}</td>
                            <td><cite style="color:#909090">{{$refferal_user->phone != null ? $refferal_user->phone : "kosong"}}</cite></td>
                            <td>{{$refferal_user->email}}</td>
                            <td>
                                @if (\App\User::find($refferal_user->referred_by) != null)
                                    {{ \App\User::find($refferal_user->referred_by)->name }} ({{ \App\User::find($refferal_user->referred_by)->email }})
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
            <div class="clearfix">
                <div class="pull-right">
                    {{ $refferal_users->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
