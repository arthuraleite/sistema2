<?php
include '../app/Views/pedidos/novo.php';
?>
<script>
<?php foreach ($itens as $i): ?>
    addItem("<?= addslashes($i['descricao']) ?>", <?= $i['quantidade'] ?>, <?= $i['valor_unitario'] ?>);
<?php endforeach; ?>
document.querySelector('textarea[name="observacoes"]').value = `Convertido do orçamento #<?= $orcamento['id'] ?>\n\n<?= addslashes($orcamento['observacoes']) ?>`;
</script>
