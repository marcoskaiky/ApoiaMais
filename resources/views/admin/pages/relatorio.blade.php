@extends('admin.dashboard')

@section('content')

<div class="content-wrapper">
    <h1 class="page-title">Relatórios</h1>

    <div class="section container">

            <h2 class="section-title">Listagem de Operações</h2>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tipo de Operação</th>
                    <th scope="col">Doador</th>
                    <th scope="col">Data</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Doação</td>
                    <td>Mercado São João</td>
                    <td>20/10/2025</td>
                    <td>14:30</td>
                    <td><button class="bg-yellow-500 text-white px-4 py-2 rounded flex items-center gap-2">
                            <x-heroicon-s-pencil-square class="w-5 h-5" />
                        </button></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Saída</td>
                    <td> </td>
                    <td>18/10/2025</td>
                    <td>17:02</td>
                    <td><button class="bg-yellow-500 text-white px-4 py-2 rounded flex items-center gap-2">
                            <x-heroicon-s-pencil-square class="w-5 h-5" />
                        </button></td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Doação</td>
                    <td>Roberto Carlos</td>
                    <td>17/10/2025</td>
                    <td>12:33</td>
                    <td><button class="bg-yellow-500 text-white px-4 py-2 rounded flex items-center gap-2">
                            <x-heroicon-s-pencil-square class="w-5 h-5" />
                        </button></td>
                </tr>
            </tbody>
        </table>

    </div>

    @endsection