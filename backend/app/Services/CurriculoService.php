<?php
namespace App\Services;

use App\DTOs\CurriculoDTO;
use App\Repositories\CurriculoRepository;
use Illuminate\Support\Facades\Mail;
use App\Mail\CurriculoComprovanteMail;
use App\Models\Curriculo;

class CurriculoService
{
    public function __construct(
        protected CurriculoRepository $repository
    ) {}

    public function salvar(CurriculoDTO $dto): Curriculo
    {
        $curriculo = $this->repository->store($dto);
        return $curriculo;
    }

    public function enviarEmailComprovante(Curriculo $curriculo): void
    {
        Mail::to($curriculo->email)->send(new CurriculoComprovanteMail($curriculo));
    }
}