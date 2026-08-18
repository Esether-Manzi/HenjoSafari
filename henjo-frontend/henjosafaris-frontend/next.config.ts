import type { NextConfig } from 'next';

const nextConfig: NextConfig = {
  images: {
    // Next.js 16 blocks image fetches to hostnames that resolve to a private/loopback
    // IP by default (SSRF protection). Our backend runs on localhost in dev, so this
    // must be enabled or every image proxied through next/image 400s regardless of
    // remotePatterns. Safe here since it only affects local development.
    dangerouslyAllowLocalIP: process.env.NODE_ENV !== 'production',
    remotePatterns: [
      {
        protocol: 'http',
        hostname: 'localhost',
        port: '8000',
        pathname: '/storage/**',
      },
      {
        protocol: 'http',
        hostname: 'localhost',
        port: '', // Allow any port
        pathname: '/**',
      },
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