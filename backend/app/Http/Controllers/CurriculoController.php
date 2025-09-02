<?php
namespace App\Http\Controllers;

use App\Services\CurriculoService;
use App\DTOs\CurriculoDTO;
use App\Http\Requests\CurriculoStoreRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Exception;

class CurriculoController extends Controller
{
    public function __construct(
        protected CurriculoService $service
    ) {}

    public function store(CurriculoStoreRequest $request): JsonResponse
    {
        try {
            $dto = CurriculoDTO::fromRequest($request);
            $curriculo = $this->service->salvar($dto);
            $this->service->enviarEmailComprovante($curriculo);

            return response()->json(['message' => 'Currículo enviado com sucesso!'], 201);
        } catch (Exception $e) {
            Log::critical('Erro ao enviar currículo: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json([
                'message' => 'Erro ao enviar currículo. Tente novamente mais tarde.'
            ], 500);
        }
    }
}