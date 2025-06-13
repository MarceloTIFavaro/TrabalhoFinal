@php($__pageTitle = 'Editar Manutenção')
@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Editar Manutenção</h2>
    </div>
    <div class="card-body">
        <form action="{{ route('manutencoes.update', $manutencao->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Importante para o método UPDATE --}}
            <div class="mb-3">
                <label for="equipamento_id" class="form-label">Equipamento:</label>
                <select class="form-control" id="equipamento_id" name="equipamento_id" required>
                    <option value="">Selecione um Equipamento</option>
                    @foreach ($equipamentos as $equipamento)
                        <option value="{{ $equipamento->id }}" {{ old('equipamento_id', $manutencao->equipamento_id) == $equipamento->id ? 'selected' : '' }}>
                            {{ $equipamento->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="data_manutencao" class="form-label">Data da Manutenção:</label>
                <input type="date" class="form-control" id="data_manutencao" name="data_manutencao" value="{{ old('data_manutencao', $manutencao->data_manutencao) }}" required>
            </div>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-sync-alt"></i> Atualizar
            </button>
            <a href="{{ route('manutencoes.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </form>
    </div>
</div>
@endsection