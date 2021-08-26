@extends('layouts.master')

@section('content')
 <div class="block  ml-auto mr-auto">
    <div class="block-header block-header-default">
        <h3 class="block-title">Department Index</h3>
        <div class="block-options">
            <button type="button" class="btn-block-option">
                <i class="si si-wrench"></i>
            </button>
        </div>
    </div>
    <div class="block-content">
        <a class="btn btn-primary m-3" href="javascript:;" data-toggle="modal" data-target="#formDepartment">
            Add Department
        </a>
        <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
    </div>
</div>
<div id="formDepartment" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Department</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body">
                <div class="form-group col-xs-12 col-lg-12">
                    <label class="control-label">Department Name</label>
                    {{ Form::text('name', null, ['class' => 'form-control name']) }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="submit()">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    var idEdit = 0;
    //  var table =  $('#users-table').DataTable();
    $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'http://hrms.test:81/departments/index',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });


    function submit()
    {
        var url;
        var type;
        var result;

        if(idEdit == 0)
        {
            url = 'http://hrms.test:81/departments/store'
            type = 'POST'
        }else{
            url = 'http://hrms.test:81/departments/'+idEdit+'/update'
            type = 'PUT'
        }

        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type : type,
            url : url,
            data : {
                name : $('[name = name]').val(),

            },
            beforeSend:function(){
                Swal.fire({
                    title : 'Tunggu Sebentar...',
                    text  : 'Data Sedang Di Proses',
                    imageUrl : "{!! asset('assets/img/loading/Glowing ring.gif') !!}",
                    showConfirmButton : false,
                    allowOutsideClick : false,

                });
            },

            success : function(response){
                if(response.fail != false)
                {
                    Swal.close();
                    Swal.fire({
                        title   : 'Berhasil!',
                        icon    : 'success',
                        text    : 'Penambahan Departement Baru Berhasil',
                        showConfirmButton : true
                    })
                }else{
                    Swal.fire({
                        title   :   'Gagal!',
                        text    :   'Periksa Form Input!',
                        icon    : 'error',
                        showConfirmButton   : true
                    })
                }
                idEdit = 0;
                $('[name = name]').val('');
                $('#formDepartment').modal('hide');
                $('#users-table').DataTable().draw()
            }
        })
    }

    $(document).on('click','.edit',function(){
        var id = $(this).attr('data-id');
        console.log(id)
          $.ajax({

                type:'GET',
                url: 'http://hrms.test:81/departments/'+id+'/edit',
                success : function(data){
                    console.log(data)
                    idEdit = data.id;
                    $('#formDepartment').modal('show');
                    $('[name=name]').val(data.name);
                }
            })
    })

    $(document).on('click','.delete',function(){
        var id = $(this).attr('data-id');
        Swal.fire({
            title: "Anda Yakin?",
            text: "Data Yang Dihapus Tidak Akan Bisa Dikembalikan",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Tidak, Batalkan!',
            allowOutsideClick: false,
        })
        .then((result) => {
            if (result.value) {
                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                    type:'DELETE',
                    url:'http://hrms.test:81/departments/'+id+'/delete',
                    beforeSend:function(){
                            Swal.fire({
                                title : 'Tunggu Sebentar...',
                                text  : 'Data Sedang Di Proses',
                                imageUrl : "{!! asset('assets/img/loading/Glowing ring.gif') !!}",
                                showConfirmButton : false,
                                allowOutsideClick : false,

                            });
                        },

                    success : function(response){
                        if(response.fail != false)
                        {
                            Swal.close();
                            Swal.fire({
                                title   : 'Berhasil!',
                                icon    : 'success',
                                text    : 'Data Berhasil Di Hapus!',
                                showConfirmButton : true
                            })
                        }else{
                            Swal.fire({
                                title   :   'Gagal!',
                                text    :   'Data Gagal Di Hapus!',
                                icon    : 'error',
                                showConfirmButton   : true
                            })
                        }
                        idEdit = 0;
                        $('#users-table').DataTable().draw()
                    }
                })
            }else{
                Swal.close()
            }
        })
    })



</script>
@endpush
