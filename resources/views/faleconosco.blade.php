<!DOCTYPE html>

<html class="light" lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Contato - Apoia+</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#2563EB",
                        "background-light": "#FFFFFF",
                        "background-dark": "#1F2937",
                        "text-light": "#1F2937",
                        "text-dark": "#F3F4F6",
                        "accent-light": "#F3F4F6",
                        "accent-dark": "#374151"
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
            font-variation-settings:
                'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24
        }
    </style>

    @vite(['resources/css/home.css'])
    @vite(['resources/css/faleconosco.css'])
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-text-light dark:text-text-dark">
    <div class="relative flex min-h-screen w-full flex-col">

        @include('components/land-page.header-welcome')

        <main class="flex-grow">
            <div class="container mx-auto px-4 py-16 sm:py-24">
                <!-- PageHeading -->
                <div class="mx-auto max-w-4xl text-center mb-12">
                    <h2 class="text-4xl sm:text-5xl font-black tracking-tighter">Entre em Contato</h2>
                    <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">Estamos aqui para ajudar. Escolha um dos canais abaixo ou nos envie uma mensagem diretamente pelo formulário.</p>
                </div>
                <div class="mx-auto max-w-6xl grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">
                    <!-- Left Column: Contact Methods -->
                    <div class="flex flex-col gap-8">
                        <!-- Card 1: Chat Online -->
                        <div class="flex flex-col sm:flex-row items-start gap-6 p-6 bg-accent-light dark:bg-accent-dark rounded-lg">
                            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-primary/20 text-primary">
                                <span class="material-symbols-outlined text-3xl">chat</span>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-bold">Chat Online</h3>
                                <p class="text-gray-600 dark:text-gray-300 mt-1">Disponível de Seg a Sex, 9h-18h</p>
                                <button class="mt-4 inline-flex items-center justify-center rounded-md h-10 px-6 bg-primary text-white text-sm font-medium shadow-sm hover:bg-primary/90 transition-colors focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 focus:ring-offset-background-light dark:focus:ring-offset-background-dark">
                                    Iniciar Conversa
                                </button>
                            </div>
                        </div>
                        <!-- Card 2: Telefone -->
                        <div class="flex flex-col sm:flex-row items-start gap-6 p-6 bg-accent-light dark:bg-accent-dark rounded-lg">
                            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-primary/20 text-primary">
                                <span class="material-symbols-outlined text-3xl">call</span>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-bold">Telefone</h3>
                                <p class="text-gray-600 dark:text-gray-300 mt-1">(11) 99999-9999</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Atendimento de Seg a Sex, 9h-18h</p>
                            </div>
                        </div>
                        <!-- Card 3: E-mail -->
                        <div class="flex flex-col sm:flex-row items-start gap-6 p-6 bg-accent-light dark:bg-accent-dark rounded-lg">
                            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-primary/20 text-primary">
                                <span class="material-symbols-outlined text-3xl">email</span>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-bold">E-mail</h3>
                                <p class="text-gray-600 dark:text-gray-300 mt-1">contato@apoiama.is</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Respondemos em até 24 horas úteis</p>
                            </div>
                        </div>
                    </div>
                    <!-- Right Column: Contact Form -->
                    <div class="flex flex-col">
                        <h3 class="text-2xl font-bold mb-6">Ou nos envie uma mensagem</h3>
                        <form action="#" class="space-y-6" method="POST">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200" for="nome">Nome</label>
                                <div class="mt-1">
                                    <input class="block w-full rounded-md border-gray-300 dark:border-gray-600 bg-background-light dark:bg-gray-700 shadow-sm focus:border-primary focus:ring-primary sm:text-sm" id="nome" name="nome" placeholder="Seu nome completo" type="text" />
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200" for="email">E-mail</label>
                                <div class="mt-1">
                                    <input class="block w-full rounded-md border-gray-300 dark:border-gray-600 bg-background-light dark:bg-gray-700 shadow-sm focus:border-primary focus:ring-primary sm:text-sm" id="email" name="email" placeholder="seu.email@exemplo.com" type="email" />
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200" for="assunto">Assunto</label>
                                <div class="mt-1">
                                    <input class="block w-full rounded-md border-gray-300 dark:border-gray-600 bg-background-light dark:bg-gray-700 shadow-sm focus:border-primary focus:ring-primary sm:text-sm" id="assunto" name="assunto" placeholder="Sobre o que você gostaria de falar?" type="text" />
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200" for="mensagem">Mensagem</label>
                                <div class="mt-1">
                                    <textarea class="block w-full rounded-md border-gray-300 dark:border-gray-600 bg-background-light dark:bg-gray-700 shadow-sm focus:border-primary focus:ring-primary sm:text-sm" id="mensagem" name="mensagem" placeholder="Digite sua mensagem aqui..." rows="5"></textarea>
                                </div>
                            </div>
                            <div>
                                <button class="w-full inline-flex items-center justify-center rounded-md h-12 px-6 bg-primary text-white text-base font-medium shadow-sm hover:bg-primary/90 transition-colors focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 focus:ring-offset-background-light dark:focus:ring-offset-background-dark" type="submit">
                                    Enviar Mensagem
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <!-- Footer -->
        @include('components.land-page.footer-welcome')
    </div>
</body>

</html>