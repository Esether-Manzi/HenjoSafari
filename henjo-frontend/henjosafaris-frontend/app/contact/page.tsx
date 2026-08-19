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
// Client Component because:
// - It uses useState for form handling
// - Form submissions are client-side

import { useState, useEffect } from 'react';
import { submitInquiry } from '@/lib/api/contactApi';
import { settingsApi } from '@/lib/api/settingsApi';
import { pagesApi } from '@/lib/api/pagesApi';
import Hero from '@/components/common/Hero';
import type { SiteSettings } from '@/types/settings';
import type { CmsPage } from '@/types/page';
import {
    FaPhone,
    FaEnvelope,
    FaMapMarkerAlt,
    FaClock,
    FaFacebook,
    FaTwitter,
    FaInstagram,
    FaLinkedin,
    FaTiktok,
    FaCheckCircle
} from 'react-icons/fa';

// International phone numbers aren't part of the editable CMS content —
// they're a fixed, rarely-changing list tied to each regional office.
const internationalContacts = [
    { country: 'Kenya', phone: '+254 739 013 098' },
    { country: 'USA / Canada', phone: '+1 929 243 9699' },
    { country: 'United Kingdom', phone: '+44 1226 520 77' },
    { country: 'Netherlands', phone: '+31 6 1675 3816' },
];

export default function ContactPage() {
    // ============================================
    // STATE MANAGEMENT
    // ============================================

    // form: Stores form field values
    const [form, setForm] = useState({
        name: '',
        email: '',
        phone: '',
        message: ''
    });

    // submitted: Tracks if form was successfully submitted
    const [submitted, setSubmitted] = useState(false);
    const [submitting, setSubmitting] = useState(false);
    const [submitError, setSubmitError] = useState<string | null>(null);

    const [settings, setSettings] = useState<SiteSettings | null>(null);
    const [page, setPage] = useState<CmsPage | null>(null);

    useEffect(() => {
        const fetchData = async () => {
            try {
                const [settingsRes, pageRes] = await Promise.all([
                    settingsApi.getSettings(),
                    pagesApi.getBySlug('contact'),
                ]);
                if (settingsRes.success) setSettings(settingsRes.data);
                if (pageRes.success) setPage(pageRes.data);
            } catch (err) {
                console.warn('Unable to load contact page content:', err);
            }
        };
        fetchData();
    }, []);

    const socialLinks = [
        { name: 'Facebook', icon: FaFacebook, url: settings?.facebook_url },
        { name: 'Twitter', icon: FaTwitter, url: settings?.twitter_url },
        { name: 'Instagram', icon: FaInstagram, url: settings?.instagram_url },
        { name: 'LinkedIn', icon: FaLinkedin, url: settings?.linkedin_url },
        { name: 'TikTok', icon: FaTiktok, url: settings?.tiktok_url },
    ].filter((social) => social.url);

    // ============================================
    // FORM HANDLERS
    // ============================================

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();
        setSubmitting(true);
        setSubmitError(null);
        try {
            await submitInquiry({
                name: form.name,
                email: form.email,
                phone: form.phone || undefined,
                subject: 'Website Contact Form',
                message: form.message,
            });
            setSubmitted(true);
            setForm({ name: '', email: '', phone: '', message: '' });
            setTimeout(() => setSubmitted(false), 5000);
        } catch (err: any) {
            setSubmitError(err.message || 'Failed to send your message. Please try again.');
        } finally {
            setSubmitting(false);
        }
    };



    // ============================================
    // RENDER: PAGE HTML
    // ============================================

    return (
        <div className="min-h-screen">
            {/* HERO SECTION */}
            <Hero
                size="medium"
                title={page?.hero_title || 'Get In Touch'}
                subtitle={page?.hero_subtitle || "Have questions about our safaris? We'd love to hear from you."}
                ctaText={page?.hero_cta_text || 'Book Now'}
                ctaLink={page?.hero_cta_href || '/safaris'}
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
                                <div className="space-y-3">
                                    <h3 className="font-bold" style={{ color: 'var(--text-primary)' }}>Uganda Office</h3>

                                    {/* Address */}
                                    <div className="flex items-start gap-4">
                                        <div
                                            className="p-3 rounded-full flex-shrink-0"
                                            style={{ background: 'var(--brand-gold-subtle)' }}
                                        >
                                            <FaMapMarkerAlt className="text-xl" style={{ color: 'var(--brand-gold)' }} />
                                        </div>
                                        <div>
                                            <p className="text-sm" style={{ color: 'var(--text-secondary)' }}>{settings?.address}</p>
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
                                            <p style={{ color: 'var(--text-secondary)' }}>{settings?.phone}</p>
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
                                                href={`mailto:${settings?.email}`}
                                                className="transition hover:text-[var(--brand-gold)]"
                                                style={{ color: 'var(--text-secondary)' }}
                                            >
                                                {settings?.email}
                                            </a>
                                        </div>
                                    </div>
                                </div>

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
                                        <p style={{ color: 'var(--text-secondary)' }}>{settings?.working_hours_weekday}</p>
                                        <p style={{ color: 'var(--text-secondary)' }}>{settings?.working_hours_saturday}</p>
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
                                                    href={social.url!}
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
                                    <FaCheckCircle className="text-4xl mb-3 mx-auto" />
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

                                    {/* Error Message */}
                                    {submitError && (
                                        <p className="text-sm text-center" style={{ color: 'var(--brand-maroon)' }}>{submitError}</p>
                                    )}

                                    {/* Submit Button */}
                                    <button
                                        type="submit"
                                        disabled={submitting}
                                        className="w-full font-bold py-4 rounded-xl transition transform hover:scale-[1.02] disabled:opacity-60 disabled:cursor-not-allowed disabled:hover:scale-100"
                                        style={{
                                            background: 'var(--brand-gold)',
                                            color: 'var(--text-on-gold)',
                                        }}
                                    >
                                        {submitting ? 'Sending...' : 'Send Message'}
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