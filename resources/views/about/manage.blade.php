@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12">
        {{-- <a href="{{ route('brands.create')}}" class="btn btn-rounded btn-info pull-right">{{translate('Add New Brand')}}</a> --}}
    </div>
</div>

<br>

@php
    $content = \App\about::first();
    $id = isset($content) ? $content->id : 0;
    $content = isset($content) ? $content->content : "";
@endphp
<input type="hidden" name="" id="konten" value="{{json_encode($content)}}">
<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{translate('About')}}</h3>
    </div>
    <div class="panel-body">
      <form action="{{route('about.update',$id)}}" method="post">
        @method('put')
        @csrf
        <textarea name="content" id="editor" cols="30" rows="10"></textarea>
        <div class="clearfix" style="float:right;margin:12px">
            <button type="submit" class="btn btn-primary">simpan</button>
        </div>
      </form>
    </div>
</div>

@endsection
@section('script')
    <script type="text/javascript">
        var editor = new Jodit('#editor');
        const konten = document.getElementById('konten').value
        editor.value = JSON.parse(konten);
        // console.log(konten)

    </script>
@endsection
