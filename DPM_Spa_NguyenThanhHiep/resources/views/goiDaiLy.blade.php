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
                                    @if(Auth::user())
                                      &nbsp; &nbsp; &nbsp;&nbsp;Xin chào bạn <strong>{{Auth::user()->name}}</strong> đến với hệ thống Spa.
                                    @else
                                      &nbsp; &nbsp; &nbsp;&nbsp;Xin chào bạn đến với hệ thống Spa mời bạn <strong><a href="{{url('/dangnhap')}}">đăng nhập</a></strong> vào để hệ thống.
                                    @endif
                                        <br>
                                          <div class="row">
                                            <h3 class="title-package_key">Nâng cấp thành viên đại lý để nhận nhiều ưu đãi</h3>
                                            <br>
                                            @if($find_customer->package_id == 0)
                                            <div class="col-sm-12">
                                              <ul class="sex_box">
                                                <li>
                                                    <div class="table-item">

                                                        <h2 class="price">
                                                            {{number_format($data_package_free->package_price)}} <sup>đ</sup>
                                                        </h2>
                                                        <p class="class_package"><a title="Thành viên đại lý đồng" href="#" class="title_package_free">{{$data_package_free->package_name}}</a></p>
                                                        <br>
                                                        <div class="package-description">
                                                            <p>{{$data_package_free->package_description_short}}</p>
                                                        </div>
                                                         <div class="link-register_free"><a title="Thành viên đại lý đồng" href="{{url('package/mua-package',[$data_package_free->id, $data_package_free->package_name])}}">Nâng cấp</a></div>
                                                    </div>
                                                  </li>
                                                <li>
                                                    <div class="table-item gold">
                                                        <h2 class="price">
                                                            {{number_format($data_package_normal->package_price)}} <sup>đ</sup>
                                                        </h2>
                                                        <p class="class_package"><a title="Thành viên đại lý đồng" href="#" class="title_package_normal">{{$data_package_normal->package_name}}</a></p>
                                                        <br>
                                                        <div class="package-description">
                                                            <p>{{$data_package_normal->package_description_short}}</p>
                                                        </div>
                                                        
                                                        <div class="link-register_normal"><a title="Thành viên đại lý đồng" href="{{url('package/mua-package',[$data_package_normal->id, $data_package_normal->package_name])}}">Nâng cấp</a></div>
                                                    </div>
                                                  </li>
                                                  <li>
                                                      <div class="table-item gold">
                                                        <h2 class="price">
                                                            {{number_format($data_package_vip->package_price)}} <sup>đ</sup>
                                                        </h2>
                                                        <p class="class_package"><a title="Thành viên đại lý đồng" href="#" class="title_package_normal">{{$data_package_vip->package_name}}</a></p>
                                                        <br>
                                                        <div class="package-description">
                                                            <p>{{$data_package_vip->package_description_short}}</p>
                                                        </div>
                                                        
                                                        <div class="link-register_normal"><a title="Thành viên đại lý đồng" href="{{url('package/mua-package',[$data_package_vip->id, $data_package_vip->package_name])}}">Nâng cấp</a></div>
                                                    </div>
                                                  </li>
                                              </ul>
                                            </div>
                                            @endif

                                            @if($find_customer->package_id == 1)
                                            <div class="col-sm-12">
                                              <ul class="sex_box">
                                                <li>
                                                    <div class="table-item">

                                                        <h2 class="price">
                                                            {{number_format($data_package_free->package_price)}} <sup>đ</sup>
                                                        </h2>
                                                        <p class="class_package"><a title="Thành viên đại lý đồng" href="#" class="title_package_free">{{$data_package_free->package_name}}</a></p>
                                                        <br>
                                                        <div class="package-description">
                                                            <p>{{$data_package_free->package_description_short}}</p>
                                                        </div>
                                                        <!-- <br><br><br><br>
                                                        <div class="link-register_normal"><a title="Thành viên đại lý đồng" href="taikhoan/xacnhan_package_free/{{$find_customer->customer_id}}">Nâng cấp</a></div> -->
                                                    </div>
                                                  </li>
                                                <li>
                                                    <div class="table-item gold">
                                                        <h2 class="price">
                                                            {{number_format($data_package_normal->package_price)}} <sup>đ</sup>
                                                        </h2>
                                                        <p class="class_package"><a title="Thành viên đại lý đồng" href="#" class="title_package_normal">{{$data_package_normal->package_name}}</a></p>
                                                        <br>
                                                        <div class="package-description">
                                                            <p>{{$data_package_normal->package_description_short}}</p>
                                                        </div>
                                                        
                                                        <div class="link-register_normal"><a title="Thành viên đại lý đồng" href="{{url('package/mua-package',[$data_package_normal->id, $data_package_normal->package_name])}}">Nâng cấp</a></div>
                                                    </div>
                                                  </li>
                                                  <li>
                                                      <div class="table-item gold">
                                                        <h2 class="price">
                                                            {{number_format($data_package_vip->package_price)}} <sup>đ</sup>
                                                        </h2>
                                                        <p class="class_package"><a title="Thành viên đại lý đồng" href="#" class="title_package_normal">{{$data_package_vip->package_name}}</a></p>
                                                        <br>
                                                        <div class="package-description">
                                                            <p>{{$data_package_vip->package_description_short}}</p>
                                                        </div>
                                                        
                                                        <div class="link-register_normal"><a title="Thành viên đại lý đồng" href="{{url('package/mua-package',[$data_package_vip->id, $data_package_vip->package_name])}}">Nâng cấp</a></div>
                                                    </div>
                                                  </li>
                                              </ul>
                                            </div>
                                            @endif
                                            @if($find_customer->package_id == 2)
                                            <div class="col-sm-12">
                                              <ul class="sex_box">
                                                <li>
                                                    <div class="table-item">

                                                        <h2 class="price">
                                                            {{number_format($data_package_free->package_price)}} <sup>đ</sup>
                                                        </h2>
                                                        <p class="class_package"><a title="Thành viên đại lý đồng" href="#" class="title_package_free">{{$data_package_free->package_name}}</a></p>
                                                        <br>
                                                        <div class="package-description">
                                                            <p>{{$data_package_free->package_description_short}}</p>
                                                        </div>
                                                        <!-- <br><br><br><br>
                                                        <div class="link-register_normal"><a title="Thành viên đại lý đồng" href="taikhoan/xacnhan_package_free/{{$find_customer->customer_id}}">Nâng cấp</a></div> -->
                                                    </div>
                                                  </li>
                                                <li>
                                                    <div class="table-item gold">
                                                        <h2 class="price">
                                                            {{number_format($data_package_normal->package_price)}} <sup>đ</sup>
                                                        </h2>
                                                        <p class="class_package"><a title="Thành viên đại lý đồng" href="#" class="title_package_normal">{{$data_package_normal->package_name}}</a></p>
                                                        <br>
                                                        <div class="package-description">
                                                            <p>{{$data_package_normal->package_description_short}}</p>
                                                        </div>
                                                        
                                                       <!--  <div class="link-register_normal"><a title="Thành viên đại lý đồng" href="{{url('package/mua-package',[$data_package_normal->id, $data_package_normal->package_name])}}">Nâng cấp</a></div> -->
                                                    </div>
                                                  </li>
                                                  <li>
                                                      <div class="table-item gold">
                                                        <h2 class="price">
                                                            {{number_format($data_package_vip->package_price)}} <sup>đ</sup>
                                                        </h2>
                                                        <p class="class_package"><a title="Thành viên đại lý đồng" href="#" class="title_package_normal">{{$data_package_vip->package_name}}</a></p>
                                                        <br>
                                                        <div class="package-description">
                                                            <p>{{$data_package_vip->package_description_short}}</p>
                                                        </div>
                                                        
                                                        <div class="link-register_normal"><a title="Thành viên đại lý đồng" href="{{url('package/mua-package',[$data_package_vip->id, $data_package_vip->package_name])}}">Nâng cấp</a></div>
                                                    </div>
                                                  </li>
                                              </ul>
                                            </div>
                                            @endif



                                            <!-- gói dai lý đã là vip  -->
                                            @if($find_customer->package_id == 3)
                                             <div class="col-sm-12">
                                              <ul class="sex_box">
                                                <li>
                                                    <div class="table-item">

                                                        <h2 class="price">
                                                            {{number_format($data_package_free->package_price)}} <sup>đ</sup>
                                                        </h2>
                                                        <h3 class="class_package"><a title="Thành viên đại lý đồng" href="#" class="title_package_free">{{$data_package_free->package_name}}</a></h3>
                                                        <br>
                                                        <div class="package-description">
                                                            <p>{{$data_package_free->package_description_short}}</p>
                                                        </div>
                                                        <!-- <br><br><br><br>
                                                        <div class="link-register_normal"><a title="Thành viên đại lý đồng" href="taikhoan/xacnhan_package_free/{{$find_customer->customer_id}}">Nâng cấp</a></div> -->
                                                    </div>
                                                  </li>
                                                <li>
                                                    <div class="table-item gold">
                                                        <h2 class="price">
                                                            {{number_format($data_package_normal->package_price)}} <sup>đ</sup>
                                                        </h2>
                                                        <h3 class="class_package"><a title="Thành viên đại lý đồng" href="#" class="title_package_normal">{{$data_package_normal->package_name}}</a></h3>
                                                        <br>
                                                        <div class="package-description">
                                                            <p>{{$data_package_normal->package_description_short}}</p>
                                                        </div>
                                                        
                                                    </div>
                                                  </li>
                                                  <li>
                                                      <div class="table-item gold">
                                                        <h2 class="price">
                                                            {{number_format($data_package_vip->package_price)}} <sup>đ</sup>
                                                        </h2>
                                                        <h3 class="class_package"><a title="Thành viên đại lý đồng" href="#" class="title_package_normal">{{$data_package_vip->package_name}}</a></h3>
                                                        <br>
                                                        <div class="package-description">
                                                            <p>{{$data_package_vip->package_description_short}}</p>
                                                        </div>
                                                       
                                                    </div>
                                                    </div>
                                                  </li>
                                              </ul>
                                            </div>
                                            @endif
                                        </div>
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
        width: 260px;
        height: 300px;
        border-radius: 5px;
        border: 2px solid #f8d4d4;
        padding: 5px;
        background-color: #fae4e4;
        margin-left: 75px;
    }
    .title-package_key{
        font-weight: bold;
        font-size: 18pt;
        margin-left: 18px;
        color: blue;
    }
    .price{
        margin: 22px;
        color: black;
        font-size: 24pt;
        text-align: center;
        font-weight: bold;
    }
    .class_package{
        font-size: 18pt;
        text-align: center;
        color: red;
        font-weight: bold;
    }
    .title_package_free{
        color: #4cd54c;
    }
    .title_package_normal{
        color: #e53099;
    }
    .title_package_vip{
        color: #ffae00;
    }
    .package-description{
        text-align: center;
    }
    .table-item .link-register > a {
        color: #a165f1;
        font-weight: 600;
        border-radius: 20px;
        padding: 10px 30px;
        font-size: 17px;
        position: relative;
        top: 20px;
        background-color: #b8f3da;
        margin-left: 55px;
    }
    .table-item .link-register_normal > a {
        color: #a165f1;
        font-weight: 600;
        border-radius: 20px;
        padding: 10px 30px;
        font-size: 17px;
        position: relative;
        top: 60px;
        background-color: #b8f3da;
        margin-left: 55px;
    }
    
    .link-register_free > a {
        color: #a165f1;
        font-weight: 600;
        border-radius: 20px;
        padding: 10px 30px;
        font-size: 17px;
        position: relative;
        top: 137px;
        background-color: #b8f3da;
        margin-left: 55px;
    }
</style>