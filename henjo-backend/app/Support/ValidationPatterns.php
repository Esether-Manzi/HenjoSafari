<?php

namespace App\Support;

/**
 * Regex patterns shared by FormRequest rules and Filament form fields.
 * Mirrored exactly in the frontend's lib/utils/validation.ts so client-side
 * and server-side validation always agree on what counts as valid input.
 */
class ValidationPatterns
{
    // All three patterns tolerate incidental leading/trailing whitespace
    // (\s* at each end) rather than assuming the caller trims first —
    // Filament validates a field's raw live state before any
    // dehydrateStateUsing() cleanup runs, so a bare "^letter...letter$"
    // shape would wrongly reject "  Jane Doe  " before Sanitizer::clean()
    // ever gets a chance to trim it.

    public const EMAIL = "/^\s*[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)+\s*$/";

    // Optional leading +, then digits/spaces/hyphens/dots/parentheses, with
    // a lookahead requiring 7-15 actual digits — a character-class check
    // alone would pass junk like "-----" or "(  )". Accommodates formats
    // like "+256 779 557 514" or "(555) 123-4567".
    public const PHONE = '/^\s*\+?(?=(?:.*?\d){7,15}\s*$)[\d\s().-]{7,20}\s*$/';

    // Letters (incl. accented, via the Unicode property escape), spaces,
    // hyphens, apostrophes, and periods only — blocks digits/symbols from
    // name fields without rejecting real names ("O'Brien", "St. John").
    public const NAME = "/^\s*\p{L}[\p{L}\s'.-]{1,99}\s*$/u";
}
