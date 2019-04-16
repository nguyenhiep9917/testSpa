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

		<h3>Danh sách đại lý chờ phê duyệt</h3>
		<div class="card-body">
			
			<table  class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="20%">Họ tên</th>
						<th width="15%">Email</th>
						<th width="10%">Số điện thoại</th>
						<th width="10%">Ngày mua</th>
						<th width="10%">Giá gói</th>
						<th width="15%">Trạng thái</th>
						<th width="7%"></th>
					</tr>
				</thead>
				<tbody>
					@foreach($order as $value)
					@if($value->order_package > 0 && $value->order_package < 4)
							<tr>
								<td>
									@foreach($customer as $valcustomer)
									@if($value->customer_id == $valcustomer->customer_id)
										{{$valcustomer->customer_username}}
									@endif
									@endforeach
								</td>
								<td>
									@foreach($customer as $valcustomer)
									@if($value->customer_id == $valcustomer->customer_id)
										{{$valcustomer->customer_email}}
									@endif
									@endforeach
								</td>
								<td>
									@foreach($customer as $valcustomer)
									@if($value->customer_id == $valcustomer->customer_id)
										{{$valcustomer->customer_phone}}
									@endif
									@endforeach
								</td>
								<td>
									{{$value->order_createdate}}
								</td>
								<td>
									{{$value->order_totalvalue}}
								</td>
								<td>
									<li class="check_ringt dropdown acounts">
                                        <a class="nav-link dropdown-toggle tk " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="far fa-calendar-check fa-lg"></i>
                                        <lable style="color:blue; font-weight: bold;">Chưa xác nhận</lable> 
                                        </a>
                                        <div class="dropdown-menu centers">
                                          <a class="dropdown-item" href="admin/quanly/xacnhanmuagoidaily/{{$value->customer_id}}"><span>Xác nhận</span></a><br>
                                          <a class="dropdown-item" href="admin/quanly/xem-thong-tin-chi-tiet/{{$value->customer_id}}"><span>Xem thông tin</span></a>
                                        </div>
                                    </li>
								</td>
								<td style="text-align: center;">
									<a href="admin/quanly/AdminXacNhanPackage/{{$value->customer_id}}">
										
										<i class="fas fa-trash-alt" style="color: red"></i>
									</a>
								</td>
							</tr>
							@endif
					@endforeach
				</tbody>
			</table>
		</div>

		<h3>Danh sách đại lý</h3>
		<div class="card-body">
			
			<table id="DataList" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="20%">Thành viên</th>
						<th width="20%">Đại lý</th>
						<th width="10%">Giá</th>
						<th width="15%">Ngày xác nhận</th>
						<th width="10%">Mã</th>
						<th width="15%">Trạng thái</th>
						<th width="10%"></th>
					</tr>
				</thead>
				<tbody>
					@foreach($dataDL as $value)
						
							<tr>
								<td>@foreach($customer as $valcustomer)
										@if($value->customer_id == $valcustomer->customer_id)
											{{$valcustomer->customer_username}}
										@endif
									@endforeach</td>
								<td>
									@foreach($customer as $valcustomer)
										@if($value->customer_id == $valcustomer->customer_id)
											@if($valcustomer->package_id == 1)
												<p>Gói miễn phí</p>
											@endif
											@if($valcustomer->package_id == 2)
												<p>Gói thường</p>
											@endif
											@if($valcustomer->package_id == 3)
												<p>Gói Vip</p>
											@endif
										@endif
									@endforeach
								</td>
								<td>
									{{$value->hoahongdoanhsodaily_tong}}
								</td>
								<td>
									{{$value->hoahongdoanhsodaily_createdate}}
								</td>
								<td>
									<p style="background-color: #9dfcb1; text-align: center;">
										GDL{{$value->hoahongdoanhsodaily_id}}
									</p>
								</td>
								<td style="text-align: center;">
									<p style="background-color: #79cc1d; color: white">
										Đã xác nhận
									</p> 
								</td>
								<td style="text-align: center;">
									@foreach($customer as $valcustomer)
										@if($value->customer_id == $valcustomer->customer_id)
											<a href="admin/quanly/capnhathongtindaily/{{$valcustomer->customer_id}}">
												<i class="fas fa-external-link-alt"></i> 
											</a>
										@endif
									@endforeach
									
									/
									<a href="">
										<i class="fas fa-trash-alt" style="color: red"></i>
									</a>
								</td>
							</tr>
							
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