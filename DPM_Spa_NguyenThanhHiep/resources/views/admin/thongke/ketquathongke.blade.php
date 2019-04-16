@extends('admin.layout.index')

@section('content')
<div class="card">
	<h3>Thống kê doanh số bán hàng</h3>
		<div class="card-body">
			<form enctype="multipart/form-data" action="{{ url('/admin/thongke/ketquabaocao')}}" method="GET">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<div class="row">
					<div class="col-lg-3">
						<span>Từ ngày</span>
						<input type="date" name="startday" class="form-control">
					</div>
					<div class="col-lg-3">
						<span>Đến ngày</span>
						<input type="date" name="endday" class="form-control">
					</div>
					<div class="col-lg-6">
						<button type="submit" class="btn btn-default" style="margin-top: 20px;">XEM BÁO CÁO</button>
					</div>
				</div>

			</form>
			<hr>
			<table id="DataList" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="15%">Tên khách hàng</th>
						<th width="10%">Số điện thoại</th>
						<th width="10%">Ngày đặt</th>
						<th width="22%">Sản phẩm</th>
						<th width="15%">Trạng thái</th>
						<th width="18%">Tổng tiền</th>
						<th width="5%">Sửa</th>
					</tr>
				</thead>
				<tbody>
					@php $count = 1; @endphp
					@foreach ($data_Order as $value)
			            @if($value->payment_date <= $timestamps && $value->payment_date >= $timestamp)
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
								<?php
									$idOrder =  $value->order_id;
									$dataOrder = \App\Order::where('order_id', $idOrder)->first();
									$keythanhtoan = 1;
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
							<td>
								{{number_format($value->order_totalvalue,0,',','.')}} VNĐ
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