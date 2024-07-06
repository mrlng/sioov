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
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Select Customer Form</h3>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form action="{{route($uri_segments[1].'.store')}}" method="POST">
            @csrf
              <div class="card-body">
                <input type="text" class="form-control" name="id" hidden value="{{ $randomString }}">
                <p><b>Customer</b></p>
                <div class="input-group mb-3">
                  <select class="form-control" name="customer_id">
                  <option disabled selected>Select Customer</option>
                  @foreach ($customers as $row)
                    <option value="{{$row->id}}">{{$row->customer_name}} - {{$row->id}}</option>
                  @endforeach
                  </select>
                  <span class="input-group-append">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-lg"><i class="fa-solid fa-plus"></i> Add new customer</button>
                  </span>
                </div>
                <div class="form-group">
                  <label for="mont">Month</label>
                  <select class="form-control" name="month">
                    <option value="" disabled selected>Select month</option>
                    <option value="january">January</option>
                    <option value="february">February</option>
                    <option value="march">March</option>
                    <option value="april">April</option>
                    <option value="may">May</option>
                    <option value="june">June</option>
                    <option value="july">July</option>
                    <option value="august">August</option>
                    <option value="september">September</option>
                    <option value="october">October</option>
                    <option value="november">November</option>
                    <option value="december">December</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="year">Year</label>
                  <input type="number" class="form-control" name="year" placeholder="Enter Year" required>
                  <input type="number" class="form-control" name="paid" value="0" hidden>
                  <input type="number" class="form-control" name="unpaid" value="0" hidden>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <a href="javascript:window.history.go(-1);" class="btn btn-secondary"><i class="fa-solid fa-angle-left"></i> Back</a>
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                <a href="{{route('jobs.create')}}" class="btn btn-warning">Skip <i class="fa-solid fa-angle-right"></i></a>
              </div>
              </form>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.row -->
        <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          <form action="{{route('customers.store')}}" method="POST">
          @csrf
            <div class="modal-header">
              <h4 class="modal-title">Add New Customer</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
            <input type="text" class="form-control" name="id" hidden value="{{ $randomString }}">
                <div class="form-group">
                  <label for="customer_name">Customer Name</label>
                  <input type="text" class="form-control" name="customer_name" placeholder="Enter Customer Name" required>
                </div>
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" class="form-control" name="phone" placeholder="Enter Phone" required>
                </div>
            
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
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
