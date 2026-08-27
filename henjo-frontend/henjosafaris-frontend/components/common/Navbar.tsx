'use client';
// Client Component because it uses useState for mobile menu and dropdowns

import Link from 'next/link';
import Image from 'next/image';
import { useState } from 'react';
import { FaBars, FaTimes, FaChevronDown } from 'react-icons/fa';
import ThemeToggle from './ThemeToggle';
import type { MenuItem } from '@/types/menu';

interface NavbarProps {
    menuItems: MenuItem[];
    siteName: string;
    logoUrl?: string | null;
}

export default function Navbar({ menuItems, siteName, logoUrl }: NavbarProps) {
    // ============================================
    // STATE MANAGEMENT
    // ============================================

    const [isOpen, setIsOpen] = useState(false);
    const [openDropdown, setOpenDropdown] = useState<string | null>(null);

    const toggleDropdown = (name: string) => {
        setOpenDropdown(openDropdown === name ? null : name);
    };

    return (
        <nav
            className="fixed w-full z-50 transition-colors duration-300 shadow-lg"
            style={{
                background: 'var(--bg-nav)',
                boxShadow: 'var(--shadow-md)',
            }}
        >
            <div className="container mx-auto px-4">
                <div className="flex justify-between items-center h-20">

                    {/* Logo */}
                    <Link href="/" className="flex items-center gap-3 group">
                        <div
                            className="relative w-12 h-12 rounded-full overflow-hidden bg-white flex-shrink-0"
                            style={{ border: '2px solid var(--brand-gold)' }}
                        >
                            <Image
                                src={logoUrl || '/images/henjo_icon_logo.webp'}
                                alt={`${siteName} - Home`}
                                fill
                                className="object-cover"
                                priority
                            />
                        </div>
                    </Link>

                    {/* Desktop Menu */}
                    <div className="hidden lg:flex items-center space-x-3 text-sm">
                        {menuItems.map((item) => (
                            <div key={item.id} className="relative group">
                                {item.children && item.children.length > 0 ? (
                                    <div className="flex items-center">
                                        <Link
                                            href={item.url}
                                            className="font-medium transition whitespace-nowrap"
                                            style={{ color: 'var(--text-secondary)' }}
                                            onMouseEnter={(e) => {
                                                e.currentTarget.style.color = 'var(--brand-gold)';
                                            }}
                                            onMouseLeave={(e) => {
                                                e.currentTarget.style.color = 'var(--text-secondary)';
                                            }}
                                        >
                                            {item.label}
                                        </Link>
                                        <button
                                            className="ml-1 transition p-1"
                                            style={{ color: 'var(--text-tertiary)' }}
                                            onClick={() => toggleDropdown(item.label)}
                                            onMouseEnter={(e) => {
                                                e.currentTarget.style.color = 'var(--brand-gold)';
                                            }}
                                            onMouseLeave={(e) => {
                                                e.currentTarget.style.color = 'var(--text-tertiary)';
                                            }}
                                            aria-label={`Toggle ${item.label} dropdown`}
                                        >
                                            <FaChevronDown className={`text-xs transition-transform duration-200 ${openDropdown === item.label ? 'rotate-180' : ''
                                                }`} />
                                        </button>
                                    </div>
                                ) : (
                                    <Link
                                        href={item.url}
                                        className="font-medium transition whitespace-nowrap"
                                        style={{ color: 'var(--text-secondary)' }}
                                        onMouseEnter={(e) => {
                                            e.currentTarget.style.color = 'var(--brand-gold)';
                                        }}
                                        onMouseLeave={(e) => {
                                            e.currentTarget.style.color = 'var(--text-secondary)';
                                        }}
                                    >
                                        {item.label}
                                    </Link>
                                )}

                                {item.children && item.children.length > 0 && openDropdown === item.label && (
                                    <div
                                        className="absolute top-full left-0 mt-2 rounded-lg py-2 min-w-[200px] z-50"
                                        style={{
                                            background: 'var(--bg-card)',
                                            border: '1px solid var(--border-primary)',
                                            boxShadow: 'var(--shadow-lg)',
                                        }}
                                    >
                                        {item.children.map((sub) => (
                                            <Link
                                                key={sub.id}
                                                href={sub.url}
                                                className="block px-4 py-2 transition"
                                                style={{ color: 'var(--text-secondary)' }}
                                                onMouseEnter={(e) => {
                                                    e.currentTarget.style.background = 'var(--brand-gold-subtle)';
                                                    e.currentTarget.style.color = 'var(--brand-gold)';
                                                }}
                                                onMouseLeave={(e) => {
                                                    e.currentTarget.style.background = 'transparent';
                                                    e.currentTarget.style.color = 'var(--text-secondary)';
                                                }}
                                                onClick={() => setOpenDropdown(null)}
                                            >
                                                {sub.label}
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
                            href="/booking"
                            className="font-semibold px-6 py-2 rounded-full transition hover:scale-105 whitespace-nowrap"
                            style={{
                                background: 'var(--brand-gold)',
                                color: 'var(--text-on-gold)',
                            }}
                            onMouseEnter={(e) => {
                                e.currentTarget.style.background = 'var(--brand-gold-hover)';
                            }}
                            onMouseLeave={(e) => {
                                e.currentTarget.style.background = 'var(--brand-gold)';
                            }}
                        >
                            Book Now
                        </Link>
                    </div>

                    {/* Mobile Menu Button */}
                    <div className="flex items-center gap-4 lg:hidden">
                        <ThemeToggle />
                        <button
                            onClick={() => setIsOpen(!isOpen)}
                            className="text-2xl"
                            style={{ color: 'var(--text-secondary)' }}
                            aria-label="Toggle navigation menu"
                        >
                            {isOpen ? <FaTimes /> : <FaBars />}
                        </button>
                    </div>
                </div>

                {/* Mobile Menu */}
                {isOpen && (
                    <div
                        className="lg:hidden pb-6 space-y-2 max-h-[80vh] overflow-y-auto"
                    >
                        {menuItems.map((item) => (
                            <div key={item.id}>
                                {item.children && item.children.length > 0 ? (
                                    <>
                                        <div className="flex items-center justify-between">
                                            <Link
                                                href={item.url}
                                                className="py-2 font-medium transition"
                                                style={{ color: 'var(--text-secondary)' }}
                                                onClick={() => setIsOpen(false)}
                                            >
                                                {item.label}
                                            </Link>
                                            <button
                                                className="p-2 transition"
                                                style={{ color: 'var(--text-tertiary)' }}
                                                onClick={() => toggleDropdown(item.label)}
                                            >
                                                <FaChevronDown className={`text-xs transition-transform duration-200 ${openDropdown === item.label ? 'rotate-180' : ''
                                                    }`} />
                                            </button>
                                        </div>
                                        {openDropdown === item.label && (
                                            <div
                                                className="pl-4 space-y-1 ml-2"
                                                style={{ borderLeft: '2px solid var(--brand-gold)' }}
                                            >
                                                {item.children.map((sub) => (
                                                    <Link
                                                        key={sub.id}
                                                        href={sub.url}
                                                        className="block py-2 transition"
                                                        style={{ color: 'var(--text-tertiary)' }}
                                                        onClick={() => {
                                                            setIsOpen(false);
                                                            setOpenDropdown(null);
                                                        }}
                                                    >
                                                        {sub.label}
                                                    </Link>
                                                ))}
                                            </div>
                                        )}
                                    </>
                                ) : (
                                    <Link
                                        href={item.url}
                                        className="block py-2 font-medium transition"
                                        style={{ color: 'var(--text-secondary)' }}
                                        onClick={() => setIsOpen(false)}
                                    >
                                        {item.label}
                                    </Link>
                                )}
                            </div>
                        ))}
                        <Link
                            href="/booking"
                            className="block mt-2 font-semibold text-center px-4 py-2 rounded-full transition"
                            style={{
                                background: 'var(--brand-gold)',
                                color: 'var(--text-on-gold)',
                            }}
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
