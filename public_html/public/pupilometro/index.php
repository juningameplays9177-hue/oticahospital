<?php
/**
 * Pupilômetro Digital — página autocontida (visual alinhado ao painel Hospital dos Óculos).
 * URL: /pupilometro/index.php
 */
declare(strict_types=1);
header('Content-Type: text/html; charset=utf-8');
header('X-Frame-Options: SAMEORIGIN');
?><!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="color-scheme" content="light">
  <title>Pupilômetro Digital</title>
  <style>
    *, *::before, *::after { box-sizing: border-box; }
    html { font-size: 16px; -webkit-text-size-adjust: 100%; }
    body {
      margin: 0;
      min-height: 100vh;
      min-height: 100dvh;
      font-family: "Inter", system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
      line-height: 1.5;
      color: #0f172a;
      background: linear-gradient(160deg, #f8fafc 0%, #eff6ff 45%, #f1f5f9 100%);
    }

    .pagina {
      min-height: 100vh;
      min-height: 100dvh;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 1.25rem 1rem 5rem;
    }

    .cartao {
      width: 100%;
      max-width: 36rem;
      background: #ffffff;
      border-radius: 1rem;
      border: 1px solid #e2e8f0;
      box-shadow: 0 10px 40px rgba(15, 23, 42, 0.08);
      padding: 1.5rem 1.25rem 1.75rem;
      position: relative;
      overflow: hidden;
    }

    .cartao::before {
      content: "";
      position: absolute;
      left: 0; right: 0; top: 0;
      height: 4px;
      background: linear-gradient(90deg, #2563eb, #3b82f6);
    }

    .selo {
      display: inline-block;
      font-size: 0.7rem;
      font-weight: 600;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      color: #2563eb;
      background: #eff6ff;
      border: 1px solid #bfdbfe;
      padding: 0.25rem 0.6rem;
      border-radius: 999px;
      margin-bottom: 0.75rem;
    }

    h1 {
      margin: 0 0 0.35rem;
      text-align: center;
      font-size: 1.5rem;
      font-weight: 700;
      letter-spacing: -0.02em;
      color: #0f172a;
    }

    .sub {
      margin: 0 0 1.25rem;
      text-align: center;
      font-size: 0.9375rem;
      color: #64748b;
    }

    .bloco-video {
      width: 100%;
      min-height: 14rem;
      border: 2px dashed #cbd5e1;
      border-radius: 0.75rem;
      background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 1.25rem 1rem;
      text-align: center;
    }

    .bloco-video .icone {
      font-size: 2.75rem;
      line-height: 1;
      margin-bottom: 0.5rem;
      filter: grayscale(0.2);
    }

    .bloco-video p {
      margin: 0.25rem 0 0;
      font-size: 0.9rem;
      color: #475569;
    }

    .bloco-video .sim {
      margin-top: 0.5rem;
      font-size: 0.8rem;
      color: #94a3b8;
    }

    .rodape {
      position: fixed;
      left: 0;
      right: 0;
      bottom: 0;
      padding: 0.65rem 1rem;
      text-align: center;
      font-size: 0.75rem;
      color: #64748b;
      background: rgba(255, 255, 255, 0.92);
      backdrop-filter: blur(8px);
      border-top: 1px solid #e2e8f0;
    }
  </style>
</head>
<body>
  <div class="pagina">
    <main class="cartao">
      <div style="text-align:center;">
        <span class="selo">Ordem de Serviço</span>
      </div>
      <h1>Pupilômetro Digital</h1>
      <p class="sub">Medição auxiliar da distância pupilar (PD)</p>

      <section class="bloco-video" aria-label="Área da câmera">
        <span class="icone" aria-hidden="true">&#128247;</span>
        <p><strong style="color:#1e293b;">Área da câmera</strong></p>
        <p class="sim">Placeholder — substitua pelo fluxo com câmera quando integrar o app completo.</p>
      </section>
    </main>
  </div>

  <footer class="rodape">
    Processamento local no navegador. Nenhuma imagem é enviada ao servidor Hospital dos Óculos.
  </footer>
</body>
</html>
