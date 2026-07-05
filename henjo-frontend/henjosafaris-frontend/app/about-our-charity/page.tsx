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
                ctaText="Learn More"
                ctaLink="/contact"
                backgroundImage="/images/charity-hero.jpg"
                overlay={true}
                showTagline={false}
            />

            <div className="container mx-auto px-4 max-w-4xl py-16">
                <div className="bg-white rounded-2xl shadow-lg p-8 md:p-12 space-y-6">
                    <h2 className="text-2xl font-bold text-gray-800">Our Commitment to Community</h2>
                    
                    <p className="text-gray-600 leading-relaxed">
                        At Henjo African Safaris, we believe that tourism should benefit local communities 
                        and protect the environment. Our charity initiatives focus on:
                    </p>

                    <ul className="space-y-3 text-gray-600">
                        <li className="flex items-start gap-3">
                            <span className="text-yellow-500 text-xl">🌍</span>
                            <div>
                                <strong>Community Development:</strong> Supporting local schools, healthcare, and infrastructure projects in the communities we visit.
                            </div>
                        </li>
                        <li className="flex items-start gap-3">
                            <span className="text-yellow-500 text-xl">🦁</span>
                            <div>
                                <strong>Wildlife Conservation:</strong> Partnering with organizations to protect endangered species and their habitats.
                            </div>
                        </li>
                        <li className="flex items-start gap-3">
                            <span className="text-yellow-500 text-xl">👩‍👧‍👦</span>
                            <div>
                                <strong>Women's Empowerment:</strong> Supporting women-led tourism initiatives and female guides.
                            </div>
                        </li>
                        <li className="flex items-start gap-3">
                            <span className="text-yellow-500 text-xl">🌱</span>
                            <div>
                                <strong>Sustainable Tourism:</strong> Promoting eco-friendly practices and reducing environmental impact.
                            </div>
                        </li>
                    </ul>

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