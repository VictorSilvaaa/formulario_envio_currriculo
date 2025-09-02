<?php
namespace App\DTOs;

use App\Models\Curriculo;
use Illuminate\Http\Request;

class CurriculoDTO
{
    public function __construct(
        public string $nome,
        public string $email,
        public string $telefone,
        public string $cargo_desejado,
        public int $escolaridade_id,
        public ?string $observacoes,
        public string $arquivo,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            nome: $request->input('nome'),
            email: $request->input('email'),
            telefone: $request->input('telefone'),
            cargo_desejado: $request->input('cargo_desejado'),
            escolaridade_id: (int) $request->input('escolaridade_id'),
            observacoes: $request->input('observacoes'),
            arquivo: $request->file('arquivo')?->store('curriculos', 'public') ?? ''
        );
    }

    public static function fromModel(Curriculo $curriculo): self
    {
        return new self(
            nome: $curriculo->nome,
            email: $curriculo->email,
            telefone: $curriculo->telefone,
            cargo_desejado: $curriculo->cargo_desejado,
            escolaridade_id: $curriculo->escolaridade_id,
            observacoes: $curriculo->observacoes,
            arquivo: $curriculo->arquivo,
        );
    }
}