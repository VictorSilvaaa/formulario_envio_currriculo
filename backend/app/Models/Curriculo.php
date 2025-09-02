<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curriculo extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'cargo_desejado',
        'escolaridade_id',
        'arquivo',
        'observacoes',
    ];

    protected $table = 'curriculos';

    public $timestamps = true;

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function escolaridade()
    {
        return $this->belongsTo(EscolaridadeTipos::class, 'escolaridade_id');
    }

    public function getTelefoneFormatadoAttribute()
    {
        $valor = preg_replace('/\D/', '', $this->telefone);
        if (strlen($valor) === 11) {
            return sprintf('(%s) %s-%s',
                substr($valor, 0, 2),
                substr($valor, 2, 5),
                substr($valor, 7, 4)
            );
        } elseif (strlen($valor) === 10) {
            return sprintf('(%s) %s-%s',
                substr($valor, 0, 2),
                substr($valor, 2, 4),
                substr($valor, 6, 4)
            );
        }
        return $this->telefone;
    }
}