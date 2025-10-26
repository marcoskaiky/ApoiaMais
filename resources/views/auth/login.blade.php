@vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/login.css'])

<div class="admin-wrapper">
    <!-- Left sidebar / branding -->
    <aside class="sidebar">
        <div class="logo">
            
                <div class="logo-icon">A+</div>
                <div class="logo-text">Apoia+</div>

        </div>

        <div class="sidebar-content">
            <h1>
                Gestão de estoque e campanhas de arrecadação de forma simples e eficiente.
            </h1>
        </div>

        <div class="sidebar-footer">
            <p>&copy; <small>2025</small> Apoia+. Todos os direitos reservados.</p>
        </div>
    </aside>

    <!-- Right main content with form -->
    <main class="main-content">
        <div class="content-wrapper">
            <div class="section">
                <div class="login-header">
                    <h2 class="login-title">Bem-vindo de volta</h2>
                    <p class="login-subtitle">Acesse sua conta para continuar.</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label class="form-label" for="email">E-mail</label>
                        <x-text-input id="email" class="form-input" type="email" name="email" placeholder="seuemail@exemplo.com" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="text-danger" />
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">Senha</label>
                        <x-text-input id="password" class="form-input" type="password" name="password" placeholder="Sua senha" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="text-danger" />
                    </div>

                    <div class="forgot-password-link">
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Esqueceu sua senha?</a>
                        @endif
                    </div>

                    <button type="submit" class="btn-primary">Entrar</button>

                </form>
            </div>
        </div>
    </main>
</div>