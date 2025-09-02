<?php

namespace Tests\Unit;

use App\Repositories\CurriculoRepository;
use App\DTOs\CurriculoDTO;
use App\Models\EscolaridadeTipos;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CurriculoRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_curriculo()
    {
        $this->seed(\Database\Seeders\EscolaridadeTiposSeeder::class);
        $escolaridade_id = EscolaridadeTipos::first()?->id ?? 1;

        $repo = new CurriculoRepository();
        $dto = new CurriculoDTO(
            'Maria',
            'maria@email.com',
            '98987654321',
            'QA',
            $escolaridade_id,
            null,
            'curriculos/arquivo.docx'
        );

        $curriculo = $repo->store($dto);

        $this->assertDatabaseHas('curriculos', [
            'nome' => 'Maria',
            'email' => 'maria@email.com',
            'cargo_desejado' => 'QA',
            'escolaridade_id' => $escolaridade_id,
            'telefone' => '98987654321',
        ]);
        $this->assertEquals('curriculos/arquivo.docx', $curriculo->arquivo);
    }
}