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
          <!-- /.card -->
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Create Data Form</h3>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form action="{{route($uri_segments[1].'.store')}}" method="POST">
            @csrf
              <div class="card-body">
                <div class="form-group">
                <input type="text" class="form-control" name="id" value="{{ $randomString }}" hidden>
                  <label for="order_id">Order ID</label>
                  <select class="form-control" name="order_id">
                    <option value="" disabled selected>Select order ID</option>
                    @foreach ($orders as $row)
                      <option value="{{$row->id}}">{{$row->id}} - {{$row->customer->customer_name}} - {{$row->created_at}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="item">Item</label>
                  <input type="text" class="form-control" name="item" placeholder="Enter Item Name" required>
                </div>
                <div class="form-group">
                  <label for="price">Price</label>
                  <input type="number" class="form-control" name="price" placeholder="Enter Price" required>
                </div>
                <div class="form-group row">
                  <div class="col-6">
                  <label for="qty">qty</label>
                  <input type="number" class="form-control" name="qty" placeholder="Enter Quantity" required>
                  </div>
                  <div class="col-6">
                  <label for="Unit">Unit</label>
                  <input type="text" class="form-control" name="unit" placeholder="Enter Unit" required>
                  </div>
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
