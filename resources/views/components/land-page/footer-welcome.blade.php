<footer class="bg-white dark:bg-[#1a1a1a]/50">
    <div class="px-4 lg:px-40 flex justify-center py-10">
        <div class="max-w-[960px] w-full flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="flex items-center gap-4 text-[#111418] dark:text-white font-bold">
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