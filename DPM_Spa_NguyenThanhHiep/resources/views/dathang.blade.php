@extends('layouts.app')

@section('content')
<div class="container">
  <div id="content">
     @if(session('ThongBaothanhtoan'))
        <div class="alert alert-success">
            {{session('ThongBaothanhtoan')}}
        </div>
    @endif
    @if(session('ThongBaotienvi'))
        <div class="alert alert-success">
            {{session('ThongBaotienvi')}}
        </div>
    @endif
    
    @if(session('ThongBaodonhang'))
        <div class="alert alert-success">
            {{session('ThongBaodonhang')}}
        </div>
    @endif
    <div class="row">
       <form enctype="multipart/form-data" action="dathang/{{Auth::user()->id}}" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="col-sm-6">
          <div class="title_datahng"><h4>Thông tin khách hàng</h4></div>
          <br>
           <div class="form-group">
            <label class="control-label col-sm-3" for="full_name">Họ và tên</label>
              <div class="col-sm-9">
                  <input name="full_name" class="form-control" id="full_name" value="{{$Customer->customer_username}}">
                  <div class="help-block with-errors"></div>
              </div>
            <div class="clearfix"></div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-3" for="email">Email</label>
              <div class="col-sm-9">
                  <input name="email" class="form-control" id=""  value="{{$Customer->customer_email}}">
                  <div class="help-block with-errors"></div>
              </div>
            <div class="clearfix"></div>
          </div>
          <div class="form-group">
              <label class="control-label col-sm-3" for="sex">Giới tính</label>
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
            <label class="control-label col-sm-3" for="">Ngày sinh</label>
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
            <label class="control-label col-sm-3" for="phone">Số điện thoại</label>
              <div class="col-sm-9">
                  <input type="number" name="phone" class="form-control" id="" autocomplete="off" value="{{$Customer->customer_phone}}">
                  <div class="help-block with-errors"></div>
              </div>
            <div class="clearfix"></div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-3" for="note">Ghi chú</label>
              <div class="col-sm-9">
                  <textarea name="note">
                    
                  </textarea>
                  <div class="help-block with-errors"></div>
              </div>
            <div class="clearfix"></div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-3" for="address">Số nhà tên đường</label>
              <div class="col-sm-9">
                  <input type="text" name="address" class="form-control" id="" autocomplete="off" value="{{$Customer->customer_address}}">
                  <div class="help-block with-errors"></div>
              </div>
            <div class="clearfix"></div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-3" for="phone">Tỉnh/TP</label>
              <div class="col-sm-9">
                  <select class="form-control" id="tinh_dh" name="customer_province_id">
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
            <label class="control-label col-sm-3" for="phone">Huyện/Quận</label>
              <div class="col-sm-9">
                  <select class="form-control" id="huyen_dh" name="customer_district_id">
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
            <label class="control-label col-sm-3" for="phone">Xã/Phường</label>
              <div class="col-sm-9">
                  <select class="form-control" id="xa_dh" name="custoner_commune_id">
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
        <div class="col-sm-6">
          <div class="title_datahng"><h4>Sản phẩm của bạn</h4></div>
          <br>
          @if(Session::has('cart'))
            @foreach(Cart::content() as $value)
             <div class="form-group product_dathang">
              <label class="control-label col-sm-3" for="address">Tên sản phẩm:</label>
                <div class="col-sm-9">
                    <label> {{$value->name}}</label>
                    <div class="help-block with-errors"></div>
                </div>
                <label class="control-label col-sm-3" for="address">Số lượng:</label>
                <div class="col-sm-9">
                    <label> {{$value->qty}}</label>
                    <div class="help-block with-errors"></div>
                </div>
                <label class="control-label col-sm-3" for="address">Giá:</label>
                <div class="col-sm-9">
                    <label>
                      {{number_format($value->price * $value->qty, 0 ,',','.')}}&nbsp;vnđ
                        
                    </label>
                    <div class="help-block with-errors"></div>
                </div>
                <p>&nbsp; &nbsp; &nbsp;------------------------------------------------------------------------------------</p>
              <div class="clearfix"></div>
            </div>
            @endforeach
          @endif
          <label class="control-label col-sm-3" for="address">Tổng tiền: </label>
          <div class="col-sm-9">
              <label>

               <?php echo (Cart::total()); echo ('&nbsp;vnđ')?>
                 
               </label>
              <div class="help-block with-errors"></div>
          </div>
          <h6>Hình thức Giao hàng</h6><br>
          <div class="col-sm-12">
              <select class="form-control" id="shiptype_name" name="shiptype_name" required="">
                <option value="">--Chọn--</option>
                @foreach($shiptype as $value)
                <option value="{{$value->id}}">{{$value->shiptype_name}}</option>
                @endforeach
              </select>
              <div class="help-block with-errors"></div>
          </div>
          <br>
          <h6>Hình thức thanh toán</h6><br>
          <div class="col-sm-12">
              <select class="form-control" id="paymenttype_name" name="paymenttype_name" required="">
                
                <option value="">--Chọn--</option>
                <?php 
                  $user = Auth::User();
                  $Customer_code = $user->customer_code;
                  $Customer = \App\Customer::where('customer_code', $Customer_code)->first();
                  $paymenttype = \App\Paymenttype::all();
                  if($Customer->package_id > 1)
                  {
                    foreach($paymenttype as $value)
                    {
                      
                        echo '<option value="'.$value->id.'">'.$value->paymenttype_name.'</option>';
                     
                    }
                  }
                  if($Customer->package_id <= 1)
                  {
                    $RECEIVE_PRODUCT = \App\Paymenttype::where('paymenttype_code', '=', 'RECEIVE_PRODUCT')->first();
                    echo '<option value="'.$RECEIVE_PRODUCT->id.'">'.$RECEIVE_PRODUCT->paymenttype_name.'</option>';
                    $PAYMENT_TRANSFER = \App\Paymenttype::where('paymenttype_code', '=', 'PAYMENT_TRANSFER')->first();
                    echo '<option value="'.$PAYMENT_TRANSFER->id.'">'.$PAYMENT_TRANSFER->paymenttype_name.'</option>';
                    $RECEIVE_NGANLUONG = \App\Paymenttype::where('paymenttype_code', '=', 'RECEIVE_NGANLUONG')->first();
                    echo '<option value="'.$RECEIVE_NGANLUONG->id.'">'.$RECEIVE_NGANLUONG->paymenttype_name.'</option>';
                  }
                ?>
                
              </select>
              <div class="help-block with-errors"></div>
          </div>
          <br>
          <hr>
          <button type="submit" class="btn btn-default">Thanh Toán</button>
        </div>
      </form>
    </div>
  </div> <!-- #content -->
</div> <!-- .container -->

@endsection
<style type="text/css">
  .sex_box li{
        display: inline-table;
        width: 90px;
    }
    .title_datahng{
      background-color: #7bf3c7;
      font-weight: bold;
    }
    .product_dathang{
      border: solid 1px blue;
      border-radius: 5px; 
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
                    url: "ajax_loadaddress_dathang/huyen/"+idTinh,
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
                    url: "ajax_loadaddress_dathang/xa/"+idHuyen,
                    dataType:'html',
                    success : function(response){
                        $("#xa_dh").html(response);
                    }
                });
            });
        });
    </script>
@endsection



