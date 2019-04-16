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
                            <div class="col-lg-12" style="padding-bottom:120px">
                                <form enctype="multipart/form-data" action="{{ url('/admin/danhmuc/sanpham/them')}}" method="POST">
                                   <input type="hidden" name="_token" value="{{csrf_token()}}">
                                   <div class="col-lg-6" style="padding-bottom:120px">
                                        <div class="form-group">
                                            <label>Tên khách hàng: (*)</label><br>
                                            <input class="form-control" name="product_name" placeholder="Please Enter Category Name" />
                                        </div>
                                        <div class="form-group">
                                            <label>Tên đăng nhập: (*)</label><br>
                                            <input class="form-control" name="product_name" placeholder="Please Enter Category Name" />
                                        </div>
                                        <div class="form-group">
                                            <label>Mật khẩu: (*)</label><br>
                                            <input type="password" class="form-control" name="product_name" placeholder="*******" />
                                        </div>
                                        <div class="form-group">
                                            <label>Giới tính</label><br>
                                            <select class="form-control">
                                                <option value="0">--Chọn--</option>
                                                <option value="Nam">Nam</option>
                                                <option value="Nữ">Nữ</option>
                                                <option value="Khác">Khác</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Ngày sinh: (*)</label><br>
                                            <input type="date" class="form-control" name="product_name" placeholder="Please Enter Category Name" />
                                        </div>
                                        <div class="form-group">
                                            <label>Email: (*)</label><br>
                                            <input class="form-control" name="product_name" placeholder="Please Enter Category Name" />
                                        </div>
                                        <div class="form-group">
                                            <label>Số điện thoại</label><br>
                                            <input class="form-control" name="price_value" />
                                        </div>
                                        <div class="form-group">
                                            <label>Người giới thiệu</label><br>
                                              <select class="form-control">
                                                <option value="0">--Chọn--</option>
                                                <option value="">----</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Trạng thái</label><br>
                                            <select class="form-control">
                                                <option value="0">Kích hoạt</option>
                                                <option value="0">Khóa</option>
                                                <option value="0">Chưa xác nhận</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Logo</label><br>
                                            <input type="file" class="form-control" name="customer_logo" />
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" name="service_status" checked="">Cho phép nhượng quyền<br>
                                        </div>
                                    </div>


                                    <div class="col-lg-6" style="padding-bottom:120px">
                                        <div class="form-group">
                                            <label>Số CMND: (*)</label><br>
                                            <input class="form-control" name="product_name" placeholder="Please Enter Category Name" />
                                        </div>
                                        <div class="form-group">
                                            <label>Gói đại lý</label><br>
                                              <select class="form-control">
                                                <option value="1">Miễn phí</option>
                                                <option value="2">Thường</option>
                                                <option value="3">VIP</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Tên đăng nhập: (*)</label><br>
                                            <input class="form-control" name="product_name" placeholder="Please Enter Category Name" />
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>



                                    <h4>Địa chỉ</h4>
                                    <table style="width:100%">
                                      <tr>
                                        <th>Số nhà tên đường</th>
                                        <th>Tỉnh/TP</th> 
                                        <th>Huyện/Quận</th>
                                        <th>Xã/Phường</th>
                                      </tr>
                                      <tr>
                                        <td>
                                            <div class="form-group">
                                                <input class="form-control" name="price_value" />
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <select class="form-control" id="tinh">
                                                    <option value="0">--Chọn--</option>
                                                    @foreach($data_province as $value)
                                                    <option value="{{$value->province_id}}">{{$value->province_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td> 
                                        <td>
                                            <div class="form-group">
                                                <select class="form-control" id="huyen">
                                                    <option value="0">--Chọn--</option>
                                                    @foreach($data_district as $value)
                                                    <option value="{{$value->district_id}}">{{$value->district_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <select class="form-control" id="xa">
                                                    <option value="0">--Chọn--</option>
                                                    @foreach($data_commune as $value)
                                                    <option value="{{$value->commune_id}}">{{$value->commune_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                      </tr>
                                    </table>

                                        
                                    <button type="submit" class="btn btn-default">Thêm vào CSDL</button>
                                    <button type="reset" class="btn btn-default">Làm mới</button>
                                    <a href="admin/product/danhsach" class="btn btn-default"> Trở lại</a>
                                </form>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $("#tinh").change(function(){
                var idTinh = $(this).val();
                ///alert(idTinh);
                $.ajax({
                    type: "GET",
                    data: {},
                    url: "admin/ajax/huyen/"+idTinh,
                    dataType:'html',
                    success : function(response){
                        $("#huyen").html(response);
                    }
                });

            });
            $("#huyen").change(function(){
                var idHuyen = $(this).val();
                //alert(idHuyen);
                $.ajax({
                    type: "GET",
                    data: {},
                    url: "admin/ajax/xa/"+idHuyen,
                    dataType:'html',
                    success : function(response){
                        $("#xa").html(response);
                    }
                });
            });
        });
    </script>
@endsection