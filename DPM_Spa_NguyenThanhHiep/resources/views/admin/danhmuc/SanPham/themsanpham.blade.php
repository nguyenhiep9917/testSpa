@extends('admin.layout.index')

@section('content')
	<div class="row">
           <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div id="page-wrapper">
                        <div class="container-fluid" style="background-color: white; margin: 0 5;">
                            <div class="col-lg-12">
                                <h1 class="page-header">Thêm Sản phẩm</h1>
                                </div>
                                <!-- /.col-lg-12 -->
                                <div class="col-lg-7" style="padding-bottom:120px">
                                <form enctype="multipart/form-data" action="{{ url('/admin/danhmuc/sanpham/them')}}" method="POST">
                                   <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="form-group">
                                        <label>Tên nhóm</label><br>
                                        <select name="catalogy_id" class="form-control">
                                            <option value="0">--Chọn--</option>
                                            @foreach($data_catalogy as $value)
                                                <option value="{{$value->id}}">{{$value->catalogy_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Tên sản phẩm</label><br>
                                        <input class="form-control" name="product_name" placeholder="Please Enter Category Name" />
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả ngắn</label><br>
                                        <textarea name="product_short_desciption" class="form-control " ></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label><br>
                                        <textarea name="product_desciption" class="form-control " id="editor1"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Giá sản phẩm</label><br>
                                        <input type="number" class="form-control" name="price_value" />
                                    </div>
                                    <div class="form-group">
                                        <label>Giá Đại lý</label><br>
                                          <input type="radio" name="price_agency" value="30" checked=""> Giảm 30% &nbsp; &nbsp;
                                          <input type="radio" name="price_agency" value="40"> Giảm 40% &nbsp; &nbsp;
                                          <input type="radio" name="price_agency" value="50"> Giảm 50% &nbsp; &nbsp;
                                    </div>
                                    <div class="form-group">
                                        <label>Giá khuyến mãi</label><br>
                                        <input type="number" class="form-control" name="price_special" />
                                    </div>
                                    <div class="form-group">
                                        <label>Từ ngày</label><br>
                                        <input type="date" class="form-control" name="price_applydate">
                                    </div>
                                    <div class="form-group">
                                        <label>Đến ngày</label><br>
                                        <input type="date" class="form-control" name="price_todate">
                                    </div>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="product_status" checked="">Cho phép mở
                                    </label>
                                    <!-- <div class="form-group">
                                        <label>Trạng thái</label><br>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="product_status" checked="">Cho phép mở
                                        </label>
                                    </div> -->
                                    <div class="form-group">
                                        <label>Hình ảnh</label><br>
                                        <input type="file" name="HinhAnh" class="form-control">
                                    </div>
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