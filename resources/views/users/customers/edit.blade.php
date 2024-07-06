@extends('layouts.master')

@section('head')

<!-- Theme style -->
<link rel="stylesheet" href="../../dist/css/adminlte.min.css">

@endsection

@section('content')
@php
  $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  $uri_segments = explode('/', $uri_path);
@endphp

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ ucwords($uri_segments[1]) }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route($uri_segments[1].'.index') }}">{{ ucwords($uri_segments[1]) }}</a></li>
            <li class="breadcrumb-item active">Create Data</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12 flex justify-content-center">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Create Data Form</h3>
            </div>
            <!-- /.card-header -->
            @php
             $row = $uri_segments[1];
            @endphp
            <!-- form start -->
            <form action="{{ route($uri_segments[1].'.update', $$row->id) }}" method="post">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="form-group">
                  <label for="customer_name">Customer Name</label>
                  <input type="text" class="form-control" name="customer_name" placeholder="Enter Customer Name" value="{{ $$row->customer_name }}" required>
                </div>
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" class="form-control" name="phone" placeholder="Enter Phone" value="{{ $$row->phone }}" required>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <a href="javascript:window.history.go(-1);" class="btn btn-secondary"><i class="fa-solid fa-angle-left"></i> Back</a>
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
              </div>
            </form>
          </div>
          <!-- /.card -->

          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

@endsection

@section('jquery')

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    bsCustomFileInput.init();
  });
</script>

@endsection

<!-- <div>
<h2>Add Customer</h2>
    <form action="{{ route('customers.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nam:</label>
            <input type="text" name="customer_name" class="form-control" placeholder="Enter Customer Name">
            <label for="name">Phone:</label>
            <input type="text" name="phone" class="form-control" placeholder="Enter Phone">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div> -->
