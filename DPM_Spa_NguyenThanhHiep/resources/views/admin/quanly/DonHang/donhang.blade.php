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
		<h3>Đơn hàng chờ xét duyệt</h3>
		<div class="card-body">
			<table class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="3%">#</th>
						<th width="14%">Tên khách hàng</th>
						
						<th width="8%">Số điện thoại</th>
						<th width="10%">Ngày đặt</th>
						<th width="18%">Sản phẩm</th>
						<th width="13%">Tổng tiền</th>
						<th width="15%">Trạng thái</th>
						<th width="14%">Tình trạng</th>
						
						<th width="5%">Sửa</th>
					</tr>
				</thead>
				<tbody>
					@php $count = 1; @endphp
					@foreach($data_Order as $value)
						@if($value->confirm_status == 0)
						<tr>
							<td>{{$count++}}</td>
							<td>
							@foreach($find_customer as $valcustomer)
								@if($value->customer_id == $valcustomer->customer_id)
									{{$valcustomer->customer_username}}
								@endif
							@endforeach
							</td>
							<td>
								@foreach($find_customer as $valcustomer)
								@if($value->customer_id == $valcustomer->customer_id)
									{{$valcustomer->customer_phone}}
								@endif
							@endforeach
							</td>
							<td>
								{{$value->order_createdate}}
							</td>
							<td>
								@foreach($data_Order_detail as $val)
									@if($val->order_id == $value->order_id)
										@foreach($product as $vlProduct)
											@if($val->product_id == $vlProduct->id)
												{{$vlProduct->product_name}} <br>
											@endif
										@endforeach
									@endif
								@endforeach
							</td>
							<td>
								{{number_format($value->order_totalvalue,0,',','.')}} VNĐ
							</td>
							<td>
								<?php
									$idOrder =  $value->order_id;
									$dataOrder = \App\Order::where('order_id', $idOrder)->first();
									$keyxacnhan = 1;
									$keyhuy = 2;
									$keythanhtoan = 1;
									if($dataOrder->confirm_status == 0)
	                                {
										echo '
											<li class="check_ringt dropdown acounts">
		                                        <a class="nav-link dropdown-toggle tk " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
		                                        <i class="far fa-calendar-check fa-lg"></i>
		                                        <lable style="color:blue; font-weight: bold;">Chưa xác nhận</lable> 
		                                        </a>
		                                        <div class="dropdown-menu centers">
		                                          <a class="dropdown-item" href="admin/quanly/xacnhandonhang/'.$dataOrder->order_id.'/'.$keyxacnhan.'"><span>Xác nhận</span></a><br>
		                                          <a class="dropdown-item" href="admin/quanly/xacnhandonhang/'.$dataOrder->order_id.'/'.$keyhuy.'"><span>Hủy đơn hàng</span></a>
		                                        </div>
		                                    </li>
										';
									}
									if($dataOrder->confirm_status == 1 || $dataOrder->confirm_status == 3)
	                                {
										echo '
											<li class="check_ringt dropdown acounts">
		                                        <a class="nav-link dropdown-toggle tk " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
		                                        <i class="far fa-calendar-check fa-lg"></i>
		                                        	<lable style="color:#279000; font-weight: bold;">Đã xác nhận</lable> 
		                                        </a>
		                                        <div class="dropdown-menu centers">
		                                           <a class="dropdown-item" href="admin/quanly/xacnhandonhang/'.$dataOrder->order_id.'/'.$keyxacnhan.'"><span>Xác nhận</span></a><br>
		                                          <a class="dropdown-item" href="admin/quanly/xacnhandonhang/'.$dataOrder->order_id.'/'.$keyhuy.'"><span>Hủy đơn hàng</span></a>
		                                        </div>
		                                    </li>
										';
									}
									if($dataOrder->confirm_status == 2)
	                                {
										echo '
											<li class="check_ringt dropdown acounts">
		                                        <a class="nav-link dropdown-toggle tk " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
		                                        <i class="far fa-calendar-check fa-lg"></i>
		                                        	<lable style="color:red; font-weight: bold;">Đã hủy</lable> 
		                                        </a>
		                                        <div class="dropdown-menu centers">
		                                           <a class="dropdown-item" href="admin/quanly/xacnhandonhang/'.$dataOrder->order_id.'/'.$keyxacnhan.'"><span>Xác nhận</span></a><br>
		                                          <a class="dropdown-item" href="admin/quanly/xacnhandonhang/'.$dataOrder->order_id.'/'.$keyhuy.'"><span>Hủy đơn hàng</span></a>
		                                        </div>
		                                    </li>
										';
									}
								?>
								
							</td>
							<td>
								<?php
									$idOrder =  $value->order_id;
									$dataOrder = \App\Order::where('order_id', $idOrder)->first();
									if($dataOrder->payment_status == 0)
	                                {
										echo '
											<li class="check_ringt dropdown acounts">
		                                        <a class="nav-link dropdown-toggle tk " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
		                                        	<lable style="color:blue; font-weight: bold;">Chưa thanh toán</lable> 
		                                        </a>
		                                        <div class="dropdown-menu centerss">
		                                          <a class="dropdown-item" href="admin/quanly/xacnhanthanhtoan/'.$dataOrder->order_id.'/'.$keythanhtoan.'"><span>Xác nhận thanh toán</span></a><br>
		                                          
		                                        </div>
		                                    </li>
										';
									}
									if($dataOrder->payment_status == 1)
	                                {
										echo '
											<li class="check_ringt dropdown acounts">
		                                        <a class="nav-link dropdown-toggle tk " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" >
		                                       		<lable style="color:#279000; font-weight: bold;">Đã thanh toán</lable> 
		                                        </a>
		                                        <div class="dropdown-menu centerss">
		                                          <a class="dropdown-item" href="admin/quanly/xacnhanthanhtoan/'.$dataOrder->order_id.'/'.$keythanhtoan.'"><span>Xác nhận thanh toán</span></a><br>
		                                         
		                                        </div>
		                                    </li>
										';
									}
								?>
							</td>
							
							<td class="text-center"><a href="#" ><i class="fas fa-edit"></i></a>
							</td>
						</tr>
						@endif
					@endforeach
				</tbody>
			</table>
		</div>





		<h3>Quản lý đơn hàng</h3>
		<div class="card-body">
			<p>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fal fa-plus"></i> Thêm</button>
				<!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalImport"><i class="fal fa-upload"></i> Nhập từ Excel</button> -->
				<a href="{{route('xuatExcel.excelOrder')}}" class="btn btn-warning"><i class="fal fa-download"></i> Xuất ra Excel</a> (<a href="#">Tải file mẫu</a>)
			</p>
			<table id="DataList" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="3%">#</th>
						<th width="14%">Tên khách hàng</th>
						
						<th width="8%">Số điện thoại</th>
						<th width="10%">Ngày đặt</th>
						<th width="18%">Sản phẩm</th>
						<th width="13%">Tổng tiền</th>
						<th width="15%">Trạng thái</th>
						<th width="14%">Tình trạng</th>
						<th width="5%">Sửa</th>
					</tr>
				</thead>
				<tbody>
					@php $count = 1; @endphp
					@foreach($data_Order as $value)
						@if($value->confirm_status != 0 )
						<tr>
							<td>{{$count++}}</td>
							<td>
							@foreach($find_customer as $valcustomer)
								@if($value->customer_id == $valcustomer->customer_id)
									{{$valcustomer->customer_username}}
								@endif
							@endforeach
							</td>
							<td>
								@foreach($find_customer as $valcustomer)
								@if($value->customer_id == $valcustomer->customer_id)
									{{$valcustomer->customer_phone}}
								@endif
							@endforeach
							</td>
							<td>
								{{$value->order_createdate}}
							</td>
							<td>
								@foreach($data_Order_detail as $val)
									@if($val->order_id == $value->order_id)
										@foreach($product as $vlProduct)
											@if($val->product_id == $vlProduct->id)
												{{$vlProduct->product_name}} <br>
											@endif
										@endforeach
									@endif
								@endforeach
							</td>
							<td>
								{{number_format($value->order_totalvalue,0,',','.')}} VNĐ
							</td>
							<td>
								<?php
									$idOrder =  $value->order_id;
									$dataOrder = \App\Order::where('order_id', $idOrder)->first();
									$keyxacnhan = 1;
									$keyhuy = 2;
									$keythanhtoan = 1;
									if($dataOrder->confirm_status == 0)
	                                {
										echo '
											<li class="check_ringt dropdown acounts">
		                                        <a class="nav-link dropdown-toggle tk " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
		                                        <i class="far fa-calendar-check fa-lg"></i>
		                                        <lable style="color:blue; font-weight: bold;">Chưa xác nhận</lable> 
		                                        </a>
		                                        <div class="dropdown-menu centers">
		                                          <a class="dropdown-item" href="admin/quanly/xacnhandonhang/'.$dataOrder->order_id.'/'.$keyxacnhan.'"><span>Xác nhận</span></a><br>
		                                          <a class="dropdown-item" href="admin/quanly/xacnhandonhang/'.$dataOrder->order_id.'/'.$keyhuy.'"><span>Hủy đơn hàng</span></a>
		                                        </div>
		                                    </li>
										';
									}
									if($dataOrder->confirm_status == 1 || $dataOrder->confirm_status == 3)
	                                {
										echo '
											<li class="check_ringt dropdown acounts">
		                                        <a class="nav-link dropdown-toggle tk " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
		                                        <i class="far fa-calendar-check fa-lg"></i>
		                                        	<lable style="color:#279000; font-weight: bold;">Đã xác nhận</lable> 
		                                        </a>
		                                        <div class="dropdown-menu centers">
		                                           <a class="dropdown-item" href="admin/quanly/xacnhandonhang/'.$dataOrder->order_id.'/'.$keyxacnhan.'"><span>Xác nhận</span></a><br>
		                                          <a class="dropdown-item" href="admin/quanly/xacnhandonhang/'.$dataOrder->order_id.'/'.$keyhuy.'"><span>Hủy đơn hàng</span></a>
		                                        </div>
		                                    </li>
										';
									}
									if($dataOrder->confirm_status == 2)
	                                {
										echo '
											<li class="check_ringt dropdown acounts">
		                                        <a class="nav-link dropdown-toggle tk " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
		                                        <i class="far fa-calendar-check fa-lg"></i>
		                                        	<lable style="color:red; font-weight: bold;">Đã hủy</lable> 
		                                        </a>
		                                        <div class="dropdown-menu centers">
		                                           <a class="dropdown-item" href="admin/quanly/xacnhandonhang/'.$dataOrder->order_id.'/'.$keyxacnhan.'"><span>Xác nhận</span></a><br>
		                                          <a class="dropdown-item" href="admin/quanly/xacnhandonhang/'.$dataOrder->order_id.'/'.$keyhuy.'"><span>Hủy đơn hàng</span></a>
		                                        </div>
		                                    </li>
										';
									}
								?>
								
							</td>
							<td>
								<?php
									$idOrder =  $value->order_id;
									$dataOrder = \App\Order::where('order_id', $idOrder)->first();
									if($dataOrder->payment_status == 0)
	                                {
										echo '
											<li class="check_ringt dropdown acounts">
		                                        <a class="nav-link dropdown-toggle tk " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
		                                        	<lable style="color:blue; font-weight: bold;">Chưa thanh toán</lable> 
		                                        </a>
		                                        <div class="dropdown-menu centerss">
		                                          <a class="dropdown-item" href="admin/quanly/xacnhanthanhtoan/'.$dataOrder->order_id.'/'.$keythanhtoan.'"><span>Xác nhận thanh toán</span></a><br>
		                                          
		                                        </div>
		                                    </li>
										';
									}
									if($dataOrder->payment_status == 1)
	                                {
										echo '
											<li class="check_ringt dropdown acounts">
		                                        <a class="nav-link dropdown-toggle tk " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" >
		                                       		<lable style="color:#279000; font-weight: bold;">Đã thanh toán</lable> 
		                                        </a>
		                                        <div class="dropdown-menu centerss">
		                                          <a class="dropdown-item" href="admin/quanly/xacnhanthanhtoan/'.$dataOrder->order_id.'/'.$keythanhtoan.'"><span>Xác nhận thanh toán</span></a><br>
		                                         
		                                        </div>
		                                    </li>
										';
									}
								?>
							</td>
							
							<td class="text-center"><a href="#" ><i class="fas fa-edit"></i></a>
							</td>
						</tr>
						@endif
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