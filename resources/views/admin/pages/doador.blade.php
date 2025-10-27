@extends('admin.dashboard')

@section('content')
    <div class="content-wrapper">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Doadores / Instituições</h1>
        </div>

        <p class="text-muted mb-4">Cadastro de doadores e instituições do sistema.</p>

        <!-- Toast Component -->
        @include('admin.components.toast')

        <!-- Navegação por Abas -->
        <ul class="nav nav-tabs mb-4" id="cadastrosTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="doadores-tab" data-bs-toggle="tab" data-bs-target="#doadores"
                    type="button" role="tab" aria-controls="doadores" aria-selected="true">
                    Doadores
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="instituicoes-tab" data-bs-toggle="tab" data-bs-target="#instituicoes"
                    type="button" role="tab" aria-controls="instituicoes" aria-selected="false">
                    Instituições
                </button>
            </li>
        </ul>

        <div class="tab-content" id="cadastrosTabContent">
            <!-- Aba Doadores -->
            <div class="tab-pane fade show active" id="doadores" role="tabpanel" aria-labelledby="doadores-tab">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Cadastro de Doadores</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.doadores.store') }}" method="POST" autocomplete="off">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label">Tipo de doador</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipo_doador" id="tipo_doador_pf" value="PF" checked onchange="alternarCamposDoador()">
                                        <label class="form-check-label" for="tipo_doador_pf">Pessoa Física</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipo_doador" id="tipo_doador_pj" value="PJ" onchange="alternarCamposDoador()">
                                        <label class="form-check-label" for="tipo_doador_pj">Pessoa Jurídica</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nome</label>
                                    <input type="text" name="nome_doador" class="form-control @error('nome_doador') is-invalid @enderror" placeholder="Ex: João da Silva" autocomplete="off" value="{{ old('nome_doador') }}" required>
                                    @error('nome_doador')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3" id="campo-cpf-doador">
                                    <label class="form-label">CPF</label>
                                    <input type="text" name="cpf_doador" id="cpf_doador" class="form-control @error('cpf_doador') is-invalid @enderror" placeholder="000.000.000-00" autocomplete="off" value="{{ old('cpf_doador') }}">
                                    @error('cpf_doador')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3" id="campo-cnpj-doador" style="display: none;">
                                    <label class="form-label">CNPJ</label>
                                    <input type="text" name="cnpj_doador" id="cnpj_doador" class="form-control @error('cnpj_doador') is-invalid @enderror" placeholder="00.000.000/0000-00" autocomplete="off" value="{{ old('cnpj_doador') }}">
                                    @error('cnpj_doador')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Telefone</label>
                                    <input type="text" name="telefone_doador" class="form-control @error('telefone_doador') is-invalid @enderror" placeholder="(00) 00000-0000" value="{{ old('telefone_doador') }}" required>
                                    @error('telefone_doador')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">CEP</label>
                                    <input type="text" name="cep_doador" id="cep_doador" class="form-control @error('cep_doador') is-invalid @enderror" placeholder="00000-000" value="{{ old('cep_doador') }}" maxlength="9" onblur="buscarCepDoador()">
                                    @error('cep_doador')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted" id="loading_cep_doador" style="display: none;">Buscando CEP...</small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label class="form-label">Rua</label>
                                    <input type="text" name="rua_doador" id="rua_doador" class="form-control @error('rua_doador') is-invalid @enderror" placeholder="Ex: Rua das Flores" value="{{ old('rua_doador') }}">
                                    @error('rua_doador')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Número</label>
                                    <input type="text" name="numero_doador" class="form-control @error('numero_doador') is-invalid @enderror" placeholder="123" value="{{ old('numero_doador') }}">
                                    @error('numero_doador')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Bairro</label>
                                    <input type="text" name="bairro_doador" id="bairro_doador" class="form-control @error('bairro_doador') is-invalid @enderror" placeholder="Ex: Centro" value="{{ old('bairro_doador') }}">
                                    @error('bairro_doador')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Cidade</label>
                                    <input type="text" name="cidade_doador" id="cidade_doador" class="form-control @error('cidade_doador') is-invalid @enderror" placeholder="Ex: São Paulo" value="{{ old('cidade_doador') }}">
                                    @error('cidade_doador')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-2 mb-3">
                                    <label class="form-label">UF</label>
                                    <input type="text" name="uf_doador" id="uf_doador" class="form-control @error('uf_doador') is-invalid @enderror" placeholder="SP" value="{{ old('uf_doador') }}" maxlength="2">
                                    @error('uf_doador')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Complemento</label>
                                    <input type="text" name="complemento_doador" class="form-control @error('complemento_doador') is-invalid @enderror" placeholder="Ex: Apto 101, Bloco A" value="{{ old('complemento_doador') }}">
                                    @error('complemento_doador')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Cadastrar Doador</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Aba Instituições -->
            <div class="tab-pane fade" id="instituicoes" role="tabpanel" aria-labelledby="instituicoes-tab">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Cadastro de Instituições</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.instituicoes.store') }}" method="POST" autocomplete="off">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nome da Instituição</label>
                                    <input type="text" name="nome_instituicao" class="form-control @error('nome_instituicao') is-invalid @enderror" placeholder="Ex: Casa de Apoio São José" autocomplete="off" value="{{ old('nome_instituicao') }}" required>
                                    @error('nome_instituicao')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">CNPJ</label>
                                    <input type="text" name="cnpj_instituicao" class="form-control @error('cnpj_instituicao') is-invalid @enderror" placeholder="00.000.000/0000-00" autocomplete="off" value="{{ old('cnpj_instituicao') }}" required>
                                    @error('cnpj_instituicao')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Telefone</label>
                                    <input type="text" name="telefone_instituicao" class="form-control @error('telefone_instituicao') is-invalid @enderror" placeholder="(00) 00000-0000" value="{{ old('telefone_instituicao') }}" required>
                                    @error('telefone_instituicao')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">CEP</label>
                                    <input type="text" name="cep_instituicao" id="cep_instituicao" class="form-control @error('cep_instituicao') is-invalid @enderror" placeholder="00000-000" value="{{ old('cep_instituicao') }}" maxlength="9" onblur="buscarCepInstituicao()">
                                    @error('cep_instituicao')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted" id="loading_cep_instituicao" style="display: none;">Buscando CEP...</small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label class="form-label">Rua</label>
                                    <input type="text" name="rua_instituicao" id="rua_instituicao" class="form-control @error('rua_instituicao') is-invalid @enderror" placeholder="Ex: Rua das Flores" value="{{ old('rua_instituicao') }}">
                                    @error('rua_instituicao')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Número</label>
                                    <input type="text" name="numero_instituicao" class="form-control @error('numero_instituicao') is-invalid @enderror" placeholder="123" value="{{ old('numero_instituicao') }}">
                                    @error('numero_instituicao')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Bairro</label>
                                    <input type="text" name="bairro_instituicao" id="bairro_instituicao" class="form-control @error('bairro_instituicao') is-invalid @enderror" placeholder="Ex: Centro" value="{{ old('bairro_instituicao') }}">
                                    @error('bairro_instituicao')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Cidade</label>
                                    <input type="text" name="cidade_instituicao" id="cidade_instituicao" class="form-control @error('cidade_instituicao') is-invalid @enderror" placeholder="Ex: São Paulo" value="{{ old('cidade_instituicao') }}">
                                    @error('cidade_instituicao')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-2 mb-3">
                                    <label class="form-label">UF</label>
                                    <input type="text" name="uf_instituicao" id="uf_instituicao" class="form-control @error('uf_instituicao') is-invalid @enderror" placeholder="SP" value="{{ old('uf_instituicao') }}" maxlength="2">
                                    @error('uf_instituicao')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Complemento</label>
                                    <input type="text" name="complemento_instituicao" class="form-control @error('complemento_instituicao') is-invalid @enderror" placeholder="Ex: Sala 201" value="{{ old('complemento_instituicao') }}">
                                    @error('complemento_instituicao')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Cadastrar Instituição</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/doador.js'])
@endpush
