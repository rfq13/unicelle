
@extends('layouts.app')

@section('content')

{{--<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('member.create')}}" class="btn btn-rounded btn-info pull-right">{{translate('Add New Member Tiers')}}</a>
    </div>
</div>--}}

<br>
<div class="row">
    <div class="col-lg-8">
        <div class="panel">
            <div class="panel-heading bord-btm clearfix pad-all h-100">
                <h3 class="panel-title pull-left pad-no">{{translate('Member Dokter Reguler')}}</h3>
                <div class="pull-right clearfix">
                    <form class="" id="sort_flash_deals" action="" method="GET">
                        <div class="box-inline pad-rgt pull-left">
                            <div class="" style="min-width: 200px;">
                                {{-- <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Ketik Nama Dokter') }}"> --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="panel-body" id="panel-body">
                <table class="table res-table table-responsive mar-no" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{translate('Judul')}}</th>
                            <th class="text-center">{{ translate('Pelanggan') }}</th>
                            <th>{{translate('Min')}}</th>
                            <th>{{translate('Periode')}}</th>
                            <th width="10%" style="text-right">{{translate('Opsi')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($members as $key => $member)
                            <tr id="row{{$member->id}}">
                                <td>{{ ($key+1) + ($members->currentPage() - 1)*$members->perPage() }}</td>
                                <td>
                                    <span id="title">{{$member->title}}</span>
                                </td>
                                <td class="text-center">{{ $member->user != null ? count($member->user) : 0 }}</td>
                                <td>
                                    <span id="min">{{$member->min}}</span>
                                </td>
                                @php
                                    $periode = $member->periode;
                                    $periods = \App\Membership_period::where('id',$member->period_unit)->first();
                                @endphp

                                <td>
                                    <span id="periode">{{$periode}}</span> <span id="unit">{{$periods->member_period}}</span>
                                </td>
                                <td>
                                    <div class="btn-group dropdown">
                                        <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                            {{translate('Aksi')}} <i class="dropdown-caret"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="{{route('regular-physician-member.edit', encrypt($member->id))}}">
                                                    {{translate('Edit')}}
                                                </a>
                                            </li>
                                            <li>
                                                <a onclick="confirm_modal(`{{route('admin.member.destroy', $member->id)}}`);" style="background-color:#428df5;color:white">{{translate('Hapus')}}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="clearfix">
                    <div class="pull-right">
                        {{$members->appends(request()->input())->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        @include("Member.create")
    </div>
</div>

<!-- Basic Data Tables -->
<!--===================================================-->


@endsection


@section('script')
    <script type="text/javascript">
        
        $("#panel-body #btnEdit").on("click", function (e) {
            e.stopPropagation()
            e.preventDefault()

            $("#panel-title").html("Edit Jenis Member")

            $("#btn-store").hide()
            $("#btnCancel").show()
            $("#btnUpdate").show()

            let id = $(this).data("id")
            let row = $("#row"+id)
            let title = row.find("#title").text()
            let min = row.find("#min").text()
            let periode = row.find("#periode").text()
            let unit = row.find("#period_unit").text()
            let urL = "{{route('regular-physician-member.update','id-membership')}}".replace("id-membership",id)
            console.log(periode);
            $("#input-title").val(title)
            $("#input-min").val(min)
            $("#input-min").change()

            $("#input-periode").val(periode)
            $("#input-unit").val(unit)

            $("#btnUpdate").attr("href",urL)

        })

        $("#btnCancel").click(function (e) {
            e.preventDefault()

            $("#panel-title").html("Tambah Jenis Member")

            $("#btnUpdate").hide()
            $(this).hide()
            $("#btn-store").show()
            $("#input-title").val("")
            $("#input-min").val("")
            $("#input-periode").val("")
            $("#input-unit").val("unit")
        })

        $("#btnUpdate").click(function (e) {
            e.preventDefault()

            let data = {
                _token: "{{csrf_token()}}",
                title: $("#input-title").val(),
                min: $("#input-min").val(),
                periode: $("#input-periode").val(),
                unit:$("#input-unit").val()
            }
            
            $.ajax({
                url : $(this).attr("href"),
                type: "put",
                data: data,
                success: function (data) {
                    if (data == "sukses") {
                        location.reload()
                    }
                }
            })
        })

        function update_flash_deal_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('flash_deals.update_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    location.reload();
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }
        function update_flash_deal_feature(el){
            if(el.checked){
                var featured = 1;
            }
            else{
                var featured = 0;
            }
            $.post('{{ route('flash_deals.update_featured') }}', {_token:'{{ csrf_token() }}', id:el.value, featured:featured}, function(data){
                if(data == 1){
                    location.reload();
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }


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
