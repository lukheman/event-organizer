<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collaboration;
use App\Models\RentalItem;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'stats' => [
                'rental_items' => RentalItem::query()->count(),
                'available_rental_items' => RentalItem::query()->where('availability', 'available')->count(),
                'services' => Service::query()->count(),
                'collaborations' => Collaboration::query()->count(),
                'testimonials' => Testimonial::query()->count(),
                'team_members' => TeamMember::query()->count(),
            ],
            'recentItems' => RentalItem::query()->latest()->limit(5)->get(),
        ]);
    }
}
