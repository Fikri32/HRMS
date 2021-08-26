@extends('layouts.master')

@section('content')
<div class="block  ml-auto mr-auto">
    <div class="block-header block-header-default">
        <h3 class="block-title">Department Employee Index</h3>
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
        <table class="table table-bordered" id="employee-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>name</th>
                <th>photo</th>
                <th>gender</th>
                <th>Birth</th>
                <th>Joining</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Department</th>
                <th>Salary</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $('#employee-table').DataTable({
        processing:true,
        serverSide:true,
        ajax:'http://hrms.test:81/employee/index',
        columns:[
            {data:'id',name:'id'},
            {data:'name',name:'name'},
            {data:'photo',name:'photo'},
            {data:'gender',name:'gender'},
            {data:'birth_date',name:'birth'},
            {data:'join_date',name:'join'},
            {data:'phone',name:'phone'},
            {data:'address',name:'address'},
            {data:'depart_id',name:'depart_id'},
            {data:'salary',name:'salary'},
            {data:'action',name:'action'},
        ]
    })


    $(document).on('click','.delete',function(){
        var id = $(this).attr('data-id')
        Swal.fire({
            title : 'Anda Yakin Ingin Menghapus Data?',
            text  : 'Data Yang Sudah Di Hapus Tidak Dapat Di Kembalikan.',
            icon  : 'warning',
            showConfirmButton : true,
            showCancelButton  : true,
            confirmButtonText : 'Ya,Hapus!',
            cancelButtonText  : 'Tidak,Batalkan!',
            allowOutsideClick : false,
        })
        .then((result)=>{
            if(result.value)
            {
                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                    type:'DELETE',
                    url:'http://hrms.test:81/employee/'+id+'/delete',
                    beforeSend:function(){
                        Swal.fire({
                            title:'Tunggu Sebentar...',
                            text:'Data Sedang Di proses',
                            imageUrl : "{!! asset('assets/img/loading/Glowing ring.gif') !!}",
                            showConfirmButton : false,
                            allowOutsideClick : false,
                        });
                    },
                    success:function(response){
                        if(response.fail != false)
                        {
                            Swal.close()
                            Swal.fire({
                                title:'Berhasil!',
                                text:'Data Berhasil DiHapus',
                                icon:'success',
                                showConfirmButton:true
                            })

                        }else{
                            Swal.fire({
                                title   :   'Gagal!',
                                text    :   'Data Gagal Di Hapus!',
                                icon    : 'error',
                                showConfirmButton   : true
                            })
                        }

                        $('#employee-table').DataTable().draw()
                    }
                })
            }else{
                Swal.close()
            }
        })
    })
</script>
@endpush

