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
		<h3>Sản phẩm</h3>
		<div class="card-body">
			<p>
				<a href="admin/danhmuc/sanpham/them" class="btn btn-default" style="background-color: #8ce4e8; border-radius: 3px;"> <i class="fas fa-plus"></i>   Thêm</a>
				<!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalImport"><i class="fal fa-upload"></i> Nhập từ Excel</button> -->

				<a href="{{route('xuatExcel.excel')}}" class="btn btn-warning"><i class="fal fa-download"></i> Xuất ddra Excel</a> (<a href="#">Tải file mẫu</a>)
			</p>
			<table id="DataList" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="25%">Tên sản phẩm</th>
						<th width="15%">Giá</th>
						<th width="15%">Giá khuyến mãi</th>
						<th width="20%">Nhóm sản phẩm</th>
						<th width="10%">Ngày tạo</th>
						<th width="10%">Trạng thái</th>
						<th width="5%">Sửa</th>
						<th width="5%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					@php $count = 1; @endphp
					@foreach($data as $value)
						<tr>
							<td>{{ $count++ }}</td>
							<td>{{ $value->product_name}}</td>
							<td>
								{{ $value->price_value}}
							</td>
							<td>
								{{ $value->price_special}}
							</td>
							
							<td>
								@foreach($data_catalogy as $valcatalogy)
									@if($value->catalogy_id == $valcatalogy->id)
										{{ $valcatalogy->catalogy_name}}
									@endif
								@endforeach
							</td>
							<td>{{ $value->product_createdate}}</td>
							<td>
								@if($value->product_status == 1)
									<input type="checkbox" name="product_status" checked="">
								@else
									<input type="checkbox" name="product_status">
								@endif
							</td>
							<td class="text-center"><a href="admin/danhmuc/sanpham/sua/{{$value->id}}"> <i class="fas fa-edit"></i></a></td>
							<td class="text-center"><a href="admin/danhmuc/sanpham/xoa/{{$value->id}}" onclick="return xacnhanxoa('Bạn có chắc là muốn xóa không!')"><i class="fas fa-trash-alt" style="color: red;"></i></a></td>
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
							<label for="catalogy_id">Nhóm cấp trên <span class="text-danger font-weight-bold">*</span></label>
							<select name="catalogy_id" class="form-control">
								<option value="0">--Chọn--</option>
							</select>
							
						</div>
						<div class="form-group">
							<label for="product_name">Tên sản phẩm <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control{{ $errors->has('product_name') ? ' is-invalid' : '' }}" id="product_name" name="product_name" value="{{ old('product_name') }}" placeholder="0531" required />
							@if($errors->has('product_name'))
								<div class="invalid-feedback"><strong>{{ $errors->first('product_name') }}</strong></div>
							@endif
						</div>
						<div class="form-group">
							<label for="product_short_desciption">Mô tả ngắn <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control{{ $errors->has('product_short_desciption') ? ' is-invalid' : '' }}" id="product_short_desciption" name="product_short_desciption" value="{{ old('product_short_desciption') }}" placeholder="0531" required />
							@if($errors->has('product_short_desciption'))
								<div class="invalid-feedback"><strong>{{ $errors->first('product_short_desciption') }}</strong></div>
							@endif
						</div>
						<div class="form-group">
							<label for="price_todate">Giá <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control{{ $errors->has('price_todate') ? ' is-invalid' : '' }}" id="price_todate" name="price_todate" value="{{ old('price_todate') }}" placeholder="nhập giá sản phẩm..." required />
							@if($errors->has('price_todate'))
								<div class="invalid-feedback"><strong>{{ $errors->first('price_todate') }}</strong></div>
							@endif
						</div>
						<div class="form-group">
							<label for="catalogy_image">Gói đại lý <span class="text-danger font-weight-bold">*</span></label>
							<label class="checkbox-inline">
								<input type="radio" name="price_check" class="price-check-agency" style="margin-right: 10px" value="30">Giảm 30%
							</label>
							<label class="checkbox-inline">
								<input type="radio" name="price_check" class="price-check-agency" style="margin-right: 10px" value="40">Giảm 40%
							</label>
							<label class="checkbox-inline">
								<input type="radio" name="price_check" class="price-check-agency" style="margin-right: 10px" value="50">Giảm 50%
							</label>
							<input type="number" name="price_agency" class="form-control" id="price_agency" value="0">
						</div>
						<div class="form-group">
							<label for="price_special">Giá khuyến mãi<span class="text-danger font-weight-bold">*</span></label>
							<input type="text" class="form-control{{ $errors->has('price_special') ? ' is-invalid' : '' }}" id="price_special" name="price_special" value="{{ old('price_special') }}" placeholder="nhập giá khuyến mãi..." required />
							@if($errors->has('price_special'))
								<div class="invalid-feedback"><strong>{{ $errors->first('price_special') }}</strong></div>
							@endif
						</div>
						<div class="form-group">
							<label for="catalogy_banner">Từ ngày <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" name="" class="form-control">
						</div>
						<div class="form-group">
							<label for="catalogy_banner">Đến ngày <span class="text-danger font-weight-bold">*</span></label>
							<input type="text" name="" class="form-control">
						</div>
						<div class="form-group">
							<label for="catalogy_description">Hình ảnh<span class="text-danger font-weight-bold">*</span></label>
							<input type="file" name="file_1">
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

