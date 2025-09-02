<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EscolaridadeTipos;

class EscolaridadeTiposSeeder extends Seeder
{
    public function run(): void
    {
        $escolaridades = [
            ['titulo' => 'Fundamental', 'descricao' => 'Ensino Fundamental completo'],
            ['titulo' => 'Médio', 'descricao' => 'Ensino Médio completo'],
            ['titulo' => 'Superior', 'descricao' => 'Ensino Superior completo'],
            ['titulo' => 'Pós-graduação', 'descricao' => 'Pós-graduação completa'],
            ['titulo' => 'Mestrado', 'descricao' => 'Curso de Mestrado completo'],
            ['titulo' => 'Doutorado', 'descricao' => 'Curso de Doutorado completo'],
        ];

        foreach ($escolaridades as $escolaridade) {
            EscolaridadeTipos::updateOrCreate(
                ['titulo' => $escolaridade['titulo']],
                ['descricao' => $escolaridade['descricao']]
            );
        }
    }
}