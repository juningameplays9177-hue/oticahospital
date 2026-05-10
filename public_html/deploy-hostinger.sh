#!/usr/bin/env bash
# Deploy / correção pós-upload na Hostinger (SSH).
# Uso: cd ~/domains/SEU_DOMINIO/public_html && bash deploy-hostinger.sh
# Opcional: DEPLOY_MIGRATE=1 bash deploy-hostinger.sh  (corre migrações)

set -euo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
cd "$ROOT"

echo "==> Pasta: $ROOT"

if [[ ! -f artisan ]]; then
  echo "ERRO: artisan não encontrado. Corre este script dentro da pasta Laravel (public_html)."
  exit 1
fi
  
echo "==> PHP: $(php -r 'echo PHP_VERSION;')"

if [[ ! -f .env ]]; then
  if [[ -f .env.example ]]; then
    echo "==> A criar .env a partir de .env.example (edita DB e APP_URL antes de usar em sério!)"
    cp -n .env.example .env
  else
    echo "ERRO: Falta .env e .env.example. Copia o .env do backup do servidor ou cria .env manualmente."
    exit 1
  fi
fi

if ! grep -q '^APP_KEY=base64:' .env 2>/dev/null; then
  echo "==> APP_KEY em falta ou inválida — a gerar"
  php artisan key:generate --force
fi

# Sessões em BD exigem MySQL em cada pedido; se a BD falhar → 500 em todo o site.
if grep -q '^SESSION_DRIVER=database' .env 2>/dev/null; then
  echo "==> A corrigir SESSION_DRIVER=database -> file no .env (backup: .env.bak.session)"
  cp -a .env .env.bak.session 2>/dev/null || cp .env .env.bak.session
  sed -i 's/^SESSION_DRIVER=database/SESSION_DRIVER=file/' .env
fi

# Sem tabela jobs no projeto, queue database pode falhar em tarefas em background.
if grep -q '^QUEUE_CONNECTION=database' .env 2>/dev/null; then
  echo "==> A corrigir QUEUE_CONNECTION=database -> sync no .env (backup: .env.bak.queue)"
  cp -a .env .env.bak.queue 2>/dev/null || cp .env .env.bak.queue
  sed -i 's/^QUEUE_CONNECTION=database/QUEUE_CONNECTION=sync/' .env
fi

echo "==> Pastas de storage/framework"
mkdir -p storage/logs \
  storage/framework/cache/data \
  storage/framework/sessions \
  storage/framework/views \
  bootstrap/cache

echo "==> composer install"
if command -v composer >/dev/null 2>&1; then
  composer install --no-dev --optimize-autoloader --no-interaction
else
  echo "AVISO: comando 'composer' não encontrado. Instala dependências no hPanel ou:"
  echo "  php -r \"copy('https://getcomposer.org/installer', 'composer-setup.php');\""
  echo "  php composer-setup.php && php composer.phar install --no-dev --optimize-autoloader --no-interaction"
  exit 1
fi

echo "==> Permissões storage e bootstrap/cache (ignorar erros se não fores dono de todos os ficheiros)"
chmod -R ug+rwx storage bootstrap/cache 2>/dev/null || true

echo "==> Link simbólico public/storage (se aplicável)"
php artisan storage:link 2>/dev/null || true

echo "==> Limpar caches antigos"
php artisan optimize:clear 2>/dev/null || true
php artisan config:clear || true
php artisan cache:clear || true
php artisan view:clear || true
php artisan route:clear || true

echo "==> Otimizar para produção"
php artisan config:cache
if ! php artisan route:cache 2>/dev/null; then
  echo "AVISO: route:cache falhou (memória PHP ou rotas). A limpar cache de rotas — o site continua sem route cache."
  php artisan route:clear || true
fi
php artisan view:cache
php artisan event:cache 2>/dev/null || true

if [[ "${DEPLOY_MIGRATE:-0}" == "1" ]]; then
  echo "==> Migrações (DEPLOY_MIGRATE=1)"
  php artisan migrate --force
fi

echo "==> Feito. Testa no browser: https://SEU-DOMINIO/__ping (deve mostrar OK)."
echo "    Depois: tail -n 100 storage/logs/laravel.log"
