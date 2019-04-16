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
		<h3>Danh sách slider</h3>
		<div class="card-body">
			<p>
				<a href="admin/danhmuc/slider/them" class="btn btn-default" style="background-color: #8ce4e8; border-radius: 3px;"> <i class="fas fa-plus"></i>   Thêm</a>
				<!-- 
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalImport"><i class="fal fa-upload"></i> Nhập từ Excel</button>
				<a href="#" class="btn btn-warning"><i class="fal fa-download"></i> Xuất ra Excel</a> (<a href="#">Tải file mẫu</a>) -->
			</p>
			<table id="DataList" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="25%">Hình ảnh</th>
						<th width="60%">Nội dung</th>
						<th width="10%">Sửa</th>
						<th width="10%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					@php $count = 1; @endphp
					@foreach($data as $value)
						<tr>
							<td>{{ $count++}}</td>
							<td>
								<img src="image/slider/{{ $value-> file_name}}" width="160px" height="130px" class="center">
							</td>
							<td>{{ $value-> content}}</td>
							
							<td class="text-center"><a href="admin/danhmuc/slider/sua/{{$value->id}}" ><i class="fas fa-edit"></i></a></td>
							<td class="text-center">
								<a href="admin/danhmuc/slider/xoa/{{$value->id}}" onclick="return xacnhanxoa('Bạn có chắc là muốn xóa không!')">
									<i class="fas fa-trash-alt"></i>
								</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection