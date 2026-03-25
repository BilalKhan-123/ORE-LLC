<footer id="footer" class="footer light-background">

    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about">
            <a href="#about" class="logo d-flex align-items-center">
                <span class="sitename">{{ config('site.siteTitle') }}</span>
            </a>
            <div class="footer-contact pt-3">
                <p>{{ $data['contacts']->address ?? '' }}</p>
                {{-- <p>New York, NY 535022</p> --}}
                @php
                    $phones = [];

                    if (!empty($data['contacts']->phone_1)) {
                        $phones[] = $data['contacts']->phone_1;
                    }
                    if (!empty($data['contacts']->phone_2)) {
                        $phones[] = $data['contacts']->phone_2;
                    }
                    if (!empty($data['contacts']->phone_3)) {
                        $phones[] = $data['contacts']->phone_3;
                    }
                @endphp
                @php
                    $emails = [];

                    if (!empty($data['contacts']->email_1)) {
                        $emails[] = $data['contacts']->email_1;
                    }
                    if (!empty($data['contacts']->email_2)) {
                        $emails[] = $data['contacts']->email_2;
                    }
                    if (!empty($data['contacts']->email_3)) {
                        $emails[] = $data['contacts']->email_3;
                    }
                @endphp
                <p class="mt-3"><strong>{{ __('messages.phone') }}:</strong> <span>{{ !empty($phones) ? implode(' | ', $phones) : __('messages.phone_number') }}</span></p>
                <p><strong>{{ __('messages.email') }}:</strong> <span>{{ !empty($emails) ? implode(' | ', $emails) : __('messages.email_address') }}</span></p>
            </div>
            {{-- https://via.placeholder.com/1200x600.png/00ff55?text=eos
            http://ore-llc.ddev.site/assets/img/icons/logo.svg --}}
            <div class="social-links d-flex mt-4">
                <a href=""><i class="bi bi-twitter-x"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
            <h4>{{ __('messages.usefull_links') }}</h4>
            <ul>
                <li><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
                <li><a href="{{ route('site.about') }}">{{ __('messages.about') }}</a></li>
                <li><a href="{{ route('site.services') }}">{{ __('messages.services') }}</a></li>
                <li><a href="{{ route('site.departments') }}">{{ __('messages.departments') }}</a></li>
                <li><a href="{{ route('site.contact') }}">{{ __('messages.contact') }}</a></li>
                {{-- <li><a href="#">Terms of service</a></li>
                <li><a href="#">Privacy policy</a></li> --}}
            </ul>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
            <h4>{{ __('messages.our_services') }}</h4>
            <ul>
                @if(!empty($data['services']) && $data['services']->count() > 0)
                    @foreach ($data['services']->slice(0, 5) as $service)
                        <li><a href="{{ route('site.services.details',$service->slug) }}">{{ $service->title }}</a></li>
                    @endforeach
                @else
                    <li><a href="#">{{ __('messages.no_services') }}</a></li>
                @endif
            </ul>

            </div>

            <div class="col-lg-2 col-md-3 footer-links">
            <h4>{{ __('messages.our_departments') }}</h4>
            <ul> 
                @if($data['departments']->count() > 0)
                    @foreach ($data['departments']->slice(0, 5) as $department)
                        <li><a href="{{ route('site.departments.details',$department->slug) }}">{{ $department->title }}</a></li>
                    @endforeach
                @else
                    <li><a href="#">{{ __('messages.no_departments') }}</a></li>
                @endif
            </ul>
             
            </div>

        </div>
    </div>

    <div class="container copyright text-center mt-4">
        <p>© <span>{{ __('messages.copyright') }} {{ date('Y') }}</span> <strong class="px-1 sitename">{{ config('site.siteTitle') }}</strong> <span>{{ __('messages.all_rights_reserved') }}</span></p>
        <div class="credits">
            {{ __('messages.designed_by') }} <a href="https://www.linkedin.com/in/bilal-khan-bk1992/">Bilal</a> | <a href="https://www.linkedin.com/in/bilal-khan-bk1992/">Khan</a>
        </div>
    </div>

</footer>