@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <a href="{{ route('pages.create')}}" class="btn btn-rounded btn-info pull-right">{{translate('Tambah Halaman Baru')}}</a>
        </div>
    </div>

    <br>

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{translate('Halaman Kustom')}}</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width="10%">#</th>
                        <th>{{translate('Judul')}}</th>
                        <th>{{translate('Slug')}}</th>
                        <th width="10%">{{translate('Pilihan')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pages as $key => $page)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$page->title}}</td>
                            <td>{{ route('custom-pages.show_custom_page', $page->slug) }}</td>
                            <td>
                                <div class="btn-group dropdown">
                                    <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                        {{translate('Aksi')}} <i class="dropdown-caret"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="{{route('pages.edit', $page->slug)}}">{{translate('Edit')}}</a></li>
                                        <li><a onclick="confirm_modal('{{route('pages.destroy', $page->id)}}');">{{translate('Hapus')}}</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
