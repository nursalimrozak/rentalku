<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $settings = \App\Models\SectionSetting::all()->keyBy('key');
        $brands = \App\Models\Brand::all();
        $features = \App\Models\Feature::all();
        $testimonials = \App\Models\Testimonial::latest()->take(3)->get();
        $faqs = \App\Models\Faq::all();
        $articles = \App\Models\Article::whereNotNull('published_at')->latest('published_at')->take(3)->get();
        $cars = \App\Models\Car::latest()->limit(6)->get();
        $rentalCommunities = \App\Models\RentalCommunity::all();
        $rentalSteps = \App\Models\RentalStep::all();

        return view('welcome', compact('settings', 'brands', 'features', 'testimonials', 'faqs', 'articles', 'cars', 'rentalCommunities', 'rentalSteps'));
    }
}
