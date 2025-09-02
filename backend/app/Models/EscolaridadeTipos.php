<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EscolaridadeTipos extends Model
{
    protected $fillable = [
        'titulo',
        'descricao',
    ];

    protected $table = 'escolaridades_tipos';

    public $timestamps = true;
}