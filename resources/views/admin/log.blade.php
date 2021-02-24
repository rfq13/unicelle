@extends('layouts.app')

@section('content')




<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{translate('Log Admin')}}</h3>
        <div class="pull-right clearfix">
            <form class="" id="sort_categories" action="" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Ketik') }}">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
        <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Waktu')}}</th>
                    <th>{{__('Admin')}}</th>
                    <th>{{__('Aktivitas')}}</th>
                    <th>{{__('Nomor Pesanan')}}</th>
                    <th>{{__('Konsumen')}}</th>

                </tr>
            </thead>
            <tbody>

                @foreach($logs as $key => $detail)

                    <tr>
                        <td>{{ ($key+1) + ($logs->currentPage() - 1)*$logs->perPage() }}</td>
                        <td>{{ date('Y-m-d H:i:s', strtotime($detail->created_at)) }}</td>
                         <td>{{__($detail->user->name)}}</td>
                         <td>{{__($detail->event)}}</td>
                         <td>{{__($detail->order_id)}}</td>
                         <td>{{__($detail->konsumen)}}</td>

                        
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
            {{ $logs->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>

@endsection

