<?php
require_once '../libs/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isHtml5ParserEnabled', true);

$dompdf = new Dompdf($options);

$html = "
    <h2>Orçamento #{$orcamento['id']}</h2>
    <p><strong>Cliente:</strong> {$orcamento['cliente_nome']}</p>
    <p><strong>Contato:</strong> {$orcamento['cliente_contato']}</p>
    <p><strong>Data:</strong> " . date('d/m/Y', strtotime($orcamento['data'])) . "</p>
    <p><strong>Validade:</strong> " . date('d/m/Y', strtotime($orcamento['validade'])) . "</p>

    <table border='1' cellpadding='5' cellspacing='0' width='100%'>
        <thead>
            <tr>
                <th>Descrição</th>
                <th>Qtd</th>
                <th>Valor Unitário</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>";

foreach ($itens as $i) {
    $html .= "<tr>
        <td>{$i['descricao']}</td>
        <td>{$i['quantidade']}</td>
        <td>R$ " . number_format($i['valor_unitario'], 2, ',', '.') . "</td>
        <td>R$ " . number_format($i['subtotal'], 2, ',', '.') . "</td>
    </tr>";
}

$html .= "</tbody>
    </table>
    <h4>Total: R$ " . number_format($orcamento['total'], 2, ',', '.') . "</h4>
    <p><strong>Observações:</strong><br>" . nl2br($orcamento['observacoes']) . "</p>
";

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("orcamento_{$orcamento['id']}.pdf", ["Attachment" => false]);
