// ============================================
// FOOTER COMPONENT (with Dark Theme Support)
// ============================================

import Link from 'next/link';
import Image from 'next/image';
import { FaFacebook, FaTwitter, FaInstagram, FaLinkedin, FaTiktok } from 'react-icons/fa';

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
        <footer className="bg-gray-900 dark:bg-gray-950 text-white transition-colors duration-300">
            <div className="container mx-auto px-4 py-12">
                <div className="grid grid-cols-1 md:grid-cols-4 gap-8">
                    
                    {/* Company Info */}
                    <div>
                        <div className="relative w-32 h-16 mb-4">
                            <Image
                                src="/images/henjo_icon_logo.png"
                                alt="Henjo African Safaris"
                                fill
                                className="object-contain"
                            />
                        </div>
                        <p className="text-gray-400 text-sm leading-relaxed">
                            Authentic African Safaris to Kenya, Uganda, Tanzania, and Rwanda. 
                            Bespoke tours, tailor-made holidays, and luxury experiences.
                        </p>
                    </div>

                    {/* Quick Links */}
                    <div>
                        <h4 className="font-bold mb-4 text-white">Quick Links</h4>
                        <ul className="space-y-2 text-gray-400 text-sm">
                            {quickLinks.map((link) => (
                                <li key={link.name}>
                                    <Link 
                                        href={link.href} 
                                        className="hover:text-yellow-500 transition"
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
                        <h4 className="font-bold mb-4 text-white">Contact Us</h4>
                        <ul className="space-y-3 text-gray-400 text-sm">
                            <li className="flex items-start gap-2">
                                <span className="text-yellow-500 mt-1">📍</span>
                                <span>
                                    <strong className="text-white">Uganda Office:</strong><br />
                                    Plot 402, Seguku, Entebbe<br />
                                    Box 700589, Entebbe, Uganda
                                </span>
                            </li>
                            <li className="flex items-start gap-2">
                                <span className="text-yellow-500 mt-1">📞</span>
                                <span>
                                    <strong className="text-white">Uganda:</strong> +256 779 557 514
                                </span>
                            </li>
                            <li className="flex items-start gap-2">
                                <span className="text-yellow-500 mt-1">✉️</span>
                                <span>
                                    <a href="mailto:info@henjosafaris.com" className="hover:text-yellow-500 transition">
                                        info@henjosafaris.com
                                    </a>
                                </span>
                            </li>
                        </ul>
                    </div>

                    {/* Social & Payment */}
                    <div>
                        <h4 className="font-bold mb-4 text-white">Follow Us</h4>
                        <div className="flex space-x-4 mb-6">
                            {socialLinks.map((social) => {
                                const Icon = social.icon;
                                return (
                                    <a
                                        key={social.name}
                                        href={social.url}
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        className="bg-gray-800 hover:bg-yellow-500 p-2 rounded-full transition text-gray-400 hover:text-white"
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

                <div className="border-t border-gray-800 dark:border-gray-700 mt-8 pt-8 text-center text-gray-500 text-sm">
                    <p>{currentYear} | All rights reserved - Henjo African Safaris.</p>
                </div>
            </div>
        </footer>
    );
}