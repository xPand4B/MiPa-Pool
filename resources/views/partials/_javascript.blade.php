{{-- Core JS Files --}}
{{ Html::script('js/jquery-3.3.1.min.js') }}
{{ Html::script('js/bootstrap/popper.min.js') }}
{{ Html::script('js/material_dashboard/bootstrap-material-design.min.js') }}
{{ Html::script('js/material_dashboard/perfect-scrollbar.jquery.min.js') }}

{{-- Chartist Plugin --}}
{{ Html::script('js/plugins/chartist.min.js') }}

{{-- Notification Plugin --}}
{{ Html::script('js/plugins/bootstrap-notify.js') }}

{{-- Core Center for Material Dashboard: parallax effects, scripts for the example pages etc. --}}
{{ Html::script('js/material_dashboard/material-dashboard.min.js?v=2.1.0') }}

{{-- Font-Awesome --}}
{{ Html::script('js/plugins/fontawesome-all.min.js') }}

{{-- Parsley-Validation --}}
{{ Html::script('js/plugins/parsley.min.js') }}

@yield('javascript')