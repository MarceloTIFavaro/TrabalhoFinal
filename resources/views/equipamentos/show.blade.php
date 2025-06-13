@php($__pageTitle = 'Detalhes Equipamentos')
@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2>Detalhes do Equipamento: {{ $equipamento->nome }}</h2>
        @auth
            <a href="{{ route('equipamentos.edit', $equipamento->id) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i> Editar
            </a>
        @endauth
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 text-center">
                @if ($equipamento->imagem)
                    <img src="{{ asset('storage/' . $equipamento->imagem) }}" class="img-fluid rounded" alt="{{ $equipamento->nome }}" style="max-width: 250px;">
                @else
                    <p class="text-muted">Nenhuma imagem disponível</p>
                    <i class="fas fa-image fa-5x text-secondary"></i>
                @endif
            </div>
            <div class="col-md-8">
                <p><strong>ID:</strong> {{ $equipamento->id }}</p>
                <p><strong>Nome:</strong> {{ $equipamento->nome }}</p>
                <p><strong>Tipo:</strong> {{ $equipamento->tipo }}</p>
                <p><strong>Fabricante:</strong> {{ $equipamento->fabricante }}</p>
                <p><strong>Data de Aquisição:</strong> {{ \Carbon\Carbon::parse($equipamento->data_aquisicao)->format('d/m/Y') }}</p>
                <p><strong>Criado em:</strong> {{ \Carbon\Carbon::parse($equipamento->created_at)->format('d/m/Y H:i') }}</p>
                <p><strong>Última Atualização:</strong> {{ \Carbon\Carbon::parse($equipamento->updated_at)->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <h3 class="mt-4">Manutenções Relacionadas</h3>
        @auth
        <a href="{{ route('manutencoes.create', ['equipamento_id' => $equipamento->id]) }}" class="btn btn-success btn-sm mb-3">
            <i class="fas fa-plus"></i> Adicionar Manutenção
        </a>
        @endauth

        @if ($equipamento->manutencoes->isEmpty())
            <p>Nenhuma manutenção registrada para este equipamento.</p>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Data da Manutenção</th>
                            @auth
                            <th>Ações</th>
                            @endauth
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($equipamento->manutencoes as $manutencao)
                            <tr>
                                <td>{{ $manutencao->id }}</td>
                                <td>{{ \Carbon\Carbon::parse($manutencao->data_manutencao)->format('d/m/Y') }}</td>
                                @auth
                                <td>
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
                                </td>
                                @endauth
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <a href="{{ route('equipamentos.index') }}" class="btn btn-secondary mt-3">
            <i class="fas fa-arrow-left"></i> Voltar para Equipamentos
        </a>
    </div>
</div>
@endsection