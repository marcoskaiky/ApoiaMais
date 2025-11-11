<!DOCTYPE html>

<html class="light" lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Roadmap do Sistema - Apoia+</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#3A86FF",
                        "background-light": "#F8F9FA",
                        "background-dark": "#101922",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.5rem",
                        "lg": "0.75rem",
                        "xl": "1rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            font-size: 24px;
        }
    </style>
    @vite(['resources/css/home.css'])
</head>

<body class="font-display bg-background-light dark:bg-background-dark">
    <div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">
        <div class="layout-container flex h-full grow flex-col">
            <!-- TopNavBar Section -->
            @include('components/land-page.header-welcome')

            <main class="flex flex-1 justify-center py-8 sm:py-12 px-4 sm:px-6">
                <div class="layout-content-container flex flex-col w-full max-w-5xl flex-1 gap-8">
                    <!-- PageHeading Section -->
                    <div class="flex flex-wrap justify-between gap-4 p-4 text-center sm:text-left">
                        <div class="flex w-full flex-col gap-2">
                            <p class="text-slate-900 dark:text-white text-4xl sm:text-5xl font-black tracking-tighter">Roadmap do Apoia+</p>
                            <p class="text-slate-500 dark:text-slate-400 text-base font-normal leading-normal max-w-2xl mx-auto sm:mx-0">Acompanhe a transparência do nosso processo de desenvolvimento e as futuras novidades do sistema.</p>
                        </div>
                    </div>
                    <!-- Timeline Section -->
                    <div class="flex flex-col gap-10 p-4">
                        <!-- Stage: Concluído -->
                        <div class="flex flex-col md:flex-row gap-4 md:gap-8">
                            <div class="flex-shrink-0 md:w-48">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-green-500">task_alt</span>
                                    <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Já Concluído</h3>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 flex-1">
                                <div class="bg-white dark:bg-slate-800/50 p-5 rounded-lg border border-slate-200 dark:border-slate-800">
                                    <div class="flex items-center gap-3 mb-2">
                                        <span class="material-symbols-outlined text-primary text-xl">inventory_2</span>
                                        <h4 class="font-bold text-slate-900 dark:text-white">Controle de Estoque Básico</h4>
                                    </div>
                                    <p class="text-sm text-slate-500 dark:text-slate-400 mb-3">Gestão de entradas e saídas de itens doados.</p>
                                    <div class="inline-flex h-6 items-center justify-center gap-x-2 rounded-md bg-green-100 dark:bg-green-500/20 px-2.5">
                                        <p class="text-xs font-medium text-green-700 dark:text-green-300">Lançado</p>
                                    </div>
                                </div>
                                <div class="bg-white dark:bg-slate-800/50 p-5 rounded-lg border border-slate-200 dark:border-slate-800">
                                    <div class="flex items-center gap-3 mb-2">
                                        <span class="material-symbols-outlined text-primary text-xl">group</span>
                                        <h4 class="font-bold text-slate-900 dark:text-white">Cadastro de Doadores</h4>
                                    </div>
                                    <p class="text-sm text-slate-500 dark:text-slate-400 mb-3">Manutenção de uma base de dados de doadores.</p>
                                    <div class="inline-flex h-6 items-center justify-center gap-x-2 rounded-md bg-green-100 dark:bg-green-500/20 px-2.5">
                                        <p class="text-xs font-medium text-green-700 dark:text-green-300">Lançado</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Divider -->
                        <div class="border-t border-dashed border-slate-300 dark:border-slate-700"></div>
                        <!-- Stage: Em Desenvolvimento -->
                        <div class="flex flex-col md:flex-row gap-4 md:gap-8">
                            <div class="flex-shrink-0 md:w-48">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-yellow-500">pending</span>
                                    <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Em Desenvolvimento</h3>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 flex-1">
                                <div class="bg-white dark:bg-slate-800/50 p-5 rounded-lg border border-slate-200 dark:border-slate-800">
                                    <div class="flex items-center gap-3 mb-2">
                                        <span class="material-symbols-outlined text-primary text-xl">bar_chart</span>
                                        <h4 class="font-bold text-slate-900 dark:text-white">Relatórios Avançados</h4>
                                    </div>
                                    <p class="text-sm text-slate-500 dark:text-slate-400 mb-3">Geração de relatórios customizáveis sobre doações e estoque.</p>
                                    <div class="inline-flex h-6 items-center justify-center gap-x-2 rounded-md bg-yellow-100 dark:bg-yellow-500/20 px-2.5">
                                        <p class="text-xs font-medium text-yellow-700 dark:text-yellow-300">Em Testes</p>
                                    </div>
                                </div>
                                <div class="bg-white dark:bg-slate-800/50 p-5 rounded-lg border border-slate-200 dark:border-slate-800">
                                    <div class="flex items-center gap-3 mb-2">
                                        <span class="material-symbols-outlined text-primary text-xl">forward_to_inbox</span>
                                        <h4 class="font-bold text-slate-900 dark:text-white">Integração com E-mail</h4>
                                    </div>
                                    <p class="text-sm text-slate-500 dark:text-slate-400 mb-3">Envio de confirmações e agradecimentos automáticos.</p>
                                    <div class="inline-flex h-6 items-center justify-center gap-x-2 rounded-md bg-yellow-100 dark:bg-yellow-500/20 px-2.5">
                                        <p class="text-xs font-medium text-yellow-700 dark:text-yellow-300">Em Testes</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Divider -->
                        <div class="border-t border-dashed border-slate-300 dark:border-slate-700"></div>
                        <!-- Stage: Planejado -->
                        <div class="flex flex-col md:flex-row gap-4 md:gap-8">
                            <div class="flex-shrink-0 md:w-48">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-blue-500">event_upcoming</span>
                                    <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Planejado</h3>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 flex-1">
                                <div class="bg-white dark:bg-slate-800/50 p-5 rounded-lg border border-slate-200 dark:border-slate-800">
                                    <div class="flex items-center gap-3 mb-2">
                                        <span class="material-symbols-outlined text-primary text-xl">phone_android</span>
                                        <h4 class="font-bold text-slate-900 dark:text-white">Aplicativo Mobile</h4>
                                    </div>
                                    <p class="text-sm text-slate-500 dark:text-slate-400 mb-3">Versão para iOS e Android para gestão em qualquer lugar.</p>
                                    <div class="inline-flex h-6 items-center justify-center gap-x-2 rounded-md bg-blue-100 dark:bg-blue-500/20 px-2.5">
                                        <p class="text-xs font-medium text-blue-700 dark:text-blue-300">Em Análise</p>
                                    </div>
                                </div>
                                <div class="bg-white dark:bg-slate-800/50 p-5 rounded-lg border border-slate-200 dark:border-slate-800">
                                    <div class="flex items-center gap-3 mb-2">
                                        <span class="material-symbols-outlined text-primary text-xl">volunteer_activism</span>
                                        <h4 class="font-bold text-slate-900 dark:text-white">Módulo de Voluntários</h4>
                                    </div>
                                    <p class="text-sm text-slate-500 dark:text-slate-400 mb-3">Cadastro e gestão de voluntários e suas atividades.</p>
                                    <div class="inline-flex h-6 items-center justify-center gap-x-2 rounded-md bg-blue-100 dark:bg-blue-500/20 px-2.5">
                                        <p class="text-xs font-medium text-blue-700 dark:text-blue-300">Em Análise</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Divider -->
                        <div class="border-t border-dashed border-slate-300 dark:border-slate-700"></div>
                        <!-- Stage: Ideias Futuras -->
                        <div class="flex flex-col md:flex-row gap-4 md:gap-8">
                            <div class="flex-shrink-0 md:w-48">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-purple-500">emoji_objects</span>
                                    <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Ideias Futuras</h3>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 flex-1">
                                <div class="bg-white dark:bg-slate-800/50 p-5 rounded-lg border border-slate-200 dark:border-slate-800">
                                    <div class="flex items-center gap-3 mb-2">
                                        <span class="material-symbols-outlined text-primary text-xl">campaign</span>
                                        <h4 class="font-bold text-slate-900 dark:text-white">Módulo de Campanhas</h4>
                                    </div>
                                    <p class="text-sm text-slate-500 dark:text-slate-400 mb-3">Criação e acompanhamento de campanhas de arrecadação.</p>
                                    <div class="inline-flex h-6 items-center justify-center gap-x-2 rounded-md bg-purple-100 dark:bg-purple-500/20 px-2.5">
                                        <p class="text-xs font-medium text-purple-700 dark:text-purple-300">Backlog</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ActionPanel Section -->
                    <div class="p-4 @container">
                        <div class="flex flex-1 flex-col items-start justify-between gap-4 rounded-lg border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900/50 p-6 @[480px]:flex-row @[480px]:items-center">
                            <div class="flex flex-col gap-1">
                                <p class="text-slate-900 dark:text-white text-base font-bold leading-tight">Tem uma sugestão?</p>
                                <p class="text-slate-500 dark:text-slate-400 text-base font-normal leading-normal">Incentive o engajamento do usuário e nos ajude a melhorar.</p>
                            </div>
                            <button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-5 bg-primary text-white text-sm font-medium leading-normal hover:bg-primary/90 transition-colors">
                                <span class="truncate">Envie para nós!</span>
                            </button>
                        </div>
                    </div>
                </div>
            </main>
            <!-- Footer -->
            @include('components.land-page.footer-welcome')
        </div>
    </div>
</body>

</html>