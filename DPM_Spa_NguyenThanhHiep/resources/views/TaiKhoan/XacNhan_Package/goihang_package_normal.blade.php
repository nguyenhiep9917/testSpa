@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
     <div id="page-wrapper">
      <div class="container-fluid">
          <div class="row">
              <div class="col-sm-12">
                  <h4 style="font-weight: bold;">Thông tin giỏ hàng</h4><br>
                  <table class="table table-sm">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên gói</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Tổng giá</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <form action="{{url('dangnhap')}}" method="post" class="beta-form-checkout">
                      <input type="hidden" name="_token" value="{{csrf_token()}}">
                          @php $count = 1; @endphp
                          @foreach($content as $item)
                          <tr>
                            <th scope="row">{{$count++}}</th>
                            <td>{{$item->name}}</td>
                            <td>{{number_format($item->price, 0 ,',','.')}}&nbsp;vnđ</td>
                            <td>{{number_format($item->price * $item->qty, 0 ,',','.' )}}&nbsp;vnđ</td>
                            <td><a href="package/xoa-package/{{$item->rowId}}"><i class="fas fa-times-circle fa-lg"></i></a></td>
                          </tr>
                          @endforeach
                      </form>
                    </tbody>
                  </table>
              </div>
          </div>
          <div class="row">
              <div class="col-sm-8">
              </div>
              <div class="col-sm-4">
                  <table class="table table-bordered table-dark">
                    <thead>
                      <tr>
                        <th scope="col" style="color: red">Tổng Giá:</th>
                        <th scope="col">{{$totals}}&nbsp;vnđ</th>
                      </tr>
                    </thead>
                  </table>
              </div>
          </div>
          <div class="thanhtoangiohang">
            <a href="package/dathangPackage/{{Auth::user()->id}}" >Tiến hành đặt mua</a>
          </div>
      </div>
  </div>
  </div>
  <br>
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
    .thanhtoangiohang{
    float: right; 
    background-color: #66d7fa; 
    width: 200px; height: 35px; 
    font-weight: bold; 
    line-height: 35px;
    border-radius: 5px;
  }
    .thanhtoangiohang a {
    margin-left: 40px;
  }
</style>




