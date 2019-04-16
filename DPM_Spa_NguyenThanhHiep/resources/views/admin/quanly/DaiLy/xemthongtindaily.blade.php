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

		<h3>Thông tin đại lý</h3>
		<div class="card-body">
			
			<form enctype="multipart/form-data" action="admin/quanly/yeucauxnthongtin/{{$Customer->customer_id}}" method="POST">
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
                        <div class="col-sm-9">
                            <input type="date" name="customer_dateofbirth" class="form-control" id="" autocomplete="off" value="{{$Customer->customer_dateofbirth}}" required="">
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
                    <div style="clear:both"></div>
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
                    <button type="submit" class="btn btn-default" style="text-align: center; margin-left: 450px;">Gửi yêu cầu</button>
                    <a href="admin/quanly/goidailykhachhang" class="btn btn-default" style="background-color: #8ce4e8; border-radius: 3px;">Trở lại</a>
			</form>

		</div>
	</div>

@endsection
<style type="text/css">
	.centers a{
		margin-left: 40px;

	}

	.centerss a{
		margin-left: 20px;
	}
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