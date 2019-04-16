@extends('admin.layout.index')

@section('content')
<div class="card">
		
		<h3>Hình thức vận chuyển</h3>
		<div class="card-body">
			<p>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fal fa-plus"></i> Thêm</button>
				<!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalImport"><i class="fal fa-upload"></i> Nhập từ Excel</button>
				<a href="#" class="btn btn-warning"><i class="fal fa-download"></i> Xuất ra Excel</a> (<a href="#">Tải file mẫu</a>) -->
			</p>
			<table id="DataList" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="45%">Hình thức vận chuyển</th>
						<th width="15%">Code</th>
						<th width="15%">Ngày tạo</th>
						<th width="15%">Trạng thái</th>
						<th width="5%">Sửa</th>
						<th width="5%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					@php $count = 1; @endphp
					@foreach($ds_htvc as $value)
						<tr>
							<td>{{ $count++ }}</td>
							<td>{{ $value->shiptype_name}}</td>
							<td>{{ $value->shiptype_code}}</td>
							<td>{{ $value->shiptype_createdate}}</td>
							<td>{{ $value->shiptype_status}}</td>
							<td class="text-center"><a href="admin/danhmuc/hinhthucvanchuyen/sua/{{$value->id}}"><i class="fas fa-edit"></i></a></td>
							<td class="text-center"><a href="admin/danhmuc/hinhthucvanchuyen/xoa/{{$value->id}}" onclick="return xacnhanxoa('Bạn có chắc là muốn xóa không!')"><i class="fas fa-trash-alt"></i></a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<!-- thêm -->
	<form action="{{ url('/admin/danhmuc/hinhthucvanchuyen/them')}}" method="post">
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
							<label for="shiptype_name">Hình thức vận chuyển <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control{{ $errors->has('shiptype_name') ? ' is-invalid' : '' }}" id="shiptype_name" name="shiptype_name" value="{{ old('shiptype_name') }}" placeholder="" required />
							@if($errors->has('shiptype_name'))
								<div class="invalid-feedback"><strong>{{ $errors->first('shiptype_name') }}</strong></div>
							@endif
						</div>
						<div class="form-group">
							<label for="shiptype_code">Code<span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control{{ $errors->has('shiptype_code') ? ' is-invalid' : '' }}" id="shiptype_code" name="shiptype_code" value="{{ old('shiptype_code') }}" placeholder="" required />
							@if($errors->has('shiptype_code'))
								<div class="invalid-feedback"><strong>{{ $errors->first('shiptype_code') }}</strong></div>
							@endif
						</div>
						<label class="checkbox-inline">
							<input type="checkbox" name="shiptype_status" checked="">Cho phép mở
						</label>
						
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Thực hiện</button>
					</div>
				</div>
			</div>
		</div>
	</form>

	
	<form action="{{ url('/admin/danhmuc/hinhthucvanchuyen/xoa')}}" method="post">
		@csrf
		<input type="hidden" id="shiptype_id_delete" name="shiptype_id_delete" value="" />
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
		function getCapNhat(shiptype_id, shiptype_name, shiptype_code, shiptype_createdate, shiptype_status) {
			$('#shiptype_idedit').val(shiptype_id);
			$('#shiptype_name_edit').val(shiptype_name);
			$('#shiptype_code_edit').val(shiptype_code);
			$('#shiptype_createdate_edit').val(shiptype_createdate);
			$('#shiptype_status_edit').val(shiptype_status);
		}
		
		function getXoa(shiptype_id) {
			$('#shiptype_id_delete').val(shiptype_id);
		}
		
	</script>
@endsection