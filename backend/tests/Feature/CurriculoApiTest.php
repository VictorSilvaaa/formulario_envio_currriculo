<?php

namespace Tests\Feature;

use App\Models\EscolaridadeTipos;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CurriculoApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_envio_curriculo_sucesso()
    {   
         $this->seed(\Database\Seeders\EscolaridadeTiposSeeder::class);
        Storage::fake('local');

        $payload = [
            'nome' => 'João Silva',
            'email' => 'joao@email.com',
            'telefone' => '98912345678',
            'cargo_desejado' => 'Desenvolvedor',
            'escolaridade_id' => EscolaridadeTipos::first()?->id ?? 1, // Use o id válido
            'observacoes' => 'Disponível para início imediato',
            'arquivo' => UploadedFile::fake()->create('curriculo.pdf', 100, 'application/pdf'),
        ];

        $response = $this->postJson('/api/curriculos', $payload);

        $response->assertStatus(201)
                 ->assertJson(['message' => 'Currículo enviado com sucesso!']);
    }

    public function test_envio_curriculo_falha_validacao()
    {
        $payload = [
            // Campos obrigatórios ausentes
            'nome' => '',
            'email' => 'emailinvalido',
            'telefone' => '',
            'cargo_desejado' => '',
            'escolaridade' => '',
            'arquivo' => null,
        ];

        $response = $this->postJson('/api/curriculos', $payload);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors([
                     'nome', 'email', 'telefone', 'cargo_desejado', 'escolaridade_id', 'arquivo'
                 ]);
    }
}