@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
       <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div id="page-wrapper">
                    <div class="container-fluid " style="background-color: white; margin: 0 5;">
                       @include('TaiKhoan.linkGioiThieu')
                        <!-- /.col-lg-12 -->
                        @if(session('ThongBao'))
                            <div class="alert alert-success">
                                {{session('ThongBao')}}
                            </div>
                        @endif
                        <div class="col-lg-12">
                            <div class="col-lg-3 title_customer">
                               <h5>Thông tin khách hàng</h5>
                            </div>
                            <div class="col-lg-9">
                                <h5>Thông tin tài khoản</h5>
                            </div>
                        </div>
                        <div class="col-lg-12" style="padding-bottom:120px">
                            @include('Taikhoan.menu_taikhoan')
                           <form enctype="multipart/form-data" action="taikhoan/updatathongtin-taikhoan/{{Auth::user()->id}}" method="POST">
                             <input type="hidden" name="_token" value="{{csrf_token()}}">
                              <div class="col-lg-9" style="padding-bottom:120px">
                                <div class="form-group">
                                  <label class="control-label col-sm-2" for="customer_username">Họ và tên</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="customer_username" class="form-control" id="Customer" value="{{$Customer->customer_username}}" disabled="">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                  <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="customer_sex">Giới tính</label>
                                    <div class="col-sm-9">
                                        <ul class="sex_box">
                                          <li><input type="radio" class="form-check-input" id="sex_male" name="sex" autocomplete="off" value="1" <?php if($Customer->customer_sex == 1) echo ('checked=""')?> ><label for="sex_male"> Nam</label></li>
                                          <li><input type="radio" class="form-check-input" id="sex_female" name="sex" autocomplete="off" value="2" <?php if($Customer->customer_sex == 2) echo ('checked=""')?>><label for="sex_female"> Nữ</label></li>
                                          <li><input type="radio" class="form-check-input" id="sex_other" name="sex" autocomplete="off" value="3" <?php if($Customer->customer_sex == 3) echo ('checked=""')?>><label for="sex_other"> Khác</label></li>
                                        </ul> 
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-2" for="">Ngày sinh</label>
                                        <?php
                                        $date = date_create($Customer->customer_dateofbirth);
                                        $date = date_format($date, 'Y-m-d');
                                        ?> 
                                    <div class="col-sm-9">
                                        <input type="date" name="customer_dateofbirth" class="form-control" id="" autocomplete="off" value="<?php echo $date ?>">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                  <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-2" for="">Số điện thoại</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="customer_phone" class="form-control" id="" autocomplete="off" value="{{$Customer->customer_phone}}" required="">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                  <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-2" for="customer_email">Email</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="customer_email" class="form-control" id="" autocomplete="off" value="{{$Customer->customer_email}}" required="">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                  <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-2" for="customer_type_verify">Xác nhận qua</label>
                                    <div class="col-sm-9">
                                        <select name="customer_type_verify" class="form-control" required="">
                                            <option>
                                                <?php
                                                    if(isset($Customer->customer_type_verify))
                                                    {
                                                        echo $Customer->customer_type_verify;
                                                    }
                                                    else
                                                    {
                                                        echo '--Chọn--';
                                                    }
                                                ?>
                                            </option>
                                            <option value="CMND">CMND</option>
                                            <option value="BLX">BLX</option>
                                            <option value="PASSPORT">PASSPORT</option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                  <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-2" for="customer_identity_card">Mã số</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="customer_identity_card" class="form-control" value="{{$Customer->customer_identity_card}}" required="">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                  <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-2" for="">Chứng minh mặt trước</label>
                                    <div class="col-sm-9">
                                        <img src="image/image_CMND/{{$Customer->customer_image_face_before}}" width="250px" height="150px">
                                        <br>
                                        <input type="file" name="customer_image_face_before">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                  <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-2" for="">Chứng minh mặt sau</label>
                                    <div class="col-sm-9">
                                        <img src="image/image_CMND/{{$Customer->customer_image_face_after}}"  width="250px" height="150px">
                                        <br>
                                        <input type="file" name="customer_image_face_after">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                  <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-2" for="">Logo đại lý (nếu có)</label>
                                    <div class="col-sm-9">
                                        <img src="image/logo/{{$Customer->customer_logo}}"  width="250px" height="150px">
                                        <br>
                                        <input type="file" name="customer_logo">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                  <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="address">Số nhà tên đường</label>
                                      <div class="col-sm-9">
                                          <input type="text" name="address" class="form-control" id="" autocomplete="off" value="{{$Customer->customer_address}}" required="">
                                          <div class="help-block with-errors"></div>
                                      </div>
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-2" for="phone">Tỉnh/TP</label>
                                      <div class="col-sm-9">
                                          <select class="form-control" id="tinh_dh" name="customer_province_id" required="">
                                              <option value="{{$Customer->customer_province_id}}">
                                                <?php 
                                                $province = \App\Province::where('province_id', $Customer->customer_province_id)->first();
                                                if(isset($Customer->customer_province_id)) 
                                                  {
                                                    echo $province->province_name;
                                                  }
                                                else
                                                  {
                                                    echo '--Chọn--';
                                                  }
                                                  ?>
                                                    
                                                  </option>
                                              @foreach($data_province as $value)
                                              <option value="{{$value->province_id}}">{{$value->province_name}}</option>
                                              @endforeach
                                          </select>
                                          <div class="help-block with-errors"></div>
                                      </div>
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-2" for="phone">Huyện/Quận</label>
                                      <div class="col-sm-9">
                                          <select class="form-control" id="huyen_dh" name="customer_district_id" required="">
                                            <option value="{{$Customer->customer_district_id}}">
                                              <?php 
                                                $district = \App\District::where('district_id', $Customer->customer_district_id)->first();
                                                if(isset($Customer->customer_district_id)) 
                                                  {
                                                    echo $district->district_name;
                                                  }
                                                else
                                                  {
                                                    echo '--Chọn--';
                                                  }
                                                  ?>
                                            </option>
                                            @foreach($data_district as $value)
                                            <option value="{{$value->district_id}}">{{$value->district_name}}</option>
                                            @endforeach
                                          </select>
                                          <div class="help-block with-errors"></div>
                                      </div>
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-2" for="phone">Xã/Phường</label>
                                      <div class="col-sm-9">
                                          <select class="form-control" id="xa_dh" name="custoner_commune_id" required="">
                                            <option value="{{$Customer->custoner_commune_id}}">
                                               <?php 
                                                $commune = \App\Commune::where('commune_id', $Customer->custoner_commune_id)->first();
                                                if(isset($Customer->custoner_commune_id)) 
                                                  {
                                                    echo $commune->commune_name;
                                                  }
                                                else
                                                  {
                                                    echo '--Chọn--';
                                                  }
                                                  ?>
                                            </option>
                                            @foreach($data_commune as $value)
                                            <option value="{{$value->commune_id}}">{{$value->commune_name}}</option>
                                            @endforeach
                                          </select>
                                          <div class="help-block with-errors"></div>
                                      </div>
                                    <div class="clearfix"></div>
                                  </div>
                                </div>
                                <h6>Thông tin tài khoản ngân hàng</h6>
                                <br>
                                <div class="form-group">
                                  <label class="control-label col-sm-2" for="customer_account_name">Họ và Tên</label>
                                    <div class="col-sm-9">
                                        <input name="customer_account_name" class="form-control" id="" autocomplete="off" value="{{$Customer->customer_account_name}}" required="">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                  <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-2" for="customer_account_type">Ngân hàng</label>
                                    <div class="col-sm-9">
                                        <select name="customer_account_type" class="form-control" required="">
                                            <option>
                                                <?php
                                                    if(isset($Customer->customer_account_type))
                                                    {
                                                        echo $Customer->customer_account_type;
                                                    }
                                                    else
                                                    {
                                                        echo '--Chọn--';
                                                    }
                                                ?>
                                            </option>
                                            <option value="VietCombank">VietCombank</option>
                                            <option value="SacomBank">SacomBank</option>
                                            <option value="VietinBank">VietinBank</option>
                                        </select>
                                        
                                        <div class="help-block with-errors"></div>
                                    </div>
                                  <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-2" for="customer_account_number">Số tài khoản</label>
                                    <div class="col-sm-9">
                                        <input name="customer_account_number" class="form-control" id="" autocomplete="off" value="{{$Customer->customer_account_number}}" required="">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                  <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-2" for="customer_account_branch">Chi nhánh</label>
                                    <div class="col-sm-9">
                                        <input name="customer_account_branch" class="form-control" id="" autocomplete="off" value="{{$Customer->customer_account_branch}}" required="">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                  <div class="clearfix"></div>
                                </div>
                                 <hr>
                                <button type="submit" class="btn btn-default" style="text-align: center; margin-left: 450px;">Cập Nhật Thông Tin</button>
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
<style type="text/css">
    .title_customer{
        background-color: #e3d346;
        height: 40px;
        line-height: 40px;
        margin-top: -1px;
        border-radius: 6px;
    }
    .body_customer{
        background-color: #c9e1d1;
        margin-top: 5px;
    }
    .sex_box li{
        display: inline-table;
        width: 90px;
    }
</style>

@section('script')
    <script>
        $(document).ready(function(){
            $("#tinh_dh").change(function(){
                var idTinh = $(this).val();
                ///alert(idTinh);
                $.ajax({
                    type: "GET",
                    data: {},
                    url: "taikhoan/ajax_loadaddress/huyen/"+idTinh,
                    dataType:'html',
                    success : function(response){
                        $("#huyen_dh").html(response);
                    }
                });

            });
            $("#huyen_dh").change(function(){
                var idHuyen = $(this).val();
                //alert(idHuyen);
                $.ajax({
                    type: "GET",
                    data: {},
                    url: "taikhoan/ajax_loadaddress/xa/"+idHuyen,
                    dataType:'html',
                    success : function(response){
                        $("#xa_dh").html(response);
                    }
                });
            });
        });
    </script>
@endsection