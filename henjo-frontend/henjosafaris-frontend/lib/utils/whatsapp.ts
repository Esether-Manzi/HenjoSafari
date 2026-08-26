// Builds a wa.me deep link from a Site Settings phone number, which is
// stored formatted for display (e.g. "+256 779 557 514") rather than as the
// bare digit string wa.me expects.
export function getWhatsAppUrl(phone: string | null | undefined, message?: string): string | null {
    if (!phone) return null;

    const digits = phone.replace(/[^\d]/g, '');
    if (!digits) return null;

    const base = `https://wa.me/${digits}`;
    return message ? `${base}?text=${encodeURIComponent(message)}` : base;
}
