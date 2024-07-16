<!doctype html>
<html dir="{{ app()->getLocale() == "en" ? "ltr":"rtl" }}"  lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('images/alraqiah_logo.jpeg') }}" type="image/jpeg">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @if(app()->isLocale('ar'))
    <link href="{{ asset('css/rtl.css') }}" rel="stylesheet">
    @endif
    <link href="{{ asset('css/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Almarai&display=swap" rel="stylesheet"> -->

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
</head>
<body>
    <div id="app">

        <main class="py-4">
            @include('layouts.sidebar')
            <div class="container-fluid">
                <div class="row ">
                    @include('layouts.header')

                    @yield('content')
                </div>
            </div>

        </main>

        <div class="load_content form-group text-center">
            <img class="load_image" src="{{asset('images/load_image.jpg')}}">
        </div>

        <div class="confirm_content form-group text-center">
            <div class="confirm_alert panel panel-primary">
                <div class="panel-body">
                    <h3>{{ __('lang.are_you_sure') }}</h3>
                    <button id="btn_no" class="btn btn-primary">{{ __('lang.no') }}</button>
                    <button id="btn_yes" class="btn btn-danger" data-href="">{{ __('lang.yes') }}</button>
                </div>
              </div>
        </div>
        {{-- start show photo section --}}
        <div id="show_photo" class="text-center col-xs-12">

        </div>
        {{-- end update section --}}

        <div style="display: none" class="alert_message alert alert-success" role="alert">

        </div>
        <div class=" displayView">
            <div class="displayViewContent">

            </div>
            <button class="close btn btn-danger">X</button>
        </div>
    </div>
        <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
        <script src="{{asset('js/jquery.nicescroll.min.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
        @yield('script')
        <script src="{{asset('js/js.js')}}"></script>
        @if(app()->isLocale('ar'))
        <script src="{{asset('js/rtl.js')}}"></script>
        @endif
        <script>
            $(document).ready(function(){
                $("body").on("click", "button[name='delete']",function(e){
                    e.preventDefault();
                    $('#btn_yes').data('delete_type', 'single');
                    $('#btn_yes').data('href', $(this).parent('form').attr('action'));
                    $('.confirm_content').show();

                });
                $("body").on("click", "a[name='delete_multiple']",function(e){
                    e.preventDefault();
                    $('#btn_yes').data('delete_type', 'multiple');
                    $('#btn_yes').data('href', $(this).attr('href'));
                    $('.confirm_content').show();

                });
                if('{{ session("message") }}')
                {
                    $(".alert_message").html('{{ session("message") }}');
                    $(".alert_message").fadeIn().delay(2000).fadeOut();
                }
                $('body').on('click', '#btn_no', function(e){
                    $('.confirm_content').hide();
                });
                $('body').on('click', '#btn_yes', function(e){
                    var delete_type = $(this).data('delete_type');
                    if(delete_type == 'single')
                    {
                        var url = $(this).data('href');
                        $('.confirm_content').hide();
                        $.ajax({
                            url:url,
                            method:"post",
                            data: {"_method":"delete", "_token": '{{ csrf_token() }}'},
                            beforeSend:function(){
                                $(".load_content").show();
                            },
                            success:function(responsetext){
                                $(".load_content").hide();
                                $(".alert_message").text('{{ __("lang.success_operation") }}');
                                $(".alert_message").fadeIn().delay(2000).fadeOut();
                                $('.table-data').DataTable().ajax.reload(null, false);
                            },
                            error: function(data_error, exception){
                                $(".load_content").hide();
                                if(exception == "error"){
                                    $(".alert_message").text(data_error.responseJSON.message);
                                    $(".alert_message").fadeIn().delay(2000).fadeOut();
                                }
                            }

                        });
                    }else{
                        var url = $(this).data('href');
                        $('.confirm_content').hide();
                        // start get clients ids
                        var selected_ids = [];
                        $('input[name="clients[]"]').each(function(i){
                            if ($(this).is(':checked')) {
                                // Perform action when checkbox is checked
                                selected_ids.push($(this).val())

                            }
                        });
                        // // end get clients ids
                        $.ajax({
                            url:url,
                            method:"post",
                            data: {"_method":"delete", "ids":selected_ids, "_token": '{{ csrf_token() }}'},
                            beforeSend:function(){
                                $(".load_content").show();
                            },
                            success:function(responsetext){
                                $(".load_content").hide();
                                $(".alert_message").text('{{ __("lang.success_operation") }}');
                                $(".alert_message").fadeIn().delay(2000).fadeOut();
                                $('.table-data').DataTable().ajax.reload(null, false);
                            },
                            error: function(data_error, exception){
                                $(".load_content").hide();
                                if(exception == "error"){
                                    $(".alert_message").text(data_error.responseJSON.message);
                                    $(".alert_message").fadeIn().delay(2000).fadeOut();
                                }
                            }

                        });
                    }


                });
                // start the is_active button

                $("body").on("click", "#is_active",function(e){
                    var url = $(this).data("href");
                    $.ajax({
                        url:url,
                        method:"post",
                        data:{"_token": "{{ csrf_token() }}"},
                        success:function(responsetext){
                            $('.table-data').DataTable().ajax.reload(null, false);
                        },
                        error: function(data_error, exception){
                            if(exception == "error"){
                                $(".alert_message").text(data_error.responseJSON.message);
                                $(".alert_message").fadeIn().delay(2000).fadeOut();
                            }
                        }
                    });
                });

                // end the is_active button

            });
        </script>
        {{-- @yield('script') --}}
        <script>
            $(document).ready(function () {
                var selected_ids = [];

                $(".checkAll").click(function(){
                    $('.datatable-checkboxes').not(this).prop('checked', this.checked);
                    $('input[name="clients[]"]').each(function(i){
                        if ($(this).is(':checked')) {
                            // Perform action when checkbox is checked
                            selected_ids.push($(this).val())

                        } else {
                            // Perform action when checkbox is unchecked
                            selected_ids.pop($(this).val())
                            console.log('Checkbox is unchecked.');
                        }
                    });
                });

            });
        </script>

        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
        <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
        <script>
                //  // Enable pusher logging - don't include this in production
                Pusher.logToConsole = true;

                // var pusher = new Pusher('274a7b774e7ee17cfcf3', {
                //     cluster: 'eu'
                // });

                var pusher = new Pusher('274a7b774e7ee17cfcf3', {
                    cluster: 'eu',
                    authEndpoint: '/broadcasting/auth',
                    auth: {
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        }
                    }
                });
                var myChannel = pusher.subscribe('CompaintCountChannel');
                myChannel.bind('my-event', function(data) {
                    $('#complaint_count').html(data.count);
                });
        </script>
    </body>

</html>
