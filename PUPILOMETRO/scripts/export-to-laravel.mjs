/**
 * Copia o export estático Next (out/) para Laravel public/pupilometro/
 * Uso: npm run export:laravel
 */
import fs from "fs";
import path from "path";
import { fileURLToPath } from "url";

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const pupRoot = path.join(__dirname, "..");
const outDir = path.join(pupRoot, "out");
const destDir = path.join(pupRoot, "..", "public_html", "public", "pupilometro");

if (!fs.existsSync(outDir)) {
  console.error("Pasta out/ não encontrada. Rode: npm run build");
  process.exit(1);
}

if (fs.existsSync(destDir)) {
  fs.rmSync(destDir, { recursive: true, force: true });
}
fs.mkdirSync(path.dirname(destDir), { recursive: true });
fs.cpSync(outDir, destDir, { recursive: true });
console.log("OK: export copiado para", destDir);
