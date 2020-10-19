@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-8 col-lg-offset-2">
        <div class="panel">
            <div class="panel-heading bord-btm">
                <h3 class="panel-title">{{translate('Buat Halaman Kustom')}}</h3>
            </div>

            <!--Horizontal Form-->
            <!--===================================================-->
            <form class="form-horizontal" action="{{ route('pages.store') }}" method="POST" enctype="multipart/form-data">
            	@csrf
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="title">{{translate('Judul')}}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{translate('Judul')}}" id="title" name="title" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="slug">{{translate('Slug')}}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{translate('your-slug')}}" id="slug" name="slug" class="form-control" required>
                            <small><code>http://domain.com/your-slug</code> Only a-z, numbers, hypen allowed</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="content">{{translate('Konten')}}</label>
                        <div class="col-sm-9">
                            <textarea class="editor" name="content" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="slug">{{translate('Meta Title')}}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{translate(' Judul Meta ')}}" id="meta_title" name="meta_title" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="meta_description">{{translate('Deskripsi Meta')}}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{translate('Deskripsi Meta')}}" id="meta_description" name="meta_description" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="keywords">{{translate('Kata Kunci')}}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{translate('Kata Kunci')}}" id="keywords" name="keywords" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="meta_image">{{translate('Gambar Meta ')}} <small>(200x300)</small></label>
                        <div class="col-sm-9">
                            <input type="file" id="meta_image" name="meta_image" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-right">
                    <button class="btn btn-purple" type="submit">{{translate('Tambah Baru')}}</button>
                </div>
            </form>
            <!--===================================================-->
            <!--End Horizontal Form-->

        </div>
    </div>
</div>
@endsection
