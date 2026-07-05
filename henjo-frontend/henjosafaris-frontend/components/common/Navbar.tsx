'use client';
// ✅ Client Component because it uses useState for mobile menu and dropdowns

import Link from 'next/link';
import Image from 'next/image';
import { useState } from 'react';
import { FaBars, FaTimes, FaChevronDown } from 'react-icons/fa';
import ThemeToggle from './ThemeToggle';

export default function Navbar() {
    // ============================================
    // STATE MANAGEMENT
    // ============================================
    
    const [isOpen, setIsOpen] = useState(false);
    const [openDropdown, setOpenDropdown] = useState<string | null>(null);

    // ============================================
    // NAVIGATION DATA
    // ============================================
    
    const menuItems = [
        { name: 'Home', href: '/' },
        { 
            name: 'Safaris', 
            href: '/safaris',
            dropdown: [
                { name: 'Wildlife Adventure', href: '/safaris?category=wildlife' },
                { name: 'Gorilla Trekking', href: '/safaris?category=gorilla' },
                { name: 'Fly In Safaris', href: '/safaris?category=flying' },
                { name: 'Mountaineering', href: '/safaris?category=mountaineering' },
                { name: 'Cultural Tour', href: '/safaris?category=cultural' },
                { name: 'Women Only Tours', href: '/women-only-tours' },
                { name: 'City Tours', href: '/safaris?category=city' },
            ]
        },
        { name: 'Women Only Tours', href: '/women-only-tours' },
        { 
            name: 'Destinations', 
            href: '/destinations',
            dropdown: [
                { name: 'Kenya', href: '/destinations/kenya' },
                { name: 'Tanzania', href: '/destinations/tanzania' },
                { name: 'Uganda', href: '/destinations/uganda' },
                { name: 'Rwanda', href: '/destinations/rwanda' },
            ]
        },
        { name: 'Travel Information', href: '/travel-information' },
        { 
            name: 'About Us', 
            href: '/about',
            dropdown: [
                { name: 'About Our Charity', href: '/about-our-charity' },
                { name: 'Our Team', href: '/our-team' },
                { name: 'Blog', href: '/blog' },
                { name: 'Booking Policy', href: '/booking-policy' },
            ]
        },
        { name: 'Contact', href: '/contact' },
    ];

    const toggleDropdown = (name: string) => {
        setOpenDropdown(openDropdown === name ? null : name);
    };

    return (
        <nav className="bg-white dark:bg-gray-900 shadow-lg dark:shadow-gray-800 fixed w-full z-50 transition-colors duration-300">
            <div className="container mx-auto px-4">
                <div className="flex justify-between items-center h-20">
                    
                    {/* Logo */}
                    <Link href="/" className="flex items-center gap-3 group">
                        <div className="relative w-12 h-12">
                            <Image
                                src="/images/henjo_icon_logo.png"
                                alt="Henjo African Safaris - Home"
                                fill
                                className="object-contain"
                                priority
                            />
                        </div>
                        <div className="hidden sm:block">
                            <span className="text-xl font-bold text-green-700 dark:text-green-400 group-hover:text-green-800 dark:group-hover:text-green-300 transition">
                                Henjo African Safaris
                            </span>
                            <span className="block text-[10px] text-yellow-600 dark:text-yellow-400 font-semibold tracking-wider">
                                Every step, with us is an adventure
                            </span>
                        </div>
                    </Link>

                    {/* Desktop Menu */}
                    <div className="hidden lg:flex items-center space-x-6">
                        {menuItems.map((item) => (
                            <div key={item.name} className="relative group">
                                {item.dropdown ? (
                                    <div className="flex items-center">
                                        <Link
                                            href={item.href}
                                            className="text-gray-700 dark:text-gray-300 hover:text-yellow-500 dark:hover:text-yellow-400 transition font-medium"
                                        >
                                            {item.name}
                                        </Link>
                                        <button
                                            className="ml-1 text-gray-500 dark:text-gray-400 hover:text-yellow-500 dark:hover:text-yellow-400 transition p-1"
                                            onClick={() => toggleDropdown(item.name)}
                                            aria-label={`Toggle ${item.name} dropdown`}
                                        >
                                            <FaChevronDown className={`text-xs transition-transform duration-200 ${
                                                openDropdown === item.name ? 'rotate-180' : ''
                                            }`} />
                                        </button>
                                    </div>
                                ) : (
                                    <Link
                                        href={item.href}
                                        className="text-gray-700 dark:text-gray-300 hover:text-yellow-500 dark:hover:text-yellow-400 transition font-medium"
                                    >
                                        {item.name}
                                    </Link>
                                )}
                                
                                {item.dropdown && openDropdown === item.name && (
                                    <div className="absolute top-full left-0 mt-2 bg-white dark:bg-gray-800 shadow-lg dark:shadow-gray-900 rounded-lg py-2 min-w-[200px] z-50 border border-gray-200 dark:border-gray-700">
                                        {item.dropdown.map((sub) => (
                                            <Link
                                                key={sub.name}
                                                href={sub.href}
                                                className="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-yellow-50 dark:hover:bg-gray-700 hover:text-yellow-500 dark:hover:text-yellow-400 transition"
                                                onClick={() => setOpenDropdown(null)}
                                            >
                                                {sub.name}
                                            </Link>
                                        ))}
                                    </div>
                                )}
                            </div>
                        ))}
                        
                        {/* Theme Toggle */}
                        <ThemeToggle />
                        
                        {/* CTA Button */}
                        <Link
                            href="/contact"
                            className="bg-yellow-500 hover:bg-yellow-400 text-black font-semibold px-6 py-2 rounded-full transition"
                        >
                            Book Now
                        </Link>
                    </div>

                    {/* Mobile Menu Button */}
                    <div className="flex items-center gap-4 lg:hidden">
                        <ThemeToggle />
                        <button
                            onClick={() => setIsOpen(!isOpen)}
                            className="text-2xl text-gray-700 dark:text-gray-300"
                            aria-label="Toggle navigation menu"
                        >
                            {isOpen ? <FaTimes /> : <FaBars />}
                        </button>
                    </div>
                </div>

                {/* Mobile Menu */}
                {isOpen && (
                    <div className="lg:hidden pb-6 space-y-2 max-h-[80vh] overflow-y-auto">
                        {menuItems.map((item) => (
                            <div key={item.name}>
                                {item.dropdown ? (
                                    <>
                                        <div className="flex items-center justify-between">
                                            <Link
                                                href={item.href}
                                                className="py-2 text-gray-700 dark:text-gray-300 hover:text-yellow-500 dark:hover:text-yellow-400 transition font-medium"
                                                onClick={() => setIsOpen(false)}
                                            >
                                                {item.name}
                                            </Link>
                                            <button
                                                className="p-2 text-gray-500 dark:text-gray-400 hover:text-yellow-500 dark:hover:text-yellow-400 transition"
                                                onClick={() => toggleDropdown(item.name)}
                                            >
                                                <FaChevronDown className={`text-xs transition-transform duration-200 ${
                                                    openDropdown === item.name ? 'rotate-180' : ''
                                                }`} />
                                            </button>
                                        </div>
                                        {openDropdown === item.name && (
                                            <div className="pl-4 space-y-1 border-l-2 border-yellow-200 dark:border-yellow-600 ml-2">
                                                {item.dropdown.map((sub) => (
                                                    <Link
                                                        key={sub.name}
                                                        href={sub.href}
                                                        className="block py-2 text-gray-600 dark:text-gray-400 hover:text-yellow-500 dark:hover:text-yellow-400 transition"
                                                        onClick={() => {
                                                            setIsOpen(false);
                                                            setOpenDropdown(null);
                                                        }}
                                                    >
                                                        {sub.name}
                                                    </Link>
                                                ))}
                                            </div>
                                        )}
                                    </>
                                ) : (
                                    <Link
                                        href={item.href}
                                        className="block py-2 text-gray-700 dark:text-gray-300 hover:text-yellow-500 dark:hover:text-yellow-400 transition"
                                        onClick={() => setIsOpen(false)}
                                    >
                                        {item.name}
                                    </Link>
                                )}
                            </div>
                        ))}
                        <Link
                            href="/contact"
                            className="block mt-4 bg-yellow-500 hover:bg-yellow-400 text-black font-semibold text-center px-6 py-2 rounded-full transition"
                            onClick={() => setIsOpen(false)}
                        >
                            Book Now
                        </Link>
                    </div>
                )}
            </div>
        </nav>
    );
}