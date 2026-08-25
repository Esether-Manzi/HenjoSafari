// ============================================
// REGEX-BASED FIELD VALIDATION
// ============================================
// Mirrors henjo-backend/app/Support/ValidationPatterns.php so client-side
// and server-side validation agree on what counts as valid input. Used by
// lib/validation/schemas.ts (zod) and available for ad-hoc checks.

// All three patterns tolerate incidental leading/trailing whitespace (\s*
// at each end) rather than requiring the caller to trim first — some
// callers (e.g. Filament admin form validation) run these against the raw,
// not-yet-trimmed field value, and a bare "^letter...letter$" shape would
// wrongly reject "  Jane Doe  " before it ever gets a chance to be cleaned.

export const EMAIL_REGEX = /^\s*[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)+\s*$/;

// Optional leading +, then digits/spaces/hyphens/dots/parentheses, with a
// lookahead requiring 7-15 actual digits somewhere in the value — a
// character-class check alone would pass junk like "-----" or "(  )".
// Mirrored exactly in the backend's ValidationPatterns::PHONE so both
// layers agree on what's a valid phone number, e.g. "+256 779 557 514"
// or "(555) 123-4567".
export const PHONE_REGEX = /^\s*\+?(?=(?:.*?\d){7,15}\s*$)[\d\s().-]{7,20}\s*$/;

// Letters (incl. accented, via the Unicode property escape), spaces,
// hyphens, apostrophes, and periods only — blocks digits/symbols from name
// fields without rejecting real names ("O'Brien", "Jean-Pierre", "St. John").
export const NAME_REGEX = /^\s*\p{L}[\p{L}\s'.-]{1,99}\s*$/u;

export function isValidEmail(value: string): boolean {
    return EMAIL_REGEX.test(value.trim());
}

export function isValidPhone(value: string): boolean {
    return PHONE_REGEX.test(value.trim());
}

export function isValidName(value: string): boolean {
    return NAME_REGEX.test(value.trim());
}
