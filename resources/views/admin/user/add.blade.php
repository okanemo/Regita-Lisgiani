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
              <form role="form" method="post" action="{{ url('admin/user/create') }}">
                {{ csrf_field() }}
                <div class="card-body">
                  
                <div class="form-group">
                    <label>Role</label>
                    <select class="custom-select" name="role_id" required>
                      <option value="">==Please Select==</option>
                      @foreach($role as $key)
                      <option value="{{$key['role_id']}}">{{$key['role_name']}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputText">Name</label>
                    <input type="text" name="fullname" class="form-control" id="exampleInputText" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputText">Account Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputText" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputText">Account Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputText" required>
                    <p>Must contain uppercase, lowecase, number, and special char</p>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputText">Account Confirmation Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="exampleInputText" required>
                  </div>
                  <div class="form-group">
                    <label>Employee Gender</label>
                    <select class="custom-select" name="gender">
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                  </div>
                  <div class="form-group">
                      <label>Account Status</label>
                      <select class="custom-select" name="status">
                        <option value="active">Active</option>
                        <option value="inactive">Deadactivated</option>
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