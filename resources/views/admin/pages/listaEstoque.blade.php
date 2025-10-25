@extends('admin.dashboard')

@section('content')

<div class="content-wrapper">
    <h1 class="page-title">Estoque</h1>

    <div class="section container">

            <h2 class="section-title">Listagem de Itens</h2>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Estoque</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Arroz 5kg</td>
                    <td>Alimentos Não Perecíveis</td>
                    <td>10</td>
                    <td><button class="bg-yellow-500 text-white px-4 py-2 rounded flex items-center gap-2">
                            <x-heroicon-s-pencil-square class="w-5 h-5" />
                        </button></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Garrafa de Água 2L</td>
                    <td>Bebida</td>
                    <td>15</td>
                    <td><button class="bg-yellow-500 text-white px-4 py-2 rounded flex items-center gap-2">
                            <x-heroicon-s-pencil-square class="w-5 h-5" />
                        </button></td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Feijão 1kg</td>
                    <td>Alimentos Não Perecíveis</td>
                    <td>20</td>
                    <td><button class="bg-yellow-500 text-white px-4 py-2 rounded flex items-center gap-2">
                            <x-heroicon-s-pencil-square class="w-5 h-5" />
                        </button></td>
                </tr>
            </tbody>
        </table>

    </div>

    @endsection