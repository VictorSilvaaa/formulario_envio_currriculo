<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurriculoStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        if ($this->has('telefone')) {
            $telefoneNumeros = preg_replace('/\D/', '', $this->input('telefone'));
            $this->merge([
                'telefone' => $telefoneNumeros
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email'],
            'telefone' => ['required', 'string', 'digits_between:10,11'],
            'cargo_desejado' => ['required', 'string', 'min:2'],
            'escolaridade_id' => ['required', 'integer', 'exists:escolaridades_tipos,id'],
            'observacoes' => ['nullable', 'string', 'max:500'],
            'arquivo' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:1024'],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.min' => 'O nome deve ter pelo menos :min caracteres.',

            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'Informe um endereço de e-mail válido.',

            'telefone.required' => 'O campo telefone é obrigatório.',
            'telefone.string' => 'O telefone deve ser um texto válido.',
            'telefone.digits_between' => 'O telefone deve conter entre 10 e 11 dígitos (com DDD).',

            'cargo_desejado.required' => 'O campo cargo desejado é obrigatório.',
            'cargo_desejado.min' => 'O cargo desejado deve ter pelo menos :min caracteres.',

            'escolaridade_id.required' => 'O campo escolaridade é obrigatório.',
            'escolaridade_id.integer' => 'O campo escolaridade deve ser um número válido.',
            'escolaridade_id.exists' => 'O tipo de escolaridade selecionado é inválido.',

            'observacoes.string' => 'As observações devem ser um texto válido.',
            'observacoes.max' => 'As observações podem ter no máximo :max caracteres.',

            'arquivo.required' => 'O envio do arquivo é obrigatório.',
            'arquivo.file' => 'O arquivo enviado não é válido.',
            'arquivo.mimes' => 'O arquivo deve estar no formato: :values.',
            'arquivo.max' => 'O arquivo não pode ter mais que :max kilobytes.',
        ];
    }
}