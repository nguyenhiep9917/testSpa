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
                                        <h5>Thông tin ví của bạn</h5>
                                    </div>
                            </div>
                            <div class="col-lg-12" style="padding-bottom:120px">
                              @include('Taikhoan.menu_taikhoan')
                               <div class="col-lg-9" style="padding-bottom:120px">
                                <div class="form-group">
                                  <hr>
                                    <div class="row orderkh" style="background-color: ">
                                      <div class="col-lg-5">
                                          <div class="topsp">
                                              <table class="table table-striped">
                                                  <tr>
                                                    <th scope="col" width="40%">Mã đại lý:</th>
                                                    <th scope="col"width="60%">DL{{$finddl->hoahongdoanhsodaily_id}}</th>
                                                  </tr>
                                                  <tr>
                                                    <th scope="col" width="40%">Ngày nâng cấp:</th>
                                                    <th scope="col"width="60%">Tháng-{{$finddl->hoahongdoanhsodaily_month}}-{{$finddl->hoahongdoanhsodaily_year}}
                                                    </th>
                                                  </tr>
                                              </table>
                                          </div>
                                          
                                          <div style="clear:both"></div>
                                          
                                        </div>
                                        <div class="col-lg-7">
                                          
                                          <div class="buttomsp">
                                            <table class="table table-striped">
                                              <tr>
                                                <th scope="col" width="40%">Tổng số tiền trong ví:</th>
                                                <th scope="col"width="50%"><span style="color: blue; font-weight: bold;">{{number_format($finddl->hoahongdoanhsodaily_tong,0,',','.')}} VNĐ</span></th>
                                                <th scope="col"width="10%"><a href="">  </a>
                                                </th>
                                              </tr>
                                              <tr>
                                                <th scope="col" width="50%">Hoa hồng doanh số đại lý:</th>
                                                <th scope="col"width="20%"><span style="color: blue; font-weight: bold;">0.0 VNĐ</span>
                                                </th>
                                                <th scope="col"width="30%"><a href="">Xem chi tiết</a>
                                                </th>
                                              </tr>
                                              <tr>
                                                <th scope="col" width="40%">Hoa hồng tổng đại lý:</th>
                                                <th scope="col"width="30%"><span style="color: blue; font-weight: bold;">0.0 VNĐ</span>
                                                </th>
                                                <th scope="col"width="30%"><a href="">Xem chi tiết</a>
                                                </th>
                                              </tr>
                                            </table>
                                          </div>
                                          <div style="clear:both"></div>
                                        </div>
                                      </div>
                              <div style="clear:both"></div>
                              <!-- <div class="buttomsp" >
                                <a href="taikhoan/ordervidailys/{{$finddl->customer_id}}" style="color: red; background-color: #b7f1b7; border-radius: 5px;">Xem các đơn hàng trừ từ ví</a>
                              </div> -->
           <!--  don hang dl -->
                              <hr>
                              <h4>Quản lý đơn hàng</h4>
                              <div class="tab">
                                <button class="tablinks" onclick="openCity(event, 'London')">Đơn hàng mua trong tháng</button>
                                <button class="tablinks" onclick="openCity(event, 'Paris')">Đơn hàng mua từ ví</button>
                                <button class="tablinks" onclick="openCity(event, 'Tokyo')">Đơn hàng đã hủy</button>
                              </div>
<!-- Đơn hàng mua trong tháng -->
                              <div id="London" class="tabcontent">
                                <table id="DataList" class="table table-bordered table-hover table-sm">
                                  <thead>
                                    <tr>
                                      <th width="5%">#</th>
                                      <th width="25%">Mã đơn hàng</th>
                                      <th width="10%">Ngày đặt</th>
                                      <th width="30%">Sản phẩm</th>
                                      <th width="15%">Tổng tiền</th>
                                      <th width="15%">Trạng thái</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @php $count = 1; @endphp
                                      @foreach($data_Order as $value)
                                        @if($value->payment_status == 1 && $value->paymenttype_id != 8)
                                          <tr>
                                            <td>{{$count++}}</td>
                                            <td>
                                             MDH{{$value->order_id}}
                                            </td>
                                            <td>
                                             <?php
                                              echo date('m/d/Y h:i:sa', $value->payment_date);
                                             ?>
                                            </td>
                                            <td>
                                              @if($value->order_totalvalue == 5000000)
                                                Gói đại lý thường
                                              @endif
                                              @if($value->order_totalvalue == 25000000)
                                                Gói đại lý Vip
                                              @endif
                                              @foreach($data_Order_detail as $val)
                                                @if($val->order_id == $value->order_id)
                                                  @foreach($product as $vlProduct)
                                                    @if($val->product_id == $vlProduct->id)
                                                      {{$vlProduct->product_name}} <br>
                                                    @endif
                                                  @endforeach
                                                @endif
                                              @endforeach
                                            </td>
                                             
                                            <td>
                                               {{number_format($value->order_totalvalue,0,',','.')}} VNĐ
                                            </td>
                                            <td>
                                              @if($value->payment_status == 1)
                                              Đã Thanh toán
                                              @endif
                                            </td>
                                          </tr>
                                          @endif
                                      @endforeach
                                  </tbody>
                                </table>
                              </div>
<!-- Đơn hàng mua từ ví -->
                              <div id="Paris" class="tabcontent">
                                <table id="DataList" class="table table-bordered table-hover table-sm">
                                  <thead>
                                    <tr>
                                      <th width="5%">#</th>
                                      <th width="25%">Tên khách hàng</th>
                                      <th width="15%">Số điện thoại</th>
                                      <th width="10%">Ngày đặt</th>
                                      <th width="30%">Sản phẩm</th>
                                      <th width="15%">Trạng thái</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @php $count = 1; @endphp
                                    @foreach($data_Order as $value)
                                        @if($value->paymenttype_id == 8)
                                          <tr>
                                            <td>{{$count++}}</td>
                                            <td>
                                             MDH{{$value->order_id}}
                                            </td>
                                            <td>
                                             <?php
                                              echo date('m/d/Y h:i:sa', $value->payment_date);
                                             ?>
                                            </td>
                                            <td>
                                              @if($value->order_totalvalue == 5000000)
                                                Gói đại lý thường
                                              @endif
                                              @if($value->order_totalvalue == 25000000)
                                                Gói đại lý Vip
                                              @endif
                                              @foreach($data_Order_detail as $val)
                                                @if($val->order_id == $value->order_id)
                                                  @foreach($product as $vlProduct)
                                                    @if($val->product_id == $vlProduct->id)
                                                      {{$vlProduct->product_name}} <br>
                                                    @endif
                                                  @endforeach
                                                @endif
                                              @endforeach
                                            </td>
                                             
                                            <td>
                                               {{number_format($value->order_totalvalue,0,',','.')}} VNĐ
                                            </td>
                                            <td>
                                              @if($value->payment_status == 1)
                                              Đã Thanh toán
                                              @endif
                                            </td>
                                          </tr>
                                          @endif
                                      @endforeach
                                  </tbody>
                                </table>
                              </div>
<!-- Đơn hàng đã hủy -->
                              <div id="Tokyo" class="tabcontent">
                                <table id="DataList" class="table table-bordered table-hover table-sm">
                                  <thead>
                                    <tr>
                                      <th width="5%">#</th>
                                      <th width="25%">Tên khách hàng</th>
                                      <th width="15%">Số điện thoại</th>
                                      <th width="10%">Ngày đặt</th>
                                      <th width="30%">Sản phẩm</th>
                                      <th width="15%">Trạng thái</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @php $count = 1; @endphp
                                    @foreach($data_Order as $value)
                                        @if($value->order_istrash == 1)
                                          <tr>
                                            <td>{{$count++}}</td>
                                            <td>
                                             MDH{{$value->order_id}}
                                            </td>
                                            <td>
                                             <?php
                                              echo date('m/d/Y h:i:sa', $value->payment_date);
                                             ?>
                                            </td>
                                            <td>
                                              @if($value->order_totalvalue == 5000000)
                                                Gói đại lý thường
                                              @endif
                                              @if($value->order_totalvalue == 25000000)
                                                Gói đại lý Vip
                                              @endif
                                              @foreach($data_Order_detail as $val)
                                                @if($val->order_id == $value->order_id)
                                                  @foreach($product as $vlProduct)
                                                    @if($val->product_id == $vlProduct->id)
                                                      {{$vlProduct->product_name}} <br>
                                                    @endif
                                                  @endforeach
                                                @endif
                                              @endforeach
                                            </td>
                                             
                                            <td>
                                               {{number_format($value->order_totalvalue,0,',','.')}} VNĐ
                                            </td>
                                            <td>
                                              @if($value->payment_status == 1)
                                              Đã Thanh toán
                                              @endif
                                            </td>
                                          </tr>
                                          @endif
                                      @endforeach
                                  </tbody>
                                </table>
                              </div>
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