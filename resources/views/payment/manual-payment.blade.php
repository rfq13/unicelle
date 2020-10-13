@extends("frontend.layouts.app")

{{--@section('style')
<style>
  .uploader {
      display: block;
      clear: both;
      margin: 0 auto;
      width: 100%;
      max-width: 600px;
  }

  .uploader label {
      float: left;
      clear: both;
      width: 100%;
      padding: 2rem 1.5rem;
      text-align: center;
      background: #fff;
      border-radius: 7px;
      border: 3px solid #eee;
      -webkit-transition: all 0.2s ease;
      transition: all 0.2s ease;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
  }

  .uploader label:hover {
      border-color: #3B6CB6;
  }

  .uploader label.hover {
      border: 3px solid #3B6CB6;
      box-shadow: inset 0 0 0 6px #eee;
  }

  .uploader label.hover #start i.fa {
      -webkit-transform: scale(0.8);
      transform: scale(0.8);
      opacity: 0.3;
  }

  .uploader #start {
      float: left;
      clear: both;
      width: 100%;
  }

  .uploader #start.hidden {
      display: none;
  }

  .uploader #start i.fa {
      font-size: 50px;
      margin-bottom: 1rem;
      -webkit-transition: all 0.2s ease-in-out;
      transition: all 0.2s ease-in-out;
  }

  .uploader #response {
      float: left;
      clear: both;
      width: 100%;
  }

  .uploader #response.hidden {
      display: none;
  }

  .uploader #response #messages {
      margin-bottom: 0.5rem;
  }

  .uploader #file-image {
      display: inline;
      margin: 0 auto 0.5rem auto;
      width: auto;
      height: auto;
      max-width: 180px;
  }

  .uploader #file-image.hidden {
      display: none;
  }

  .uploader #notimage {
      display: block;
      float: left;
      clear: both;
      width: 100%;
  }

  .uploader #notimage.hidden {
      display: none;
  }

  .uploader progress,
  .uploader .progress {
      display: inline;
      clear: both;
      margin: 0 auto;
      width: 100%;
      max-width: 180px;
      height: 8px;
      border: 0;
      border-radius: 4px;
      background-color: #eee;
      overflow: hidden;
  }

  .uploader .progress[value]::-webkit-progress-bar {
      border-radius: 4px;
      background-color: #eee;
  }

  .uploader .progress[value]::-webkit-progress-value {
      background: -webkit-gradient(linear, left top, right top, from(#393f90), color-stop(50%, #3B6CB6));
      background: linear-gradient(to right, #393f90 0%, #3B6CB6 50%);
      border-radius: 4px;
  }

  .uploader .progress[value]::-moz-progress-bar {
      background: linear-gradient(to right, #393f90 0%, #3B6CB6 50%);
      border-radius: 4px;
  }

  .uploader input[type="file"] {
      display: none;
  }

  .uploader div {
      margin: 0 0 0.5rem 0;
      color: #5f6982;
  }

  .uploader .btn {
      display: inline-block;
      margin: 0.5rem 0.5rem 1rem 0.5rem;
      clear: both;
      font-family: inherit;
      font-weight: 700;
      font-size: 14px;
      text-decoration: none;
      text-transform: initial;
      border: none;
      border-radius: 0.2rem;
      outline: none;
      padding: 0 1rem;
      height: 36px;
      line-height: 36px;
      color: #fff;
      -webkit-transition: all 0.2s ease-in-out;
      transition: all 0.2s ease-in-out;
      box-sizing: border-box;
      background: #3B6CB6;
      border-color: #3B6CB6;
      cursor: pointer;
  }
</style>
@endsection--}}
@php
$bank_setting = \App\BusinessSetting::where('type', 'bank_setting')->first();
if ($bank_setting == null) {
    flash("mohon maaf mengganggu kenyamanan anda, pengaturan bank belum dilakukan oleh admin");
    echo "<script>window.location ='".route("home")."' </script>";
    return;
}
$config =  json_decode( $bank_setting->value);
@endphp
@section('content')
  <div class="row">
      <div class="col-2"></div>
      <div class="col-lg-8 col-12">
          <div class="card p-4">
              <div class="row">
                  <div class="col-1"></div>
                  <div class="col-10">

                      <div class="border-bottom pb-lg-3 pb-1">
                          <table>
                              <tr>
                                  <td class="w-100" style="font-size: 18px;">Total Pembayaran</td>
                                  <th style="color: #B71C1C; font-size: 18px;">{{ single_price($order->grand_total) }}</th>
                              </tr>
                          </table>
                      </div>
                      <div class="row mt-1 mt-lg-3">
                          <div class="col-4">
                              <span class="font-weight-bold">Metode Pembayaran</span>
                              <img src="{{ my_asset($config->LOGO) }}" alt="" class="text-center" style="width: 60px; height: 60px; ">
                          </div>
                          <div class="col-8 border-left">
                              <table>
                                  <tr>
                                      <th class="pr-5">Bank</th>
                                      <td>: {{ $config->BANK_NAME }}</td>
                                  </tr>
                                  <tr>
                                      <th>No. Rek</th>
                                      <td>: {{ $config->BANK_NO_REK }}</td>
                                  </tr>
                                  <tr>
                                      <th>a/n</th>
                                      <td>: {{ $config->BANK_ATAS_NAMA }}</td>
                                  </tr>
                              </table>
                          </div>
                      </div>
                      <hr>
                      <form id="file-upload-form" class="uploader mt-lg-2 mt-1" action="{{ route('payment.store') }}" method="post" enctype="multipart/form-data">
                          @csrf
                       
                          <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">No. Re</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputPassword" name="norek" placeholder="No Rekening." @if($order->manual_payment && is_array(json_decode($order->manual_payment, true))) value="{{ json_decode($order->manual_payment)->norek }}"  @endif required>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">A/n</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="name" placeholder="Atas Nama Rek." @if($order->manual_payment && is_array(json_decode($order->manual_payment, true))) value="{{ json_decode($order->manual_payment)->name }}"  @endif required>
                            </div>
                          </div>
                        
                      <div class="info-lanjut-konfirmasi__ my-5">
                          <!-- Upload  -->
                          
                          <input type="hidden" name="order_id" value="{{ $order->id }}">
                          <div class="row" style="padding: 0 40px;">
                            <p class="mx-0 my-2" style="font-weight: 600;">*Upload Bukti Pembayaran <span style="font-weight: 400;">(max. 5MB)</span></p>
                            <div  class="rounded width-100 text-center" style="border: 1px solid #3B6CB6;height: 200px;">
                                @if($order->manual_payment && is_array(json_decode($order->manual_payment, true)))
                                @php
                                $img = my_asset(json_decode($order->manual_payment)->foto);
                                @endphp
                                <label for="photo" id="display-foto" class="mb-0 text-center" style="background-repeat: no-repeat;background-position: center center;background-size: contain; width: 100%;cursor: pointer;background-image: url({{$img}});">
                                    <i class="fa fa-edit" aria-hidden="true" style="font-size: 36px; line-height: 200px;"></i>
                                </label>
                                <input type="file" id="photo" name="photo" style="display: none;" accept="image/x-png,image/gif,image/jpeg"/>
                                @else
                                <label for="photo" id="display-foto" class="mb-0 text-center" style="width: 100%;cursor: pointer;">
                                    <i class="fa fa-download" aria-hidden="true" style="font-size: 36px; line-height: 200px;"></i>
                                </label>
                                <input type="file" id="photo" name="photo" style="display: none;" accept="image/x-png,image/gif,image/jpeg" required />
                                @endif
                                
                            </div>
                            
                           
                        </div>
                      </div>

                      <div class="row mt-3 mt-lg-5">
                          <div class="col-6 text-center">
                              <a href="" class="btn btn-danger w-80">Batal</a>
                          </div>
                          <div class="col-6 text-center">
                              <button type="submit" class="btn btn-primary1 w-80">Konfirmasi Pembayaran</button>
                          </div>
                      </div>
                      </form>

                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection

@section('script')
<script type="text/javascript">
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      // $('#blah').attr('src', e.target.result);
        $('#display-foto').css('background-image','url('+e.target.result+')');
        $('#display-foto').css('background-size','contain');
        $('#display-foto').css('background-repeat','no-repeat');
        $('#display-foto').css('background-position','center center');
        $('#display-foto').html('<i class="fa fa-edit" aria-hidden="true" style="font-size: 36px; line-height: 200px;"></i>');

    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$(document).ready(function(){
    $("#photo").on('change',function(){
        //do whatever you want
       readURL(this);
    })
});
</script> 
@endsection