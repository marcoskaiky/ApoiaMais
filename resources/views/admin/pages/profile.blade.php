@extends('admin.dashboard')

@section('content')
<div class="content-wrapper">
            <h1 class="page-title">Meu Perfil</h1>

            <!-- Informações Pessoais -->
            <div class="section">
                <h2 class="section-title">Informações Pessoais</h2>
                <form action="#" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Nome</label>
                            <input type="text" class="form-input" placeholder="Seu nome completo" value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-input" placeholder="seu.email@exemplo.com" value="{{ $user->email }}">
                        </div>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Telefone</label>
                            <input type="tel" class="form-input" placeholder="(00) 00000-0000" value="">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Endereço</label>
                            <input type="text" class="form-input" placeholder="Sua rua, número e bairro" value="">
                        </div>
                    </div>
                </form>
            </div>

            <!-- Preferências de Notificações -->
            <div class="section">
                <h2 class="section-title">Preferências de Notificações</h2>
                <div class="checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" checked>
                        <span>Receber notificações por email</span>
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox">
                        <span>Receber notificações por SMS</span>
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" checked>
                        <span>Receber notificações no aplicativo</span>
                    </label>
                </div>
            </div>

            <!-- Histórico de Atividades -->
            <div class="section">
                <h2 class="section-title">Histórico de Atividades</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>DATA</th>
                            <th>TIPO</th>
                            <th>DETALHES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>15/07/2024</td>
                            <td>Doação</td>
                            <td>R$ 50 para a campanha 'Alimentos para Todos'</td>
                        </tr>
                        <tr>
                            <td>20/06/2024</td>
                            <td>Campanha</td>
                            <td>Campanha 'Roupas de Inverno' criada</td>
                        </tr>
                        <tr>
                            <td>05/06/2024</td>
                            <td>Doação</td>
                            <td>R$ 100 para a campanha 'Crianças Felizes'</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <button type="submit" class="btn-primary">Salvar Alterações</button>
        </div>
@endsection
