
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>PUSKESMAS | @yield("title")</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

    @include("komponen.css.style_css")

    @yield("css")

</head>
<body>
    <div class="wrapper">

        @include("komponen.header.header")

        @include("komponen.sidebar.sidebar")

        <div class="main-panel">
            <div class="content">
                @yield("content")
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="copyright">
                        Copyright &copy; 2022. All Rights Reserved. {{ env("APP_NAME") }} , Project Created By
                        <strong>
                            <a href="https://www.themekita.com">
                                Team Maulana Ibrahim
                            </a>
                        </strong>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    @include("komponen.js.style_js")

    <script>
        $('.btn-delete').click(function(e) {
            let form =  $(this).closest("form");
            e.preventDefault();
            swal({
                title: "Maaf!",
                text: "Data anda akan dihapus!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                buttons: ['Batal', 'Hapus']
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        });
    </script>

    @if (session('message'))
    {!! session('message') !!}
    @endif

    @yield("js")

</body>
</html>
