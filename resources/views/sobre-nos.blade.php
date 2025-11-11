<!DOCTYPE html>

<html class="light" lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Apoia+ | Gestão de Doações Simplificada</title>
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
                        "primary": "#0d7ff2",
                        "background-light": "#f5f7f8",
                        "background-dark": "#101922",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings:
                'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24
        }
    </style>
    @vite(['resources/css/home.css'])
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-[#111418] dark:text-gray-200">
    <div class="relative flex min-h-screen w-full flex-col group/design-root overflow-x-hidden">
        <div class="layout-container flex h-full grow flex-col">
            @include('components/land-page.header-welcome')
            <main class="flex-1">
                <!-- HeroSection -->
                <section class="flex justify-center py-12 sm:py-16 lg:py-20 px-4 sm:px-6">
                    <div class="layout-content-container flex flex-col items-center max-w-6xl flex-1 w-full">
                        <div class="w-full">
                            <div class="flex flex-col gap-8 lg:gap-12 lg:flex-row-reverse items-center">
                                <div class="w-full lg:w-1/2 flex justify-center px-4 sm:px-0">
                                    <img class="w-full max-w-sm sm:max-w-md h-auto object-cover rounded-xl shadow-lg" data-alt="Volunteers organizing donation boxes in a well-lit room." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBgahcYhm_AyAI0nW_ca7ax4xAvsgJ07Ov4NpLQp2copYeNUu8m-2_c6rNY8Qi6Q5i1eaehXuRrBvDr3OtY2GriVtXuI5ab37d3WAjaQuhybm2_qrHQNn7mH4N18SkF8o7pD7AJH45mKua8AmSaVCrG8poWXE1KMYZxzGGYas3SqpV1PsEZfZxoaDTgUCCTZcyrSjsMylkYRgXqTKCWGTwMnW2PMCSSzqsEKPIor_NUG5wxlHH181kmho9WXHaSvwVM2Nb1GFIj4EdJ" />
                                </div>
                                <div class="flex flex-col gap-6 text-center lg:text-left lg:w-1/2 px-4 sm:px-0">
                                    <div class="flex flex-col gap-4">
                                        <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-4xl xl:text-5xl font-black leading-tight tracking-tight dark:text-white break-words">
                                            Apoia+: Simplifique a Gestão de Doações e o Controle de Estoque
                                        </h1>
                                        <h2 class="text-sm sm:text-base md:text-lg font-normal leading-relaxed dark:text-gray-300">
                                            Uma solução completa para instituições, desenvolvida para otimizar o recebimento, organização e distribuição de doações com total transparência.
                                        </h2>
                                    </div>
                                    <div class="flex justify-center lg:justify-start">
                                        <button class="flex min-w-[84px] w-full sm:w-auto sm:max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-6 bg-primary text-white text-base font-bold tracking-[0.015em] hover:bg-primary/90 transition-all duration-200 shadow-md hover:shadow-lg">
                                            <span class="truncate">Saber Mais</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- FeatureSection -->
                <section class="flex justify-center py-12 sm:py-16 lg:py-20 px-4 sm:px-6 bg-white dark:bg-background-dark/50">
                    <div class="layout-content-container flex flex-col max-w-6xl flex-1 w-full">
                        <div class="flex flex-col gap-8 lg:gap-12">
                            <div class="flex flex-col gap-3 sm:gap-4 text-center max-w-3xl mx-auto px-4">
                                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold tracking-tight dark:text-white">Tudo que você precisa para uma gestão eficiente</h2>
                                <p class="text-sm sm:text-base font-normal text-[#60758a] dark:text-gray-400 leading-relaxed">O Apoia+ foi pensado para centralizar e facilitar todas as operações da sua instituição, desde o registro de doações até a análise de dados.</p>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                                <div class="flex flex-col flex-1 gap-3 rounded-xl border border-gray-200 dark:border-gray-800 bg-background-light dark:bg-background-dark p-5 sm:p-6 hover:shadow-lg transition-shadow duration-200">
                                    <div class="text-primary text-3xl sm:text-4xl"><span class="material-symbols-outlined">volunteer_activism</span></div>
                                    <div class="flex flex-col gap-1.5">
                                        <h3 class="text-base sm:text-lg font-bold dark:text-white">Gestão de Doações</h3>
                                        <p class="text-xs sm:text-sm font-normal text-[#60758a] dark:text-gray-400 leading-relaxed">Acompanhe e gerencie todas as doações recebidas de forma simples e organizada.</p>
                                    </div>
                                </div>
                                <div class="flex flex-col flex-1 gap-3 rounded-xl border border-gray-200 dark:border-gray-800 bg-background-light dark:bg-background-dark p-5 sm:p-6 hover:shadow-lg transition-shadow duration-200">
                                    <div class="text-primary text-3xl sm:text-4xl"><span class="material-symbols-outlined">inventory_2</span></div>
                                    <div class="flex flex-col gap-1.5">
                                        <h3 class="text-base sm:text-lg font-bold dark:text-white">Controle de Estoque</h3>
                                        <p class="text-xs sm:text-sm font-normal text-[#60758a] dark:text-gray-400 leading-relaxed">Mantenha o controle do seu inventário em tempo real para otimizar a distribuição.</p>
                                    </div>
                                </div>
                                <div class="flex flex-col flex-1 gap-3 rounded-xl border border-gray-200 dark:border-gray-800 bg-background-light dark:bg-background-dark p-5 sm:p-6 hover:shadow-lg transition-shadow duration-200">
                                    <div class="text-primary text-3xl sm:text-4xl"><span class="material-symbols-outlined">monitoring</span></div>
                                    <div class="flex flex-col gap-1.5">
                                        <h3 class="text-base sm:text-lg font-bold dark:text-white">Dashboards Interativos</h3>
                                        <p class="text-xs sm:text-sm font-normal text-[#60758a] dark:text-gray-400 leading-relaxed">Visualize dados e relatórios para tomar decisões mais assertivas e transparentes.</p>
                                    </div>
                                </div>
                                <div class="flex flex-col flex-1 gap-3 rounded-xl border border-gray-200 dark:border-gray-800 bg-background-light dark:bg-background-dark p-5 sm:p-6 hover:shadow-lg transition-shadow duration-200">
                                    <div class="text-primary text-3xl sm:text-4xl"><span class="material-symbols-outlined">group</span></div>
                                    <div class="flex flex-col gap-1.5">
                                        <h3 class="text-base sm:text-lg font-bold dark:text-white">Gestão de Usuários e Doadores</h3>
                                        <p class="text-xs sm:text-sm font-normal text-[#60758a] dark:text-gray-400 leading-relaxed">Cadastre administradores e mantenha um registro completo de seus doadores.</p>
                                    </div>
                                </div>
                                <div class="flex flex-col flex-1 gap-3 rounded-xl border border-gray-200 dark:border-gray-800 bg-background-light dark:bg-background-dark p-5 sm:p-6 hover:shadow-lg transition-shadow duration-200">
                                    <div class="text-primary text-3xl sm:text-4xl"><span class="material-symbols-outlined">label</span></div>
                                    <div class="flex flex-col gap-1.5">
                                        <h3 class="text-base sm:text-lg font-bold dark:text-white">Categorias e Campanhas</h3>
                                        <p class="text-xs sm:text-sm font-normal text-[#60758a] dark:text-gray-400 leading-relaxed">Personalize o sistema com categorias de itens e tipos de campanhas específicas.</p>
                                    </div>
                                </div>
                                <div class="flex flex-col flex-1 gap-3 rounded-xl border border-gray-200 dark:border-gray-800 bg-background-light dark:bg-background-dark p-5 sm:p-6 hover:shadow-lg transition-shadow duration-200">
                                    <div class="text-primary text-3xl sm:text-4xl"><span class="material-symbols-outlined">manage_search</span></div>
                                    <div class="flex flex-col gap-1.5">
                                        <h3 class="text-base sm:text-lg font-bold dark:text-white">Logs de Auditoria</h3>
                                        <p class="text-xs sm:text-sm font-normal text-[#60758a] dark:text-gray-400 leading-relaxed">Garanta a transparência e rastreabilidade com um sistema completo de logs e filtros.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Dashboard Showcase Section -->
                <section class="flex justify-center py-12 sm:py-16 lg:py-20 px-4 sm:px-6">
                    <div class="layout-content-container flex flex-col items-center max-w-6xl flex-1 w-full gap-8 lg:gap-10">
                        <div class="flex flex-col gap-3 sm:gap-4 text-center max-w-3xl mx-auto px-4">
                            <h4 class="text-primary text-xs sm:text-sm font-bold tracking-wide uppercase">VISUALIZE SEU IMPACTO</h4>
                            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold tracking-tight dark:text-white">Dashboards que Contam uma História</h2>
                            <p class="text-sm sm:text-base font-normal text-[#60758a] dark:text-gray-400 leading-relaxed">Nossos painéis interativos transformam dados brutos em insights claros, permitindo que você acompanhe o progresso, identifique tendências e demonstre o impacto do seu trabalho para a comunidade e doadores.</p>
                        </div>
                        <div class="w-full bg-white dark:bg-background-dark p-3 sm:p-4 md:p-6 border border-gray-200 dark:border-gray-800 rounded-xl shadow-2xl shadow-gray-200/50 dark:shadow-black/50">
                            <img class="w-full h-auto object-cover rounded-lg" data-alt="A clean and modern dashboard interface showing various charts and graphs related to donations and inventory management." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDmXw_Hz1kJbBn3oOEuX8tyH9QSuIT5_G-2JQpr1RjP-jrhZcAAg4IXNRqB_zHOeRgbNzZ3IYTYft34xfnvh0hzKHMoOgTkMKVbrW3LSZ5cge4P6vHvXHU09ex4ob4ZBs2cDmbhlub1gHXQsNAacO03W5z3bu6d2_QEdzH8W3kmbztgT4W323vaGkeEtvd4Sd6ZozBlwCqCVvIZEwBoW4UNl9Y0tqEjux1x0oTSsVwn1cwCXfIXHO4PGeu2m8glM78VS9vcJnZyOfjE" />
                        </div>
                    </div>
                </section>
                <!-- CTA Section -->
                <section class="flex justify-center py-12 sm:py-16 lg:py-20 px-4 sm:px-6">
                    <div class="layout-content-container flex flex-col items-center text-center max-w-3xl flex-1 w-full gap-5 sm:gap-6">
                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold tracking-tight dark:text-white px-4">Pronto para transformar a gestão da sua instituição?</h2>
                        <p class="text-sm sm:text-base font-normal text-[#60758a] dark:text-gray-400 leading-relaxed px-4">Descubra como o Apoia+ pode otimizar suas operações e ampliar seu impacto. Entre em contato conosco para saber mais sobre nosso projeto.</p>
                        <a class="text-sm" href="{{ url('/faleconosco') }}">
                            <button class="flex min-w-[84px] w-full sm:w-auto sm:max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-6 bg-primary text-white text-base font-bold tracking-[0.015em] hover:bg-primary/90 transition-all duration-200 shadow-md hover:shadow-lg mx-4">
                                <span class="truncate">Entre em Contato</span>
                            </button>
                        </a>
                    </div>
                </section>
            </main>
            <!-- Footer -->
            @include('components.land-page.footer-welcome')
        </div>
    </div>
</body>

</html>