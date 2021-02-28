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
							<form role="form" method="post" action="{{ url('admin/expance/create') }}">
								{{ csrf_field() }}
								<input type="text" name="type" value="expance" style="display:none">
								<input type="text" name="user_id" value="{{Session::get('Users.id')}}" style="display:none">
								<div class="card-body">
								<div class="form-group">
										<label for="exampleInputText">Category</label>
										<select class="custom-select" name="category_id" required>
											<option value="">== Please Select Category ==</option>
											@foreach($category as $key)
											<option value="{{$key['id']}}">{{$key['name']}}</option>
											@endforeach
										</select>
									</div>
									
									<div class="form-group">
											<label for="state">Sub Category:</label>
											<select name="sub_category_id" class="form-control">
											<option value="">== Please Select Sub Category ==</option>
											</select>
									</div>
									<div class="form-group">
										<label for="exampleInputText">Date</label>
										<input type="date" required name="spent_at" class="form-control" id="exampleInputText">
									</div>
									<div class="form-group">
										<label for="exampleInputText">Amount</label>
										<input type="number" required name="total" min="0" class="form-control" id="exampleInputText" placeholder="10000">
									</div>
									<div class="form-group">
										<label for="exampleInputText">Remarks</label>
										<input type="text" class="form-control" name="remarks">
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
<script type="text/javascript">
		jQuery(document).ready(function ()
		{
						jQuery('select[name="category_id"]').on('change',function(){
							 var categoryId = jQuery(this).val();
							 if(categoryId)
							 {
									jQuery.ajax({
										 url : 'dropdownlist/get-subcategory/' +categoryId,
										 type : "GET",
										 dataType : "json",
										 success:function(data)
										 {
												console.log(data);
												jQuery('select[name="sub_category_id"]').empty();
												jQuery.each(data, function(key,value){
													 $('select[name="sub_category_id"]').append('<option value="'+ key +'">'+ value +'</option>');
												});
										 }
									});
							 }
							 else
							 {sub_category_id
									$('select[name="state"]').empty();
							 }
						});
		});
		</script>

