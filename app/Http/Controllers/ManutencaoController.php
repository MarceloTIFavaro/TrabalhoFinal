<?php

namespace App\Http\Controllers;

use App\Models\Manutencao;
use App\Models\Equipamento; // Precisamos do modelo Equipamento
use Illuminate\Http\Request;

class ManutencaoController extends Controller
{
    public function __construct()
    {
        // Aplica o middleware 'auth' para todas as operações exceto 'index' e 'show'.
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Para listar todas as manutenções, incluindo o nome do equipamento
        $manutencoes = Manutencao::with('equipamento')->get();
        return view('manutencoes.index', compact('manutencoes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Passa todos os equipamentos para o formulário de criação de manutenção
        $equipamentos = Equipamento::all();
        return view('manutencoes.create', compact('equipamentos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'equipamento_id' => 'required|exists:equipamentos,id', // Garante que o equipamento_id exista
            'data_manutencao' => 'required|date',
        ]);

        Manutencao::create($request->all());

        return redirect()->route('manutencoes.index')->with('success', 'Manutenção cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Manutencao $manutencao)
    {
        // Carrega o equipamento relacionado à manutenção
        $manutencao->load('equipamento');
        return view('manutencoes.show', compact('manutencao'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Manutencao $manutencao)
    {
        $equipamentos = Equipamento::all(); // Para permitir a mudança de equipamento
        return view('manutencoes.edit', compact('manutencao', 'equipamentos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Manutencao $manutencao)
    {
        $request->validate([
            'equipamento_id' => 'required|exists:equipamentos,id',
            'data_manutencao' => 'required|date',
        ]);

        $manutencao->update($request->all());

        return redirect()->route('manutencoes.index')->with('success', 'Manutenção atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manutencao $manutencao)
    {
        $manutencao->delete();

        return redirect()->route('manutencoes.index')->with('success', 'Manutenção excluída com sucesso!');
    }
}