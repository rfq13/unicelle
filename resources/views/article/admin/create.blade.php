@php
    // dd($content);
@endphp
@extends('layouts.app')
@section('content')
@php
    $categories = \App\CategoryBlog::all();
@endphp
    <div class="col-md" onload="LoadValue()">
        <div class="panel">
            <!--Panel heading-->
            <div class="panel-heading">
                <a href="{{ route('blog.index') }}" style="float:right;margin:2%"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>Kembali</a>
                <h3 class="panel-title">{{ translate("$operasi Blog") }}</h3>
            </div>
            <!--Panel body-->
            <div class="panel-body">
                <form action="{{ $url }}" method="POST" enctype="multipart/form-data">
                    @if ($method == "update")
                        @method('put')
                    @endif
                    @csrf
                    <div class="form-group">
                      <label for="exampleFormControlInput1">{{ translate('Tampilkan Blog ?') }}</label><br>
                      <label class="switch">
                        <input type="checkbox" name="visible" value="1" {{ $method == "create"? "" : $blog->visible == 1 ? "checked" : "" }}/>
                        <span class="slider round"></span>
                      </label>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">{{ translate('Judul') }}</label>
                      <input type="text" class="form-control" id="judul-blog" name="title" placeholder="judul blog" value="{{ $method == "create"? "" : $blog->title }}">
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">{{ translate('sub Judul') }}</label>
                      <input type="text" class="form-control" id="subjudul-blog" name="subtitle" placeholder="subjudul blog" value="{{ $method == "create"? "" : $blog->subtitle }}">
                    </div>
                    <div class="form-group">
                        <label for="Category">{{__('Kategori')}}</label>
                            <select name="category" class="form-control">
                                <option selected disabled>Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}" {{ $method == "create"? "" : $blog->category_id == $category->id ? "selected" : "" }}>{{$category->name}}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">{{ translate('Thumbnail') }} <cite style="color: #5D5E62;font-size:12px">*pastikan gambar berukuran (255 x 130 pixel)</cite></label>
                      <input type="file" name="thumbnail" id="thumbnail" class="dropify" data-default-file="{{ $method == "create"? "" : my_asset($blog->thumbnail) }}" data-min-width="254" data-max-width="256" data-min-hight="129" data-max-width="131"   data-max-file-size="3M" data-allowed-file-extensions="jpg png jpeg" {{ $method == "create"? "required" : "" }}>
                      @if ($method == "update")
                        <input type="hidden" name="oldThumb" value="{{ $blog->thumbnail }}">
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="konten-blog">Konten Blog / Artikel</label>
                      <textarea name="content" id="konten-blog" cols="30" rows="10">{{ $method == "create"? "" : $blog->content }}</textarea>
                    </div>
                    <button type="submit">simpan</button>
                  </form>
            </div>
        </div>
    </div>

@endsection
@section('script')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
                $('#konten-blog').summernote({
                    shortcuts: false,
                    indent:true,
                    outdent:true,
                    tabDisable: false,
                    placeholder: 'Start writing...',
                    height: 500,
                    codeviewFilter: true,
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['insert', ['link', 'picture']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        ['view', ['fullscreen', 'codeview']],
                        'undo','redo'
                    ],
                    popover: {
                        image: [
                            ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                            ['float', ['floatLeft', 'floatRight', 'floatCenter', 'floatNone']],
                            ['remove', ['removeMedia']]
                        ]
                    },
                    lineHeights: ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0', '1.2', '1.4', '1.5', '2.0', '3.0'],
                    callbacks:{
                        onImageUpload: function(files) {
                            uploadImg(files[0])
                        },
                        onMediaDelete : function(target) {
                            deleteFile(target[0].src);
                        }
                    }
                });

                $('.dropify').dropify({
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
        })

            function uploadImg(file) {
                let imgFile = new FormData
                imgFile.append('image', file)
                imgFile.append('_token',"{{csrf_token()}}")

                let url = "{{route('admin.imgUpload.ajax')}}"

                $.ajax({
                    type:'post',
                    url:url,
                    data:imgFile,
                    dataType:'json',
                    processData:false,
                    contentType:false,
                    success: function (data) {
                        $("#konten-blog").summernote('insertImage',data.image)
                    }
                })
            }

            function deleteFile(link) {
                let urL = "{{route('admin.deleteImg.ajax')}}"
                const first = parseInt(link.indexOf("blog"))
                const last = parseInt(link.length)
                let src = link.slice(first,last)
                console.log(src)
                let data = {
                    _token:"{{csrf_token()}}",
                    src:src
                }
                $.post(urL, data, (res) => {
                    showAlert('success','image deleted')
                })
            }
    </script>
@endsection
