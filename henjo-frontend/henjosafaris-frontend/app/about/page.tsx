// ============================================
// ABOUT US PAGE
// ============================================
// This page displays information about Henjo African Safaris.
// Content is sourced from the content audit document.
// 
// Page sections:
// 1. Hero section with page title and subtitle
// 2. Who We Are - image on right, text on left
// 3. Our Services - horizontal scrolling cards (3 visible at a time)
// 4. Core Values, Commitment & Inclusive Tourism - 3 columns
// 5. Stats section - experience, travelers, rating
// ============================================

import Hero from '@/components/common/Hero';
import Image from 'next/image';
import { FaShieldAlt, FaLeaf, FaUsers, FaCompass, FaHeart, FaGlobeAfrica } from 'react-icons/fa';

export default function AboutPage() {
    return (
        <div className="min-h-screen bg-gray-50">
            {/* ============================================
            HERO SECTION
            ============================================ */}
            <Hero 
                size="medium"
                title="About Henjo African Safaris"
                subtitle="Authentic African Safaris to Kenya, Uganda, Tanzania, and Rwanda"
                ctaText="Contact Us"
                ctaLink="/contact"
                backgroundImage="/images/placeholder.png"
                overlay={true}
                showTagline={true}
            />

            {/* ============================================
            SECTION 1: Who We Are (Image Right, Text Left)
            ============================================ */}
            <section className="py-20 bg-white">
                <div className="container mx-auto px-4 max-w-7xl">
                    <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                        {/* Left: Text Content */}
                        <div>
                            <h2 className="text-3xl md:text-4xl font-bold text-gray-800 mb-6">
                                Who <span className="text-yellow-500">We Are</span>
                            </h2>
                            <p className="text-gray-600 leading-relaxed text-lg">
                                Henjo African Safaris Ltd is a Ugandan Tour agency offering Bespoke Safaris, 
                                Tailor Made Holidays, Authentic Luxury African Safaris, Fly-In Safaris, 
                                Gorilla Tracking and Cultural Safaris.
                            </p>
                            <p className="text-gray-600 leading-relaxed text-lg mt-4">
                                We take pride in having a team of professionals who have traveled in East Africa 
                                and now work to ensure that clients both acquire a unique and educational 
                                experience of African wildlife, landscape, and culture.
                            </p>
                            <p className="text-gray-600 leading-relaxed text-lg mt-4">
                                The competence and knowledge of our safari tour guides highly contributes 
                                to the overall experience.
                            </p>
                        </div>

                        {/* Right: Image */}
                        <div className="relative h-[400px] rounded-2xl overflow-hidden shadow-card">
                            <Image
                                src="/images/about_us_2.png"
                                alt="Henjo African Safaris - Who We Are"
                                fill
                                className="object-cover"
                            />
                        </div>
                    </div>
                </div>
            </section>

            {/* ============================================
            SECTION 2: Our Services (Horizontal Scrolling)
            ============================================ */}
            <section className="py-20 bg-primary">
                <div className="container mx-auto px-4 max-w-7xl">
                    <div className="text-center mb-12">
                        <h2 className="section-title">
                            Our <span className="text-yellow-500">Services</span>
                        </h2>
                        <p className="section-subtitle">
                            We offer a wide range of safari experiences tailored to your preferences
                        </p>
                    </div>

                    {/* <div className="overflow-x-auto pb-6 scrollbar-hide">
                        <div className="flex gap-6 w-max px-2">
                            {services.map((service, index) => (
                                <div key={index} className="w-72 flex-shrink-0 card p-6 hover:shadow-lg transition duration-300 group">
                                    <div className="w-16 h-16 bg-yellow-100 dark:bg-yellow-900/30 rounded-full flex items-center justify-center mb-4 group-hover:bg-yellow-200 dark:group-hover:bg-yellow-800/50 transition">
                                        <span className="text-3xl">{service.icon}</span>
                                    </div>
                                    <h3 className="text-xl font-bold text-primary mb-2">{service.title}</h3>
                                    <p className="text-secondary text-sm">{service.description}</p>
                                </div>
                            ))}
                        </div>
                    </div> */}
                    {/* Horizontal Scrolling Cards */}
                    <div className="relative">
                        {/* Scrolling container - hides scrollbar but allows scrolling */}
                        <div className="overflow-x-auto pb-6 scrollbar-hide">
                            <div className="flex gap-6 w-max px-2">
                                {/* Card 1 */}
                                <div className="w-72 flex-shrink-0 bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition duration-300">
                                    <div className="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mb-4">
                                        <span className="text-3xl">🦁</span>
                                    </div>
                                    <h3 className="text-xl font-bold text-gray-800 mb-2">Wildlife Safaris</h3>
                                    <p className="text-gray-600 text-sm">
                                        Experience the thrill of seeing the Big Five in their natural habitat across East Africa's national parks.
                                    </p>
                                </div>

                                {/* Card 2 */}
                                <div className="w-72 flex-shrink-0 bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition duration-300">
                                    <div className="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mb-4">
                                        <span className="text-3xl">🦍</span>
                                    </div>
                                    <h3 className="text-xl font-bold text-gray-800 mb-2">Gorilla Trekking</h3>
                                    <p className="text-gray-600 text-sm">
                                        Trek through the lush forests of Uganda and Rwanda to encounter endangered mountain gorillas.
                                    </p>
                                </div>

                                {/* Card 3 */}
                                <div className="w-72 flex-shrink-0 bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition duration-300">
                                    <div className="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mb-4">
                                        <span className="text-3xl">✈️</span>
                                    </div>
                                    <h3 className="text-xl font-bold text-gray-800 mb-2">Fly-In Safaris</h3>
                                    <p className="text-gray-600 text-sm">
                                        Skip the long drives and fly directly to your safari destination for more time exploring.
                                    </p>
                                </div>

                                {/* Card 4 */}
                                <div className="w-72 flex-shrink-0 bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition duration-300">
                                    <div className="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mb-4">
                                        <span className="text-3xl">🏔️</span>
                                    </div>
                                    <h3 className="text-xl font-bold text-gray-800 mb-2">Mountaineering</h3>
                                    <p className="text-gray-600 text-sm">
                                        Conquer the highest peaks in Africa including Mount Kilimanjaro and the Rwenzori Mountains.
                                    </p>
                                </div>

                                {/* Card 5 */}
                                <div className="w-72 flex-shrink-0 bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition duration-300">
                                    <div className="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mb-4">
                                        <span className="text-3xl">🏛️</span>
                                    </div>
                                    <h3 className="text-xl font-bold text-gray-800 mb-2">Cultural Tours</h3>
                                    <p className="text-gray-600 text-sm">
                                        Immerse yourself in the rich cultures and traditions of East Africa's diverse communities.
                                    </p>
                                </div>

                                {/* Card 6 */}
                                <div className="w-72 flex-shrink-0 bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition duration-300">
                                    <div className="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mb-4">
                                        <span className="text-3xl">👩‍🦰</span>
                                    </div>
                                    <h3 className="text-xl font-bold text-gray-800 mb-2">Women Only Tours</h3>
                                    <p className="text-gray-600 text-sm">
                                        Specially designed tours for women travelers seeking safe and empowering African adventures.
                                    </p>
                                </div>

                                {/* Card 7 */}
                                <div className="w-72 flex-shrink-0 bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition duration-300">
                                    <div className="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mb-4">
                                        <span className="text-3xl">🏙️</span>
                                    </div>
                                    <h3 className="text-xl font-bold text-gray-800 mb-2">City Tours</h3>
                                    <p className="text-gray-600 text-sm">
                                        Explore the vibrant cities of East Africa including Kampala, Nairobi, and Dar es Salaam.
                                    </p>
                                </div>
                            </div>
                        </div>

                        {/* Scroll Hint */}
                        <div className="text-center mt-6">
                            <p className="text-sm text-gray-400 animate-pulse">
                                ← Scroll to see more services →
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            {/* ============================================
            SECTION 3: Core Values, Commitment & Inclusive Tourism
            ============================================ */}


            <section className="py-20 bg-secondary">
                <div className="container mx-auto px-4 max-w-7xl">
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                        
                        {/* Values - Green accent */}
                        <div className="card p-8 hover:shadow-lg transition duration-300 border-t-4 border-green-600 dark:border-green-400">
                            <div className="w-14 h-14 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mb-4">
                                <FaHeart className="text-green-600 dark:text-green-400 text-2xl" />
                            </div>
                            <h3 className="text-xl font-bold text-gray-800 mb-4">Our Core Values</h3>
                            {/* Content */}

                            <ul className="space-y-3 text-gray-600">
                                <li className="flex items-start gap-3">
                                    <span className="text-yellow-500 mt-1">✓</span>
                                    <span>Integrity and transparency in all our dealings</span>
                                </li>
                                <li className="flex items-start gap-3">
                                    <span className="text-yellow-500 mt-1">✓</span>
                                    <span>Passion for wildlife and conservation</span>
                                </li>
                                <li className="flex items-start gap-3">
                                    <span className="text-yellow-500 mt-1">✓</span>
                                    <span>Excellence in customer service</span>
                                </li>
                                <li className="flex items-start gap-3">
                                    <span className="text-yellow-500 mt-1">✓</span>
                                    <span>Respect for local communities and cultures</span>
                                </li>
                            </ul>

                        </div>

                        {/* Commitment - Yellow accent */}
                        <div className="card p-8 hover:shadow-lg transition duration-300 border-t-4 border-yellow-500">
                            <div className="w-14 h-14 bg-yellow-100 dark:bg-yellow-900/30 rounded-full flex items-center justify-center mb-4">
                                <FaLeaf className="text-yellow-600 dark:text-yellow-400 text-2xl" />
                            </div>
                            <h3 className="text-xl font-bold text-gray-800 mb-4">Our Commitment</h3>
                            {/* Content */}
                            <p className="text-gray-600 leading-relaxed">
                                Henjo African Safaris continues to endeavor to be sustainable in practice in the 
                                tours offered, to protect African wildlife and ensure the tourism industry continues 
                                to prosper.
                            </p>
                            <p className="text-gray-600 leading-relaxed mt-4">
                                We are working towards leaving a minimal negative impact on the 
                                environment and local communities, integrating environmental and social best 
                                practices into every aspect of the business.
                            </p>
                        </div>

                        {/* Inclusive - Red accent */}
                        <div className="card p-8 hover:shadow-lg transition duration-300 border-t-4 border-red-600 dark:border-red-400">
                            <div className="w-14 h-14 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mb-4">
                                <FaUsers className="text-red-600 dark:text-red-400 text-2xl" />
                            </div>
                            <h3 className="text-xl font-bold text-gray-800 mb-4">Inclusive Tourism</h3>
                            {/* Content */}
                            <p className="text-gray-600 leading-relaxed">
                                Henjo African Safaris believes in Responsible and Inclusive Tourism, and offers 
                                Disability Tours & Safaris — whether a traveler has a disability or not, they are 
                                welcomed to experience their African holiday with Henjo.
                            </p>
                            <p className="text-gray-600 leading-relaxed mt-4">
                                We are represented on SafariBookings.com and offer tours ranging from short stays 
                                to longer durations, as well as fully tailor-made safaris on request.
                            </p>
                        </div>
                    </div>
                </div>
            </section>


            {/* ============================================
            SECTION 4: Stats / Social Proof
            ============================================ */}

            
            <section className="py-16 bg-gradient-to-r from-yellow-500 to-yellow-600">
                <div className="container mx-auto px-4 max-w-7xl">
                    <div className="grid grid-cols-2 md:grid-cols-4 gap-8">
                        <div className="text-center text-white">
                            <div className="text-5xl font-bold">15+</div>
                            <p className="text-yellow-100 text-sm mt-2">Years Experience</p>
                        </div>
                        <div className="text-center text-white">
                            <div className="text-5xl font-bold">500+</div>
                            <p className="text-yellow-100 text-sm mt-2">Happy Travelers</p>
                        </div>
                        <div className="text-center text-white">
                            <div className="text-5xl font-bold">4.9★</div>
                            <p className="text-yellow-100 text-sm mt-2">Average Rating</p>
                        </div>
                        <div className="text-center text-white">
                            <div className="text-5xl font-bold">28</div>
                            <p className="text-yellow-100 text-sm mt-2">Tour Packages</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    );
}
