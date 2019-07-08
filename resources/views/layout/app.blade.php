<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Skill Test</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top bg-primary">
        <div class="container">
            <div class="navbar-header">
                <!-- Branding Image -->
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    Skill Test
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Custom Links -->
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
</div>

<!-- Scripts -->
<script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-XSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });

    $(document).ready(function(){

        loadData();

        $("#save-product").click(function(){
            $.ajax({
                'type': 'POST',
                'data': $("#frm-product").serialize(),
                'url': $("#frm-product").attr('action'),
                success : function() {
                    $("#frm-product").find("input[type=text]").val("");
                    loadData();
                },
                error : function(xhr, status, error) {
                    alert( $.parseJSON(xhr.responseText).message );
                }
            });
            return false;
        })
    });

    function loadData() {
        $.ajax({
            'type': 'GET',
            'url': '/products/load-data',
            success : function(data) {
                $("#data-submitted").html(data);
            },
            error : function() {
                alert( 'Could not load data' );
            }
        })
    }
</script>
</body>
</html>
