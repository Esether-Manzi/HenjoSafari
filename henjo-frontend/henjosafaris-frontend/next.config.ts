import type { NextConfig } from 'next';

// Derive an image remotePattern from wherever the backend actually is
// (NEXT_PUBLIC_API_URL), so a demo/staging/production backend host works
// without editing this file — only the env var needs to change.
const apiUrl = process.env.NEXT_PUBLIC_API_URL;
const backendPattern = (() => {
  if (!apiUrl) return null;
  try {
    const { protocol, hostname, port } = new URL(apiUrl);
    return {
      protocol: protocol.replace(':', '') as 'http' | 'https',
      hostname,
      ...(port ? { port } : {}),
      pathname: '/**' as const,
    };
  } catch {
    return null;
  }
})();

const nextConfig: NextConfig = {
  images: {
    // Next.js 16 blocks image fetches to hostnames that resolve to a private/loopback
    // IP by default (SSRF protection). Our backend runs on localhost in dev, so this
    // must be enabled or every image proxied through next/image 400s regardless of
    // remotePatterns. Safe here since it only affects local development.
    dangerouslyAllowLocalIP: process.env.NODE_ENV !== 'production',
    remotePatterns: [
      {
        // Next.js remotePatterns treats port: '' as "default port only", not
        // a wildcard, despite how that reads — so the backend's actual dev
        // port must be listed explicitly to allow images it serves outside
        // of storage:link (e.g. the public/images/** fallback paths).
        protocol: 'http',
        hostname: 'localhost',
        port: '8000',
        pathname: '/**',
      },
      // Whatever backend NEXT_PUBLIC_API_URL points to at build time (demo
      // host today, the real production domain later) — skipped if it's
      // just the localhost:8000 default already covered above.
      ...(backendPattern && backendPattern.hostname !== 'localhost' ? [backendPattern] : []),
      {
        protocol: 'https',
        hostname: 'picsum.photos',
      },
      {
        protocol: 'https',
        hostname: 'images.unsplash.com',
      },
      {
        protocol: 'https',
        hostname: '**.cloudinary.com',
      },
    ],
  },
  reactStrictMode: true,
  async redirects() {
    return [
      {
        source: '/safari',
        destination: '/safaris',
        permanent: true,
      },
    ];
  },
};

export default nextConfig;