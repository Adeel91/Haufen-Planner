<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ getPageTitle() }} | {{ config('app.name', 'Haufen Planner') }}</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    </head>
    <body>
        @yield('app')

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
        <script>
            $(function() {
                $( '#dueDateDatepicker' ).datepicker({
                    dateFormat: 'yy-mm-dd',
                    minDate: new Date($( '#dueDateDatepicker' ).attr('mindate')),
                    maxDate: new Date($( '#dueDateDatepicker' ).attr('maxdate'))
                });

                $( '#startDateDatepicker' ).datepicker({
                    dateFormat: 'yy-mm-dd',
                    onSelect: function(dateStr)
                    {
                        $( '#endDateDatepicker' ).val(dateStr);
                        $( '#endDateDatepicker' ).datepicker("option", { minDate: new Date(dateStr)})
                    }
                });

                $( '#endDateDatepicker' ).datepicker({
                    dateFormat: 'yy-mm-dd',
                    onSelect: function(dateStr)
                    {
                        $( '#startDateDatepicker' ).datepicker("option", { maxDate: new Date(dateStr)})
                    }
                });
            });
        </script>
    </body>
</html>
