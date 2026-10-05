# Government Portal — Build Plan

## Phase 1: Scaffold & Dependencies
- [x] Install PHP 8.3 & Composer
- [x] Create Laravel project
- [x] Install: Livewire, Filament, Tailwind CSS 4, Spatie Permission
- [x] Configure SQLite
- [x] Configure fonts (Inter, Noto Sans Devanagari)

## Phase 2: Database Schema & Models
- [x] Migrations: users, pages, notices, acts, tenders, schemes, meetings, financial_disclosures, documents, media
- [x] Models with bilingual fields (title_en/title_hi, etc.)
- [x] Publishing workflow (draft → pending_review → published / rejected → archived)
- [x] Roles: super_admin, editor, publisher

## Phase 3: Layout & Components
- [x] Tailwind config (color palette, fonts, breakpoints)
- [x] Main layout (app.blade.php)
- [x] Utility bar component
- [x] Header with emblem + search
- [x] Navigation (desktop horizontal, mobile drawer)
- [x] Footer (4-column dark navy)
- [x] Reusable components (StatusBadge, SectionHeader, Breadcrumbs, etc.)

## Phase 4: Localization
- [x] Locale middleware + routing (/en/..., /hi/...)
- [x] lang/en/ and lang/hi/ translation files
- [x] Language switcher component

## Phase 5: Public Pages
- [x] Homepage (hero, quick access, notices, tenders, about, stats, schemes, updates, gallery, links, contact CTA)
- [x] Tenders listing with search/filter
- [x] Tender detail
- [x] Acts & Rules listing
- [x] Schemes listing + detail
- [x] Meetings listing + detail
- [x] Financial Disclosure
- [x] RTI
- [x] Contact
- [x] Media Gallery
- [x] Search results

## Phase 6: Admin Panel (Filament)
- [x] Filament panel config
- [x] Resources: Notice, Act, Tender, Scheme, Meeting, FinancialDisclosure, Document, Media, User, Page
- [x] Dashboard widgets (StatsOverview & LatestNoticesWidget)
- [x] Publishing workflow in admin
- [x] Role-based access

## Phase 7: Seed Data
- [x] 6 notices, 6 tenders, 5 schemes, 5 acts, 5 meetings, 5 financial records
- [x] 8+ gallery images (SVG assets)
- [x] 10+ documents (sample PDFs with cryptographic reference headers)
- [x] 3 users (super_admin, editor, publisher)

## Phase 8: Polish & Verification
- [x] Responsive testing
- [x] SEO meta tags
- [x] Accessibility audit (A-, A, A+ font resizer, skip links, semantic landmarks)
- [x] Neutral placeholder emblem / logo
- [x] Automated test suite: 23 tests, 73 assertions (100% green)
- [x] End-to-end demo flow verified
