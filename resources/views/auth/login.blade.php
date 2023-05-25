<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>PreSkool - Login</title>

    <link rel="shortcut icon" href="assets/img/favicon.png">

    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/plugins/feather/feather.css">

    <link rel="stylesheet" href="assets/plugins/icons/flags/flags.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="col-md-4 float-right pt-3">
                    @if (Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message') }}
                        </p>
                    @endif
                    @if (Session::has('status'))
                        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('status') }}
                        </p>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
                <div class="loginbox">
                    <div class="login-left">
                        <img class="img-fluid" src="assets/img/login.png" alt="Logo">
                    </div>
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Welcome to PreSkool</h1>
                            <p class="account-subtitle">Need an account? <a href="{{ route('register') }}">Sign Up</a>
                            </p>
                            <h2>Sign in</h2>

                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Email <span class="login-danger">*</span></label>
                                    <input id="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror" type="text"
                                        value="{{ old('email') }}">
                                    <span class="error-msg"></span>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password <span class="login-danger">*</span></label>
                                    <input id="password" name="password"
                                        class="form-control pass-input @error('password') is-invalid @enderror"
                                        type="password">
                                    <span id="error-password"></span>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="forgotpass">
                                    <div class="remember-me">
                                        <label class="custom_check mr-2 mb-0 d-inline-flex remember-me"> Remember me
                                            <input type="checkbox" name="remember"
                                                {{ old('remember') ? 'checked' : '' }}>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" type="submit">Login</button>
                                </div>
                            </form>

                            <div class="login-or">
                                <span class="or-line"></span>
                                <span class="span-or">or</span>
                            </div>

                            <div class="social-login">
                                <a href="#"><i class="fab fa-google-plus-g"></i></a>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/feather.min.js"></script>

    <script src="assets/js/script.js"></script>
</body>

</html>
{{-- @push('scripts')
    <script defer>
        $(document).ready(function() {
            setRecaptchaToken();
            // Every 90 Seconds
            setInterval(function() {
                setRecaptchaToken();
            }, 90 * 1000);
        });

        function setRecaptchaToken() {
            grecaptcha.ready(function() {
                grecaptcha.execute('{{ config('captcha.sitekey') }}', {
                    action: 'login'
                }).then(function(token) {
                    // console.log(token);
                    if (token) {
                        document.getElementById('recaptcha').value = token;
                        $('input[type="submit"]').prop('disabled', false);
                    }
                });
            });
        }
    </script>
@endpush --}}
<script src="{{ asset('assets/js/form-validation.js') }}"></script>
