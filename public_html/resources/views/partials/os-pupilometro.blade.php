@php
    /** App Next estático em public/pupilometro; fallbacks legados */
    $pupiloSrc = null;
    foreach ([
        'pupilometro/index.html',
        'pupilometro/index.php',
        'O.S/pupilometro/index.php',
    ] as $rel) {
        if (is_string($rel) && is_readable(public_path($rel))) {
            $pupiloSrc = asset($rel);
            break;
        }
    }
    if ($pupiloSrc === null) {
        $pupiloSrc = asset('pupilometro/index.html');
    }
@endphp
<link rel="stylesheet" href="{{ asset('css/os-pupilometro.css') }}?v=4" />
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
            allow="camera; fullscreen"
        ></iframe>
    </div>
</section>
