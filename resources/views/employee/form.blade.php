@extends('layouts.master')

@section('content')
<div class="block  ml-auto mr-auto">
    <div class="block-header block-header-default">
        <h3 class="block-title">Add Employee</h3>
        <div class="block-options">
            <button type="button" class="btn-block-option">
                <i class="si si-wrench"></i>
            </button>
        </div>
    </div>
    <div class="block-content">
        <div class="col-md-12">
            <!-- Validation Wizard Material -->
            <div class="js-wizard-validation-material block">
                <!-- Step Tabs -->
                <ul class="nav nav-tabs nav-tabs-alt nav-fill" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#wizard-validation-material-step1" data-toggle="tab">1. Personal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#wizard-validation-material-step2" data-toggle="tab">2. Bank</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#wizard-validation-material-step3" data-toggle="tab">3. User Registration</a>
                    </li>
                </ul>
                <!-- END Step Tabs -->

                <!-- Form -->
                <form class="js-wizard-validation-material-form" action="{{route('emp.store')}}" onsubmit="return false;" enctype="multipart/form-data" method="post">
                    @csrf
                    <!-- Steps Content -->
                    <div class="block-content block-content-full tab-content" style="min-height: 267px;">
                        <!-- Step 1 -->
                        <div class="tab-pane active" id="wizard-validation-material-step1" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-material floating">
                                            <input class="form-control" type="text" id= "name" name= "name">
                                            <label for= "name">Name</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-material floating">
                                            <input class="form-control" type="text" id="gender" name="gender">
                                            <label for="gender">Gender</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-material">
                                            <input class="form-control" type="date" id="birth_date" name="birth_date">
                                            <label for="birth">BirthDate</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-material floating">
                                            <input class="form-control" type="text" id="address" name="address">
                                            <label for="address">Address</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-material floating">
                                            <input class="form-control" type="email" id="email" name="email">
                                            <label for="email">Email</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-material floating">
                                            <input class="form-control" type="text" id="phone" name="phone">
                                            <label for="phone">Phone</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-material">
                                            <input class="form-control" type="date" id="join_date" name="join_date">
                                            <label for="join">Join Date</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-material floating">
                                            <input class="form-control" type="text" id="salary" name="salary">
                                            <label for="salary">Salary</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-material floating">
                                            <select class="form-control" id="depart_id" name="depart_id" size="1">
                                                @foreach ($data as $d)
                                                    <option value=""></option>
                                                    <option value={{($d->id)}}>{{($d->name)}}</option>
                                                @endforeach
                                            </select>
                                            <label for="department">Departement</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-material">
                                            <input class="form-control" type="file" id="photo" name="photo">
                                            <label for="photo">Photo</label>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- END Step 1 -->

                        <!-- Step 2 -->
                        <div class="tab-pane" id="wizard-validation-material-step2" role="tabpanel">
                            <div class="form-group">
                                <div class="form-material floating">
                                    <input class="form-control" type="text" id="account_number" name="account_number">
                                    <label for="account_number">Account Number</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-material floating">
                                    <input class="form-control" type="text" id="bank_name" name="bank_name">
                                    <label for="bank_name">Bank Name</label>
                                </div>
                            </div>
                        </div>
                        <!-- END Step 2 -->

                        <!-- Step 3 -->
                        {{-- <div class="tab-pane" id="wizard-validation-material-step3" role="tabpanel">
                            <div class="form-group">
                                <div class="form-material floating">
                                    <input class="form-control" type="email" id="email" name="email">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-material floating">
                                    <input class="form-control" type="password" id="password" name="password">
                                    <label for="password">Password</label>
                                </div>
                            </div>
                        </div> --}}
                        <!-- END Step 3 -->
                    </div>
                    <!-- END Steps Content -->

                    <!-- Steps Navigation -->
                    <div class="block-content block-content-sm block-content-full bg-body-light">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-alt-secondary" data-wizard="prev">
                                    <i class="fa fa-angle-left mr-5"></i> Previous
                                </button>
                            </div>
                            <div class="col-6 text-right">
                                <button type="button" class="btn btn-alt-secondary" data-wizard="next">
                                    Next <i class="fa fa-angle-right ml-5"></i>
                                </button>
                                <button type="submit" class="btn btn-alt-primary d-none" data-wizard="finish">
                                    <i class="fa fa-check mr-5"></i> Submit
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- END Steps Navigation -->
                </form>
                <!-- END Form -->
            </div>
            <!-- END Validation Wizard 2 -->
        </div>
    </div>
</div>
@endsection
@push('scripts')

<script>
    $('form').submit(function(event){
        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'http://hrms.test:81/employee/store',
            type : 'POST',
            data:new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
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
                    Swal.close()
                }
                 window.location.href = "http://hrms.test:81/employee/";
            }
        })
    })



</script>
@endpush
