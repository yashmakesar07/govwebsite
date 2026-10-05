<?php

namespace Tests\Feature;

use App\Models\Document;
use App\Models\Tender;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GovernmentPortalTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    protected function setUp(): void
    {
        parent::setUp();

        if (Tender::count() === 0) {
            $this->seed(DatabaseSeeder::class);
        }
    }

    /**
     * Test homepage loads successfully in English.
     */
    public function test_homepage_loads_successfully_in_english(): void
    {
        $response = $this->get('/en');

        $response->assertStatus(200);
        $response->assertSee('Department of Public Infrastructure');
        $response->assertSee('Official Information Portal');
        $response->assertSee('Latest Tenders');
    }

    /**
     * Test homepage loads successfully in Hindi.
     */
    public function test_homepage_loads_successfully_in_hindi(): void
    {
        $response = $this->get('/hi');

        $response->assertStatus(200);
        $response->assertSee('लोक निर्माण एवं आधारभूत संरचना विभाग');
        $response->assertSee('नवीनतम निविदाएं');
    }

    /**
     * Test root URL redirects to default locale (/en).
     */
    public function test_root_redirects_to_default_locale(): void
    {
        $response = $this->get('/');

        $response->assertRedirect('/en');
    }

    /**
     * Test tenders index loads and filters (search & status) work.
     */
    public function test_tenders_index_and_filters_work(): void
    {
        // Index page loads
        $response = $this->get('/en/tenders');
        $response->assertStatus(200);

        // Search query parameter filter
        $searchResponse = $this->get('/en/tenders?search=Road');
        $searchResponse->assertStatus(200);
        $searchResponse->assertSee('Road Improvement');

        // Status query parameter filter
        $statusResponse = $this->get('/en/tenders?status=active');
        $statusResponse->assertStatus(200);
        $statusResponse->assertSee('TPI/2026/001');

        $closedResponse = $this->get('/en/tenders?status=closed');
        $closedResponse->assertStatus(200);
        $closedResponse->assertSee('TPI/2025/088');
    }

    /**
     * Test tender detail page loads with tender number, title, and document links.
     */
    public function test_tender_detail_page_loads_with_documents(): void
    {
        $response = $this->get('/en/tenders/tpi-2026-001-road-improvement-works');

        $response->assertStatus(200);
        $response->assertSee('TPI/2026/001');
        $response->assertSee('Road Improvement and Development Works');
        $response->assertSee('/documents/');
    }

    /**
     * Test acts and rules repository loads and filters work.
     */
    public function test_acts_repository_loads_and_filters(): void
    {
        $response = $this->get('/en/acts-rules');
        $response->assertStatus(200);

        // Filter by type
        $filterResponse = $this->get('/en/acts-rules?type=act');
        $filterResponse->assertStatus(200);

        // Filter by search
        $searchResponse = $this->get('/en/acts-rules?search=Infrastructure');
        $searchResponse->assertStatus(200);
    }

    /**
     * Test schemes page and scheme detail page load successfully.
     */
    public function test_schemes_page_and_detail_load(): void
    {
        $indexResponse = $this->get('/en/schemes');
        $indexResponse->assertStatus(200);

        $detailResponse = $this->get('/en/schemes/rural-infrastructure-development-scheme');
        $detailResponse->assertStatus(200);
        $detailResponse->assertSee('Rural Infrastructure');
    }

    /**
     * Test meetings page and meeting detail page load successfully.
     */
    public function test_meetings_page_and_detail_load(): void
    {
        $indexResponse = $this->get('/en/meetings');
        $indexResponse->assertStatus(200);

        $detailResponse = $this->get('/en/meetings/42nd-state-infrastructure-apex-meeting');
        $detailResponse->assertStatus(200);
        $detailResponse->assertSee('42nd State Infrastructure Apex Review Meeting');
    }

    /**
     * Test financial disclosure page loads and displays fund figures.
     */
    public function test_financial_disclosure_page_loads(): void
    {
        $response = $this->get('/en/financial-disclosure');

        $response->assertStatus(200);
        $response->assertSee('Financial Disclosures');
        $response->assertSee('Cr');
    }

    /**
     * Test media gallery page loads successfully.
     */
    public function test_media_gallery_page_loads(): void
    {
        $response = $this->get('/en/media');

        $response->assertStatus(200);
    }

    /**
     * Test RTI proactive disclosure page loads successfully.
     */
    public function test_rti_page_loads(): void
    {
        $response = $this->get('/en/rti');

        $response->assertStatus(200);
        $response->assertSee('Right to Information');
    }

    /**
     * Test contact page loads and submission redirects with success session.
     */
    public function test_contact_page_and_submission(): void
    {
        $pageResponse = $this->get('/en/contact');
        $pageResponse->assertStatus(200);

        $submitResponse = $this->post('/en/contact', [
            'name' => 'Rajesh Sharma',
            'email' => 'rajesh.sharma@example.com',
            'phone' => '+91-9876543210',
            'subject' => 'Project Inquiry',
            'message' => 'This is an official inquiry regarding state road infrastructure projects.',
        ]);

        $submitResponse->assertRedirect();
        $submitResponse->assertSessionHas('success');
    }

    /**
     * Test global search returns matching results.
     */
    public function test_global_search_returns_results(): void
    {
        $response = $this->get('/en/search?q=Infrastructure');

        $response->assertStatus(200);
        $response->assertSee('Infrastructure');
    }

    /**
     * Test document download endpoint delivers PDF file.
     */
    public function test_document_download_delivers_pdf_file(): void
    {
        $document = Document::firstOrFail();

        $response = $this->get(route('documents.download', ['document' => $document->id]));

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
    }

    /**
     * Test Filament admin login page loads.
     */
    public function test_admin_login_page_loads(): void
    {
        $response = $this->get('/admin/login');

        $response->assertStatus(200);
    }

    /**
     * Test editor and publisher publishing workflow for tender.
     */
    public function test_editor_and_publisher_publishing_workflow(): void
    {
        $editor = User::where('role', 'editor')->first();

        // 1. Create a new Tender as draft
        $tender = Tender::create([
            'tender_number' => 'TPI/2026/TEST-099',
            'title_en' => 'Draft Highway Expansion Project Test',
            'title_hi' => 'प्रारूप राजमार्ग विस्तार परियोजना परीक्षण',
            'description_en' => 'Draft road expansion works for testing.',
            'department' => 'Department of Public Infrastructure',
            'category' => 'works',
            'slug' => 'draft-highway-expansion-project-test',
            'published_date' => now()->toDateString(),
            'closing_date' => now()->addDays(30)->toDateString(),
            'tender_status' => 'active',
            'status' => 'draft',
            'estimated_value' => 15000000.00,
            'created_by' => $editor?->id,
        ]);

        // 2. Assert it is in draft status
        $this->assertEquals('draft', $tender->status);
        $this->assertFalse(Tender::published()->where('id', $tender->id)->exists());

        // 3. Transition status to pending_review
        $tender->update(['status' => 'pending_review']);
        $this->assertEquals('pending_review', $tender->fresh()->status);
        $this->assertFalse(Tender::published()->where('id', $tender->id)->exists());

        // 4. Transition status to published and assert it appears in published tenders
        $tender->update([
            'status' => 'published',
            'published_at' => now(),
        ]);
        $this->assertEquals('published', $tender->fresh()->status);
        $this->assertTrue(Tender::published()->where('id', $tender->id)->exists());

        $listingResponse = $this->get('/en/tenders');
        $listingResponse->assertStatus(200);
        $listingResponse->assertSee('TPI/2026/TEST-099');
    }
}
