<?php

namespace App\Http\Controllers;

use App\Models\CmsMenu;
use App\Models\ContactMessage;
use App\Models\Course;
use App\Models\FooterWidget;
use App\Models\News;
use App\Models\Page;
use App\Models\Setting;
use App\Models\SocialLink;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class FrontController extends Controller
{
    public function __construct()
    {
        View::share('cms', [
            'menus'    => CmsMenu::where('position', 'header')->where('is_active', true)->orderBy('sort_order')->get(),
            'footers'  => FooterWidget::orderBy('sort_order')->get(),
            'socials'  => SocialLink::all(),
            'settings' => Setting::pluck('value', 'key')->toArray(),
        ]);
    }

    public function home()
    {
        return view('front.home', [
            'news'         => News::with('newsCategory')->latest('publish_date')->take(3)->get(),
            'courses'      => Course::with('courseCategory')->latest()->take(6)->get(),
            'testimonials' => Testimonial::latest()->take(4)->get(),
        ]);
    }

    public function news()
    {
        return view('front.news', ['items' => News::with('newsCategory')->latest('publish_date')->paginate(9)]);
    }

    public function newsShow($id)
    {
        return view('front.news-show', ['item' => News::with('newsCategory')->findOrFail($id)]);
    }

    public function courses()
    {
        return view('front.courses', ['items' => Course::with('courseCategory')->latest()->paginate(9)]);
    }

    public function courseShow($id)
    {
        return view('front.course-show', ['item' => Course::with('courseCategory')->findOrFail($id)]);
    }

    public function about()
    {
        return view('front.about');
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function contactSave(Request $request)
    {
        ContactMessage::create($request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'nullable|email',
            'phone'   => 'nullable|string|max:30',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',
        ]));
        return back()->with('success', 'Thank you! Your message has been received.');
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('front.page', ['page' => $page]);
    }
}
