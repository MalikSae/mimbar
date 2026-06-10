<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — Mimbar Al-Tauhid</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="font-family: var(--font-body); background-color: var(--color-muted);
             min-height: 100vh; display: flex; align-items: center; justify-content: center;">

    <div style="width: 100%; max-width: 400px; padding: 16px;">

        {{-- Logo --}}
        <div style="text-align: center; margin-bottom: 32px;">
            <img src="{{ asset('storage/images/logo/LOGO-MIMBAR-LIGHT-MODE.webp') }}" 
                 alt="Logo Mimbar Al-Tauhid" 
                 style="height: 80px; width: auto; object-fit: contain; margin: 0 auto;">
        </div>

        {{-- Card --}}
        <div style="background: white; border-radius: var(--radius-xl);
                    border: 1px solid var(--color-border);
                    box-shadow: var(--shadow-card); padding: 32px;">

            <h1 style="font-family: var(--font-heading); font-size: 20px;
                       font-weight: 700; color: var(--color-gray-900);
                       margin-bottom: 24px;">Masuk ke Admin Panel</h1>

            {{-- Error --}}
            @if (session('error'))
                <div style="background: var(--color-danger-surface);
                            color: var(--color-danger); border-radius: var(--radius-lg);
                            padding: 10px 14px; font-size: 13px; margin-bottom: 16px;">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf

                {{-- Email --}}
                <div style="margin-bottom: 16px;">
                    <label style="display: block; font-size: 13px; font-weight: 500;
                                  color: var(--color-gray-900); margin-bottom: 6px;">
                        Email
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           required autofocus
                           placeholder="email@domain.com"
                           style="width: 100%; padding: 10px 14px;
                                  border: 1px solid {{ $errors->has('email') ? 'var(--color-danger)' : 'var(--color-border)' }};
                                  border-radius: var(--radius-lg); font-size: 14px;
                                  outline: none; font-family: var(--font-body);
                                  box-sizing: border-box;">
                    @error('email')
                        <div style="color: var(--color-danger); font-size: 12px; margin-top: 4px;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Password --}}
                <div style="margin-bottom: 24px;">
                    <label style="display: block; font-size: 13px; font-weight: 500;
                                  color: var(--color-gray-900); margin-bottom: 6px;">
                        Password
                    </label>
                    <div style="position: relative;">
                        <input type="password" name="password" id="password" required
                               placeholder="••••••••"
                               style="width: 100%; padding: 10px 40px 10px 14px;
                                      border: 1px solid var(--color-border);
                                      border-radius: var(--radius-lg); font-size: 14px;
                                      outline: none; font-family: var(--font-body);
                                      box-sizing: border-box;">
                        <button type="button" onclick="togglePassword()"
                                style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
                                       background: none; border: none; padding: 0; cursor: pointer;
                                       color: var(--color-gray-500); display: flex; align-items: center;">
                            <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            <svg id="eye-off-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: none;">
                                <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                                <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path>
                                <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path>
                                <line x1="2" y1="2" x2="22" y2="22"></line>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Remember me --}}
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 24px;">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember" style="font-size: 13px; color: var(--color-gray-600);">
                        Ingat saya
                    </label>
                </div>

                {{-- Submit --}}
                <button type="submit"
                        style="width: 100%; padding: 11px;
                               background: var(--color-primary); color: white;
                               border: none; border-radius: var(--radius-lg);
                               font-size: 14px; font-weight: 600;
                               font-family: var(--font-heading); cursor: pointer;">
                    Masuk
                </button>
            </form>
        </div>

        <div style="text-align: center; margin-top: 16px;
                    font-size: 12px; color: var(--color-gray-400);">
            © {{ date('Y') }} Yayasan Mimbar Al-Tauhid
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            const eyeOffIcon = document.getElementById('eye-off-icon');
            
            if (input.type === 'password') {
                input.type = 'text';
                eyeIcon.style.display = 'none';
                eyeOffIcon.style.display = 'block';
            } else {
                input.type = 'password';
                eyeIcon.style.display = 'block';
                eyeOffIcon.style.display = 'none';
            }
        }
    </script>
</body>
</html>
