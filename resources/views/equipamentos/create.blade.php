@extends('layouts.app') {{-- Garante que o layout principal seja utilizado --}}

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="fas fa-plus-circle"></i> Cadastrar Novo Equipamento</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('equipamentos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf {{-- O CSRF token é essencial para formulários no Laravel --}}
            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome') }}" required>
                @error('nome')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo:</label>
                <input type="text" class="form-control @error('tipo') is-invalid @enderror" id="tipo" name="tipo" value="{{ old('tipo') }}" required>
                @error('tipo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="fabricante" class="form-label">Fabricante:</label>
                <input type="text" class="form-control @error('fabricante') is-invalid @enderror" id="fabricante" name="fabricante" value="{{ old('fabricante') }}" required>
                @error('fabricante')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="data_aquisicao" class="form-label">Data de Aquisição:</label>
                <input type="date" class="form-control @error('data_aquisicao') is-invalid @enderror" id="data_aquisicao" name="data_aquisicao" value="{{ old('data_aquisicao') }}" required>
                @error('data_aquisicao')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="imagem" class="form-label">Imagem do Equipamento:</label>
                <input type="file" class="form-control @error('imagem') is-invalid @enderror" id="imagem" name="imagem">
                @error('imagem')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Cadastrar</button>
            <a href="{{ route('equipamentos.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Voltar</a>
        </form>
    </div>
</div>
@endsection