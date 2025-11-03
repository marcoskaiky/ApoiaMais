<!DOCTYPE html>
<html lang="pt-BR" class="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Apoia+ | Landing Page</title>

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

            <!-- Hero Section -->
            <div class="px-4 lg:px-40 flex flex-1 justify-center py-5">
                <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
                    <div class="@container">
                        <div class="@[480px]:p-4">
                            <div class="hero-section flex min-h-[480px] flex-col gap-6 bg-cover bg-center bg-no-repeat @[480px]:gap-8 @[480px]:rounded-xl items-center justify-center p-4">
                                <div class="flex flex-col gap-4 text-center max-w-2xl">
                                    <h1 class="text-white text-4xl font-black leading-tight tracking-[-0.033em] @[480px]:text-5xl">
                                        Transforme a Gestão de Doações. Amplifique seu Impacto.
                                    </h1>
                                    <h2 class="text-gray-200 text-base font-normal leading-normal @[480px]:text-lg">
                                        Apoia+ é a plataforma completa para otimizar seu estoque e impulsionar suas campanhas de arrecadação. Foco no que realmente importa: ajudar quem precisa.
                                    </h2>
                                </div>
                                <button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 @[480px]:h-14 @[480px]:px-6 bg-primary text-white text-base font-bold leading-normal tracking-[0.015em] @[480px]:text-lg">
                                    <span class="truncate">Comece a Usar Gratuitamente</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features Section -->
            <div class="px-4 lg:px-40 flex flex-1 justify-center py-5">
                <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
                    <div class="flex flex-col gap-10 px-4 py-10 @container">
                        <div class="flex flex-col gap-6 items-start">
                            <div class="flex flex-col gap-4">
                                <h1 class="text-[#111418] dark:text-white tracking-tight text-[32px] font-bold leading-tight @[480px]:text-4xl @[480px]:font-black @[480px]:leading-tight max-w-[720px]">
                                    Funcionalidades Pensadas para sua Organização
                                </h1>
                                <p class="text-[#60758a] dark:text-gray-300 text-base font-normal leading-normal max-w-[720px]">
                                    Descubra como o Apoia+ pode simplificar a gestão de doações e potencializar o alcance das suas campanhas.
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-[repeat(auto-fit,minmax(240px,1fr))] gap-4 p-0">
                            <!-- Card 1 -->
                            <div class="flex flex-1 gap-4 rounded-lg border border-gray-200 dark:border-[#2a2a2a] bg-white dark:bg-[#1a1a1a] p-6 flex-col shadow-sm hover:shadow-lg transition-shadow duration-300">
                                <div class="text-primary">
                                    <span class="material-symbols-outlined !text-3xl">inventory_2</span>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <h2 class="text-[#111418] dark:text-white text-lg font-bold leading-tight">Controle de Estoque Inteligente</h2>
                                    <p class="text-[#60758a] dark:text-gray-300 text-sm font-normal leading-normal">
                                        Monitore entradas, saídas e validades de produtos em tempo real. Saiba exatamente o que você tem e o que precisa.
                                    </p>
                                </div>
                            </div>

                            <!-- Card 2 -->
                            <div class="flex flex-1 gap-4 rounded-lg border border-gray-200 dark:border-[#2a2a2a] bg-white dark:bg-[#1a1a1a] p-6 flex-col shadow-sm hover:shadow-lg transition-shadow duration-300">
                                <div class="text-primary">
                                    <span class="material-symbols-outlined !text-3xl">campaign</span>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <h2 class="text-[#111418] dark:text-white text-lg font-bold leading-tight">Criação de Campanhas Simplificada</h2>
                                    <p class="text-[#60758a] dark:text-gray-300 text-sm font-normal leading-normal">
                                        Crie e gerencie campanhas de arrecadação em minutos. Divulgue facilmente e acompanhe o progresso.
                                    </p>
                                </div>
                            </div>

                            <!-- Card 3 -->
                            <div class="flex flex-1 gap-4 rounded-lg border border-gray-200 dark:border-[#2a2a2a] bg-white dark:bg-[#1a1a1a] p-6 flex-col shadow-sm hover:shadow-lg transition-shadow duration-300">
                                <div class="text-primary">
                                    <span class="material-symbols-outlined !text-3xl">bar_chart</span>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <h2 class="text-[#111418] dark:text-white text-lg font-bold leading-tight">Relatórios de Impacto</h2>
                                    <p class="text-[#60758a] dark:text-gray-300 text-sm font-normal leading-normal">
                                        Gere relatórios visuais sobre o impacto de suas ações. Transparência para sua equipe e para seus doadores.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- How It Works -->
            <div class="px-4 lg:px-40 flex flex-1 justify-center py-5">
                <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
                    <h2 class="text-[#111418] dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">Como Funciona</h2>
                    <div class="grid grid-cols-[40px_1fr] gap-x-4 px-4 py-5">

                        <!-- Step 1 -->
                        <div class="flex flex-col items-center gap-2">
                            <div class="flex items-center justify-center size-10 rounded-full bg-primary/20 text-primary">
                                <span class="material-symbols-outlined">person_add</span>
                            </div>
                            <div class="w-[2px] bg-gray-200 dark:bg-gray-700 h-full"></div>
                        </div>
                        <div class="flex flex-1 flex-col pb-8">
                            <p class="text-gray-500 dark:text-gray-400 text-sm font-medium leading-normal">Passo 1</p>
                            <p class="text-[#111418] dark:text-white text-lg font-medium leading-normal">Cadastre-se na Plataforma</p>
                            <p class="text-[#60758a] dark:text-gray-300 text-base font-normal leading-normal mt-1">Crie sua conta gratuitamente em poucos minutos e tenha acesso a todas as nossas ferramentas.</p>
                        </div>

                        <!-- Step 2 -->
                        <div class="flex flex-col items-center gap-2">
                            <div class="flex items-center justify-center size-10 rounded-full bg-primary/20 text-primary">
                                <span class="material-symbols-outlined">move_to_inbox</span>
                            </div>
                            <div class="w-[2px] bg-gray-200 dark:bg-gray-700 h-full"></div>
                        </div>
                        <div class="flex flex-1 flex-col pb-8">
                            <p class="text-gray-500 dark:text-gray-400 text-sm font-medium leading-normal">Passo 2</p>
                            <p class="text-[#111418] dark:text-white text-lg font-medium leading-normal">Organize seu Estoque</p>
                            <p class="text-[#60758a] dark:text-gray-300 text-base font-normal leading-normal mt-1">Registre as doações recebidas, categorize os itens e tenha uma visão clara do seu inventário.</p>
                        </div>

                        <!-- Step 3 -->
                        <div class="flex flex-col items-center gap-2">
                            <div class="flex items-center justify-center size-10 rounded-full bg-primary/20 text-primary">
                                <span class="material-symbols-outlined">speaker_phone</span>
                            </div>
                            <div class="w-[2px] bg-gray-200 dark:bg-gray-700 h-full"></div>
                        </div>
                        <div class="flex flex-1 flex-col pb-8">
                            <p class="text-gray-500 dark:text-gray-400 text-sm font-medium leading-normal">Passo 3</p>
                            <p class="text-[#111418] dark:text-white text-lg font-medium leading-normal">Crie sua Campanha</p>
                            <p class="text-[#60758a] dark:text-gray-300 text-base font-normal leading-normal mt-1">Lance campanhas de arrecadação, defina metas e compartilhe com sua rede de apoiadores.</p>
                        </div>

                        <!-- Step 4 -->
                        <div class="flex flex-col items-center gap-2">
                            <div class="flex items-center justify-center size-10 rounded-full bg-primary/20 text-primary">
                                <span class="material-symbols-outlined">monitoring</span>
                            </div>
                        </div>
                        <div class="flex flex-1 flex-col pb-8">
                            <p class="text-gray-500 dark:text-gray-400 text-sm font-medium leading-normal">Passo 4</p>
                            <p class="text-[#111418] dark:text-white text-lg font-medium leading-normal">Meça seu Impacto</p>
                            <p class="text-[#60758a] dark:text-gray-300 text-base font-normal leading-normal mt-1">Acompanhe os resultados em tempo real e gere relatórios para demonstrar o impacto social do seu trabalho.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonials -->
            <div class="px-4 lg:px-40 flex flex-1 justify-center py-10 bg-white dark:bg-[#1a1a1a]/50">
                <div class="layout-content-container flex flex-col items-center max-w-[960px] flex-1 gap-10">
                    <div class="flex flex-col gap-4 text-center">
                        <h1 class="text-[#111418] dark:text-white tracking-tight text-[32px] font-bold leading-tight @[480px]:text-4xl @[480px]:font-black max-w-[720px]">
                            O que nossos parceiros dizem
                        </h1>
                        <p class="text-[#60758a] dark:text-gray-300 text-base font-normal leading-normal max-w-[720px]">
                            Organizações que confiam no Apoia+ para potencializar suas missões.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-full">
                        <div class="flex flex-col gap-4 p-6 rounded-lg bg-background-light dark:bg-[#1a1a1a] shadow-sm">
                            <div class="flex items-center gap-4">
                                <img alt="Foto de Maria Silva" class="size-12 rounded-full" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBb3Vy1pPsuAsU7LCb572T3f0TFaUsAfNASHm62P4ltHXJvZNsrTeiFocfz_qL3nRH5GP1QLDicJVOkhsmGJE2rkNwCNSu3MYkIvHeraoR1SVoP7oag_rqcgIbLScLc3_7-wiowgfVimsKr1An62XozUZISpKFOLeLiFTJaPLY5WuS0VIvJe8T8OOryIgPICL5eR3IY6qfBmjeV64Eel1ShSAzBwfTJnLwtMYCuRfYw3-TiV6PWRXNtggWSvyHw7PdplRhDq5JXQQYu" />
                                <div>
                                    <p class="font-bold text-[#111418] dark:text-white">Maria Silva</p>
                                    <p class="text-sm text-[#60758a] dark:text-gray-300">Diretora da ONG Causa Nobre</p>
                                </div>
                            </div>
                            <p class="text-[#111418] dark:text-white">"O Apoia+ revolucionou nossa gestão de doações. A plataforma é intuitiva e os relatórios de impacto nos ajudam a ser mais transparentes com nossos doadores. Ganhamos muito mais agilidade."</p>
                        </div>

                        <div class="flex flex-col gap-4 p-6 rounded-lg bg-background-light dark:bg-[#1a1a1a] shadow-sm">
                            <div class="flex items-center gap-4">
                                <img alt="Foto de João Pereira" class="size-12 rounded-full" src="https://lh3.googleusercontent.com/aida-public/AB6AXuASEur1wCAEDcrzrGHCJzvSOe_DUX2Rd8k2XWaZ6ywZleE_ID_WtvZrR7DfF2x1TSAPmw2lCKK2QRQlURUSjx-LKmxnA-uULNTbL8tIogFa3Go1jRPTtVi7eCGsqod0QU-PhhiARPurLVU0-kG2lnv1l5jlnGbCtgA07Up249_Q-CFjFhyHvovF7_lXIbRR456wS_2jKXx8bhjGul639L-FWfw6bqsExizC94KWZv9RdJ5g7556-2mlwq7clQ3gHNQRBiZPDiBTcyDl" />
                                <div>
                                    <p class="font-bold text-[#111418] dark:text-white">João Pereira</p>
                                    <p class="text-sm text-[#60758a] dark:text-gray-300">Coordenador do Projeto Mão Amiga</p>
                                </div>
                            </div>
                            <p class="text-[#111418] dark:text-white">"Criar campanhas de arrecadação ficou muito mais fácil e rápido. Conseguimos engajar nossa comunidade de forma muito mais eficaz e atingir nossas metas com o Apoia+."</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA -->
            <div class="px-4 lg:px-40 flex flex-1 justify-center py-20">
                <div class="layout-content-container flex flex-col items-center text-center max-w-[960px] flex-1 gap-6">
                    <h2 class="text-3xl font-bold text-[#111418] dark:text-white">Pronto para transformar sua organização?</h2>
                    <p class="text-lg text-[#60758a] dark:text-gray-300 max-w-xl">Junte-se a centenas de organizações que já estão otimizando suas operações e ampliando seu impacto com o Apoia+.</p>
                    <button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-6 bg-primary text-white text-base font-bold leading-normal tracking-[0.015em]">
                        <span class="truncate">Comece a Usar Gratuitamente</span>
                    </button>
                </div>
            </div>

            @include('components.land-page.footer-welcome')
        </div>
    </div>
</body>

</html>