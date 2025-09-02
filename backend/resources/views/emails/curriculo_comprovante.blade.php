
<p>Olá {{ $curriculo->nome }},</p>
<p>Seu currículo foi recebido com sucesso!</p>

<table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr style="background: #f5f5f5;">
            <th colspan="2">Comprovante de Envio de Currículo</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><strong>Nome</strong></td>
            <td>{{ $curriculo->nome }}</td>
        </tr>
        <tr>
            <td><strong>E-mail</strong></td>
            <td>{{ $curriculo->email }}</td>
        </tr>
        <tr>
            <td><strong>Telefone</strong></td>
            <td>{{ $curriculo->telefone_formatado ?? $curriculo->telefone }}</td>
        </tr>
        <tr>
            <td><strong>Cargo desejado</strong></td>
            <td>{{ $curriculo->cargo_desejado }}</td>
        </tr>
        <tr>
            <td><strong>Escolaridade</strong></td>
            <td>{{ $curriculo->escolaridadeTipo->nome ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Observações</strong></td>
            <td>{{ $curriculo->observacoes ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Ip:</strong></td>
            <td>{{ $curriculo->ip }}</td>
        </tr>
        <tr>
            <td><strong>Data e hora do envio</strong></td>
            <td>{{ $curriculo->created_at->format('d/m/Y H:i:s') }}</td>
        </tr>
    </tbody>
</table>

<p style="margin-top: 24px;">Obrigado por se candidatar! Em breve entraremos em contato caso seu perfil seja selecionado.</p>