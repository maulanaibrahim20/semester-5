<link rel="icon" href="{{ url('') }}/autentikasi/img/kesmas.png" type="image/x-icon"/>

<!-- Fonts and icons -->
<script src="{{ url('') }}/assets/js/plugin/webfont/webfont.min.js"></script>
<script>
    WebFont.load({
        google: {"families":["Lato:300,400,700,900"]},
        custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{ url('') }}/assets/css/fonts.min.css']},
        active: function() {
            sessionStorage.fonts = true;
        }
    });
</script>

<!-- CSS Files -->
<link rel="stylesheet" href="{{ url('') }}/assets/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ url('') }}/assets/css/atlantis.min.css">

<!-- CSS Just for demo purpose, don't include it in your project -->
<link rel="stylesheet" href="{{ url('') }}/assets/css/demo.css">
