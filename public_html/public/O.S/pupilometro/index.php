<?php
/**
 * Legado: mesmo path público aponta para o pupilômetro Next em /pupilometro/
 */
declare(strict_types=1);
header('Location: /pupilometro/', true, 302);
exit;
