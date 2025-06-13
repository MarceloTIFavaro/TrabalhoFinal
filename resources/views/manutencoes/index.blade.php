@php($__pageTitle = 'Equipamentos')
@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2>Lista de Manutenções</h2>
        @auth
            <a href="{{ route('manutencoes.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nova Manutenção
            </a>
        @endauth
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Equipamento</th>
                        <th>Data da Manutenção</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($manutencoes as $manutencao)
                        <tr>
                            <td>{{ $manutencao->id }}</td>
                            <td>
                                @if ($manutencao->equipamento)
                                    <a href="{{ route('equipamentos.show', $manutencao->equipamento->id) }}">
                                        {{ $manutencao->equipamento->nome }}
                                    </a>
                                @else
                                    Equipamento Removido
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($manutencao->data_manutencao)->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('manutencoes.show', $manutencao->id) }}" class="btn btn-info btn-sm" title="Ver Detalhes">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @auth
                                    <a href="{{ route('manutencoes.edit', $manutencao->id) }}" class="btn btn-warning btn-sm" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('manutencoes.destroy', $manutencao->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Tem certeza que deseja excluir esta manutenção?');">
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
                            <td colspan="4" class="text-center">Nenhuma manutenção cadastrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection