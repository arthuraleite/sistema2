<?php
// libs/dompdf/src/Options.php

namespace Dompdf;

class Options {
    private $options = [];

    public function set($key, $value) {
        $this->options[$key] = $value;
    }
}
