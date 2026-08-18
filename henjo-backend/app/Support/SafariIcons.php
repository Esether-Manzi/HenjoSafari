<?php

namespace App\Support;

/**
 * Curated icon keys shared with the frontend (henjo-frontend/.../lib/config/icons.tsx).
 * The key stored on a model (e.g. Activity::$icon, SafariCategory::$icon) is looked up
 * there against a matching react-icons/fa component for public-page rendering. The
 * heroicon name here is only used for the admin picker preview.
 */
class SafariIcons
{
    /**
     * @return array<string, array{label: string, heroicon: string}>
     */
    public static function all(): array
    {
        return [
            'wildlife' => ['label' => 'Wildlife & Big Five', 'heroicon' => 'heroicon-o-eye'],
            'birding' => ['label' => 'Bird Watching', 'heroicon' => 'heroicon-o-sparkles'],
            'hiking' => ['label' => 'Hiking & Trekking', 'heroicon' => 'heroicon-o-bolt'],
            'mountain' => ['label' => 'Mountain Climbing', 'heroicon' => 'heroicon-o-trophy'],
            'forest' => ['label' => 'Forest & Nature', 'heroicon' => 'heroicon-o-globe-europe-africa'],
            'water' => ['label' => 'Boat Cruises & Rivers', 'heroicon' => 'heroicon-o-cloud'],
            'photography' => ['label' => 'Photography Tours', 'heroicon' => 'heroicon-o-camera'],
            'camping' => ['label' => 'Camping & Overnight Stays', 'heroicon' => 'heroicon-o-home'],
            'adventure' => ['label' => 'Adventure & Exploration', 'heroicon' => 'heroicon-o-map'],
            'daytrip' => ['label' => 'Day Excursions', 'heroicon' => 'heroicon-o-sun'],
            'nighttour' => ['label' => 'Night Tours', 'heroicon' => 'heroicon-o-moon'],
            'cultural' => ['label' => 'Cultural & City Tours', 'heroicon' => 'heroicon-o-building-library'],
            'group' => ['label' => 'Group Tours', 'heroicon' => 'heroicon-o-user-group'],
            'family' => ['label' => 'Family Friendly', 'heroicon' => 'heroicon-o-face-smile'],
            'women' => ['label' => 'Women Only Tours', 'heroicon' => 'heroicon-o-key'],
            'multiday' => ['label' => 'Multi-Day Itineraries', 'heroicon' => 'heroicon-o-calendar'],
            'featured' => ['label' => 'Featured / Premium', 'heroicon' => 'heroicon-o-star'],
            'popular' => ['label' => 'Popular & Loved', 'heroicon' => 'heroicon-o-heart'],
            'safety' => ['label' => 'Safety & Security', 'heroicon' => 'heroicon-o-shield-check'],
            'flying' => ['label' => 'Fly-In Safaris', 'heroicon' => 'heroicon-o-paper-airplane'],
            'driving' => ['label' => 'Game Drives', 'heroicon' => 'heroicon-o-truck'],
            'cycling' => ['label' => 'Cycling Tours', 'heroicon' => 'heroicon-o-fire'],
            'eco' => ['label' => 'Eco-Friendly & Conservation', 'heroicon' => 'heroicon-o-light-bulb'],
            'beach' => ['label' => 'Beach & Coastal', 'heroicon' => 'heroicon-o-gift-top'],
        ];
    }

    public static function label(?string $key): ?string
    {
        return $key ? (self::all()[$key]['label'] ?? null) : null;
    }

    /**
     * Option list for a Filament Select with allowHtml(), each label prefixed with
     * an inline SVG preview of its heroicon.
     *
     * @return array<string, string>
     */
    public static function selectOptions(): array
    {
        $options = [];

        foreach (self::all() as $key => $icon) {
            $svg = svg($icon['heroicon'], 'w-4 h-4 inline-block align-text-bottom mr-2')->toHtml();
            $options[$key] = $svg.e($icon['label']);
        }

        return $options;
    }

    public static function preview(?string $key): ?string
    {
        $icon = $key ? (self::all()[$key] ?? null) : null;

        if (! $icon) {
            return null;
        }

        return svg($icon['heroicon'], 'w-5 h-5')->toHtml();
    }
}
