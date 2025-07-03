<?php
function render($view, $data = [], $layout = true) {
    extract($data);
    if ($layout) {
        ob_start();
        include __DIR__ . '/../Views/' . $view . '.php';
        $content = ob_get_clean();
        include __DIR__ . '/../Views/layout.php';
    } else {
        include __DIR__ . '/../Views/' . $view . '.php';
    }
}
