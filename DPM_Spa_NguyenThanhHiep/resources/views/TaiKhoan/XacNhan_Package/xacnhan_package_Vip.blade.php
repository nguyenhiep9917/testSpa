@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
           <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div id="page-wrapper">
                        <div class="container-fluid " style="background-color: white; margin: 0 5;">
                            <div class="col-lg-12">
                                    <div class="col-lg-3 title_customer">
                                       <h5>Thông tin khách hàng</h5>
                                    </div>
                                    <div class="col-lg-9">
                                        <h5>THÀNH VIÊN ĐẠI LÝ MIỄN PHÍ</h5>
                                    </div>
                            </div>
                            <div class="col-lg-12" style="padding-bottom:120px">
                                @include('Taikhoan.menu_taikhoan')
                                <div class="col-lg-9" style="padding-bottom:120px">
                                  <hr>
                                  <div class="row">
                                      <div class="col-lg-3" style="padding-bottom:120px">
                                      </div>
                                      <div class="col-lg-6" style="padding-bottom:120px">
                                          <form action="taikhoan/xacnhan_package_vip/{{$find_customer->customer_id}}" method="post">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <div class="form-group">
                                              <h2 class="price">
                                                Số tiền: 25.000.000 <sup>đ</sup>
                                              </h2>
                                              <br>
                                              <p>Thành viên đại lý Vip.</p>
                                              <br>
                                              <div class="form-block">
                                                  <button type="submit" class="btn btn-primary">Xác nhận</button>
                                              </div>
                                            </div>
                                          </form>
                                      </div>
                                      <div class="col-lg-3" style="padding-bottom:120px">
                                      </div>
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
    
</style>