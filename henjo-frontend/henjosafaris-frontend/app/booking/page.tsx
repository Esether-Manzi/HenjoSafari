// ============================================
// BOOKING PAGE
// ============================================
// A premium 3-step booking form that collects:
//   Step 1 — Personal Information
//   Step 2 — Trip Details (package, dates, group size)
//   Step 3 — Review & Submit
//
// On success: shows a confirmation card with booking number.
// API: POST /api/v1/bookings  (BookingController@store)
// ============================================

'use client';

import { useState, useEffect } from 'react';
import { submitBooking, BookingFormData } from '@/lib/api/bookingApi';
import Hero from '@/components/common/Hero';
import {
    FaUser,
    FaMapMarkedAlt,
    FaCheckCircle,
    FaArrowRight,
    FaArrowLeft,
    FaCalendarAlt,
    FaUsers,
    FaChild,
    FaGlobe,
    FaPhone,
    FaEnvelope,
    FaStickyNote,
    FaCompass,
    FaSpinner,
} from 'react-icons/fa';

// ──────────────────────────────────────────────────────────
// TYPES
// ──────────────────────────────────────────────────────────

interface SafariPackageOption {
    id: number;
    title: string;
    slug: string;
    duration_days: number;
    base_price: number;
    currency: string;
}

interface FormData {
    first_name: string;
    last_name: string;
    email: string;
    phone: string;
    country: string;
    package_id: number | null;
    package_name: string;
    travel_date: string;
    adults: number;
    children: number;
    special_requests: string;
}

const STEPS = [
    { id: 1, label: 'Personal Info', icon: FaUser },
    { id: 2, label: 'Trip Details', icon: FaMapMarkedAlt },
    { id: 3, label: 'Review', icon: FaCheckCircle },
];

const COUNTRIES = [
    'Uganda', 'Kenya', 'Tanzania', 'Rwanda', 'South Africa',
    'United States', 'United Kingdom', 'Canada', 'Australia',
    'Germany', 'France', 'Netherlands', 'Belgium', 'Sweden',
    'Norway', 'Denmark', 'Switzerland', 'Italy', 'Spain',
    'Japan', 'China', 'India', 'Brazil', 'Argentina',
    'Other',
];

// ──────────────────────────────────────────────────────────
// COMPONENT
// ──────────────────────────────────────────────────────────

export default function BookingPage() {
    const [currentStep, setCurrentStep] = useState(1);
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState<string | null>(null);
    const [bookingRef, setBookingRef] = useState<string | null>(null);
    const [packages, setPackages] = useState<SafariPackageOption[]>([]);

    const [form, setForm] = useState<FormData>({
        first_name: '',
        last_name: '',
        email: '',
        phone: '',
        country: '',
        package_id: null,
        package_name: '',
        travel_date: '',
        adults: 1,
        children: 0,
        special_requests: '',
    });

    // ── Fetch available safari packages for the dropdown ──
    useEffect(() => {
        const apiUrl = (process.env.NEXT_PUBLIC_API_URL || 'http://localhost:8000/api/v1').replace(/\/+$/, '');
        fetch(`${apiUrl}/safaris`)
            .then((r) => r.json())
            .then((data) => {
                const list: SafariPackageOption[] = Array.isArray(data?.data)
                    ? data.data
                    : Array.isArray(data)
                        ? data
                        : [];
                setPackages(list);
            })
            .catch(() => setPackages([]));
    }, []);

    // ── Helpers ──
    const update = (field: keyof FormData, value: string | number | null) =>
        setForm((prev) => ({ ...prev, [field]: value }));

    const handlePackageChange = (pkgId: string) => {
        if (!pkgId) {
            update('package_id', null);
            update('package_name', '');
            return;
        }
        const pkg = packages.find((p) => p.id === parseInt(pkgId));
        update('package_id', pkg ? pkg.id : null);
        update('package_name', pkg ? pkg.title : '');
    };

    const isStep1Valid =
        form.first_name.trim() &&
        form.last_name.trim() &&
        form.email.trim() &&
        form.phone.trim() &&
        form.country.trim();

    const isStep2Valid =
        form.travel_date &&
        form.adults >= 1;

    const handleNext = () => {
        setError(null);
        setCurrentStep((s) => s + 1);
    };

    const handleBack = () => {
        setError(null);
        setCurrentStep((s) => s - 1);
    };

    const handleSubmit = async () => {
        setIsLoading(true);
        setError(null);
        try {
            const payload: BookingFormData = {
                first_name: form.first_name,
                last_name: form.last_name,
                email: form.email,
                phone: form.phone,
                country: form.country,
                package_id: form.package_id,
                package_name: form.package_name || null,
                travel_date: form.travel_date,
                adults: form.adults,
                children: form.children,
                special_requests: form.special_requests || undefined,
            };
            const res = await submitBooking(payload);
            setBookingRef(res.booking_number);
        } catch (err: any) {
            setError(err.message || 'Something went wrong. Please try again.');
        } finally {
            setIsLoading(false);
        }
    };

    // ── Today's date for the min attribute on the date picker ──
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    const minDate = tomorrow.toISOString().split('T')[0];

    // ──────────────────────────────────────────────────────────
    // SHARED INPUT STYLES
    // ──────────────────────────────────────────────────────────
    const inputStyle: React.CSSProperties = {
        background: 'var(--bg-input)',
        border: '1px solid var(--border-primary)',
        color: 'var(--text-primary)',
        borderRadius: '0.75rem',
        padding: '0.85rem 1rem',
        width: '100%',
        fontSize: '0.95rem',
        outline: 'none',
        transition: 'border-color 0.2s',
    };

    const labelStyle: React.CSSProperties = {
        display: 'block',
        fontSize: '0.85rem',
        fontWeight: 600,
        marginBottom: '0.4rem',
        color: 'var(--text-secondary)',
    };

    // ──────────────────────────────────────────────────────────
    // SUCCESS STATE
    // ──────────────────────────────────────────────────────────
    if (bookingRef) {
        return (
            <div className="min-h-screen" style={{ background: 'var(--bg-secondary)' }}>
                <Hero
                    size="small"
                    title="Booking Received!"
                    subtitle="Thank you for choosing Henjo African Safaris."
                    backgroundImage="/images/placeholder.png"
                    overlay={true}
                    showTagline={false}
                />
                <div className="container mx-auto px-4 max-w-2xl py-16">
                    <div
                        className="rounded-2xl p-10 text-center animate-slideUp"
                        style={{ background: 'var(--bg-card)', boxShadow: 'var(--shadow-lg)' }}
                    >
                        {/* Icon */}
                        <div
                            className="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6"
                            style={{ background: 'var(--brand-gold-subtle)' }}
                        >
                            <FaCheckCircle style={{ color: 'var(--brand-gold)', fontSize: '2.5rem' }} />
                        </div>

                        <h2 className="text-2xl font-bold mb-2" style={{ color: 'var(--text-primary)' }}>
                            Your Request is Confirmed!
                        </h2>
                        <p className="mb-6" style={{ color: 'var(--text-secondary)' }}>
                            We've received your booking request and will send you a personalised quote within 24 hours.
                        </p>

                        {/* Booking Reference */}
                        <div
                            className="inline-block px-8 py-4 rounded-xl mb-8"
                            style={{ background: 'var(--brand-gold)', color: 'var(--text-on-gold)' }}
                        >
                            <p className="text-xs font-semibold uppercase tracking-widest mb-1">Booking Reference</p>
                            <p className="text-2xl font-bold tracking-widest">{bookingRef}</p>
                        </div>

                        {/* Summary */}
                        <div
                            className="rounded-xl p-6 text-left space-y-3 mb-8"
                            style={{ background: 'var(--bg-secondary)' }}
                        >
                            {[
                                ['Name', `${form.first_name} ${form.last_name}`],
                                ['Email', form.email],
                                ['Package', form.package_name || 'To be discussed'],
                                ['Date', new Date(form.travel_date).toLocaleDateString('en-GB', { day: 'numeric', month: 'long', year: 'numeric' })],
                                ['Travellers', `${form.adults} adult${form.adults > 1 ? 's' : ''}${form.children ? `, ${form.children} child${form.children > 1 ? 'ren' : ''}` : ''}`],
                            ].map(([label, value]) => (
                                <div key={label} className="flex justify-between text-sm">
                                    <span style={{ color: 'var(--text-muted)' }}>{label}</span>
                                    <span className="font-medium" style={{ color: 'var(--text-primary)' }}>{value}</span>
                                </div>
                            ))}
                        </div>

                        <p className="text-sm" style={{ color: 'var(--text-muted)' }}>
                            Check your email at <strong>{form.email}</strong> — we'll be in touch soon. 🌍
                        </p>

                        <a
                            href="/safaris"
                            className="inline-block mt-6 px-8 py-3 rounded-full font-bold transition hover:scale-105"
                            style={{ background: 'var(--brand-gold)', color: 'var(--text-on-gold)' }}
                        >
                            Browse More Safaris
                        </a>
                    </div>
                </div>
            </div>
        );
    }

    // ──────────────────────────────────────────────────────────
    // MAIN FORM
    // ──────────────────────────────────────────────────────────
    return (
        <div className="min-h-screen">
            {/* HERO */}
            <Hero
                size="medium"
                title="Book Your Safari"
                subtitle="Fill in your details and we'll craft the perfect African adventure for you."
                ctaText="View Packages"
                ctaLink="/safaris"
                backgroundImage="/images/placeholder.png"
                overlay={true}
                showTagline={false}
            />

            <div className="py-16" style={{ background: 'var(--bg-secondary)' }}>
                <div className="container mx-auto px-4 max-w-3xl">

                    {/* ── Progress Steps ── */}
                    <div className="flex items-center justify-center mb-10 gap-0">
                        {STEPS.map((step, idx) => {
                            const Icon = step.icon;
                            const isActive = currentStep === step.id;
                            const isCompleted = currentStep > step.id;
                            return (
                                <div key={step.id} className="flex items-center">
                                    {/* Step Circle */}
                                    <div className="flex flex-col items-center">
                                        <div
                                            className="w-12 h-12 rounded-full flex items-center justify-center font-bold transition-all duration-300"
                                            style={{
                                                background: isCompleted
                                                    ? 'var(--brand-green)'
                                                    : isActive
                                                        ? 'var(--brand-gold)'
                                                        : 'var(--bg-card)',
                                                color: isCompleted || isActive
                                                    ? '#fff'
                                                    : 'var(--text-muted)',
                                                border: isActive
                                                    ? '3px solid var(--brand-gold)'
                                                    : isCompleted
                                                        ? '3px solid var(--brand-green)'
                                                        : '2px solid var(--border-primary)',
                                                boxShadow: isActive ? '0 0 0 4px var(--brand-gold-subtle)' : 'none',
                                            }}
                                        >
                                            {isCompleted ? <FaCheckCircle size={18} /> : <Icon size={18} />}
                                        </div>
                                        <span
                                            className="text-xs font-semibold mt-2 whitespace-nowrap"
                                            style={{ color: isActive ? 'var(--brand-gold)' : isCompleted ? 'var(--brand-green)' : 'var(--text-muted)' }}
                                        >
                                            {step.label}
                                        </span>
                                    </div>

                                    {/* Connector Line */}
                                    {idx < STEPS.length - 1 && (
                                        <div
                                            className="h-0.5 w-16 md:w-24 mx-2 mb-5 transition-all duration-300"
                                            style={{
                                                background: currentStep > step.id
                                                    ? 'var(--brand-green)'
                                                    : 'var(--border-primary)',
                                            }}
                                        />
                                    )}
                                </div>
                            );
                        })}
                    </div>

                    {/* ── Form Card ── */}
                    <div
                        className="rounded-2xl p-8 animate-slideUp"
                        style={{ background: 'var(--bg-card)', boxShadow: 'var(--shadow-lg)' }}
                    >
                        {/* Error Banner */}
                        {error && (
                            <div
                                className="p-4 rounded-xl mb-6 text-sm font-medium"
                                style={{ background: '#fff1f0', border: '1px solid #ffa39e', color: '#cf1322' }}
                            >
                                ⚠️ {error}
                            </div>
                        )}

                        {/* ══════════════ STEP 1 — Personal Info ══════════════ */}
                        {currentStep === 1 && (
                            <div>
                                <div className="flex items-center gap-3 mb-6">
                                    <div
                                        className="w-10 h-10 rounded-full flex items-center justify-center"
                                        style={{ background: 'var(--brand-gold-subtle)' }}
                                    >
                                        <FaUser style={{ color: 'var(--brand-gold)' }} />
                                    </div>
                                    <div>
                                        <h2 className="text-xl font-bold" style={{ color: 'var(--text-primary)' }}>
                                            Personal Information
                                        </h2>
                                        <p className="text-sm" style={{ color: 'var(--text-muted)' }}>
                                            Tell us about yourself so we can personalise your safari.
                                        </p>
                                    </div>
                                </div>

                                <div className="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    {/* First Name */}
                                    <div>
                                        <label style={labelStyle}>
                                            <FaUser className="inline mr-1 mb-0.5" size={11} /> First Name *
                                        </label>
                                        <input
                                            type="text"
                                            style={inputStyle}
                                            placeholder="e.g. Jane"
                                            value={form.first_name}
                                            onChange={(e) => update('first_name', e.target.value)}
                                            required
                                            id="first_name"
                                        />
                                    </div>
                                    {/* Last Name */}
                                    <div>
                                        <label style={labelStyle}>
                                            <FaUser className="inline mr-1 mb-0.5" size={11} /> Last Name *
                                        </label>
                                        <input
                                            type="text"
                                            style={inputStyle}
                                            placeholder="e.g. Doe"
                                            value={form.last_name}
                                            onChange={(e) => update('last_name', e.target.value)}
                                            required
                                            id="last_name"
                                        />
                                    </div>
                                    {/* Email */}
                                    <div>
                                        <label style={labelStyle}>
                                            <FaEnvelope className="inline mr-1 mb-0.5" size={11} /> Email Address *
                                        </label>
                                        <input
                                            type="email"
                                            style={inputStyle}
                                            placeholder="jane@example.com"
                                            value={form.email}
                                            onChange={(e) => update('email', e.target.value)}
                                            required
                                            id="email"
                                        />
                                    </div>
                                    {/* Phone */}
                                    <div>
                                        <label style={labelStyle}>
                                            <FaPhone className="inline mr-1 mb-0.5" size={11} /> Phone Number *
                                        </label>
                                        <input
                                            type="tel"
                                            style={inputStyle}
                                            placeholder="+256 779 557 514"
                                            value={form.phone}
                                            onChange={(e) => update('phone', e.target.value)}
                                            required
                                            id="phone"
                                        />
                                    </div>
                                    {/* Country */}
                                    <div className="md:col-span-2">
                                        <label style={labelStyle}>
                                            <FaGlobe className="inline mr-1 mb-0.5" size={11} /> Country / Nationality *
                                        </label>
                                        <select
                                            style={{ ...inputStyle, cursor: 'pointer' }}
                                            value={form.country}
                                            onChange={(e) => update('country', e.target.value)}
                                            required
                                            id="country"
                                        >
                                            <option value="">Select your country…</option>
                                            {COUNTRIES.map((c) => (
                                                <option key={c} value={c}>{c}</option>
                                            ))}
                                        </select>
                                    </div>
                                </div>

                                {/* Next Button */}
                                <div className="flex justify-end mt-8">
                                    <button
                                        onClick={handleNext}
                                        disabled={!isStep1Valid}
                                        className="flex items-center gap-2 px-8 py-3 rounded-full font-bold transition-all duration-200 hover:scale-105 disabled:opacity-40 disabled:cursor-not-allowed disabled:scale-100"
                                        style={{ background: 'var(--brand-gold)', color: 'var(--text-on-gold)' }}
                                        id="step1-next"
                                    >
                                        Next: Trip Details <FaArrowRight />
                                    </button>
                                </div>
                            </div>
                        )}

                        {/* ══════════════ STEP 2 — Trip Details ══════════════ */}
                        {currentStep === 2 && (
                            <div>
                                <div className="flex items-center gap-3 mb-6">
                                    <div
                                        className="w-10 h-10 rounded-full flex items-center justify-center"
                                        style={{ background: 'var(--brand-gold-subtle)' }}
                                    >
                                        <FaMapMarkedAlt style={{ color: 'var(--brand-gold)' }} />
                                    </div>
                                    <div>
                                        <h2 className="text-xl font-bold" style={{ color: 'var(--text-primary)' }}>
                                            Trip Details
                                        </h2>
                                        <p className="text-sm" style={{ color: 'var(--text-muted)' }}>
                                            When are you travelling and what kind of experience are you looking for?
                                        </p>
                                    </div>
                                </div>

                                <div className="space-y-5">
                                    {/* Destination Country */}
                                    <div>
                                        <label style={labelStyle}>
                                            <FaCompass className="inline mr-1 mb-0.5" size={11} /> Destination Country *
                                        </label>
                                        <select
                                            style={{ ...inputStyle, cursor: 'pointer' }}
                                            value={form.package_id ?? ''}
                                            onChange={(e) => handlePackageChange(e.target.value)}
                                            id="package_id"
                                        >
                                            <option value="">— I'm open to suggestions / not sure yet —</option>
                                            {packages.map((pkg) => (
                                                <option key={pkg.id} value={pkg.id}>
                                                    {pkg.title}
                                                    {pkg.duration_days ? ` (${pkg.duration_days} days)` : ''}
                                                    {pkg.base_price ? ` — from $${Number(pkg.base_price).toLocaleString()}` : ''}
                                                </option>
                                            ))}
                                        </select>
                                        <p className="text-xs mt-1" style={{ color: 'var(--text-muted)' }}>
                                            Don't worry if you haven't decided — we'll help you choose.
                                        </p>
                                    </div>

                                    {/* Safari Package */}
                                    <div>
                                        <label style={labelStyle}>
                                            <FaCompass className="inline mr-1 mb-0.5" size={11} /> Safari Package (Optional)
                                        </label>
                                        <select
                                            style={{ ...inputStyle, cursor: 'pointer' }}
                                            value={form.package_id ?? ''}
                                            onChange={(e) => handlePackageChange(e.target.value)}
                                            id="package_id"
                                        >
                                            <option value="">— I'm open to suggestions / not sure yet —</option>
                                            {packages.map((pkg) => (
                                                <option key={pkg.id} value={pkg.id}>
                                                    {pkg.title}
                                                    {pkg.duration_days ? ` (${pkg.duration_days} days)` : ''}
                                                    {pkg.base_price ? ` — from $${Number(pkg.base_price).toLocaleString()}` : ''}
                                                </option>
                                            ))}
                                        </select>
                                        <p className="text-xs mt-1" style={{ color: 'var(--text-muted)' }}>
                                            Don't worry if you haven't decided — we'll help you choose.
                                        </p>
                                    </div>


                                    {/* Travel Date */}
                                    <div>
                                        <label style={labelStyle}>
                                            <FaCalendarAlt className="inline mr-1 mb-0.5" size={11} /> Preferred Travel Date *
                                        </label>
                                        <input
                                            type="date"
                                            style={inputStyle}
                                            min={minDate}
                                            value={form.travel_date}
                                            onChange={(e) => update('travel_date', e.target.value)}
                                            required
                                            id="travel_date"
                                        />
                                    </div>

                                    {/* Adults & Children */}
                                    <div className="grid grid-cols-1 md:grid-cols-2 gap-5">
                                        <div>
                                            <label style={labelStyle}>
                                                <FaUsers className="inline mr-1 mb-0.5" size={11} /> Adults *
                                            </label>
                                            <div className="flex items-center gap-3">
                                                <button
                                                    type="button"
                                                    onClick={() => update('adults', Math.max(1, form.adults - 1))}
                                                    className="w-10 h-10 rounded-full font-bold text-lg flex items-center justify-center transition hover:scale-110"
                                                    style={{ background: 'var(--bg-secondary)', border: '1px solid var(--border-primary)', color: 'var(--text-primary)' }}
                                                    id="adults-minus"
                                                >
                                                    −
                                                </button>
                                                <span
                                                    className="text-xl font-bold w-8 text-center"
                                                    style={{ color: 'var(--text-primary)' }}
                                                >
                                                    {form.adults}
                                                </span>
                                                <button
                                                    type="button"
                                                    onClick={() => update('adults', Math.min(50, form.adults + 1))}
                                                    className="w-10 h-10 rounded-full font-bold text-lg flex items-center justify-center transition hover:scale-110"
                                                    style={{ background: 'var(--brand-gold)', color: 'var(--text-on-gold)' }}
                                                    id="adults-plus"
                                                >
                                                    +
                                                </button>
                                            </div>
                                        </div>
                                        <div>
                                            <label style={labelStyle}>
                                                <FaChild className="inline mr-1 mb-0.5" size={11} /> Children <span className="font-normal">(under 12)</span>
                                            </label>
                                            <div className="flex items-center gap-3">
                                                <button
                                                    type="button"
                                                    onClick={() => update('children', Math.max(0, form.children - 1))}
                                                    className="w-10 h-10 rounded-full font-bold text-lg flex items-center justify-center transition hover:scale-110"
                                                    style={{ background: 'var(--bg-secondary)', border: '1px solid var(--border-primary)', color: 'var(--text-primary)' }}
                                                    id="children-minus"
                                                >
                                                    −
                                                </button>
                                                <span
                                                    className="text-xl font-bold w-8 text-center"
                                                    style={{ color: 'var(--text-primary)' }}
                                                >
                                                    {form.children}
                                                </span>
                                                <button
                                                    type="button"
                                                    onClick={() => update('children', Math.min(50, form.children + 1))}
                                                    className="w-10 h-10 rounded-full font-bold text-lg flex items-center justify-center transition hover:scale-110"
                                                    style={{ background: 'var(--brand-gold)', color: 'var(--text-on-gold)' }}
                                                    id="children-plus"
                                                >
                                                    +
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    {/* Special Requests */}
                                    <div>
                                        <label style={labelStyle}>
                                            <FaStickyNote className="inline mr-1 mb-0.5" size={11} /> Special Requests / Notes
                                        </label>
                                        <textarea
                                            rows={4}
                                            style={{ ...inputStyle, resize: 'none' }}
                                            placeholder="e.g. dietary requirements, mobility needs, specific animals you'd love to see, honeymoon, family celebration…"
                                            value={form.special_requests}
                                            onChange={(e) => update('special_requests', e.target.value)}
                                            id="special_requests"
                                        />
                                    </div>
                                </div>

                                {/* Navigation */}
                                <div className="flex justify-between mt-8">
                                    <button
                                        onClick={handleBack}
                                        className="flex items-center gap-2 px-6 py-3 rounded-full font-semibold transition hover:scale-105"
                                        style={{ background: 'var(--bg-secondary)', color: 'var(--text-secondary)', border: '1px solid var(--border-primary)' }}
                                        id="step2-back"
                                    >
                                        <FaArrowLeft /> Back
                                    </button>
                                    <button
                                        onClick={handleNext}
                                        disabled={!isStep2Valid}
                                        className="flex items-center gap-2 px-8 py-3 rounded-full font-bold transition-all duration-200 hover:scale-105 disabled:opacity-40 disabled:cursor-not-allowed disabled:scale-100"
                                        style={{ background: 'var(--brand-gold)', color: 'var(--text-on-gold)' }}
                                        id="step2-next"
                                    >
                                        Review Booking <FaArrowRight />
                                    </button>
                                </div>
                            </div>
                        )}

                        {/* ══════════════ STEP 3 — Review & Submit ══════════════ */}
                        {currentStep === 3 && (
                            <div>
                                <div className="flex items-center gap-3 mb-6">
                                    <div
                                        className="w-10 h-10 rounded-full flex items-center justify-center"
                                        style={{ background: 'var(--brand-gold-subtle)' }}
                                    >
                                        <FaCheckCircle style={{ color: 'var(--brand-gold)' }} />
                                    </div>
                                    <div>
                                        <h2 className="text-xl font-bold" style={{ color: 'var(--text-primary)' }}>
                                            Review Your Booking
                                        </h2>
                                        <p className="text-sm" style={{ color: 'var(--text-muted)' }}>
                                            Please confirm your details before submitting.
                                        </p>
                                    </div>
                                </div>

                                {/* Summary Cards */}
                                <div className="space-y-4 mb-8">

                                    {/* Personal Info Card */}
                                    <div
                                        className="rounded-xl p-5"
                                        style={{ background: 'var(--bg-secondary)', border: '1px solid var(--border-subtle)' }}
                                    >
                                        <h3
                                            className="text-xs font-bold uppercase tracking-widest mb-4"
                                            style={{ color: 'var(--brand-gold)' }}
                                        >
                                            👤 Personal Information
                                        </h3>
                                        <div className="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                                            {[
                                                ['Name', `${form.first_name} ${form.last_name}`],
                                                ['Email', form.email],
                                                ['Phone', form.phone],
                                                ['Country', form.country],
                                            ].map(([label, value]) => (
                                                <div key={label}>
                                                    <span style={{ color: 'var(--text-muted)' }}>{label}</span>
                                                    <p className="font-semibold mt-0.5" style={{ color: 'var(--text-primary)' }}>{value}</p>
                                                </div>
                                            ))}
                                        </div>
                                    </div>

                                    {/* Trip Details Card */}
                                    <div
                                        className="rounded-xl p-5"
                                        style={{ background: 'var(--bg-secondary)', border: '1px solid var(--border-subtle)' }}
                                    >
                                        <h3
                                            className="text-xs font-bold uppercase tracking-widest mb-4"
                                            style={{ color: 'var(--brand-gold)' }}
                                        >
                                            🌍 Trip Details
                                        </h3>
                                        <div className="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                                            {[
                                                ['Package', form.package_name || 'To be discussed with our team'],
                                                ['Travel Date', form.travel_date
                                                    ? new Date(form.travel_date).toLocaleDateString('en-GB', { day: 'numeric', month: 'long', year: 'numeric' })
                                                    : '—'
                                                ],
                                                ['Adults', String(form.adults)],
                                                ['Children', String(form.children)],
                                            ].map(([label, value]) => (
                                                <div key={label}>
                                                    <span style={{ color: 'var(--text-muted)' }}>{label}</span>
                                                    <p className="font-semibold mt-0.5" style={{ color: 'var(--text-primary)' }}>{value}</p>
                                                </div>
                                            ))}
                                            {form.special_requests && (
                                                <div className="md:col-span-2">
                                                    <span style={{ color: 'var(--text-muted)' }}>Special Requests</span>
                                                    <p className="font-medium mt-0.5" style={{ color: 'var(--text-primary)' }}>{form.special_requests}</p>
                                                </div>
                                            )}
                                        </div>
                                    </div>

                                    {/* What Happens Next */}
                                    <div
                                        className="rounded-xl p-5"
                                        style={{ background: 'var(--brand-gold-subtle)', border: '1px solid var(--brand-gold)' }}
                                    >
                                        <h3 className="text-xs font-bold uppercase tracking-widest mb-3" style={{ color: 'var(--brand-gold-hover)' }}>
                                            What happens next?
                                        </h3>
                                        <ol className="space-y-1 text-sm" style={{ color: 'var(--text-secondary)' }}>
                                            <li>✅ Your request will be received and reviewed by our team</li>
                                            <li>📧 We'll send a personalised quote to <strong>{form.email}</strong> within 24 hours</li>
                                            <li>💬 A dedicated safari consultant will reach out to discuss details</li>
                                            <li>🦁 Once confirmed, we'll begin tailoring your safari experience!</li>
                                        </ol>
                                    </div>
                                </div>

                                {/* Navigation */}
                                <div className="flex justify-between">
                                    <button
                                        onClick={handleBack}
                                        disabled={isLoading}
                                        className="flex items-center gap-2 px-6 py-3 rounded-full font-semibold transition hover:scale-105"
                                        style={{ background: 'var(--bg-secondary)', color: 'var(--text-secondary)', border: '1px solid var(--border-primary)' }}
                                        id="step3-back"
                                    >
                                        <FaArrowLeft /> Edit Details
                                    </button>
                                    <button
                                        onClick={handleSubmit}
                                        disabled={isLoading}
                                        className="flex items-center gap-2 px-8 py-4 rounded-full font-bold text-base transition-all duration-200 hover:scale-105 disabled:opacity-60 disabled:cursor-not-allowed disabled:scale-100"
                                        style={{ background: 'var(--brand-gold)', color: 'var(--text-on-gold)' }}
                                        id="submit-booking"
                                    >
                                        {isLoading ? (
                                            <>
                                                <FaSpinner className="animate-spin" />
                                                Submitting…
                                            </>
                                        ) : (
                                            <>
                                                Confirm Booking Request <FaCheckCircle />
                                            </>
                                        )}
                                    </button>
                                </div>
                            </div>
                        )}
                    </div>

                    {/* Trust Badges */}
                    <div className="flex flex-wrap justify-center gap-6 mt-10 text-sm" style={{ color: 'var(--text-muted)' }}>
                        {[
                            '🔒 Secure & Private',
                            '📞 No payment required now',
                            '⚡ Response within 24 hours',
                            '✈️ Fully customisable',
                        ].map((badge) => (
                            <span key={badge} className="flex items-center gap-1">{badge}</span>
                        ))}
                    </div>
                </div>
            </div>
        </div>
    );
}
