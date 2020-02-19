{{-- http://bootstrap-notify.remabledesigns.com/ --}}

@if (Session::has('success') || $message = Session::get('success'))
    <script>
        $.notify({
            title:      '{{ trans("session.title.success") }}',
            message:    '{{ Session::get("success") }}',
        },{
            type:            'success',
            delay:           2000,
            offset:          20,
            spacing:         10,
            allow_dismiss:   true,
            showProgressbar: false,
            animate: {
                enter:  'animated fadeInDown',
                exit:   'animated fadeOutUp'
            },
            placement: {
                from:   'top',
                align:  'right'
            },
            template: '<div data-notify="container" class="col-sm-3 alert alert-{0}" role="alert">' +
                        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +

                        '<span data-notify="title">' +
                            '<i class="fa fa-check-circle" style="color: #fff"></i> <strong>{1}</strong>' +
                        '</span>' +

                        '<span data-notify="message">' +
                            '<p>{2}</p>' +
                        '</span>' +

                    '</div>'
        });
    </script>
@endif

@if(Session::has('info') || $message = Session::get('info'))
    <script>
        $.notify({
            title:      '{{ trans("session.title.info") }}',
            message:    '{{ Session::get("info") }}',
        },{
            type:            'info',
            delay:           5000,
            allow_dismiss:   true,
            showProgressbar: true,
            animate: {
                enter:  'animated fadeInDown',
                exit:   'animated fadeOutUp'
            },
            placement: {
                from:   'top',
                align:  'right'
            },
            template:   '<div data-notify="container" class="col-sm-3 alert alert-{0}" role="alert">' +
                            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +

                            '<span data-notify="title">' +
                                '{!! config("icons.info") !!} <strong>{1}</strong>' +
                            '</span>' +

                            '<span data-notify="message">' +
                                '<p>{2}</p>' +
                            '</span>' +

                            '<div class="progress" data-notify="progressbar" style="height: 5px;">' +
                                '<div class="progress-bar bg-primary progress-bar-striped progress-bar-animated progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                            '</div>' +
                            '<a href="{3}" target="{4}" data-notify="url"></a>' +
                        '</div>'
        });
    </script>
@endif

@if(Session::has('error') || $message = Session::get('error'))
   <script>
       $.notify({
           title:      '{{ trans("session.title.error") }}',
           message:    '{{ Session::get("error") }}',
      },{
            type:            'danger',
            delay:           8000,
            allow_dismiss:   true,
            showProgressbar: true,
            animate: {
                enter:  'animated fadeInDown',
                exit:   'animated fadeOutUp'
            },
            placement: {
                from:   'top',
                align:  'right'
            },
            template: '<div data-notify="container" class="col-sm-3 alert alert-{0}" role="alert">' +
                        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +

                        '<span data-notify="title">' +
                            '{!! config("icons.error") !!} <strong>{1}</strong>' +
                        '</span>' +

                        '<span data-notify="message">' +
                            '<p>{2}</p>' +
                        '</span>' +

                        '<div class="progress" data-notify="progressbar" style="height: 5px;">' +
                            '<div class="progress-bar bg-primary progress-bar-striped progress-bar-animated progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                        '</div>' +
                        '<a href="{3}" target="{4}" data-notify="url"></a>' +
                    '</div>'
      });
  </script>
@endif

{{-- Validation errors --}}
@if (count($errors) > 0)
    <script>
        $.notify({
            title:      '{{ trans("session.title.error") }}',
            message:    '@foreach ($errors->all() as $error) <li>{{$error}}</li> @endforeach'
        },{
            type:            'danger',
            delay:           5000,
            allow_dismiss:   true,
            showProgressbar: true,
            animate: {
                enter:  'animated fadeInDown',
                exit:   'animated fadeOutUp'
            },
            placement: {
                from:   'top',
                align:  'right'
            },
            template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +

                        '<span data-notify="title">' +
                            '{!! config("icons.error") !!} </strong>{1}</strong>' +
                        '</span> ' +

                        '<span data-notify="message">' +
                            '<p>{2}</p>' +
                        '</span>' +

                        '<div class="progress mt-2" data-notify="progressbar" style="height: 5px;">' +
                            '<div class="progress-bar bg-primary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                        '</div>' +
                        '<a href="{3}" target="{4}" data-notify="url"></a>' +
                    '</div>'
        });
    </script>
@endif
