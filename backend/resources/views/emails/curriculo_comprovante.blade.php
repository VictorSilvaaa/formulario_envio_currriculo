<p>Olá {{ $curriculo->nome }},</p>
<p>Seu currículo foi recebido com sucesso!</p>
<ul>
    <li><strong>Cargo desejado:</strong> {{ $curriculo->cargo_desejado }}</li>
    <li><strong>Data e hora do envio:</strong> {{ $curriculo->created_at->format('d/m/Y H:i:s') }}</li>
</ul>
<p>Obrigado!</p>