<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.includes.head')
    @section('css')

    @show
</head>

<body>

<div id="wrapper">
        <div id="app">

        </div>
    <!-- /#page-wrapper -->
    <script type="text/javascript">
        window.Laravel= <?php echo json_encode(['csrfToken' => csrf_token()]);?>
    </script>
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
</div>
<!-- /#wrapper -->

<!-- jQuery -->
@include('template.includes.foot')
@section('js')

@show
</body>

</html>
