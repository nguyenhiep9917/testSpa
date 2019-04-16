@extends('layouts.app')

@section('content')

<div class="header-content">
    <div class="container">
        <div class="box-header-content-top box">
            <ul>
                <li class="check-spa"><i class="fa fa-map-marker" aria-hidden="true"></i><a href="#">SPA GẦN NHẤT</a></li>
                <li class="flash-sale"><i class="fa fa-bolt" aria-hidden="true"></i><a href="#">FLASH SALE</a></li>
                <li class="vouchers"><i class="fa fa-gift" aria-hidden="true"></i><a href="">VOUCHERS</a></li>
                <li class="wishlist"><i class="fa fa-heart" aria-hidden="true"></i><a href="">YÊU THÍCH</a> </li>
            </ul>
        </div>
        <hr>
    </div>
</div>


<div class="container">
    <p><br></p>
    <div class="box-item box-merchandise">
        <h3 class="title">Sản phẩm dành cho bạn<a class="all-btn" href="#">Xem thêm <i class="fa fa-chevron-right"></i></a></h3>
        <div class="">
            @if(count($data_product) == 0)
                <p>Chưa có sản phẩm.</p>
            @else
            @foreach($data_product as $value)
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
                    <div class="cartss">
                    <a href="{{url('mua-hang',[$value->id, $value->product_name, $value->price_value])}}" class="addcart"><i class="fas fa-cart-plus"></i>Thêm vào giỏ</a>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
            <div class="clearfix"></div>
            <div class="row">
                <div class="phantrang">{{$data_product -> links()}}</div>
            </div>
        </div>
    </div>
    <p><br></p>
</div> 
@endsection
<style type="text/css">
    .item-merchandise{
        height: 250px;
    }
    .addcart{
        background-color: #90e1f1;
        margin-left: 15px;

    }
    .nam_product{

        height: 60px;
        text-align: center;
    }
    .price_product{
        text-align: center;
    }
</style>