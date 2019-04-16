<!-- slider -->
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <div id="menudoc">
                <ul>
                    <li style="background-color: #bfedbf; color: black; font-weight: bold;">
                        <a href="">Danh mục</a>
                    </li>
                    @foreach($data_menu_catalogy as $value)
                    <li>
                        <a href="loaisanpham/{{$value->id}}">{{$value->catalogy_name}}</a>
                    </li>
                    @endforeach
                    
                    @foreach($data_menu_catalogyservice as $value)
                    <li>
                        <a href="loaisanpham/{{$value->id}}">{{$value->catalogyservice_name}}</a>
                    </li>
                    @endforeach
                    <li style="background-color: #bfedbf; color: black; font-weight: bold;">
                        <a href="{{url('package/goidaily')}}">Gói đại lý</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="rev-slider">
                <div class="fullwidthbanner-container">
                    <div class="fullwidthbanner">
                        <div class="bannercontainer" >
                        <div class="banner" style="height: 410px" >
                                <ul>
                                    <!-- THE FIRST SLIDE -->
                                    @foreach($data_slider as $value_slider)
                                    <li data-transition="boxfade" data-slotamount="20" class="active-revslide" style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
                                        <div class="slotholder" style="width:100%;height:100%;" data-duration="undefined" data-zoomstart="undefined" data-zoomend="undefined" data-rotationstart="undefined" data-rotationend="undefined" data-ease="undefined" data-bgpositionend="undefined" data-bgposition="undefined" data-kenburns="undefined" data-easeme="undefined" data-bgfit="undefined" data-bgfitend="undefined" data-owidth="undefined" data-oheight="undefined">
                                            <div class="tp-bgimg defaultimg" data-lazyload="undefined" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" data-lazydone="undefined" src="image/slider/{{$value_slider->file_name}}" data-src="image/slider/{{$value_slider->file_name}}" style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('image/slider/{{$value_slider->file_name}}'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;">
                                            </div>
                                        </div>
                                    @endforeach
                                </li>
                                </ul>
                            </div>
                        </div>

                        <div class="tp-bannertimer"></div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
<!--slider-->