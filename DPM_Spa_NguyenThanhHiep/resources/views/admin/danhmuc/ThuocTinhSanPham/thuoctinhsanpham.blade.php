@extends('admin.layout.index')

@section('content')
<div class="card">
		<h3>Thuộc tính sản phẩm</h3>
		<div class="card-body">
			<p>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fal fa-plus"></i> Thêm</button>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalImport"><i class="fal fa-upload"></i> Nhập từ Excel</button>
				<a href="#" class="btn btn-warning"><i class="fal fa-download"></i> Xuất ra Excel</a> (<a href="#">Tải file mẫu</a>)
			</p>
			<table id="DataList" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="10%">Key</th>
						<th width="25%">Tên thuộc tính</th>
						<th width="50%">Các giá trị thuộc tính</th>
						<th width="50%">Trạng thái	</th>
						<th width="5%">Sửa</th>
						<th width="5%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					@php $count = 1; @endphp
						@foreach($data as $values)
						<tr>
							<td>{{$count++}}</td>
							<td>{{$values->properties_key}}</td>
							<td>{{$values->properties_name}}</td>
							<td>
								@foreach($data_Properties_option as $value)
									@if($value->properties_id == $values->properties_id)
										{{$value->option_value}}
									@endif
								@endforeach
							</td>
							<td>
								@if($values->properties_status == 1)
									<input type="checkbox" name="properties_status" checked="">Cho phép mở
								@else
									<input type="checkbox" name="properties_status">Cho phép mở
								@endif
							</td>
							<td class="text-center"><a href="#sua" data-toggle="modal" data-target="#myModalEdit" ><i class="fas fa-edit"></i></a></td>
							<td class="text-center"><a href="#xoa" data-toggle="modal" data-target="#myModalDelete" ><i class="fas fa-trash-alt"></i></a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	
	<form action="@" method="post">
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
							<input type="text" class="form-control{{ $errors->has('paymenttype_name') ? ' is-invalid' : '' }}" id="paymenttype_name" name="paymenttype_name" value="{{ old('paymenttype_name') }}" placeholder="0531" required />
							@if($errors->has('paymenttype_name'))
								<div class="invalid-feedback"><strong>{{ $errors->first('paymenttype_name') }}</strong></div>
							@endif
						</div>
						<div class="form-group">
							<label for="paymenttype_code">Mã code <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control{{ $errors->has('paymenttype_code') ? ' is-invalid' : '' }}" id="paymenttype_code" name="paymenttype_code" value="{{ old('paymenttype_code') }}" placeholder="0531" required />
							@if($errors->has('paymenttype_code'))
								<div class="invalid-feedback"><strong>{{ $errors->first('paymenttype_code') }}</strong></div>
							@endif
						</div>
						<div class="form-group">
							<label for="paymenttype_description">Mô tả <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control{{ $errors->has('paymenttype_description') ? ' is-invalid' : '' }}" id="paymenttype_description" name="paymenttype_description" value="{{ old('paymenttype_description') }}" placeholder="0531" required />
							@if($errors->has('paymenttype_description'))
								<div class="invalid-feedback"><strong>{{ $errors->first('paymenttype_description') }}</strong></div>
							@endif
						</div>
						<div class="form-group">
							<label for="Email">Địa chỉ Email <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control{{ $errors->has('Email') ? ' is-invalid' : '' }}" id="Email" name="Email" value="{{ old('Email') }}" placeholder="0531" required />
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
	</form>

@endsection