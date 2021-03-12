@extends('frontend.layouts.app')

@section('title',"Petunjuk Dropshipper |")

@section('content')
<div class="container">
  <div class="row">
      <div class="head-text-syarat-ketentuan">
          <span class="syarat__">PETUNJUK DROPSHIPPER</span>
         
      </div>
      @php
          $dropshipper = \App\Policy::where('name', "info_dropshipper")->first();
        //   dd($policy);
      @endphp
      <div class="text-syarat-ketentuan">
          
        {!!$dropshipper->content!!}
      </div>
  </div>
</div>
@endsection