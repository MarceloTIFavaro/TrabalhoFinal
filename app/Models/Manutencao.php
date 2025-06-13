<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manutencao extends Model
{
    use HasFactory;

    // Adicione esta linha para especificar o nome da tabela
    protected $table = 'manutencoes'; // <-- CORRIGIDO: Nome da tabela no banco de dados

    protected $fillable = [
        'equipamento_id',
        'data_manutencao',
    ];

    /**
     * Get the equipamento that owns the manutencao.
     */
    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class);
    }
}