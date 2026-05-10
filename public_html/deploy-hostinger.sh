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

# O projeto não tem migração da tabela `cache`; CACHE_STORE=database causa 500 após config:cache.
if grep -q '^CACHE_STORE=database' .env 2>/dev/null; then
  echo "==> A corrigir CACHE_STORE=database -> file no .env (backup: .env.bak.cachestore)"
  cp -a .env .env.bak.cachestore
  sed -i 's/^CACHE_STORE=database/CACHE_STORE=file/' .env
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
php artisan route:cache
php artisan view:cache
php artisan event:cache 2>/dev/null || true

if [[ "${DEPLOY_MIGRATE:-0}" == "1" ]]; then
  echo "==> Migrações (DEPLOY_MIGRATE=1)"
  php artisan migrate --force
fi

echo "==> Feito. Se ainda houver 500, corre: tail -n 100 storage/logs/laravel.log"
