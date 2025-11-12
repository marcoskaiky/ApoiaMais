<footer class="bg-white dark:bg-[#1a1a1a]/50">
    <div class="px-4 lg:px-40 flex justify-center py-10">
        <div class="max-w-[960px] w-full flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="flex items-center gap-4 text-[#111418] dark:text-white">
                <div class="size-6 text-primary">
                    <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                        <path d="M42.4379 44C42.4379 44 36.0744 33.9038 41.1692 24C46.8624 12.9336 42.2078 4 42.2078 4L7.01134 4C7.01134 4 11.6577 12.932 5.96912 23.9969C0.876273 33.9029 7.27094 44 7.27094 44L42.4379 44Z" fill="currentColor"></path>
                    </svg>
                </div>
                <a class="text-xl focus:outline-none" href="{{ url('/') }}">Apoia +</a>
            </div>
            <div class="flex gap-6 text-[#60758a] dark:text-gray-300">
                <a class="text-sm focus:outline-none hover:text-primary transition-colors" href="{{ url('/funcionalidades') }}">Funcionalidades</a>
                <a class="text-sm focus:outline-none hover:text-primary transition-colors" href="{{ url('/sobrenos') }}">Sobre Nós</a>
                <a class="text-sm focus:outline-none hover:text-primary transition-colors" href="{{ url('/roadmap') }}">Roadmap do Sistema</a>
                <a class="text-sm focus:outline-none hover:text-primary transition-colors" href="{{ url('/faleconosco') }}">Contato</a>
            </div>
            <p class="text-sm text-gray-500 dark:text-gray-400">© {{ date('Y') }} Apoia+. Todos os direitos reservados.</p>
        </div>
    </div>
</footer>