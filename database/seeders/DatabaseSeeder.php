<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Notice;
use App\Models\Act;
use App\Models\Tender;
use App\Models\Scheme;
use App\Models\Meeting;
use App\Models\FinancialDisclosure;
use App\Models\Document;
use App\Models\Media;
use App\Models\Page;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Users
        $superAdmin = User::updateOrCreate(
            ['email' => 'superadmin@example.gov.in'],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make('password'),
                'role' => 'super_admin',
            ]
        );

        $editor = User::updateOrCreate(
            ['email' => 'editor@example.gov.in'],
            [
                'name' => 'Rajesh Sharma (Content Editor)',
                'password' => Hash::make('password'),
                'role' => 'editor',
            ]
        );

        $publisher = User::updateOrCreate(
            ['email' => 'publisher@example.gov.in'],
            [
                'name' => 'Anil Verma (Designated Publisher)',
                'password' => Hash::make('password'),
                'role' => 'publisher',
            ]
        );

        // 2. Notices (6 items)
        $notices = [
            [
                'title_en' => 'Public Hearing on Draft Infrastructure Policy 2026',
                'title_hi' => 'प्रारूप अवसंरचना नीति 2026 पर सार्वजनिक जनसुनवाई',
                'content_en' => 'Notice is hereby given that a public consultation hearing on the proposed State Infrastructure Masterplan 2026-2035 will be held on 25th October 2026 at the Conference Hall, Directorate Complex. Citizens and stakeholders are invited to submit feedback.',
                'content_hi' => 'एतद्द्वारा सूचित किया जाता है कि प्रस्तावित राज्य अवसंरचना महायोजना 2026-2035 पर एक सार्वजनिक परामर्श सुनवाई 25 अक्टूबर 2026 को निदेशालय परिसर के सम्मेलन कक्ष में आयोजित की जाएगी। नागरिक अपने सुझाव प्रस्तुत कर सकते हैं।',
                'category' => 'public_notice',
                'slug' => 'public-hearing-draft-infrastructure-policy-2026',
                'is_new' => true,
                'status' => 'published',
                'published_at' => now()->subDays(2),
                'file_path' => 'documents/Infrastructure_Guidelines_2026.pdf',
            ],
            [
                'title_en' => 'Office Order – Revised Working Hours and Grievance Disposal Timeline',
                'title_hi' => 'कार्यालय आदेश – संशोधित कार्य समय एवं जनशिकायत निवारण समय-सीमा',
                'content_en' => 'In accordance with public service guarantee standards, all regional offices shall operate citizen grievance windows from 10:00 AM to 1:00 PM daily. Disposal timeline for technical certifications reduced to 7 working days.',
                'content_hi' => 'लोक सेवा गारंटी मानकों के अनुसार, सभी क्षेत्रीय कार्यालय प्रतिदिन सुबह 10:00 बजे से दोपहर 1:00 बजे तक नागरिक शिकायत खिड़की संचालित करेंगे। तकनीकी प्रमाणन हेतु समय-सीमा घटाकर 7 कार्य दिवस कर दी गई है।',
                'category' => 'office_order',
                'slug' => 'office-order-revised-working-hours',
                'is_new' => true,
                'status' => 'published',
                'published_at' => now()->subDays(4),
                'file_path' => 'documents/Citizen_Charter_2026.pdf',
            ],
            [
                'title_en' => 'Notification Regarding Rural Connectivity Development Scheme Phase-III',
                'title_hi' => 'ग्रामीण संपर्क विकास योजना चरण-III के संबंध में अधिसूचना',
                'content_en' => 'Sanction is accorded for upgrade of 180 rural all-weather roads covering 720 kilometers across 12 underserved districts under State Rural Infrastructure Fund.',
                'content_hi' => 'राज्य ग्रामीण अवसंरचना कोष के अंतर्गत 12 जिलों में 720 किलोमीटर की 180 बारहमासी ग्रामीण सड़कों के उन्नयन हेतु स्वीकृति प्रदान की जाती है।',
                'category' => 'notification',
                'slug' => 'notification-rural-connectivity-scheme-phase-3',
                'is_new' => true,
                'status' => 'published',
                'published_at' => now()->subDays(7),
                'file_path' => 'documents/Infrastructure_Guidelines_2026.pdf',
            ],
            [
                'title_en' => 'Administrative Circular No. 12/2026 – Mandatory E-Procurement Protocols',
                'title_hi' => 'प्रशासनिक परिपत्र संख्या 12/2026 – अनिवार्य ई-खरीद प्रोटोकॉल',
                'content_en' => 'All divisions are instructed to strictly process tenders valued above INR 2 Lakhs through the central electronic bidding system. Offline acceptance is strictly prohibited.',
                'content_hi' => 'सभी प्रभागों को 2 लाख रुपये से अधिक की सभी निविदाएं केवल केंद्रीय इलेक्ट्रॉनिक पोर्टल के माध्यम से संसाधित करने के निर्देश दिए जाते हैं।',
                'category' => 'circular',
                'slug' => 'administrative-circular-12-2026-eprocurement',
                'is_new' => false,
                'status' => 'published',
                'published_at' => now()->subDays(12),
                'file_path' => 'documents/Procurement_Rules_2025.pdf',
            ],
            [
                'title_en' => 'Notice for Public Consultation on Eco-Friendly Pavement Specifications',
                'title_hi' => 'पर्यावरण-अनुकूल फुटपाथ विनिर्देशों पर जन परामर्श सूचना',
                'content_en' => 'Draft specifications integrating reclaimed asphalt and industrial fly-ash into state highway sub-bases are published for open industry comments over the next 30 days.',
                'content_hi' => 'राज्य राजमार्ग उप-आधारों में पुनर्नवीनीकरण डामर और फ्लाई-ऐश के उपयोग संबंधी प्रारूप विनिर्देश अगले 30 दिनों के लिए सार्वजनिक टिप्पणियों हेतु आमंत्रित हैं।',
                'category' => 'public_notice',
                'slug' => 'notice-public-consultation-eco-friendly-pavement',
                'is_new' => false,
                'status' => 'published',
                'published_at' => now()->subDays(18),
                'file_path' => 'documents/Technical_Specification_TPI_2026_001.pdf',
            ],
            [
                'title_en' => 'Vigilance Awareness & Transparent Governance Circular 2026',
                'title_hi' => 'सतर्कता जागरूकता एवं पारदर्शी शासन परिपत्र 2026',
                'content_en' => 'Guidelines regarding proactive asset disclosure, computerized project monitoring, and direct citizen feedback collection mechanisms across all active sites.',
                'content_hi' => 'सक्रिय संपत्ति प्रकटीकरण, कम्प्यूटरीकृत परियोजना निगरानी और प्रत्यक्ष नागरिक प्रतिक्रिया संग्रह हेतु आवश्यक दिशानिर्देश।',
                'category' => 'circular',
                'slug' => 'vigilance-awareness-circular-2026',
                'is_new' => false,
                'status' => 'published',
                'published_at' => now()->subDays(25),
                'file_path' => 'documents/RTI_Proactive_Disclosure_Manual.pdf',
            ],
        ];

        foreach ($notices as $n) {
            Notice::updateOrCreate(
                ['slug' => $n['slug']],
                array_merge($n, ['created_by' => $editor->id])
            );
        }

        // 3. Tenders (6 items)
        $tenders = [
            [
                'tender_number' => 'TPI/2026/001',
                'title_en' => 'Road Improvement and Development Works on State Highway Corridor 4',
                'title_hi' => 'राज्य राजमार्ग कॉरिडोर 4 पर सड़क सुधार एवं विकास कार्य',
                'description_en' => 'Widening to four-lane configuration, rigid concrete pavement construction, installation of smart solar LED street lighting, and stormwater drainage network over 42.5 kilometers.',
                'description_hi' => '42.5 किलोमीटर में फोर-लेन चौड़ीकरण, कंक्रीट पेवमेंट निर्माण, स्मार्ट सोलर एलईडी स्ट्रीट लाइटिंग और वर्षा जल निकासी नेटवर्क की स्थापना।',
                'department' => 'Department of Public Infrastructure',
                'category' => 'works',
                'slug' => 'tpi-2026-001-road-improvement-works',
                'published_date' => now()->subDays(5)->toDateString(),
                'closing_date' => now()->addDays(25)->toDateString(),
                'tender_status' => 'active',
                'status' => 'published',
                'estimated_value' => 485000000.00,
                'contact_name' => 'Chief Engineer (Highways)',
                'contact_email' => 'ce.highways@example.gov.in',
                'contact_phone' => '+91-11-2309-8801',
                'published_at' => now()->subDays(5),
            ],
            [
                'tender_number' => 'TPI/2026/002',
                'title_en' => 'Government Secretariat Complex Renovation & Energy Efficiency Retrofitting',
                'title_hi' => 'सरकारी सचिवालय परिसर नवीनीकरण एवं ऊर्जा दक्षता रेट्रोफिटिंग',
                'description_en' => 'Comprehensive architectural restoration, structural seismic retrofitting, installation of central VRV HVAC system, and 250 kWp rooftop solar photovoltaic generation facility.',
                'description_hi' => 'व्यापक वास्तुशिल्प पुनरुद्धार, भूकंपरोधी सुदृढ़ीकरण, केंद्रीय वीआरवी एयर कंडीशनिंग प्रणाली और 250 किलोवाट रूफटॉप सौर ऊर्जा संयंत्र की स्थापना।',
                'department' => 'Department of Public Infrastructure',
                'category' => 'works',
                'slug' => 'tpi-2026-002-secretariat-renovation',
                'published_date' => now()->subDays(8)->toDateString(),
                'closing_date' => now()->addDays(18)->toDateString(),
                'tender_status' => 'active',
                'status' => 'published',
                'estimated_value' => 182000000.00,
                'contact_name' => 'Superintending Engineer (Buildings)',
                'contact_email' => 'se.buildings@example.gov.in',
                'contact_phone' => '+91-11-2309-8802',
                'published_at' => now()->subDays(8),
            ],
            [
                'tender_number' => 'TPI/2026/003',
                'title_en' => 'Digital Public Infrastructure & Real-Time Project Telemetry System',
                'title_hi' => 'डिजिटल सार्वजनिक अवसंरचना एवं रीयल-टाइम परियोजना टेलीमेट्री प्रणाली',
                'description_en' => 'Procurement, deployment, and 5-year maintenance of IoT-based sensor stations, drone surveillance quality audit software, and unified public progress tracking GIS portal.',
                'description_hi' => 'आईओटी आधारित सेंसर स्टेशन, ड्रोन गुणवत्ता ऑडिट सॉफ्टवेयर और एकीकृत जीआईएस पोर्टल की खरीद, स्थापना एवं 5 वर्षीय रखरखाव।',
                'department' => 'Department of Public Infrastructure',
                'category' => 'services',
                'slug' => 'tpi-2026-003-digital-infrastructure-telemetry',
                'published_date' => now()->subDays(12)->toDateString(),
                'closing_date' => now()->addDays(28)->toDateString(),
                'tender_status' => 'active',
                'status' => 'published',
                'estimated_value' => 95000000.00,
                'contact_name' => 'Director (Information Technology)',
                'contact_email' => 'dir.it@example.gov.in',
                'contact_phone' => '+91-11-2309-8805',
                'published_at' => now()->subDays(12),
            ],
            [
                'tender_number' => 'TPI/2026/004',
                'title_en' => 'Solar Street Lighting Corridor Phase-II in Rural Market Zones',
                'title_hi' => 'ग्रामीण बाजार क्षेत्रों में सौर स्ट्रीट लाइटिंग कॉरिडोर चरण-II',
                'description_en' => 'Supply and installation of 1,200 standalone integrated solar street light fixtures with lithium iron phosphate batteries and remote wireless mesh monitoring.',
                'description_hi' => '1,200 स्टैंडअलोन एकीकृत सौर स्ट्रीट लाइटों की आपूर्ति, स्थापना एवं रिमोट मॉनिटरिंग प्रणाली।',
                'department' => 'Department of Public Infrastructure',
                'category' => 'goods',
                'slug' => 'tpi-2026-004-solar-lighting-phase-2',
                'published_date' => now()->subDays(20)->toDateString(),
                'closing_date' => now()->addDays(3)->toDateString(),
                'tender_status' => 'closing_soon',
                'status' => 'published',
                'estimated_value' => 34000000.00,
                'contact_name' => 'Executive Engineer (Electrical)',
                'contact_email' => 'ee.electrical@example.gov.in',
                'contact_phone' => '+91-11-2309-8806',
                'published_at' => now()->subDays(20),
            ],
            [
                'tender_number' => 'TPI/2026/005',
                'title_en' => 'Riverfront Retaining Wall and Flood Mitigation Works',
                'title_hi' => 'नदी तट सुरक्षा दीवार एवं बाढ़ शमन सिविल निर्माण कार्य',
                'description_en' => 'Construction of reinforced soil retaining walls, gabion revetments, and automated drainage sluice gates across 8 critical perennial river flood choke-points.',
                'description_hi' => '8 संवेदनशील नदी बाढ़ बिंदुओं पर आरसीसी रिटेनिंग वॉल, गैबियन तटबंध और स्वचालित जल निकासी स्लुइस गेट का निर्माण।',
                'department' => 'Department of Public Infrastructure',
                'category' => 'works',
                'slug' => 'tpi-2026-005-riverfront-flood-mitigation',
                'published_date' => now()->addDays(5)->toDateString(),
                'closing_date' => now()->addDays(45)->toDateString(),
                'tender_status' => 'upcoming',
                'status' => 'published',
                'estimated_value' => 240000000.00,
                'contact_name' => 'Superintending Engineer (Hydraulics)',
                'contact_email' => 'se.hydraulics@example.gov.in',
                'contact_phone' => '+91-11-2309-8808',
                'published_at' => now()->addDays(5),
            ],
            [
                'tender_number' => 'TPI/2025/088',
                'title_en' => 'District Composite Administrative Centre Construction',
                'title_hi' => 'जिला समग्र प्रशासनिक केंद्र का निर्माण कार्य',
                'description_en' => 'Turnkey civil and structural construction of G+6 administrative complex including auditorium, underground parking, and solar integration.',
                'description_hi' => 'सभागार, भूमिगत पार्किंग और सौर एकीकरण सहित G+6 प्रशासनिक भवन परिसर का निर्माण।',
                'department' => 'Department of Public Infrastructure',
                'category' => 'works',
                'slug' => 'tpi-2025-088-composite-administrative-centre',
                'published_date' => now()->subDays(60)->toDateString(),
                'closing_date' => now()->subDays(15)->toDateString(),
                'tender_status' => 'closed',
                'status' => 'published',
                'estimated_value' => 310000000.00,
                'contact_name' => 'Executive Engineer (Div-1)',
                'contact_email' => 'ee.div1@example.gov.in',
                'contact_phone' => '+91-11-2309-8810',
                'published_at' => now()->subDays(60),
            ],
        ];

        foreach ($tenders as $t) {
            $tenderModel = Tender::updateOrCreate(
                ['tender_number' => $t['tender_number']],
                array_merge($t, ['created_by' => $editor->id])
            );

            // Attach standard documents
            Document::updateOrCreate(
                [
                    'documentable_type' => Tender::class,
                    'documentable_id' => $tenderModel->id,
                    'type' => 'tender_notice'
                ],
                [
                    'title_en' => "Tender Notice - {$t['tender_number']}.pdf",
                    'title_hi' => "निविदा सूचना - {$t['tender_number']}.pdf",
                    'language' => 'bilingual',
                    'file_path' => 'documents/Tender_Notice_TPI_2026_001.pdf',
                    'file_size' => 1953,
                    'mime_type' => 'application/pdf',
                    'status' => 'published',
                    'published_at' => now(),
                    'uploaded_by' => $publisher->id,
                ]
            );

            Document::updateOrCreate(
                [
                    'documentable_type' => Tender::class,
                    'documentable_id' => $tenderModel->id,
                    'type' => 'specification'
                ],
                [
                    'title_en' => "Technical Specification - {$t['tender_number']}.pdf",
                    'title_hi' => "तकनीकी विनिर्देश - {$t['tender_number']}.pdf",
                    'language' => 'english',
                    'file_path' => 'documents/Technical_Specification_TPI_2026_001.pdf',
                    'file_size' => 1749,
                    'mime_type' => 'application/pdf',
                    'status' => 'published',
                    'published_at' => now(),
                    'uploaded_by' => $publisher->id,
                ]
            );

            Document::updateOrCreate(
                [
                    'documentable_type' => Tender::class,
                    'documentable_id' => $tenderModel->id,
                    'type' => 'boq'
                ],
                [
                    'title_en' => "Bill of Quantities (BOQ) - {$t['tender_number']}.pdf",
                    'title_hi' => "मात्रा का बिल (BOQ) - {$t['tender_number']}.pdf",
                    'language' => 'english',
                    'file_path' => 'documents/BOQ_TPI_2026_001.pdf',
                    'file_size' => 1670,
                    'mime_type' => 'application/pdf',
                    'status' => 'published',
                    'published_at' => now(),
                    'uploaded_by' => $publisher->id,
                ]
            );
        }

        // 4. Schemes (5 items)
        $schemes = [
            [
                'title_en' => 'Rural Infrastructure Development Scheme',
                'title_hi' => 'ग्रामीण आधारभूत संरचना विकास योजना',
                'description_en' => 'Flagship scheme aimed at providing all-weather road connectivity, robust culverts, and decentralized micro-warehousing facilities across rural clusters.',
                'description_hi' => 'ग्रामीण बस्तियों में बारहमासी पक्की सड़क, मजबूत पुलिया और विकेंद्रीकृत भंडारण सुविधाओं का निर्माण सुनिश्चित करने वाली प्रमुख योजना।',
                'objectives_en' => '1. Connect 100% habitations with population > 250 with paved roads. 2. Establish 85 agricultural produce transit points. 3. Zero road accidents through engineered sight distances and signages.',
                'objectives_hi' => '1. 250 से अधिक आबादी वाली बस्तियों को पक्की सड़कों से जोड़ना। 2. 85 कृषि उपज पारगमन केंद्रों की स्थापना। 3. दुर्घटना मुक्त सड़कें सुनिश्चित करना।',
                'eligibility_en' => 'Gram Panchayats possessing recognized revenue village status with no prior all-weather road access under national programs.',
                'eligibility_hi' => 'राजस्व ग्राम का दर्जा प्राप्त वे ग्राम पंचायतें जिनके पास बारहमासी पक्की सड़क का अभाव है।',
                'slug' => 'rural-infrastructure-development-scheme',
                'progress_percentage' => 68,
                'financial_allocation' => 2800000000.00,
                'beneficiaries_count' => 450000,
                'scheme_status' => 'active',
                'status' => 'published',
                'image_path' => 'assets/images/scheme-rural.svg',
                'published_at' => now()->subMonths(6),
            ],
            [
                'title_en' => 'Green Public Infrastructure Initiative',
                'title_hi' => 'हरित सार्वजनिक अवसंरचना पहल',
                'description_en' => 'Transitioning all state government administrative offices and civic complexes into net-zero energy buildings through rooftop solar panels, rainwater harvesting, and native bio-swales.',
                'description_hi' => 'सभी सरकारी प्रशासनिक भवनों को रूफटॉप सौर ऊर्जा, वर्षा जल संचयन और पर्यावरण अनुकूल वास्तुकला द्वारा नेट-जीरो ऊर्जा परिसरों में बदलना।',
                'objectives_en' => '1. 50 MW rooftop solar deployment across 400 civic buildings. 2. 40% reduction in municipal water consumption via rainwater recycling. 3. Mandatory GRIHA 3-Star certification.',
                'objectives_hi' => '1. 400 सरकारी भवनों पर 50 मेगावाट रूफटॉप सोलर स्थापना। 2. जल खपत में 40% की कमी। 3. अनिवार्य 3-स्टार ग्रीन रेटिंग।',
                'eligibility_en' => 'All state departmental directorates, district collectorates, and subordinate court complexes.',
                'eligibility_hi' => 'सभी राज्य विभागीय निदेशालय, जिला कलेक्ट्रेट और अधीनस्थ न्यायालय परिसर।',
                'slug' => 'green-public-infrastructure-initiative',
                'progress_percentage' => 45,
                'financial_allocation' => 1500000000.00,
                'beneficiaries_count' => 180000,
                'scheme_status' => 'active',
                'status' => 'published',
                'image_path' => 'assets/images/scheme-green.svg',
                'published_at' => now()->subMonths(4),
            ],
            [
                'title_en' => 'Digital Governance Access Programme',
                'title_hi' => 'डिजिटल सुशासन पहुंच कार्यक्रम',
                'description_en' => 'Deploying secure optical fiber backbone, public Wi-Fi zones, and self-service digital citizen kiosks at block and panchayat headquarters for seamless access to public services.',
                'description_hi' => 'प्रखंड और पंचायत स्तर पर ऑप्टिकल फाइबर कनेक्टिविटी, सार्वजनिक वाई-फाई और नागरिक सेवा कियोस्क स्थापित करने का राष्ट्रव्यापी कार्यक्रम।',
                'objectives_en' => '1. High-speed 1 Gbps broadband to 2,400 village secretariats. 2. Integrated citizen service kiosks operational 24/7. 3. Zero-paper digital approvals for departmental sanctions.',
                'objectives_hi' => '1. 2,400 ग्राम सचिवालयों को 1 Gbps ब्रॉडबैंड। 2. 24/7 नागरिक सेवा कियोस्क। 3. विभागीय स्वीकृतियों हेतु पेपरलेस डिजिटल व्यवस्था।',
                'eligibility_en' => 'Registered village panchayats and municipal ward councils in backward blocks.',
                'eligibility_hi' => 'अधिसूचित पिछड़े प्रखंडों के पंजीकृत ग्राम पंचायत एवं नगर परिषद।',
                'slug' => 'digital-governance-access-programme',
                'progress_percentage' => 82,
                'financial_allocation' => 500000000.00,
                'beneficiaries_count' => 850000,
                'scheme_status' => 'active',
                'status' => 'published',
                'image_path' => 'assets/images/scheme-digital.svg',
                'published_at' => now()->subMonths(9),
            ],
            [
                'title_en' => 'Urban Civic Transit Connectivity Project',
                'title_hi' => 'शहरी नागरिक पारगमन संपर्क परियोजना',
                'description_en' => 'Modernization of urban arterial bus rapid corridors, intelligent traffic signaling, and universally accessible pedestrian skywalks connecting transit terminals.',
                'description_hi' => 'शहरी बस कॉरिडोर का आधुनिकीकरण, इंटेलिजेंट ट्रैफिक सिग्नलिंग और पारगमन टर्मिनलों को जोड़ने वाले सुगम्य पैदल पुलों का निर्माण।',
                'objectives_en' => '1. 14 modern multimodal interchange transit hubs. 2. Integrated automated traffic management center. 3. Full barrier-free tactile paving across urban footpaths.',
                'objectives_hi' => '1. 14 आधुनिक मल्टीमॉडल पारगमन केंद्र। 2. एकीकृत स्वचालित यातायात नियंत्रण कक्ष। 3. दिव्यांगजनों हेतु सुगम फुटपाथ निर्माण।',
                'eligibility_en' => 'Municipal corporations with population exceeding 300,000.',
                'eligibility_hi' => '3 लाख से अधिक जनसंख्या वाले नगर निगम।',
                'slug' => 'urban-civic-transit-connectivity',
                'progress_percentage' => 30,
                'financial_allocation' => 3200000000.00,
                'beneficiaries_count' => 1200000,
                'scheme_status' => 'active',
                'status' => 'published',
                'image_path' => 'assets/images/scheme-rural.svg',
                'published_at' => now()->subMonths(3),
            ],
            [
                'title_en' => 'Clean Drinking Water Pipeline Network Mission',
                'title_hi' => 'स्वच्छ पेयजल पाइपलाइन नेटवर्क मिशन',
                'description_en' => 'Piped drinking water distribution networks with SCADA-monitored chlorination plants and automated leakage detection sensors for peri-urban communities.',
                'description_hi' => 'स्वचालित रिसाव पहचान सेंसर और स्काडा-नियंत्रित क्लोरीनीकरण संयंत्रों के साथ नल से स्वच्छ पेयजल वितरण प्रणाली।',
                'objectives_en' => '1. 100% household tap connections in 600 peri-urban hamlets. 2. Real-time water pressure and turbidity tracking. 3. 24/7 quality grievance helpline.',
                'objectives_hi' => '1. 600 बस्तियों में शत-प्रतिशत घरेलू नल कनेक्शन। 2. पानी की शुद्धता की रीयल-टाइम निगरानी। 3. 24/7 नागरिक हेल्पलाइन।',
                'eligibility_en' => 'Peri-urban habitations lacking piped water supply as certified by District Water Authority.',
                'eligibility_hi' => 'जिला जल प्राधिकरण द्वारा प्रमाणित पेयजल विहीन उप-शहरी क्षेत्र।',
                'slug' => 'clean-drinking-water-pipeline-network',
                'progress_percentage' => 75,
                'financial_allocation' => 1900000000.00,
                'beneficiaries_count' => 640000,
                'scheme_status' => 'active',
                'status' => 'published',
                'image_path' => 'assets/images/scheme-green.svg',
                'published_at' => now()->subMonths(10),
            ],
        ];

        foreach ($schemes as $s) {
            Scheme::updateOrCreate(
                ['slug' => $s['slug']],
                array_merge($s, ['created_by' => $editor->id])
            );
        }

        // 5. Acts & Rules (5 items)
        $acts = [
            [
                'title_en' => 'Public Infrastructure Development & Regulation Act',
                'title_hi' => 'सार्वजनिक अवसंरचना विकास एवं विनियमन अधिनियम',
                'description_en' => 'Primary legislative statute providing statutory framework for project feasibility appraisal, mandatory public disclosures, quality inspection protocols, and contractual accountability.',
                'description_hi' => 'परियोजना व्यवहार्यता मूल्यांकन, अनिवार्य सार्वजनिक प्रकटीकरण, गुणवत्ता निरीक्षण प्रोटोकॉल और अनुबंधीय जवाबदेही हेतु प्राथमिक वैधानिक अधिनियम।',
                'type' => 'act',
                'year' => 2024,
                'language' => 'bilingual',
                'category' => 'legislation',
                'slug' => 'public-infrastructure-act-2024',
                'file_path' => 'documents/Public_Infrastructure_Act_2024.pdf',
                'file_size' => 1907,
                'status' => 'published',
                'published_at' => now()->subMonths(14),
            ],
            [
                'title_en' => 'State Sustainable Infrastructure Guidelines 2026',
                'title_hi' => 'राज्य सतत अवसंरचना दिशानिर्देश 2026',
                'description_en' => 'Comprehensive technical manual setting standards for climate-resilient road geometry, eco-friendly concrete mixes, universal accessibility, and energy conservation.',
                'description_hi' => 'जलवायु-अनुकूल सड़क ज्यामिति, पर्यावरण-अनुकूल कंक्रीट मिश्रण और सुगम्यता हेतु व्यापक तकनीकी नियमावली।',
                'type' => 'guideline',
                'year' => 2026,
                'language' => 'english',
                'category' => 'guidelines',
                'slug' => 'infrastructure-guidelines-2026',
                'file_path' => 'documents/Infrastructure_Guidelines_2026.pdf',
                'file_size' => 1571,
                'status' => 'published',
                'published_at' => now()->subMonths(2),
            ],
            [
                'title_en' => 'Public Procurement & E-Tendering Rules 2025',
                'title_hi' => 'सार्वजनिक खरीद एवं ई-निविदा नियम 2025',
                'description_en' => 'Statutory rules governing standard bidding documents, electronic reverse auctions, vendor performance grading, and grievance redressal mechanisms.',
                'description_hi' => 'मानक निविदा दस्तावेज, इलेक्ट्रॉनिक रिवर्स नीलामी और विक्रेता निष्पादन मूल्यांकन संबंधी वैधानिक नियम।',
                'type' => 'rule',
                'year' => 2025,
                'language' => 'bilingual',
                'category' => 'procurement',
                'slug' => 'procurement-rules-2025',
                'file_path' => 'documents/Procurement_Rules_2025.pdf',
                'file_size' => 1590,
                'status' => 'published',
                'published_at' => now()->subMonths(8),
            ],
            [
                'title_en' => 'Public Disclosure & Proactive Transparency Rules',
                'title_hi' => 'सार्वजनिक प्रकटीकरण एवं सक्रिय पारदर्शिता नियम',
                'description_en' => 'Mandating real-time digital publication of all public works tenders, payment vouchers, third-party inspection logs, and social audit reports.',
                'description_hi' => 'सभी सार्वजनिक निर्माण कार्यों की निविदाओं, भुगतान वाउचर और सामाजिक अंकेक्षण रिपोर्टों का अनिवार्य डिजिटल प्रकाशन।',
                'type' => 'rule',
                'year' => 2024,
                'language' => 'english',
                'category' => 'transparency',
                'slug' => 'public-disclosure-rules-2024',
                'file_path' => 'documents/RTI_Proactive_Disclosure_Manual.pdf',
                'file_size' => 1685,
                'status' => 'published',
                'published_at' => now()->subMonths(11),
            ],
            [
                'title_en' => 'Project Administration & Quality Certification Code',
                'title_hi' => 'परियोजना प्रशासन एवं गुणवत्ता प्रमाणन संहिता',
                'description_en' => 'Standard operating procedures for stage-wise engineering audits, laboratory core sampling, and penalty schedules for construction non-compliance.',
                'description_hi' => 'चरणबद्ध इंजीनियरिंग ऑडिट, प्रयोगशाला परीक्षण और गुणवत्ता मानकों के अनुपालन हेतु मानक संचालन प्रक्रिया।',
                'type' => 'regulation',
                'year' => 2023,
                'language' => 'english',
                'category' => 'technical',
                'slug' => 'project-administration-code-2023',
                'file_path' => 'documents/Technical_Specification_TPI_2026_001.pdf',
                'file_size' => 1749,
                'status' => 'published',
                'published_at' => now()->subMonths(18),
            ],
        ];

        foreach ($acts as $a) {
            Act::updateOrCreate(
                ['slug' => $a['slug']],
                array_merge($a, ['created_by' => $editor->id])
            );
        }

        // 6. Meetings (5 items)
        $meetings = [
            [
                'title_en' => '42nd State Infrastructure Apex Review Meeting',
                'title_hi' => '42वीं राज्य अवसंरचना शीर्ष समीक्षा बैठक',
                'date' => now()->subDays(15)->toDateString(),
                'location_en' => 'Committee Room A, Central Secretariat',
                'location_hi' => 'समिति कक्ष ए, केंद्रीय सचिवालय',
                'type' => 'review',
                'slug' => '42nd-state-infrastructure-apex-meeting',
                'meeting_status' => 'completed',
                'agenda_en' => '1. Review of 18 high-impact arterial road projects. 2. Budgetary reallocation for flood-resilience culverts. 3. Clearance of pending utility shifting permits.',
                'agenda_hi' => '1. 18 प्रमुख सड़क परियोजनाओं की प्रगति समीक्षा। 2. बाढ़ प्रतिरोधी पुलियों हेतु बजट पुनर्वितरण। 3. उपयोगिता स्थानांतरण अनुमतियां।',
                'minutes_en' => 'The council chaired by Principal Secretary evaluated progress across all 12 zones. Directed contractor penalty enforcement on 2 delayed packages. Approved supplementary fund release of INR 45 Cr.',
                'minutes_hi' => 'प्रधान सचिव की अध्यक्षता में 12 जोनों की समीक्षा की गई। 2 विलंबित पैकेजों पर जुर्माना लगाने के निर्देश। 45 करोड़ रुपये की अनुपूरक राशि स्वीकृत।',
                'resolutions_en' => 'Resolved that all pending highway stretches be completed before onset of monsoon. Resolved to mandate weekly drone progress audits.',
                'resolutions_hi' => 'प्रस्तावित कि मानसून पूर्व सभी राजमार्ग पूरे किए जाएं। साप्ताहिक ड्रोन सर्वेक्षण अनिवार्य करने का संकल्प।',
                'status' => 'published',
                'published_at' => now()->subDays(10),
            ],
            [
                'title_en' => 'Departmental Technical Vetting Council - Quarter 4 Session',
                'title_hi' => 'विभागीय तकनीकी परीक्षण परिषद - चतुर्थ तिमाही सत्र',
                'date' => now()->subDays(28)->toDateString(),
                'location_en' => 'Conference Hall, Chief Engineer Office',
                'location_hi' => 'सम्मेलन कक्ष, मुख्य अभियंता कार्यालय',
                'type' => 'departmental',
                'slug' => 'technical-vetting-council-q4',
                'meeting_status' => 'completed',
                'agenda_en' => 'Detailed technical scrutinization of detailed project reports (DPRs) for 14 new rural connectivity packages.',
                'agenda_hi' => '14 नए ग्रामीण सड़क पैकेजों की विस्तृत परियोजना रिपोर्ट (डीपीआर) का तकनीकी परीक्षण।',
                'minutes_en' => '12 DPRs cleared with minor revisions in drainage design. 2 DPRs returned for soil bearing capacity verification.',
                'minutes_hi' => '12 डीपीआर स्वीकृत। 2 डीपीआर मिट्टी परीक्षण सुधार हेतु वापस भेजे गए।',
                'resolutions_en' => 'Standardized use of M-40 grade concrete for all major culvert bridge slabs.',
                'resolutions_hi' => 'सभी पुलिया स्लैब हेतु M-40 ग्रेड कंक्रीट का मानक उपयोग निर्धारित।',
                'status' => 'published',
                'published_at' => now()->subDays(20),
            ],
            [
                'title_en' => 'Inter-Departmental Coordination on Renewable Energy Integration',
                'title_hi' => 'नवीकरणीय ऊर्जा एकीकरण पर अंतर-विभागीय समन्वय बैठक',
                'date' => now()->subDays(45)->toDateString(),
                'location_en' => 'State Energy Bhavan, Board Room',
                'location_hi' => 'राज्य ऊर्जा भवन, बोर्ड रूम',
                'type' => 'special',
                'slug' => 'inter-departmental-renewable-energy',
                'meeting_status' => 'completed',
                'agenda_en' => 'Net-metering permissions, solar tariff subsidies, and structural roof fitness certification for 400 government buildings.',
                'agenda_hi' => '400 सरकारी भवनों हेतु नेट-मीटरिंग, सौर सब्सिडी एवं छत संरचनात्मक उपयुक्तता प्रमाणन।',
                'minutes_en' => 'State power discom agreed to provide expedited green-channel approvals within 10 days of application.',
                'minutes_hi' => 'बिजली वितरण कंपनी ने 10 दिनों के भीतर ग्रीन-चैनल त्वरित स्वीकृति देने पर सहमति व्यक्त की।',
                'resolutions_en' => 'Approved joint SOP between Infrastructure and Energy Departments.',
                'resolutions_hi' => 'अवसंरचना एवं ऊर्जा विभागों के बीच संयुक्त मानक संचालन प्रक्रिया को मंजूरी।',
                'status' => 'published',
                'published_at' => now()->subDays(40),
            ],
            [
                'title_en' => 'Public Stakeholder Consultation on Urban Transport Masterplan',
                'title_hi' => 'शहरी परिवहन महायोजना पर सार्वजनिक हितधारक परामर्श',
                'date' => now()->addDays(14)->toDateString(),
                'location_en' => 'Town Hall Auditorium, Capital City',
                'location_hi' => 'टाउन हॉल सभागार, राजधानी',
                'type' => 'public',
                'slug' => 'public-consultation-transport-masterplan',
                'meeting_status' => 'scheduled',
                'agenda_en' => 'Presentation of proposed dedicated bus corridors, cycle tracks, and non-motorized transport zones to trade associations, citizen welfare groups, and transit experts.',
                'agenda_hi' => 'व्यापार मंडलों, नागरिक कल्याण संगठनों और परिवहन विशेषज्ञों के समक्ष समर्पित बस कॉरिडोर एवं साइकिल ट्रैक योजना का प्रस्तुतीकरण।',
                'minutes_en' => null,
                'resolutions_en' => null,
                'status' => 'published',
                'published_at' => now()->subDays(5),
            ],
            [
                'title_en' => 'State High-Level Quality Assurance Council Hearing',
                'title_hi' => 'राज्य उच्च स्तरीय गुणवत्ता आश्वासन परिषद सुनवाई',
                'date' => now()->subDays(70)->toDateString(),
                'location_en' => 'Vigilance Directorate Complex',
                'location_hi' => 'सतर्कता निदेशालय परिसर',
                'type' => 'departmental',
                'slug' => 'quality-assurance-council-hearing',
                'meeting_status' => 'completed',
                'agenda_en' => 'Audit reports on bituminous paving density and core compressive tests across 6 district highways.',
                'agenda_hi' => '6 जिला राजमार्गों पर डामर घनत्व और कोर संपीड़न परीक्षणों की ऑडिट रिपोर्ट की समीक्षा।',
                'minutes_en' => 'Penalties totaling INR 18.4 Lakh levied on three contracting firms for bituminous grading variance.',
                'minutes_hi' => 'गुणवत्ता मानकों में विचलन हेतु तीन कंपनियों पर कुल 18.4 लाख रुपये का जुर्माना अधिरोपित।',
                'resolutions_en' => 'Mandated digital batch-mix plant data logging for all ongoing contracts.',
                'resolutions_hi' => 'सभी चालू अनुबंधों हेतु बैच-मिक्स प्लांट डिजिटल लॉगिंग अनिवार्य की गई।',
                'status' => 'published',
                'published_at' => now()->subDays(65),
            ],
        ];

        foreach ($meetings as $m) {
            $meetModel = Meeting::updateOrCreate(
                ['slug' => $m['slug']],
                array_merge($m, ['created_by' => $editor->id])
            );

            Document::updateOrCreate(
                [
                    'documentable_type' => Meeting::class,
                    'documentable_id' => $meetModel->id,
                    'type' => 'minutes'
                ],
                [
                    'title_en' => "Meeting Proceedings & Minutes - {$m['title_en']}.pdf",
                    'title_hi' => "बैठक कार्यवाही एवं कार्यवृत्त - {$m['title_hi']}.pdf",
                    'language' => 'bilingual',
                    'file_path' => 'documents/Meeting_Minutes_SEC_42.pdf',
                    'file_size' => 1632,
                    'mime_type' => 'application/pdf',
                    'status' => 'published',
                    'published_at' => now(),
                    'uploaded_by' => $publisher->id,
                ]
            );
        }

        // 7. Financial Disclosures (5 records)
        $financials = [
            [
                'financial_year' => '2025-26',
                'quarter' => 'Q3',
                'fund_receipts' => 1652000000.00,
                'expenditure' => 1488000000.00,
                'project_allocation' => 1800000000.00,
                'project_category' => 'Highways & Bridges',
                'remarks_en' => 'Fund utilization achieved 90.1% of quarterly target. Major spending on 4-lane widening and flood mitigation works.',
                'remarks_hi' => 'त्रैमासिक लक्ष्य के सापेक्ष 90.1% निधि उपयोग। 4-लेन चौड़ीकरण एवं बाढ़ सुरक्षा कार्यों पर प्रमुख व्यय।',
                'status' => 'published',
                'published_at' => now()->subDays(40),
            ],
            [
                'financial_year' => '2025-26',
                'quarter' => 'Q2',
                'fund_receipts' => 1420000000.00,
                'expenditure' => 1315000000.00,
                'project_allocation' => 1500000000.00,
                'project_category' => 'Rural Connectivity',
                'remarks_en' => 'Monsoon season maintenance and emergency culvert restorations completed across 12 rural districts.',
                'remarks_hi' => 'मानसून पूर्व एवं आपातकालीन मरम्मत कार्य 12 ग्रामीण जिलों में सफलतापूर्वक पूर्ण।',
                'status' => 'published',
                'published_at' => now()->subMonths(4),
            ],
            [
                'financial_year' => '2025-26',
                'quarter' => 'Q1',
                'fund_receipts' => 1750000000.00,
                'expenditure' => 1590000000.00,
                'project_allocation' => 1850000000.00,
                'project_category' => 'Civic Infrastructure',
                'remarks_en' => 'Commencement of green building conversions and rooftop solar installations across state complex.',
                'remarks_hi' => 'राज्य सचिवालय परिसर में हरित भवन रूपांतरण एवं सौर ऊर्जा संयंत्र कार्यों का शुभारंभ।',
                'status' => 'published',
                'published_at' => now()->subMonths(7),
            ],
            [
                'financial_year' => '2024-25',
                'quarter' => 'Q4',
                'fund_receipts' => 2100000000.00,
                'expenditure' => 2045000000.00,
                'project_allocation' => 2100000000.00,
                'project_category' => 'Annual Capital Works',
                'remarks_en' => 'Year-end financial closing with 97.4% overall budget execution. Audited by Comptroller and Auditor General (CAG).',
                'remarks_hi' => 'वित्तीय वर्ष समापन पर 97.4% समग्र बजट निष्पादन। महालेखाकार (सीएजी) द्वारा ऑडिट संपन्न।',
                'status' => 'published',
                'published_at' => now()->subMonths(10),
            ],
            [
                'financial_year' => '2024-25',
                'quarter' => 'Q3',
                'fund_receipts' => 1540000000.00,
                'expenditure' => 1410000000.00,
                'project_allocation' => 1600000000.00,
                'project_category' => 'Digital Governance',
                'remarks_en' => 'Procurement and rollout of fiber optic routers and citizen digital kiosks across 800 gram panchayats.',
                'remarks_hi' => '800 ग्राम पंचायतों में फाइबर ऑप्टिक नेटवर्क एवं नागरिक सेवा कियोस्क की स्थापना।',
                'status' => 'published',
                'published_at' => now()->subMonths(13),
            ],
        ];

        foreach ($financials as $f) {
            FinancialDisclosure::updateOrCreate(
                [
                    'financial_year' => $f['financial_year'],
                    'quarter' => $f['quarter'],
                    'project_category' => $f['project_category'],
                ],
                array_merge($f, ['created_by' => $editor->id])
            );
        }

        // 8. Media Gallery (8 items)
        $mediaItems = [
            [
                'title_en' => 'Highway Quality Audit & Core Sampling Inspection',
                'title_hi' => 'राजमार्ग गुणवत्ता अंकेक्षण एवं कोर सैंपलिंग निरीक्षण',
                'caption_en' => 'Senior engineering inspection team examining bitumen thickness and compressive strength along State Highway 4.',
                'caption_hi' => 'राज्य राजमार्ग 4 पर डामर मोटाई एवं संपीड़न शक्ति की जांच करती वरिष्ठ इंजीनियरिंग निरीक्षण टीम।',
                'category' => 'inspections',
                'file_path' => 'assets/images/media-inspection.svg',
                'thumbnail_path' => 'assets/images/media-inspection.svg',
                'date' => now()->subDays(10)->toDateString(),
                'status' => 'published',
            ],
            [
                'title_en' => 'State Infrastructure Apex Monitoring Session',
                'title_hi' => 'राज्य अवसंरचना शीर्ष निगरानी सत्र',
                'caption_en' => 'High-level meeting of the Infrastructure Project Monitoring Board reviewing quarterly milestones.',
                'caption_hi' => 'त्रैमासिक मील के पत्थरों की समीक्षा करती अवसंरचना परियोजना निगरानी बोर्ड की उच्च स्तरीय बैठक।',
                'category' => 'meetings',
                'file_path' => 'assets/images/media-meeting.svg',
                'thumbnail_path' => 'assets/images/media-meeting.svg',
                'date' => now()->subDays(15)->toDateString(),
                'status' => 'published',
            ],
            [
                'title_en' => 'Cable-Stayed River Viaduct Infrastructure',
                'title_hi' => 'केबल-स्टेड रिवर वायाडक्ट अवसंरचना',
                'caption_en' => 'A landmark 1.8 km balanced-cantilever river bridge connecting two commercial industrial corridors.',
                'caption_hi' => 'दो वाणिज्यिक औद्योगिक गलियारों को जोड़ने वाला 1.8 किमी लंबा ऐतिहासिक नदी पुल।',
                'category' => 'infrastructure',
                'file_path' => 'assets/images/media-bridge.svg',
                'thumbnail_path' => 'assets/images/media-bridge.svg',
                'date' => now()->subDays(22)->toDateString(),
                'status' => 'published',
            ],
            [
                'title_en' => 'Rural Connectivity Mission - Village Roadway',
                'title_hi' => 'ग्रामीण संपर्क मिशन - ग्राम सड़क संपर्क',
                'caption_en' => 'Newly paved all-weather concrete road linking remote farming hamlets to the district marketing yard.',
                'caption_hi' => 'दूरदराज के कृषि क्षेत्रों को जिला कृषि उपज मंडी से जोड़ने वाली नवनिर्मित पक्की सड़क।',
                'category' => 'community',
                'file_path' => 'assets/images/media-rural-road.svg',
                'thumbnail_path' => 'assets/images/media-rural-road.svg',
                'date' => now()->subDays(30)->toDateString(),
                'status' => 'published',
            ],
            [
                'title_en' => '50MW State Public Solar Initiative',
                'title_hi' => '50 मेगावाट राज्य सार्वजनिक सौर पहल',
                'caption_en' => 'Ground-mounted and rooftop solar generation arrays providing clean power to public utility facilities.',
                'caption_hi' => 'सार्वजनिक उपयोगिता सुविधाओं को स्वच्छ ऊर्जा प्रदान करने वाले विशाल सौर ऊर्जा संयंत्र।',
                'category' => 'infrastructure',
                'file_path' => 'assets/images/media-solar-park.svg',
                'thumbnail_path' => 'assets/images/media-solar-park.svg',
                'date' => now()->subDays(45)->toDateString(),
                'status' => 'published',
            ],
            [
                'title_en' => 'Secretariat Infrastructure Wing Headquarters',
                'title_hi' => 'सचिवालय अवसंरचना विंग मुख्यालय भवन',
                'caption_en' => 'Main administrative headquarters building housing engineering directorates and the public grievance cell.',
                'caption_hi' => 'इंजीनियरिंग निदेशालयों एवं जनशिकायत प्रकोष्ठ को समाहित करने वाला मुख्य प्रशासनिक मुख्यालय।',
                'category' => 'events',
                'file_path' => 'assets/images/media-hq.svg',
                'thumbnail_path' => 'assets/images/media-hq.svg',
                'date' => now()->subDays(50)->toDateString(),
                'status' => 'published',
            ],
            [
                'title_en' => 'State Command, Control & GIS Telemetry Centre',
                'title_hi' => 'राज्य कमान, नियंत्रण एवं जीआईएस टेलीमेट्री केंद्र',
                'caption_en' => 'Real-time monitoring room tracking project timelines, material logistics, and quality assurance metrics.',
                'caption_hi' => 'परियोजना समय-सीमा, सामग्री आपूर्ति और गुणवत्ता मानकों की वास्तविक समय निगरानी कक्ष।',
                'category' => 'infrastructure',
                'file_path' => 'assets/images/media-tech-center.svg',
                'thumbnail_path' => 'assets/images/media-tech-center.svg',
                'date' => now()->subDays(60)->toDateString(),
                'status' => 'published',
            ],
            [
                'title_en' => 'Public Citizen Service Kiosk & Grievance Centre',
                'title_hi' => 'सार्वजनिक नागरिक सेवा कियोस्क एवं शिकायत केंद्र',
                'caption_en' => 'Decentralized digital facilitation center helping citizens access schemes and track public works.',
                'caption_hi' => 'योजनाओं तक पहुंच और विकास कार्यों की निगरानी में नागरिकों की सहायता करता डिजिटल केंद्र।',
                'category' => 'community',
                'file_path' => 'assets/images/media-citizen-portal.svg',
                'thumbnail_path' => 'assets/images/media-citizen-portal.svg',
                'date' => now()->subDays(75)->toDateString(),
                'status' => 'published',
            ],
        ];

        foreach ($mediaItems as $item) {
            Media::updateOrCreate(
                ['title_en' => $item['title_en']],
                $item
            );
        }

        // 9. Pages (RTI, About Us, Contact)
        Page::updateOrCreate(
            ['slug' => 'about'],
            [
                'title_en' => 'About the Department of Public Infrastructure',
                'title_hi' => 'लोक निर्माण एवं आधारभूत संरचना विभाग के बारे में',
                'content_en' => 'The Department of Public Infrastructure is the apex nodal agency responsible for planning, designing, constructing, and maintaining modern, resilient, and inclusive public infrastructure across the state. Committed to transparent governance, the department oversees arterial road networks, civic buildings, flood defense systems, and digital public infrastructure.',
                'content_hi' => 'लोक निर्माण एवं आधारभूत संरचना विभाग राज्य भर में आधुनिक, सुदृढ़ और समावेशी सार्वजनिक अवसंरचना के नियोजन, निर्माण और रखरखाव हेतु नोडल एजेंसी है। पारदर्शी शासन के लिए प्रतिबद्ध, यह विभाग मुख्य सड़क नेटवर्क, नागरिक भवनों, बाढ़ सुरक्षा प्रणालियों और डिजिटल अवसंरचना की निगरानी करता है।',
                'template' => 'about',
                'status' => 'published',
                'published_at' => now(),
                'created_by' => $superAdmin->id,
            ]
        );

        Page::updateOrCreate(
            ['slug' => 'rti'],
            [
                'title_en' => 'Right to Information (RTI) Disclosures',
                'title_hi' => 'सूचना का अधिकार (आरटीआई) प्रकटीकरण',
                'content_en' => 'In accordance with Section 4(1)(b) of the Right to Information Act, the Department of Public Infrastructure provides proactive disclosures regarding organization, powers of officers, decision making procedures, budget allocations, and public grievance mechanisms.',
                'content_hi' => 'सूचना का अधिकार अधिनियम की धारा 4(1)(b) के अनुसार, लोक निर्माण एवं आधारभूत संरचना विभाग अपने संगठन, अधिकारियों की शक्तियों, निर्णय लेने की प्रक्रियाओं, बजट आवंटन और जनशिकायत निवारण के संबंध में स्वैच्छिक प्रकटीकरण प्रदान करता है।',
                'template' => 'rti',
                'status' => 'published',
                'published_at' => now(),
                'created_by' => $superAdmin->id,
            ]
        );

        Page::updateOrCreate(
            ['slug' => 'contact'],
            [
                'title_en' => 'Contact the Department',
                'title_hi' => 'विभाग से संपर्क करें',
                'content_en' => 'Get in touch with the Department of Public Infrastructure for queries, technical consultations, or citizen grievances.',
                'content_hi' => 'किसी भी प्रश्न, तकनीकी परामर्श या नागरिक शिकायतों के लिए लोक निर्माण एवं आधारभूत संरचना विभाग से संपर्क करें।',
                'template' => 'contact',
                'status' => 'published',
                'published_at' => now(),
                'created_by' => $superAdmin->id,
            ]
        );
    }
}
