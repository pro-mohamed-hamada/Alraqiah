<?php

namespace App\Http\Controllers;

use App\Enum\ActivationStatusEnum;
use App\Enum\UserTypeEnum;
use App\Models\Client;
use App\Models\Complaint;
use App\Models\Faq;
use App\Models\Setting;
use App\Models\Site;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_users = User::where('type', UserTypeEnum::SUPERVISOR)->count();
        $total_clients = Client::count();
        $total_complaints = Complaint::count();
        $active_complaints = Complaint::where('is_active', ActivationStatusEnum::ACTIVE)->count();
        $not_active_complaints = Complaint::where('is_active', ActivationStatusEnum::NOT_ACTIVE)->count();
        $total_videos = Video::count();
        $total_faqs = Faq::count();
        $total_sites = Site::count();
        $rate = Setting::first()->rate;
        return view('home', compact('total_users', 'total_clients', 'total_complaints', 'active_complaints', 'not_active_complaints', 'total_videos', 'total_faqs', 'total_sites', 'rate'));
    }

    public function privacy(){
        return view('privacy');
    }
}
