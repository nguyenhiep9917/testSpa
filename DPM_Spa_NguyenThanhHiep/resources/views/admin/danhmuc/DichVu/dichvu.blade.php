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
		<h3>Dịch vụ</h3>
		<div class="card-body">
			<p>
				<a href="admin/danhmuc/dichvu/them"class="btn btn-default" style="background-color: #8ce4e8; border-radius: 3px;"> <i class="fas fa-plus"></i>   Thêm</a>
				<!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalImport"><i class="fal fa-upload"></i> Nhập từ Excel</button> -->
				<a href="{{route('xuatExcel.excelDichVu')}}" class="btn btn-warning"><i class="fal fa-download"></i> Xuất ra Excel</a> (<a href="#">Tải file mẫu</a>)
			</p>
			<table id="DataList" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="20%">Tiêu đề</th>
						<th width="10%">Số lần</th>
						<th width="10%">Giá</th>
						<th width="15%">Giá khuyến mãi</th>
						<th width="10%">Trong thời</th>
						<th width="15%">Hình ảnh</th>
						<th width="10%">New</th>
						<th width="10%">Trạng thái</th>
						<th width="5%">Sửa</th>
						<th width="5%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					@php $count = 1; @endphp
					@foreach($ds_dv as $value)
						<tr>
							<td>{{ $count++ }}</td>
							<td>{{ $value->service_name }}</td>
							<td>{{ $value->total_times }}</td>
							<td>{{ $value->service_normalprice }}</td>
							<td>{{ $value->service_specialprice }}</td>
							<td>#</td>
							<td><img src="trangAdmin/inages_dichvu/{{ $value->service_images}}" width="120px" height="80px"></td>
							<td>{{ $value->service_isnew }}</td>
							<td>
								@if($value->service_status == 1)
									<input type="checkbox" name="service_status" checked="" >
								@else
									<input type="checkbox" name="service_status">
								@endif
							</td>
							<td class="text-center"><a href="admin/danhmuc/dichvu/sua/{{$value->id}}"><i class="fas fa-edit"></i></a></td>
							<td class="text-center"><a href="admin/danhmuc/dichvu/xoa/{{$value->id}}" onclick="return xacnhanxoa('Bạn có chắc là muốn xóa không!')"><i class="fas fa-trash-alt"></i></a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

@endsection