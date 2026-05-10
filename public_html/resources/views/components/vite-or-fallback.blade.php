{{--
    Laravel @vite falha sem public/build/manifest.json (deploy incomum em FTP/Git sem npm run build).
    Neste modo carregamos CDN mínimo e axios para não derrubar o site inteiro.
--}}
@props([
    'withAxios' => true,
    'entries' => ['resources/css/app.css', 'resources/js/app.js'],
])

@php
    $viteOk =
        file_exists(public_path('build/manifest.json'))
        || (file_exists(public_path('hot')));
@endphp

@if ($viteOk)
    @vite($entries)
@else
    {{-- Produção/hosting sem build pré-compilado: fallback seguro para evitar 500 global --}}
    @if ($withAxios)
        <script src="https://cdn.jsdelivr.net/npm/axios@1.7.7/dist/axios.min.js"></script>
        <script>
            window.axios = axios;
            window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        </script>
    @endif
    <script src="https://cdn.tailwindcss.com"></script>
@endif
