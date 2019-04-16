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
		<h3>Nhóm sản phẩm</h3>
		<div class="card-body">
			
			<p>
				<a href="admin/danhmuc/nhomsanpham/them"class="btn btn-default" style="background-color: #8ce4e8; border-radius: 3px;"> <i class="fas fa-plus"></i>    Thêm</a>
				<!-- 
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalImport"><i class="fal fa-upload"></i> Nhập từ Excel</button>
				<a href="#" class="btn btn-warning"><i class="fal fa-download"></i> Xuất ra Excel</a> (<a href="#">Tải file mẫu</a>) -->
			</p>
			<table id="DataList" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="25%">Nhóm sản phẩm</th>
						<th width="20%">Ngày tạo</th>
						<th width="20%">Hình ảnh</th>
						<th width="20%">Banner</th>
						<th width="10%">Trạng thái</th>
						<th width="5%">Sửa</th>
						<th width="5%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					@php $count = 1; @endphp
					@foreach($ds_nsp as $value)
						<tr>
							<td>{{ $count++}}</td>
							<td>{{ $value-> catalogy_name}}</td>
							<td>{{ $value-> catalogy_createdate}}</td>
							<td><img src="trangAdmin/images/{{ $value->catalogy_image}}"></td>
							<td><img src="trangAdmin/images/{{ $value-> catalogy_banner}}"></td>

							<td>
								@if($value->catalogy_status == 1)
									<input type="checkbox" name="paymenttype_status" checked="">Cho phép mở
								@else
									<input type="checkbox" name="paymenttype_status">Cho phép mở
								@endif
							</td>
							<td class="text-center"><a href="admin/danhmuc/nhomsanpham/sua/{{$value->id}}" ><i class="fas fa-edit"></i></a></td>
							<td class="text-center">
								<a href="admin/danhmuc/nhomsanpham/xoa/{{$value->id}}" onclick="return xacnhanxoa('Bạn có chắc là muốn xóa không!')">
									<i class="fas fa-trash-alt"></i>
								</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	
	<!-- <form action="{{ url('/admin/danhmuc/nhomsanpham/them')}}" method="post">
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
							<label for="catalogy_name">Tên nhóm <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control{{ $errors->has('catalogy_name') ? ' is-invalid' : '' }}" id="catalogy_name" name="catalogy_name" value="{{ old('catalogy_name') }}" placeholder="" required />
							@if($errors->has('catalogy_name'))
								<div class="invalid-feedback"><strong>{{ $errors->first('catalogy_name') }}</strong></div>
							@endif
						</div>
						<div class="form-group">
							<label for="catalogy_parent">Nhóm cấp trên <span class="text-danger font-weight-bold">*</span></label>
							<select name="catalogy_parent" class="form-control">
								<option value="0">--Chọn--</option>
								<option value="Châm sóc da mặt">Châm sóc da mặt</option>
								<option value="Châm sóc da toàn thân">Châm sóc da toàn thân</option>
								<option value="Gói liệu trình">Gói liệu trình</option>
								<option value="Hiệu quả">Hiệu quả</option>
							</select>
							
						</div>
						<div class="form-group">
							<label for="catalogy_image">Hình ảnh <span class="text-danger font-weight-bold">*</span></label>
							<input type="file" name="HinhAnh" class="form-control">
						</div>
						<div class="form-group">
							<label for="catalogy_banner">Banner <span class="text-danger font-weight-bold">*</span></label>
							<input type="file" name="Banner" class="form-control">
						</div>
						<div class="form-group">
							<label for="catalogy_description">Mô tả<span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control{{ $errors->has('catalogy_description') ? ' is-invalid' : '' }}" id="catalogy_description" name="catalogy_description" value="{{ old('catalogy_description') }}" placeholder="0531" required />
							@if($errors->has('Email'))
								<div class="invalid-feedback"><strong>{{ $errors->first('Email') }}</strong></div>
							@endif
						</div>
						<label class="checkbox-inline">
							<input type="checkbox" name="catalogy_status" checked="">Cho phép mở
						</label>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Thực hiện</button>
					</div>
				</div>
			</div>
		</div>
	</form> -->

	<!-- <form action="" method="post">
		@csrf
		<input type="hidden" id="catalogy_old_edit" name="catalogy_old_edit" value="" />
		<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalEditLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Sửa</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="catalogy_name">Tên nhóm <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control{{ $errors->has('catalogy_name') ? ' is-invalid' : '' }}" id="catalogy_name" name="catalogy_name" value="{{ old('catalogy_name') }}" placeholder="0531" required />
							@if($errors->has('catalogy_name'))
								<div class="invalid-feedback"><strong>{{ $errors->first('catalogy_name') }}</strong></div>
							@endif
						</div>
						<div class="form-group">
							<label for="catalogy_parent">Nhóm cấp trên <span class="text-danger font-weight-bold">*</span></label>
							<select name="catalogy_parent" class="form-control">
								<option value="0">--Chọn--</option>
							</select>
							
						</div>
						<div class="form-group">
							<label for="catalogy_image">Hình ảnh <span class="text-danger font-weight-bold">*</span></label>
							<input type="file" name="catalogy_image">
						</div>
						<div class="form-group">
							<label for="catalogy_banner">Banner <span class="text-danger font-weight-bold">*</span></label>
							<input type="file" name="catalogy_banner">
						</div>
						<div class="form-group">
							<label for="catalogy_description">Mô tả<span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control{{ $errors->has('catalogy_description') ? ' is-invalid' : '' }}" id="catalogy_description" name="catalogy_description" value="{{ old('catalogy_description') }}" placeholder="0531" required />
							@if($errors->has('Email'))
								<div class="invalid-feedback"><strong>{{ $errors->first('Email') }}</strong></div>
							@endif
						</div>
						
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Thực hiện</button>
					</div>
				</div>
			</div>
		</div>
	</form> -->

	<form action="" method="post">
		@csrf
		<input type="hidden" id="catalogy_id_delete" name="catalogy_id_delete" value="" />
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
@section('javascript')
	<script type="text/javascript">
		// function getCapNhat(shiptype_id, shiptype_name, shiptype_code, shiptype_createdate, shiptype_status) {
		// 	$('#shiptype_idedit').val(shiptype_id);
		// 	$('#shiptype_name_edit').val(shiptype_name);
		// 	$('#shiptype_code_edit').val(shiptype_code);
		// 	$('#shiptype_createdate_edit').val(shiptype_createdate);
		// 	$('#shiptype_status_edit').val(shiptype_status);
		// }
		
		function getXoa(catalogy_id) {
			$('#catalogy_id_delete').val(catalogy_id);
		}
		
		// @if($errors->has('MaGiangVien') || $errors->has('MaNgach') || $errors->has('MaBoMon') || $errors->has('HoLot') || $errors->has('Ten') || $errors->has('Email'))
		// 	$('#myModal').modal('show');
		// @endif
		
		// @if($errors->has('MaGiangVien_edit') || $errors->has('MaNgach_edit') || $errors->has('MaBoMon_edit') || $errors->has('HoLot_edit') || $errors->has('Ten_edit') || $errors->has('Email_edit'))
		// 	$('#myModalEdit').modal('show');
		// @endif
		
		// @if($errors->has('FileExcel') || $errors->has('FileExcel'))
		// 	$('#myModalImport').modal('show');
		// @endif
	</script>
@endsection