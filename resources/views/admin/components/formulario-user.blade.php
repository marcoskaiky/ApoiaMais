<div class="row">
    <!-- Nome -->
    <div class="col-md-6 mb-3">
        <label for="name" class="form-label inline-flex">
            Nome Completo <span class="text-danger px-2">*</span>
        </label>
        <input
            type="text"
            name="name"
            id="name"
            value="{{ old('name', $user->name) }}"
            class="form-control @error('name') is-invalid @enderror"
            placeholder="Digite o nome completo"
            required />
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Email -->
    <div class="col-md-6 mb-3">
        <label for="email" class="form-label inline-flex">
            E-mail <span class="text-danger px-2">*</span>
        </label>
        <input
            type="email"
            name="email"
            id="email"
            value="{{ old('email', $user->email) }}"
            class="form-control @error('email') is-invalid @enderror"
            placeholder="Digite o e-mail"
            autocomplete="off"
            required />
        @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Senha (opcional) -->
    <div class="col-md-6 mb-3">
        <label for="password" class="form-label">
            Nova Senha
            <span class="text-muted small">(deixe em branco para manter a atual)</span>
        </label>
        <input
            type="password"
            name="password"
            id="password"
            class="form-control @error('password') is-invalid @enderror"
            placeholder="Digite a nova senha"
            autocomplete="off" />
        @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Confirmar Senha -->
    <div class="col-md-6 mb-3">
        <label for="password_confirmation" class="form-label">
            Confirmar Nova Senha
        </label>
        <input
            type="password"
            name="password_confirmation"
            id="password_confirmation"
            class="form-control"
            placeholder="Confirme a nova senha" />
    </div>

    <!-- Nível de Acesso -->
    <div class="col-md-6 mb-3">
        <label for="role" class="form-label inline-flex">
            Nível de Acesso <span class="text-danger px-2">*</span>
        </label>
        <select
            name="role"
            id="role"
            class="form-select @error('role') is-invalid @enderror"
            required>
            <option value="">Selecione...</option>
            <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>
                Administrador
            </option>
            <option value="gerente" {{ old('role', $user->role) === 'gerente' ? 'selected' : '' }}>
                Gerente
            </option>
            <option value="operador" {{ old('role', $user->role) === 'operador' ? 'selected' : '' }}>
                Operador
            </option>
        </select>
        @error('role')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Status -->
    <div class="col-md-6 mb-3">
        <label for="status" class="form-label inline-flex">
            Status <span class="text-danger px-2">*</span>
        </label>
        <select
            name="status"
            id="status"
            class="form-select @error('status') is-invalid @enderror"
            required>
            <option value="1" {{ old('status', $user->status ?? 1) == 1 ? 'selected' : '' }}>
                Ativo
            </option>
            <option value="0" {{ old('status', $user->status ?? 1) == 0 ? 'selected' : '' }}>
                Inativo
            </option>
        </select>
        @error('status')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>