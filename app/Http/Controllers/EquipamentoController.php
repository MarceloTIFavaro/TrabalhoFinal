<?php

namespace App\Http\Controllers;

use App\Models\Equipamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Para manipulação de arquivos

class EquipamentoController extends Controller
{
    public function __construct()
    {
        // Aplica o middleware 'auth' para todas as operações exceto 'index' e 'show'.
        // Isso garante que apenas usuários autenticados possam Inserir, Alterar e Excluir.
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Exibe uma listagem de todos os recursos (equipamentos).
     */
    public function index()
    {
        $equipamentos = Equipamento::all(); // Ou Equipamento::paginate(10); para paginação
        return view('equipamentos.index', [
            'equipamentos' => $equipamentos,
            'title' => 'Lista de Equipamentos', // Título para a tag <title>
            'navbarTitle' => 'Equipamentos'     // Título para o navbar-brand
        ]);
    }

    /**
     * Mostra o formulário para criar um novo recurso.
     */
    public function create()
    {
        // Certifique-se de que a view 'equipamentos.create' existe em 'resources/views/equipamentos/create.blade.php'
        return view('equipamentos.create', [
            'title' => 'Cadastrar Novo Equipamento',
            'navbarTitle' => 'Novo Equipamento'
        ]);
    }

    /**
     * Armazena um recurso recém-criado no armazenamento.
     */
    public function store(Request $request)
    {
        // Validação dos dados de entrada
        $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'fabricante' => 'required|string|max:255',
            'data_aquisicao' => 'required|date',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validação para imagens
        ]);

        $imagePath = null;
        // Se uma imagem foi enviada, armazena-a no disco 'public'
        if ($request->hasFile('imagem')) {
            $imagePath = $request->file('imagem')->store('equipamento_images', 'public');
        }

        // Cria um novo registro de equipamento
        Equipamento::create([
            'nome' => $request->nome,
            'tipo' => $request->tipo,
            'fabricante' => $request->fabricante,
            'data_aquisicao' => $request->data_aquisicao,
            'imagem' => $imagePath,
        ]);

        return redirect()->route('equipamentos.index')->with('success', 'Equipamento cadastrado com sucesso!');
    }

    /**
     * Exibe o recurso especificado (um único equipamento).
     */
    public function show(Equipamento $equipamento)
    {
        // Carrega as manutenções relacionadas ao equipamento
        $equipamento->load('manutencoes');
        return view('equipamentos.show', [
            'equipamento' => $equipamento,
            'title' => 'Detalhes do Equipamento: ' . $equipamento->nome,
            'navbarTitle' => 'Equipamentos'
        ]);
    }

    /**
     * Mostra o formulário para editar o recurso especificado.
     */
    public function edit(Equipamento $equipamento)
    {
        return view('equipamentos.edit', [
            'equipamento' => $equipamento,
            'title' => 'Editar Equipamento: ' . $equipamento->nome,
            'navbarTitle' => 'Equipamentos'
        ]);
    }

    /**
     * Atualiza o recurso especificado no armazenamento.
     */
    public function update(Request $request, Equipamento $equipamento)
    {
        // Validação dos dados de entrada
        $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'fabricante' => 'required|string|max:255',
            'data_aquisicao' => 'required|date',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $equipamento->imagem; // Mantém o caminho da imagem existente por padrão

        // Se uma nova imagem foi enviada
        if ($request->hasFile('imagem')) {
            // Se houver uma imagem antiga, a deleta
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            // Armazena a nova imagem
            $imagePath = $request->file('imagem')->store('equipamento_images', 'public');
        } elseif ($request->boolean('remove_image')) { // Opção para remover a imagem (se você tiver um checkbox no form)
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
                $imagePath = null;
            }
        }

        // Atualiza os dados do equipamento
        $equipamento->update([
            'nome' => $request->nome,
            'tipo' => $request->tipo,
            'fabricante' => $request->fabricante,
            'data_aquisicao' => $request->data_aquisicao,
            'imagem' => $imagePath, // Atualiza com o novo caminho ou null
        ]);

        return redirect()->route('equipamentos.index')->with('success', 'Equipamento atualizado com sucesso!');
    }

    /**
     * Remove o recurso especificado do armazenamento.
     */
    public function destroy(Equipamento $equipamento)
    {
        // Antes de deletar o equipamento, se houver uma imagem, a deleta do armazenamento
        if ($equipamento->imagem) {
            Storage::disk('public')->delete($equipamento->imagem);
        }

        $equipamento->delete(); // Isso também deletará as manutenções relacionadas devido ao onDelete('cascade')

        return redirect()->route('equipamentos.index')->with('success', 'Equipamento excluído com sucesso!');
    }
}