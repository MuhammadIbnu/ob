<!DOCTYPE html>
<html>
<head>
  @include('layouts.partials.head')
  @yield('baseStyles')
</head>
<body class="hold-transition skin-blue sidebar-mini">
    @yield('b')
    @include('layouts.partials.script')



    @yield('baseScripts')
    <script type="text/javascript">
    $(document).ready( function () {
        $('.myTable').DataTable();
    } );
    </script>
</body>
</html>
