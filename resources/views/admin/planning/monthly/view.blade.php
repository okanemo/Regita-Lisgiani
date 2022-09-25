@extends('admin.template.main')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{$title}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">{{$title}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-12">
            @if($errors->any())
              <div class="alert alert-danger">
              {{$errors->first()}}
              </div>
            @endif
            @if(session()->has('success'))
              <div class="alert alert-success">
                  {{ session()->get('success') }}
              </div>
          @endif
            <div class="card">
              <div class="card-header">
                <h1 class="card-title">Planning MO</h1><br>
                <a class="btn btn-success btn-sm" href="{{ url('/admin/planning-monthly/add')}}"><i class="fa fa-plus"></i> Input MO</a>
                <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal"><i class="fas fa-file-excel"></i> Import Excel</a>
                <!-- Modal -->
                <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5>Import Excel</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Drop Excel Here.</p>
                        <form role="form" method="post" action="{{ url('admin/planning-monthly/import') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="text" name="module" value="monthly" style="display:none">
                            <div class="card-body">
                            <div class="form-group">
                                <label for="file">File</label>
                                <input type="file" required name="file"  class="form-control" id="file">
                            </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                            <button type="submit" class="btn btn-primary" style="background-color: #3BB873;border:none">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    </div>

                </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Prodution Date</th>
                    <th>Line Number</th>
                    <th>Part Name</th>
                    <th>Part Category</th>
                    <th>Cycle Time</th>
                    <th>Production Time</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach($data as $key)
                <tr>
                    <td>{{$key['id']}}</td>
                    <td>{{$key['production_date']}}</td>
                    <td>{{$key['line_number']}}</td>
                    <td>{{$key['part_name']}}</td>
                    <td>{{$key['part_category']}}</td>
                    <td>{{$key['cycle_time']}}</td>
                    <td>{{$key['start_production']}} - {{$key['finish_production']}}</td>
                    <td>{{$key['status']}}</td>
                    <td>
                    <a class="btn btn-warning" href='{{ url('/admin/planning/edit')}}/{{$key['id'] }}')"><i class="fa fa-edit"></i></a>
                </tr>
                @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Prodution Date</th>
                    <th>Line Number</th>
                    <th>Part Name</th>
                    <th>Part Category</th>
                    <th>Cycle Time</th>
                    <th>Production Time</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection

