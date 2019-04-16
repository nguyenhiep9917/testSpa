@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
     <div id="page-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div id="page-wrapper">
            <div class="container-fluid " style="background-color: white; margin: 0 5;">
              <div class="col-lg-12" style="padding-bottom:120px">
                  <br>
                  @if($find_customer ->package_id == 0)
                    <span class="title_confiml_package">&nbsp; &nbsp; &nbsp;&nbsp;Chào bạn <strong class="title_confiml_package">{{Auth::user()->name}}</strong> đến với hệ thống Spa.<strong class="title_confiml_package">Bạn cần nhập đầy đủ thông tin khi lần đầu mua gói đại lý.</strong></span>
                  @else
                    <span class="title_confiml_package">&nbsp; &nbsp; &nbsp;&nbsp;Xin chào bạn đến với hệ thống Spa mời bạn <strong class="title_confiml_package"><a href="{{url('/')}}">Xem lại thông tin</a></strong> vào xác nhận gói đại lý.</span>
                  @endif
                      <br>
                  <form enctype="multipart/form-data" action="{{ url('/admin/danhmuc/sanpham/them')}}" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="row">
                    <div class="col-lg-12" style="padding-bottom:120px">
                      <div class="col-lg-6" style="padding-bottom:120px">
                        <label>Thông tin đại lý thành viên.</label>
                        <div class="customer_spa">
                          <div class="form-group customer_spa_form">
                            <label>Tên Spa:</label><br>
                            <input class="form-control" name="customer_name_spa" />
                          </div>
                          <div class="form-group customer_spa_form">
                            <label>Thông tin Spa:</label><br>
                            <input type="text" name="customer_content_spa">
                          </div>
                          <div class="form-group customer_spa_form">
                            <label>Số nhà tên đường:</label><br>
                            <input type="text" name="customer_address">
                          </div>
                          <div class="form-group customer_spa_form">
                              <label>Tỉnh/TP</label><br>
                              <select class="form-control" id="tinh_">
                                  <option value="0">--Chọn--</option>
                                  @foreach($data_province as $value)
                                  <option value="{{$value->customer_province_id}}">{{$value->province_name}}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="form-group customer_spa_form">
                              <label>Huyện/Quận</label> <br>
                              <select class="form-control" id="huyen_">
                                  <option value="0">--Chọn--</option>
                                  @foreach($data_district as $value)
                                  <option value="{{$value->customer_district_id}}">{{$value->district_name}}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="form-group customer_spa_form">
                              <label>Xã/Phường</label> <br>
                              <select class="form-control" id="xa_">
                                  <option value="0">--Chọn--</option>
                                  @foreach($data_commune as $value)
                                  <option value="{{$value->custoner_commune_id}}">{{$value->commune_name}}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="form-group customer_spa_form">
                              <label>Logo</label> <br>
                              <input type="file" name="customer_logo">
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6" style="padding-bottom:120px">
                        <label>_</label>
                        <div class="customer_spa">
                          <div class="form-group customer_spa_form">
                              <label>Số CMND: (*)</label><br>
                              <input class="form-control" name="customer_identity_card" placeholder="Please Enter Category Name" />
                          </div>
                          <div class="form-group customer_spa_form">
                              <label>Hình mặt trước CMND:</label><br>
                                <input type="file" class="form-control" name="customer_image_face_before">
                          </div>
                          <div class="form-group customer_spa_form">
                              <label>Hình mặt sau CMND: (*)</label><br>
                              <input type="file" class="form-control" name="customer_image_face_after" placeholder="Please Enter Category Name" />
                          </div>
                          <div class="form-group customer_spa_form">
                              <label>Số tài khoản ngân hàng: (*)</label><br>
                              <input type="text" class="form-control" name="customer_account_number" placeholder="Please Enter Category Name" />
                          </div>
                          <div class="form-group customer_spa_form">
                              <label>Hình mặt sau CMND: (*)</label><br>
                              <select class="form-control" name="customer_account_type">
                                  <option value="">--Chọn--</option>
                                  <option value="VietCombank">VietCombank</option>
                                  <option value="SaCombank">SaCombank</option>
                                  <option value="VietinCombank">VietinCombank</option>
                              </select>
                          </div>
                          
                        </div>
                      </div>
                      <div style="clear:both"></div>
                      <button type="submit" class="btn btn-default">Giử Xác nhận</button>
                      <button type="reset" class="btn btn-default">Làm mới</button>
                      <a href="{{url('/taikhoan/taikhoan_page')}}" class="btn btn-default"> Trở lại</a>
                    </div>
                  </div>
                  </form>
              <div style="clear:both"></div>
              </div>
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
            $("#tinh_").change(function(){
                var idTinh = $(this).val();
                // alert(idTinh);
                $.ajax({
                    type: "GET",
                    data: {},
                    url: "taikhoan/ajax_loadaddress/huyen/"+idTinh,
                    dataType:'html',
                    success : function(response){
                        $("#huyen_").html(response);
                    }
                });

            });
            $("#huyen_").change(function(){
                var idHuyen = $(this).val();
                //alert(idHuyen);
                $.ajax({
                    type: "GET",
                    data: {},
                    url: "taikhoan/ajax_loadaddress/xa/"+idHuyen,
                    dataType:'html',
                    success : function(response){
                        $("#xa_").html(response);
                    }
                });
            });
        });
    </script>
@endsection


<style type="text/css">
    .title_confiml_package{
      color: #f90;
      font-size: 12pt;
    }
    .title_confiml_package{
      color: #f90;

    }
    .customer_spa{
    border: 2px solid blue;
    border-radius: 4px;
    }
    .customer_spa_form{
      margin: 15px;
    }
</style>