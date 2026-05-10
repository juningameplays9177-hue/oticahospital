{{-- Fragmento: pupilômetro na mesma página (evita iframe, cache ou ficheiros public em falta) --}}
@php($pupiloId = $pupiloId ?? 'pupilo-' . uniqid())

<div id="{{ $pupiloId }}" class="pupilo-scope-root" style="margin: 0;font-family: system-ui, Segoe UI, Roboto, Arial, sans-serif; line-height: 1.5; color: #e8eef3; background: #0f1419; border-radius: 0 0 12px 12px;">
    <style>
        #{{ $pupiloId }}.pupilo-scope-root *,
        #{{ $pupiloId }}.pupilo-scope-root *::before,
        #{{ $pupiloId }}.pupilo-scope-root *::after { box-sizing: border-box; }

        #{{ $pupiloId }}.pupilo-scope-root .pup-wrap {
            max-width: 42rem;
            margin: 0 auto;
            padding: 20px 16px 28px;
            display: flex;
            flex-direction: column;
            gap: 1.1rem;
        }
        #{{ $pupiloId }}.pupilo-scope-root h3.pup-t {
            margin: 0;
            text-align: center;
            font-size: 1.55rem;
            font-weight: 800;
            color: #5ee1f0;
        }
        #{{ $pupiloId }}.pupilo-scope-root .p-sub {
            margin: 0;
            text-align: center;
            font-size: 0.92rem;
            color: #9db0c0;
        }
        #{{ $pupiloId }}.pupilo-scope-root .aviso {
            font-size: 0.82rem;
            color: #86a0b3;
            background: #1a2430;
            border: 1px solid #2a3b4a;
            border-radius: 10px;
            padding: 10px 12px;
        }
        #{{ $pupiloId }}.pupilo-scope-root .bloco-video {
            width: 100%;
            aspect-ratio: 4/3;
            max-height: 360px;
            border: 2px solid #1eb8d4;
            border-radius: 12px;
            background: #1a1f28;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        #{{ $pupiloId }}.pupilo-scope-root .bloco-video video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        #{{ $pupiloId }}.pupilo-scope-root .sem-cam {
            text-align: center;
            padding: 1rem;
            color: #a8bcc9;
        }
        #{{ $pupiloId }}.pupilo-scope-root .acoes {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            justify-content: center;
        }
        #{{ $pupiloId }}.pupilo-scope-root button[type="button"].p-btn {
            cursor: pointer;
            font: inherit;
            font-weight: 700;
            font-size: 0.88rem;
            padding: 10px 18px;
            border-radius: 10px;
            border: none;
        }
        #{{ $pupiloId }}.pupilo-scope-root .btn-cyan {
            background: linear-gradient(180deg, #1eb8d4, #1699b0);
            color: #081016;
        }
        #{{ $pupiloId }}.pupilo-scope-root .btn-muted {
            background: #2a3644;
            color: #e8eef3;
            border: 1px solid #3d4d60;
        }
        #{{ $pupiloId }}.pupilo-scope-root .btn-accent {
            background: linear-gradient(180deg, #22c55e, #16a34a);
            color: #052e16;
        }
        #{{ $pupiloId }}.pupilo-scope-root .grid-pd {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        @media (max-width: 480px) {
            #{{ $pupiloId }}.pupilo-scope-root .grid-pd { grid-template-columns: 1fr; }
        }
        #{{ $pupiloId }}.pupilo-scope-root label.p-lab {
            display: block;
            font-size: 0.72rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #89a6bb;
            margin-bottom: 4px;
        }
        #{{ $pupiloId }}.pupilo-scope-root input.mm {
            width: 100%;
            padding: 10px 11px;
            border-radius: 10px;
            border: 1px solid #344a5e;
            background: #161c24;
            color: #f1f5f9;
            font-size: 1rem;
        }
        #{{ $pupiloId }}.pupilo-scope-root input.mm:focus {
            outline: none;
            border-color: #1eb8d4;
            box-shadow: 0 0 0 2px rgba(30, 184, 212, 0.25);
        }
        #{{ $pupiloId }}.pupilo-scope-root .painel {
            background: #151b24;
            border: 1px solid #263241;
            border-radius: 12px;
            padding: 14px;
        }
        #{{ $pupiloId }}.pupilo-scope-root .p-footer {
            text-align: center;
            font-size: 0.75rem;
            color: #7a8f9e;
            padding: 10px;
            margin-top: 6px;
            border-top: 1px solid #2a3642;
        }
        #{{ $pupiloId }}.pupilo-scope-root .status-erro { color: #fda4af; font-size: 0.85rem; text-align: center; }
    </style>

    <div class="pup-wrap">
        <h3 class="pup-t">Pupilômetro Digital</h3>
        <p class="p-sub">Pré-visualização da câmera e registo da distância pupilar (DP total e DNP por olho).</p>
        <p class="aviso">Os valores são tratados neste navegador. Use o botão verde para preencher os campos <strong>DNP</strong> ocultos da receita antes de finalizar.</p>

        <section class="bloco-video" aria-label="Pré-visualização da câmera">
            <video id="{{ $pupiloId }}__video" playsinline autoplay muted hidden></video>
            <div id="{{ $pupiloId }}__semCam" class="sem-cam" hidden>
                <span style="font-size:3rem;line-height:1" aria-hidden="true">📷</span>
                <p><strong>Câmera não ativa</strong></p>
                <p>Use «Iniciar câmera» ou introduza mm manualmente.</p>
            </div>
        </section>
        <p id="{{ $pupiloId }}__camStatus" class="status-erro" role="status"></p>

        <div class="acoes">
            <button type="button" class="p-btn btn-cyan" id="{{ $pupiloId }}__btnIniciar">Iniciar câmera</button>
            <button type="button" class="p-btn btn-muted" id="{{ $pupiloId }}__btnParar">Parar</button>
        </div>

        <div class="painel">
            <label class="p-lab" for="{{ $pupiloId }}__pdTotal">DP total (interpupilar)</label>
            <input type="text" inputmode="decimal" class="mm" id="{{ $pupiloId }}__pdTotal" placeholder="Ex.: 64,0" autocomplete="off">
            <p style="font-size:0.78rem;color:#62788a;margin-top:8px;margin-bottom:12px;">
                Delta OD (mm): desvia o meio interpupilar (positivo = mais peso no OD).
            </p>
            <div class="grid-pd">
                <div>
                    <label class="p-lab" for="{{ $pupiloId }}__deltaOd">Delta OD (mm)</label>
                    <input type="text" inputmode="decimal" class="mm" id="{{ $pupiloId }}__deltaOd" placeholder="0" value="0">
                </div>
                <div>
                    <label class="p-lab">DNP OD (mm)</label>
                    <input type="text" class="mm" id="{{ $pupiloId }}__dnpOd" readonly style="opacity:0.95;background:#1a222c">
                </div>
                <div>
                    <label class="p-lab">DNP OE (mm)</label>
                    <input type="text" class="mm" id="{{ $pupiloId }}__dnpOe" readonly style="opacity:0.95;background:#1a222c">
                </div>
                <div>
                    <label class="p-lab"> </label>
                    <button type="button" class="p-btn btn-muted" id="{{ $pupiloId }}__btnRecalc" style="width:100%">Recalcular DNP</button>
                </div>
            </div>
        </div>

        <div class="acoes" style="margin-top:4px;">
            <button type="button" class="p-btn btn-accent" id="{{ $pupiloId }}__btnAplicar">Aplicar DNP na receita da O.S.</button>
        </div>
        <p class="p-sub" style="font-size:0.8rem">Preenche os campos LONGE e PERTO DNP ocultos (se existirem nesta página).</p>

        <div class="p-footer">HTTPS recomendado para acesso estável à câmera em telemóveis.</div>
    </div>
</div>

@once
<script>
(function () {
  function opticahospitalPupiloInit(scopeId) {
    var root = typeof scopeId === 'string' ? document.getElementById(scopeId) : scopeId;
    if (!root) return;
    function $(suffix) {
      return document.getElementById(scopeId + suffix);
    }
    var video = $('__video');
    var sem = $('__semCam');
    var camStatus = $('__camStatus');
    var stream = null;

    function parseNum(pt) {
      if (pt === undefined || pt === null || typeof pt !== 'string') return NaN;
      var s = String(pt).replace(/\s+/g, '').replace(',', '.');
      var x = parseFloat(s);
      return isFinite(x) ? x : NaN;
    }

    function formatMm(n) {
      if (!isFinite(n)) return '';
      return String(n.toFixed(1)).replace('.', ',');
    }

    function atualizarDnps() {
      var pd = parseNum($('__pdTotal').value);
      var delta = parseNum($('__deltaOd').value);
      if (!isFinite(delta)) delta = 0;
      if (!isFinite(pd) || pd <= 0) {
        $('__dnpOd').value = '';
        $('__dnpOe').value = '';
        return;
      }
      var metade = pd / 2;
      $('__dnpOd').value = formatMm(metade + delta);
      $('__dnpOe').value = formatMm(metade - delta);
    }

    function mostrarPlaceholder(on) {
      sem.hidden = !on;
      video.hidden = on;
      if (on) {
        video.removeAttribute('src');
        video.srcObject = null;
      }
    }

    async function iniciar() {
      camStatus.textContent = '';
      if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
        camStatus.textContent = 'Este navegador não expõe a câmera. Introduza os mm manualmente.';
        mostrarPlaceholder(true);
        return;
      }
      try {
        stream = await navigator.mediaDevices.getUserMedia({
          video: { facingMode: { ideal: 'user' }, width: { ideal: 640 } },
          audio: false
        });
        video.srcObject = stream;
        mostrarPlaceholder(false);
      } catch (e) {
        camStatus.textContent = 'Permissão negada ou câmera indisponível. Use só os valores em mm.';
        mostrarPlaceholder(true);
      }
    }

    function parar() {
      camStatus.textContent = '';
      if (stream) {
        stream.getTracks().forEach(function (t) { t.stop(); });
        stream = null;
      }
      mostrarPlaceholder(true);
    }

    function guardarLocal() {
      try {
        localStorage.setItem('oticahospital_pupilometro_v1', JSON.stringify({
          pdTotal: $('__pdTotal').value,
          deltaOd: $('__deltaOd').value
        }));
      } catch (e) {}
    }

    function carregarLocal() {
      try {
        var raw = localStorage.getItem('oticahospital_pupilometro_v1');
        if (!raw) return;
        var o = JSON.parse(raw);
        if (o.pdTotal) $('__pdTotal').value = o.pdTotal;
        if (o.deltaOd != null) $('__deltaOd').value = o.deltaOd;
      } catch (e) {}
    }

    function aplicarAoFormulario() {
      atualizarDnps();
      var od = $('__dnpOd').value;
      var oe = $('__dnpOe').value;
      function set(fid, val) {
        var el = document.getElementById(fid);
        if (el && typeof val === 'string') el.value = val;
      }
      set('prescription_longe_dnp_od', od);
      set('prescription_longe_dnp_oe', oe);
      set('prescription_perto_dnp_od', od);
      set('prescription_perto_dnp_oe', oe);
      guardarLocal();
      try {
        if (window.parent && window.parent !== window) {
          window.parent.postMessage({
            type: 'opticahospital-pupilometro',
            payload: {
              longe_dnp_od: od,
              longe_dnp_oe: oe,
              perto_dnp_od: od,
              perto_dnp_oe: oe
            }
          }, window.location.origin);
        }
      } catch (e) {}
    }

    $('__btnIniciar').addEventListener('click', iniciar);
    $('__btnParar').addEventListener('click', parar);
    $('__btnRecalc').addEventListener('click', function () {
      atualizarDnps();
      guardarLocal();
    });
    $('__pdTotal').addEventListener('input', function () { atualizarDnps(); guardarLocal(); });
    $('__deltaOd').addEventListener('input', function () { atualizarDnps(); guardarLocal(); });
    $('__btnAplicar').addEventListener('click', aplicarAoFormulario);

    mostrarPlaceholder(true);
    carregarLocal();
    atualizarDnps();

    root.addEventListener('pupiloDestroy', parar);
  }

  window.opticahospitalPupiloInit = opticahospitalPupiloInit;
})();
</script>
@endonce

<script>
document.addEventListener('DOMContentLoaded', function () {
  if (typeof window.opticahospitalPupiloInit === 'function') {
    window.opticahospitalPupiloInit(@json($pupiloId));
  }
});
</script>
