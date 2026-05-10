/** Alinhado com `basePath` em `next.config.mjs` — embutido no build via `NEXT_PUBLIC_BASE_PATH`. */
export function withBasePath(path: string): string {
  const base = (process.env.NEXT_PUBLIC_BASE_PATH || "").replace(/\/$/, "");
  const p = path.startsWith("/") ? path : `/${path}`;
  return base ? `${base}${p}` : p;
}
