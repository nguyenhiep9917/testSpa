@extends('admin.layout.index')

@section('content')
<div class="card">
	<h3>Thống kê doanh số bán hàng</h3>
		<div class="card-body">
			<form enctype="multipart/form-data" action="{{ url('/admin/thongke/ketquabaocao')}}" method="GET">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<div class="row">
					<div class="col-lg-3">
						<span>Từ ngày</span>
						<input type="date" name="startday" class="form-control">
					</div>
					<div class="col-lg-3">
						<span>Đến ngày</span>
						<input type="date" name="endday" class="form-control">
					</div>
					<div class="col-lg-6">
						<button type="submit" class="btn btn-default" style="margin-top: 20px;">XEM BÁO CÁO</button>
					</div>
				</div>

			</form>
			<hr>
			<table id="DataList" class="table table-bordered table-hover table-sm">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="15%">Tên khách hàng</th>
						<th width="10%">Số điện thoại</th>
						<th width="10%">Ngày đặt</th>
						<th width="22%">Sản phẩm</th>
						<th width="15%">Trạng thái</th>
						<th width="18%">Tổng tiền</th>
						<th width="5%">Sửa</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td></td>
						<td></td>
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