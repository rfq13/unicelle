@extends('layouts.app')

@section('content')

    <div class="pad-all text-center">
        <form class="" action="{{ route('seller_sale_report.index') }}" method="GET">
            <div class="box-inline mar-btm pad-rgt">
                 {{ translate('Urutkan berdasarkan status verifikasi') }}:
                 <div class="select">
                     <select class="demo-select2" name="verification_status" required>
                        <option value="1">{{ translate('Disetujui') }}</option>
                        <option value="0">{{ translate('Tidak Disetujui') }}</option>
                     </select>
                 </div>
            </div>
            <button class="btn btn-default" type="submit">{{ translate('Filter') }}</button>
        </form>
    </div>


    <div class="col-md">
        <div class="panel">
            <div class="panel-body">
                <p>
                    <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                      Atur Banner Blog
                    </a>
                </p>
                  <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        @php
                            $id = isset($banner)? $banner->id : "id";
                        @endphp
                      <form action="{{ route('update.banner',$id) }}" method="post" enctype="multipart/form-data">
                          @method('put')
                          @csrf
                          <input type="file" name="banner" id="banner-blog" data-default-file="{{ isset($banner)? my_asset($banner->photo) : "" }}">
                          <button type="submit" class="btn" style="background-color:#ffcc00;color:whitesmoke;float:right;margin-top:2%">simpan</button>
                      </form>
                    </div>
                  </div>
            </div>
        </div>
        <div class="panel">
            <!--Panel heading-->
            <div class="panel-heading">
                <h3 class="panel-title">{{ translate('Blog') }}</h3>
            </div>

            <!--Panel body-->
            <div class="panel-body">
                <div class="table-responsive">
                    <a href="{{ route('blog.create') }}" class="btn btn-primary" style="float: right;margin:5px"><i class="fa fa-pencil-square-o"></i> Tulis Blog</a><br>
                    <table class="table table-striped mar-no demo-dt-basic">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ translate('Judul') }}</th>
                                <th>{{ translate('Thumbnail') }}</th>
                                <th>{{ translate('Dilihat') }}</th>
                                <th>{{ translate('Tampil') }}</th>
                                <th>{{ translate('Aksi') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blogs as $key => $blog)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $blog->title }}</td>
                                    <td><img src="{{ my_asset($blog->thumbnail) }}" width="60%" alt="" srcset=""></td>
                                    <td>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="switch">
                                              <input type="checkbox" id="visible" data-id="{{ $blog->id }}" name="visible" value="1" {{ $blog->visible == 1 ? "checked" : "" }}>
                                              <span class="slider round"></span>
                                            </label>
                                          </div>
                                    </td>
                                    <td>
                                        <div class="btn-group dropdown">
                                            <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                                {{translate('Aksi')}} <i class="dropdown-caret"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="{{route('blog.edit', encrypt($blog->id))}}">{{translate('Edit')}}</a></li>
                                                <li><a onclick="confirm_modal('{{route('blog.destroy', encrypt($blog->id))}}');">{{translate('Hapus')}}</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $('#banner-blog').dropify({
            messages: {
                'default': 'Drag and drop gambar',
                'replace': 'Drag and drop atau click untuk mengubah gambar',
                'remove':  'Hapus',
                'error':   'Ooops, ada kesalahan.'
            },

            error: {
                'imageFormat': 'Hanya mendukung format gambar "jpg" "png" "jpeg".'
            }
        });
        $(document).ready(function () {
            $(".panel-body #visible").change(function () {
                let id = $(this).data('id')
                let value = $(this).is(':checked') ? 1 : 0;
                let data = {
                    _token: "{{ csrf_token() }}",
                    visible: value
                }
                $.post("{{ route('blog.update-visib','vsb') }}".replace('vsb',id),data,function (data) {
                    if (data == "success") {
                        showAlert('success','berhasil update data')
                    }
                })
            })
        })
    </script>
@endsection
