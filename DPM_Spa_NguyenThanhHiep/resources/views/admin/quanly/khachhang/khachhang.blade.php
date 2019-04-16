@extends('admin.layout.index')

@section('content')
<div class="card">
		<h3>Khách hàng</h3>
		<div class="card-body">
			<p>
		
				<a href="admin/quanly/khachhang/them" class="btn btn-default" style="background-color: #8ce4e8; border-radius: 3px;">Thêm</a>
				<!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalImport"><i class="fal fa-upload"></i> Nhập từ Excel</button>
				<a href="#" class="btn btn-warning"><i class="fal fa-download"></i> Xuất ra Excel</a> (<a href="#">Tải file mẫu</a>) -->
			</p>
			<table id="DataList" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="3%">#</th>
						<th width="10%">Tài khoản</th>
						<th width="18%">Họ và tên</th>
						<th width="9%">Giớ tính</th>
						<th width="15%">Email</th>
						<th width="12%">Số điện thoại</th>
						<th width="10%">Trạng thái</th>
						<th width="10%">Đại lý</th>
						<th width="10%">Hành Động</th>
						<th width="3%"></th>
					</tr>
				</thead>
				<tbody>
					@php $count = 1; @endphp
					@foreach($dataCustomer as $value)
						<tr>
							<td>{{$count++}}</td>
							<td>{{$value->customer_account_name}}</td>
							<td>{{$value->customer_username}}</td>
							<td>
								@if($value->customer_sex == 1)
									Nam
								@endif
								@if($value->customer_sex == 2)
									Nữ
								@endif
								@if($value->customer_sex == 3)
									Khác
								@endif
							</td>
							<td>{{$value->customer_email}}</td>
							<td>{{$value->customer_phone}}</td>
							<td>
								<?php
									if($value->customer_status == 0)
									{
										echo 'Chưa kích hoạt(Comfirm)';
									}
									else if($value->customer_status == 1 
										&& $value->customer_type_verify != "" 
										&& $value->customer_identity_card != "" 
										&& $value->customer_image_face_before != "" 
										&& $value->customer_image_face_after != "" 
										&& $value->customer_account_name != "" 
										&& $value->customer_account_number != "" 
										&& $value->customer_address != "" 
										&& $value->customer_phone != "" 
										&& $value->customer_email != "" 
									)
									{
										echo 'Kích hoạt';
									}
									else {
										echo 'Chưa Cập Nhật Thông Tin';
									}

								?>
							</td>
							<td>
								<!-- @if($value->package_id == 0)
									<div class="alert-success" style="font-size: 12px">
										Khách hàng thường
									</div>
								@endif -->
								@if($value->package_id == 1)
									<div class="alert-success" style="font-size: 12px; text-align: center;">
										Gói Miễn Phí
									</div>
								@endif
								@if($value->package_id == 2)
									<div class="alert-dark " style="font-size: 12px; background-color: #eff168;  text-align: center;">
										Gói Thường
									</div>
								@endif
								@if($value->package_id == 3)
									<div class="alert-danger " style="font-size: 12px;  text-align: center;">
										Gói Vip
									</div>
								@endif
							</td>
							<td>
								<ul class="nav nav-tabs">
								  <li class="nav-item dropdown">
								    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><label style="font-size: 9px;">Cập nhật</label></a>
								    <div class="dropdown-menu capnhat_kh">
								      <a class="dropdown-item fixx" href="#"><i class="fas fa-edit"></i>  Sửa(trạng thái)</a><br>
								      <a class="dropdown-item fixx" href="#"><i class="fab fa-expeditedssl"></i>  Khóa</a><br>
								      <a class="dropdown-item fixx" href="#"><i class="fas fa-trash-alt"></i>  	Xóa</a>
								    </div>
								  </li>
								</ul>
							</td>
							<td>
	                          <a href="admin/quanly/xem-thong-tin-khach-hang/{{$value->customer_id}}" target="_blank" title="Xem thông tin khách hàng" rel="follow, index">
	                          	<i class="fas fa-external-link-alt"></i>
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
	.nav-tabs{
		margin-top: -5px;
		margin-bottom: -5px;
	}
	.capnhat_kh{
		margin: 0 auto;
		text-align: center;
	}
	.fixx{
		text-align: center;
		margin-left: 50px;
	}
</style>