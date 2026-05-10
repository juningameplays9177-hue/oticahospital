/** @type {import('next').NextConfig} */
const BASE_PATH = "/pupilometro-next";

const nextConfig = {
  output: "export",
  basePath: BASE_PATH,
  /** pastas com `index.html` — melhor em Apache/cPanel (`/receita/` → `receita/index.html`) */
  trailingSlash: true,
  env: {
    NEXT_PUBLIC_BASE_PATH: BASE_PATH
  },
  reactStrictMode: true,
  webpack: (config) => {
    config.resolve.fallback = {
      ...(config.resolve.fallback || {}),
      fs: false,
      encoding: false
    };
    return config;
  }
};

export default nextConfig;
