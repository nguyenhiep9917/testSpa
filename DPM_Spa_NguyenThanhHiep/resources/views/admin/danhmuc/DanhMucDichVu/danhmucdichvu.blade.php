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
		<h3>Danh muc dịch vụ</h3>
		<div class="card-body">
			<p>
				<a href="admin/danhmuc/danhmucdichvu/them" class="btn btn-default" style="background-color: #8ce4e8; border-radius: 3px;"> <i class="fas fa-plus"></i>  Thêm</a>
				<!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalImport"><i class="fal fa-upload"></i> Nhập từ Excel</button>
				<a href="#" class="btn btn-warning"><i class="fal fa-download"></i> Xuất ra Excel</a> (<a href="#">Tải file mẫu</a>) -->
			</p>
			<table id="DataList" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="30%">Nhóm dịch vụ</th>
						<th width="15%">Icon </th>
						<th width="15%">Hình ảnh</th>
						<th width="15%">Banner</th>
						<th width="10%">Trạng thái</th>
						<th width="15%">Ngày tạo</th>
						<th width="5%">Sửa</th>
						<th width="5%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					@php $count = 1; @endphp
					@foreach($ds_dmdv as $value)
						<tr>
							<td>{{ $count++ }}</td>
							<td>{{ $value->catalogyservice_name }}</td>
							<td><img src="trangAdmin/inages_dichvu/{{ $value->catalogyservice_icon}}" width="70%" height="50%"></td>
							<td><img src="trangAdmin/inages_dichvu/{{ $value->catalogyservice_image}}" width="70%" height="50%"></td>
							<td><img src="trangAdmin/inages_dichvu/{{ $value->catalogyservice_banner}}" width="70%" height="50%"></td>
							<td>
								@if($value->catalogyservice_status == 1)
									<input type="checkbox" name="paymenttype_status" checked="" >
								@else
									<input type="checkbox" name="paymenttype_status">
								@endif
							</td>
							<td>{{ $value->catalogyservice_creadate }}</td>
							<td class="text-center"><a href="admin/danhmuc/danhmucdichvu/sua/{{$value->id}}"> <i class="fas fa-edit"></i></a></td>
							<td class="text-center"><a href="admin/danhmuc/danhmucdichvu/xoa/{{$value->id}}" onclick="return xacnhanxoa('Bạn có chắc là muốn xóa không!')"><i class="fas fa-trash-alt"></i></a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

@endsection