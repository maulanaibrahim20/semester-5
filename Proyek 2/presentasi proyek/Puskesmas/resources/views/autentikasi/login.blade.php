<html>
<head>
    <title>
        {{ env("APP_NAME") }} | Login
    </title>
    <link href="{{ url('autentikasi/img/kesmas.png') }}" rel="icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link rel="stylesheet" href="{{ url('autentikasi/css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ url('autentikasi/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('autentikasi/css/bootstrap/style.css') }}">

</head>


<body>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="text-center">
                            <img src="{{ url('autentikasi/img/kesmas.png') }}" alt="50" width="100">
                        </div>
                        <h3 class="text-center mb-4">Silahkan login untuk masuk!</h3>
                        <form action="{{ url('/login') }}" class="login-form" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text"
                                class="form-control rounded-left {{ $errors->has('username') ? 'is-invalid' : '' }}"
                                placeholder="Username" name='username' id="username">
                                @if ($errors->has('username'))
                                <p class="text-danger">{{ $errors->first('username') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password"
                                class="form-control rounded-left {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                placeholder="Password" name='password' id="password">
                                @if ($errors->has('password'))
                                <p class="text-danger">{{ $errors->first('password') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary rounded submit px-3">Masuk</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ url('autentikasi/js/jquery.min.js') }}"></script>
    <script src="{{ url('autentikasi/js/popper.js') }}s"></script>
    <script src="{{ url('autentikasi/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('autentikasi/js/main1.js') }}"></script>

</body>

</html>
