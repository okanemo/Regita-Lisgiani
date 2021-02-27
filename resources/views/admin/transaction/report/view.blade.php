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
	<section class="content">
	  <div class="container-fluid">
		<div class="row">
			
			  
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
		  <div class="col-md-4">
			<div class="card">
			  <div class="card-header">
				<h3 class="card-title">Report Data</h3>
			  </div>
			  <!-- /.card-header -->
			  <div class="card-body">
				<table id="example1" class="table table-bordered table-striped">
					<tbody>
					<tr>
						<td><b>Income</b></td>
						<td>{{$income->sum('total')}}</td>
					</tr>
					<tr>
						<td><b>Expance</b></td>

						<td>{{$expance->sum('total')}}</td>
					</tr>
					<tr>
						<td><b>Profit</b></td>
						<td>{{$income->sum('total')-$expance->sum('total')}}</td>
					</tr>
					</tbody>
				</table>
			  </div>
			</div>
		  </div>
		  <!-- /.col -->
		  <div class="col-md-4">
			<div class="card">
			  <div class="card-header">
				<h3 class="card-title">Income Total Report</h3>
			  </div>
			  <!-- /.card-header -->
			  <div class="card-body p-0">
				<table id="example2" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Category</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>

					@foreach($income->get() as $key)
					<tr>
						<td>{{$key['category']['name']}}</td>
						<td>{{$key['total']}}</td>
					</tr>
					@endforeach
					</tbody>
				</table>
			  </div>
			  <!-- /.card-body -->
			</div>
			<!-- /.card -->
		  </div>
		  
		  <!-- /.col -->
		  <div class="col-md-4">
			<div class="card">
			  <div class="card-header">
				<h3 class="card-title">Expance Total Report</h3>
			  </div>
			  <!-- /.card-header -->
			  <div class="card-body p-0">
				<table id="example2" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Category</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>

					@foreach($expance->get() as $key)
					<tr>
						<td>{{$key['category']['name']}}</td>
						<td>{{$key['total']}}</td>
					</tr>
					@endforeach
					</tbody>
				</table>
			  </div>
			  <!-- /.card-body -->
			</div>
			<!-- /.card -->
		  </div>
	</section>
	<section class="content">
	  <div class="container-fluid">
		<div class="row">
		  <!-- /.col -->
		  <div class="col-md-6">
			<div class="card">
			  <div class="card-header">
				<h3 class="card-title">Income Sub Category Total</h3>
			  </div>
			  <!-- /.card-header -->
			  <div class="card-body p-0">
				<table id="example2" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Category Name</th>
							<th>Sub Category Name</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>

					@foreach($detail_income->get() as $key)
					<tr>
						<td>{{$key['subcategory']['category']['name']}}</td>
						<td>{{$key['subcategory']['name']}}</td>
						<td>{{$key['total_details_bysub']}}</td>
					</tr>
					@endforeach
					</tbody>
				</table>
			  </div>
			  <!-- /.card-body -->
			</div>
			<!-- /.card -->
		  </div>
		  
		  <!-- /.col -->
		  <div class="col-md-6">
			<div class="card">
			  <div class="card-header">
				<h3 class="card-title">Expance Sub Category Total Report</h3>
			  </div>
			  <!-- /.card-header -->
			  <div class="card-body p-0">
				<table id="example2" class="table table-bordered table-striped">
				<thead>
						<tr>
							<th>Category Name</th>
							<th>Sub Category Name</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>

					@foreach($detail_expance->get() as $key)
					<tr>
						<td>{{$key['subcategory']['category']['name']}}</td>
						<td>{{$key['subcategory']['name']}}</td>
						<td>{{$key['total_details_bysub']}}</td>
					</tr>
					@endforeach
					</tbody>
				</table>
			  </div>
			  <!-- /.card-body -->
			</div>
			<!-- /.card -->
		  </div>
	</section>
	</div>
@endsection

