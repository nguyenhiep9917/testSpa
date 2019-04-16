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
                                <h5>Cập nhật mật khẩu</h5>
                            </div>
                        </div>
                        <div class="col-lg-12" style="padding-bottom:120px">
                            @include('Taikhoan.menu_taikhoan')
                             <form enctype="multipart/form-data" action="taikhoan/doimatkhau/{{Auth::user()->id}}" method="POST">
                               <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="col-lg-9" style="padding-bottom:120px">
                                  <hr>
                                  <!-- <div class="form-group">
                                    <label class="control-label col-sm-2" for="customer_username">Mật khẩu củ</label>
                                      <div class="col-sm-9">
                                          <input type="text" name="matkhaucu" class="form-control" id="matkhaucu" value="" >
                                          <div class="help-block with-errors"></div>
                                      </div>
                                    <div class="clearfix"></div>
                                  </div> -->
                                  <div class="form-group">
                                    <label class="control-label col-sm-2" for="customer_passwordnew">Mật khẩu mới</label>
                                      <div class="col-sm-9">
                                          <input type="password" name="customer_passwordnew" class="form-control" id="customer_passwordnew" value="" >
                                          <div class="help-block with-errors"></div>
                                      </div>
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-2" for="customer_passwordnewXacNhan">Xác nhận lại mật khẩu</label>
                                      <div class="col-sm-9">
                                          <input type="password" name="customer_passwordnewXacNhan" class="form-control" id="customer_passwordnewXacNhan" value="" >
                                          <div class="help-block with-errors"></div>
                                      </div>
                                    <div class="clearfix"></div>
                                  </div>
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