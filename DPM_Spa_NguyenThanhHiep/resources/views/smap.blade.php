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
        <h5 class="title"><label style="font-size: 18px; margin-left: 10px;">Thông tin địa chỉ SPA</label></h5>
        <div class="">
            <div class="">
                <div class="col-xs-3">
                  Danh sách đại lý
                </div>
                <div class="col-xs-9">
                    <div id="map"></div>
                    <script>
                      function initMap() {
                        var mapDiv = document.getElementById('map');
                        var map = new google.maps.Map(mapDiv, {
                          center: {lat: 44.540, lng: -78.546},
                          zoom: 8
                        });
                      }
                    </script>
                    <script src="https://maps.googleapis.com/maps/api/js?callback=initMap" async defer></script>
                </div>
                <div class="clearfix"></div>
        </div>
        <hr>
               
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
      #map {
        width: 800px;
        height: 400px;
      }
</style>