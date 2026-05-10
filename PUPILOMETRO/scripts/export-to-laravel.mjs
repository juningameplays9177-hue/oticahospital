/**
 * Copia o export estático Next (out/) para Laravel public/pupilometro/
 * Uso: npm run export:laravel (ou npm run pupilometro:sync na raiz do repositório)
 */
import fs from "fs";
import path from "path";
import { fileURLToPath } from "url";

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const pupRoot = path.resolve(path.join(__dirname, ".."));
const outDir = path.join(pupRoot, "out");
const destDir = path.resolve(path.join(pupRoot, "..", "public_html", "public", "pupilometro"));

try {
  if (!fs.existsSync(outDir)) {
    console.error("Pasta out/ não encontrada. Rode antes: npm run build");
    process.exit(1);
  }

  if (fs.existsSync(destDir)) {
    fs.rmSync(destDir, { recursive: true, force: true });
  }
  fs.mkdirSync(path.dirname(destDir), { recursive: true });
  fs.cpSync(outDir, destDir, { recursive: true });

  const count = fs.readdirSync(destDir, { withFileTypes: true }).length;
  console.log("OK: pupilômetro copiado para", destDir);
  console.log("    (entrada:", path.join(destDir, "index.html"), "| itens na raiz:", count + ")");
} catch (err) {
  console.error("Falha ao copiar export:", err);
  process.exit(1);
}
