@extends('admin.layout.index')

@section('content')

 <div class="card">
    <div style="float: right; font-size: 14px;">
        <i class="fas fa-list"></i><a href="{{route('xemdanhsach.doanhsoDL')}}">  Xem theo danh sách</a>
    </div>
    <section class="management-hierarchy">

        <div class="hv-container">
            
            <div class="hv-wrapper">
   				<?php echo $htmlCayHeThongHoaHong; ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
	$(function (){
	    $('[data-toggle="popover"]').popover({'html':true});
	});
</script>
@endsection