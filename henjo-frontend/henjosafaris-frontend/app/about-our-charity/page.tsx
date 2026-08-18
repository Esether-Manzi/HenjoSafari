// ============================================
// ABOUT OUR CHARITY PAGE
// ============================================
// This page describes Henjo's charitable initiatives
// and community impact programs.
// ============================================

import Hero from '@/components/common/Hero';
import Link from 'next/link';

export default function AboutOurCharityPage() {
    return (
        <div className="min-h-screen">
            <Hero
                size="small"
                title="About Our Charity"
                subtitle="Making a difference through responsible tourism"
                // ctaText="Learn More"
                // ctaLink="/contact"
                backgroundImage="/images/charity-hero.jpg"
                overlay={true}
                showTagline={false}
            />

            <div className="container mx-auto px-4 max-w-4xl py-16">
                <div className="bg-white rounded-2xl shadow-lg p-8 md:p-12 space-y-6">
                    <h2 className="text-2xl font-bold text-gray-800">Our Commitment to Community</h2>

                    <p className="text-gray-600 leading-relaxed">
                        Henjo African Safaris is more than just a premier safari company; it's a beacon of hope for vulnerable children in Africa. <br />
                        Through a strategic partnership with <a href="https://www.empathychildreninitiative.org/" target="_blank" rel="noopener noreferrer" className="text-yellow-500 hover:underline">Empathy Children Initiative</a>, Henjo African Safaris dedicates itself to making a tangible difference in the lives of these children. Every booking made directly with Henjo African Safaris contributes directly to the well-being, education and Menistrual Hygiene programs of these children.<br />
                        Whether you're embarking on a thrilling safari adventure or planning a serene getaway, your decision to book with Henjo African Safaris means you're actively participating in changing lives and building brighter futures for those in need.<br />
                        Join us in making a lasting impact through unforgettable experiences.
                    </p>

                    <a href="https://www.empathychildreninitiative.org/" target="_blank" rel="noopener noreferrer" className="inline-block mt-4 bg-yellow-500 hover:bg-yellow-400 text-black font-semibold px-6 py-2 rounded-full transition">
                        Learn More
                    </a>


                    <div className="bg-yellow-50 p-6 rounded-xl border border-yellow-200 mt-6">
                        <p className="text-gray-700">
                            <strong>Want to contribute?</strong> A portion of every safari booking goes
                            towards supporting these community initiatives. Contact us to learn more about
                            how you can make a difference.
                        </p>
                        <Link
                            href="/contact"
                            className="inline-block mt-4 bg-yellow-500 hover:bg-yellow-400 text-black font-semibold px-6 py-2 rounded-full transition"
                        >
                            Contact Us
                        </Link>

                    </div>
                </div>
            </div>
        </div>
    );
}