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
            <!-- general form elements -->
            <div class="card card-primary">
              <!-- form start -->
              <form role="form" method="post" action="{{ url('admin/user/update/'.$data['id']) }}">
                {{ csrf_field() }}
                <div class="card-body">
                  
                <div class="form-group">
                    <label>Role</label>
                    <select class="custom-select" name="role_id" required>
                      <option value="">==Please Select==</option>
                      @foreach($role as $key)
                      <option value="{{$key['role_id']}}" @if($data['role_id']==$key['role_id']) selected @endif>{{$key['role_name']}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputText">Name</label>
                    <input type="text" name="fullname" class="form-control" id="exampleInputText"  value="{{$data['fullname']}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputText">Account Email</label>
                    <input type="email" disabled class="form-control" id="exampleInputText" value="{{$data['email']}}">
                  </div>
                  <div class="form-group">
                    <label>Employee Gender</label>
                    <select class="custom-select" name="gender">
                      <option value="Male" @if($data['gender']=="Male") selected @endif>Male</option>
                      <option value="Female" @if($data['gender']=="Female") selected @endif>Female</option>
                    </select>
                  </div>
                  <div class="form-group">
                      <label>Account Status</label>
                      <select class="custom-select" name="status">
                        <option value="active"  @if($data['status']=="active") selected @endif>Active</option>
                        <option value="inactive" @if($data['status']=="inactive") selected @endif>Deadactivated</option>
                      </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
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
  </div>
  @endsection