<?php

namespace Tests\Unit;

use App\Services\CurriculoService;
use App\Repositories\CurriculoRepository;
use App\DTOs\CurriculoDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use App\Mail\CurriculoComprovanteMail;
use App\Models\EscolaridadeTipos;

class CurriculoServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_salvar()
    {   
        $this->seed(\Database\Seeders\EscolaridadeTiposSeeder::class);
        Mail::fake();

        $repo = new CurriculoRepository();
        $service = new CurriculoService($repo);

        $dto = new CurriculoDTO(
            'Ana',
            'ana@email.com',
            '98911223344',
            'Designer',
            EscolaridadeTipos::first()?->id ?? 1,
            'Obs',
            'curriculos/arquivo.pdf',
        );

        $service->salvar($dto);

        $this->assertDatabaseHas('curriculos', [
            'email' => 'ana@email.com',
            'cargo_desejado' => 'Designer'
        ]);
    }
}