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
		<h3>Khách hàng</h3>
		<div class="card-body">
			<p>
				<a href="admin/quanly/nguoidung/them" class="btn btn-default" style="background-color: #8ce4e8; border-radius: 3px;"><i class="fas fa-plus"></i>  Thêm</a>
				<!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalImport"><i class="fal fa-upload"></i> Nhập từ Excel</button>
				<a href="#" class="btn btn-warning"><i class="fal fa-download"></i> Xuất ra Excel</a> (<a href="#">Tải file mẫu</a>) -->
			</p>
			<table id="DataList" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="3%">#</th>
						<th width="15%">Tài khoản</th>
						<th width="20%">Họ và tên</th>
						<th width="20%">Email</th>
						<th width="12%">Số điện thoại</th>
						<th width="12%">Trạng thái</th>
						<th width="8%">Nhóm</th>
						<th width="5%">Sửa</th>
						<th width="5%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					@php $count = 1; @endphp
					@foreach($data as $value)
						<tr>
							<td>{{$count++}}</td>
							<td>{{$value->TaiKhoan}}</td>
							<td>{{$value->name}}</td>
							<td>{{$value->email}}</td>
							<td>{{$value->user_phone}}</td>
							<td>
								@if($star == 1)
									<div class="alert-success" style="font-size: 12px; text-align: center;">
										kích hoạt
									</div>
								@endif
								@if($star == 0)
									<div class="alert-success" style="font-size: 12px; text-align: center;">
										Chưa kích hoạt
									</div>
								@endif
							</td>
							<td>
								@if($value->user_status == 2)
									<div class="alert-success" style="font-size: 12px; text-align: center;">
										Admin
									</div>
								@endif
								@if($value->user_status == 0)
									<div class="alert-success" style="font-size: 12px; text-align: center;">
										user
									</div>
								@endif
							</td>
							<td class="text-center"><a href="admin/quanly/nguoidung/sua/{{$value->id}}" ><i class="fas fa-edit"></i></a></td>
							<td><a href="admin/quanly/nguoidung/xoa/{{$value->id}}" onclick="return xacnhanxoa('Bạn có chắc là muốn xóa không!')"> <i class="fas fa-trash-alt" style="color: red"></i></a></td>
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
