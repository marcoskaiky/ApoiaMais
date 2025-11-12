<!DOCTYPE html>

<html class="light" lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Sobre Nós - Apoia+</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <script id="tailwind-config">
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
            <main class="flex flex-1 justify-center py-5 sm:py-10">
                <div class="layout-content-container flex flex-col max-w-6xl flex-1 px-4 sm:px-6 lg:px-8 gap-16 sm:gap-24">
                    <section class="@container">
                        <div class="flex flex-col-reverse gap-8 px-4 py-10 @[864px]:flex-row @[864px]:items-center">
                            <div class="flex w-full flex-col gap-6 text-center @[864px]:text-left @[864px]:w-1/2 @[864px]:pr-8">
                                <div class="flex flex-col gap-4">
                                    <h1 class="text-3xl font-black leading-tight tracking-tight sm:text-4xl lg:text-5xl dark:text-white">
                                        Nascido da sala de aula para causar impacto real
                                    </h1>
                                    <h2 class="text-base font-normal leading-relaxed sm:text-lg dark:text-gray-300">
                                        Conheça a história do Apoia+, um sistema de gestão de doações e estoque criado por estudantes para transformar a realidade de instituições.
                                    </h2>
                                </div>
                                <div class="flex justify-center gap-4 @[864px]:justify-start">
                                    <a href="{{ url('/funcionalidades') }}">
                                        <button class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 bg-primary text-white text-base font-bold leading-normal tracking-[0.015em] hover:bg-primary/90 transition-colors">
                                            <span class="truncate">Funcionalidades</span>
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="w-full @[864px]:w-1/2">
                                <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-xl" data-alt="Uma foto da equipe de estudantes do projeto Apoia+ colaborando em uma sessão de brainstorming em frente a um quadro branco." style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDtqZvZyZmXaQroyiGORRcmvYPlXsaN7ejPF-9s4xJElrlOzX72uO9pebPe3DYeNTIX70DCC7xbeq8FyOua8dmflOwZPA22mqvwleazXIakWVm5eFf6s155AL5qo11q9th82_U2PsyFFN-SrVK55jig6KuGDdwUqJPzD59BpYMtj4RB7lSIw1X7r_gPl2QbwNx8TtB2m5msEJfQQ2cdPVVcBe5bZL8I90eg2k1UmUL6Rw2QPJSwWzLYuwjgDcaEoIhG1Ro6WICyjK8a");'></div>
                            </div>
                        </div>
                    </section>
                    <section class="flex flex-col items-center gap-12">
                        <div class="flex flex-col gap-2 text-center max-w-3xl">
                            <h2 class="text-3xl font-bold leading-tight tracking-tight sm:text-4xl dark:text-white">Nossos Pilares</h2>
                            <p class="text-base font-normal leading-normal text-[#60758a] dark:text-gray-400">Três valores fundamentais que guiam cada passo do nosso projeto.</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 w-full">
                            <div class="flex flex-col items-center text-center p-6 bg-white dark:bg-background-dark/50 rounded-lg border border-gray-200 dark:border-gray-800">
                                <div class="mb-4 flex size-12 items-center justify-center rounded-full bg-primary/20 text-primary">
                                    <span class="material-symbols-outlined !text-3xl">lightbulb</span>
                                </div>
                                <h3 class="text-lg font-bold dark:text-white">Inovação</h3>
                                <p class="mt-2 text-sm text-[#60758a] dark:text-gray-400">Aplicamos tecnologia para criar soluções eficientes e acessíveis para problemas reais.</p>
                            </div>
                            <div class="flex flex-col items-center text-center p-6 bg-white dark:bg-background-dark/50 rounded-lg border border-gray-200 dark:border-gray-800">
                                <div class="mb-4 flex size-12 items-center justify-center rounded-full bg-primary/20 text-primary">
                                    <span class="material-symbols-outlined !text-3xl">groups</span>
                                </div>
                                <h3 class="text-lg font-bold dark:text-white">Impacto Social</h3>
                                <p class="mt-2 text-sm text-[#60758a] dark:text-gray-400">Nosso foco é fortalecer instituições de caridade, ampliando seu alcance e otimizando seu trabalho.</p>
                            </div>
                            <div class="flex flex-col items-center text-center p-6 bg-white dark:bg-background-dark/50 rounded-lg border border-gray-200 dark:border-gray-800">
                                <div class="mb-4 flex size-12 items-center justify-center rounded-full bg-primary/20 text-primary">
                                    <span class="material-symbols-outlined !text-3xl">school</span>
                                </div>
                                <h3 class="text-lg font-bold dark:text-white">Aprendizado</h3>
                                <p class="mt-2 text-sm text-[#60758a] dark:text-gray-400">O Apoia+ é um reflexo da nossa paixão por aprender, criar e evoluir constantemente.</p>
                            </div>
                        </div>
                    </section>
                    <section class="flex flex-col gap-10">
                        <div class="flex flex-col gap-2">
                            <h2 class="text-3xl font-bold leading-tight tracking-tight sm:text-4xl px-4 dark:text-white">A Motivação por Trás do Apoia+</h2>
                            <p class="text-base font-normal leading-relaxed px-4 text-[#60758a] dark:text-gray-400">
                                O Apoia+ nasceu da nossa vontade de aplicar o conhecimento acadêmico para resolver um problema real. Identificamos as dificuldades que muitas instituições de caridade enfrentam na gestão de doações e controle de estoque e decidimos criar uma solução que trouxesse mais eficiência e transparência para o trabalho delas.
                            </p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <h2 class="text-3xl font-bold leading-tight tracking-tight sm:text-4xl px-4 dark:text-white">Nossa Jornada</h2>
                            <p class="text-base font-normal leading-relaxed px-4 text-[#60758a] dark:text-gray-400">
                                Desde a primeira linha de código até o lançamento da plataforma, nossa jornada foi marcada por desafios, colaboração intensa e muito aprendizado. Cada obstáculo superado fortaleceu nossa equipe e nosso compromisso com a causa, transformando uma ideia universitária em uma ferramenta de impacto real.
                            </p>
                        </div>
                    </section>
                    <section class="flex flex-col items-center gap-12">
                        <div class="flex flex-col gap-2 text-center max-w-3xl">
                            <h2 class="text-3xl font-bold leading-tight tracking-tight sm:text-4xl dark:text-white">Conheça a Equipe</h2>
                            <p class="text-base font-normal leading-normal text-[#60758a] dark:text-gray-400">Os estudantes que transformaram uma ideia em realidade.</p>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 w-full">
                            <div class="flex flex-col items-center text-center bg-white dark:bg-background-dark/50 p-6 rounded-lg border border-gray-200 dark:border-gray-800">
                                <img class="h-24 w-24 rounded-full object-cover mb-4" data-alt="Foto de perfil de um jovem sorrindo, com cabelo curto e barba." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDIny1X-MucELxAvlraUHTA36bXCJ2ncNMHHGkkbaNn8ZZE4BWfCuXH4Ou7gVVLWKkrcKv5t68U4pxist0nYp01VZ5D4NS_g4S2wPv-LJCejqc8yazuTBDvvXVdTUG-x-JfffiNMQ2T5cqjL7PquDt8se71qEedyxjJynkm9Zfph56qilvUsH4iPtPJ9bPN6P_9Relu0Jw8gWiU5r0bWeT-YtGis3eqJXmxv3FflioHQbevcVX99ii6OgNhC60JqkKxCsYtu8oq20-H" />
                                <h3 class="text-lg font-bold dark:text-white">Lucas Oliveira</h3>
                                <p class="text-sm text-primary">Desenvolvedor Full-Stack</p>
                                <div class="mt-4 flex gap-4 text-[#60758a] dark:text-gray-400">
                                    <a class="hover:text-primary transition-colors" data-alt="LinkedIn logo" href="#"><svg class="h-5 w-5" fill="currentColor" viewbox="0 0 24 24">
                                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"></path>
                                        </svg></a>
                                </div>
                            </div>
                            <div class="flex flex-col items-center text-center bg-white dark:bg-background-dark/50 p-6 rounded-lg border border-gray-200 dark:border-gray-800">
                                <img class="h-24 w-24 rounded-full object-cover mb-4" data-alt="Foto de perfil de um jovem sorrindo, com cabelo curto e barba." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDIny1X-MucELxAvlraUHTA36bXCJ2ncNMHHGkkbaNn8ZZE4BWfCuXH4Ou7gVVLWKkrcKv5t68U4pxist0nYp01VZ5D4NS_g4S2wPv-LJCejqc8yazuTBDvvXVdTUG-x-JfffiNMQ2T5cqjL7PquDt8se71qEedyxjJynkm9Zfph56qilvUsH4iPtPJ9bPN6P_9Relu0Jw8gWiU5r0bWeT-YtGis3eqJXmxv3FflioHQbevcVX99ii6OgNhC60JqkKxCsYtu8oq20-H" />
                                <h3 class="text-lg font-bold dark:text-white">Lucas Oliveira</h3>
                                <p class="text-sm text-primary">Desenvolvedor Full-Stack</p>
                                <div class="mt-4 flex gap-4 text-[#60758a] dark:text-gray-400">
                                    <a class="hover:text-primary transition-colors" data-alt="LinkedIn logo" href="#"><svg class="h-5 w-5" fill="currentColor" viewbox="0 0 24 24">
                                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"></path>
                                        </svg></a>
                                </div>
                            </div>
                            <div class="flex flex-col items-center text-center bg-white dark:bg-background-dark/50 p-6 rounded-lg border border-gray-200 dark:border-gray-800">
                                <img class="h-24 w-24 rounded-full object-cover mb-4" data-alt="Foto de perfil de um jovem sorrindo, com cabelo curto e barba." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDIny1X-MucELxAvlraUHTA36bXCJ2ncNMHHGkkbaNn8ZZE4BWfCuXH4Ou7gVVLWKkrcKv5t68U4pxist0nYp01VZ5D4NS_g4S2wPv-LJCejqc8yazuTBDvvXVdTUG-x-JfffiNMQ2T5cqjL7PquDt8se71qEedyxjJynkm9Zfph56qilvUsH4iPtPJ9bPN6P_9Relu0Jw8gWiU5r0bWeT-YtGis3eqJXmxv3FflioHQbevcVX99ii6OgNhC60JqkKxCsYtu8oq20-H" />
                                <h3 class="text-lg font-bold dark:text-white">Lucas Oliveira</h3>
                                <p class="text-sm text-primary">Desenvolvedor Full-Stack</p>
                                <div class="mt-4 flex gap-4 text-[#60758a] dark:text-gray-400">
                                    <a class="hover:text-primary transition-colors" data-alt="LinkedIn logo" href="#"><svg class="h-5 w-5" fill="currentColor" viewbox="0 0 24 24">
                                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"></path>
                                        </svg></a>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </main>
            @include('components.land-page.footer-welcome')
        </div>
    </div>
</body>

</html>