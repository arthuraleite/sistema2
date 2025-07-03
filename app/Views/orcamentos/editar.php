<?php
$title = 'Editar Orçamento';
$action = BASE_URL . '/orcamentos/atualizar/' . $orcamento['id'];
include 'formulario.php';
?>
<script>
<?php foreach ($itens as $i): ?>
    addItem("<?= addslashes($i['descricao']) ?>", <?= $i['quantidade'] ?>, <?= $i['valor_unitario'] ?>);
<?php endforeach; ?>
</script>
