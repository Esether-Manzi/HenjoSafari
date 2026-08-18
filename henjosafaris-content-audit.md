# Henjo African Safaris — Website Content Audit
**Source:** https://henjosafaris.com/ (also aliased as https://www.henjoafricansafaris.com/)
**Purpose:** Full content/sitemap capture to support rebuild on Laravel (backend/API) + Next.js (frontend)
**Platform (current):** WordPress + WooCommerce (product catalog), Slider Revolution (hero sliders), Contact Form 7 (contact form), Pesapal (payment gateway)
**Date scraped:** August 2026

---

## 1. Site Map / Page Inventory

| # | Page | URL | Notes |
|---|------|-----|-------|
| 1 | Home | `/` | Hero slider, search widget, destination cards, featured tours per country, offers, affiliations |
| 2 | Safaris (all tours) | `/destination/uganda/` (Safaris nav item points here) | Acts as "all tours" landing |
| 3 | Tour Category: Wildlife Adventure | `/product-category/wildlife-adventure/` | WooCommerce product category archive |
| 4 | Tour Category: Gorilla Trekking | `/product-category/gorilla-safaris/` | " |
| 5 | Tour Category: Fly-In Safaris | `/product-category/flying/` | " |
| 6 | Tour Category: Mountaineering | `/product-category/mountaineering/` | " |
| 7 | Tour Category: Cultural Tour | `/product-category/cultural-tour/` | " |
| 8 | Tour Category: Women Only Tours | `/women-only-tours-to-uganda-rwanda-kenya/` | Standalone page + nav category |
| 9 | Tour Category: City Tours | `/product-category/city-tours/` | " |
| 10 | (Also referenced) Birding | `/product-category/birding/` | Appears as a tag on products, not in main nav |
| 11 | (Also referenced) Cycling | `/product-category/cycling/` | Appears as a tag on products |
| 12 | (Also referenced) Day Tours | `/product-category/day-tours/` | Appears as a tag on products |
| 13 | Destination: Kenya | `/destination/kenya/` | Tour archive filtered by country |
| 14 | Destination: Tanzania | `/destination/tanzania/` | " |
| 15 | Destination: Uganda | `/destination/uganda/` | " |
| 16 | Destination: Rwanda | `/destination/rwanda/` | " |
| 17 | Travel Information | `/travel-information/` | Blog-style list of travel/visa articles |
| 18 | — Visa guide article | `/east-africa-tourist-visa-guide/` | Sub-article |
| 19 | — Uganda entry requirements article | `/entry-requirements-for-uganda/` | Sub-article |
| 20 | About Us | `/about-us/` | Company bio + team preview |
| 21 | About Our Charity | `/about-our-charity/` | Empathy Children Initiative partnership |
| 22 | Our Team | `/our-team/` | Full staff bios |
| 23 | Blog | `/blog/` | (nav link exists; not fully scraped — WordPress blog index) |
| 24 | Booking Policy | `/booking-policy/` | Deposit, cancellation, children policy |
| 25 | Contact | `/contact/` | Contact form, map, phone/email |
| 26 | Individual Tour/Product pages | `/product/{slug}/` | ~25+ individual safari package pages (see Section 5) |
| 27 | Login / Register | `/login` | WooCommerce account pages |
| 28 | Cart | (WooCommerce cart, empty by default) | |
| 29 | Booking Page / Trip Planner | `/booking-page/` and `/trip-planner/` | Referenced in footer/CTA buttons |
| 30 | Pay Online | External: `https://payments.pesapal.com/henjoafricansafaris` | Pesapal payment portal |

**Global elements present on every page:** top utility bar (phone/email), header logo, main nav w/ dropdowns, tour search widget (region/activity/price/date), footer (address, contacts, quick links, payment logo, social icons, copyright).

---

## 2. Global Navigation Structure

```
Home
Safaris  →  (mega-menu)
  ├─ Wildlife Adventure
  ├─ Gorilla trekking
  ├─ Fly In Safaris
  ├─ Mountaineering
  ├─ Cultural Tour
  ├─ Women Only Tours
  └─ City Tours
Women Only Tours (standalone top-level link, duplicated from submenu)
Destinations →
  ├─ Kenya
  ├─ Tanzania
  ├─ Uganda
  └─ Rwanda
Travel Information
About Us →
  ├─ About Our Charity
  ├─ Our Team
  ├─ Blog
  └─ Booking Policy
Contact
[Search icon]
```

**Utility bar (top):** `+256779557514` (tel link), `info@henjosafaris.com` (email link), Login, Register, Cart (with item count).

**Tour search widget (Home page hero):**
- Departing (date)
- Returning (date)
- Select Region: Any Region / Kenya / Rwanda / Tanzania / Uganda
- Select Activity: Any Activity / City Tours / Day tours / Gorilla safaris (dropdown truncated in scrape — likely full category list)
- Price Range: Any Price Range
- "Find Tours" submit button

**Footer (repeated site-wide):**
- **Addresses:** Uganda Office — Plot 402, Seguku, Entebbe, Box 700589, Entebbe, Uganda
- **Contacts (multi-country phone numbers):**
  - +256 779 557 514 (UG)
  - +254 739 013 098 (KE)
  - +1 929 243 96995 (USA/CA)
  - +441 226652077 (UK)
  - +31 616753816 (NL)
  - Email: info@henjosafaris.com
- **Quick links:** Home, Kenya, Uganda safaris, Gorilla trekking, Tanzania, Rwanda, Book Schedule A Meeting, Pay Online
- **Payment:** "Click To Pay Online" badge/logo image
- **Social icons:** Facebook, Twitter/X (@henjosafaris), Instagram (@henjo.african.safaris), LinkedIn, TikTok (@henjo_african_safaris)
- **Copyright:** "2023 | All rights reserved - Henjo African safaris." + credit to site designer (webvator.com) — **omit/replace on rebuild**
- **Affiliations/partner logos (Home page only):** IATA, TripAdvisor, Travel Aware, Eco Tourism Australia

---

## 3. Page-by-Page Content

### 3.1 Home (`/`)
**Meta title:** Henjo African Safaris - African Safari Vacation - Call: +256779557514
**Meta description:** Henjo African Safaris Ltd is a Ugandan Tour agency offering Bespoke Safaris, Tailor Made Holidays, Authentic Luxury African Safaris, Fly-In Safaris, Gorilla Tracking. Email: info@henjoafricansafaris.com

**Sections (in order):**
1. **Hero slider** (4 slides, Slider Revolution): rotating headlines —
   - "KARIBU KENYA! Henjo African safaris — Explore Tours — Experience the wild."
   - "Discover the wild side. Henjo African safaris — Explore Tours"
   - "Gorilla safaris — Henjo African safaris — Explore Tours — Uncover the wild."
   - "Discover the wild within. Henjo African safaris — Explore Tours"
2. **Tour search widget** (see Section 2)
3. **"Why Henjo African Safaris"**
   - Heading: *Well organized tours to elevate your spirit!*
   - Body: "The combination of our experienced team of travel consultants and our certified driver guide assures a safe, treasurable, thrilling and informative safari."
4. **"Our Top Safari Destinations"** — intro copy: "We aim at creating dreamy experiences and uncover a range of exhilarating, inspiring journeys to East Africa. We expand our operations and offer itineraries toward exploration of every corner of East Africa."
   - 4 destination cards: Kenya ("Wildebeest Migration"), Uganda ("The pearl of Africa"), Tanzania ("Home of Mount Kilimanjaro"), Rwanda ("The Land of Thousand Hills")
5. **"Must do Kenya safaris"** — 4 featured product cards (see Section 5 for full details)
6. **"Best Of Uganda safaris"** — 6 featured product cards
7. **"Must do Tanzania safaris"** — 4 featured product cards
8. **Value proposition icon-blocks (3):**
   - "Book With Us Online" — "Make your booking online directly with us as soon as possible in the fastest and best as possible."
   - "Special Offers For Children" — "Free safari for children below 5 years from one family or group and a 25% discount for children between 6-12 years."
   - "Disability Tours & Safaris" — "We believe in Responsible and Inclusive Tourism, and for this reason whether you have a disability or not, we welcome you to experience your African holiday with us."
   - "Medical Travel Insurance" — "Our tours come with a free medical insurance upto 10 days which protects you in the event of an illness or injury while on a safari in Uganda with Henjo African Safaris."
9. **"Affiliations"** — partner logo strip (IATA, TripAdvisor, Travel Aware, Eco Tourism Australia)
10. **Footer** (global)

---

### 3.2 About Us (`/about-us/`)
**Meta title:** About Us - Henjo Safaris
Breadcrumb: Home / About Us

**Body copy:**
> Henjo African Safaris Ltd is a Ugandan Tour agency offering Bespoke Safaris, Tailor Made Holidays, Authentic Luxury African Safaris, Fly-In Safaris, Gorilla Tracking and Cultural Safaris. We take pride in having a team of professionals who have traveled in East Africa and now work to ensure that our clients both acquire a unique and educational experience of African wildlife, landscape, and culture. The competence and knowledge of our safari tour guides highly contribute to the overall experience. We believe this will provide our clients with the best experience possible as they embark on a journey with our team. Clients can fully enjoy the scenery, wildlife, and other activities knowing that they are with the best guide. Your experience is important to us!
>
> Henjo African Safaris continues to endeavor to be sustainable in practice in the tours we offer to protect the African wildlife and ensure that the tourism industry continues to prosper. We are working towards the goal of leaving a minimal negative impact on the environment and local communities. We are working towards integrating environmental and social best practices into every aspect of our businesses. Henjo African Safaris believes in Responsible and Inclusive Tourism, therefore we offer Disability Tours & Safaris and for this reason whether you have a disability or not, we welcome you to experience your African holiday with us. We are represented on SafariBookings.com.
>
> We have different types of tours available for you to choose from ranging from short stays to longer durations. Henjo African safaris is also capable of creating a tailor-made safari tour just for you. If you are interested in this kindly get in touch with us and we will make sure your dream will be turned into a reality.

**"Meet Our Team" (preview — 4 people):**
| Name | Role | Notes |
|---|---|---|
| Joan Tusubira | Director / Head of Women Only Safaris / Reservations Manager | |
| Claire Robinah | Head Guide | |
| Magemeso Faziri | Driver | |
| Henry Katinda | Founder / CEO | LinkedIn + Facebook links |

---

### 3.3 Our Team (`/our-team/`)
**Meta title:** Our Team - Henjo Safaris
Breadcrumb: Home / Our Team

**Full bios:**

**Henry Katinda — Founder/CEO**
> My passion for tourism began at the age of 18 when I worked as a part time Tour guide at the source of the Nile in Jinja. This experience ignited a deep love for African wildlife and the incredible landscapes that make the continent so unique.
>
> Driven by a desire to share my passion with others, I founded Henjo African Safaris to provide personalized, high-quality tours that showcase the beauty and diversity of East Africa. With a focus on responsible tourism, the company works closely with local communities and conservation organizations to ensure that its tours have a positive impact on both the environment and the people who call them home.
>
> As a strong advocate for women's empowerment, I am proud that 90% of our employees (both directly and indirectly) are women. I believe that providing opportunities for women to succeed in the tourism industry is crucial to creating a more equitable and sustainable future for Africa.
>
> In addition to running the safari company, I also founded the Empathy Children Initiative (empathychildren.org), a charity that helps 50 vulnerable children in Mayuge District, Eastern Uganda acquire education, helps single moms and widows with micro-revolving loans to start up their own business ventures to increase household income and promote self-sufficiency, and helps teenage girls from vulnerable backgrounds with sanitary towels. 40% of the earnings from the safari company are directed towards these initiatives.
>
> Through my commitment to responsible tourism, women's empowerment, and community development, I have established myself as a leader in the safari industry.

Links: LinkedIn (`linkedin.com/in/henry-katinda-a91b121a0`), Facebook (`facebook.com/henry.katinda`)
Includes 4 gallery images.

**Joan Tusubira — Director / Head of Women Only Safaris / Reservations Manager** (bio not expanded on this page — see Women Only Tours page for her bio)

**Claire Robinah — Head Guide** (no expanded bio scraped)

**Magemeso Faziri — Driver** (no expanded bio scraped)

---

### 3.4 About Our Charity (`/about-our-charity/`)
**Meta title:** About Our Charity - Henjo Safaris
Breadcrumb: Home / About Our Charity

**Body copy:**
> Henjo African Safaris is more than just a premier safari company; it's a beacon of hope for vulnerable children in Africa. Through a strategic partnership with Empathy Children Initiative, Henjo African Safaris dedicates itself to making a tangible difference in the lives of these children. Every booking made directly with Henjo African Safaris contributes directly to the well-being, education and Menstrual Hygiene programs of these children. Whether you're embarking on a thrilling safari adventure or planning a serene getaway, your decision to book with Henjo African Safaris means you're actively participating in changing lives and building brighter futures for those in need. Join us in making a lasting impact through unforgettable experiences.

CTA: "Read More" → external link `https://empathychildren.org/`

---

### 3.5 Women Only Tours (`/women-only-tours-to-uganda-rwanda-kenya/`)
**Meta title:** Women only tours to Uganda, Rwanda & Kenya - Henjo Safaris
Breadcrumb: Home / Women only tours to Uganda, Rwanda & Kenya

**Body copy:**
> Our Women-only travel packages offer a safe and empowering way for women to explore Uganda, Kenya & Rwanda on their terms. These packages enable our clients to feel a sense of security and safety it provides. Henjo African Safaris offer security measures such as women-only attendants in accommodations, transportation, as well as local female guides and support networks in the destinations they visit. This can give women the confidence to travel to destinations that may be considered unsafe for solo female travelers.
>
> Choosing women-only travel packages offers the opportunity to connect with other like-minded women and provides a supportive and empowering environment where women can bond and make lasting friendships. This can be particularly beneficial for women who are traveling solo and may feel lonely or isolated.
>
> In addition to the safety and social aspects, women-only travel packages also offer unique travel experiences that are tailored to the interests and needs of women. These can include activities such as wellness retreats, cultural immersion experiences, adventure sports, and teenage girls' Menstrual health programs. We work with local female-owned businesses and organizations to provide authentic and empowering travel experiences.

**Featured person — Joan Tusubira:**
> Joan Tusubira is the co-founder/director of Henjo African safaris. She is among the few women in a male dominated travel industry in Uganda. She has been working as a tour guide for the past 7 Years and she's a strong leader passionate about female travel, environment and culture. She loves doing charity to vulnerable children and helping teenage girls on matters of menstrual health. Her charming sense of humor will make you smile. She works hard to ensure that travelers have experiences in deep balance while visiting Uganda, Kenya and Rwanda.

*(Note: no specific "women only" tour packages/products were listed on this page at scrape time — it functions as an informational/marketing page.)*

---

### 3.6 Travel Information (`/travel-information/`)
**Meta title:** Travel Information - Henjo Safaris
Breadcrumb: Home / Travel Information

**Intro copy:**
> Africa is extraordinary and her people evoke a sense of adventure, romance and deep connection to nature. Find the reliable information from Henjo African Safaris as you dive into the true essence of Africa.

**Articles listed (blog-style cards):**

1. **East Africa Tourist Visa guide** (`/east-africa-tourist-visa-guide/`)
   > This is a Joint Tourist Visa and it allows the traveler to travel to Uganda, Kenya, and Rwanda ONLY. It can be used multiple times for tourism purposes. The visa prohibits employment and is issued only for tourism purposes. The visa is valid for 90 days and is not renewable upon expiry or upon exit […]

2. **Entry Requirements For Uganda** (`/entry-requirements-for-uganda/`)
   > Uganda Tourist Visa – Single Entry. This visa is granted to travelers coming to Uganda for tourism, is a single-entry visa and can be granted for up to 3 months. Apply online at visas.immigration.go.ug. Requirements: Passport copy (bio-data page) with at least 6 months validity, Tour Plan, Travel itinerary/booking […]

*(Both articles are truncated by "Read more" links; full content should be scraped individually if needed — not captured in full here.)*

---

### 3.7 Booking Policy (`/booking-policy/`)
**Meta title:** Booking Policy - Henjo Safaris
Breadcrumb: Home / Booking Policy

**BOOKING POLICY**
- A 30% deposit is required to confirm booking within 7 days of written confirmation; otherwise treated as provisional only, with possible inability to reinstate the reservation.
- After confirmation, the 30% deposit is paid and booking is confirmed.
- One calendar month before commencement of the safari, the remaining 70% of total safari cost is paid.
- The above is at the discretion of Henjo African Safaris Ltd.

**Special requirements and insurance**
- Clients' incoming travel insurance is covered by Henjo African Safaris for 12 days while on safari.
- If the client is fully covered by their own insurance, details should be forwarded at least 4 weeks before the commencement of the safari.
- Any medical conditions should be mentioned.

**TERMS & CONDITIONS — CANCELLATIONS**
- Before cancellation, Henjo African Safaris and the client will discuss the possibility of rescheduling.
- Cancellations must be made in writing and are only effective upon acknowledged receipt by Henjo African Safaris.
- Cancellation penalty schedule:
  - 30 days or more before commencement (remaining 70% due): 5% forfeit of the 30% deposit
  - 60 days or more before commencement: forfeit 20%
  - Less than 60 days before commencement: forfeit 50% of package price
  - Less than 30 days before commencement: forfeit 100% of package price

**CHILDREN**
- Children welcome on safaris.
- Free spot for kids below 5 years (1 kid per group).
- 25% discount for 6–12 year-olds.

---

### 3.8 Contact (`/contact/`)
**Meta title:** Contact - Henjo Safaris
Breadcrumb: Home / Contact

**Sections:**
- "Get in Touch" — "Contact us by email, phone or through our web form below."
- **Call Us:** +256 779 557 514 (tel link)
- **Email:** info@henjoafricansafaris.com *(note: differs slightly from footer's info@henjosafaris.com — confirm correct email with client)*
- Contact form (WordPress Contact Form 7, id 3289, title "Contact Us") — fields not retrievable from static scrape; standard fields likely: Name, Email, Phone, Subject, Message
- Embedded Google Map centered on Kampala

---

### 3.9 Destinations — Overview

Each destination page displays: page title, breadcrumb, and a grid of tour/product cards filtered by that country (image, title, category tags, "0 Place / N Activity" meta, short excerpt, "Explore" button, starting price). A "Recently Viewed" widget appears at the bottom (client-side, cookie-based — same 3 products shown across pages in the scrape, indicating this is dynamic/session based, not static content).

#### 3.9.1 Uganda (`/destination/uganda/`)
14 tours listed — see Section 5 table (Uganda group).

#### 3.9.2 Kenya (`/destination/kenya/`)
11 tours listed — see Section 5 table (Kenya group). Note: several Kenya tours show "from $0.00" — indicates missing/unset price in the source WooCommerce data; flag for client to confirm real prices before rebuild.

#### 3.9.3 Tanzania (`/destination/tanzania/`)
4 tours listed — see Section 5 table (Tanzania group).

#### 3.9.4 Rwanda (`/destination/rwanda/`)
Page heading: "Holidays in Rwanda" / section heading "Top Attractions" (differs from other destination pages which use "Tours in X").
4 tours listed — see Section 5 table (Rwanda group). Note: Kigali City Tour shows "from $0.00" — same missing-price issue.

---

## 4. Tour/Safari Categories (Taxonomy)

These function as WooCommerce product categories/tags. Recommend modeling as a many-to-many `categories` taxonomy in the rebuild (a tour can belong to multiple categories).

| Category | Slug | In main nav? |
|---|---|---|
| Wildlife Adventure | `wildlife-adventure` | Yes |
| Gorilla Trekking (labelled "Gorilla safaris" on product tags) | `gorilla-safaris` | Yes |
| Fly In Safaris (labelled "Flying" on product tags) | `flying` | Yes |
| Mountaineering | `mountaineering` | Yes |
| Cultural Tour | `cultural-tour` | Yes |
| Women Only Tours | (standalone page, not a product category archive) | Yes |
| City Tours | `city-tours` | Yes |
| Birding | `birding` | No (tag only) |
| Cycling | `cycling` | No (tag only) |
| Day Tours | `day-tours` | No (tag only) |

---

## 5. Tours / Safari Packages (Product Catalog)

Each tour is a WooCommerce "product" at `/product/{slug}/`. A sample full product page was scraped in detail (Section 5.1) to document the page template structure; all other tours follow the same template (Overview / Itinerary / Accommodation tabs). Section 5.2 is a master list of every tour discovered across the Home, destination, and category pages, with price and category — use this as the seed data set/spreadsheet for the new product database, then re-scrape each `/product/{slug}/` URL individually for full day-by-day itineraries, inclusions/exclusions, and accommodation options before launch.

### 5.1 Sample full product page structure — "4-Day Bwindi Gorilla Trekking Flying Safari"
URL: `/product/4-day-bwindi-gorilla-trekking-flying-safari/`

- **Title:** 4-Day Bwindi Gorilla Trekking Flying Safari
- **Price:** from $3,480.00
- **Short description:** "The top highlight on this 4-day Uganda Gorilla Safari is, of course, African Mountain Gorilla Trekking in Uganda's Bwindi Impenetrable Forest. The Uganda gorilla trek takes us through the dense jungle to encounter the endangered mountain gorillas in the wild. Bwindi Forest is also known for its high biodiversity and excellent bird watching."
- **Meta fields:** Reviews (0 Reviews / 0/5), Vacation Style: "Family" (Holiday Type), Activity Level: "Challenging" (5/8)
- **CTA:** "Book Now" → `/trip-planner/`
- **Share/Tweet** social buttons
- **Tabs:** Overview | Itinerary | Accommodation

**Included:**
- Park fees (for non-residents)
- Gorilla Permits
- All activities (unless labeled optional)
- All accommodation (unless listed as upgrade)
- A professional driver/guide
- All transportation (unless labeled optional)
- All taxes/VAT
- Meals (as specified in day-by-day section)
- Drinking water (all days)

**Excluded:**
- International flights (from/to home)
- Roundtrip airport transfer
- Additional accommodation before/after tour
- Tips
- Personal items (souvenirs, travel insurance, visa fees, etc.)
- Government-imposed tax increases
- Some meals (as specified in day-by-day section)

**Itinerary (day-by-day):**
| Day | Title | Details |
|---|---|---|
| 1 | Arrival Entebbe Airport and transfer to Hotel | Welcome by representative, transfer to hotel in Entebbe. Overnight Hotel No.5. Meals: Dinner, Breakfast. |
| 2 | Entebbe – Fly to Bwindi – Buhoma Lodge | Transfer to Entebbe Airport, scheduled flight (~2 hrs) to Bwindi (Kihihi/Kisoro airstrip), transfer to lodge, afternoon Batwa trail experience. Overnight Buhoma Lodge. Meals: Lunch, Dinner. |
| 3 | Bwindi Gorilla Trekking – Buhoma Lodge | Briefing at 8am with UWA staff, gorilla trekking (2–6 hrs), afternoon Buhoma Village Walk. Overnight Buhoma Lodge. |
| 4 | Bwindi to the Airstrip, fly back to Entebbe | Morning (dep 0945/arr 1125) or afternoon (dep 1445/arr 1615) flight option back to Entebbe. End of service. Meals: Breakfast. |

**Accommodation tab:** Describes 3 accommodation tiers offered across the catalog (Moderate, Luxury, Budget), plus example lodge names for this specific tour (Da Vinci Gorilla Lodge, Bweza Gorilla Lodge).
- *Moderate:* ~3-star, self-contained rooms, hot water daily, boutique-style.
- *Luxury:* 4–5 star, example cited: Chobe Safari Lodge.
- *Budget:* Minimum amenities, clean/safe rooms, generally under ~€50/night, 1–2 star equivalent.

> **Rebuild recommendation:** Model each tour as: `title, slug, summary, description, hero_image, gallery[], price_from, currency, duration_days, holiday_type (tag), activity_level (1–8 scale + label), categories[], destinations[] (country), included[], excluded[], itinerary[{day, title, body}], accommodation_options[{tier, name, image}], meta (reviews_count, rating)`.

### 5.2 Master Tour List (as discovered across Home + Destination + Category pages)

**Uganda**
| Tour | Categories | Price (from) | URL slug |
|---|---|---|---|
| 4-Day Bwindi Gorilla Trekking Flying Safari | Flying, Gorilla safaris, Wildlife Adventure | $3,480.00 | `4-day-bwindi-gorilla-trekking-flying-safari` |
| 5-Day Birding Safari to Uganda | Birding, Wildlife Adventure | $1,308.00 | `5-day-birding-safari-to-uganda` |
| 8 Days Western Uganda Cycling Safari | Cycling, Wildlife Adventure | $1,516.00 | `8-days-western-uganda-cycling-safari` |
| Kampala Cultural Tour | City Tours, Cultural Tour | $180.00 | `kampala-cultural-tour` |
| 1 Day White Water Rafting on the Nile | City Tours, Wildlife Adventure | $180.00 | `1-day-white-water-rafting-on-the-nile` |
| Kampala City Tour | City Tours | $80.00 | `kampala-city-tour` |
| 8 Days Mountain Rwenzori Hiking Safari | Mountaineering | $2,650.00 | `8-days-mountain-rwenzori-hiking-safari` |
| 5 Day Mount Elgon Hiking Safari | Mountaineering | $1,316.00 | `5-day-mount-elgon-hiking-safari` |
| 5-Day Uganda Safari Holiday | Gorilla safaris, Wildlife Adventure | $1,960.00 | `5-day-uganda-safari-holiday` |
| 3-Day Queen Elizabeth Safari Holiday | Wildlife Adventure | $956.00 | `3-day-queen-elizabeth-safari-holiday` |
| 4-Day Queen Elizabeth & Lake Mburo National Parks Safari | Wildlife Adventure | $1,050.00 | `4-day-queen-elizabeth-lake-mburo-national-parks-safari` |
| 7-Day Kibale National Park and Gorillas Safari | Gorilla safaris, Wildlife Adventure | $2,215.00 | `7-day-kibale-national-park-and-gorillas-safari` |
| 6-Day Kidepo and Murchison Falls Wilderness Tour | Day tours, Wildlife Adventure | $1,823.00 | `6-day-kidepo-and-murchison-falls-wilderness-tour` |
| 4-Day Bwindi, Lake Bunyonyi and Queen Elizabeth Safari | Gorilla safaris, Wildlife Adventure | $1,560.00 | `5-day-highlighted-gorillas-a4-day-bwindi-lake-bunyonyi-and-queen-elizabeth-safarnd-wildlife-safari` *(note: slug/title mismatch on live site — flag for cleanup)* |
| 4-Day Kidepo Wildlife Safari | Day tours, Wildlife Adventure | $750.00 | `4-day-kidepo-wildlife-safari` |

**Kenya**
| Tour | Categories | Price (from) | URL slug |
|---|---|---|---|
| 12-Day Kenya Classic Signature Wildlife Safari (v2) | Wildlife Adventure | $0.00 ⚠ | `12-day-kenya-classic-signature-wildlife-safari-2` |
| 5-Day Masai Mara Flying Luxury Safari | Wildlife Adventure | $0.00 ⚠ | `5-day-masai-mara-flying-luxury-safari` |
| 8 Days Best of Kenya Safari | Wildlife Adventure | $0.00 ⚠ | `8-days-best-of-kenya-safari` |
| 9-Day Kenya Beach Holiday and Luxury Wildlife Safari | Wildlife Adventure | $0.00 ⚠ | `9-day-kenya-beach-holiday-and-luxury-wildlife-safari` |
| 6-Day Mount Kenya Chogoria Route Climbing Package | Mountaineering | $0.00 ⚠ | `6-day-mount-kenya-chogoria-route-climbing-package` |
| 5-Day Masai Mara Fly-in Luxury Safari | Wildlife Adventure | $3,000.00 | `5-day-masai-mara-fly-in-luxury-safari` |
| 12-Day Kenya Classic Signature Wildlife Safari | Wildlife Adventure | $4,000.00 | `12-day-kenya-classic-signature-wildlife-safari` |
| 6-Day Kenya Safari Holiday | Wildlife Adventure | $1,516.00 | `6-day-kenya-safari-holiday` |
| 5-Day Masai Mara, Nakuru, Naivasha | Wildlife Adventure | $1,316.00 | `5-day-masai-mara-nakuru-naivasha` |
| 4-Day Tsavo and Amboseli Kenya Safari | Wildlife Adventure | $1,016.00 | `4-day-tsavo-and-amboseli-kenya-safari` |
| 3-Day Best of Masai Mara | Wildlife Adventure | $978.00 | `3-day-best-of-masai-mara` |

⚠ = price shown as $0.00 on live site — likely unset/misconfigured in WooCommerce; confirm real values with client before migrating.

**Tanzania**
| Tour | Categories | Price (from) | URL slug |
|---|---|---|---|
| 3-Day Safari – Tarangire, Ngorongoro & Lake Manyara | Wildlife Adventure | $906.00 | `3-day-safari-tarangire-ngorongoro-lake-manyara` |
| 4-Day Luxury Tanzania Safari | Wildlife Adventure | $2,050.00 | `4-day-luxury-tanzania-safari` |
| 4-Day Tanzania Safari Tarangire, Serengeti & Manyara | Wildlife Adventure | $2,016.00 | `4-day-tanzania-safari-tarangire-serengeti-manyara` |
| 7-Day Luxury Tanzania Safari | Wildlife Adventure | $3,256.00 | `7-day-luxury-tanzania-safari` |

**Rwanda**
| Tour | Categories | Price (from) | URL slug |
|---|---|---|---|
| Kigali – Rwanda City Tour | City Tours, Day tours | $0.00 ⚠ | `kigali-rwanda-city-tour` |
| 3-Day Gorillas and Golden Monkey Safari | Gorilla safaris | $2,816.00 | `3-day-gorillas-and-golden-monkey-safari` |
| 3-Day Rwanda Gorilla Safari | Gorilla safaris | $2,506.00 | `3-day-rwanda-gorilla-safari` |
| 7-Day Rwanda Akagera Safari and Golden Monkey Tour | Gorilla safaris, Wildlife Adventure | $3,016.00 | `7-day-rwanda-akagera-safari-and-golden-monkey-tour` |

> **Total distinct tours discovered: ~34.** This is very likely not exhaustive — the destination/category archive pages may paginate further tours not surfaced in this pass (no pagination controls were captured in the scrape). **Recommendation:** before final migration, either request a WooCommerce product export (CSV) directly from the current site admin, or run a full crawler against `/product/` sitemap XML (check `/sitemap.xml` or `/product-sitemap.xml`) to guarantee 100% catalog coverage — a manual page-by-page scrape risks missing older/unlinked products.

---

## 6. Contact & Company Information Summary

- **Legal/trading name:** Henjo African Safaris Ltd
- **Registered/Office address:** Plot 402, Seguku, Entebbe, Box 700589, Entebbe, Uganda
- **Phone numbers:**
  - Uganda: +256 779 557 514
  - Kenya: +254 739 013 098
  - USA/Canada: +1 929 243 96995
  - UK: +441 226652077 *(likely formatting artifact — probably +44 1226 652077, confirm with client)*
  - Netherlands: +31 616753816
- **Email(s):** info@henjosafaris.com (site-wide footer/header) and info@henjoafricansafaris.com (used on Contact page and meta descriptions) — **confirm which is the canonical inbox**
- **Social media:**
  - Facebook: facebook.com/profile.php?id=100083135236902
  - Twitter/X: twitter.com/henjosafaris (@henjosafaris)
  - Instagram: instagram.com/henjo.african.safaris
  - LinkedIn: linkedin.com/company/henjo-african-safaris
  - TikTok: tiktok.com/henjo_african_safaris
- **Payment:** Online payments processed via Pesapal — `https://payments.pesapal.com/henjoafricansafaris`
- **Affiliations/certifications displayed:** IATA, TripAdvisor, Travel Aware, Eco Tourism Australia (logos only, no accompanying text captured)
- **Domain note:** Site is served on two domains — `henjosafaris.com` (primary, currently live) and `henjoafricansafaris.com`/`www.henjoafricansafaris.com` (referenced throughout internal links, especially footer Quick Links and destination card links). **Clarify with client which domain is canonical for the new build**, and set up 301 redirects accordingly for SEO continuity.

---

## 7. Team Members Summary

| Name | Role | Bio available |
|---|---|---|
| Henry Katinda | Founder / CEO | Full bio (Section 3.3) |
| Joan Tusubira | Director / Head of Women Only Safaris / Reservations Manager | Short bio (Section 3.5) |
| Claire Robinah | Head Guide | Name/title only |
| Magemeso Faziri | Driver | Name/title only |

---

## 8. Special Offers / Policies (cross-page, repeated as marketing blocks)

- **Children:** Free for under-5s (1 per family/group); 25% discount for ages 6–12.
- **Disability/Inclusive tourism:** Disability Tours & Safaris offered; "Responsible and Inclusive Tourism" stated as a core value.
- **Medical travel insurance:** Free medical insurance included, up to 10 days, covering illness/injury while on safari.
- **Charity:** Partnership with Empathy Children Initiative (empathychildren.org) — 40% of company earnings reportedly directed to charity programs (per Founder bio) supporting: vulnerable children's education (50 children, Mayuge District), micro-loans for single mothers/widows, and menstrual hygiene products for teenage girls.
- **Booking deposit:** 30% deposit to confirm; balance (70%) due 1 month before departure.
- **Cancellation tiers:** see Section 3.7 in full.

---

## 9. Content Gaps / Items Needing Follow-Up Before Rebuild

**Resolved in this pass:**
- ✅ **Blog page** — fully scraped; confirmed only 2 posts exist (full text in Section 5.6).
- ✅ **All 34 individual product pages** — fully scraped in detail (itineraries, inclusions/exclusions, accommodation, meta fields) — see Section 5.3.
- ✅ **Booking Page / Trip Planner** — confirmed unreachable; root cause identified (expired domain) — see Section 5.5. No further scraping possible or needed; treat as a "build new" item instead.

**Still open:**
1. **Gallery page** — no dedicated "Gallery" page was found anywhere in the navigation or sitemap; images are embedded per-page only (product photos, team photos, hero sliders). If the rebuild requires a standalone Gallery page, this is a **new addition**, not a migration — confirm with the client whether one exists elsewhere/was planned.
2. **Missing prices ($0.00)** flagged on 6 tours (5 Kenya, 1 Rwanda) — confirm real pricing with client before launch (full list in Section 5.3, marked ⚠).
3. **Contact form fields** (Contact Form 7 shortcode `[contact-form-7 id="3289"]`) could not be introspected from a static scrape — inspect the live form in a browser to document exact fields/validation before rebuilding as a Laravel form.
4. **Login/Register/Cart** — standard WooCommerce account & cart pages; no unique marketing copy, straightforward to rebuild as generic e-commerce auth/cart flows.
5. **Canonical domain** — clarify `henjosafaris.com` vs `henjoafricansafaris.com`; given the latter has **expired and is for sale**, `henjosafaris.com` should very likely be the canonical domain going forward (see Section 6 and 5.5).
6. **Full product catalog completeness** — 34 tours were found and fully scraped via the Home, destination, and category archive pages. No pagination controls were observed on any archive page, suggesting this is the complete catalog, but a WooCommerce CSV/XML export from the site admin is still the more reliable way to guarantee 100% coverage, especially for older/unlinked products not surfaced in navigation.
7. **"Recently Viewed" widget** — confirmed client-side/cookie-driven, not real content; exclude from static content migration, but replicate as a UI feature (session-based recently-viewed tracking) in the rebuild if desired.
8. **Duplicate/near-duplicate products** — several tours exist as two near-identical listings with different prices or minor title variants (e.g. two "12-Day Kenya Classic Signature Wildlife Safari," two Masai Mara flying safaris, "3-Day" vs "4-Day" Queen Elizabeth safaris with identical itinerary text, "8 Days Best of Kenya" vs "9-Day Kenya Beach Holiday" with identical itinerary text). Recommend the client decide which of each pair is canonical before migration — full list with slugs in Section 5.3.
9. **Content-quality issues found during full scrape** — two product pages have leftover Lorem Ipsum placeholder text in their Accommodation tab; one has a leaked raw WordPress admin edit-post URL in the itinerary body text; several tours reference third-party representative/company names that aren't Henjo's own (e.g. "Africa Paradise Safaris," "Lion King," "Hermosa Life Tours") — likely copied from template content when products were created and never edited. Full list in Section 5.3/5.4.

---

## 10. Suggested Data Model for Laravel Backend (derived from content above)

```
Tour (Product)
├── id, slug, title, summary, description
├── price_from, currency
├── duration_days
├── holiday_type (e.g. Family)
├── activity_level (1–8 scale + label, e.g. "Challenging")
├── hero_image, gallery[]
├── categories[] (many-to-many → Category)
├── destination (belongs-to → Destination/Country)
├── included[] (text list)
├── excluded[] (text list)
├── itinerary[] (has-many → ItineraryDay: day_number, title, body)
├── accommodations[] (has-many → AccommodationOption: tier, name, image)
├── reviews_count, rating

Category
├── id, name, slug (Wildlife Adventure, Gorilla Trekking, Fly-In Safaris,
│    Mountaineering, Cultural Tour, City Tours, Birding, Cycling, Day Tours)

Destination (Country)
├── id, name, slug (Kenya, Tanzania, Uganda, Rwanda), hero_image, intro_copy

TeamMember
├── id, name, role, bio, photo, social_links[]

Page (flat CMS pages: About Us, About Our Charity, Women Only Tours,
      Travel Information, Booking Policy, Contact)
├── id, slug, title, body (rich text), meta_title, meta_description

Article (Travel Information sub-articles / Blog posts)
├── id, slug, title, body, image, published_at

Inquiry/Booking (from Contact form + Trip Planner/Booking Page)
├── id, name, email, phone, message, tour_id (nullable), created_at
```

---

## 5.3 Full Product Detail — All 34 Tours (Itineraries, Inclusions/Exclusions, Accommodation)

> All 34 tours share the identical page template described in Section 5.1 (Overview / Itinerary / Accommodation tabs; standard "Included/Excluded" boilerplate list; 3-tier Moderate/Luxury/Budget accommodation blurb). Only the tour-specific content is repeated below — day-by-day itinerary titles, unique inclusions, and named lodges — to keep this section scannable. Full narrative paragraph text for each day was captured in the scrape and can be supplied in full if needed for direct copy migration.

### UGANDA

**5-Day Birding Safari to Uganda** — $1,308 — Birding, Wildlife Adventure
Extra included: none beyond standard. Days: 1) Arrival/Mabamba wetlands shoebill canoe trip → Masindi 2) Birding the Royal Mile → Budongo Eco-Lodge 3) Kaniyo Pabidi birding → Murchison Falls NP 4) Morning game drive + afternoon boat trip to base of Falls 5) Top-of-falls birding, transfer to airport. Lodges: Rushaga Gorilla Havens Lodge, The Bush Lodge (Banda).

**8 Days Western Uganda Cycling Safari** — $1,516 — Cycling, Wildlife Adventure
Days: 1) Arrival, transfer to Entebbe/Kampala 2) Drive to Kibale + bike to Queen Elizabeth NP (Mweya Safari Lodge) 3) Bike Ishasha sector (Savannah Resort Hotel) 4) Bike to Ruhija sector, Bwindi (Ruhija Gorilla Lodge) 5) Gorilla tracking in Bwindi 6) Bike to Lake Bunyonyi (Bunyonyi Overland Resort) 7) Drive back to Kampala/Entebbe 8) Shopping + flight home.

**Kampala Cultural Tour** — $180 — City Tours, Cultural Tour
Single day covering: Maridadi Crafts (1hr), Kasubi Tombs (3hr — Buganda royal burial site), Kabaka's Palace/Mengo torture chambers (1hr), Ndere Cultural Centre traditional dance (3hr, Wed/Fri/Sun 7pm). Lodges: King Fisher, Jinja Nile Resort.

**1 Day White Water Rafting on the Nile** — $180 — City Tours, Wildlife Adventure
Single-day Jinja rafting trip (3–4 hrs on the water), Grade 5 raft or family float option (family float min. age 6), departs Kampala 6am, includes Jinja town city tour. Lodges: King Fisher, Jinja Nile Resort.

**Kampala City Tour** — $80 — City Tours
Single-day walking tour: old taxi park, Owino market, Kabaka's palace, Idi Amin torture chambers, Kasubi tombs, Kabaka's Lake, Hindu/Bahai temples, Gaddafi mosque, Uganda Martyrs Shrine, independence monument, Rolex street food. Lodges: Sheraton Hotel Kampala, Serena Hotel Kampala.

**8 Days Mountain Rwenzori Hiking Safari** — $2,650 — Mountaineering
Days: 1) Journey to Rwenzori (Equator Snow Lodge) 2) Nyakalengija (1600m) → Nyabitaba (2650m) 3) → John Matte (3350m) 4) → Bujuku (3900m) 5) → Elena Hut (4541m) 6) Summit attempt on Margherita Peak (5109m) or descend to Kitandara Hut (4023m) 7) → Guy Yeoman Hut (3260m) 8) Descend to Nyakalengiija (1600m), departure. Lodges: Equator Snow Lodge, John Matte Hut.

**5 Day Mount Elgon Hiking Safari** — $1,316 — Mountaineering
Days: 1) Kampala–Budadiri → Sasa Camp (2900m), incl. "Wall of Death" staircase section 2) → Mude Camp (3500m) 3) Summit Wagagai Peak (4321m), return to Mude 4) Mude → Budadiri 5) Transfer via Jinja/Source of the Nile to Kampala/Entebbe. Lodges: Mude Cave Campsite, Gorilla safari lodge (Sasa River Camp).

**5-Day Uganda Safari Holiday** — $1,960 — Gorilla safaris, Wildlife Adventure
Includes Gorilla + Chimpanzee Permits. Days: 1) Entebbe → Kibale (Bigodi Wetland walk) 2) Kibale chimp area → Queen Elizabeth (Kazinga Channel water safari) 3) QE game drives → Bwindi 4) Gorilla trekking → Lake Mburo 5) Lake Mburo walking safari (optional horse/bike) → Entebbe. Lodges: Twin Lakes Safari Lodge, Mweya Safari Lodge.

**3-Day Queen Elizabeth Safari Holiday** — $956 — Wildlife Adventure
Note: description text on live site actually describes the 4-Day QE/Lake Mburo itinerary (content mismatch/duplication on live site — flag for cleanup). Includes Gorilla + Chimp Permits per boilerplate (likely copy error since no trekking is scheduled). Days: 1) Lake Mburo boat cruise 2) Lake Mburo → Queen Elizabeth game drive 3) QE game drive + Kazinga Channel cruise 4) QE → Kampala. Lodges: Twin Lakes Safari Lodge, Mweya Safari Lodge.

**4-Day Queen Elizabeth & Lake Mburo National Parks Safari** — $1,050 — Wildlife Adventure
Same itinerary text/days as the 3-Day QE listing above (near-duplicate product — flag for consolidation). Lodges: Rwakobo Rock, Mweya Safari Lodge.

**7-Day Kibale National Park and Gorillas Safari** — $2,215 — Gorilla safaris, Wildlife Adventure
Days: 1) Arrive Entebbe, optional Botanical Gardens birding 2) Mabamba shoebill wetlands → Kibale 3) Kibale chimpanzee tracking + birding 4) → Queen Elizabeth NP 5) Ishasha tree-climbing lions → Bwindi 6) Bwindi gorilla trekking 7) → Entebbe airport. Lodges: Isunga Lodge, Gorilla safari lodge (Bunyonyi).

**6-Day Kidepo and Murchison Falls Wilderness Tour** — $1,823 — Day tours, Wildlife Adventure
Days: 1) Kapchorwa/Sipi Falls hike + coffee tour 2) → Kidepo Valley NP 3) Nature walk, game drive, Karamojong community cultural visit 4) → Murchison Falls NP 5) Game drive + launch cruise to base of Falls 6) → Kampala via Ziwa Rhino Sanctuary, depart. Lodges: Kidepo Savannah Lodge, Pakuba Safari Lodge.

**4-Day Bwindi, Lake Bunyonyi and Queen Elizabeth Safari** — $1,560 — Gorilla safaris, Wildlife Adventure (1 review, 5/5; Activity Level: Moderate 3/8)
*Note: slug (`5-day-highlighted-gorillas-a4-day-bwindi...`) doesn't match the displayed 4-day title — legacy WooCommerce slug artifact, flag for cleanup.* Days with full accommodation/meal breakdown per day: 1) Bwindi transfer + Batwa cultural experience (Rushaga Gorilla Haven's Lodge/Broadbill Forest Camp — budget) 2) Gorilla trekking + Lake Bunyonyi canoe ride (Bunyonyi Safaris Resort — mid-range) 3) → Queen Elizabeth, Kazinga Channel boat cruise + evening game drive (The Bush Lodge/Banda — mid-range) 4) Chimp trek at Kalinzu Forest Reserve → Entebbe (end of tour). *Accommodation tab contains leftover Lorem Ipsum placeholder text on live site — flag for content team.*

**4-Day Kidepo Wildlife Safari** — $750 — Day tours, Wildlife Adventure (2 reviews, 5/5; Activity Level: Moderate 3/8)
Days with full accommodation/meal breakdown: 1) Kampala → Kidepo Valley NP via Gulu/Kitgum (Kidepo Savannah Lodge/camping) 2) Two game drives, Kanangorok Hot Springs option 3) Game drive + Karamojong cultural tour 4) → Kampala → Entebbe airport. Notes on page: airport transfer, pre/post accommodation, and return transfer all arrangeable "for an extra cost." Lodges referenced: Red Chilli Hideaway, Murchison River Lodge, Jinja Base Camp.

### KENYA

**12-Day Kenya Classic Signature Wildlife Safari** *(v2, slug `-2`)* — $0.00 ⚠ — Wildlife Adventure
Same 12-day itinerary as the priced version below (near-duplicate product listing — consolidate). Days: 1) Arrive Nairobi (Ibis Styles Nairobi Westlands) 2) → Masai Mara (Fisi Camp) 3–4) Masai Mara game drives, optional balloon safari $500pp, Maasai village visit 5) → Lake Naivasha boat ride (Panorama Hotel Naivasha) 6) → Lake Nakuru NP (Hotel CityMax) 7) → Amboseli NP (AA Lodge Amboseli) 8) Full day Amboseli 9) → Tsavo West NP (Ngulia Safari Lodge) 10) → Tsavo East NP (Ashnil Aruba) 11) Full day Tsavo East (Aruba Dam, Mudanda Rock, Yatta Plateau) 12) → Nairobi, depart.

**5-Day Masai Mara Flying Luxury Safari** — $0.00 ⚠ — Wildlife Adventure
Days: 1) Nairobi (JKIA) → Wilson Airport → fly to Kichwa Tembo airstrip, Masai Mara, afternoon game drive 2–4) Morning/afternoon game drives, optional hot air balloon (+$450 on day 4), sundowners, pool time 5) Sunrise game drive, optional Maasai village visit, fly back to Nairobi. All 5 nights at &Beyond Kichwa Tembo Tented Camp (luxury+, unfenced).

**8 Days Best of Kenya Safari** — $0.00 ⚠ — Wildlife Adventure
Coastal/beach-focused itinerary (not wildlife-inland as the name suggests — content appears misaligned with title, flag for review). Days: 1) Mombasa/Malindi airport → Diamonds Dream of Africa Resort 2) Vasco da Gama Pillar + Malindi Marine Park 3) Gedi Ruins excursion 4) → Mombasa, Haller Park nature trail (Sarova Whitesands Beach Resort) 5) Fort Jesus + Old Town Mombasa 6) → Diani, Shimba Hills NR game drive + Sheldrick Falls (Baobab Beach Resort) 7–8) Diani Beach leisure/optional add-ons 9) → Moi International Airport, depart. *Note: itinerary text is nearly identical to the 9-Day Kenya Beach Holiday listing below — duplicate content, flag for cleanup.*

**9-Day Kenya Beach Holiday and Luxury Wildlife Safari** — $0.00 ⚠ — Wildlife Adventure
Itinerary identical to "8 Days Best of Kenya Safari" above (same days/lodges: Diamonds Dream of Africa, Sarova Whitesands, Baobab Beach Resort) — confirmed duplicate content on the live site.

**6-Day Mount Kenya Chogoria Route Climbing Package** — $0.00 ⚠ — Mountaineering, Camping
Days: 1) Nairobi → Chogoria Gate, trek to Mt Kenya Bandas (budget camping) 2) → Lake Ellis Camp (3600m) 3) → Mintos Hut (4200m), "the Temple" viewpoint 4) → Austrian Hut via Tooth Col 5) Pre-dawn summit of Pt Lenana (hiker's summit), descend via Mackinder's Valley to Liki North Camp (3900m) 6) → Old Moses Camp → Nairobi. Camping-only accommodation (mountain huts). Lodges/camps referenced: Camp at Point Lenana, Shipton Hut.

**5-Day Masai Mara Fly-in Luxury Safari** — $3,000 — Wildlife Adventure
Same itinerary/lodge as the "Flying Luxury Safari" listing above (&Beyond Kichwa Tembo Tented Camp) — near-duplicate product with different price set, consolidate.

**12-Day Kenya Classic Signature Wildlife Safari** *(priced version)* — $4,000 — Wildlife Adventure
Full 12-day itinerary as summarized in the $0.00 duplicate above; this listing has complete pricing and additional accommodation gallery images. Reference: Tsavo West best-time-to-visit note ("June to October and January to February").

**6-Day Kenya Safari Holiday** — $1,516 — Wildlife Adventure
Days: 1) Nairobi → Masai Mara (Mara Enkorok Tented Camp) 2) Full-day Masai Mara game drives 3) → Lake Nakuru NP (Hotel Waterbuck) 4) Nakuru park visit → Amboseli (AA Lodge) 5) Amboseli full day, Kilimanjaro views 6) Amboseli → Nairobi. Lodges: Enkorok Mara Camp, Amboseli Sopa Lodge.

**5-Day Masai Mara, Nakuru, Naivasha** — $1,316 — Wildlife Adventure
Days: 1) → Masai Mara (Goshen Camp) 2) Full game drive, optional Maasai village ($20pp) 3) → Lake Nakuru (Lanet Matfam Resort) 4) Nakuru game drive → Lake Naivasha 5) Hell's Gate NP (walking/cycling park) → Nairobi. Lodges: Mara Serena Safari Lodge, Lanet Matfam Resort.

**4-Day Tsavo and Amboseli Kenya Safari** — $1,016 — Wildlife Adventure
Days: 1) Mombasa → Tsavo West NP, Mzima Springs (Ngulia Safari Lodge) 2) → Amboseli NP (Sentrim Amboseli Camp) 3) → Tsavo East NP, "red elephants" (Voi Safari Lodge) 4) → Mombasa. Lodges: Sentrim Amboseli, Voi Safari Lodge.

**3-Day Best of Masai Mara** — $978 — Wildlife Adventure
Days: 1) → Masai Mara, evening game drive (Lenchada Tourist Camp) 2) Full sunrise-to-sunset game drive, optional Maasai village visit ($20pp) 3) Morning game drive → Nairobi.

### TANZANIA

**3-Day Safari – Tarangire, Ngorongoro & Lake Manyara** — $906 — Wildlife Adventure
Days: 1) Arusha → Tarangire NP, Matete picnic site lunch 2) → Ngorongoro Crater (viewpoint stop, hippo pool picnic) 3) → Lake Manyara NP (Endalla picnic site, tree-climbing lions) → Arusha. Lodge: Fig Tree Lodge & Camp.

**4-Day Luxury Tanzania Safari** — $2,050 — Wildlife Adventure
Days: 1) Arusha → Tarangire NP full-day game drive (luxury tented camp) 2) → Ngorongoro Crater, Lake Magadi 3) → Serengeti NP 4) Morning game drive → Arusha. Lodges: Acacia Tarangire Luxury Camp, Ngorongoro Lion's Paw Camp.

**4-Day Tanzania Safari Tarangire, Serengeti & Manyara** — $2,016 — Wildlife Adventure
Days: 1) → Tarangire NP (elephant migration) 2) → Ngorongoro Crater half-day tour → Serengeti NP 3) Serengeti game drive → Karatu 4) → Lake Manyara NP → Arusha. Lodges: Embalakai Camp, Eileen's Trees Inn.

**7-Day Luxury Tanzania Safari** — $3,256 — Wildlife Adventure
Days: 1) Arrival Arusha (Gran Melia Arusha) 2) → Tarangire NP 3) → Lake Manyara NP 4) → Serengeti NP (via Ngorongoro Conservation Area) 5) Full day Serengeti game drives (Lahia Tented Camp) 6) → Ngorongoro Crater floor tour (Kitela Lodge) 7) Karatu → Airport, depart. Lodges: Gran Melia Arusha, Kitela Lodge.

### RWANDA

**Kigali– Rwanda City Tour** — $0.00 ⚠ — City Tours, Day tours
Single day: Kimironko city market, Mt. Kigali viewpoint, milk bar, public art walk, Rwandan lunch, coffee stop, Kigali Genocide Memorial Centre visit (starts 7:30am).

**3-Day Gorillas and Golden Monkey Safari** — $2,816 — Gorilla safaris
Days: 1) Kigali airport pickup, optional city tour + Genocide Memorial → Volcanoes NP 2) Golden monkey trekking → cross border to Bwindi, Uganda (via Cyanika) 3) Gorilla trekking → transfer back to Kigali. Lodges: Da Vinci Gorilla Lodge, Bweza Gorilla Lodge. *Note: itinerary text contains a raw leaked WordPress admin edit-post URL — flag for the dev team to strip from content before migration.*

**3-Day Rwanda Gorilla Safari** — $2,506 — Gorilla safaris
Days: 1) Arrive Kigali, hotel transfer, tour briefing 2) Kigali city tour (Genocide Memorial, Art Gallery, Kimironko market) → Volcanoes National Park (Musanze) 3) Gorilla trekking (2–4 hrs) → Kigali airport, depart. Lodges: Hotel Des Mille Collines, Tiloreza Volcanoes Ecolodge.

**7-Day Rwanda Akagera Safari and Golden Monkey Tour** — $3,016 — Gorilla safaris, Wildlife Adventure (2 reviews, 5/5; Activity Level: Moderate 3/8)
Days: 1) Arrival Kigali 2) → Akagera National Park, night game drive 3) Akagera game drives + Lake Ihema boat cruise → Kigali 4) Kigali city tour (Genocide Memorial, Kimironko, Nyamirambo) → Musanze/Volcanoes NP 5) Golden Monkey trek + Iby'iwacu Cultural Village 6) Bisoke Volcano hike (crater lake, 4hr up/2hr down) → Lake Kivu 7) Lake Kivu boat cruise → Kigali, depart. Lodges: Akagera Game Lodge, Paradise Malahide. *Note: Accommodation tab contains leftover Lorem Ipsum placeholder text on live site — flag for content team, same issue as the 4-Day Bwindi/Bunyonyi/QE tour.*

---

## 5.4 Cross-Cutting Product-Page Data Points (for every tour, confirmed via full scrape)

- **Reviews field:** Almost all tours show "0 Reviews / 0/5" — only 3 of the 34 tours have real reviews on the live site (4-Day Bwindi/Bunyonyi/QE: 1 review, 5/5; 4-Day Kidepo Wildlife Safari: 2 reviews, 5/5; 7-Day Rwanda Akagera: 2 reviews, 5/5).
- **Vacation Style / Holiday Type tag:** Almost universally "Family," sometimes with additional tags appended (Wildlife, Culture, Guided Tours, Trekking, Discovery, History, Short Breaks, Camping, Cycling).
- **Activity Level:** Most tours are labeled "Challenging (5/8)" regardless of actual difficulty (appears to be a default/unconfigured field on most products) — only 3 tours have a differentiated "Moderate (3/8)" rating (the same 3 tours that have real reviews, above). Recommend re-auditing actual difficulty per tour rather than migrating this field as-is.
- **"Book Now" CTA:** Every product page links to `https://www.henjoafricansafaris.com/trip-planner/` — see Section 5.5 below, this is very likely a dead link.
- **Standard accommodation tab boilerplate:** All 34 tours repeat the identical 3-paragraph Moderate/Luxury/Budget accommodation description (including the "Chobe safari lodge... hosted Kim and Kanye West" anecdote) regardless of destination — this is generic filler copy, not tour-specific, and should be replaced with real per-tour accommodation descriptions in the rebuild rather than migrated verbatim.
- **Standard Included/Excluded boilerplate:** Nearly identical across all tours (park fees, activities, accommodation, guide, transport, taxes, meals, water / excludes international flights, tips, personal items, tax increases). A small number of higher-end tours (12-Day Kenya Classic, 5-Day Masai Mara Flying/Fly-in, 8-Day Best of Kenya, 9-Day Kenya Beach) additionally include international flights and all in-tour flights.

## 5.5 ⚠ Critical Finding: Secondary Domain Has Expired

`henjoafricansafaris.com` — the domain used throughout the current site for the "Book Now" button on every single tour page, the footer's "Book Schedule A Meeting" link, and several internal navigation links (e.g. "Safaris" menu item) — **has expired and is currently listed for sale on a domain resale marketplace** (asking price $195, 24 referring domains, 3 years of history). This means:

- The primary booking call-to-action on every one of the 34 tour pages (`/trip-planner/`) is very likely broken right now on the live site.
- The footer's "Book Schedule A Meeting" link (`/booking-page/`) is on the same dead domain.
- Some destination-page internal links also route through this domain.

**Recommendation:** Do not attempt to migrate content from `/trip-planner/` or `/booking-page/` since they're unreachable — instead, treat this as a build requirement: the new Laravel/Next.js site needs a proper booking/inquiry flow built from scratch (form fields: name, email, phone, tour selection, preferred dates, party size, message — standard for this type of booking form), since the old one is no longer functioning. Confirm with the client whether they were aware this domain lapsed, and clarify whether `henjosafaris.com` or `henjoafricansafaris.com` should be the canonical domain going forward (see Section 6).

## 5.6 Blog — Full Content (confirmed complete; only 2 posts exist)

The Blog index (`/blog/`) contains exactly two posts — both are re-published versions of the same two Travel Information articles referenced in Section 3.6. Full text:

### Post 1: "East Africa Tourist Visa guide"
> This is a Joint Tourist Visa and it allows the traveler to travel to Uganda, Kenya, and Rwanda ONLY. It can be used multiple times for tourism purposes. The visa prohibits employment and is issued only for tourism purposes. The visa is valid for 90 days and is not renewable upon expiry or upon exit from the block (Kenya, Uganda, Rwanda).
>
> NB: The issuing country should be your first entry point.
>
> **Where to apply:** the visas are available online through: https://www.visas.immigration.go.ug/#/apply
>
> **Requirements / Attachments:**
> - Copy of the passport (Bio-data page) with at least 6 months validity
> - Copy of recent Passport size Photograph
> - Vaccination Certificate (Yellow fever)
> - Return Ticket
> - Travel Itinerary

### Post 2: "Entry Requirements For Uganda"
> **Uganda Tourist Visa – Single Entry.** This visa is granted to travelers coming to Uganda for tourism. This is a single-entry visa and can be granted for up to 3 months.
>
> **Where to apply:** the visas are available online through: https://www.visas.immigration.go.ug/#/apply
>
> **Requirements:**
> - Passport copy (bio-data page) with at least 6 months validity
> - Tour Plan
> - Travel itinerary/booking
> - Recent Passport-size Photograph
> - Vaccination Certificate (Yellow Fever)

Both posts are authored by "admin," have 0 comments, and cross-link to each other via Next/Previous post navigation. No other blog posts exist on the site as of this scrape (confirmed via the "Recent Posts" widget, which lists only these two).

---

## 11. Recommended Next Steps

1. Request a raw WooCommerce product CSV export and WordPress XML export from the current site owner/host — far more reliable than manual scraping for guaranteeing catalog completeness and capturing exact image assets.
2. Scrape (or export) every `/product/{slug}/` page individually using the template documented in Section 5.1, to fill in itinerary/inclusions/accommodation data for all 34 tours.
3. Capture the Blog and Trip Planner/Booking Page flows separately.
4. Download all image assets referenced (currently hosted under `/wp-content/uploads/...`) rather than hot-linking, and re-host on the new stack.
5. Confirm canonical domain, canonical support email, and correct UK phone number formatting with the client.
6. Validate/replace the $0.00 priced tours before go-live.
