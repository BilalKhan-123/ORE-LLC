<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Services\SiteService;


class SiteController extends Controller
{

    public function __construct(private SiteService $siteService)
    {
        //
    }
    
    /**
     * Forget Password
     */
    public function siteIndex()
    {
        $data = $this->siteService->index();
        
        if($data && count($data) > 0){
            return view('site.index', compact('data'));
        }

        return view('site.index', compact('data'));
    }

    /**
     * Show About Page
     */
    public function siteAbout()
    {
        $data = $this->siteService->index();
        
        return view('site.about_detail', compact('data'));
    }

    /**
     * Show Services Page
     */
    public function siteServices()
    {
        $data = $this->siteService->index();

        return view('site.all-services', compact('data'));
    }

    /**
     * Show Services Page
     */
    public function siteServicesDetails($slug)
    {
        $data = $this->siteService->serviceDetails($slug);
        
        return view('site.service-details', compact('data'));
    }


    /**
     * Show Featured Services
     */
    public function siteFeaturedServices()
    {
        $data = $this->siteService->featuredServices();
        
        return view('site.all-featured-services', compact('data'));
    }

    /**
     * Show Departments Page
     */
    public function siteDepartments()
    {
        $data = $this->siteService->index();
        
        return view('site.all-departments', compact('data'));
    }

    /**
     * Show Departments Page
     */
    public function siteDepartmentsDetails($slug)
    {
        $data = $this->siteService->departmentDetails($slug);
        
        return view('site.department-details', compact('data'));
    }

    public function siteContact()
    {
        $data = $this->siteService->contactDetail();
        
        return view('site.contact-details', compact('data'));
    }

    /**
     * Show FAQs Page
     */
    public function siteFaqs()
    {
        $data = $this->siteService->index();
        
        return view('site.faq', compact('data'));
    }

    /**
     * Show Gallery Page
     */
    public function siteGallery()
    {
        $data = $this->siteService->index();
        
        return view('site.gallery', compact('data'));
    }

    /**
     * Show Testimonials Page
     */
    public function siteTestimonial()
    {
        $data = $this->siteService->index();
        
        return view('site.testimonials', compact('data'));
    }

    

}
