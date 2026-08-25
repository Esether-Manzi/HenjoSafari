// ============================================
// TEXT CLEANING & HEADING STANDARDIZATION
// ============================================
// Applied to CMS/admin-editable copy (Page sections, SiteSetting, safari
// and blog titles, etc.) at render time, so formatting stays consistent
// site-wide no matter how it was typed in the Filament admin — no backend
// deploy needed to fix a heading typed in ALL CAPS or with stray spacing.

const HTML_TAG_REGEX = /<[^>]*>/g;
const MULTI_SPACE_REGEX = /[ \t]+/g;
const MULTI_NEWLINE_REGEX = /\n{3,}/g;
const REPEATED_PUNCTUATION_REGEX = /([!?.,])\1+/g;

// Drops non-printable control characters (keeping tab/newline/CR) without
// relying on a control-character regex literal, which some tooling mangles.
function stripControlChars(input: string): string {
    let result = '';
    for (const ch of input) {
        const code = ch.codePointAt(0) ?? 0;
        if (code === 9 || code === 10 || code === 13) {
            result += ch;
            continue;
        }
        if (code < 32 || code === 127) continue;
        result += ch;
    }
    return result;
}

/**
 * Strip markup/control characters and collapse stray whitespace. Safe to
 * run on any freeform admin-entered string before it hits the page.
 */
export function cleanText(input: string | null | undefined): string {
    if (!input) return '';
    return stripControlChars(input)
        .replace(HTML_TAG_REGEX, '')
        .replace(MULTI_SPACE_REGEX, ' ')
        .replace(MULTI_NEWLINE_REGEX, '\n\n')
        .replace(REPEATED_PUNCTUATION_REGEX, '$1')
        .trim();
}

// Domain proper nouns that must stay capitalized even when the rest of a
// heading gets lowercased for sentence case — extend as new destinations
// or brand terms come up.
const PROPER_NOUNS = [
    'Uganda', 'Kenya', 'Tanzania', 'Rwanda', 'Africa', 'East Africa',
    'Nairobi', 'Kampala', 'Kigali', 'Entebbe', 'Arusha', 'Zanzibar',
    'Serengeti', 'Masai Mara', 'Maasai Mara', 'Ngorongoro', 'Bwindi',
    'Kilimanjaro', 'Nile', 'Queen Elizabeth', 'Murchison Falls', 'Kibale',
    'Lake Victoria', 'Lake Naivasha', 'Big Five',
    'Henjo', 'Henjo African Safaris', 'HenjoSafaris',
    'TripAdvisor', 'SafariBookings',
];

const escapeRegex = (s: string) => s.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
const FIRST_LETTER_REGEX = /^([^a-zA-Z]*)([a-zA-Z])/;
const SENTENCE_BOUNDARY_REGEX = /([.!?]\s+)([a-z])/g;

function reapplyProperNouns(text: string): string {
    return PROPER_NOUNS.reduce(
        (result, noun) => result.replace(new RegExp(`\\b${escapeRegex(noun)}\\b`, 'gi'), noun),
        text
    );
}

function capitalizeFirst(text: string): string {
    return text.replace(FIRST_LETTER_REGEX, (_, lead, letter) => lead + letter.toUpperCase());
}

/**
 * Standardize a heading/title to sentence case. Only rewrites text typed
 * as ALL CAPS or all lowercase — a heading already in deliberate mixed
 * case (the common case for well-formed admin input) is left alone aside
 * from whitespace cleanup and re-asserting known proper nouns, so this
 * never mangles intentional formatting.
 */
export function toSentenceCase(input: string | null | undefined): string {
    const text = cleanText(input);
    if (!text) return '';

    const hasLower = /[a-z]/.test(text);
    const hasUpper = /[A-Z]/.test(text);
    const isAllCaps = hasUpper && !hasLower;
    const isAllLower = hasLower && !hasUpper;

    if (!isAllCaps && !isAllLower) {
        return reapplyProperNouns(capitalizeFirst(text));
    }

    const sentenceCased = capitalizeFirst(
        text.toLowerCase().replace(SENTENCE_BOUNDARY_REGEX, (_, sep, letter) => sep + letter.toUpperCase())
    );
    return reapplyProperNouns(sentenceCased);
}

/** Render-time formatter for any CMS-editable heading/title. */
export function formatHeading(input: string | null | undefined): string {
    return toSentenceCase(input);
}
