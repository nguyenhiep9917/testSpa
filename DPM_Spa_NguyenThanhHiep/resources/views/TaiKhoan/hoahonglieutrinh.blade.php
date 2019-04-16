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
                            <div class="col-lg-12">
                                
                                    <div class="col-lg-3 title_customer">
                                       <h5>Danh sách đơn hàng</h5>
                                    </div>
                                    <div class="col-lg-9">
                                        <h5>Hoa hồng trong tháng</h5>
                                    </div>
                            </div>


                            <div class="col-lg-12" style="padding-bottom:120px">
                                
                                    @include('Taikhoan.menu_taikhoan')


                                    <div class="col-lg-9" style="padding-bottom:120px">
                                      <div class="form-group">
                                        <table class="table">
                                          <thead>
                                            <tr>
                                              <th scope="col">STT</th>
                                              <th scope="col">Tháng/Năm</th>
                                              <th scope="col">Ngày tạo</th>
                                              <th scope="col">Trang thái</th>
                                              <th scope="col">Hoa hồng</th>
                                              <th scope="col">Ghi chú</th>
                                              <th scope="col">Thanh toán</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <th scope="row">1</th>
                                              <td>Mark</td>
                                              <td>Otto</td>
                                              <td>@mdo</td>
                                              <td>Otto</td>
                                              <td>@mdo</td>
                                              <td>Otto</td>
                                            </tr>
                                          </tbody>
                                        </table>
                                        <div class="clearfix"></div>
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