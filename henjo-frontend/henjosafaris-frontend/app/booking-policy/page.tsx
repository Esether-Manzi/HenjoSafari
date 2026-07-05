// ============================================
// BOOKING POLICY PAGE
// ============================================
// This page contains the terms and conditions for booking.
// Important legal page that must be accurate.
// ============================================

import Hero from '@/components/common/Hero';
import Link from 'next/link';

export default function BookingPolicyPage() {
    return (
        <div className="min-h-screen">
            <Hero 
                size="small"
                title="Booking Policy"
                subtitle="Terms and conditions for booking your safari"
                ctaText="Contact Us"
                ctaLink="/contact"
                backgroundImage="/images/policy-hero.jpg"
                overlay={true}
                showTagline={false}
            />

            <div className="container mx-auto px-4 max-w-4xl py-16">
                <div className="bg-white rounded-2xl shadow-lg p-8 md:p-12 space-y-6">
                    <div className="bg-yellow-50 p-4 rounded-xl border border-yellow-200">
                        <p className="text-gray-700 text-sm">
                            ⚠️ <strong>Note:</strong> This is the current placeholder for the booking policy. 
                            The full policy from the original site will be added once it's retrieved. 
                            Please contact us for immediate booking inquiries.
                        </p>
                    </div>

                    <h2 className="text-2xl font-bold text-gray-800">Booking Terms</h2>
                    
                    <div>
                        <h3 className="text-xl font-semibold text-gray-800 mb-2">Deposit Requirements</h3>
                        <p className="text-gray-600">
                            A deposit is required at the time of booking to confirm your safari. 
                            The deposit amount varies depending on the tour package.
                        </p>
                    </div>

                    <div>
                        <h3 className="text-xl font-semibold text-gray-800 mb-2">Payment Terms</h3>
                        <p className="text-gray-600">
                            Full payment is due 30 days before departure. We accept various payment 
                            methods including bank transfer, credit card, and mobile money.
                        </p>
                    </div>

                    <div>
                        <h3 className="text-xl font-semibold text-gray-800 mb-2">Cancellation Policy</h3>
                        <p className="text-gray-600">
                            Cancellations must be made in writing. Refunds are subject to the tour 
                            operator's terms and conditions.
                        </p>
                    </div>

                    <div className="bg-gray-50 p-6 rounded-xl mt-6">
                        <p className="text-gray-700">
                            <strong>Need more information?</strong> Contact our booking team for 
                            personalized assistance with your safari booking.
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