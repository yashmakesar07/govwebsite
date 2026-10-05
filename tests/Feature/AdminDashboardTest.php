<?php

namespace Tests\Feature;

use App\Filament\Widgets\LatestNoticesWidget;
use App\Filament\Widgets\StatsOverview;
use App\Models\Notice;
use App\Models\User;
use Filament\Facades\Filament;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_can_be_accessed(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'superadmin@example.gov.in'],
            [
                'name' => 'Super Administrator',
                'password' => bcrypt('password'),
                'role' => 'super_admin',
            ]
        );

        $response = $this->actingAs($admin)->get('/admin');
        $response->assertSuccessful();
        $response->assertSee('Department of Public Infrastructure — Official Admin Portal');
    }

    public function test_stats_overview_widget_returns_correct_stats(): void
    {
        $widget = new StatsOverview();
        $reflection = new \ReflectionClass($widget);
        $method = $reflection->getMethod('getStats');
        $method->setAccessible(true);
        $stats = $method->invoke($widget);

        $this->assertCount(6, $stats);
        $labels = array_map(fn ($stat) => $stat->getLabel(), $stats);
        $this->assertEquals([
            'Total Published',
            'Drafts',
            'Pending Review',
            'Archived',
            'Active Tenders',
            'Upcoming Tenders',
        ], $labels);
    }

    public function test_latest_notices_widget_instantiates_and_configures_table(): void
    {
        $widget = new LatestNoticesWidget();
        $table = $widget->table(new \Filament\Tables\Table($widget));

        $this->assertEquals('Latest Notices', $table->getHeading());
        $columns = $table->getColumns();
        $this->assertArrayHasKey('title_en', $columns);
        $this->assertArrayHasKey('category', $columns);
        $this->assertArrayHasKey('status', $columns);
        $this->assertArrayHasKey('published_at', $columns);
    }

    public function test_user_form_has_role_select_with_expected_options(): void
    {
        $schema = \App\Filament\Resources\Users\Schemas\UserForm::configure(new \Filament\Schemas\Schema());
        $roleField = collect($schema->getComponents())->first(fn ($c) => $c->getName() === 'role');

        $this->assertInstanceOf(\Filament\Forms\Components\Select::class, $roleField);
        $options = $roleField->getOptions();
        $this->assertArrayHasKey('super_admin', $options);
        $this->assertArrayHasKey('editor', $options);
        $this->assertArrayHasKey('publisher', $options);
        $this->assertEquals('Super Administrator (Full System Access)', $options['super_admin']);
        $this->assertEquals('Content Editor (Draft & Submit)', $options['editor']);
        $this->assertEquals('Designated Publisher (Review, Approve & Publish)', $options['publisher']);
    }

    public function test_users_table_displays_role_as_colored_badge(): void
    {
        $table = new \Filament\Tables\Table(new \App\Filament\Resources\Users\Pages\ListUsers());
        $configured = \App\Filament\Resources\Users\Tables\UsersTable::configure($table);
        $roleColumn = $configured->getColumn('role');

        $this->assertNotNull($roleColumn);
        $this->assertTrue($roleColumn->isBadge());
    }
}

