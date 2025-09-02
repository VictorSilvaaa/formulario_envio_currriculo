<?php
namespace App\Repositories;

use App\DTOs\CurriculoDTO;
use App\Models\Curriculo;

class CurriculoRepository
{
    public function store(CurriculoDTO $dto): Curriculo
    {
        return Curriculo::create([
            'nome' => $dto->nome,
            'ip' => $dto->ip,
            'email' => $dto->email,
            'telefone' => $dto->telefone,
            'cargo_desejado' => $dto->cargo_desejado,
            'escolaridade_id' => $dto->escolaridade_id,
            'arquivo' => $dto->arquivo,
            'observacoes' => $dto->observacoes,
        ]);
    }
}