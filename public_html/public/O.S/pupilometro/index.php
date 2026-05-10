<?php
/**
 * Encaminha para o pupilômetro principal em /pupilometro/index.php (uma única cópia).
 */
declare(strict_types=1);
$main = realpath(__DIR__ . '/../../pupilometro/index.php');
if ($main !== false && is_readable($main)) {
    require $main;
    return;
}
http_response_code(503);
header('Content-Type: text/plain; charset=utf-8');
echo 'Pupilômetro indisponível: arquivo public/pupilometro/index.php não encontrado.';
