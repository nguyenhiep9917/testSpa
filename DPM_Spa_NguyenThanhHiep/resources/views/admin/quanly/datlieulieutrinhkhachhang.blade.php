@extends('admin.layout.index')

@section('content')
<div class="card">
		<h3>Đặt liệu trình của khách hàng</h3>
		<div class="card-body">
			<!-- <div class="alert alert-info" role="alert">
				<form action="#" method="post">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Lọc theo khoa:</span>
						</div>
						<select class="form-control custom-select" id="MaKhoa" name="MaKhoa">
							<option value="">-- Chọn --</option>
						</select>
						<div class="input-group-append">
							<button class="btn btn-primary" type="submit"><i class="fal fa-filter"></i> Lọc dữ liệu</button>
						</div>
					</div>
				</form>
			</div> -->
			<p>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fal fa-plus"></i> Thêm</button>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalImport"><i class="fal fa-upload"></i> Nhập từ Excel</button>
				<a href="#" class="btn btn-warning"><i class="fal fa-download"></i> Xuất ra Excel</a> (<a href="#">Tải file mẫu</a>)
			</p>
			<table id="DataList" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="10%">Mã</th>
						<th width="25%">@</th>
						<th width="50%">@</th>
						<th width="5%">Sửa</th>
						<th width="5%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					@php $count = 1; @endphp
					
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					
				</tbody>
			</table>
		</div>
	</div>

@endsection