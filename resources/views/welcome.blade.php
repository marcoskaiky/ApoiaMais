<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apoia+ | Transforme a Gestão de Doações</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/home.css'])
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand" href="#">Apoia+</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Funcionalidades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Documentos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Conhecer Apoia+</a>
                    </li>
                </ul>
                <div class="d-flex">
                    @auth
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Acessar Painel</a>
                    @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="container">
            <h1>Transforme a Gestão de Doações. Amplifique seu Impacto.</h1>
            <p>Apoia+ é a plataforma completa para otimizar seu estoque e impulsionar suas campanhas de arrecadação, tudo em uma interface intuitiva de usar que gera impacto.</p>
            <a href="#" class="btn btn-primary">Comece a Usar Gratuitamente</a>
        </div>
    </section>

    <section class="features-section">
        <div class="container">
            <h2>Funcionalidades Pensadas para sua Organização</h2>
            <p>Descubra como o Apoia+ pode simplificar a gestão de doações e potencializar o alcance das suas campanhas.</p>

            <div class="row">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <h3>Controle de Estoque Inteligente</h3>
                        <p>Gerencie entradas, saídas e níveis de estoque em tempo real. Tenha visibilidade total e evite desperdícios.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-megaphone"></i>
                        </div>
                        <h3>Criação de Campanhas Simplificada</h3>
                        <p>Crie e gerencie campanhas de arrecadação específicas em minutos. Organize por categorias e acompanhe o progresso.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <h3>Relatórios de Impacto</h3>
                        <p>Visualize métricas e indicadores relevantes sobre suas doações. Entenda onde está o seu impacto e como melhorá-lo.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="how-it-works">
        <div class="container">
            <h2>Como Funciona</h2>

            <div class="step">
                <div class="step-number">1</div>
                <div class="step-content">
                    <h3>Cadastre-se na Plataforma</h3>
                    <p>Crie sua conta gratuitamente em poucos minutos e tenha acesso a todas as nossas ferramentas.</p>
                </div>
            </div>

            <div class="step">
                <div class="step-number">2</div>
                <div class="step-content">
                    <h3>Organize seu Estoque</h3>
                    <p>Importe os estoques existentes, categorize os itens e tenha visão clara do seu inventário.</p>
                </div>
            </div>

            <div class="step">
                <div class="step-number">3</div>
                <div class="step-content">
                    <h3>Crie sua Campanha</h3>
                    <p>Lance campanhas de arrecadação, defina metas e compartilhe com sua rede de apoiadores.</p>
                </div>
            </div>

            <div class="step">
                <div class="step-number">4</div>
                <div class="step-content">
                    <h3>Meça seu impacto</h3>
                    <p>Acompanhe os resultados em tempo real e gere relatórios para demonstrar o impacto social do seu trabalho.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonials">
        <div class="container">
            <h2>O que nossos parceiros dizem</h2>
            <p class="lead">Organizações que confiam no Apoia+ para potencializar suas doações.</p>

            <div class="row">
                <div class="col-md-6">
                    <div class="testimonial-card">
                        <img src="{{ asset('images/avatar1.jpg') }}" alt="Maria Silva" class="testimonial-avatar">
                        <h4>Maria Silva</h4>
                        <p class="text-muted">Diretora da ONG Novos Trilhos</p>
                        <p>"O Apoia+ revolucionou nossa gestão de doações. A plataforma é intuitiva e os relatórios de impacto nos ajudaram a demonstrar nosso trabalho aos doadores. Certamente muito mais aplicável."</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="testimonial-card">
                        <img src="{{ asset('images/avatar2.jpg') }}" alt="João Pereira" class="testimonial-avatar">
                        <h4>João Pereira</h4>
                        <p class="text-muted">Coordenador do Projeto Mão Amiga</p>
                        <p>"Criar campanhas de arrecadação ficou muito mais fácil e eficaz. Conseguimos sugerir itens específicos que realmente precisamos e acompanhar nossa meta com o Apoia+."</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <h2>Pronto para transformar sua organização?</h2>
            <p>Junte-se às centenas de organizações que já estão otimizando suas operações e ampliando seu impacto com o Apoia+.</p>
            <a href="#" class="btn btn-primary">Comece a Usar Gratuitamente</a>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-brand mb-4">
                <a href="#" class="text-decoration-none">
                    <span class="h5 text-primary">Apoia+</span>
                </a>
            </div>

            <div class="footer-links">
                <a href="#">Termos de Serviço</a>
                <a href="#">Política de Privacidade</a>
                <a href="#">Contato</a>
            </div>

            <p class="text-muted">&copy; {{ date('Y') }} Apoia+. Todos os direitos reservados.</p>
        </div>
    </footer>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>