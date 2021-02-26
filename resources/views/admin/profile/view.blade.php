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
      
        @if($errors->any())
            <div class="alert alert-danger">
            {{$errors->first()}}
            </div>
        @endif
        @if (Session::has('success'))
          <div class="alert alert-success">
            {{Session::get('success')}}
            </div>
        @endif
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data</h3>
              </div>
              <div class="card-body">
                <dl class="row">
                  <dt class="col-sm-4">Fullname</dt>
                  <dd class="col-sm-8">{{Session::get('Users.fullname')}}</dd>
                  <dt class="col-sm-4">Email</dt>
                  <dd class="col-sm-8">{{Session::get('Users.email')}}</dd>
                  <dt class="col-sm-4">Status</dt>
                  <dd class="col-sm-8">{{Session::get('Users.status')}}</dd>
                  <dt class="col-sm-4">Role</dt>
                  <dd class="col-sm-8">{{Session::get('Users.role.role_name')}}</dd>
                </dl>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
            
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Change Password</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="{{ url('/admin/profile/change-password') }}">
              {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Current Password</label>
                    <input type="password" class="form-control"  name ="password" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">New Password</label>
                    <input type="password" name="newpassword" class="form-control" minlength="8" id="exampleInputPassword1" placeholder="Password">
                    <p>Must contain uppercase, lowecase, number, and special char</p>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Confirm Password</label>
                    <input type="password" name="confirm_newpassword" class="form-control"  minlength="8" id="exampleInputPassword1" placeholder="Password">
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

