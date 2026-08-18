// ============================================
// CONTACT PAGE
// ============================================
// This page displays contact information and a contact form.
// All contact details are from the content audit document.
// 
// Page sections:
// 1. Hero section with page title
// 2. Contact Information (address, phone, email, hours)
// 3. Contact Form (with validation and success state)
// 4. Social Media Links
// ============================================

'use client';
// ✅ Client Component because:
// - It uses useState for form handling
// - Form submissions are client-side

import { useState } from 'react';
import { submitInquiry, InquiryFormData } from '@/lib/api/contactApi';
import Hero from '@/components/common/Hero';
import {
    FaPhone,
    FaEnvelope,
    FaMapMarkerAlt,
    FaClock,
    FaFacebook,
    FaTwitter,
    FaInstagram,
    FaLinkedin,
    FaTiktok
} from 'react-icons/fa';

export default function ContactPage() {
    // ============================================
    // STATE MANAGEMENT
    // ============================================

    // 📌 form: Stores form field values
    const [form, setForm] = useState({
        name: '',
        email: '',
        phone: '',
        message: ''
    });

    // 📌 submitted: Tracks if form was successfully submitted
    const [submitted, setSubmitted] = useState(false);

    // ============================================
    // CONTACT DATA (from audit document)
    // ============================================

    // 📌 officeAddresses: Main office location
    const officeAddresses = [
        {
            country: 'Uganda Office',
            address: 'Plot 402, Seguku, Entebbe, Box 700589, Entebbe, Uganda',
            phone: '+256 779 557 514',
            email: 'info@henjosafaris.com'
        }
    ];

    // 📌 internationalContacts: Phone numbers by country
    const internationalContacts = [
        { country: 'Kenya', phone: '+254 739 013 098' },
        { country: 'USA / Canada', phone: '+1 929 243 9699' },
        { country: 'United Kingdom', phone: '+44 1226 520 77' },
        { country: 'Netherlands', phone: '+31 6 1675 3816' },
    ];

    // 📌 socialLinks: Social media profiles with icons
    const socialLinks = [
        { name: 'Facebook', icon: FaFacebook, url: 'https://facebook.com/henjosafaris' },
        { name: 'Twitter', icon: FaTwitter, url: 'https://twitter.com/henjosafaris' },
        { name: 'Instagram', icon: FaInstagram, url: 'https://instagram.com/henjo.african.safaris' },
        { name: 'LinkedIn', icon: FaLinkedin, url: '#' },
        { name: 'TikTok', icon: FaTiktok, url: '#' },
    ];

    // ============================================
    // FORM HANDLERS
    // ============================================

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        console.log('📧 Form submitted:', form);
        setSubmitted(true);
        setForm({ name: '', email: '', phone: '', message: '' });
        setTimeout(() => setSubmitted(false), 5000);
    };



    // ============================================
    // RENDER: PAGE HTML
    // ============================================

    return (
        <div className="min-h-screen">
            {/* HERO SECTION */}
            <Hero
                size="medium"
                title="Get In Touch"
                subtitle="Have questions about our safaris? We'd love to hear from you."
                ctaText="Book Now"
                ctaLink="/safaris"
                backgroundImage="/images/placeholder.png"
                overlay={true}
                showTagline={false}
            />

            {/* MAIN CONTENT: 2-Column Grid */}
            <div
                className="py-16 transition-colors duration-300"
                style={{ background: 'var(--bg-secondary)' }}
            >
                <div className="container mx-auto px-4 max-w-4xl">
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-8">

                        {/* COLUMN 1: Contact Information */}
                        <div
                            className="rounded-2xl p-8"
                            style={{
                                background: 'var(--bg-card)',
                                boxShadow: 'var(--shadow-lg)',
                            }}
                        >
                            <h2 className="text-2xl font-bold mb-6" style={{ color: 'var(--text-primary)' }}>
                                Contact Information
                            </h2>

                            <div className="space-y-6">

                                {/* Office Address */}
                                {officeAddresses.map((office) => (
                                    <div key={office.country} className="space-y-3">
                                        <h3 className="font-bold" style={{ color: 'var(--text-primary)' }}>{office.country}</h3>

                                        {/* Address */}
                                        <div className="flex items-start gap-4">
                                            <div
                                                className="p-3 rounded-full flex-shrink-0"
                                                style={{ background: 'var(--brand-gold-subtle)' }}
                                            >
                                                <FaMapMarkerAlt className="text-xl" style={{ color: 'var(--brand-gold)' }} />
                                            </div>
                                            <div>
                                                <p className="text-sm" style={{ color: 'var(--text-secondary)' }}>{office.address}</p>
                                            </div>
                                        </div>

                                        {/* Phone */}
                                        <div className="flex items-start gap-4">
                                            <div
                                                className="p-3 rounded-full flex-shrink-0"
                                                style={{ background: 'var(--brand-gold-subtle)' }}
                                            >
                                                <FaPhone className="text-xl" style={{ color: 'var(--brand-gold)' }} />
                                            </div>
                                            <div>
                                                <p style={{ color: 'var(--text-secondary)' }}>{office.phone}</p>
                                            </div>
                                        </div>

                                        {/* Email */}
                                        <div className="flex items-start gap-4">
                                            <div
                                                className="p-3 rounded-full flex-shrink-0"
                                                style={{ background: 'var(--brand-gold-subtle)' }}
                                            >
                                                <FaEnvelope className="text-xl" style={{ color: 'var(--brand-gold)' }} />
                                            </div>
                                            <div>
                                                <a
                                                    href={`mailto:${office.email}`}
                                                    className="transition hover:text-[var(--brand-gold)]"
                                                    style={{ color: 'var(--text-secondary)' }}
                                                >
                                                    {office.email}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                ))}

                                {/* International Contacts */}
                                <div>
                                    <h3 className="font-bold mb-3" style={{ color: 'var(--text-primary)' }}>
                                        International Contacts
                                    </h3>
                                    <div className="grid grid-cols-2 gap-2 text-sm">
                                        {internationalContacts.map((contact) => (
                                            <div
                                                key={contact.country}
                                                className="p-2 rounded-lg"
                                                style={{ background: 'var(--bg-secondary)' }}
                                            >
                                                <p className="font-semibold" style={{ color: 'var(--text-primary)' }}>{contact.country}</p>
                                                <p style={{ color: 'var(--text-secondary)' }}>{contact.phone}</p>
                                            </div>
                                        ))}
                                    </div>
                                </div>

                                {/* Working Hours */}
                                <div className="flex items-start gap-4">
                                    <div
                                        className="p-3 rounded-full flex-shrink-0"
                                        style={{ background: 'var(--brand-gold-subtle)' }}
                                    >
                                        <FaClock className="text-xl" style={{ color: 'var(--brand-gold)' }} />
                                    </div>
                                    <div>
                                        <p className="font-semibold" style={{ color: 'var(--text-primary)' }}>Working Hours</p>
                                        <p style={{ color: 'var(--text-secondary)' }}>Mon - Fri: 8:00 AM - 6:00 PM (EAT)</p>
                                        <p style={{ color: 'var(--text-secondary)' }}>Sat: 9:00 AM - 4:00 PM (EAT)</p>
                                    </div>
                                </div>

                                {/* Social Media */}
                                <div className="pt-4" style={{ borderTop: '1px solid var(--border-primary)' }}>
                                    <p className="font-semibold mb-4" style={{ color: 'var(--text-primary)' }}>Follow Us</p>
                                    <div className="flex gap-4">
                                        {socialLinks.map((social) => {
                                            const Icon = social.icon;
                                            return (
                                                <a
                                                    key={social.name}
                                                    href={social.url}
                                                    target="_blank"
                                                    rel="noopener noreferrer"
                                                    className="p-3 rounded-full transition"
                                                    style={{
                                                        background: 'var(--bg-secondary)',
                                                        color: 'var(--text-tertiary)',
                                                    }}
                                                    onMouseEnter={(e) => {
                                                        e.currentTarget.style.background = 'var(--brand-gold)';
                                                        e.currentTarget.style.color = '#FFFFFF';
                                                    }}
                                                    onMouseLeave={(e) => {
                                                        e.currentTarget.style.background = 'var(--bg-secondary)';
                                                        e.currentTarget.style.color = 'var(--text-tertiary)';
                                                    }}
                                                    aria-label={`Follow us on ${social.name}`}
                                                >
                                                    <Icon size={20} />
                                                </a>
                                            );
                                        })}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {/* COLUMN 2: Contact Form */}
                        <div
                            className="rounded-2xl p-8"
                            style={{
                                background: 'var(--bg-card)',
                                boxShadow: 'var(--shadow-lg)',
                            }}
                        >
                            <h2 className="text-2xl font-bold mb-6" style={{ color: 'var(--text-primary)' }}>
                                Send Us a Message
                            </h2>

                            {/* Show success message after submission */}
                            {submitted ? (
                                <div
                                    className="p-6 rounded-xl text-center"
                                    style={{
                                        background: 'var(--brand-green-subtle)',
                                        border: '1px solid var(--brand-green)',
                                        color: 'var(--brand-green)',
                                    }}
                                >
                                    <div className="text-4xl mb-3">✅</div>
                                    <h3 className="font-bold text-lg">Message Sent!</h3>
                                    <p className="text-sm opacity-80">We'll get back to you within 24 hours.</p>
                                </div>
                            ) : (
                                <form onSubmit={handleSubmit} className="space-y-5">

                                    {/* Name Field */}
                                    <div>
                                        <label className="block text-sm font-medium mb-1" style={{ color: 'var(--text-secondary)' }}>
                                            Your Name *
                                        </label>
                                        <input
                                            type="text"
                                            className="w-full px-4 py-3 rounded-xl outline-none transition"
                                            style={{
                                                background: 'var(--bg-input)',
                                                border: '1px solid var(--border-primary)',
                                                color: 'var(--text-primary)',
                                            }}
                                            placeholder="John Doe"
                                            value={form.name}
                                            onChange={(e) => setForm({ ...form, name: e.target.value })}
                                            required
                                        />
                                    </div>

                                    {/* Email Field */}
                                    <div>
                                        <label className="block text-sm font-medium mb-1" style={{ color: 'var(--text-secondary)' }}>
                                            Email Address *
                                        </label>
                                        <input
                                            type="email"
                                            className="w-full px-4 py-3 rounded-xl outline-none transition"
                                            style={{
                                                background: 'var(--bg-input)',
                                                border: '1px solid var(--border-primary)',
                                                color: 'var(--text-primary)',
                                            }}
                                            placeholder="john@example.com"
                                            value={form.email}
                                            onChange={(e) => setForm({ ...form, email: e.target.value })}
                                            required
                                        />
                                    </div>

                                    {/* Phone Field */}
                                    <div>
                                        <label className="block text-sm font-medium mb-1" style={{ color: 'var(--text-secondary)' }}>
                                            Phone Number
                                        </label>
                                        <input
                                            type="tel"
                                            className="w-full px-4 py-3 rounded-xl outline-none transition"
                                            style={{
                                                background: 'var(--bg-input)',
                                                border: '1px solid var(--border-primary)',
                                                color: 'var(--text-primary)',
                                            }}
                                            placeholder="+256 779 557 514"
                                            value={form.phone}
                                            onChange={(e) => setForm({ ...form, phone: e.target.value })}
                                        />
                                    </div>

                                    {/* Message Field */}
                                    <div>
                                        <label className="block text-sm font-medium mb-1" style={{ color: 'var(--text-secondary)' }}>
                                            Message *
                                        </label>
                                        <textarea
                                            rows={5}
                                            className="w-full px-4 py-3 rounded-xl outline-none transition resize-none"
                                            style={{
                                                background: 'var(--bg-input)',
                                                border: '1px solid var(--border-primary)',
                                                color: 'var(--text-primary)',
                                            }}
                                            placeholder="Tell us about your dream safari..."
                                            value={form.message}
                                            onChange={(e) => setForm({ ...form, message: e.target.value })}
                                            required
                                        />
                                    </div>

                                    {/* Submit Button */}
                                    <button
                                        type="submit"
                                        className="w-full font-bold py-4 rounded-xl transition transform hover:scale-[1.02]"
                                        style={{
                                            background: 'var(--brand-gold)',
                                            color: 'var(--text-on-gold)',
                                        }}
                                    >
                                        Send Message
                                    </button>

                                    {/* Trust Signal */}
                                    <p className="text-xs text-center mt-2" style={{ color: 'var(--text-muted)' }}>
                                        We'll respond within 24 hours. Your information is secure with us.
                                    </p>
                                </form>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}