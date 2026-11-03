<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Collaboration;
use App\Models\RentalItem;
use App\Models\Service;
use App\Models\SocialLink;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Support\SiteContent;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PublicPageController extends Controller
{
    public function about(): View
    {
        return view('guest.about', [
            'teamMembers' => TeamMember::query()->where('is_active', true)->orderBy('sort_order')->get(),
            'settings' => SiteContent::settings(),
        ]);
    }

    public function services(): View
    {
        return view('guest.services', [
            'services' => Service::query()
                ->where('is_active', true)
                ->orderByRaw("CASE WHEN category = 'penyewaan' THEN 0 ELSE 1 END")
                ->orderBy('sort_order')
                ->get(),
            'documentation' => Collaboration::query()
                ->where('is_active', true)
                ->with('photos')
                ->latest('event_date')
                ->get()
                ->groupBy('service_category'),
            'settings' => SiteContent::settings(),
        ]);
    }

    public function service(Service $service): View
    {
        abort_unless($service->is_active, 404);

        return view('guest.service-detail', [
            'service' => $service->load(['rentalItems' => fn ($query) => $query->where('is_active', true)]),
            'relatedCollaborations' => Collaboration::query()
                ->where('is_active', true)
                ->where('service_category', $service->category)
                ->with('photos')
                ->latest('event_date')
                ->take(3)
                ->get(),
            'settings' => SiteContent::settings(),
        ]);
    }

    public function custom(): View
    {
        $rentalItems = RentalItem::query()
            ->where('is_active', true)
            ->whereHas('service', fn ($query) => $query->where('category', 'penyewaan')->where('is_active', true))
            ->orderBy('sort_order')
            ->get();

        return view('guest.custom-builder', [
            'rentalItems' => $rentalItems,
            'rentalCategories' => $rentalItems->pluck('category')->filter()->unique()->values(),
            'crewService' => Service::query()
                ->where('is_active', true)
                ->where('category', 'sewa-crew')
                ->first(),
            'settings' => SiteContent::settings(),
        ]);
    }

    public function rentalItem(RentalItem $rentalItem): View
    {
        abort_unless($rentalItem->is_active, 404);

        $relatedItems = RentalItem::query()
            ->where('is_active', true)
            ->where('category', $rentalItem->category)
            ->where('id', '!=', $rentalItem->id)
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        return view('guest.rental-detail', [
            'item' => $rentalItem->load('service'),
            'relatedItems' => $relatedItems,
            'settings' => SiteContent::settings(),
        ]);
    }

    public function collaborations(): View
    {
        return view('guest.collaborations', ['collaborations' => Collaboration::query()->where('is_active', true)->with('photos')->latest('event_date')->get(), 'settings' => SiteContent::settings()]);
    }

    public function collaboration(Collaboration $collaboration): View
    {
        abort_unless($collaboration->is_active, 404);

        return view('guest.collaboration-detail', ['collaboration' => $collaboration->load('photos'), 'settings' => SiteContent::settings()]);
    }

    public function testimonials(): View
    {
        return view('guest.testimonials', ['testimonials' => Testimonial::query()->where('is_active', true)->latest()->get(), 'settings' => SiteContent::settings()]);
    }

    public function contact(): View
    {
        return view('guest.contact', ['socialLinks' => SocialLink::query()->where('is_active', true)->orderBy('sort_order')->get(), 'settings' => SiteContent::settings()]);
    }

    public function sitemap(): Response
    {
        return response()->view('guest.sitemap', [
            'services' => Service::query()->where('is_active', true)->get(),
            'rentalItems' => RentalItem::query()->where('is_active', true)->get(),
            'collaborations' => Collaboration::query()->where('is_active', true)->get(),
        ], 200, ['Content-Type' => 'text/xml']);
    }
}
