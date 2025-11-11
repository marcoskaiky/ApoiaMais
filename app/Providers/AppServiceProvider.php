<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Gates para controle de acesso baseado em roles

        // Admin tem acesso total
        Gate::define('admin-access', function (User $user) {
            return $user->isAdmin();
        });

        // Gerente tem acesso a gestão (Admin + Gerente)
        Gate::define('gerente-access', function (User $user) {
            return $user->hasAnyRole(['admin', 'gerente']);
        });

        // Operador tem acesso básico (todos os níveis)
        Gate::define('operador-access', function (User $user) {
            return $user->hasAnyRole(['admin', 'gerente', 'operador']);
        });

        // Permissões específicas por funcionalidade

        // Gestão de Usuários (apenas Admin)
        Gate::define('manage-users', function (User $user) {
            return $user->isAdmin();
        });

        // Gestão de Doadores e Instituições (Admin e Gerente)
        Gate::define('manage-doadores', function (User $user) {
            return $user->hasAnyRole(['admin', 'gerente', 'operador']);
        });

        // Gestão de Itens (Admin e Gerente)
        Gate::define('manage-items', function (User $user) {
            return $user->hasAnyRole(['admin', 'gerente', 'operador']);
        });

        // Gestão de Categorias e Campanhas (Admin e Gerente)
        Gate::define('manage-categories', function (User $user) {
            return $user->hasAnyRole(['admin', 'gerente', 'operador']);
        });

        // Receber Doações (todos podem)
        Gate::define('receive-donations', function (User $user) {
            return $user->hasAnyRole(['admin', 'gerente', 'operador']);
        });

        // Enviar Doações (Admin e Gerente)
        Gate::define('send-donations', function (User $user) {
            return $user->hasAnyRole(['admin', 'gerente']);
        });

        // Visualizar Estoque (todos podem)
        Gate::define('view-stock', function (User $user) {
            return $user->hasAnyRole(['admin', 'gerente', 'operador']);
        });

        // Gerar Relatórios (Admin e Gerente)
        Gate::define('view-reports', function (User $user) {
            return $user->hasAnyRole(['admin', 'gerente']);
        });

        // Auditoria (apenas Admin)
        Gate::define('view-audit', function (User $user) {
            return $user->isAdmin();
        });
    }
}
