@php($__pageTitle = 'Editar Equipamentos')
@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Editar Equipamento: {{ $equipamento->nome }}</h2>
    </div>
    <div class="card-body">
        <form action="{{ route('equipamentos.update', $equipamento->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- Importante para o método UPDATE --}}
            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $equipamento->nome) }}" required>
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo:</label>
                <input type="text" class="form-control" id="tipo" name="tipo" value="{{ old('tipo', $equipamento->tipo) }}" required>
            </div>
            <div class="mb-3">
                <label for="fabricante" class="form-label">Fabricante:</label>
                <input type="text" class="form-control" id="fabricante" name="fabricante" value="{{ old('fabricante', $equipamento->fabricante) }}" required>
            </div>
            <div class="mb-3">
                <label for="data_aquisicao" class="form-label">Data de Aquisição:</label>
                <input type="date" class="form-control" id="data_aquisicao" name="data_aquisicao" value="{{ old('data_aquisicao', $equipamento->data_aquisicao) }}" required>
            </div>
            <div class="mb-3">
                <label for="imagem" class="form-label">Nova Imagem do Equipamento:</label>
                <input type="file" class="form-control" id="imagem" name="imagem">
                @if ($equipamento->imagem)
                    <small class="form-text text-muted mt-2">
                        Imagem atual: <img src="{{ asset('storage/' . $equipamento->imagem) }}" alt="Imagem atual" style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px;">
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image">
                            <label class="form-check-label" for="remove_image">
                                Remover imagem atual
                            </label>
                        </div>
                    </small>
                @else
                    <small class="form-text text-muted mt-2">Nenhuma imagem atual.</small>
                @endif
            </div>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-sync-alt"></i> Atualizar
            </button>
            <a href="{{ route('equipamentos.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </form>
    </div>
</div>
@endsection