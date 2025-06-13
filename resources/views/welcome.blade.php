@extends('layouts.app')

@section('content')
    {{-- HERO SECTION COM CONTRASTE --}}
    <section class="py-5" style="background: linear-gradient(to right, #1e3c72, #2a5298); color: white;">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-3">Bem-vindo ao Sistema de Manutenção</h1>
            <p class="lead mb-4">
                Gerencie seus equipamentos e mantenha um histórico completo de suas manutenções.
                Explore as seções de Equipamentos e Manutenções para começar!
            </p>
            <div class="d-flex flex-column flex-sm-row justify-content-center gap-3 mt-4">
                <a href="{{ route('equipamentos.index') }}"
                class="btn custom-transparent-btn btn-lg px-4">
                    <i class="fas fa-desktop me-2"></i> Ver Equipamentos
                </a>
                <a href="{{ route('manutencoes.index') }}"
                class="btn custom-transparent-btn btn-lg px-4">
                    <i class="fas fa-wrench me-2"></i> Ver Manutenções
                </a>
            </div>
            <style>
                .custom-transparent-btn {
                    background-color: transparent;
                    color: #ffffff;
                    border: 2px solid #ffffff;
                    transition: all 0.3s ease;
                }
                .custom-transparent-btn:hover {
                    background-color: #ffffff;
                    color: #1e3c72;
                    border-color: #ffffff;
                }
            </style>
        </div>
    </section>

    {{-- FEATURES COM LEVE SOMBRA E FUNDO DIFERENCIADO --}}
    <section class="py-5" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-4 h-100 shadow rounded bg-white">
                        <h3 class="text-primary"><i class="fas fa-cogs me-2"></i>Controle Total</h3>
                        <p class="mb-0">Mantenha um registro detalhado de cada equipamento e suas manutenções programadas ou realizadas.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 h-100 shadow rounded bg-white">
                        <h3 class="text-secondary"><i class="fas fa-history me-2"></i>Histórico Completo</h3>
                        <p class="mb-0">Acesse o histórico de cada manutenção e visualize informações importantes sobre seus equipamentos.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
