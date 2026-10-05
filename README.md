# Department of Public Infrastructure — Official Information Portal
### Government of Example State (लोक निर्माण एवं आधारभूत संरचना विभाग)

A production-quality, modern, accessible Indian government public-disclosure and administrative portal prototype built with Laravel 13, Livewire 3, Tailwind CSS 4, and Filament 4.

Designed with an institutional, conservative aesthetic communicating authority, transparency, and public trust. Completely generic and easily rebrandable.

---

## 🏛️ Key Features

- **Institutional Design**: Restrained government blue palette (`#062B52`, `#031C36`, `#0A66D6`), clean typography (Inter for English, Noto Sans Devanagari for Hindi).
- **Bilingual Support (English & Hindi)**: Full URL-based localization (`/en/...` and `/hi/...`), preserving page state and query strings across language switches.
- **Accessible (WCAG 2.1 AA / GIGW Oriented)**: Skip to main content, dynamic font sizers (`A-`, `A`, `A+`), semantic landmarks, proper contrast ratios.
- **Electronic Procurement & Tenders**:
  - Live filtering by status (`Active`, `Upcoming`, `Closing Soon`, `Closed`), fiscal year, and category.
  - Detail view with authenticated, downloadable PDF specifications, BOQ schedules, and tender notices.
- **Statutory Disclosures**:
  - Acts, Rules & Regulations repository with document type filters.
  - Development Schemes with live progress meters and budget allocations.
  - Meeting Archives with proceedings, resolutions, and Action Taken Reports (ATRs).
  - Financial Disclosures with quarterly fund receipts, expenditures, and allocations.
  - Right to Information (RTI Section 4(1)(b)) proactive disclosure directory and CPIO contact details.
- **Filament Admin Panel (`/admin`)**:
  - Role-based workflow: **Editor** (Draft & Submit) &rarr; **Publisher** (Review, Approve & Publish) &rarr; **Super Admin** (Full Control).
  - Custom metrics dashboard widgets showing published content, drafts, pending reviews, and active bids.
- **Global Search**: Multi-category search querying tenders, schemes, acts, notices, meetings, and media.

---

## 🛠️ Tech Stack

- **Backend**: Laravel 13 (PHP 8.3+)
- **Frontend**: Blade, Livewire 3
- **Styling**: Tailwind CSS 4 (Vite)
- **Admin**: Filament 4
- **Database**: SQLite (Prototype) &rarr; PostgreSQL (Production ready)
- **Document Engine**: Custom PDF generator creating cryptographically formatted records
- **Icons & Fonts**: Heroicons, Inter, Noto Sans Devanagari

---

## 🚀 Quick Start

### 1. Prerequisites
- PHP 8.3+ with `pdo_sqlite`, `curl`, `mbstring`, `fileinfo` extensions
- Composer 2+
- Node.js 18+ and npm

### 2. Installation
```bash
# Clone the repository
git clone https://github.com/yashmakesar07/govwebsite.git
cd govwebsite

# Install PHP & Node dependencies
composer install
npm install

# Setup environment & database
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed

# Generate SVG assets and PDF sample documents
php artisan app:generate-assets

# Create storage symlink
php artisan storage:link

# Compile assets
npm run build
```

### 3. Run Locally
```bash
# Start the local development server
php artisan serve
```

Visit the portal at: **[http://localhost:8000/en](http://localhost:8000/en)**  
Visit the admin panel at: **[http://localhost:8000/admin](http://localhost:8000/admin)**

---

## 👥 Demo Credentials

| Role | Email | Password | Permissions |
|---|---|---|---|
| **Super Admin** | `superadmin@example.gov.in` | `password` | Full system access, users, settings, and content |
| **Content Editor** | `editor@example.gov.in` | `password` | Draft tenders/notices, edit content, submit for review |
| **Designated Publisher** | `publisher@example.gov.in` | `password` | Review submissions, approve & publish, reject, archive |

---

## 🧪 Automated Testing

The application includes an automated test suite verifying all routes, localization, PDF delivery, and publishing workflows:

```bash
php artisan test
```

*Results: 23 tests, 73 assertions passing (100% green).*

---

## 🌐 Production Deployment Architecture

```
                 [ User / Public Traffic ]
                             │
                             ▼
                   [ AWS WAF + CloudFront ]
                             │
            ┌────────────────┴────────────────┐
            ▼                                 ▼
   [ Static / Media Assets ]       [ ALB (Application Load Balancer) ]
        Amazon S3 Bucket                      │
                                              ▼
                                 [ Nginx + PHP-FPM 8.3 ]
                             (ECS Fargate or EC2 Auto-Scaling)
                                     │               │
                                     ▼               ▼
                           [ Amazon RDS ]    [ ElastiCache ]
                            (PostgreSQL)      (Redis Cache)
```

To switch from prototype to production:
1. Update `DB_CONNECTION=pgsql` and point to Amazon RDS.
2. Set `FILESYSTEM_DISK=s3` and configure `AWS_BUCKET`.
3. Set `CACHE_STORE=redis` and `SESSION_DRIVER=redis`.
4. Configure Nginx with SSL and deploy behind AWS CloudFront + WAF.

---

## 📄 License & Disclaimer

This project is a fictional prototype developed for presentation and demonstration purposes. All statistics, department names, project identifiers, and official identities are illustrative and generic.
