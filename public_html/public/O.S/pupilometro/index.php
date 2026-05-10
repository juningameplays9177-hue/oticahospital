<?php
/**
 * Pupilômetro Digital — página autocontida (HTML + CSS no mesmo ficheiro).
 * Servida em: /O.S/pupilometro/index.php (document root = public)
 */
declare(strict_types=1);
header('Content-Type: text/html; charset=utf-8');
?><!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pupilômetro Digital</title>
  <style>
    /* Reset mínimo (sem frameworks) */
    *, *::before, *::after { box-sizing: border-box; }
    html { font-size: 16px; -webkit-text-size-adjust: 100%; }
    body {
      margin: 0;
      min-height: 100vh;
      min-height: 100dvh;
      font-family: system-ui, Segoe UI, Roboto, Arial, sans-serif;
      line-height: 1.5;
      color: #e8eef3;
      background: #0f1419;
    }

    .pagina {
      min-height: 100vh;
      min-height: 100dvh;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 24px 16px 80px;
    }

    .cartao {
      width: 100%;
      max-width: 42rem;
      display: flex;
      flex-direction: column;
      gap: 1.25rem;
    }

    h1 {
      margin: 0;
      text-align: center;
      font-size: 1.75rem;
      font-weight: 700;
      color: #5ee1f0;
    }

    .sub {
      margin: 0;
      text-align: center;
      font-size: 0.95rem;
      color: #9db0c0;
    }

    .bloco-video {
      width: 100%;
      min-height: 16rem;
      border: 2px solid #1eb8d4;
      border-radius: 12px;
      background: #1a1f28;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 1rem;
      text-align: center;
    }

    .bloco-video p {
      margin: 0.35rem 0 0 0;
      font-size: 0.9rem;
      color: #a8bcc9;
    }

    .bloco-video .sim {
      font-size: 0.8rem;
      color: #6d8496;
    }

    .rodape {
      position: fixed;
      left: 0;
      right: 0;
      bottom: 0;
      padding: 12px 16px;
      text-align: center;
      font-size: 0.8rem;
      color: #7a8f9e;
      background: rgba(15, 20, 25, 0.95);
      border-top: 1px solid #2a3642;
    }
  </style>
</head>
<body>
  <div class="pagina">
    <main class="cartao">
      <h1>Pupilômetro Digital</h1>
      <p class="sub">Medição local da distância pupilar (PD)</p>

      <section class="bloco-video" aria-label="Área da câmera">
        <span style="font-size:3rem; line-height:1;" aria-hidden="true">&#128247;</span>
        <p><strong>Área da câmera</strong></p>
        <p class="sim">(simulada nesta página — sem JavaScript adicional no ficheiro)</p>
      </section>
    </main>
  </div>

  <footer class="rodape">
    Processamento 100% local no navegador. Nenhuma imagem é enviada ou armazenada.
  </footer>
</body>
</html>
