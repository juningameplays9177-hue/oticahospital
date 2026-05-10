import { Suspense } from "react";
import type { Metadata } from "next";
import ReceitaClient from "./receita-client";

export const metadata: Metadata = {
  title: "Receituário | Pupilômetro Digital",
  description: "Ficha de dados da receita óptica — preenchimento local."
};

export default function ReceitaPage() {
  return (
    <Suspense
      fallback={
        <div
          className="flex min-h-screen items-center justify-center bg-[#06060a] text-slate-500"
          style={{ padding: 32, fontSize: 14 }}
        >
          A carregar ficha de receita…
        </div>
      }
    >
      <ReceitaClient />
    </Suspense>
  );
}
