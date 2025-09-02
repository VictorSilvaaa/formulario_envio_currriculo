<?php

namespace App\Http\Controllers;

use App\Models\EscolaridadeTipos;
use Illuminate\Http\JsonResponse;

class EscolaridadeTiposController extends Controller
{
    public function index(): JsonResponse
    {
        $tipos = EscolaridadeTipos::all();
        return response()->json($tipos);
    }
}
