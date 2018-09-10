@if (Session::has('success'))
    <script>
         $.notify({
            title:      '<strong>Erfolgreich:</strong>',
            message:    '{{ Session::get("success") }}'
        },{
            type:           'success',
            allow_dismiss:  true,
            animate: {
                enter:  'animated fadeInDown',
                exit:   'animated fadeOutUp'
            },
            placement: {
                from:   'top',
                align:  'center'
            }
        });
    </script>
@endif

@if (count($errors) > 0)
    <script>
        $.notify({
            title:      '<strong>Fehler:</strong>',
            message:    '@foreach ($errors->all() as $error) <li>{{$error}}</li> @endforeach'
        },{
            type:           'danger',
            allow_dismiss:  true,
            animate: {
                enter:  'animated fadeInDown',
                exit:   'animated fadeOutUp'
            },
            placement: {
                from:   'top',
                align:  'center'
            }
        });
    </script>
@endif