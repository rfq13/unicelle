<div class="panel">
  <div class="panel-heading">
      <h3 class="panel-title" id="panel-title">{{translate('Tambah Jenis Member')}}</h3>
  </div>

  <!--Horizontal Form-->
  <!--===================================================-->
  <form class="form-horizontal" action="{{ route('regular-physician-member.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="panel-body">
          <div class="form-group">
                <input type="text" placeholder="{{translate('title')}}" id="input-title" name="title" class="form-control" required>
                <input type="text" placeholder="{{translate('min')}}" onchange="formatRupiah(this.value,'Rp. ')" id="input-min" name="min" class="form-control" style="margin-top: 13px" required>

                <input type="number" placeholder="periode" name="periode" id="input-periode" class="form-control" style="margin-top: 13px">
                <select name="unit" aria-placeholder="unit" id="input-unit" class="form-control" style="margin-top: 13px">
                <option selected disabled>Unit</option>
                                        @php($periods = \App\Membership_period::all())
                                        @foreach($periods as $period)
                                            <option value="{{$period->id}}">{{$period->member_period}}</option>
                                        @endforeach
                </select>
                <button class="btn" id="btn-store" style="margin-top:13px;float:right;background-color:#1d2d50;color:white" type="submit">{{translate('Save')}}</button>
                <a href="#" class="btn" id="btnUpdate" style="display:none;background-color: #132743; color:white;margin-top:13px;float:right">Simpan</a>
                <a href="#" class="btn btn-warning" id="btnCancel" style="display:none; color:white;margin-top:13px;margin-right:3px;float:right">Batal</a>
          </div>
      </div>
  </form>
  <!--===================================================-->
  <!--End Horizontal Form-->

</div>