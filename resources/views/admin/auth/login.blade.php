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
            <div style="font-family: var(--font-heading); font-weight: 700;
                        font-size: 22px; color: var(--color-primary);">
                Mimbar Al-Tauhid
            </div>
            <div style="font-size: 13px; color: var(--color-gray-600); margin-top: 4px;">
                Panel Administrator
            </div>
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
                           placeholder="admin@mimbar.or.id"
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
                    <input type="password" name="password" required
                           placeholder="••••••••"
                           style="width: 100%; padding: 10px 14px;
                                  border: 1px solid var(--color-border);
                                  border-radius: var(--radius-lg); font-size: 14px;
                                  outline: none; font-family: var(--font-body);
                                  box-sizing: border-box;">
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

</body>
</html>
