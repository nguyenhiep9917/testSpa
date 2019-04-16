@extends('layouts.app')

@section('content')
@include('slider')

<div class="header-content">
    <div class="container">
        <div class="box-header-content-top box">
            <ul>
                <li class="check-spa"><i class="fas fa-map-marker-alt fa-lg" style="color: red"></i> <a href="#"> SPA GẦN NHẤT</a></li>
                <li class="flash-sale"><i class="fas fa-bolt fa-lg" style="color: orange"></i><a href="#"> FLASH SALE</a></li>
                <li class="vouchers"><a href="{{url('tin-tuc')}}"><i class="fas fa-newspaper fa-lg" style="color: blue"></i> NEWS</a></li>
                <li class="wishlist"><i class="fas fa-heart fa-lg" style="color: #e95cb1"></i><a href=""> YÊU THÍCH</a> </li>
            </ul>
        </div>
        <hr>
    </div>
</div>

<div class="container">
    <p></p>
    <div class="box-item box-merchandise">
        <h5 class="title"><label style="font-size: 18px; margin-left: 10px;">SẢN PHẨM SLASH SALE</label></h5>
        <div class="">
                
                @foreach($data_productsale as $value)
                <div class="col-xs-6 col-md-3">
                    <br>
                    <div class="item-merchandise" >
                        <div class="img_product">
                            <a href="#">
                            <img class="img-responsive" src="image/product/{{$value->image}}" style="height: 110px; width: 120px; text-align: center; margin: 5px auto;">
                            </a>
                        </div>
                        <br>
                        <div class="nam_product">
                            <a href="#" class="nam_spa">{{$value->product_name}}</a>
                        </div>
                        <div class="price_product">
                            <a href="#" class="nam_spa">{{number_format($value->price_value, 0 ,',','.')}} <label>vnđ</label></a>
                        </div> <br>
                        <div class="" style=" width:  80%; margin: 0 auto;" >
                            <div class="row">
                                <div class="col-xs-7" style="text-align: center;  background-color: #e5d47e; border-radius: 4px; height: 27px; line-height: 27px;">
                                    <a href="{{url('mua-hang',[$value->id, $value->product_name, $value->price_value])}}" class="addcart"><i class="fas fa-cart-plus"></i>Thêm vào giỏ</a>
                                </div>
                                <div class="col-xs-5" style="text-align: center;  background-color: #00ffd0 ; border-radius: 4px; margin-left: 4px; width: 90px; height: 27px; line-height: 27px;">
                                    <a href="xemc-chi-tiet-san-pham/{{$value->id}}">Chi tiết</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            <div class="clearfix"></div>
        </div>
    </div>
    <p><hr></p>
  </div>  
@endsection

<style type="text/css">
    .cartss{
        text-align: center;
        height: 28px;
        line-height: 28px;
        width: 130px;
        border-radius: 6px;
        margin: 0 auto;
        background-color: #90e1f1;
    }
</style>