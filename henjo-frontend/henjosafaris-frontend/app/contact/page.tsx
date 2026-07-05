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
    
    /**
     * 📌 handleSubmit
     * When the form is submitted:
     * 1. Prevent default browser behavior (page reload)
     * 2. Log the form data (in development)
     * 3. Show success message
     * 4. Reset form fields after 5 seconds
     */
    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault(); // ✅ IMPORTANT: Prevents page reload
        
        console.log('📧 Form submitted:', form); // Debug log
        
        setSubmitted(true); // Show success message
        setForm({ name: '', email: '', phone: '', message: '' }); // Clear form
        
        // Hide success message after 5 seconds
        setTimeout(() => setSubmitted(false), 5000);
    };

    // ============================================
    // RENDER: PAGE HTML
    // ============================================

    return (
        <div className="min-h-screen">
            {/* ============================================
            HERO SECTION
            ============================================
            - size="small" → 40vh (compact hero for interior pages)
            - No tagline shown (showTagline={false}) for cleaner look
            ============================================ */}
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

            {/* ============================================
            MAIN CONTENT: 2-Column Grid
            ============================================
            Left column: Contact information
            Right column: Contact form
            ============================================ */}
            <div className="container mx-auto px-4 max-w-4xl py-16">
                <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    {/* ============================================
                    COLUMN 1: Contact Information
                    ============================================ */}
                    <div className="bg-white rounded-2xl shadow-lg p-8">
                        <h2 className="text-2xl font-bold text-gray-800 mb-6">
                            Contact Information
                        </h2>
                        
                        <div className="space-y-6">
                            
                            {/* Office Address */}
                            {officeAddresses.map((office) => (
                                <div key={office.country} className="space-y-3">
                                    <h3 className="font-bold text-gray-800">{office.country}</h3>
                                    
                                    {/* Address */}
                                    <div className="flex items-start gap-4">
                                        <div className="bg-yellow-100 p-3 rounded-full flex-shrink-0">
                                            <FaMapMarkerAlt className="text-yellow-600 text-xl" />
                                        </div>
                                        <div>
                                            <p className="text-gray-600 text-sm">{office.address}</p>
                                        </div>
                                    </div>
                                    
                                    {/* Phone */}
                                    <div className="flex items-start gap-4">
                                        <div className="bg-yellow-100 p-3 rounded-full flex-shrink-0">
                                            <FaPhone className="text-yellow-600 text-xl" />
                                        </div>
                                        <div>
                                            <p className="text-gray-600">{office.phone}</p>
                                        </div>
                                    </div>
                                    
                                    {/* Email */}
                                    <div className="flex items-start gap-4">
                                        <div className="bg-yellow-100 p-3 rounded-full flex-shrink-0">
                                            <FaEnvelope className="text-yellow-600 text-xl" />
                                        </div>
                                        <div>
                                            <a 
                                                href={`mailto:${office.email}`} 
                                                className="text-gray-600 hover:text-yellow-500 transition"
                                            >
                                                {office.email}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            ))}

                            {/* International Contacts */}
                            <div>
                                <h3 className="font-bold text-gray-800 mb-3">
                                    International Contacts
                                </h3>
                                <div className="grid grid-cols-2 gap-2 text-sm">
                                    {internationalContacts.map((contact) => (
                                        <div key={contact.country} className="bg-gray-50 p-2 rounded-lg">
                                            <p className="font-semibold text-gray-700">{contact.country}</p>
                                            <p className="text-gray-600">{contact.phone}</p>
                                        </div>
                                    ))}
                                </div>
                            </div>

                            {/* Working Hours */}
                            <div className="flex items-start gap-4">
                                <div className="bg-yellow-100 p-3 rounded-full flex-shrink-0">
                                    <FaClock className="text-yellow-600 text-xl" />
                                </div>
                                <div>
                                    <p className="font-semibold text-gray-800">Working Hours</p>
                                    <p className="text-gray-600">Mon - Fri: 8:00 AM - 6:00 PM (EAT)</p>
                                    <p className="text-gray-600">Sat: 9:00 AM - 4:00 PM (EAT)</p>
                                </div>
                            </div>

                            {/* Social Media */}
                            <div className="pt-4 border-t border-gray-200">
                                <p className="font-semibold text-gray-800 mb-4">Follow Us</p>
                                <div className="flex gap-4">
                                    {socialLinks.map((social) => {
                                        const Icon = social.icon;
                                        return (
                                            <a
                                                key={social.name}
                                                href={social.url}
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                className="bg-gray-100 hover:bg-yellow-500 p-3 rounded-full transition text-gray-600 hover:text-white"
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

                    {/* ============================================
                    COLUMN 2: Contact Form
                    ============================================ */}
                    <div className="bg-white rounded-2xl shadow-lg p-8">
                        <h2 className="text-2xl font-bold text-gray-800 mb-6">
                            Send Us a Message
                        </h2>

                        {/* Show success message after submission */}
                        {submitted ? (
                            <div className="bg-green-50 border border-green-200 text-green-700 p-6 rounded-xl text-center">
                                <div className="text-4xl mb-3">✅</div>
                                <h3 className="font-bold text-lg">Message Sent!</h3>
                                <p className="text-sm">We'll get back to you within 24 hours.</p>
                            </div>
                        ) : (
                            // Form with validation
                            <form onSubmit={handleSubmit} className="space-y-5">
                                
                                {/* Name Field */}
                                <div>
                                    <label className="block text-sm font-medium text-gray-700 mb-1">
                                        Your Name *
                                    </label>
                                    <input
                                        type="text"
                                        className="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 outline-none transition"
                                        placeholder="John Doe"
                                        value={form.name}
                                        onChange={(e) => setForm({...form, name: e.target.value})}
                                        required
                                    />
                                </div>

                                {/* Email Field */}
                                <div>
                                    <label className="block text-sm font-medium text-gray-700 mb-1">
                                        Email Address *
                                    </label>
                                    <input
                                        type="email"
                                        className="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 outline-none transition"
                                        placeholder="john@example.com"
                                        value={form.email}
                                        onChange={(e) => setForm({...form, email: e.target.value})}
                                        required
                                    />
                                </div>

                                {/* Phone Field (optional) */}
                                <div>
                                    <label className="block text-sm font-medium text-gray-700 mb-1">
                                        Phone Number
                                    </label>
                                    <input
                                        type="tel"
                                        className="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 outline-none transition"
                                        placeholder="+256 779 557 514"
                                        value={form.phone}
                                        onChange={(e) => setForm({...form, phone: e.target.value})}
                                    />
                                </div>

                                {/* Message Field */}
                                <div>
                                    <label className="block text-sm font-medium text-gray-700 mb-1">
                                        Message *
                                    </label>
                                    <textarea
                                        rows={5}
                                        className="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 outline-none transition resize-none"
                                        placeholder="Tell us about your dream safari..."
                                        value={form.message}
                                        onChange={(e) => setForm({...form, message: e.target.value})}
                                        required
                                    />
                                </div>

                                {/* Submit Button */}
                                <button
                                    type="submit"
                                    className="w-full bg-yellow-500 hover:bg-yellow-400 text-black font-bold py-4 rounded-xl transition transform hover:scale-[1.02]"
                                >
                                    Send Message
                                </button>

                                {/* Trust Signal */}
                                <p className="text-xs text-center text-gray-500 mt-2">
                                    We'll respond within 24 hours. Your information is secure with us.
                                </p>
                            </form>
                        )}
                    </div>
                </div>
            </div>
        </div>
    );
}