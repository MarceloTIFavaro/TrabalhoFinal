@php($__pageTitle = 'Equipamentos')
@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2>Lista de Equipamentos</h2>
        @auth
            <a href="{{ route('equipamentos.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Novo Equipamento
            </a>
        @endauth
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th>Fabricante</th>
                        <th>Data Aquisição</th>
                        <th>Imagem</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($equipamentos as $equipamento)
                        <tr>
                            <td>{{ $equipamento->id }}</td>
                            <td>{{ $equipamento->nome }}</td>
                            <td>{{ $equipamento->tipo }}</td>
                            <td>{{ $equipamento->fabricante }}</td>
                            <td>{{ \Carbon\Carbon::parse($equipamento->data_aquisicao)->format('d/m/Y') }}</td>
                            <td>
                                @if ($equipamento->imagem)
                                    <img src="{{ asset('storage/' . $equipamento->imagem) }}" alt="{{ $equipamento->nome }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('equipamentos.show', $equipamento->id) }}" class="btn btn-info btn-sm" title="Ver Detalhes">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @auth
                                    <a href="{{ route('equipamentos.edit', $equipamento->id) }}" class="btn btn-warning btn-sm" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('equipamentos.destroy', $equipamento->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Tem certeza que deseja excluir este equipamento e todas as suas manutenções?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Excluir">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endauth
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Nenhum equipamento cadastrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection