@extends('admin.layout.index')

@section('content')

 <div class="card">
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