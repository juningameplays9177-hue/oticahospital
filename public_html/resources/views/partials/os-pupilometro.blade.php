@php
    /** Prioriza public/pupilometro; depois index.html; fallback O.S/pupilometro */
    $pupiloSrc = null;
    foreach ([
        'pupilometro/index.php',
        'pupilometro/index.html',
        'O.S/pupilometro/index.php',
    ] as $rel) {
        if (file_exists(public_path($rel))) {
            $pupiloSrc = asset($rel);
            break;
        }
    }
    $pupiloSrc = $pupiloSrc ?? asset('pupilometro/index.php');
@endphp
<link rel="stylesheet" href="{{ asset('css/os-pupilometro.css') }}?v=2" />
<section class="os-pupilometro-section" aria-labelledby="os-pupilometro-heading">
    <div class="os-pupilometro-section__head">
        <h2 id="os-pupilometro-heading">Pupilômetro Digital</h2>
        <p class="os-pupilometro-section__intro">
            Ferramenta auxiliar para medição pupilar dentro da Ordem de Serviço. Os dados permanecem no seu navegador.
        </p>
    </div>
    <div class="os-pupilometro-frame-wrap">
        <iframe
            src="{{ $pupiloSrc }}"
            class="os-pupilometro-frame"
            loading="lazy"
            title="Pupilômetro Digital — medição pupilar"
            referrerpolicy="strict-origin-when-cross-origin"
            allow="camera; fullscreen"
        ></iframe>
    </div>
</section>
