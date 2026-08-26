<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | FCT Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #004D40 0%, #00352C 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-card { background: #fff; border-radius: 12px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); padding: 2.5rem; width: 100%; max-width: 420px; }
        .login-logo { text-align: center; margin-bottom: 1.5rem; }
        .login-logo img { height: 60px; }
        .login-logo h4 { color: #004D40; font-weight: 700; margin-top: 0.5rem; }
        .form-control { border-radius: 6px; padding: 0.65rem 1rem; border: 1px solid #dee2e6; }
        .form-control:focus { border-color: #004D40; box-shadow: 0 0 0 0.2rem rgba(0,77,64,0.15); }
        .btn-login { background: #004D40; color: #fff; padding: 0.65rem; border-radius: 6px; font-weight: 500; border: none; width: 100%; }
        .btn-login:hover { background: #00352C; color: #fff; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-logo">
            <img src="{{ asset('assets/images/fct-logo.png') }}" alt="FCT">
            <h4>Admin Login</h4>
            <p class="text-muted mb-0">Fair Competition Tribunal</p>
        </div>
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" required autofocus value="{{ old('email') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
            </div>
            <button type="submit" class="btn btn-login">Sign In</button>
        </form>
        <div class="text-center mt-3"><small class="text-muted">Default: admin@fct.go.tz / password</small></div>
    </div>
</body>
</html>