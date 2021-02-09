
@extends('layouts.app')

@section('content')



<br>
<div class="row">
    <div class="col-lg-8">
    <div class="panel">
  <div class="panel-heading">
      <h3 class="panel-title" id="panel-title">{{translate('Edit Jenis Member')}}</h3>
  </div>

  <!--Horizontal Form-->
  <!--===================================================-->
  <form class="form-horizontal" action="{{ route('member.update', $member->id) }}" method="POST" enctype="multipart/form-data">

      @csrf
      <div class="panel-body">
          <div class="form-group">
                <input type="text" placeholder="{{translate('title')}}" value="{{$member->title}}" name="title" class="form-control" required>
                <input type="text" placeholder="{{translate('min')}}" value="{{$member->min}}" name="min" class="form-control" style="margin-top: 13px" required>

                <input type="number" placeholder="periode" name="periode"  class="form-control" style="margin-top: 13px" value="{{$member->periode}}">
                <select name="unit" aria-placeholder="unit"  class="form-control" style="margin-top: 13px">
                <option selected disabled>Unit</option>
                                        @php($periods = \App\Membership_period::all())
                                        @foreach($periods as $period)
                                        @if($member->period_unit ==  $period->id)
                                        <option value="{{$period->id}}" selected>{{$period->member_period}}</option>
                                        @else
                                            <option value="{{$period->id}}">{{$period->member_period}}</option>
                                        @endif
                                        @endforeach
                </select>
                <button class="btn btn-purple" type="submit">{{translate('Simpan')}}</button>
                <a href="#" class="btn btn-warning" style="color:white;margin-top:13px;margin-right:3px;float:right">Batal</a>
          </div>
      </div>
  </form>
  <!--===================================================-->
  <!--End Horizontal Form-->

</div>
    </div>
  
</div>

<!-- Basic Data Tables -->
<!--===================================================-->


@endsection


@section('script')
    <script type="text/javascript">

        var rupiah = document.getElementById('input-min');
		rupiah.addEventListener('keyup', function(e){
			rupiah.value = formatRupiah(this.value, 'Rp. ');
        });
        
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}
    </script>
@endsection
