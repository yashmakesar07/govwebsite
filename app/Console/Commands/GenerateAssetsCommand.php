<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\PdfGenerator;

class GenerateAssetsCommand extends Command
{
    protected $signature = 'app:generate-assets';
    protected $description = 'Generate realistic SVG images and sample PDF documents for the government portal prototype';

    public function handle()
    {
        $this->info('Generating SVG assets...');

        // 1. Hero Infrastructure (1600 x 600, ~16:6 aspect ratio)
        $heroSvg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1600 600" width="1600" height="600" preserveAspectRatio="xMidYMid slice">
  <defs>
    <linearGradient id="skyGrad" x1="0%" y1="0%" x2="0%" y2="100%">
      <stop offset="0%" stop-color="#031C36" />
      <stop offset="45%" stop-color="#062B52" />
      <stop offset="85%" stop-color="#0E487F" />
      <stop offset="100%" stop-color="#1E65A8" />
    </linearGradient>
    <linearGradient id="glassGrad" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#60A5FA" stop-opacity="0.35" />
      <stop offset="50%" stop-color="#93C5FD" stop-opacity="0.2" />
      <stop offset="100%" stop-color="#1D4ED8" stop-opacity="0.4" />
    </linearGradient>
    <linearGradient id="groundGrad" x1="0%" y1="0%" x2="0%" y2="100%">
      <stop offset="0%" stop-color="#0F243B" />
      <stop offset="100%" stop-color="#061625" />
    </linearGradient>
    <linearGradient id="bridgeGrad" x1="0%" y1="0%" x2="100%" y2="0%">
      <stop offset="0%" stop-color="#334155" />
      <stop offset="50%" stop-color="#64748B" />
      <stop offset="100%" stop-color="#1E293B" />
    </linearGradient>
  </defs>

  <!-- Sky -->
  <rect width="1600" height="600" fill="url(#skyGrad)" />

  <!-- Subtle Atmospheric Stars / Clean Night Aura -->
  <g fill="#FFFFFF" opacity="0.4">
    <circle cx="200" cy="80" r="1.5" />
    <circle cx="450" cy="50" r="1" />
    <circle cx="780" cy="110" r="1.2" />
    <circle cx="1100" cy="65" r="1.5" />
    <circle cx="1380" cy="95" r="1.2" />
    <circle cx="1520" cy="45" r="1" />
  </g>

  <!-- Distant City Skyline Silhouettes -->
  <path d="M 0 420 L 50 420 L 50 360 L 90 360 L 90 420 L 140 420 L 140 330 L 180 330 L 180 420 L 260 420 L 260 380 L 310 380 L 310 420 L 450 420 L 450 340 L 520 340 L 520 420 L 680 420 L 680 390 L 740 390 L 740 420 L 850 420 L 850 350 L 920 350 L 920 420 L 1100 420 L 1100 320 L 1180 320 L 1180 420 L 1320 420 L 1320 360 L 1400 360 L 1400 420 L 1600 420 L 1600 600 L 0 600 Z" fill="#0B2B4C" opacity="0.6" />

  <!-- Modern Metro / Flyover Viaduct Across Midground -->
  <g opacity="0.85">
    <!-- Elevated Viaduct Deck -->
    <path d="M 0 440 Q 800 425 1600 440 L 1600 455 Q 800 440 0 455 Z" fill="url(#bridgeGrad)" />
    <!-- Piers (Pillars) -->
    <rect x="220" y="445" width="28" height="115" rx="3" fill="#1E293B" />
    <rect x="520" y="443" width="28" height="117" rx="3" fill="#1E293B" />
    <rect x="820" y="440" width="30" height="120" rx="3" fill="#334155" />
    <rect x="1120" y="443" width="28" height="117" rx="3" fill="#1E293B" />
    <rect x="1420" y="445" width="28" height="115" rx="3" fill="#1E293B" />
    <!-- Cable Stayed Bridge Pylon in Center-Right -->
    <polygon points="980,240 1000,240 1015,442 965,442" fill="#E2E8F0" opacity="0.9" />
    <!-- Cables -->
    <line x1="990" y1="260" x2="840" y2="440" stroke="#CBD5E1" stroke-width="1.5" opacity="0.7" />
    <line x1="990" y1="280" x2="880" y2="440" stroke="#CBD5E1" stroke-width="1.5" opacity="0.7" />
    <line x1="990" y1="310" x2="930" y2="440" stroke="#CBD5E1" stroke-width="1.5" opacity="0.7" />
    <line x1="1000" y1="260" x2="1140" y2="440" stroke="#CBD5E1" stroke-width="1.5" opacity="0.7" />
    <line x1="1000" y1="280" x2="1100" y2="440" stroke="#CBD5E1" stroke-width="1.5" opacity="0.7" />
    <line x1="1000" y1="310" x2="1050" y2="440" stroke="#CBD5E1" stroke-width="1.5" opacity="0.7" />
  </g>

  <!-- Landmark Government Secretariat Building (Right Half) -->
  <g transform="translate(920, 160)">
    <!-- Central Dome / Rotunda -->
    <path d="M 320 150 C 320 80, 440 80, 440 150 Z" fill="#1E3A5F" stroke="#3B82F6" stroke-width="2" />
    <rect x="375" y="60" width="10" height="25" fill="#E2E8F0" />
    <circle cx="380" cy="55" r="5" fill="#D97706" />

    <!-- Main Edifice -->
    <rect x="180" y="150" width="400" height="230" rx="4" fill="#0A1D33" stroke="#1E40AF" stroke-width="2" />
    
    <!-- Grand Colonnade Columns -->
    <g fill="#E2E8F0" opacity="0.9">
      <rect x="210" y="170" width="12" height="190" rx="2" />
      <rect x="245" y="170" width="12" height="190" rx="2" />
      <rect x="280" y="170" width="12" height="190" rx="2" />
      <rect x="315" y="170" width="12" height="190" rx="2" />
      <rect x="435" y="170" width="12" height="190" rx="2" />
      <rect x="470" y="170" width="12" height="190" rx="2" />
      <rect x="505" y="170" width="12" height="190" rx="2" />
      <rect x="540" y="170" width="12" height="190" rx="2" />
    </g>

    <!-- Glass Facade Behind Columns -->
    <rect x="200" y="180" width="360" height="170" fill="url(#glassGrad)" />
    
    <!-- Glowing Institutional Windows -->
    <g fill="#93C5FD" opacity="0.8">
      <rect x="350" y="185" width="60" height="20" rx="2" />
      <rect x="350" y="215" width="60" height="20" rx="2" />
      <rect x="350" y="245" width="60" height="20" rx="2" />
      <rect x="350" y="275" width="60" height="20" rx="2" />
      <rect x="350" y="305" width="60" height="40" rx="2" fill="#F8FAFC" />
    </g>
  </g>

  <!-- Foreground Landscaped Boulevard & Lawns -->
  <rect x="0" y="520" width="1600" height="80" fill="url(#groundGrad)" />
  <rect x="0" y="520" width="1600" height="12" fill="#15803D" opacity="0.8" />
  
  <!-- Boulevard Lights -->
  <g fill="#FDE047">
    <circle cx="100" cy="510" r="3" />
    <circle cx="300" cy="510" r="3" />
    <circle cx="500" cy="510" r="3" />
    <circle cx="700" cy="510" r="3" />
    <circle cx="900" cy="510" r="3" />
    <circle cx="1100" cy="510" r="3" />
    <circle cx="1300" cy="510" r="3" />
    <circle cx="1500" cy="510" r="3" />
  </g>
</svg>
SVG;
        file_put_contents(public_path('assets/images/hero-infrastructure.svg'), $heroSvg);

        // 2. Schemes SVGs
        $schemeRural = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 400" width="600" height="400">
  <defs>
    <linearGradient id="rSky" x1="0" y1="0" x2="0" y2="1"><stop offset="0%" stop-color="#0284C7"/><stop offset="100%" stop-color="#BAE6FD"/></linearGradient>
  </defs>
  <rect width="600" height="400" fill="url(#rSky)"/>
  <circle cx="480" cy="90" r="45" fill="#FEF08A"/>
  <!-- Green Rolling Hills -->
  <path d="M0 240 Q150 170 320 220 T600 210 L600 400 L0 400 Z" fill="#166534"/>
  <path d="M0 280 Q200 230 400 270 T600 250 L600 400 L0 400 Z" fill="#15803D"/>
  <!-- Modern All-Weather Paved Road -->
  <polygon points="280,240 320,240 450,400 150,400" fill="#334155"/>
  <line x1="300" y1="240" x2="300" y2="400" stroke="#FDE047" stroke-width="4" stroke-dasharray="16,16"/>
  <!-- Solar Street Lights along road -->
  <line x1="230" y1="360" x2="230" y2="300" stroke="#CBD5E1" stroke-width="3"/>
  <rect x="220" y="295" width="20" height="6" fill="#0284C7"/>
  <circle cx="230" cy="305" r="4" fill="#FEF08A"/>
</svg>
SVG;
        file_put_contents(public_path('assets/images/scheme-rural.svg'), $schemeRural);

        $schemeGreen = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 400" width="600" height="400">
  <defs>
    <linearGradient id="gSky" x1="0" y1="0" x2="0" y2="1"><stop offset="0%" stop-color="#0F766E"/><stop offset="100%" stop-color="#CCFBF1"/></linearGradient>
  </defs>
  <rect width="600" height="400" fill="url(#gSky)"/>
  <!-- Green Infrastructure Building with Solar Roof -->
  <rect x="120" y="160" width="360" height="240" rx="6" fill="#042F2E"/>
  <!-- Solar Panels Array on Roof -->
  <polygon points="100,160 500,160 460,110 140,110" fill="#1E3A8A" stroke="#60A5FA" stroke-width="2"/>
  <line x1="140" y1="135" x2="460" y2="135" stroke="#93C5FD" stroke-width="1.5"/>
  <line x1="220" y1="110" x2="200" y2="160" stroke="#93C5FD" stroke-width="1.5"/>
  <line x1="300" y1="110" x2="300" y2="160" stroke="#93C5FD" stroke-width="1.5"/>
  <line x1="380" y1="110" x2="400" y2="160" stroke="#93C5FD" stroke-width="1.5"/>
  <!-- Energy Efficient Glass Windows -->
  <g fill="#2DD4BF" opacity="0.7">
    <rect x="160" y="190" width="60" height="40" rx="3"/>
    <rect x="270" y="190" width="60" height="40" rx="3"/>
    <rect x="380" y="190" width="60" height="40" rx="3"/>
    <rect x="160" y="250" width="60" height="40" rx="3"/>
    <rect x="270" y="250" width="60" height="40" rx="3"/>
    <rect x="380" y="250" width="60" height="40" rx="3"/>
  </g>
</svg>
SVG;
        file_put_contents(public_path('assets/images/scheme-green.svg'), $schemeGreen);

        $schemeDigital = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 400" width="600" height="400">
  <defs>
    <linearGradient id="dSky" x1="0" y1="0" x2="1" y2="1"><stop offset="0%" stop-color="#0F172A"/><stop offset="100%" stop-color="#1E3A8A"/></linearGradient>
  </defs>
  <rect width="600" height="400" fill="url(#dSky)"/>
  <!-- Digital Governance Circuit & Network Hub -->
  <g stroke="#38BDF8" stroke-width="1.5" opacity="0.5">
    <circle cx="300" cy="180" r="90" fill="none"/>
    <circle cx="300" cy="180" r="140" fill="none" stroke-dasharray="6,8"/>
    <line x1="300" y1="40" x2="300" y2="320"/>
    <line x1="160" y1="180" x2="440" y2="180"/>
  </g>
  <!-- Central Digital Infrastructure Core -->
  <circle cx="300" cy="180" r="40" fill="#0284C7"/>
  <rect x="285" y="165" width="30" height="30" rx="4" fill="#FFFFFF"/>
  <path d="M292 180 L298 186 L308 174" fill="none" stroke="#0284C7" stroke-width="3" stroke-linecap="round"/>
</svg>
SVG;
        file_put_contents(public_path('assets/images/scheme-digital.svg'), $schemeDigital);

        // 3. Media Gallery Placeholders (8 items)
        $mediaCategories = [
            'inspection' => ['Inspection & Quality Audit', '#062B52', 'Engineers inspecting state highway superstructure'],
            'meeting' => ['Departmental Review Meeting', '#031C36', 'State level project monitoring council session'],
            'bridge' => ['Major River Bridge Project', '#0E487F', 'Modern 6-lane elevated viaduct commissioning'],
            'rural-road' => ['Rural Connectivity Mission', '#15803D', 'All-weather road connecting rural market hub'],
            'solar-park' => ['50MW Public Solar Project', '#0D9488', 'Decarbonization initiative for government offices'],
            'hq' => ['Secretariat Infrastructure Wing', '#1E293B', 'Modern administrative office complex'],
            'tech-center' => ['State Command & Control', '#1E3A8A', 'Real-time telemetry and project tracking unit'],
            'citizen-portal' => ['Public Citizen Service Kiosk', '#4338CA', 'Grassroots digital public infrastructure service center'],
        ];

        foreach ($mediaCategories as $key => [$title, $bgColor, $caption]) {
            $mediaSvg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 420" width="600" height="420">
  <defs>
    <linearGradient id="bg_{$key}" x1="0" y1="0" x2="1" y2="1">
      <stop offset="0%" stop-color="{$bgColor}"/>
      <stop offset="100%" stop-color="#021123"/>
    </linearGradient>
  </defs>
  <rect width="600" height="420" fill="url(#bg_{$key})"/>
  <!-- Decorative Technical Grid Overlay -->
  <path d="M 0 100 L 600 100 M 0 200 L 600 200 M 0 300 L 600 300 M 150 0 L 150 420 M 300 0 L 300 420 M 450 0 L 450 420" stroke="#FFFFFF" stroke-width="0.5" opacity="0.1"/>
  <!-- Institutional Frame -->
  <rect x="25" y="25" width="550" height="370" rx="8" fill="none" stroke="#60A5FA" stroke-width="1.5" opacity="0.4"/>
  <!-- Center Badge / Watermark -->
  <circle cx="300" cy="180" r="50" fill="#0A66D6" opacity="0.2"/>
  <text x="300" y="175" font-family="sans-serif" font-size="28" font-weight="bold" fill="#F8FAFC" text-anchor="middle">OFFICIAL RECORD</text>
  <text x="300" y="205" font-family="sans-serif" font-size="15" fill="#93C5FD" text-anchor="middle">{$title}</text>
  <rect x="40" y="340" width="520" height="40" rx="4" fill="#000000" opacity="0.6"/>
  <text x="55" y="365" font-family="sans-serif" font-size="13" fill="#E2E8F0">{$caption}</text>
</svg>
SVG;
            file_put_contents(public_path("assets/images/media-{$key}.svg"), $mediaSvg);
        }

        // 4. Generate Valid PDF Documents in storage/app/public/documents/
        $this->info('Generating sample PDF documents...');
        $docs = [
            'Tender_Notice_TPI_2026_001.pdf' => [
                'Tender Notice No. TPI/2026/001',
                'TPI/2026/001-NOTICE',
                [
                    'Notice Inviting Tender for Road Improvement and Development Works on State Highway Corridor 4.',
                    'Sealed competitive tenders are invited in the prescribed format from eligible Class-A certified infrastructure contractors.',
                    'The scope of work encompasses widening to 4-lane configuration, rigid concrete pavement construction, installation of smart solar LED street lighting, and provision of stormwater drainage networks over 42.5 kilometers.',
                    'Bidders must submit technical and financial bids through the electronic procurement system prior to the closing deadline of 30th April 2026 at 17:00 IST.',
                ]
            ],
            'Technical_Specification_TPI_2026_001.pdf' => [
                'Technical Specification & Engineering Standards',
                'TPI/2026/001-TECH-SPEC',
                [
                    'This document specifies the technical criteria, quality metrics, and testing procedures for pavement grade concrete, bituminous macadam, and structural steel.',
                    'All aggregates must adhere to Indian Standards Specifications IS:383 and Ministry of Road Transport and Highways (MoRTH) Section 500 guidelines.',
                    'Third-party testing from accredited national laboratories is mandatory for every 500 cubic meters of poured concrete.',
                ]
            ],
            'BOQ_TPI_2026_001.pdf' => [
                'Bill of Quantities (BOQ) - Schedule of Rates',
                'TPI/2026/001-BOQ',
                [
                    'Itemized bill of quantities covering earthwork excavation, granular sub-base preparation, wet mix macadam, dense bituminous macadam, concrete paving, and road safety furniture.',
                    'Total estimated value of works: INR 48,50,00,000 (Forty-Eight Crore Fifty Lakhs Only).',
                    'Earnest Money Deposit (EMD) required: INR 97,00,000 via irrevocable bank guarantee.',
                ]
            ],
            'Public_Infrastructure_Act_2024.pdf' => [
                'Public Infrastructure Development & Regulation Act',
                'ACT-NO-14-OF-2024',
                [
                    'An Act to provide for the planning, execution, quality certification, and transparent public disclosure of infrastructure assets developed using public funds.',
                    'Be it enacted by the State Legislature in the Seventy-Fifth Year of the Republic as follows: Every infrastructure project exceeding INR 5 Crore shall maintain public disclosures including tender records, inspection reports, and quarterly expenditure statements.',
                    'Violations of quality benchmarks shall entail strict penal liability and automatic blacklisting across all state procurement channels.',
                ]
            ],
            'Infrastructure_Guidelines_2026.pdf' => [
                'State Sustainable Infrastructure Guidelines 2026',
                'GUIDELINES-SEC-2026-04',
                [
                    'Mandatory environmental, structural resilience, and universal accessibility guidelines for all new government civil works.',
                    'All public buildings must conform to Harmonised Guidelines for Universal Accessibility and achieve minimum 3-Star GRIHA rating for energy efficiency.',
                ]
            ],
            'Procurement_Rules_2025.pdf' => [
                'Public Procurement & E-Tendering Rules 2025',
                'PROC-RULES-2025-VOL-1',
                [
                    'Comprehensive administrative manual governing public tender issuance, bid evaluation matrix, reverse auction protocols, and dispute resolution mechanisms.',
                    'All procurement above INR 2 Lakh must be executed exclusively via the official electronic procurement portal with two-stage technical vetting.',
                ]
            ],
            'Meeting_Minutes_SEC_42.pdf' => [
                'Minutes of 42nd State Infrastructure Apex Review Meeting',
                'MIN-APEX-REV-2026-42',
                [
                    'Record of proceedings of the high-level infrastructure monitoring council held at the Central Secretariat conference hall on 15th March 2026.',
                    'The council reviewed 18 ongoing major arterial projects, approved fund releases for Phase 2 rural connectivity, and resolved to expedite environmental clearances within 21 working days.',
                ]
            ],
            'Quarterly_Financial_Report_Q3.pdf' => [
                'Quarterly Financial Disclosure & Fund Utilization Statement (Q3 2025-26)',
                'FIN-DISC-2025-26-Q3',
                [
                    'Comprehensive audited report on budgetary fund receipts, capital expenditure, and scheme disbursements for the quarter ending 31st December 2025.',
                    'Total Receipts: INR 165.20 Cr | Total Expenditure: INR 148.80 Cr | Project Allocations: INR 180.00 Cr.',
                ]
            ],
            'RTI_Proactive_Disclosure_Manual.pdf' => [
                'Right to Information (RTI) Section 4(1)(b) Proactive Disclosure Manual',
                'RTI-MANUAL-SEC-4-2026',
                [
                    'Statutory manual detailing organizational structure, powers and duties of officers, decision-making procedures, directory of officers, monthly remuneration, and public grievance mechanisms.',
                    'Designated Central Public Information Officer (CPIO): Deputy Secretary (Public Works). First Appellate Authority: Special Secretary (Infrastructure).',
                ]
            ],
            'Citizen_Charter_2026.pdf' => [
                'Citizen Charter & Service Delivery Commitments 2026',
                'CITIZEN-CHARTER-2026',
                [
                    'Our commitment to delivering transparent, accountable, and time-bound public infrastructure services to citizens.',
                    'Service standards include: Tender queries response within 3 working days; Public grievance redressal within 14 days; RTI applications disposal within 30 days.',
                ]
            ]
        ];

        foreach ($docs as $filename => [$title, $ref, $paragraphs]) {
            $pdfContent = PdfGenerator::create($title, $ref, $paragraphs);
            file_put_contents(storage_path("app/public/documents/{$filename}"), $pdfContent);
        }

        $this->info('All assets and PDF documents generated successfully!');
        return 0;
    }
}
