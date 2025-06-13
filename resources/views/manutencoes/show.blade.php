@php($__pageTitle = 'Detalhes Manutenção')
@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2>Detalhes da Manutenção</h2>
        @auth
            <a href="{{ route('manutencoes.edit', $manutencao->id) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i> Editar
            </a>
        @endauth
    </div>
    <div class="card-body">
        <p><strong>ID da Manutenção:</strong> {{ $manutencao->id }}</p>
        <p><strong>Equipamento:</strong>
            @if ($manutencao->equipamento)
                <a href="{{ route('equipamentos.show', $manutencao->equipamento->id) }}">
                    {{ $manutencao->equipamento->nome }}
                </a>
            @else
                Equipamento Removido
            @endif
        </p>
        <p><strong>Data da Manutenção:</strong> {{ \Carbon\Carbon::parse($manutencao->data_manutencao)->format('d/m/Y') }}</p>
        <p><strong>Criado em:</strong> {{ \Carbon\Carbon::parse($manutencao->created_at)->format('d/m/Y H:i') }}</p>
        <p><strong>Última Atualização:</strong> {{ \Carbon\Carbon::parse($manutencao->updated_at)->format('d/m/Y H:i') }}</p>

        <a href="{{ route('manutencoes.index') }}" class="btn btn-secondary mt-3">
            <i class="fas fa-arrow-left"></i> Voltar para Manutenções
        </a>
    </div>
</div>
@endsection