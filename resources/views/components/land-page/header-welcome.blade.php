<header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#f0f2f5] dark:border-b-[#2a2a2a] px-4 sm:px-10 py-3">
    <div class="flex items-center gap-4">
        <a class="text-xl font-bold focus:outline-none" href="{{ url('/') }}">Apoia +</a>
    </div>

    <div class="hidden md:flex flex-1 justify-end gap-8">
        <div class="flex items-center gap-9">
            <a href="{{ url('/funcionalidades') }}" class="text-sm font-medium leading-normal focus:outline-none hover:text-primary transition-colors">Funcionalidades</a>
            <a href="{{ url('/sobrenos') }}" class="text-sm font-medium leading-normal focus:outline-none hover:text-primary transition-colors">Sobre Nós</a>
            <a href="{{ url('/roadmap') }}" class="text-sm font-medium leading-normal focus:outline-none hover:text-primary transition-colors">Roadmap do Sistema</a>
            <a href="{{ url('/faleconosco') }}" class="text-sm font-medium leading-normal focus:outline-none hover:text-primary transition-colors">Fale Conosco</a>
        </div>

        <div class="flex gap-2">
            @auth
            <a href="{{ route('admin.dashboard') }}" class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em] focus:outline-none hover:bg-primary/90 transition-colors">
                <span class="truncate">Acessar Painel</span>
            </a>
            @else
            <a href="{{ route('login') }}" class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary/20 text-primary text-sm font-bold leading-normal tracking-[0.015em] dark:bg-primary/30 dark:text-white focus:outline-none hover:bg-primary/30 transition-colors">
                <span class="truncate">Login</span>
            </a>
            @endauth
        </div>
    </div>

    <div class="md:hidden">
        <button id="mobile-menu-button" class="text-[#111418] dark:text-white focus:outline-none">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </div>
</header>

<!-- Mobile Menu -->
<div id="mobile-menu" class="hidden md:hidden bg-white dark:bg-background-dark border-b border-gray-200 dark:border-gray-800">
    <div class="flex flex-col px-4 py-3 space-y-3">
        <a href="{{ url('/funcionalidades') }}" class="text-sm font-medium leading-normal focus:outline-none hover:text-primary transition-colors py-2">Funcionalidades</a>
        <a href="{{ url('/sobrenos') }}" class="text-sm font-medium leading-normal focus:outline-none hover:text-primary transition-colors py-2">Sobre Nós</a>
        <a href="{{ url('/roadmap') }}" class="text-sm font-medium leading-normal focus:outline-none hover:text-primary transition-colors py-2">Roadmap do Sistema</a>
        <a href="{{ url('/faleconosco') }}" class="text-sm font-medium leading-normal focus:outline-none hover:text-primary transition-colors py-2">Fale Conosco</a>

        <div class="pt-2 border-t border-gray-200 dark:border-gray-700">
            @auth
            <a href="{{ route('admin.dashboard') }}" class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em] focus:outline-none hover:bg-primary/90 transition-colors">
                <span class="truncate">Acessar Painel</span>
            </a>
            @else
            <a href="{{ route('login') }}" class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary/20 text-primary text-sm font-bold leading-normal tracking-[0.015em] dark:bg-primary/30 dark:text-white focus:outline-none hover:bg-primary/30 transition-colors">
                <span class="truncate">Login</span>
            </a>
            @endauth
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }
    });
</script>