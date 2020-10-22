@extends('layouts.app')

@section('content')
    <div class="col-md">
        <div class="panel">
            <!--Panel heading-->
            <div class="panel-heading">
                <h3 class="panel-title">{{ translate('Kategori Blog') }}</h3>
            </div>

            <!--Panel body-->
            <div class="panel-body">
                <div class="table-responsive">
                    <a href="#" data-toggle="modal" data-target="#categoryModal" class="btn btn-primary" style="float: right;margin:5px"><i class="fa fa-pencil-square-o"></i> Tambah Kategori</a><br>
                    <table class="table table-striped mar-no demo-dt-basic">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ translate('Nama') }}</th>
                                <th>{{ translate('Blog') }}</th>
                                <th>{{ translate('Aksi') }}</th>
                            </tr>
                        </thead>
                        <tbody id="tBody">
                            @foreach ($categories as $key => $ctg)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $ctg->name }}</td>
                                    <td>{{ $ctg->blogs_count }}</td>
                                    <td>
                                        <div class="btn-group dropdown">
                                            <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                                {{translate('Aksi')}} <i class="dropdown-caret"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="{{route('blog.edit-ctg', encrypt($ctg->id))}}" data-name="{{ $ctg->name }}" id="btnEdit">{{translate('Edit')}}</a></li>
                                                <li><a onclick="confirm_modal('{{route('blog.delete-ctg',encrypt($ctg->id))}}');">{{translate('Hapus')}}</a></li>
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
        
        <!-- Modal -->
        <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('blog.store-ctg') }}" id="formCtg" method="post">
                    @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel">Tambah Kategori Blog</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <input class="form-control form-control-lg" id="ctgName" type="text" name="name" placeholder="nama kategori">
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan
                </button>
                </div>
                </form>
            </div>
            </div>
        </div>
        <!-- Modal -->

@endsection
@section('script')
<script>
    $("#tBody #btnEdit").click(function (e) {
        e.preventDefault()
        $("#formCtg").attr("action",$(this).attr("href"))
        $("#formCtg").prepend('@method("put")')
        $("#ctgName").val($(this).data('name'))
        $("#categoryModalLabel").html("Edit Kategori Blog")
        $("#categoryModal").modal("show")
    })
    $("#categoryModal").on('hidden.bs.modal', function (e) {
        $("#formCtg").attr("action","{{ route('blog.store-ctg') }}")
        $("input[name='_method']").remove()
        $("#ctgName").val("")
        $("#categoryModalLabel").html("Tambah Kategori Blog")
    })
</script>
@endsection

