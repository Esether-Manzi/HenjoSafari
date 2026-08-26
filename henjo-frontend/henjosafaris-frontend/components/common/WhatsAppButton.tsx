import { FaWhatsapp } from 'react-icons/fa';
import { getWhatsAppUrl } from '@/lib/utils/whatsapp';

interface WhatsAppButtonProps {
    phone: string | null | undefined;
}

export default function WhatsAppButton({ phone }: WhatsAppButtonProps) {
    const href = getWhatsAppUrl(phone, "Hi Henjo African Safaris, I'd like to know more about your safaris.");
    if (!href) return null;

    return (
        <a
            href={href}
            target="_blank"
            rel="noopener noreferrer"
            aria-label="Chat with us on WhatsApp"
            className="fixed bottom-5 right-5 z-50 flex items-center justify-center w-14 h-14 rounded-full shadow-xl transition duration-300 hover:scale-110"
            style={{ background: '#25D366', color: '#fff' }}
        >
            <FaWhatsapp size={28} />
        </a>
    );
}
