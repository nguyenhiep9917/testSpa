@extends('admin.layout.index')

@section('content')
	<div class="row">
           <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div id="page-wrapper">
                        <div class="container-fluid" style="background-color: white; margin: 0 5;">
                            <div class="col-lg-12">
                                <h1 class="page-header">Thêm danh mục dịch vụ</h1>
                                </div>
                                <!-- /.col-lg-12 -->
                                <div class="col-lg-7" style="padding-bottom:120px">
                                <form enctype="multipart/form-data" action="{{ url('/admin/danhmuc/danhmucdichvu/them')}}" method="POST">
                                   <input type="hidden" name="_token" value="{{csrf_token()}}">
                                   <div class="form-group">
                                        <label>Tên nhóm dịch vụ</label><br>
                                        <input class="form-control" name="catalogyservice_name" placeholder="Please Enter Category Name" />
                                    </div>
                                    <div class="form-group">
                                        <label for="catalogyservice_parent">Nhóm cấp trên <span class="text-danger font-weight-bold">*</span></label>
                                        <select name="catalogyservice_parent" class="form-control">
                                            <option value="0">--Chọn--</option>
                                            <option value="Châm sóc da mặt">Châm sóc da mặt</option>
                                            <option value="Châm sóc da toàn thân">Châm sóc da toàn thân</option>
                                            <option value="Gói liệu trình">Hiệu quả</option>
                                            <option value="Hiệu quả">Săng cơ toàn thân</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="catalogyservice_icon">Icon <span class="text-danger font-weight-bold">*</span></label>
                                        <input type="file" name="catalogyservice_icon" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="catalogyservice_image">Hình ảnh <span class="text-danger font-weight-bold">*</span></label>
                                        <input type="file" name="catalogyservice_image" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="catalogyservice_banner">Hình Banner <span class="text-danger font-weight-bold">*</span></label>
                                        <input type="file" name="catalogyservice_banner" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label><br>
                                        <textarea name="catalogyservice_description" class="form-control" id="editor1"></textarea>
                                    </div>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="catalogyservice_status" checked="">Cho phép mở
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