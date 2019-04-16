@extends('admin.layout.index')

@section('content')
	<div class="row">
           <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div id="page-wrapper">
                        <div class="container-fluid" style="background-color: white; margin: 0 5;">
                            <div class="col-lg-12">
                                <h1 class="page-header">Thêm dịch vụ</h1>
                                </div>
                                <!-- /.col-lg-12 -->
                                <div class="col-lg-7" style="padding-bottom:120px">
                                <form enctype="multipart/form-data" action="{{ url('/admin/danhmuc/dichvu/them')}}" method="POST">
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
                                        @foreach($data_dmdv as $val)
                                        <br>
                                            <input type="radio" name="catalogyservice_id" value="{{$val->id}}">{{$val->catalogyservice_name}}
                                        @endforeach
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="service_name">Tên dịch vụ<span class="text-danger font-weight-bold">*</span></label><br>
                                        <input class="form-control" name="service_name" placeholder="Please Enter Category Name" />
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label><br>
                                        <textarea name="service_shortdescription" class="form-control" >
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Thông tin</label><br>
                                        <textarea name="service_longdescription" class="form-control" id="editor1">
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="total_times">Số lần thực hiện<span class="text-danger font-weight-bold">*</span></label><br>
                                        <input type="number" class="form-control" name="total_times"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="service_normalprice">Giá dịch vụ<span class="text-danger font-weight-bold">*</span></label><br>
                                        <input class="form-control" name="service_normalprice" placeholder="Please Enter Category Name" />
                                    </div>
                                    <div class="form-group">
                                        <label for="service_specialprice">Giá khuyến mãi<span class="text-danger font-weight-bold">*</span></label><br>
                                        <input class="form-control" name="service_specialprice" placeholder="Please Enter Category Name" />
                                    </div>
                                    <div class="form-group">
                                        <label for="service_datesellfrom">Từ ngày<span class="text-danger font-weight-bold">*</span></label><br>
                                        <input type="date" class="form-control" name="service_datesellfrom" placeholder="Please Enter Category Name" />
                                    </div>
                                    <div class="form-group">
                                        <label for="service_datesellto">Đến ngày<span class="text-danger font-weight-bold">*</span></label><br>
                                        <input type="date" class="form-control" name="service_datesellto" placeholder="Please Enter Category Name" />
                                    </div>
                                    <div class="form-group">
                                        <label for="service_images">Hình Ảnh <span class="text-danger font-weight-bold">*</span></label>
                                        <input type="file" name="service_images" class="form-control">
                                    </div>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="service_status" checked="">Cho phép mở <br>
                                    </label>
                                    <br>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="service_isnew">Sản phẩm mới
                                    </label>
                                    
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