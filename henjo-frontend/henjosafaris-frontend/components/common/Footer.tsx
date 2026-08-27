// ============================================
// FOOTER COMPONENT (with Brand Theme Support)
// ============================================

import Link from 'next/link';
import Image from 'next/image';
import { FaFacebook, FaTwitter, FaInstagram, FaLinkedin, FaTiktok, FaTripadvisor, FaMapMarkerAlt, FaPhoneAlt, FaEnvelope, FaWhatsapp } from 'react-icons/fa';
import type { SiteSettings } from '@/types/settings';
import type { MenuItem } from '@/types/menu';
import { getWhatsAppUrl } from '@/lib/utils/whatsapp';

const API_ORIGIN = (process.env.NEXT_PUBLIC_API_URL || 'http://localhost:8000/api/v1').replace(/\/api\/v1\/?$/, '');

interface FooterProps {
    settings: SiteSettings | null;
    quickLinks: MenuItem[];
}

export default function Footer({ settings, quickLinks }: FooterProps) {
    const currentYear = new Date().getFullYear();

    const socialLinks = [
        { name: 'Facebook', icon: FaFacebook, url: settings?.facebook_url },
        { name: 'Twitter', icon: FaTwitter, url: settings?.twitter_url },
        { name: 'Instagram', icon: FaInstagram, url: settings?.instagram_url },
        { name: 'LinkedIn', icon: FaLinkedin, url: settings?.linkedin_url },
        { name: 'TikTok', icon: FaTiktok, url: settings?.tiktok_url },
        { name: 'TripAdvisor', icon: FaTripadvisor, url: settings?.tripadvisor_url },
    ].filter((social) => social.url);

    const whatsappUrl = getWhatsAppUrl(settings?.phone);

    const siteName = settings?.site_name || 'Henjo African Safaris';

    return (
        <footer
            className="relative transition-colors duration-300"
            style={{
                background: 'var(--bg-footer)',
                color: '#E0DDD5',
            }}
        >
            {/* Brand accent line */}
            <div
                className="h-1 w-full"
                style={{ background: 'linear-gradient(90deg, var(--brand-gold), var(--brand-green))' }}
            />

            <div className="container mx-auto px-4 py-12">
                <div className="grid grid-cols-1 md:grid-cols-4 gap-8">

                    {/* Company Info */}
                    <div>
                        <div className="flex items-center gap-3 mb-4">
                            <div
                                className="relative w-14 h-14 rounded-full overflow-hidden bg-white flex-shrink-0"
                                style={{ border: '2px solid var(--brand-gold)' }}
                            >
                                <Image
                                    src={settings?.logo_url || '/images/henjo_icon_logo.webp'}
                                    alt={siteName}
                                    fill
                                    className="object-cover"
                                />
                            </div>
                            <span className="font-bold text-lg text-white leading-tight">
                                {siteName}
                            </span>
                        </div>
                        <p className="text-sm leading-relaxed" style={{ color: '#9A968E' }}>
                            {settings?.footer_tagline}
                        </p>
                    </div>

                    {/* Quick Links */}
                    <div>
                        <h4 className="font-bold mb-4 text-white pb-2 border-b-2 inline-block" style={{ borderColor: 'var(--brand-gold)' }}>Quick Links</h4>
                        <ul className="space-y-2 text-sm" style={{ color: '#9A968E' }}>
                            {quickLinks.map((link) => (
                                <li key={link.id}>
                                    <Link
                                        href={link.url}
                                        className="transition hover:text-[var(--brand-gold)]"
                                        {...(link.url.startsWith('http') ? { target: '_blank', rel: 'noopener noreferrer' } : {})}
                                    >
                                        {link.label}
                                    </Link>
                                </li>
                            ))}
                        </ul>
                    </div>

                    {/* Contact Info */}
                    <div>
                        <h4 className="font-bold mb-4 text-white pb-2 border-b-2 inline-block" style={{ borderColor: 'var(--brand-gold)' }}>Contact Us</h4>
                        <ul className="space-y-3 text-sm" style={{ color: '#9A968E' }}>
                            <li className="flex items-start gap-2">
                                <span className="mt-1" style={{ color: 'var(--brand-gold)' }}><FaMapMarkerAlt /></span>
                                <span>
                                    <strong className="text-white">Uganda Office:</strong><br />
                                    {settings?.address}
                                </span>
                            </li>
                            <li className="flex items-start gap-2">
                                <span className="mt-1" style={{ color: 'var(--brand-gold)' }}><FaPhoneAlt /></span>
                                <span>
                                    <strong className="text-white">Uganda:</strong> {settings?.phone}
                                </span>
                            </li>
                            {whatsappUrl && (
                                <li className="flex items-start gap-2">
                                    <span className="mt-1" style={{ color: '#25D366' }}><FaWhatsapp /></span>
                                    <span>
                                        <a href={whatsappUrl} target="_blank" rel="noopener noreferrer" className="transition hover:text-[var(--brand-gold)]">
                                            <strong className="text-white">WhatsApp:</strong> {settings?.phone}
                                        </a>
                                    </span>
                                </li>
                            )}
                            <li className="flex items-start gap-2">
                                <span className="mt-1" style={{ color: 'var(--brand-gold)' }}><FaEnvelope /></span>
                                <span>
                                    <a href={`mailto:${settings?.email}`} className="transition hover:text-[var(--brand-gold)]">
                                        {settings?.email}
                                    </a>
                                </span>
                            </li>
                        </ul>
                    </div>

                    {/* Social & Payment */}
                    <div>
                        <h4 className="font-bold mb-4 text-white pb-2 border-b-2 inline-block" style={{ borderColor: 'var(--brand-gold)' }}>Follow Us</h4>
                        <div className="flex space-x-4 mb-6">
                            {socialLinks.map((social) => {
                                const Icon = social.icon;
                                return (
                                    <a
                                        key={social.name}
                                        href={social.url!}
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        className="p-2 rounded-full transition-colors duration-300 bg-white/10 hover:bg-[var(--brand-gold)] text-[#9A968E] hover:text-[#1A1A1A]"
                                        aria-label={`Follow us on ${social.name}`}
                                    >
                                        <Icon size={20} />
                                    </a>
                                );
                            })}
                        </div>

                        <div className="mt-4">
                            <h4 className="font-bold mb-3 text-white">Secure Payments</h4>
                            {settings?.payment_url && (
                                <a
                                    href={settings.payment_url}
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    className="inline-block mb-3 font-bold text-sm px-5 py-2.5 rounded-full transition hover:scale-105"
                                    style={{ background: 'var(--brand-gold)', color: '#1A1A1A' }}
                                >
                                    Pay Now
                                </a>
                            )}
                            <div className="relative w-full h-12">
                                <Image
                                    src={`${API_ORIGIN}/storage/images/online-payment.png`}
                                    alt="Payment methods accepted"
                                    fill
                                    className="object-contain"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    className="mt-8 pt-8 text-center text-sm"
                    style={{
                        borderTop: '1px solid rgba(255,255,255,0.1)',
                        color: '#6B685F',
                    }}
                >
                    <p>{currentYear} | All rights reserved - {siteName}.</p>
                </div>
            </div>
        </footer>
    );
}
