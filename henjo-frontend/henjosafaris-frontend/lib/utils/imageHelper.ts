// The backend's origin (no /api/v1 suffix), derived from the same env var
// every other API call uses — so this follows wherever the backend actually
// is (local dev, a demo host, or the real production domain) with no code change.
const BACKEND_ORIGIN = (process.env.NEXT_PUBLIC_API_URL || 'http://localhost:8000/api/v1').replace(/\/api\/v1\/?$/, '');

/**
 * Get the correct image URL from media object
 * @param media - The media array from the API
 * @param type - 'cover' or 'gallery'
 * @param index - For gallery images (default: 0)
 * @returns The full image URL
 */
export function getImageUrl(media: any, type: 'cover' | 'gallery' = 'cover', index: number = 0): string {
    // If no media, return placeholder
    if (!media || media.length === 0) {
        return '/images/placeholder.png';
    }

    // Find the right collection
    const mediaItems = media.filter((m: any) => m.collection_name === type);
    
    if (mediaItems.length === 0) {
        return '/images/placeholder.png';
    }

    // Get the specific item
    const item = type === 'gallery' ? mediaItems[index] : mediaItems[0];
    
    // Get the URL - try different possible fields
    let url = item?.original_url || 
              item?.large_url || 
              item?.thumb_url || 
              item?.preview_url || 
              `/storage/${item?.file_name}` ||
              '/images/placeholder.png';
    
    // Resolve relative URLs against the actual backend origin
    if (url) {
        // Spatie Media Library bakes the backend's own APP_URL into absolute
        // URLs like original_url — which is localhost in dev regardless of
        // where the backend is actually reachable from (a tunnel, staging,
        // production). Rewrite those to the real backend origin.
        const localBackendHost = /^https?:\/\/(localhost|127\.0\.0\.1):8000/;
        if (localBackendHost.test(url)) {
            url = url.replace(localBackendHost, BACKEND_ORIGIN);
        }
        // If URL starts with /storage/, add the backend base URL
        else if (url.startsWith('/storage/')) {
            url = `${BACKEND_ORIGIN}${url}`;
        }
        // If URL starts with storage/ (no leading slash)
        else if (url.startsWith('storage/')) {
            url = `${BACKEND_ORIGIN}/${url}`;
        }
        // If URL doesn't start with http and isn't a relative path, add backend URL
        else if (!url.startsWith('http') && !url.startsWith('/')) {
            url = `${BACKEND_ORIGIN}/${url}`;
        }
    }
    
    return url;
}