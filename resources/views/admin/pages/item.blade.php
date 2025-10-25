@extends('admin.dashboard')

@section('content')

<div class="content-wrapper">
    <h1 class="page-title">Gerenciar Estoque</h1>

    <div class="section container">
        <h2 class="section-title">Cadastro de Items</h2>
        <form action="" method="POST" autocomplete="off">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-12">
                    <label class="form-label">Nome do Item</label>
                    <input type="text" name="nome" class="form-input" placeholder="Ex: Arroz 5kg" autocomplete="off" required>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6">
                    <label class="form-label">Categoria</label>
                    <select class="form-select form-select-lg" name="categoria" id="categoria" aria-label="Default select example" required>
                        <option selected>Selecione</option>
                        <option value="1">Alimentos</option>
                        <option value="2">Roupas</option>
                        <option value="3">Itens de Higiene</option>
                    </select>
                </div>
                <div class="col-6">
                    <label class="form-label" for="quantidade">Estoque Mínimo</label>
                    <input type="number" name="quantidade" id="quantidade" class="form-input" value="0" required>
                </div>
            </div>
            <div class="row mt-3 mb-3">
                <div class="col-12">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
    @endsection