<?php
/**
 * Pupilômetro Digital + Dados da Receita (HTML estático dentro da O.S.).
 * Substituí a área simulada da câmera pelo formulário de receita óptica.
 * Servido em: /O.S/pupilometro/index.php (document root = public)
 */
declare(strict_types=1);
header('Content-Type: text/html; charset=utf-8');
?><!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dados da Receita · O.S.</title>
  <style>
    *, *::before, *::after { box-sizing: border-box; }
    html { font-size: 16px; -webkit-text-size-adjust: 100%; }
    body {
      margin: 0;
      min-height: 100vh;
      font-family: system-ui, Segoe UI, Roboto, Arial, sans-serif;
      line-height: 1.45;
      color: #0f172a;
      background: #e8eef5;
      padding: 20px 12px 64px;
    }

    .cartao-receita {
      max-width: 960px;
      margin: 0 auto;
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 8px 28px rgba(15, 23, 42, 0.1);
      padding: 28px 24px 32px;
    }

    .cartao-receita h1 {
      margin: 0 0 22px;
      font-size: 1.35rem;
      font-weight: 700;
      display: flex;
      align-items: center;
      gap: 10px;
      color: #0f172a;
      border-bottom: 1px solid #e2e8f0;
      padding-bottom: 14px;
    }

    .secao-receita { margin-bottom: 22px; }

    .secao-receita h2 {
      margin: 0 0 12px;
      font-size: 1rem;
      font-weight: 800;
      letter-spacing: 0.04em;
      color: #334155;
    }

    /* 5 colunas em ecrãs largos; quebra bem em tablets */
    .grelha-receita {
      display: grid;
      gap: 10px;
      grid-template-columns: repeat(5, minmax(0, 1fr));
    }

    @media (max-width: 720px) {
      .grelha-receita { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }

    .campo {
      display: flex;
      flex-direction: column;
      gap: 4px;
    }

    .campo label {
      font-size: 0.72rem;
      font-weight: 700;
      color: #475569;
    }

    .campo input {
      width: 100%;
      padding: 9px 10px;
      border: 1px solid #cbd5e1;
      border-radius: 10px;
      font-size: 0.875rem;
      background: #fff;
      color: #0f172a;
      transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }

    .campo input:focus {
      outline: none;
      border-color: #2563eb;
      box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.2);
    }

    .campo input::placeholder { color: #94a3b8; font-weight: 500; }

    .linha-olho {
      margin-bottom: 8px;
      font-size: 0.7rem;
      font-weight: 800;
      color: #64748b;
      text-transform: uppercase;
      letter-spacing: 0.06em;
    }

    .fundo-baixo {
      display: grid;
      gap: 14px;
      grid-template-columns: 1fr 1fr;
      margin-top: 8px;
    }

    @media (max-width: 540px) {
      .fundo-baixo { grid-template-columns: 1fr; }
    }

    .rodape {
      position: fixed;
      left: 0;
      right: 0;
      bottom: 0;
      padding: 10px 14px;
      text-align: center;
      font-size: 0.75rem;
      color: #64748b;
      background: rgba(255, 255, 255, 0.92);
      border-top: 1px solid #e2e8f0;
    }
  </style>
</head>
<body>
  <div class="cartao-receita">
    <h1><span aria-hidden="true">👁️</span> DADOS DA RECEITA</h1>

    <form action="#" method="get" autocomplete="off" id="form-receita-os">
      <div class="secao-receita">
        <h2>LONGE</h2>
        <div class="linha-olho">Olho direito (OD)</div>
        <div class="grelha-receita" style="margin-bottom:14px;">
          <div class="campo"><label for="lx_od_esf">OD Esférico</label><input id="lx_od_esf" name="lx_od_esf" placeholder="OD Esférico" type="text"></div>
          <div class="campo"><label for="lx_od_cil">OD Cilíndrico</label><input id="lx_od_cil" name="lx_od_cil" placeholder="OD Cilíndrico" type="text"></div>
          <div class="campo"><label for="lx_od_eixo">OD Eixo</label><input id="lx_od_eixo" name="lx_od_eixo" placeholder="OD Eixo" type="text"></div>
          <div class="campo"><label for="lx_od_alt">OD Altura</label><input id="lx_od_alt" name="lx_od_alt" placeholder="OD Altura" type="text"></div>
          <div class="campo"><label for="lx_od_dnp">OD DNP</label><input id="lx_od_dnp" name="lx_od_dnp" placeholder="OD DNP" type="text"></div>
        </div>
        <div class="linha-olho">Olho esquerdo (OE)</div>
        <div class="grelha-receita">
          <div class="campo"><label for="lx_oe_esf">OE Esférico</label><input id="lx_oe_esf" name="lx_oe_esf" placeholder="OE Esférico" type="text"></div>
          <div class="campo"><label for="lx_oe_cil">OE Cilíndrico</label><input id="lx_oe_cil" name="lx_oe_cil" placeholder="OE Cilíndrico" type="text"></div>
          <div class="campo"><label for="lx_oe_eixo">OE Eixo</label><input id="lx_oe_eixo" name="lx_oe_eixo" placeholder="OE Eixo" type="text"></div>
          <div class="campo"><label for="lx_oe_alt">OE Altura</label><input id="lx_oe_alt" name="lx_oe_alt" placeholder="OE Altura" type="text"></div>
          <div class="campo"><label for="lx_oe_dnp">OE DNP</label><input id="lx_oe_dnp" name="lx_oe_dnp" placeholder="OE DNP" type="text"></div>
        </div>
      </div>

      <div class="secao-receita">
        <h2>PERTO</h2>
        <div class="linha-olho">Olho direito (OD)</div>
        <div class="grelha-receita" style="margin-bottom:14px;">
          <div class="campo"><label for="pt_od_esf">OD Esférico</label><input id="pt_od_esf" name="pt_od_esf" placeholder="OD Esférico" type="text"></div>
          <div class="campo"><label for="pt_od_cil">OD Cilíndrico</label><input id="pt_od_cil" name="pt_od_cil" placeholder="OD Cilíndrico" type="text"></div>
          <div class="campo"><label for="pt_od_eixo">OD Eixo</label><input id="pt_od_eixo" name="pt_od_eixo" placeholder="OD Eixo" type="text"></div>
          <div class="campo"><label for="pt_od_alt">OD Altura</label><input id="pt_od_alt" name="pt_od_alt" placeholder="OD Altura" type="text"></div>
          <div class="campo"><label for="pt_od_dnp">OD DNP</label><input id="pt_od_dnp" name="pt_od_dnp" placeholder="OD DNP" type="text"></div>
        </div>
        <div class="linha-olho">Olho esquerdo (OE)</div>
        <div class="grelha-receita">
          <div class="campo"><label for="pt_oe_esf">OE Esférico</label><input id="pt_oe_esf" name="pt_oe_esf" placeholder="OE Esférico" type="text"></div>
          <div class="campo"><label for="pt_oe_cil">OE Cilíndrico</label><input id="pt_oe_cil" name="pt_oe_cil" placeholder="OE Cilíndrico" type="text"></div>
          <div class="campo"><label for="pt_oe_eixo">OE Eixo</label><input id="pt_oe_eixo" name="pt_oe_eixo" placeholder="OE Eixo" type="text"></div>
          <div class="campo"><label for="pt_oe_alt">OE Altura</label><input id="pt_oe_alt" name="pt_oe_alt" placeholder="OE Altura" type="text"></div>
          <div class="campo"><label for="pt_oe_dnp">OE DNP</label><input id="pt_oe_dnp" name="pt_oe_dnp" placeholder="OE DNP" type="text"></div>
        </div>
      </div>

      <div class="fundo-baixo">
        <div class="campo">
          <label for="adicao">Adição</label>
          <input id="adicao" name="adicao" placeholder="Adição" type="text">
        </div>
        <div class="campo">
          <label for="medico">Médico</label>
          <input id="medico" name="medico" placeholder="Médico" type="text">
        </div>
      </div>
    </form>
  </div>

  <footer class="rodape">
    Rascunho auxiliar na O.S. — use a aba Receita no formulário principal para gravar na base de dados.
  </footer>
  <script>
    (function () {
      var key = 'oticahospital_receita_os_draft';
      var form = document.getElementById('form-receita-os');
      if (!form) return;
      try {
        var raw = localStorage.getItem(key);
        if (raw) {
          var data = JSON.parse(raw);
          Object.keys(data).forEach(function (name) {
            var el = form.elements.namedItem(name);
            if (el && 'value' in el) el.value = data[name];
          });
        }
      } catch (e) {}
      form.addEventListener('input', function () {
        var data = {};
        for (var i = 0; i < form.elements.length; i++) {
          var el = form.elements[i];
          if (el.name && el.type !== 'submit') data[el.name] = el.value;
        }
        try { localStorage.setItem(key, JSON.stringify(data)); } catch (e) {}
      });
    })();
  </script>
</body>
</html>
