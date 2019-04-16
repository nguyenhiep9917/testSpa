@extends('layouts.app')
@section('content')
<div class="container">
    <hr>
    <div class="box-item box-merchandise">
        <h5 class="title"><label style="font-size: 18px; margin-left: 10px;">TIN TỨC</label></h5>
        @foreach($data as $value)
        <div class="">
            <div class="col-xs-3">
               <label>Chủ đề:</label> {{$value->cmssubject_name}}
            </div>
            <div class="col-xs-3">
                <label>Tiêu đề:</label> {{$value->cmsnews_title}} <br>
                <label>Mô tả ngắn:</label> {{$value->cmsnews_shortcontent}}
            </div>
            <div class="col-xs-6">
                <label>Nội dung:</label>
                {{$value->cmsnews_fullcontent}}
            </div>
            <div class="clearfix"></div>
        </div>
        <hr>
        @endforeach
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