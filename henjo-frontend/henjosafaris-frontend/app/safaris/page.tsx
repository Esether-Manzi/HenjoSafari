'use client';

// The actual page reads `filters` from the URL's query string on mount
// (see SafarisPageClient) so that nav links like /safaris?category=X land
// pre-filtered. That requires `window`, which differs between the server
// and the client's first paint — rendering it via a normal SSR'd Client
// Component would cause a React hydration mismatch (server always sees an
// empty filter set, client immediately sees the real one). `ssr: false`
// skips server rendering entirely for this route instead, so there's
// nothing for the client to mismatch against.
import dynamic from 'next/dynamic';

const SafarisPageClient = dynamic(() => import('./SafarisPageClient'), { ssr: false });

export default function SafarisPage() {
    return <SafarisPageClient />;
}
