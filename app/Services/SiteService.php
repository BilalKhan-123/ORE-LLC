<?php

namespace App\Services;

use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Banner;
use App\Models\About;
use App\Models\Service;
use App\Models\Department;
use App\Models\Galary;
use App\Models\Faq;
use App\Models\Contact;
use App\Models\Testimonial;
use App\Helpers\Helper;
use App\Models\UserOtp;
use Illuminate\Support\Str;
use Request as RouteRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\User\Resource as UserResource;

class SiteService
{
    public function __construct(private Banner $bannerObj, private About $aboutObj, private Service $serviceObj, private Department $departmentObj, private Galary $galaryObj, private Faq $faqObj, private Contact $contactObj, private Testimonial $testimonialObj)
    {
        //
    }

    public function index()
    {
        DB::beginTransaction();
            $bannersData = $this->bannerObj->visible()->get();
            $aboutsData = $this->aboutObj->visible()->first();
            $servicesData = $this->serviceObj->visible()->get();
            $departmentsData = $this->departmentObj->visible()->get();
            $galleriesData = $this->galaryObj->visible()->get();
            $faqsData = $this->faqObj->visible()->get();
            $contactsData = $this->contactObj->visible()->first();
            $testimonialsData = $this->testimonialObj->visible()->get();
        DB::commit();

        // try {
        //     VerifyUserMail::dispatch($user, $otp);
        // } catch (\Exception $e) {
        //     Log::info('User verification mail failed.' . $e->getMessage());
        // }

        $data = [
            'banners' => $bannersData,
            'about' => $aboutsData,
            'services' => $servicesData,
            'departments' => $departmentsData,
            'galleries' => $galleriesData,
            'faqs' => $faqsData,
            'contacts' => $contactsData,
            'testimonials' => $testimonialsData,
        ];
        
        return $data;
    }

    public function serviceDetails($slug)
    {
        DB::beginTransaction();
            $bannersData = $this->bannerObj->visible()->get();
            $serviceData = $this->serviceObj->visible()->get();
            $serviceDetails = $this->serviceObj->where('slug', $slug)->visible()->first();
            $departmentsData = $this->departmentObj->visible()->get();
            $contactsData = $this->contactObj->visible()->first();
        DB::commit();

        // try {
        //     VerifyUserMail::dispatch($user, $otp);
        // } catch (\Exception $e) {
        //     Log::info('User verification mail failed.' . $e->getMessage());
        // }

        $data = [
            'banners' => $bannersData,
            'services' => $serviceData,
            'serviceDetails' => $serviceDetails,
            'departments' => $departmentsData,
            'contacts' => $contactsData,
        ];

        return $data;

    }

    public function featuredServices()
        {
            DB::beginTransaction();
                $bannersData = $this->bannerObj->visible()->get();
                $servicesData = $this->serviceObj->visible()->where('is_featured', 1)->get();
                $departmentsData = $this->departmentObj->visible()->get();
                $contactsData = $this->contactObj->visible()->first();
            DB::commit();
    
            // try {
            //     VerifyUserMail::dispatch($user, $otp);
            // } catch (\Exception $e) {
            //     Log::info('User verification mail failed.' . $e->getMessage());
            // }
    
            $data = [
                'banners' => $bannersData,
                'services' => $servicesData,
                'departments' => $departmentsData,
                'contacts' => $contactsData,
            ];
    
            return $data;  
        }

    public function departmentDetails($slug)
    {
        DB::beginTransaction();
            $bannersData = $this->bannerObj->visible()->get();
            $serviceData = $this->serviceObj->visible()->get();
            $departmentDetails = $this->departmentObj->where('slug', $slug)->visible()->first();
            $departmentsData = $this->departmentObj->visible()->get();
            $contactsData = $this->contactObj->visible()->first();
        DB::commit();

        // try {
        //     VerifyUserMail::dispatch($user, $otp);
        // } catch (\Exception $e) {
        //     Log::info('User verification mail failed.' . $e->getMessage());
        // }

        $data = [
            'banners' => $bannersData,
            'services' => $serviceData,
            'departmentDetails' => $departmentDetails,
            'departments' => $departmentsData,
            'contacts' => $contactsData,
        ];

        return $data;

    }

    public function contactDetail()
    {
        DB::beginTransaction();
            $bannersData = $this->bannerObj->visible()->get();
            $serviceData = $this->serviceObj->visible()->get();
            $departmentsData = $this->departmentObj->visible()->get();
            $contactsData = $this->contactObj->visible()->first();
        DB::commit();

        // try {
        //     VerifyUserMail::dispatch($user, $otp);
        // } catch (\Exception $e) {
        //     Log::info('User verification mail failed.' . $e->getMessage());
        // }

        $data = [
            'banners' => $bannersData,
            'services' => $serviceData,
            'departments' => $departmentsData,
            'contacts' => $contactsData,
        ];

        return $data;

    }

    


        
}
