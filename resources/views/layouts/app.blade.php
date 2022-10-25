<!doctype html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon.ico" type="image/ico" />
  
  
  <title>DHC</title>
  
  <!-- Bootstrap -->
  <link href="{{ asset('/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="{{ asset('/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <!-- NProgress -->
  <link href="{{ asset('/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
  <!-- iCheck -->
  <link href="{{ asset('/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
  
  <!-- bootstrap-progressbar -->
  <link href="{{ asset('/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
  <!-- JQVMap -->
  <link href="{{ asset('/vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
  <!-- bootstrap-daterangepicker -->
  <link href="{{ asset('/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">


<link href="{{ asset('/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}"  rel="stylesheet">
<link href="{{ asset('/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ asset('/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ asset('/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ asset('/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">

{{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet">  --}}
{{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}">  --}}

<link rel="stylesheet" href="{{ asset("css/tailwind.output.css")}}" />
<script src="{{ asset('js/app.js') }}" defer></script>
  <!-- Custom Theme Style -->
  <link href="{{ asset('/build/css/custom.min.css')}}" rel="stylesheet">
  <style>
    div.hover_green:hover  { background-color: rgb(46, 180, 34) !important; opacity: 20%; } 
    .center_icon {
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 50%;
    }

    .fad{
      -webkit-animation:bounce 1s infinite;
    }

    @-webkit-keyframes bounce {
      
      0%       { bottom:-12px; }
      50%, 75% { bottom:15px; }
      50%      { bottom:20px; }
      100%     {bottom:0;}
    }
</style>
  @stack('style')
  @livewireStyles
  
   
</head>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>DHC</span></a>
          </div>
          <div class="clearfix"></div>
          @livewire("side-bar")
        </div>
      </div>

            
         
            @livewire('header')
            <div class="right_col" role="main">
                <div class="row">
                   <div class="col-md-12 col-sm-12 ">
                    {{ $slot }} 
                   </div>

               </div>
            </div>
           
        </div>

           
      </div>
    

      @stack('modals')
   
  
    
  
 
     

      @livewireScripts
 
    <script src="{{ asset('/vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{ asset('/vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{ asset('/vendors/nprogress/nprogress.js')}}"></script>
    <!-- Chart.js -->
    {{-- <script src="{{ asset('/vendors/Chart.js/dist/Chart.min.js')}}"></script> --}}
    <!-- gauge.js -->
    <script src="{{ asset('/vendors/gauge.js/dist/gauge.min.js')}}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset('/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{ asset('/vendors/iCheck/icheck.min.js')}}"></script>
    <!-- Skycons -->
    <script src="{{ asset('/vendors/skycons/skycons.js')}}"></script>
    <!-- Flot -->
    {{-- <script src="{{ asset('/vendors/Flot/jquery.flot.js')}}"></script>
    <script src="{{ asset('/vendors/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{ asset('/vendors/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{ asset('/vendors/Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{ asset('/vendors/Flot/jquery.flot.resize.js')}}"></script> --}}
    <!-- Flot plugins -->
    {{-- <script src="{{ asset('/vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{ asset('/vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{ asset('/vendors/flot.curvedlines/curvedLines.js')}}"></script> --}}
    <!-- DateJS -->
    <script src="{{ asset('/vendors/DateJS/build/date.js')}}"></script>
    {{-- <!-- JQVMap -->
    <script src="{{ asset('/vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
    <script src="{{ asset('/vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script> --}}
    <script src="{{ asset('/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{ asset('/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>


    <script src="{{asset("/vendors/datatables.net/js/jquery.dataTables.min.js")}}"></script>
<script src="{{asset("/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js")}}"></script>
<script src="{{asset("/vendors/datatables.net-buttons/js/dataTables.buttons.min.js")}}"></script>
<script src="{{asset("/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js")}}"></script>
{{-- <script src="{{asset("/vendors/datatables.net-buttons/js/buttons.flash.min.js")}}"></script>
<script src="{{asset("/vendors/datatables.net-buttons/js/buttons.html5.min.js")}}"></script>
<script src="{{asset("/vendors/datatables.net-buttons/js/buttons.print.min.js")}}"></script> --}}
<script src="{{asset("/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js")}}"></script>
<script src="{{asset("/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js")}}"></script>
<script src="{{asset("/vendors/datatables.net-responsive/js/dataTables.responsive.min.js")}}"></script>
<script src="{{asset("/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js")}}"></script>
<script src="{{asset("/vendors/datatables.net-scroller/js/dataTables.scroller.min.js")}}"></script>
{{-- <script src="{{asset("/vendors/jszip/dist/jszip.min.js")}}"></script>
<script src="{{asset("/vendors/pdfmake/build/pdfmake.min.js")}}"></script>
<script src="{{asset("/vendors/pdfmake/build/vfs_fonts.js")}}"></script> --}}
<script>
    @stack('scripts')
</script>
    <!-- Custom Theme Scripts -->
    <script src="{{ asset('/build/js/custom.min.js')}}"></script>
  

  
    
  </body>
</html>
