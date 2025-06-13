@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Você está logado!') }}

                    <p class="mt-3">
                        <a href="{{ route('equipamentos.index') }}" class="btn btn-primary">
                            Ir para Equipamentos
                        </a>
                        <a href="{{ route('manutencoes.index') }}" class="btn btn-info ms-2">
                            Ir para Manutenções
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection