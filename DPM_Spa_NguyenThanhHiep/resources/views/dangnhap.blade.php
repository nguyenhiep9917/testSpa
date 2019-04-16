@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="content">
            
            <form action="{{url('dangnhap')}}" method="post" class="beta-form-checkout">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <h4 style="text-align: center; font-weight: bold;">Đăng nhập</h4>
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach( $errors -> all() as $er)
                                        <li>{{ $er }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session('thongbaoxacnhanemail'))
                            <div class="alert alert-success">
                                {{session('thongbaoxacnhanemail')}}
                            </div>
                        @endif
                        @if(session('thongbaoxacnhan'))
                            <div class="alert alert-danger">
                                {{session('thongbaoxacnhan')}}
                            </div>
                        @endif
                        @if(session('thongbaologin'))
                            <div class="alert alert-danger">
                                {{session('thongbaologin')}}
                            </div>
                        @endif
                        <br>
                        <div class="space20">&nbsp;</div>
                        <div class="form-block" style="text-align: center; font-size: 15px; margin-bottom: 25px;">
                            <label for="email" >Email</label>
                            <input type="text" id="email" name="email" class="form-control">
                        </div>
                        <div class="form-block" style="text-align: center; font-size: 15px; margin-bottom: 25px;">
                            <label for="password">Mật khẩu </label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>
                        <div style="text-align: center;">
                            <button type="submit" class="btn btn-primary">Đăng nhập</button>
                        </div>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </form>
        </div> <!-- #content -->
    </div> <!-- .container -->

@endsection




