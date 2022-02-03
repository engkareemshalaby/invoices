@extends('layouts.master')
@section('title')
	قائمة المنتجات
@endsection
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الإعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ المنتجات</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
<!--div-->
<div class="col-xl-12">
	<div class="card">
		<div class="card-header pb-0">

			@if (session()->has('Add'))
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong> {{ session()->get('Add') }}</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">3</span>
				</button>
			  </div>
			@endif

			@if (session()->has('Edit'))
			<div class="alert alert-info alert-dismissible fade show" role="alert">
				<strong> {{ session()->get('Edit') }}</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">3</span>
				</button>
			  </div>
			@endif
			
			@if (session()->has('Delete'))
			<div class="alert alert-info alert-dismissible fade show" role="alert">
				<strong> {{ session()->get('Delete') }}</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">3</span>
				</button>
			  </div>
			@endif

			@if (session()->has('Error'))
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong> {{ session()->get('Error') }}</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">2</span>
				</button>
			  </div>
			@endif

			<div class="col-sm-6 col-md-4 col-xl-3">
				<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-slide-in-bottom" data-toggle="modal" href="#select2modal">إضافة منتج + </a>
			</div>		
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table text-md-nowrap" id="example2">
					<thead>
						<tr>
							<th class=" ">#</th>
							<th class=" ">اسم المنتج</th>
							<th class=" ">اسم القسم</th>
							<th class=" ">الوصف</th>
							<th class=" ">العمليات</th>
							

						</tr>
					</thead>
					<tbody>
						
						
						@php
						$i = 0;
					@endphp
					@foreach ($products as $product)
						<tr>
							@php
								$i++;
							@endphp
							<td col-md-4>{{$i}}</td>
							<td col-md-4>{{$product->product_name}}</td>
							<td col-md-4>{{$product->description}}</td>
							<td col-md-4>
								<a title="تعديل" class="btn ripple btn-info"
									data-id="{{$product->id}}" data-product_name="{{$product->product_name}}" data-description="{{$product->description}}"
									data-target="#modaldemo3" data-toggle="modal" href="">
									<span class="fa fa-edit"></span>
								</a>
								<a title="حذف" class="btn ripple btn-danger"
								data-id="{{$product->id}}" data-product_name="{{$product->product_name}}" data-description="{{$product->description}}"
								data-target="#modaldemo4" data-toggle="modal" href="">
									<span class="fa fa-trash-alt"></span>
								</a>
							</td>
						</tr>
					@endforeach
							
							
						
					</tbody>
				</table>
			</div>
		</div><!-- bd -->
	</div><!-- bd -->

			<!-- Basic modal -->
			<div class="modal" id="select2modal">
				<div class="modal-dialog" role="document">
					<div class="modal-content modal-content-demo">
						<div class="modal-header">
							<h6 class="modal-title">إضافة قسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
							<form action="{{route('products.store')}}" method="POST">
								{{ csrf_field() }}
								<div class="form-group">
									<label for="">اسم المنتج</label>
									<input type="text" class="form-control" name="product_name" id="product_name">
								</div>
								<div class="form-group">
									<label for="">القسم</label>
									<select name="section_id" id="section_id" class="form-select form-control" aria-label="Default select example">
										<option selected disabled>اختيار القسم</option>
										@foreach ($sections as $section)
										<option name="{{$section->id}}"  value="{{$section->id}}">{{$section->section_name}}</option>
										@endforeach

									  </select>
								</div>
								<div class="form-group">
									<label for="">وصف المنتج</label>
									<textarea type="text" class="form-control" name="description" id="description"></textarea>
								</div>
								
						</div>
						<div class="modal-footer">
							<button class="btn ripple btn-primary" type="submit">تأكيد </button>
							<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إلغاء</button>
						</div>
					</form>
					</div>
				</div>
			</div>
			<!-- End Basic modal -->

			<!-- Edit modal -->
			<div class="modal" id="modaldemo3">
				<div class="modal-dialog" role="document">
					<div class="modal-content modal-content-demo">
						<div class="modal-header">
							<h6 class="modal-title">تعديل القسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
							<form action="sections/update" method="POST" autocomplete="off">
								{{method_field('patch')}}
								{{ csrf_field() }}
								<input type="hidden" name="id" id="id">
								<div class="form-group">
									<label for="">اسم القسم</label>
									<input type="text" class="form-control" name="section_name" id="section_name">
								</div>
								<div class="form-group">
									<label for="">وصف القسم</label>
									<textarea type="text" class="form-control" name="description" id="description"></textarea>
								</div>
								
						</div>
						<div class="modal-footer">
							<button class="btn ripple btn-primary" type="submit">تأكيد </button>
							<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إلغاء</button>
						</div>
					</form>
					</div>
				</div>
			</div>
			<!-- End Edit modal -->

			<!-- Delete modal -->
			<div class="modal" id="modaldemo4">
				<div class="modal-dialog" role="document">
					<div class="modal-content modal-content-demo">
						<div class="modal-header">
							<h6 class="modal-title"> حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
							<form action="sections/destroy" method="POST" autocomplete="off">
								{{method_field('delete')}}
								{{ csrf_field() }}
								<input type="hidden" name="id" id="id">
								
									
								
								<div class="form-group">
									<label for=""> هل أنت متأكد من حذف القسم</label>
									<input type="text" class="form-control" name="section_name" id="section_name" readonly>
								</div>
								
						</div>
						<div class="modal-footer">
							<button class="btn ripple btn-primary" type="submit">تأكيد الحذف </button>
							<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إلغاء</button>
						</div>
					</form>
					</div>
				</div>
			</div>
			<!-- End Delete modal -->
</div>
<!--/div-->
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<script>
    $('#modaldemo3').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var section_name = button.data('section_name')
        var description = button.data('description')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #section_name').val(section_name);
        modal.find('.modal-body #description').val(description);
    })
</script>
<script>
    $('#modaldemo4').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var section_name = button.data('section_name')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #section_name').val(section_name);

    })
</script>
@endsection