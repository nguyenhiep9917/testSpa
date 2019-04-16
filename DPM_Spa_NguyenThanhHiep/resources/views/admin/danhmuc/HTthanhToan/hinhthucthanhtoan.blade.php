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
		<h3>Hình thức thanh toán</h3>
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
				<!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalImport"><i class="fal fa-upload"></i> Nhập từ Excel</button>
				<a href="#" class="btn btn-warning"><i class="fal fa-download"></i> Xuất ra Excel</a> (<a href="#">Tải file mẫu</a>) -->
			</p>
			<table id="DataList" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="40%">Hình thức thanh toán</th>
						<th width="15%">Mã code</th>
						<th width="15%">Ngày lập</th>
						<th width="15%"> Trạng thái</th>
						<th width="5%">Sửa</th>
						<th width="5%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					@php $count = 1; @endphp
					@foreach($ds_httt as $value)
						<tr>
							<td>{{ $count++ }}</td>
							<td>{{$value -> paymenttype_name}}</td>
							<td>{{$value -> paymenttype_code}}</td>
							<td>{{$value -> paymenttype_description}}</td>
							<td>{{$value -> paymenttype_status}}</td>
							<td class="text-center"><a href="admin/danhmuc/hinhthucthanhtoan/sua/{{$value->id}}"<i class="fas fa-edit"></i></a></td>

							<td class="text-center"><a href="admin/danhmuc/hinhthucthanhtoan/xoa/{{$value->id}}" onclick="return xacnhanxoa('Bạn có chắc là muốn xóa không!')"><i class="fas fa-trash-alt"></i></a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<form action="{{ url('/admin/danhmuc/hinhthucthanhtoan/them') }}" method="post">
		@csrf
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Thêm</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="paymenttype_name">Hình thức thanh toán <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control{{ $errors->has('paymenttype_name') ? ' is-invalid' : '' }}" id="paymenttype_name" name="paymenttype_name" value="{{ old('paymenttype_name') }}" placeholder="" required />
							@if($errors->has('paymenttype_name'))
								<div class="invalid-feedback"><strong>{{ $errors->first('paymenttype_name') }}</strong></div>
							@endif
						</div>
						<div class="form-group">
							<label for="paymenttype_code">Mã code <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control{{ $errors->has('paymenttype_code') ? ' is-invalid' : '' }}" id="paymenttype_code" name="paymenttype_code" value="{{ old('paymenttype_code') }}" placeholder="" required />
							@if($errors->has('paymenttype_code'))
								<div class="invalid-feedback"><strong>{{ $errors->first('paymenttype_code') }}</strong></div>
							@endif
						</div>
						<div class="form-group">
							<label for="paymenttype_description">Mô tả <span class="text-danger font-weight-bold">*</span></label>
								<!-- <textarea for="paymenttype_description" id="paymenttype_description" name="paymenttype_description" cols="30" rows="50" class="form-control{{ $errors->has('paymenttype_description') ? ' is-invalid' : '' }} ckeditor" value="{{ old('paymenttype_description') }}" placeholder="">
						       </textarea> -->
							
					       <input type="text" class="form-control{{ $errors->has('paymenttype_description') ? ' is-invalid' : '' }}" id="paymenttype_description" name="paymenttype_description" value="{{ old('paymenttype_description') }}" placeholder="" required />
							@if($errors->has('paymenttype_description'))
								<div class="invalid-feedback"><strong>{{ $errors->first('paymenttype_description') }}</strong></div>
							@endif
						</div>
						<label class="checkbox-inline">
							<input type="checkbox" name="paymenttype_status" checked="">Cho phép mở
						</label>
						
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Thực hiện</button>
					</div>
				</div>
			</div>
		</div>
	</form>

	

	<form action="{{ url('/admin/danhmuc/hinhthucthanhtoan/xoa') }}" method="post">
		@csrf
		<input type="hidden" id="paymenttype_id_delete" name="paymenttype_id_delete" value="" />
		<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalDeleteLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalDeleteLabel">Xóa hình thức thanh toán</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<p class="font-weight-bold text-danger"><i class="fal fa-question-circle"></i> Xác nhận xóa? Hành động này không thể phục hồi.</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fal fa-times"></i> Hủy bỏ</button>
						<button type="submit" class="btn btn-danger"><i class="fal fa-trash-alt"></i> Thực hiện</button>
					</div>
				</div>
			</div>
		</div>
	</form>
@endsection
