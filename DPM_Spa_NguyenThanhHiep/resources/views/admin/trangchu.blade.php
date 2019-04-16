@extends('admin.layout.index')

@section('content')
@include('admin.layout.show_number')
<hr>
<div class="tabledailymax">
  <h3>Danh sách thành viên đại lý</h3>
</div>
<p></p>
<table id="DataList" class="table table-bordered table-hover table-sm">
        <thead>
          <tr>
            <th width="25%">Thành viên</th>
            <th width="25%">Đại lý</th>
            <th width="10%">Giá</th>
            <th width="15%">Ngày xác nhận</th>
            <th width="10%">Mã</th>
            <th width="15%">Trạng thái</th>
          </tr>
        </thead>
        <tbody>
          @foreach($dataDL as $value)
            
              <tr>
                <td>@foreach($customer as $valcustomer)
                    @if($value->customer_id == $valcustomer->customer_id)
                      {{$valcustomer->customer_username}}
                    @endif
                  @endforeach</td>
                <td>
                  @foreach($customer as $valcustomer)
                    @if($value->customer_id == $valcustomer->customer_id)
                      @if($valcustomer->package_id == 1)
                        <p>Gói miễn phí</p>
                      @endif
                      @if($valcustomer->package_id == 2)
                        <p>Gói thường</p>
                      @endif
                      @if($valcustomer->package_id == 3)
                        <p>Gói Vip</p>
                      @endif
                    @endif
                  @endforeach
                </td>
                <td>
                  {{$value->hoahongdoanhsodaily_tong}}
                </td>
                <td>
                  {{$value->hoahongdoanhsodaily_createdate}}
                </td>
                <td>
                  <p style="background-color: #9dfcb1; text-align: center;">
                    GDL{{$value->hoahongdoanhsodaily_id}}
                  </p>
                </td>
                <td style="text-align: center;">
                  <p style="background-color: #79cc1d; color: white">
                    Đã xác nhận
                  </p> 
                </td>
              </tr>
          @endforeach
        </tbody>
      </table>




<div class="bottom-grids">
	<div class="dev-table">    
		<div class="col-md-4 dev-col">                                    

        <div class="dev-widget dev-widget-transparent">
            <h2 class="inner one">Đơn hàng</h2>
            <p>Đơn hàng hiện tại :
                  {{count($order)}} 
            </p>                                        
            <div class="dev-stat"><span class="counter"></span></div>                                                                                
                                                 
            <p>Số lượng đơn hàng đã thành toán: {{count($orderPayments)}}</p>

            <a href="#" class="dev-drop">Vào xem danh sách đơn hàng <span class="fa fa-angle-right pull-right"></span></a>
        </div>

    </div>
    <div class="col-md-4 dev-col mid">                                    

        <div class="dev-widget dev-widget-transparent dev-widget-success">
             <h3 class="inner">Khách hàng</h3>
            <p>Số lượng khách hàng hiện tại: {{count($customer)}}</p>                                        
            <p>Thành viên đại lý hiện tài có : {{count($dataDL)}}</p>

            <a href="#" class="dev-drop">Vào xem danh sách khách hàng<span class="fa fa-angle-right pull-right"></span></a>
        </div>

    </div>
    <div class="col-md-4 dev-col">                                    

        <div class="dev-widget dev-widget-transparent dev-widget-danger">
             <h3 class="inner">Đại lý</h3>
            <p>Hiện có đại lý: {{count($dataDL)}}</p>
            <p>Đại lý miễn phí: {{count($customerPackage0)}}</p>
            <p>Đại lý thường: {{count($customerPackage1)}}</p>              
            <p>Đại lý Vip: {{count($customerPackage2)}}</p>
            <a href="#" class="dev-drop">Take a closer look <span class="fa fa-angle-right pull-right"></span></a>                                        
        </div>

    </div>
	<div class="clearfix"></div>		
	
	</div>
	</div>





@endsection