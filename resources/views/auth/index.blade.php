<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Akun</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{  asset('auth') }}/login/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body style="background-image: url('{{  asset('dashboard') }}/assets/img/cta-bg.jpg');">
    <main class="container pt-5 d-flex justify-content-center align-items-center">
        <div class="col-10 col-sm-8 col-md-5 col-lg-4 mx-auto text-center px-3 py-5 border rounded bg-white">
            @if (Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif
            @if (Session::has('success'))
                <div class="alert alert-success text-center">
                    {{ Session::get('success') }}
                </div>
        @endif
            <h1 class="card-tittle text-start">Login Akun</h1>
            <form role="form" method="post" action="{{ url('authent/check') }}">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control @error('user') is-invalid @enderror" name="user" placeholder="nama lengkap atau nomor telepon" />
                </div>
                <div class="mb-3">
                    <div class="input-group">
                        <input type="password" class="form-control @error('pass') is-invalid @enderror" name="pass" placeholder="password" id="password-input" />
                        <button type="button" class="btn btn-outline-secondary" id="show-password-button">
                            <i class="fas fa-eye"></i> <!-- Ikon mata -->
                        </button>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button name="login" class="btn btn-primary">Login</button>
                </div>
            </form>

            <p class="mt-1 mb-1 text-secondary">atau</p>
            <a href='{{ url('http://127.0.0.1:80/auth/redirect') }}' class="btn border border-primary "><img width="20px"
                    style="margin-bottom:3px;margin-right:5px" alt="Google sign-in"
                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
                Login dengan Google</a>
        </div>
    </main>
</body>
<script>
    const passwordInput = document.getElementById('password-input');
    const showPasswordButton = document.getElementById('show-password-button');

    showPasswordButton.addEventListener('click', () => {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    });
</script>
</html>
