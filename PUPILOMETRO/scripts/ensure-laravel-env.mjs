/**
 * Garante .env.production para build com basePath /pupilometro (integração Laravel).
 */
import fs from "fs";
import path from "path";
import { fileURLToPath } from "url";

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const pupRoot = path.join(__dirname, "..");
const src = path.join(pupRoot, "laravel.export.env");
const dest = path.join(pupRoot, ".env.production");

if (!fs.existsSync(src)) {
  console.warn("Aviso: laravel.export.env não encontrado.");
  process.exit(0);
}
if (!fs.existsSync(dest)) {
  fs.copyFileSync(src, dest);
  console.log("Criado .env.production a partir de laravel.export.env");
} else {
  console.log(".env.production já existe — não sobrescrito.");
}
