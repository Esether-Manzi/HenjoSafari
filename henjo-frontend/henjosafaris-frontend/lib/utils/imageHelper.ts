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
        return '/images/placeholder.jpg';
    }

    // Find the right collection
    const mediaItems = media.filter((m: any) => m.collection_name === type);
    
    if (mediaItems.length === 0) {
        return '/images/placeholder.jpg';
    }

    // Get the specific item
    const item = type === 'gallery' ? mediaItems[index] : mediaItems[0];
    
    // Get the URL - try different possible fields
    let url = item?.original_url || 
              item?.large_url || 
              item?.thumb_url || 
              item?.preview_url || 
              `/storage/${item?.file_name}` ||
              '/images/placeholder.jpg';
    
    // Fix the URL for local development
    if (url) {
        // If URL starts with /storage/, add the backend base URL
        if (url.startsWith('/storage/')) {
            url = `http://localhost:8000${url}`;
        }
        // If URL starts with storage/ (no leading slash)
        else if (url.startsWith('storage/')) {
            url = `http://localhost:8000/${url}`;
        }
        // Replace 127.0.0.1 with localhost
        else if (url.includes('127.0.0.1')) {
            url = url.replace('127.0.0.1', 'localhost');
        }
        // If URL doesn't start with http and isn't a relative path, add backend URL
        else if (!url.startsWith('http') && !url.startsWith('/')) {
            url = `http://localhost:8000/${url}`;
        }
    }
    
    console.log('🖼️ Image URL:', url); // Debug log - remove after testing
    
    return url;
}