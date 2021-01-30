@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-body">
                    <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th width="20%">{{__('Nama')}}</th>
                                <th>{{__('Poin')}}</th>
                                <th>{{__('Ubah Status')}}</th>
                                <th>{{__('Diperoleh Pada')}}</th>
                                <th width="10%">{{__('Pilihan')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($club_points as $key => $club_point)
                                <tr>
                                    <td>{{ ($key+1) + ($club_points->currentPage() - 1)*$club_points->perPage() }}</td>
                                    @if ($club_point->user != null)
                                        <td>{{ $club_point->user->name }}</td>
                                    @else
                                    <td>-</td>
                                    @endif
                                    <td>{{ $club_point->points }}</td>
                                    <td>
                                        @if ($club_point->convert_status == 1)
                                            <div class="label label-table label-info">
                                                {{__('Dikonversi')}}
                                            </div>
                                        @else
                                            <div class="label label-table label-info">
                                                {{__('Pending')}}
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $club_point->created_at }}</td>
                                    <td>
                                        <div class="btn-group dropdown">
                                            <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                                {{__('Aksi')}} <i class="dropdown-caret"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="{{route('club_point.details', encrypt($club_point->id))}}">{{__('Tampilan')}}</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="clearfix">
                        <div class="pull-right">
                            {{ $club_points->appends(request()->input())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
