@extends('admin.layout.index')

@section('content')
<div class="card">
		<div class="col-lg-12">
			@if(Session::has('flash_message'))
				<div class="alert alert-{!! Session::get('flash_lever') !!}">
					{!! Session::get('flash_message') !!}
				</div>
			@endif
		</div>
		<div style="float: right; ">
			<a href="admin/hoahong/hoahongdoanhsodaily"><i class="fas fa-project-diagram" style="color: green"></i>  Cây hệ thống</a>
		</div>
		<h3>Danh sách đại lý</h3>
		
		<div class="card-body">
			
			<table class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="20%">Cấp</th>
						<th width="10%">Mã</th>
						<th width="15%">Đại lý</th>
						
						<th width="15%">Tổng doanh thu tháng</th>
					</tr>
				</thead>
				<tbody>

					@foreach($CustomerCon as $value)
						<tr>
							<td>
								Cấp 1
							</td>
							<td>
								{{$value->customer_username}}
							</td>
							<td>
								@if($value->package_id == 1)
									Gói đại lý miễn phí
								@endif
								@if($value->package_id == 2)
									Gói đại lý thường
								@endif
								@if($value->package_id == 3)
									Gói đại lý Vip
								@endif
							</td>
							
							<td>
								
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<hr>
			<table class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="20%">Cấp</th>
						<th width="10%">Mã</th>
						<th width="15%">Đại lý</th>
						
						<th width="15%">Tổng doanh thu tháng</th>
					</tr>
				</thead>
				<tbody>

					@foreach($CustomerCon as $value)
						@foreach($Customer as $valueCustomer)
							@if($value->customer_id == $valueCustomer->customer_parent)
							<tr>
								<td>
									Cấp 2
								</td>
								<td>
									
										
									{{$valueCustomer->customer_id}}
									
								</td>
								<td>
									@if($valueCustomer->package_id == 1)
										Gói đại lý miễn phí
									@endif
									@if($valueCustomer->package_id == 2)
										Gói đại lý thường
									@endif
									@if($valueCustomer->package_id == 3)
										Gói đại lý Vip
									@endif
								</td>
								
								<td>
									
								</td>
							</tr>
							@endif
						@endforeach
					@endforeach
				</tbody>
			</table>
			<hr>
			<table class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="20%">Cấp</th>
						<th width="10%">Mã</th>
						<th width="15%">Đại lý</th>
						
						<th width="15%">Tổng doanh thu tháng</th>
					</tr>
				</thead>
				<tbody>

					@foreach($CustomerCon as $value)
						@foreach($Customer as $valueCustomer)
							@if($value->customer_id == $valueCustomer->customer_parent)
								@foreach($Customer as $valueCustomerbac3)
								@if($valueCustomer->customer_id == $valueCustomerbac3->customer_parent)
							<tr>
								<td>
									Cấp 3
								</td>
								<td>
									
										
									{{$valueCustomerbac3->customer_id}}
									
								</td>
								<td>
									@if($valueCustomer->package_id == 1)
										Gói đại lý miễn phí
									@endif
									@if($valueCustomer->package_id == 2)
										Gói đại lý thường
									@endif
									@if($valueCustomer->package_id == 3)
										Gói đại lý Vip
									@endif
								</td>
								
								<td>
									
								</td>
							</tr>
								@endif
								@endforeach
							@endif
						@endforeach
					@endforeach
				</tbody>
			</table>
			<hr>
			<table class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="20%">Cấp</th>
						<th width="10%">Mã</th>
						<th width="15%">Đại lý</th>
						
						<th width="15%">Tổng doanh thu tháng</th>
					</tr>
				</thead>
				<tbody>

					@foreach($CustomerCon as $value)
						@foreach($Customer as $valueCustomer)
							@if($value->customer_id == $valueCustomer->customer_parent)
								@foreach($Customer as $valueCustomerbac3)
									@if($valueCustomer->customer_id == $valueCustomerbac3->customer_parent)
										@foreach($Customer as $valueCustomerbac4)
											@if($valueCustomerbac3->customer_id == $valueCustomerbac4->customer_parent)
												<tr>
													<td>
														Cấp 4
													</td>
													<td>
														
															
														{{$valueCustomerbac4->customer_id}}
														
													</td>
													<td>
														@if($valueCustomerbac4->package_id == 1)
															Gói đại lý miễn phí
														@endif
														@if($valueCustomerbac4->package_id == 2)
															Gói đại lý thường
														@endif
														@if($valueCustomerbac4->package_id == 3)
															Gói đại lý Vip
														@endif
													</td>
													
													<td>
														
													</td>
												</tr>
											@endif
										@endforeach
									@endif
								@endforeach
							@endif
						@endforeach
					@endforeach
				</tbody>
			</table>
			<hr>
			<table class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="20%">Cấp</th>
						<th width="10%">Mã</th>
						<th width="15%">Đại lý</th>
						
						<th width="15%">Tổng doanh thu tháng</th>
					</tr>
				</thead>
				<tbody>

					@foreach($CustomerCon as $value)
						@foreach($Customer as $valueCustomer)
							@if($value->customer_id == $valueCustomer->customer_parent)
								@foreach($Customer as $valueCustomerbac3)
									@if($valueCustomer->customer_id == $valueCustomerbac3->customer_parent)
										@foreach($Customer as $valueCustomerbac4)
											@if($valueCustomerbac3->customer_id == $valueCustomerbac4->customer_parent)
												@foreach($Customer as $valueCustomerbac5)
													@if($valueCustomerbac4->customer_id == $valueCustomerbac5->customer_parent)
												<tr>
													<td>
														Cấp 5
													</td>
													<td>
														
															
														{{$valueCustomerbac5->customer_id}}
														
													</td>
													<td>
														@if($valueCustomerbac5->package_id == 1)
															Gói đại lý miễn phí
														@endif
														@if($valueCustomerbac5->package_id == 2)
															Gói đại lý thường
														@endif
														@if($valueCustomerbac5->package_id == 3)
															Gói đại lý Vip
														@endif
													</td>
													
													<td>
														
													</td>
												</tr>
													@endif
												@endforeach
											@endif
										@endforeach
									@endif
								@endforeach
							@endif
						@endforeach
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

@endsection
<style type="text/css">
	.centers a{
		margin-left: 40px;

	}

	.centerss a{
		margin-left: 20px;
	}
</style>