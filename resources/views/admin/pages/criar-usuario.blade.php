@extends('admin.dashboard')

@section('content')
@vite('resources/css/usuarios.css')

<div class="content-wrapper usuarios-wrapper">
    <div class="usuarios-breadcrumb">
        <a href="{{ route('admin.users.index') }}" class="btn-back">
            <i class="fas fa-arrow-left me-2"></i>
            Voltar para Lista
        </a>
    </div>

    <div class="card usuarios-card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="fas fa-user-plus me-2"></i>
                Adicionar Novo Usuário
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST" class="usuarios-form">
                @csrf

                <div class="row">
                    <!-- Nome -->
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">
                            Nome Completo <span class="text-danger">*</span>
                        </label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Digite o nome completo"
                            required />
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">
                            E-mail <span class="text-danger">*</span>
                        </label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="Digite o e-mail"
                            required />
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Senha -->
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">
                            Senha <span class="text-danger">*</span>
                        </label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Digite a senha"
                            required />
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirmar Senha -->
                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation" class="form-label">
                            Confirmar Senha <span class="text-danger">*</span>
                        </label>
                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            class="form-control"
                            placeholder="Confirme a senha"
                            required />
                    </div>

                    <!-- Nível de Acesso -->
                    <div class="col-md-6 mb-3">
                        <label for="role" class="form-label">
                            Nível de Acesso <span class="text-danger">*</span>
                        </label>
                        <select
                            name="role"
                            id="role"
                            class="form-select @error('role') is-invalid @enderror"
                            required>
                            <option value="">Selecione...</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>
                                Administrador
                            </option>
                            <option value="gerente" {{ old('role') === 'gerente' ? 'selected' : '' }}>
                                Gerente
                            </option>
                            <option value="operador" {{ old('role') === 'operador' ? 'selected' : '' }}>
                                Operador
                            </option>
                        </select>
                        @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">
                            Status <span class="text-danger">*</span>
                        </label>
                        <select
                            name="status"
                            id="status"
                            class="form-select @error('status') is-invalid @enderror"
                            required>
                            <option value="1" {{ old('status', '1') === '1' ? 'selected' : '' }}>
                                Ativo
                            </option>
                            <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>
                                Inativo
                            </option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="usuarios-form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>
                        Salvar Usuário
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection