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
						<th width="3%"  style="text-align: center;">Cấp</th>
						<th width="15%"  style="text-align: center;">Tên đại lý</th>
						<th width="15%"  style="text-align: center;">Email</th>
						<th width="15%"  style="text-align: center;">Gói đại lý</th>
						<th width="13%"  style="text-align: center;">Tổng tiền trong ví</th>
						<th width="13%"  style="text-align: center;">Tổng tiền hoa hồng</th>
						<th width="13%"  style="text-align: center;">Tổng doanh thu tháng</th>
						<th width="12%"  style="text-align: center;">
							<?php 
								$date = getdate(); 
								$ngay = $date['mday'];
								$ngayconlai = 14 - $ngay;
								if($ngayconlai == 0 || $ngayconlai == 2 || $ngayconlai == 3 || $ngayconlai == 1){
									echo 'Chức năng đã mở';
								}
								else {
									echo 'Còn '.$ngayconlai.' ngày nữa cập nhật';
								}
							?>
						</th>
					</tr>
				</thead>
				<tbody>

					@foreach($dataDL as $value)
						@foreach($customer as $valueCustommer)
						@if($value->customer_id == $valueCustommer->customer_id)
						<tr>
							<td>
								DL{{$value->hoahongdoanhsodaily_id}}
							</td>
							<td>
								{{$valueCustommer->customer_username}}
							</td>
							<td>
								{{$valueCustommer->customer_email}}
							</td>
							<td>
								@if($value->customer_id == $valueCustommer->customer_id && $valueCustommer->package_id == 1)
									Gói đại lý miễn phí
								@endif
								@if($value->customer_id == $valueCustommer->customer_id && $valueCustommer->package_id == 2)
									Gói đại lý thường
								@endif
								@if($value->customer_id == $valueCustommer->customer_id && $valueCustommer->package_id == 3)
									Gói đại lý Vip
								@endif
							</td>
							<td>
								{{number_format($value->hoahongdoanhsodaily_tong,0 ,',','.')}}
							</td>
							<td>
								{{number_format($value->hoahongdoanhsodaily_TongHoaHong,0 ,',','.')}}
							</td>
							<td>
								<?php
									$idCustomerDaiLy = $value->customer_id;
									// tìm các order mà dai lý này mua trong tháng 
									$orderCuaDaiLy = \App\Order::where('customer_id', $idCustomerDaiLy)
									->where('doneupdata', 0)
									->where('paymenttype_id', '<', 8)
									->where('payment_status', '=', 1)
									->get();
									$tongtiendonhangthang = 0;
									foreach ($orderCuaDaiLy as $value) {
										$tongtiendonhangthang += $value->order_totalvalue;
										
									}
									echo number_format($tongtiendonhangthang,0 ,',','.');
								?>
							</td>

							<td>
								<?php 
								$date = getdate(); 
								$ngay = $date['mday'];
								$ngayconlai = 14 - $ngay;
								if($ngayconlai == 0 || $ngayconlai == 2 || $ngayconlai == 3 || $ngayconlai == 1)
								{
									echo '<a href="admin/capnhatHoaHonh/cap-nhat/'.$value->customer_id.'">Cập nhật</a>';
								}
								else {
									echo "";
								}
							?>
								
							</td>
						</tr>
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