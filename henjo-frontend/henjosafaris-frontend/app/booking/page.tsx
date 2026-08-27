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
import { useForm } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import { submitBooking, BookingFormData } from '@/lib/api/bookingApi';
import { bookingFormSchema, bookingStep1Schema, bookingStep2Schema, type BookingFormValues } from '@/lib/validation/schemas';
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
    FaExclamationTriangle,
    FaComments,
    FaPaw,
    FaLock,
    FaBolt,
    FaPlaneDeparture,
} from 'react-icons/fa';

// ──────────────────────────────────────────────────────────
// TYPES
// ──────────────────────────────────────────────────────────

interface DestinationCountryOption {
    id: number;
    name: string;
    code: string;
}

interface SafariPackageOption {
    id: number;
    title: string;
    slug: string;
    duration_days: number;
    base_price: number;
    currency: string;
    destination?: {
        id: number;
        name: string;
        country?: {
            id: number;
            name: string;
            code: string;
        };
    };
}

const STEPS = [
    { id: 1, label: 'Personal Info', icon: FaUser },
    { id: 2, label: 'Trip Details', icon: FaMapMarkedAlt },
    { id: 3, label: 'Review', icon: FaCheckCircle },
];

const NATIONALITIES = [
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
    const [destinationCountries, setDestinationCountries] = useState<DestinationCountryOption[]>([]);
    const [selectedCountryId, setSelectedCountryId] = useState<string>('');

    const {
        handleSubmit: handleFormSubmit,
        trigger,
        watch,
        setValue,
        setError: setFieldError,
        formState: { errors },
    } = useForm<BookingFormValues>({
        resolver: zodResolver(bookingFormSchema),
        defaultValues: {
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
        },
    });

    // Read-only snapshot of the current form values, used for the review step
    // and the success screen (rendered outside the form after submission).
    const form = watch();

    // ── Fetch available safari packages (with destination/country) and country filter options ──
    useEffect(() => {
        const apiUrl = (process.env.NEXT_PUBLIC_API_URL || 'http://localhost:8000/api/v1').replace(/\/+$/, '');

        fetch(`${apiUrl}/safaris?per_page=100`)
            .then((r) => r.json())
            .then((data) => {
                const list: SafariPackageOption[] = Array.isArray(data?.data?.data) ? data.data.data : [];
                setPackages(list);
            })
            .catch(() => setPackages([]));

        fetch(`${apiUrl}/safaris/filters`)
            .then((r) => r.json())
            .then((data) => {
                const countries: DestinationCountryOption[] = Array.isArray(data?.data?.countries) ? data.data.countries : [];
                setDestinationCountries(countries);
            })
            .catch(() => setDestinationCountries([]));
    }, []);

    // ── Helpers ──
    const update = (field: keyof BookingFormValues, value: string | number | null) =>
        setValue(field, value as never, { shouldValidate: true, shouldDirty: true });

    // Packages narrowed down to the selected destination country (or all, if none chosen yet)
    const filteredPackages = selectedCountryId
        ? packages.filter((p) => String(p.destination?.country?.id ?? '') === selectedCountryId)
        : packages;

    const handleCountryChange = (countryId: string) => {
        setSelectedCountryId(countryId);
        // Clear a previously selected package if it no longer belongs to the new country
        if (form.package_id) {
            const stillValid = countryId
                ? packages.some((p) => p.id === form.package_id && String(p.destination?.country?.id ?? '') === countryId)
                : true;
            if (!stillValid) {
                update('package_id', null);
                update('package_name', '');
            }
        }
    };

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

    const isStep1Valid = bookingStep1Schema.safeParse(form).success;
    const isStep2Valid = bookingStep2Schema.safeParse(form).success;

    const handleNext = async () => {
        setError(null);
        const fields = currentStep === 1
            ? (Object.keys(bookingStep1Schema.shape) as (keyof BookingFormValues)[])
            : (Object.keys(bookingStep2Schema.shape) as (keyof BookingFormValues)[]);
        const valid = await trigger(fields);
        if (valid) setCurrentStep((s) => s + 1);
    };

    const handleBack = () => {
        setError(null);
        setCurrentStep((s) => s - 1);
    };

    const onSubmit = async (values: BookingFormValues) => {
        setIsLoading(true);
        setError(null);
        try {
            const payload: BookingFormData = {
                first_name: values.first_name,
                last_name: values.last_name,
                email: values.email,
                phone: values.phone,
                country: values.country,
                package_id: values.package_id ?? null,
                package_name: values.package_name || null,
                travel_date: values.travel_date,
                adults: values.adults,
                children: values.children,
                special_requests: values.special_requests || undefined,
            };
            const res = await submitBooking(payload);
            setBookingRef(res.booking_number);
        } catch (err: any) {
            if (err.errors) {
                Object.entries(err.errors as Record<string, string[]>).forEach(([field, messages]) => {
                    setFieldError(field as keyof BookingFormValues, { message: messages[0] });
                });
            }
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
                            Check your email at <strong>{form.email}</strong>, we'll be in touch soon.
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
                                className="p-4 rounded-xl mb-6 text-sm font-medium flex items-center gap-2"
                                style={{ background: '#fff1f0', border: '1px solid #ffa39e', color: '#cf1322' }}
                            >
                                <FaExclamationTriangle /> {error}
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
                                            style={{ ...inputStyle, borderColor: errors.first_name ? '#cf1322' : undefined }}
                                            placeholder="e.g. Jane"
                                            value={form.first_name}
                                            onChange={(e) => update('first_name', e.target.value)}
                                            id="first_name"
                                        />
                                        {errors.first_name && <p className="text-xs mt-1" style={{ color: '#cf1322' }}>{errors.first_name.message}</p>}
                                    </div>
                                    {/* Last Name */}
                                    <div>
                                        <label style={labelStyle}>
                                            <FaUser className="inline mr-1 mb-0.5" size={11} /> Last Name *
                                        </label>
                                        <input
                                            type="text"
                                            style={{ ...inputStyle, borderColor: errors.last_name ? '#cf1322' : undefined }}
                                            placeholder="e.g. Doe"
                                            value={form.last_name}
                                            onChange={(e) => update('last_name', e.target.value)}
                                            id="last_name"
                                        />
                                        {errors.last_name && <p className="text-xs mt-1" style={{ color: '#cf1322' }}>{errors.last_name.message}</p>}
                                    </div>
                                    {/* Email */}
                                    <div>
                                        <label style={labelStyle}>
                                            <FaEnvelope className="inline mr-1 mb-0.5" size={11} /> Email Address *
                                        </label>
                                        <input
                                            type="email"
                                            style={{ ...inputStyle, borderColor: errors.email ? '#cf1322' : undefined }}
                                            placeholder="jane@example.com"
                                            value={form.email}
                                            onChange={(e) => update('email', e.target.value)}
                                            id="email"
                                        />
                                        {errors.email && <p className="text-xs mt-1" style={{ color: '#cf1322' }}>{errors.email.message}</p>}
                                    </div>
                                    {/* Phone */}
                                    <div>
                                        <label style={labelStyle}>
                                            <FaPhone className="inline mr-1 mb-0.5" size={11} /> Phone Number *
                                        </label>
                                        <input
                                            type="tel"
                                            style={{ ...inputStyle, borderColor: errors.phone ? '#cf1322' : undefined }}
                                            placeholder="+256 779 557 514"
                                            value={form.phone}
                                            onChange={(e) => update('phone', e.target.value)}
                                            id="phone"
                                        />
                                        {errors.phone && <p className="text-xs mt-1" style={{ color: '#cf1322' }}>{errors.phone.message}</p>}
                                    </div>
                                    {/* Country */}
                                    <div className="md:col-span-2">
                                        <label style={labelStyle}>
                                            <FaGlobe className="inline mr-1 mb-0.5" size={11} /> Country / Nationality *
                                        </label>
                                        <select
                                            style={{ ...inputStyle, cursor: 'pointer', borderColor: errors.country ? '#cf1322' : undefined }}
                                            value={form.country}
                                            onChange={(e) => update('country', e.target.value)}
                                            id="country"
                                        >
                                            <option value="">Select your country…</option>
                                            {NATIONALITIES.map((c) => (
                                                <option key={c} value={c}>{c}</option>
                                            ))}
                                        </select>
                                        {errors.country && <p className="text-xs mt-1" style={{ color: '#cf1322' }}>{errors.country.message}</p>}
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
                                            <FaGlobe className="inline mr-1 mb-0.5" size={11} /> Destination Country
                                        </label>
                                        <select
                                            style={{ ...inputStyle, cursor: 'pointer' }}
                                            value={selectedCountryId}
                                            onChange={(e) => handleCountryChange(e.target.value)}
                                            id="destination_country"
                                        >
                                            <option value="">Any / not decided yet</option>
                                            {destinationCountries.map((c) => (
                                                <option key={c.id} value={c.id}>{c.name}</option>
                                            ))}
                                        </select>
                                        <p className="text-xs mt-1" style={{ color: 'var(--text-muted)' }}>
                                            Choose where you'd like to go and we'll narrow the packages below.
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
                                            <option value="">Not sure? Contact us for guidance</option>
                                            {filteredPackages.map((pkg) => (
                                                <option key={pkg.id} value={pkg.id}>
                                                    {pkg.title}
                                                    {pkg.duration_days ? ` (${pkg.duration_days} days)` : ''}
                                                    {pkg.base_price ? ` (from $${Number(pkg.base_price).toLocaleString()})` : ''}
                                                </option>
                                            ))}
                                        </select>
                                        <p className="text-xs mt-1" style={{ color: 'var(--text-muted)' }}>
                                            {selectedCountryId && filteredPackages.length === 0
                                                ? "No packages listed for this country yet, pick \"Contact us for guidance\" and our team will help."
                                                : "Don't worry if you haven't decided, we'll help you choose."}
                                        </p>
                                    </div>


                                    {/* Travel Date */}
                                    <div>
                                        <label style={labelStyle}>
                                            <FaCalendarAlt className="inline mr-1 mb-0.5" size={11} /> Preferred Travel Date *
                                        </label>
                                        <input
                                            type="date"
                                            style={{ ...inputStyle, borderColor: errors.travel_date ? '#cf1322' : undefined }}
                                            min={minDate}
                                            value={form.travel_date}
                                            onChange={(e) => update('travel_date', e.target.value)}
                                            id="travel_date"
                                        />
                                        {errors.travel_date && <p className="text-xs mt-1" style={{ color: '#cf1322' }}>{errors.travel_date.message}</p>}
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
                                        {errors.special_requests && <p className="text-xs mt-1" style={{ color: '#cf1322' }}>{errors.special_requests.message}</p>}
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
                                            className="text-xs font-bold uppercase tracking-widest mb-4 flex items-center gap-2"
                                            style={{ color: 'var(--brand-gold)' }}
                                        >
                                            <FaUser /> Personal Information
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
                                            className="text-xs font-bold uppercase tracking-widest mb-4 flex items-center gap-2"
                                            style={{ color: 'var(--brand-gold)' }}
                                        >
                                            <FaGlobe /> Trip Details
                                        </h3>
                                        <div className="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                                            {[
                                                ['Package', form.package_name || 'To be discussed with our team'],
                                                ['Travel Date', form.travel_date
                                                    ? new Date(form.travel_date).toLocaleDateString('en-GB', { day: 'numeric', month: 'long', year: 'numeric' })
                                                    : 'To be decided'
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
                                            <li className="flex items-start gap-2"><FaCheckCircle className="mt-1 flex-shrink-0" /> Your request will be received and reviewed by our team</li>
                                            <li className="flex items-start gap-2"><FaEnvelope className="mt-1 flex-shrink-0" /> We'll send a personalised quote to <strong>{form.email}</strong> within 24 hours</li>
                                            <li className="flex items-start gap-2"><FaComments className="mt-1 flex-shrink-0" /> A dedicated safari consultant will reach out to discuss details</li>
                                            <li className="flex items-start gap-2"><FaPaw className="mt-1 flex-shrink-0" /> Once confirmed, we'll begin tailoring your safari experience!</li>
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
                                        onClick={() => handleFormSubmit(onSubmit)()}
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
                            { Icon: FaLock, label: 'Secure & Private' },
                            { Icon: FaPhone, label: 'No payment required now' },
                            { Icon: FaBolt, label: 'Response within 24 hours' },
                            { Icon: FaPlaneDeparture, label: 'Fully customisable' },
                        ].map((badge) => (
                            <span key={badge.label} className="flex items-center gap-1.5">
                                <badge.Icon /> {badge.label}
                            </span>
                        ))}
                    </div>
                </div>
            </div>
        </div>
    );
}
