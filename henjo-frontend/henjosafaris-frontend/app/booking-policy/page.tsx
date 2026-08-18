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

                    <h2 className="text-2xl font-bold text-gray-800">BOOKING POLICY</h2>

                    <div>
                        <h3 className="text-xl font-semibold text-gray-800 mb-2">The booking deposit and cancellation policy</h3>
                        <p className="text-gray-600">
                            A 30 % deposit is required to confirm your booking within 7 days of written confirmation, otherwise, the booking will be taken as a provisional only, with the possible inability to reinstate the reservation. After confirmation, a 30% deposit should be paid and the booking is taken as confirmed.<br />
                            One calendar month before the commencement of the safari- 70% of the total safari cost is paid.<br />
                            The above is at the discretion of Henjo African Safaris Ltd<br /><br />
                            <strong>Special requirements and insurance</strong><br />
                            Clients will have their incoming Travel insurance covered by Henjo African Safaris for 12 days while on a safari. However, if the client is fully covered by their insurance, details should be forwarded at least 4 weeks before the commencement of the safari<br />
                            Any medical conditions should be mentioned<br />
                        </p>
                    </div>



                    <div>
                        <h3 className="text-xl font-semibold text-gray-800 mb-2">Cancellation Policy</h3>
                        <p className="text-gray-600">
                            Before cancellation, henjo African Safaris and the client will discuss the possibility of rescheduling. In case of cancellations, They should be made in writing and will only deem effective upon acknowledged receipt by Henjo African Safaris. <br />
                            Cancellation will be subject to the following penalties: <br />
                            30 days or more before the remaining 70% of the total package is paid: 5% forfeit of the 30% deposit.<br />
                            60 days or more before commencement: Forfeit 50%<br />
                            Less than 60 days before commencement: Forfeit 50% of the package price<br />
                            Less than 30 days before commencement: Forfeit 100 % of the package price<br />
                        </p>
                    </div>

                    <div>
                        <h3 className="text-xl font-semibold text-gray-800 mb-2">Children</h3>
                        <p className="text-gray-600">
                            Children are welcome on our safaris, we offer kids below 5 years a free spot one kid per group and we also give a 25% discount for 6 -12 year-olds.
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