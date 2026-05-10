<?php
declare(strict_types=1);

/*
 * Caminho legado do pupilômetro dentro de /O.S/pupilometro/.
 * Mantém compatibilidade com links antigos, mas executa a versão PHP única.
 */
$pupilometro = dirname(__DIR__, 2) . '/pupilometro-digital/index.php';

if (!is_file($pupilometro)) {
    http_response_code(404);
    header('Content-Type: text/plain; charset=utf-8');
    echo 'Pupilômetro Digital não encontrado.';
    exit;
}

require $pupilometro;
