@extends('admin.dashboard')

@section('content')

<div class="content-wrapper">
    <h1 class="page-title">Gerenciar Doadores</h1>

    <div class="section container">
        <h2 class="section-title">Cadastro de Doadores</h2>
        <form action="" method="POST" autocomplete="off">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-12">
                    <label for="tipo" class="form-label pe-2">Tipo de doador</label>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="tipo1">Pessoa Física</label>
                        <input class="form-check-input" type="radio" name="tipo" id="tipo1" value="PF" checked onchange="alternarCampos()">
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="tipo2">Pessoa Jurídica</label>
                        <input class="form-check-input" type="radio" name="tipo" id="tipo2" value="PJ" onchange="alternarCampos()">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <label class="form-label">Nome</label>
                    <input type="text" name="nome" class="form-input" placeholder="Ex: João da Silva" autocomplete="off" required>
                </div>
                <div class="col-6" id="campo-cpf">
                    <label class="form-label">CPF</label>
                    <input type="text" name="cpf" id="cpf" class="form-input" placeholder="Ex: 000.000.000-00" autocomplete="off">
                </div>
                <div class="col-6" id="campo-cnpj" style="display: none;">
                    <label class="form-label">CNPJ</label>
                    <input type="text" name="cnpj" id="cnpj" class="form-input" placeholder="Ex: 00.000.000/0000-00" autocomplete="off">
                </div>
            </div>
            <div class="row mt-3 mb-3">
                <div class="col-6">
                    <label class="form-label" for="telefone">Telefone</label>
                    <input type="phone" name="telefone" id="telefone" class="form-input" placeholder="Ex: (00) 00000-0000" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>

    <script>
        function alternarCampos() {
            const tipo = document.querySelector('input[name="tipo"]:checked').value;
            const campoCpf = document.getElementById('campo-cpf');
            const campoCnpj = document.getElementById('campo-cnpj');

            if (tipo === 'PF') {
                campoCpf.style.display = 'block';
                campoCnpj.style.display = 'none';
                document.getElementById('cnpj').value = ''; // limpa o campo
            } else {
                campoCpf.style.display = 'none';
                campoCnpj.style.display = 'block';
                document.getElementById('cpf').value = '';
            }
        }
    </script>
    @endsection