<?php
spl_autoload_register(function ($clase) {
    // Autocargador para PhpSpreadsheet
    $prefijoPhpSpreadsheet = 'PhpOffice\\PhpSpreadsheet\\';
    $baseDirPhpSpreadsheet = __DIR__ . '/PhpSpreadsheet/src/PhpSpreadsheet/';

    // Autocargador para PSR SimpleCache
    $prefijoPsr = 'Psr\\SimpleCache\\';
    $baseDirPsr = __DIR__ . '/Psr/SimpleCache/';

    if (strpos($clase, $prefijoPhpSpreadsheet) === 0) {
        $rutaRelativa = str_replace('\\', '/', substr($clase, strlen($prefijoPhpSpreadsheet)));
        $archivo = $baseDirPhpSpreadsheet . $rutaRelativa . '.php';
        if (file_exists($archivo)) {
            require_once $archivo;
        } else {
            echo "NO encontrado PhpSpreadsheet: $archivo<br>";
        }
    } elseif (strpos($clase, $prefijoPsr) === 0) {
        $rutaRelativa = str_replace('\\', '/', substr($clase, strlen($prefijoPsr)));
        $archivo = $baseDirPsr . $rutaRelativa . '.php';
        if (file_exists($archivo)) {
            require_once $archivo;
        } else {
            echo "NO encontrado PSR: $archivo<br>";
        }
    }
});
