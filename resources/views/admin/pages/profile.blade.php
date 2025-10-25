@extends('admin.dashboard')

@section('content')
<div class="content-wrapper">
    <h1 class="page-title">Meu Perfil</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Informações Pessoais -->
    <div class="section">
        <h2 class="section-title">Informações Pessoais</h2>
        <form action="{{ route('admin.profile.update', auth()->id()) }}" method="POST" autocomplete="off">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Nome</label>
                    <input type="text" name="name" class="form-input" placeholder="Seu nome completo"
                           value="{{ old('name', auth()->user()->name) }}" autocomplete="off" required>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-input" placeholder="seu.email@exemplo.com"
                           value="{{ old('email', auth()->user()->email) }}" autocomplete="off" required>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn-primary">Atualizar Perfil</button>
        </form>
    </div>

    <!-- Atualizar Senha -->
    <div class="section">
        <h2 class="section-title">Alterar Senha</h2>
        <form action="{{ route('admin.profile.password.update') }}" method="POST" autocomplete="off">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Senha Atual</label>
                    <input type="password" name="current_password" class="form-input"
                           placeholder="Digite sua senha atual" autocomplete="new-password" required>
                    @error('current_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Nova Senha</label>
                    <input type="password" name="password" class="form-input"
                           placeholder="Digite a nova senha" autocomplete="new-password" required>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Confirme a Nova Senha</label>
                    <input type="password" name="password_confirmation" class="form-input"
                           placeholder="Confirme a nova senha" autocomplete="new-password" required>
                </div>
            </div>

            <button type="submit" class="btn-primary">Alterar Senha</button>
        </form>
    </div>
</div>
@endsection
