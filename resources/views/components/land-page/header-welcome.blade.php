<header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#f0f2f5] dark:border-b-[#2a2a2a] px-4 sm:px-10 py-3">
    <div class="flex items-center gap-4">
        <div class="size-6 text-primary">
            <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                <path d="M42.4379 44C42.4379 44 36.0744 33.9038 41.1692 24C46.8624 12.9336 42.2078 4 42.2078 4L7.01134 4C7.01134 4 11.6577 12.932 5.96912 23.9969C0.876273 33.9029 7.27094 44 7.27094 44L42.4379 44Z" fill="currentColor"></path>
            </svg>
        </div>
        <a class="text-xl font-bold" href="{{ url('/') }}">Apoia +</a>
    </div>

    <div class="hidden md:flex flex-1 justify-end gap-8">
        <div class="flex items-center gap-9">
            <a href="#" class="text-sm font-medium leading-normal">Funcionalidades</a>
            <a href="#" class="text-sm font-medium leading-normal">Depoimentos</a>
            <a href="#" class="text-sm font-medium leading-normal">Comece Agora</a>
            <a href="{{ url('/faleconosco') }}" class="text-sm font-medium leading-normal">Fale Conosco</a>
        </div>

        <div class="flex gap-2">
            @auth
            <a href="{{ route('admin.dashboard') }}" class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em]">
                <span class="truncate">Acessar Painel</span>
            </a>
            @else
            <a href="{{ route('login') }}" class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary/20 text-primary text-sm font-bold leading-normal tracking-[0.015em] dark:bg-primary/30 dark:text-white">
                <span class="truncate">Login</span>
            </a>
            @endauth
        </div>
    </div>

    <div class="md:hidden">
        <button class="text-[#111418] dark:text-white">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </div>
</header>