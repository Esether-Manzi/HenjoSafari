// ============================================
// SAFARI ICON LIBRARY
// ============================================
// Keys here mirror the backend's curated icon set
// (henjo-backend/app/Support/SafariIcons.php) that
// admins choose from in Filament for Activities and
// Safari Categories. Keep both lists in sync.
// ============================================

import type { IconType } from 'react-icons';
import {
    FaPaw,
    FaDove,
    FaHiking,
    FaMountain,
    FaTree,
    FaWater,
    FaCameraRetro,
    FaCampground,
    FaCompass,
    FaSun,
    FaMoon,
    FaLandmark,
    FaUsers,
    FaChild,
    FaFemale,
    FaCalendarAlt,
    FaStar,
    FaHeart,
    FaShieldAlt,
    FaPlaneDeparture,
    FaCar,
    FaBicycle,
    FaLeaf,
    FaUmbrellaBeach,
} from 'react-icons/fa';

export const SAFARI_ICONS: Record<string, { label: string; Icon: IconType }> = {
    wildlife: { label: 'Wildlife & Big Five', Icon: FaPaw },
    birding: { label: 'Bird Watching', Icon: FaDove },
    hiking: { label: 'Hiking & Trekking', Icon: FaHiking },
    mountain: { label: 'Mountain Climbing', Icon: FaMountain },
    forest: { label: 'Forest & Nature', Icon: FaTree },
    water: { label: 'Boat Cruises & Rivers', Icon: FaWater },
    photography: { label: 'Photography Tours', Icon: FaCameraRetro },
    camping: { label: 'Camping & Overnight Stays', Icon: FaCampground },
    adventure: { label: 'Adventure & Exploration', Icon: FaCompass },
    daytrip: { label: 'Day Excursions', Icon: FaSun },
    nighttour: { label: 'Night Tours', Icon: FaMoon },
    cultural: { label: 'Cultural & City Tours', Icon: FaLandmark },
    group: { label: 'Group Tours', Icon: FaUsers },
    family: { label: 'Family Friendly', Icon: FaChild },
    women: { label: 'Women Only Tours', Icon: FaFemale },
    multiday: { label: 'Multi-Day Itineraries', Icon: FaCalendarAlt },
    featured: { label: 'Featured / Premium', Icon: FaStar },
    popular: { label: 'Popular & Loved', Icon: FaHeart },
    safety: { label: 'Safety & Security', Icon: FaShieldAlt },
    flying: { label: 'Fly-In Safaris', Icon: FaPlaneDeparture },
    driving: { label: 'Game Drives', Icon: FaCar },
    cycling: { label: 'Cycling Tours', Icon: FaBicycle },
    eco: { label: 'Eco-Friendly & Conservation', Icon: FaLeaf },
    beach: { label: 'Beach & Coastal', Icon: FaUmbrellaBeach },
};

interface SafariIconProps {
    iconKey?: string | null;
    className?: string;
    fallback?: IconType | null;
}

/** Renders the react-icon matching an admin-selected icon key (falls back gracefully if unset/unknown). */
export default function SafariIcon({ iconKey, className, fallback: Fallback = null }: SafariIconProps) {
    const entry = iconKey ? SAFARI_ICONS[iconKey] : undefined;

    if (entry) {
        const { Icon } = entry;
        return <Icon className={className} />;
    }

    if (Fallback) {
        return <Fallback className={className} />;
    }

    return null;
}
