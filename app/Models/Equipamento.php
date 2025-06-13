<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipamento extends Model
{
    use HasFactory;

    // Define os campos que podem ser preenchidos em massa
    protected $fillable = [
        'nome',
        'tipo',
        'fabricante',
        'data_aquisicao',
        'imagem',
    ];

    /**
     * Obtém as manutenções para este equipamento.
     * Define a relação 1 para N (Um Equipamento tem muitas Manutenções).
     */
    public function manutencoes()
    {
        return $this->hasMany(Manutencao::class);
    }
}