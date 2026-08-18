// ============================================
// FOOTER COMPONENT (with Brand Theme Support)
// ============================================

import Link from 'next/link';
import Image from 'next/image';
import { FaFacebook, FaTwitter, FaInstagram, FaLinkedin, FaTiktok, FaMapMarkerAlt, FaPhoneAlt, FaEnvelope } from 'react-icons/fa';

export default function Footer() {
    const currentYear = new Date().getFullYear();

    const socialLinks = [
        { name: 'Facebook', icon: FaFacebook, url: 'https://facebook.com/henjosafaris' },
        { name: 'Twitter', icon: FaTwitter, url: 'https://twitter.com/henjosafaris' },
        { name: 'Instagram', icon: FaInstagram, url: 'https://instagram.com/henjo.african.safaris' },
        { name: 'LinkedIn', icon: FaLinkedin, url: '#' },
        { name: 'TikTok', icon: FaTiktok, url: '#' },
    ];

    const quickLinks = [
        { name: 'Home', href: '/' },
        { name: 'Kenya Safaris', href: '/safaris' },
        { name: 'Uganda Safaris', href: '/safaris' },
        { name: 'Gorilla Trekking', href: '/safaris?category=gorilla' },
        { name: 'Tanzania Safaris', href: '/safaris' },
        { name: 'Rwanda Safaris', href: '/safaris' },
        { name: 'Book Schedule A Meeting', href: '/booking' },
        { name: 'Pay Online', href: 'https://payments.pesapal.com/henjoafricansafaris' },
    ];

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
                                    src="/images/henjo_icon_logo.png"
                                    alt="Henjo African Safaris"
                                    fill
                                    className="object-cover"
                                />
                            </div>
                            <span className="font-bold text-lg text-white leading-tight">
                                Henjo African<br />Safaris
                            </span>
                        </div>
                        <p className="text-sm leading-relaxed" style={{ color: '#9A968E' }}>
                            Authentic African Safaris to Kenya, Uganda, Tanzania, and Rwanda.
                            Bespoke tours, tailor-made holidays, and luxury experiences.
                        </p>
                    </div>

                    {/* Quick Links */}
                    <div>
                        <h4 className="font-bold mb-4 text-white pb-2 border-b-2 inline-block" style={{ borderColor: 'var(--brand-gold)' }}>Quick Links</h4>
                        <ul className="space-y-2 text-sm" style={{ color: '#9A968E' }}>
                            {quickLinks.map((link) => (
                                <li key={link.name}>
                                    <Link 
                                        href={link.href} 
                                        className="transition hover:text-[var(--brand-gold)]"
                                        {...(link.href.startsWith('http') ? { target: '_blank', rel: 'noopener noreferrer' } : {})}
                                    >
                                        {link.name}
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
                                    Plot 402, Seguku, Entebbe<br />
                                    Box 700589, Entebbe, Uganda
                                </span>
                            </li>
                            <li className="flex items-start gap-2">
                                <span className="mt-1" style={{ color: 'var(--brand-gold)' }}><FaPhoneAlt /></span>
                                <span>
                                    <strong className="text-white">Uganda:</strong> +256 779 557 514
                                </span>
                            </li>
                            <li className="flex items-start gap-2">
                                <span className="mt-1" style={{ color: 'var(--brand-gold)' }}><FaEnvelope /></span>
                                <span>
                                    <a href="mailto:info@henjosafaris.com" className="transition hover:text-[var(--brand-gold)]">
                                        info@henjosafaris.com
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
                                        href={social.url}
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
                            <div className="relative w-full h-12">
                                <Image
                                    src="/images/site/payment-logo-sprite-1-1.png"
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
                    <p>{currentYear} | All rights reserved - Henjo African Safaris.</p>
                </div>
            </div>
        </footer>
    );
}