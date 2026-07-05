// ============================================
// OUR TEAM PAGE
// ============================================
// This page displays the team members of Henjo African Safaris.
// Team bios will be added as we get them from the client.
// ============================================

import Hero from '@/components/common/Hero';
import Image from 'next/image';
import Link from 'next/link';

// ✅ Team members will eventually come from the API
const teamMembers = [
    {
        name: 'Henjo',
        position: 'Founder & Director',
        bio: 'Passionate about wildlife conservation and sustainable tourism in East Africa.',
        image: '/images/team/henjo.jpg'
    },
    // Add more team members as they become available
];

export default function OurTeamPage() {
    return (
        <div className="min-h-screen">
            <Hero 
                size="small"
                title="Our Team"
                subtitle="Meet the experts behind your African adventure"
                ctaText="Contact Us"
                ctaLink="/contact"
                backgroundImage="/images/team-hero.jpg"
                overlay={true}
                showTagline={false}
            />

            <div className="container mx-auto px-4 max-w-4xl py-16">
                <div className="bg-white rounded-2xl shadow-lg p-8 md:p-12">
                    <h2 className="text-2xl font-bold text-gray-800 mb-6">Meet Our Team</h2>
                    
                    {teamMembers.length === 0 ? (
                        <p className="text-gray-600">
                            Team profiles are being updated. Please check back soon or contact us directly 
                            to learn more about our expert guides and staff.
                        </p>
                    ) : (
                        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {teamMembers.map((member) => (
                                <div key={member.name} className="bg-gray-50 rounded-xl p-6 text-center">
                                    <div className="relative w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden">
                                        <Image
                                            src={member.image}
                                            alt={member.name}
                                            fill
                                            className="object-cover"
                                        />
                                    </div>
                                    <h3 className="text-xl font-bold text-gray-800">{member.name}</h3>
                                    <p className="text-yellow-600 font-semibold">{member.position}</p>
                                    <p className="text-gray-600 text-sm mt-2">{member.bio}</p>
                                </div>
                            ))}
                        </div>
                    )}
                    
                    <div className="mt-8 text-center">
                        <p className="text-gray-600">
                            Want to know more about our team? <Link href="/contact" className="text-yellow-600 hover:text-yellow-700 font-semibold">Contact us</Link>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    );
}