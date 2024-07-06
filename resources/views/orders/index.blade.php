@extends('layouts.master')

@section('head')

<!-- DataTables -->
<link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="../../dist/css/adminlte.min.css">

@endsection

@section('content')
@php
  $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  $uri_segments = explode('/', $uri_path);
@endphp
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">{{ ucwords($uri_segments[1]) }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <a href="{{ route($uri_segments[1].'.create') }}" type="button" class="btn btn-block btn-success"><i
                class="fa-solid fa-plus"></i> Create data</a>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">DataTable with default features</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Total Payment</th>
                    <th>Paid</th>
                    <th>Unpaid</th>
                    <th>Date</th>
                    <th> </th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $i = 1;
                    $rows = $uri_segments[1];
                  @endphp
                  @foreach ($$rows as $row)
                    <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->customer->customer_name }}</td>
                    <td>{{ $row->total_payment }}</td>
                    <td>{{ $row->paid }}</td>
                    <td>{{ $row->unpaid }}</td>
                    <td>{{ $row->created_at }}</td>
                    <td>
                      <a href="{{ route($uri_segments[1].'.edit', $row->id) }}" class="btn btn-sm btn-info"><i
                        class="fa-solid fa-pen-to-square"></i> Edit</a>
                      <a href="{{ route($uri_segments[1].'.destroy', $row->id) }}" class="btn btn-sm btn-danger"
                      data-confirm-delete="true"><i class="fa-solid fa-trash"></i> Delete</a>
                    </td>
                    </tr>

                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Total Payment</th>
                    <th>Paid</th>
                    <th>Unpaid</th>
                    <th>Date</th>
                    <th> </th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->

  @endsection

  @section('jquery')

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../../plugins/jszip/jszip.min.js"></script>
  <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../dist/js/demo.js"></script>
  <!-- Page specific script -->
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>

  @endsection