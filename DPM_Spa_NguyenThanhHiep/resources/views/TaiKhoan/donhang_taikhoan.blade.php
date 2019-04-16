@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
           <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div id="page-wrapper">
                        <div class="container-fluid " style="background-color: white; margin: 0 5;">
                                <!-- /.col-lg-12 -->
                          <div class="col-lg-12">
                            <div class="col-lg-3 title_customer">
                               <h5>Thông tin cá nhân</h5>
                            </div>
                            <div class="col-lg-9">
                                <h5>Thông tin đơn hàng của bạn</h5>
                            </div>
                          </div>
                          <div class="col-lg-12" style="padding-bottom:120px">
                            @include('Taikhoan.menu_taikhoan')
                             <div class="col-lg-9" style="padding-bottom:120px">
                              <p>Nhấp vào các nút bên trong menu:</p>

                              <div class="tab">
                                <button class="tablinks" onclick="openCity(event, 'London')">Chờ xác nhận</button>
                                <button class="tablinks" onclick="openCity(event, 'Paris')">Đã xác nhận</button>
                                <button class="tablinks" onclick="openCity(event, 'Tokyo')">Đã giao</button>
                                <button class="tablinks" onclick="openCity(event, 'huy')">Đã Hủy</button>
                              </div>
        <!-- chờ xac nhận -->
                              <div id="London" class="tabcontent">
                                @if(count($data_Order)>0)
                                @foreach($data_Order as $value)
                                  @if($value->confirm_status == 0)
                                    <hr>
                                    <h5 style="color: blue">Thông tin đơn hàng của bạn</h5>
                                      <div class="row orderkh" style="background-color: ">
                                        <div class="col-lg-6">
                                            <div class="topsp">
                                              <label>Mã đơn hàng: </label>
                                              <span>DH{{$value->order_id}}</span> <br>
                                              <label>Ngày đặt: </label>
                                              <span>{{$value->order_createdate}}</span>
                                            </div>
                                            <hr>
                                            <div class="buttomsp">
                                             @foreach($data_Order_detail as $val)
                                                @if($value->order_id == $val->order_id)
                                                  @foreach($dataProduct as $valueProduct)
                                                    @if($val->product_id == $valueProduct->id)
                                                        <div class="row">
                                                          <div class="col-lg-4">
                                                            <img src="image/product/{{$valueProduct->image}}" width="100px" height="90px">
                                                          </div>
                                                          <div class="col-lg-8">
                                                            {{$valueProduct->product_name}} <br>
                                                            <label>Giá:</label><span> {{number_format($valueProduct->price_value, 0 ,',','.')}} VNĐ</span>
                                                          </div>
                                                          
                                                        </div>
                                                       <br>
                                                      @endif
                                                  @endforeach
                                                 
                                                @endif
                                             @endforeach
                                            </div>
                                            <div style="clear:both"></div>
                                            
                                          </div>
                                          <div class="col-lg-6">
                                            <div class="topsp" style="float: right;">
                                              <label>Tổng tiền: </label><br>
                                              <span>{{number_format($value->order_totalvalue, 0 ,',','.')}} VNĐ</span>
                                              
                                            </div>
                                            <div style="clear:both"></div>
                                            <hr>
                                            <div class="buttomsp">
                                              <div class="row">
                                                <div class="col-lg-4">
                                                    <i class="fas fa-spinner fa-lg" style="color: blue"></i>
                                                  Chờ xác nhận
                                                </div>
                                                <div class="col-lg-4">
                                                    <i class="far fa-calendar-check fa-lg" ></i>
                                                  Đã xác nhận
                                                </div>
                                                <div class="col-lg-4">
                                                  <i class="far fa-check-square fa-lg" ></i>
                                                  Đã giao
                                                </div>
                                              </div>
                                            </div>
                                            <div style="clear:both"></div>
                                            <hr>
                                            <div class="buttomsp" style="float: right;">
                                              <a href="#" style="color: red">Hủy đơn hàng</a>
                                            </div>
                                          </div>
                                        </div>
                                        @endif
                                      @endforeach
                                      @else
                                      <label>Bạn chưa có đơn hàng nào !</label>
                                      @endif
                                    <div style="clear:both"></div>
                              </div>
        <!-- Chờ xác nhận -->
                              <div id="Paris" class="tabcontent">
                                @if(count($data_Order)>0)
                                @foreach($data_Order as $value)
                                  @if($value->confirm_status == 1)
                                  <hr>
                                  <h5 style="color: blue">Thông tin đơn hàng của bạn</h5>
                                    <div class="row orderkh" style="background-color: ">
                                      <div class="col-lg-6">
                                          <div class="topsp">
                                            <label>Mã đơn hàng: </label>
                                            <span>DH{{$value->order_id}}</span> <br>
                                            <label>Ngày đặt: </label>
                                            <span>{{$value->order_createdate}}</span>
                                          </div>
                                          <hr>
                                          <div class="buttomsp">
                                           @foreach($data_Order_detail as $val)
                                              @if($value->order_id == $val->order_id)
                                                @foreach($dataProduct as $valueProduct)
                                                  @if($val->product_id == $valueProduct->id)
                                                      <div class="row">
                                                        <div class="col-lg-4">
                                                          <img src="image/product/{{$valueProduct->image}}" width="100px" height="90px">
                                                        </div>
                                                        <div class="col-lg-8">
                                                          {{$valueProduct->product_name}} <br>
                                                          <label>Giá:</label><span> {{number_format($valueProduct->price_value, 0 ,',','.')}} VNĐ</span>
                                                        </div>
                                                        
                                                      </div>
                                                     <br>
                                                    @endif
                                                @endforeach
                                               
                                              @endif
                                           @endforeach
                                          </div>
                                          <div style="clear:both"></div>
                                          
                                        </div>
                                        <div class="col-lg-6">
                                          <div class="topsp" style="float: right;">
                                            <label>Tổng tiền: </label><br>
                                            <span>{{number_format($value->order_totalvalue, 0 ,',','.')}} VNĐ</span>
                                            
                                          </div>
                                          <div style="clear:both"></div>
                                          <hr>
                                          <div class="buttomsp">
                                            <div class="row">
                                              <div class="col-lg-4">
                                                  <i class="fas fa-spinner fa-lg" style="color: blue"></i>
                                                Chờ xác nhận
                                              </div>
                                              <div class="col-lg-4">
                                                  <i class="far fa-calendar-check fa-lg" style="color: blue"></i>
                                                Đã xác nhận
                                              </div>
                                              <div class="col-lg-4">
                                                <i class="far fa-check-square fa-lg"></i>
                                                Đã giao
                                              </div>
                                            </div>
                                          </div>
                                          <div style="clear:both"></div>
                                          <hr>
                                          <div class="buttomsp" style="float: right;">
                                            <a href="#" style="color: red">Hủy đơn hàng</a>
                                          </div>
                                        </div>
                                      </div>
                                    @endif
                                  @endforeach
                                  @else
                                  <label>Bạn chưa có đơn hàng nào !</label>
                                  @endif
                              <div style="clear:both"></div>
                              </div>
         <!-- đã giao -->     
                              <div id="Tokyo" class="tabcontent">
                                @if(count($data_Order)>0)
                                @foreach($data_Order as $value)
                                  @if($value->payment_status == 1)
                                  <hr>
                                  <h5 style="color: blue">Thông tin đơn hàng của bạn</h5>
                                    <div class="row orderkh" style="background-color: ">
                                      <div class="col-lg-6">
                                          <div class="topsp">
                                            <label>Mã đơn hàng: </label>
                                            <span>DH{{$value->order_id}}</span> <br>
                                            <label>Ngày đặt: </label>
                                            <span>{{$value->order_createdate}}</span>
                                          </div>
                                          <hr>
                                          <div class="buttomsp">
                                           @foreach($data_Order_detail as $val)
                                              @if($value->order_id == $val->order_id)
                                                @foreach($dataProduct as $valueProduct)
                                                  @if($val->product_id == $valueProduct->id)
                                                      <div class="row">
                                                        <div class="col-lg-4">
                                                          <img src="image/product/{{$valueProduct->image}}" width="100px" height="90px">
                                                        </div>
                                                        <div class="col-lg-8">
                                                          {{$valueProduct->product_name}} <br>
                                                          <label>Giá:</label><span> {{number_format($valueProduct->price_value, 0 ,',','.')}} VNĐ</span>
                                                        </div>
                                                        
                                                      </div>
                                                     <br>
                                                    @endif
                                                @endforeach
                                               
                                              @endif
                                           @endforeach
                                          </div>
                                          <div style="clear:both"></div>
                                          
                                        </div>
                                        <div class="col-lg-6">
                                          <div class="topsp" style="float: right;">
                                            <label>Tổng tiền: </label><br>
                                            <span>{{number_format($value->order_totalvalue, 0 ,',','.')}} VNĐ</span>
                                            
                                          </div>
                                          <div style="clear:both"></div>
                                          <hr>
                                          <div class="buttomsp">
                                            <div class="row">
                                              <div class="col-lg-4">
                                                  <i class="fas fa-spinner fa-lg" style="color: blue"></i>
                                                Chờ xác nhận
                                              </div>
                                              <div class="col-lg-4">
                                                  <i class="far fa-calendar-check fa-lg" style="color: blue"></i>
                                                Đã xác nhận
                                              </div>
                                              <div class="col-lg-4">
                                                <i class="far fa-check-square fa-lg" style="color: blue"></i>
                                                Đã giao
                                              </div>
                                            </div>
                                          </div>
                                          <div style="clear:both"></div>
                                          <hr>
                                          
                                        </div>
                                      </div>
                                    @endif
                                  @endforeach
                                  @else
                                  <label>Bạn chưa có đơn hàng nào !</label>
                                  @endif
                              <div style="clear:both"></div>
                              </div>
         <!--  hủy -->
                              <div id="huy" class="tabcontent">
                                @if(count($data_Order)>0)
                                @foreach($data_Order as $value)
                                  @if($value->order_istrash == 1)
                                  <hr>
                                  <h5 style="color: blue">Thông tin đơn hàng của bạn</h5>
                                    <div class="row orderkh" style="background-color: ">
                                      <div class="col-lg-6">
                                          <div class="topsp">
                                            <label>Mã đơn hàng: </label>
                                            <span>DH{{$value->order_id}}</span> <br>
                                            <label>Ngày đặt: </label>
                                            <span>{{$value->order_createdate}}</span>
                                          </div>
                                          <hr>
                                          <div class="buttomsp">
                                           @foreach($data_Order_detail as $val)
                                              @if($value->order_id == $val->order_id)
                                                @foreach($dataProduct as $valueProduct)
                                                  @if($val->product_id == $valueProduct->id)
                                                      <div class="row">
                                                        <div class="col-lg-4">
                                                          <img src="image/product/{{$valueProduct->image}}" width="100px" height="90px">
                                                        </div>
                                                        <div class="col-lg-8">
                                                          {{$valueProduct->product_name}} <br>
                                                          <label>Giá:</label><span> {{number_format($valueProduct->price_value, 0 ,',','.')}} VNĐ</span>
                                                        </div>
                                                        
                                                      </div>
                                                     <br>
                                                    @endif
                                                @endforeach
                                               
                                              @endif
                                           @endforeach
                                          </div>
                                          <div style="clear:both"></div>
                                          
                                        </div>
                                        <div class="col-lg-6">
                                          <div class="topsp" style="float: right;">
                                            <label>Tổng tiền: </label><br>
                                            <span>{{number_format($value->order_totalvalue, 0 ,',','.')}} VNĐ</span>
                                            
                                          </div>
                                          <div style="clear:both"></div>
                                          <hr>
                                          <div class="buttomsp">
                                            <div class="row">
                                              <div class="col-lg-4">
                                                  <i class="fas fa-spinner fa-lg"></i>
                                                Chờ xác nhận
                                              </div>
                                              <div class="col-lg-4">
                                                  <i class="far fa-calendar-check fa-lg"></i>
                                                Đã xác nhận
                                              </div>
                                              <div class="col-lg-4">
                                                <i class="far fa-check-square fa-lg"></i>
                                                Đã giao
                                              </div>
                                            </div>
                                          </div>
                                          <div style="clear:both"></div>
                                          <hr>
                                          <div class="buttomsp" style="float: right;">
                                            <a href="#" style="color: red">Đã hủy đơn hàng</a>
                                          </div>
                                        </div>
                                      </div>
                                    @endif
                                  @endforeach
                                  @else
                                  <label>Bạn chưa có đơn hàng nào !</label>
                                  @endif
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
    .thongbaoxacnhan{
      margin: 15px auto;
      background-color: #d2ed9b;
      width: 800px;
      float: right;
      height: 30px;
      line-height: 30px;
      text-align: center;
    }
    
    body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>


@section('script')

<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
@endsection