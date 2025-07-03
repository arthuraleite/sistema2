<?php include 'formulario.php'; ?>
<script>
    <?php foreach ($itens as $i): ?>
        addItem("<?= addslashes($i['descricao']) ?>", <?= $i['quantidade'] ?>, <?= $i['valor_unitario'] ?>);
    <?php endforeach; ?>
</script>
