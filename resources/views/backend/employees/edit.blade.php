@extends('layouts.app')

@include('layouts.topbar.user')

@include('layouts.menus.user')

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="page-title">Edit Employees</h2>
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <strong class="card-title">Edit employees</strong>
                    </div>
                </div> <!-- / .card -->
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="card shadow">
                            <div class="card-body">

                                @if ($message = Session::get('success'))
                                <div class="alert alert-success" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @endif

                                @if ($message = Session::get('error'))
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @endif

                                @if ($message = Session::get('warning'))
                                <div class="alert alert-warning" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @endif

                                @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                                <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">


                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="first_name">First Name</label>
                                                <input type="text" class="form-control" value="{{$employee->first_name}}" id="first_name" name="first_name" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="second_name">Second Name</label>
                                                <input type="text" class="form-control" id="last_name" value="{{$employee->last_name}}" name="last_name" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="customFile">Email</label>
                                                <input type="email" class="form-control" value="{{$employee->email}}" id="email" name="email" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="customFile">Company</label>
                                                <select name="company_id" id="company_id" class="form-control" required>
                                                    <option value="">Select a company</option>
                                                    @foreach($companies as $company)
                                                    <option value="{{$company->id}}"{{$company->id==$employee->company_id?'selected':''}}>{{$company->name}}</option>
                                                  @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="phone"> Phone</label>
                                                <input type="text" class="form-control" pattern="[789][0-9]{9}" id="phone" value="{{$employee->phone}}" name="phone" required>
                                            </div>
                                        </div>
                                    </div>



                                    <button type="submit" class="btn mb-2 btn-primary btn-lg">Save</button>
                                </form>

                            </div> <!-- /.card-body -->
                        </div> <!-- /.card -->
                    </div> <!-- /.col -->

                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->

</main> <!-- main -->
@endsection

@section('js-script')


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('assets/js/gauge.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('assets/js/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/js/apexcharts.custom.js') }}"></script>
<script src="{{ asset('assets/js/apps.js') }}"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-56159088-1');
</script>
@endsection