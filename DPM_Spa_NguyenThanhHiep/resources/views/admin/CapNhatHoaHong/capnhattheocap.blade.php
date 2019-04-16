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
			<a href="admin/hoahong/hoahongdoanhsodaily"><i class="fas fa-project-diagram" style="color: green"></i>  Cây hệ thống</a>&nbsp; &nbsp;|&nbsp; &nbsp;
			<a href="admin/capnhatHoaHonh/capnhat-hoahong"> Trở lại</a> 
			
		</div>
		<h3 style="color: blue">Thành viện đại lý : {{$nameDL}}</h3>
		<hr>
		<h4>Đại lý cấp 1: 8%</h4><br>
		<div class="card-body">
			<form enctype="multipart/form-data" action="admin/capnhatHoaHonh/cap-nhat/{{$idCustomerPranent}}" method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
				<table class="table table-bordered table-hover table-sm">
					<thead>
						<tr>
							<th width="5%">Mã TV</th>
							<th width="15%">Tên thành viên</th>
							<th width="18%">Đại lý</th>
							<th width="15%">Tổng tiền trong ví</th>
							<th width="15%">Tổng doanh thu tháng</th>
							<th width="14%">Tình trạng</th>
							<th width="13%"></th>
						</tr>
					</thead>
					<tbody>
						@php $count = 1; $bac = 1; @endphp
						@foreach($CustomerCon as $value)
							
							<tr>
								<td>
									TV{{$value->customer_id}}
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
									<?php
									$dataDL = \App\HoaHongDL::where('customer_id', $value->customer_id)->first();
									echo $dataDL->hoahongdoanhsodaily_tong;

									?>
								</td>
								<td>
									<?php
									$idCustomerDaiLy = $value->customer_id;
									// tìm các order mà dai lý này mua trong tháng 
									$orderCuaDaiLy = \App\Order::where('customer_id', $idCustomerDaiLy)
									->where('doneupdata', 0)
									->where('paymenttype_id', '<', 8)
									->get();
									$tongtiendonhangthang = 0;
									foreach ($orderCuaDaiLy as $value)
									{
										$tongtiendonhangthang += $value->order_totalvalue;
									}
									 echo '<input type="text" name="doanhsocap1_'.$count++.'" value = "'.$tongtiendonhangthang.'"class="form-control">';
									 // echo '<input type="text" name="orrr'.$count++.'" value = "'.$tongtiendonhangthang.'"class="form-control">';
									// echo '<input type="text" name="doanhsocap14" value = "44444"class="form-control">';
								?>

								</td>


								<!-- Điều kiện dai lý mien phí -->
								<?php
									$packageCustomer = \App\Customer::where('customer_id', $value->customer_id)->first();
									if($packageCustomer->package_id == 1 && $tongtiendonhangthang > 1000000)
									echo '<td>
											<label style="color: green; font-weight: bold;">Đã đủ điều kiện</label>
										</td>
										<td>
											<a href="admin/capnhatHoaHonh/cap-nhat-theo-tung-cap-con/'.$idCustomerPranent.'/'.$value->customer_id.'/'.$tongtiendonhangthang.'/'.$bac.'">Cập nhật hoa hồng</a>
										</td>';
									else if ($packageCustomer->package_id == 1 && $tongtiendonhangthang < 1000000)
										echo '<td>
											<label style="color: red; font-weight: bold;">Chưa đủ điều kiện</label>
										</td>
										<td>
										</td>';
// Điều kiện dai lý thường

									if($packageCustomer->package_id == 2 && $tongtiendonhangthang > 1400000)
									echo '<td>
											<label style="color: green; font-weight: bold;">Đã đủ điều kiện</label>
										</td>
										<td>
											<a href="admin/capnhatHoaHonh/cap-nhat-theo-tung-cap-con/'.$idCustomerPranent.'/'.$value->customer_id.'/'.$tongtiendonhangthang.'/'.$bac.'">Cập nhật hoa hồng</a>
										</td>';
									else if($packageCustomer->package_id == 2 && $tongtiendonhangthang < 1400000)
										echo '<td>
											<label style="color: red; font-weight: bold;">Chưa đủ điều kiện</label>
										</td>
										<td>
										</td>';


// Điều kiện dai lý Vip

									if($packageCustomer->package_id == 3 && $tongtiendonhangthang > 2400000)
									echo '<td>
											<label style="color: green; font-weight: bold;">Đã đủ điều kiện</label>
										</td>
										<td>
											<a href="admin/capnhatHoaHonh/cap-nhat-theo-tung-cap-con/'.$idCustomerPranent.'/'.$value->customer_id.'/'.$tongtiendonhangthang.'/'.$bac.'">Cập nhật hoa hồng</a>
										</td>';
									else if($packageCustomer->package_id == 3 && $tongtiendonhangthang < 2400000)
										echo '<td>
											<label style="color: red; font-weight: bold;">Chưa đủ điều kiện</label>
										</td>
										<td>
										</td>';
								?>
							</tr>
						@endforeach
					</tbody>
				</table>
				<hr>
				<h4>Đại lý cấp 2</h4><br>
				<table class="table table-bordered table-hover table-sm">
					<thead>
						<tr>
							<th width="5%">Mã TV</th>
							<th width="15%">Tên thành viên</th>
							<th width="18%">Đại lý</th>
							<th width="15%">Tổng tiền trong ví</th>
							<th width="15%">Tổng doanh thu tháng</th>
							<th width="14%">Tình trạng</th>
							<th width="13%"></th>
						</tr>
					</thead>

					<tbody>
						@php $count = 1; $bac = 2; @endphp
						@foreach($CustomerCon as $value)
							@foreach($Customer as $valueCustomer)
								@if($value->customer_id == $valueCustomer->customer_parent)
								<tr>
									<td>
										TV{{$valueCustomer->customer_id}}
									</td>
									<td>
										{{$valueCustomer->customer_username}}
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
										<?php
										$dataDL = \App\HoaHongDL::where('customer_id', $valueCustomer->customer_id)->first();
										echo $dataDL->hoahongdoanhsodaily_tong;

										?>
									</td>
									<td>
										<?php
											$idCustomerDaiLy = $valueCustomer->customer_id;
											// // tìm các order mà dai lý này mua trong tháng 
											$orderCuaDaiLy = \App\Order::where('customer_id', $idCustomerDaiLy)
											->where('doneupdata', 0)
											->where('paymenttype_id', '<', 8)
											->where('payment_status', '=', 1)
											->get();
											//echo $orderCuaDaiLy;
											$tongtiendonhangthang = 0;
											foreach ($orderCuaDaiLy as $valueorderDaiLybac2)
											{
												//echo $valueorderDaiLybac2->order_totalvalue;
												$tongtiendonhangthang += $valueorderDaiLybac2->order_totalvalue;
											}
											 echo '<input type="text" name="doanhsocap1_'.$count++.'" value = "'.$tongtiendonhangthang.'"class="form-control">';
											//  // echo '<input type="text" name="orrr'.$count++.'" value = "'.$tongtiendonhangthang.'"class="form-control">';
											// // echo '<input type="text" name="doanhsocap14" value = "44444"class="form-control">';
										?>
									</td>
									<?php
										$packageCustomer = \App\Customer::where('customer_id', $valueCustomer->customer_id)->first();
										if($packageCustomer->package_id == 1 && $tongtiendonhangthang > 1000000)
										echo '<td>
												<label style="color: green; font-weight: bold;">Đã đủ điều kiện</label>
											</td>
											<td>
												<a href="admin/capnhatHoaHonh/cap-nhat-theo-tung-cap-con/'.$idCustomerPranent.'/'.$valueCustomer->customer_id.'/'.$tongtiendonhangthang.'/'.$bac.'">Cập nhật hoa hồng</a>
											</td>';
										else if ($packageCustomer->package_id == 1 && $tongtiendonhangthang < 1000000)
											echo '<td>
												<label style="color: red; font-weight: bold;">Chưa đủ điều kiện</label>
											</td>
											<td>
											</td>';




										if($packageCustomer->package_id == 2 && $tongtiendonhangthang > 1400000)
										echo '<td>
												<label style="color: green; font-weight: bold;">Đã đủ điều kiện</label>
											</td>
											<td>
												<a href="admin/capnhatHoaHonh/cap-nhat-theo-tung-cap-con/'.$idCustomerPranent.'/'.$valueCustomer->customer_id.'/'.$tongtiendonhangthang.'/'.$bac.'">Cập nhật hoa hồng</a>
											</td>';
										else if($packageCustomer->package_id == 2 && $tongtiendonhangthang < 1400000)
											echo '<td>
												<label style="color: red; font-weight: bold;">Chưa đủ điều kiện</label>
											</td>
											<td>
											</td>';




										if($packageCustomer->package_id == 3 && $tongtiendonhangthang > 2400000)
										echo '<td>
												<label style="color: green; font-weight: bold;">Đã đủ điều kiện</label>
											</td>
											<td>
												<a href="admin/capnhatHoaHonh/cap-nhat-theo-tung-cap-con/'.$idCustomerPranent.'/'.$valueCustomer->customer_id.'/'.$tongtiendonhangthang.'/'.$bac.'">Cập nhật hoa hồng</a>
											</td>';
										else if($packageCustomer->package_id == 3 && $tongtiendonhangthang < 2400000)
											echo '<td>
												<label style="color: red; font-weight: bold;">Chưa đủ điều kiện</label>
											</td>
											<td>
											</td>';
									?>
								</tr>
								@endif
							@endforeach
						@endforeach
					</tbody>
				</table>
				<hr>
				<h4>Đại lý cấp 3</h4><br>
				<table class="table table-bordered table-hover table-sm">
					<thead>
						<tr>
							<th width="5%">Mã TV</th>
							<th width="15%">Tên thành viên</th>
							<th width="18%">Đại lý</th>
							<th width="15%">Tổng tiền trong ví</th>
							<th width="15%">Tổng doanh thu tháng</th>
							<th width="14%">Tình trạng</th>
							<th width="13%"></th>
						</tr>
					</thead>
					<tbody>
						@php $count = 1; $bac3 = 3; @endphp
						@foreach($CustomerCon as $value)
							@foreach($Customer as $valueCustomer)
								@if($value->customer_id == $valueCustomer->customer_parent)
									@foreach($Customer as $valueCustomerbac3)
									@if($valueCustomer->customer_id == $valueCustomerbac3->customer_parent)
										<tr>
											<td>
												TV{{$valueCustomerbac3->customer_id}}
											</td>
											<td>
												{{$valueCustomerbac3->customer_username}}
											</td>
											<td>
												@if($valueCustomerbac3->package_id == 1)
													Gói đại lý miễn phí
												@endif
												@if($valueCustomerbac3->package_id == 2)
													Gói đại lý thường
												@endif
												@if($valueCustomerbac3->package_id == 3)
													Gói đại lý Vip
												@endif
											</td>
											<td>
												<?php
												$dataDL = \App\HoaHongDL::where('customer_id', $valueCustomerbac3->customer_id)->first();
												echo $dataDL->hoahongdoanhsodaily_tong;
												?>
											</td>
											<td>
												<?php
													$idCustomerDaiLy = $valueCustomerbac3->customer_id;
													// // tìm các order mà dai lý này mua trong tháng 
													$orderCuaDaiLy = \App\Order::where('customer_id', $idCustomerDaiLy)
													->where('doneupdata', 0)
													->where('paymenttype_id', '<', 8)
													->where('payment_status', '=', 1)
													->get();
													//echo $orderCuaDaiLy;
													$tongtiendonhangthang = 0;
													foreach ($orderCuaDaiLy as $valueorderDaiLybac3)
													{
														//echo $valueorderDaiLybac2->order_totalvalue;
														$tongtiendonhangthang += $valueorderDaiLybac3->order_totalvalue;
													}
													 echo '<input type="text" name="doanhsocap1_'.$count++.'" value = "'.$tongtiendonhangthang.'"class="form-control">';
													//  // echo '<input type="text" name="orrr'.$count++.'" value = "'.$tongtiendonhangthang.'"class="form-control">';
													// // echo '<input type="text" name="doanhsocap14" value = "44444"class="form-control">';
												?>
											</td>
											<?php
												$packageCustomer = \App\Customer::where('customer_id', $valueCustomerbac3->customer_id)->first();
												if($packageCustomer->package_id == 1 && $tongtiendonhangthang > 1000000)
												echo '<td>
														<label style="color: green; font-weight: bold;">Đã đủ điều kiện</label>
													</td>
													<td>
														<a href="admin/capnhatHoaHonh/cap-nhat-theo-tung-cap-con/'.$idCustomerPranent.'/'.$valueCustomerbac3->customer_id.'/'.$tongtiendonhangthang.'/'.$bac3.'">Cập nhật hoa hồng</a>
													</td>';
												else if ($packageCustomer->package_id == 1 && $tongtiendonhangthang < 1000000)
													echo '<td>
														<label style="color: red; font-weight: bold;">Chưa đủ điều kiện</label>
													</td>
													<td>
													</td>';




												if($packageCustomer->package_id == 2 && $tongtiendonhangthang > 1400000)
												echo '<td>
														<label style="color: green; font-weight: bold;">Đã đủ điều kiện</label>
													</td>
													<td>
														<a href="admin/capnhatHoaHonh/cap-nhat-theo-tung-cap-con/'.$idCustomerPranent.'/'.$valueCustomerbac3->customer_id.'/'.$tongtiendonhangthang.'/'.$bac3.'">Cập nhật hoa hồng</a>
													</td>';
												else if($packageCustomer->package_id == 2 && $tongtiendonhangthang < 1400000)
													echo '<td>
														<label style="color: red; font-weight: bold;">Chưa đủ điều kiện</label>
													</td>
													<td>
													</td>';




												if($packageCustomer->package_id == 3 && $tongtiendonhangthang > 2400000)
												echo '<td>
														<label style="color: green; font-weight: bold;">Đã đủ điều kiện</label>
													</td>
													<td>
														<a href="admin/capnhatHoaHonh/cap-nhat-theo-tung-cap-con/'.$idCustomerPranent.'/'.$valueCustomerbac3->customer_id.'/'.$tongtiendonhangthang.'/'.$bac3.'">Cập nhật hoa hồng</a>
													</td>';
												else if($packageCustomer->package_id == 3 && $tongtiendonhangthang < 2400000)
													echo '<td>
														<label style="color: red; font-weight: bold;">Chưa đủ điều kiện</label>
													</td>
													<td>
													</td>';
											?>
										</tr>
									@endif
									@endforeach
								@endif
							@endforeach
						@endforeach
					</tbody>
				</table>
				<hr>
				<h4>Đại lý cấp 4</h4><br>
				<table class="table table-bordered table-hover table-sm">
					<thead>
						<tr>
							<th width="5%">Mã TV</th>
							<th width="15%">Tên thành viên</th>
							<th width="18%">Đại lý</th>
							<th width="15%">Tổng tiền trong ví</th>
							<th width="15%">Tổng doanh thu tháng</th>
							<th width="14%">Tình trạng</th>
							<th width="13%"></th>
						</tr>
					</thead>
					<tbody>
						@php $count = 1; $bac4 = 4; @endphp
						@foreach($CustomerCon as $value)
							@foreach($Customer as $valueCustomer)
								@if($value->customer_id == $valueCustomer->customer_parent)
									@foreach($Customer as $valueCustomerbac3)
										@if($valueCustomer->customer_id == $valueCustomerbac3->customer_parent)
											@foreach($Customer as $valueCustomerbac4)
												@if($valueCustomerbac3->customer_id == $valueCustomerbac4->customer_parent)
													<tr>
														<td>
															TV{{$valueCustomerbac4->customer_id}}
														</td>
														<td>
															{{$valueCustomerbac4->customer_username}}
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
															<?php
																$dataDL = \App\HoaHongDL::where('customer_id', $valueCustomerbac4->customer_id)->first();
																echo $dataDL->hoahongdoanhsodaily_tong;
															?>
														</td>
														<td>
															<?php
																$idCustomerDaiLy = $valueCustomerbac4->customer_id;
																// // tìm các order mà dai lý này mua trong tháng 
																$orderCuaDaiLy = \App\Order::where('customer_id', $idCustomerDaiLy)
																->where('doneupdata', 0)
																->where('paymenttype_id', '<', 8)
																->where('payment_status', '=', 1)
																->get();
																//echo $orderCuaDaiLy;
																$tongtiendonhangthang = 0;
																foreach ($orderCuaDaiLy as $valueorderDaiLybac4)
																{
																	//echo $valueorderDaiLybac2->order_totalvalue;
																	$tongtiendonhangthang += $valueorderDaiLybac4->order_totalvalue;
																}
																 echo '<input type="text" name="doanhsocap1_'.$count++.'" value = "'.$tongtiendonhangthang.'"class="form-control">';
																//  // echo '<input type="text" name="orrr'.$count++.'" value = "'.$tongtiendonhangthang.'"class="form-control">';
																// // echo '<input type="text" name="doanhsocap14" value = "44444"class="form-control">';
															?>
														</td>
														<?php
															$packageCustomer = \App\Customer::where('customer_id', $valueCustomerbac4->customer_id)->first();
															if($packageCustomer->package_id == 1 && $tongtiendonhangthang > 1000000)
															echo '<td>
																	<label style="color: green; font-weight: bold;">Đã đủ điều kiện</label>
																</td>
																<td>
																	<a href="admin/capnhatHoaHonh/cap-nhat-theo-tung-cap-con/'.$idCustomerPranent.'/'.$valueCustomerbac4->customer_id.'/'.$tongtiendonhangthang.'/'.$bac4.'">Cập nhật hoa hồng</a>
																</td>';
															else if ($packageCustomer->package_id == 1 && $tongtiendonhangthang < 1000000)
																echo '<td>
																	<label style="color: red; font-weight: bold;">Chưa đủ điều kiện</label>
																</td>
																<td>
																</td>';




															if($packageCustomer->package_id == 2 && $tongtiendonhangthang > 1400000)
															echo '<td>
																	<label style="color: green; font-weight: bold;">Đã đủ điều kiện</label>
																</td>
																<td>
																	<a href="admin/capnhatHoaHonh/cap-nhat-theo-tung-cap-con/'.$idCustomerPranent.'/'.$valueCustomerbac4->customer_id.'/'.$tongtiendonhangthang.'/'.$bac4.'">Cập nhật hoa hồng</a>
																</td>';
															else if($packageCustomer->package_id == 2 && $tongtiendonhangthang < 1400000)
																echo '<td>
																	<label style="color: red; font-weight: bold;">Chưa đủ điều kiện</label>
																</td>
																<td>
																</td>';




															if($packageCustomer->package_id == 3 && $tongtiendonhangthang > 2400000)
															echo '<td>
																	<label style="color: green; font-weight: bold;">Đã đủ điều kiện</label>
																</td>
																<td>
																	<a href="admin/capnhatHoaHonh/cap-nhat-theo-tung-cap-con/'.$idCustomerPranent.'/'.$valueCustomerbac4->customer_id.'/'.$tongtiendonhangthang.'/'.$bac4.'">Cập nhật hoa hồng</a>
																</td>';
															else if($packageCustomer->package_id == 3 && $tongtiendonhangthang < 2400000)
																echo '<td>
																	<label style="color: red; font-weight: bold;">Chưa đủ điều kiện</label>
																</td>
																<td>
																</td>';
														?>
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
				<h4>Đại lý cấp 5</h4><br>
				<table class="table table-bordered table-hover table-sm">
					<thead>
						<tr>
							<th width="5%">Mã TV</th>
							<th width="15%">Tên thành viên</th>
							<th width="18%">Đại lý</th>
							<th width="15%">Tổng tiền trong ví</th>
							<th width="15%">Tổng doanh thu tháng</th>
							<th width="14%">Tình trạng</th>
							<th width="13%"></th>
						</tr>
					</thead>
					<tbody>
						@php $count = 1; $bac5 = 5; @endphp
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
																	TV{{$valueCustomerbac5->customer_id}}
																</td>
																<td>
																	{{$valueCustomerbac5->customer_username}}
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
																	<?php
																		$dataDL = \App\HoaHongDL::where('customer_id', $valueCustomerbac5->customer_id)->first();
																		echo $dataDL->hoahongdoanhsodaily_tong;
																	?>
																</td>
																<td>
																	<?php
																		$idCustomerDaiLy = $valueCustomerbac5->customer_id;
																		// // tìm các order mà dai lý này mua trong tháng 
																		$orderCuaDaiLy = \App\Order::where('customer_id', $idCustomerDaiLy)
																		->where('doneupdata', 0)
																		->where('paymenttype_id', '<', 8)
																		->where('payment_status', '=', 1)
																		->get();
																		//echo $orderCuaDaiLy;
																		$tongtiendonhangthang = 0;
																		foreach ($orderCuaDaiLy as $valueorderDaiLybac5)
																		{
																			//echo $valueorderDaiLybac2->order_totalvalue;
																			$tongtiendonhangthang += $valueorderDaiLybac5->order_totalvalue;
																		}
																		 echo '<input type="text" name="doanhsocap1_'.$count++.'" value = "'.$tongtiendonhangthang.'"class="form-control">';
																		//  // echo '<input type="text" name="orrr'.$count++.'" value = "'.$tongtiendonhangthang.'"class="form-control">';
																		// // echo '<input type="text" name="doanhsocap14" value = "44444"class="form-control">';
																	?>
																</td>
																<?php
																	$packageCustomer = \App\Customer::where('customer_id', $valueCustomerbac5->customer_id)->first();
																	if($packageCustomer->package_id == 1 && $tongtiendonhangthang > 1000000)
																	echo '<td>
																			<label style="color: green; font-weight: bold;">Đã đủ điều kiện</label>
																		</td>
																		<td>
																			<a href="admin/capnhatHoaHonh/cap-nhat-theo-tung-cap-con/'.$idCustomerPranent.'/'.$valueorderDaiLybac5->customer_id.'/'.$tongtiendonhangthang.'/'.$bac5.'">Cập nhật hoa hồng</a>
																		</td>';
																	else if ($packageCustomer->package_id == 1 && $tongtiendonhangthang < 1000000)
																		echo '<td>
																			<label style="color: red; font-weight: bold;">Chưa đủ điều kiện</label>
																		</td>
																		<td>
																		</td>';




																	if($packageCustomer->package_id == 2 && $tongtiendonhangthang > 1400000)
																	echo '<td>
																			<label style="color: green; font-weight: bold;">Đã đủ điều kiện</label>
																		</td>
																		<td>
																			<a href="admin/capnhatHoaHonh/cap-nhat-theo-tung-cap-con/'.$idCustomerPranent.'/'.$valueorderDaiLybac5->customer_id.'/'.$tongtiendonhangthang.'/'.$bac5.'">Cập nhật hoa hồng</a>
																		</td>';
																	else if($packageCustomer->package_id == 2 && $tongtiendonhangthang < 1400000)
																		echo '<td>
																			<label style="color: red; font-weight: bold;">Chưa đủ điều kiện</label>
																		</td>
																		<td>
																		</td>';




																	if($packageCustomer->package_id == 3 && $tongtiendonhangthang > 2400000)
																	echo '<td>
																			<label style="color: green; font-weight: bold;">Đã đủ điều kiện</label>
																		</td>
																		<td>
																			<a href="admin/capnhatHoaHonh/cap-nhat-theo-tung-cap-con/'.$idCustomerPranent.'/'.$valueorderDaiLybac5->customer_id.'/'.$tongtiendonhangthang.'/'.$bac5.'">Cập nhật hoa hồng</a>
																		</td>';
																	else if($packageCustomer->package_id == 3 && $tongtiendonhangthang < 2400000)
																		echo '<td>
																			<label style="color: red; font-weight: bold;">Chưa đủ điều kiện</label>
																			
																		</td>
																		<td>
																		</td>';
																?>
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
                
			</form>
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
<script type="text/javascript">
	var hv = $('#namcap1').val();
	alert(hv);
</script>