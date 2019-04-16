@extends('admin.layout.index')

@section('content')
	<div class="row">
           <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div id="page-wrapper">
                        <div class="container-fluid" style="background-color: white; margin: 0 5;">
                            <div class="col-lg-12">
                                <h1 class="page-header">Cập nhật thông tin</h1>
                                </div>
                                <!-- /.col-lg-12 -->
                                <div class="col-lg-7" style="padding-bottom:120px">
                                <form enctype="multipart/form-data" action="admin/danhmuc/dichvu/sua/{{$service_edit->id}}" method="POST">
                                   <input type="hidden" name="_token" value="{{csrf_token()}}">
                                   <div class="form-group">
                                        <label>Spa</label><br>
                                         <select name="catalogyservice_parent" class="form-control">
                                            <option value="Spa Sumsuhen">Spa Sumsuhen</option>
                                            <option value="Spa nhượng quyền Suu">Spa nhượng quyền Suu</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="catalogyservice_id">Nhóm dịch vụ<span class="text-danger font-weight-bold">*</span></label>
                                        @foreach($serviceincatalogy_edit as $val)
                                            @if( $val->service_id == $service_edit->id)
                                                @foreach($data_dmdv_edit as $value_dm)
                                                <br>
                                                    @if($value_dm->id == $val->catalogyservice_id)
                                                        <input type="radio" name="catalogyservice_id" value="{{$value_dm->id}}" checked >{{$value_dm->catalogyservice_name}}
                                                    @else
                                                        <input type="radio" name="catalogyservice_id" value="{{$value_dm->id}}" >{{$value_dm->catalogyservice_name}}
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label for="service_name">Tên dịch vụ<span class="text-danger font-weight-bold">*</span></label><br>
                                        <input class="form-control" name="service_name" value="{{$service_edit->service_name}}" />
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label><br>
                                        <textarea name="service_shortdescription" class="form-control" >
                                            {{$service_edit->service_shortdescription}}
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Thông tin</label><br>
                                        <textarea name="service_longdescription" class="form-control" id="editor1">
                                            {{$service_edit->service_longdescription}}
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="total_times">Số lần thực hiện<span class="text-danger font-weight-bold">*</span></label><br>
                                        <input type="number" class="form-control" name="total_times" value="{{$service_edit->total_times}}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="service_normalprice">Giá dịch vụ<span class="text-danger font-weight-bold">*</span></label><br>
                                        <input class="form-control" name="service_normalprice" value="{{$service_edit->service_normalprice}}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="service_specialprice">Giá khuyến mãi<span class="text-danger font-weight-bold">*</span></label><br>
                                        <input class="form-control" name="service_specialprice" value="{{$service_edit->service_specialprice}}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="service_datesellfrom">Từ ngày<span class="text-danger font-weight-bold">*</span></label><br>
                                        <input type="date" class="form-control" name="service_datesellfrom" value="{{$service_edit->service_datesellfrom}}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="service_datesellto">Đến ngày<span class="text-danger font-weight-bold">*</span></label><br>
                                        <input type="date" class="form-control" name="service_datesellto" value="{{$service_edit->service_datesellto}}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="service_images">Hình Ảnh <span class="text-danger font-weight-bold">*</span></label><br>
                                        <img src="trangAdmin/inages_dichvu/{{$service_edit->service_images}}" width="120px" height="100px">
                                        <input type="file" name="service_images" class="form-control">
                                    </div>
                                    <label class="checkbox-inline">
                                        @if($service_edit->service_status == 1)
                                            <input type="checkbox" name="service_status" checked="">Cho phép mở <br>
                                        @else
                                            <input type="checkbox" name="service_status">Cho phép mở <br>
                                        @endif
                                    </label>
                                    <br>
                                    <label class="checkbox-inline">
                                        @if($service_edit->service_isnew == 1)
                                            <input type="checkbox" name="service_isnew" checked="">Sản phẩm mới<br>
                                        @else
                                            <input type="checkbox" name="service_isnew">Sản phẩm mới <br>
                                        @endif
                                    </label>
                                    <br>
                                    <button type="submit" class="btn btn-default">Thêm vào CSDL</button>
                                    <button type="reset" class="btn btn-default">Làm mới</button>
                                    <a href="admin/product/danhsach" class="btn btn-default"> Trở lại</a>
                                <form>
                            </div>
                        </div>
                        <!-- /.row -->
                     </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        </div>


@endsection