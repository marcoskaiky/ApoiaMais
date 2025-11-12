<!DOCTYPE html>
<html lang="pt-BR" class="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Apoia+</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">


    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <!-- Configuração do Tailwind -->
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
                        "DEFAULT": "0.5rem",
                        "lg": "0.75rem",
                        "xl": "1rem",
                        "full": "9999px"
                    }
                }
            }
        }
    </script>

    @vite(['resources/css/home.css'])
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-[#111418] dark:text-white">
    <div class="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden">
        <div class="layout-container flex h-full grow flex-col">

            <!-- Header -->
            @include('components.land-page.header-welcome')

            <main class="flex-1">
                <section class="w-full py-20 lg:py-32">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">
                        <div class="flex min-h-[480px] flex-col gap-6 bg-cover bg-center bg-no-repeat rounded-xl items-start justify-center text-center px-4 py-10 sm:px-10" data-alt="Abstract blue and white gradient background representing support and community" style='background-image: linear-gradient(rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0.5) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuAaFsgDK41Wdq1fiiGjkz5m61U1sWen6vMzwiYl79tpGjkdvLCfdakof7shJCpBEf7gziqmmEiJcLIOX0fWATlMFKedU5NqB0EzrXhdyTDnkzONViV4HxwWo71LKMWSfGRFhxNSPZdViW3iddEbptY0RcPRrTg4zWxPyFcuLNTxU8zQz6STQ9ROXzMggJxn9JsanPWzUdSfJ6ryjomNOCxp232jv_FrfTJrkKY65vK0JQollQBlXhhztr5zQ7bzudPPCpnxp6QZCz6v");'>
                            <div class="flex flex-col gap-4 text-left max-w-3xl">
                                <h1 class="text-white text-4xl font-black leading-tight tracking-[-0.033em] sm:text-5xl lg:text-6xl">
                                    Transformando a gestão de doações da sua instituição.
                                </h1>
                                <h2 class="text-white text-base font-normal leading-normal sm:text-lg">
                                    Apoia+: solução simples e eficiente para registrar doações e controlar estoques com segurança.
                                </h2>
                            </div>
                            <button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 bg-primary text-white text-base font-bold leading-normal tracking-[0.015em] hover:opacity-90 transition-opacity">
                                <span class="truncate">Saiba mais</span>
                            </button>
                        </div>
                    </div>
                </section>
                <section class="w-full py-16 lg:py-24 bg-white dark:bg-background-dark">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">
                        <div class="flex flex-col gap-12">
                            <div class="flex flex-col gap-4 text-center">
                                <h2 class="text-gray-900 dark:text-white text-3xl font-bold leading-tight tracking-[-0.015em] sm:text-4xl">Por que escolher o Apoia+?</h2>
                                <p class="text-gray-600 dark:text-gray-400 text-base font-normal leading-normal max-w-2xl mx-auto">
                                    Uma plataforma pensada para instituições: ferramentas completas para gerenciar doações, controlar o estoque e gerar relatórios operacionais.
                                </p>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                <div class="flex flex-col gap-4 rounded-xl border border-gray-200 dark:border-gray-800 bg-background-light dark:bg-gray-800/50 p-6 text-center items-center">
                                    <div class="flex items-center justify-center size-12 rounded-full bg-primary/20 text-primary">
                                        <span class="material-symbols-outlined text-3xl">dashboard</span>
                                    </div>
                                    <div class="flex flex-col gap-1">
                                        <h3 class="text-gray-900 dark:text-white text-lg font-bold leading-tight">Controle centralizado</h3>
                                        <p class="text-gray-600 dark:text-gray-400 text-sm font-normal leading-normal">Gerencie todas as doações e informações de estoque a partir de um painel único e intuitivo.</p>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-4 rounded-xl border border-gray-200 dark:border-gray-800 bg-background-light dark:bg-gray-800/50 p-6 text-center items-center">
                                    <div class="flex items-center justify-center size-12 rounded-full bg-primary/20 text-primary">
                                        <span class="material-symbols-outlined text-3xl">inventory_2</span>
                                    </div>
                                    <div class="flex flex-col gap-1">
                                        <h3 class="text-gray-900 dark:text-white text-lg font-bold leading-tight">Inventário otimizado</h3>
                                        <p class="text-gray-600 dark:text-gray-400 text-sm font-normal leading-normal">Evite desperdício e mantenha visibilidade do saldo disponível com atualizações de estoque em tempo real.</p>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-4 rounded-xl border border-gray-200 dark:border-gray-800 bg-background-light dark:bg-gray-800/50 p-6 text-center items-center">
                                    <div class="flex items-center justify-center size-12 rounded-full bg-primary/20 text-primary">
                                        <span class="material-symbols-outlined text-3xl">monitoring</span>
                                    </div>
                                    <div class="flex flex-col gap-1">
                                        <h3 class="text-gray-900 dark:text-white text-lg font-bold leading-tight">Relatórios confiáveis</h3>
                                        <p class="text-gray-600 dark:text-gray-400 text-sm font-normal leading-normal">Gere relatórios detalhados para mensurar impacto e apoiar decisões estratégicas.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="w-full py-16 lg:py-24">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">
                        <div class="flex flex-col gap-12 items-center">
                            <div class="flex flex-col gap-4 text-center">
                                <h2 class="text-gray-900 dark:text-white text-3xl font-bold leading-tight tracking-[-0.015em] sm:text-4xl">Como funciona</h2>
                                <p class="text-gray-600 dark:text-gray-400 text-base font-normal leading-normal max-w-2xl mx-auto">
                                    Inicie em poucos passos e otimize processos de recebimento e distribuição de doações com rapidez e segurança.
                                </p>
                            </div>
                            <div class="w-full max-w-4xl relative">
                                <div class="absolute top-1/2 left-0 w-full h-0.5 bg-gray-200 dark:bg-gray-800 -translate-y-1/2"></div>
                                <div class="relative grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                                    <div class="flex flex-col items-center gap-4">
                                        <div class="flex items-center justify-center size-12 rounded-full bg-primary text-white font-bold text-lg border-4 border-background-light dark:border-background-dark">1</div>
                                        <h3 class="text-gray-900 dark:text-white text-lg font-bold">Cadastre sua instituição</h3>
                                        <p class="text-gray-600 dark:text-gray-400 text-sm">Configuração rápida para colocar sua organização em operação.</p>
                                    </div>
                                    <div class="flex flex-col items-center gap-4">
                                        <div class="flex items-center justify-center size-12 rounded-full bg-primary text-white font-bold text-lg border-4 border-background-light dark:border-background-dark">2</div>
                                        <h3 class="text-gray-900 dark:text-white text-lg font-bold">Gerencie doações</h3>
                                        <p class="text-gray-600 dark:text-gray-400 text-sm">Registre doações recebidas de forma ágil por meio de uma interface prática.</p>
                                    </div>
                                    <div class="flex flex-col items-center gap-4">
                                        <div class="flex items-center justify-center size-12 rounded-full bg-primary text-white font-bold text-lg border-4 border-background-light dark:border-background-dark">3</div>
                                        <h3 class="text-gray-900 dark:text-white text-lg font-bold">Controle o estoque</h3>
                                        <p class="text-gray-600 dark:text-gray-400 text-sm">Acompanhe itens em estoque e otimize a distribuição de acordo com necessidades.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="w-full py-16 lg:py-24 bg-white dark:bg-background-dark">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">
                        <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-16 bg-background-light dark:bg-gray-800/50 p-8 sm:p-12 rounded-xl">
                            <div class="w-full lg:w-1/2">
                                <img alt="A group of diverse students collaborating around a laptop, smiling and engaged in a project." class="rounded-lg object-cover w-full h-auto aspect-video" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBWFcmPDwkCR-usneb_M_s6xiJyVQNkWwKBJFOXs8LGLucLxCWTQu5CJEK-PXj-GNDSBr40W04OPU6EpFlOXXCIbl2BquWx6BlpOGa5UNrE6T8_XV_iboaNlNMFWiml-cTIBkEB4gWI9vvgmHt3l5utWsQxDfUGa5p0C9Mle9HPOkJT1OKheG2YsOfgATDjGf-n-YdDhHuH8D4l7XmKO0-9aZTtOYER7S23bCG8IX-j_FVe4LGX8Pm0MKS-Wp5BPP8oxyQPyDzIAhQ2" />
                            </div>
                            <div class="w-full lg:w-1/2 flex flex-col gap-4">
                                <h2 class="text-gray-900 dark:text-white text-3xl font-bold leading-tight tracking-[-0.015em]">Sobre o Apoia+</h2>
                                <p class="text-gray-600 dark:text-gray-400 text-base font-normal leading-normal">
                                    O Apoia+ é uma solução desenvolvida por estudantes com foco em instituições sem fins lucrativos. Nossa missão é oferecer uma ferramenta gratuita, robusta e de fácil utilização para otimizar o gerenciamento de doações e estoques, permitindo que as organizações concentrem seus esforços no atendimento à comunidade.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            @include('components.land-page.footer-welcome')
        </div>
    </div>
</body>

</html>