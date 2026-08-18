// ============================================
// DESTINATION DATA (from content audit)
// Shared between the destinations listing page and
// the per-country destination detail pages.
// Will be replaced with API data when a backend
// destinations detail endpoint is ready.
// ============================================

import type { DestinationData } from '@/components/destination/DestinationCard';

export const destinations: DestinationData[] = [
    {
        name: 'Uganda',
        slug: 'uganda',
        tagline: 'The Pearl of Africa',
        description:
            'Home to over half the world\'s remaining mountain gorillas in the misty Bwindi Impenetrable Forest. Trek through ancient rainforests, cruise the Kazinga Channel, and raft the source of the Nile.',
        image: '/images/destinations/uganda.png',
        country: 'East Africa',
        tours: 16,
        highlights: ['Gorilla Trekking', 'Chimpanzee Tracking', 'Source of the Nile', 'Queen Elizabeth NP', 'Rwenzori Mountains'],
        startingPrice: 1050,
        currency: '$',
    },
    {
        name: 'Kenya',
        slug: 'kenya',
        tagline: 'Where the Wild Runs Free',
        description:
            'Witness the Great Migration sweep across the Masai Mara, spot the Big Five against the backdrop of snow-capped Kilimanjaro in Amboseli, and discover flamingo-lined Lake Nakuru.',
        image: '/images/destinations/kenya.png',
        country: 'East Africa',
        tours: 4,
        highlights: ['Great Migration', 'Masai Mara', 'Amboseli', 'Lake Nakuru', 'Tsavo'],
        startingPrice: 978,
        currency: '$',
    },
    {
        name: 'Tanzania',
        slug: 'tanzania',
        tagline: 'The Roof of Africa',
        description:
            'From the endless Serengeti plains to the Ngorongoro Crater — the world\'s largest intact caldera — Tanzania offers the quintessential African safari. Climb Kilimanjaro or unwind on Zanzibar.',
        image: '/images/destinations/tanzania.png',
        country: 'East Africa',
        tours: 4,
        highlights: ['Serengeti', 'Ngorongoro Crater', 'Kilimanjaro', 'Tarangire', 'Zanzibar'],
        startingPrice: 1200,
        currency: '$',
    },
    {
        name: 'Rwanda',
        slug: 'rwanda',
        tagline: 'The Land of a Thousand Hills',
        description:
            'A jewel of Central-East Africa with emerald-green volcanic mountains, intimate gorilla encounters in Volcanoes National Park, golden monkey tracking, and the stunning shores of Lake Kivu.',
        image: '/images/destinations/rwanda.png',
        country: 'East Africa',
        tours: 4,
        highlights: ['Gorilla Safaris', 'Golden Monkeys', 'Volcanoes NP', 'Lake Kivu', 'Akagera NP'],
        startingPrice: 1500,
        currency: '$',
    },
];
