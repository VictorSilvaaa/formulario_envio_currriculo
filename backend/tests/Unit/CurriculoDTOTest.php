<?php

namespace Tests\Unit;

use App\DTOs\CurriculoDTO;
use App\Models\EscolaridadeTipos;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CurriculoDTOTest extends TestCase
{   
    use RefreshDatabase;
    public function test_dto_instanciacao()
    {   
        $this->seed(\Database\Seeders\EscolaridadeTiposSeeder::class);

        $escolaridade_id = EscolaridadeTipos::first()?->id ?? 1;
        $dto = new CurriculoDTO(
            'João',
            'joao@email.com',
            '98912345678',
            'Dev',
            $escolaridade_id,
            'Obs',
            'curriculos/arquivo.pdf',
        );

        $this->assertEquals('João', $dto->nome);
        $this->assertEquals('Dev', $dto->cargo_desejado);
        $this->assertEquals('98912345678', $dto->telefone);
        $this->assertEquals($escolaridade_id, $dto->escolaridade_id);
        $this->assertEquals('Obs', $dto->observacoes);
        $this->assertEquals('curriculos/arquivo.pdf', $dto->arquivo);
    }
}