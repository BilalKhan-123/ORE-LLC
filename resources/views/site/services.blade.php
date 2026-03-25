 <!-- Featured Services Section -->
            <section id="featured-services" class="featured-services section">

                 <!-- Section Title -->
                    <div class="container section-title" data-aos="fade-up">
                        <h2>{{ __('messages.featured_services') }}</h2>
                        <p>{{ __('messages.tag_featured_services') }}</p>
                    </div>
                <!-- End Section Title -->
                <div class="container">

                    <div class="row gy-4">
                        @php
                            $services = $data['services']->take(featuredServicesShowLimit());
                        @endphp
                        
                        @forelse($data['services']->where('is_featured', 1) as $key => $service)
                            <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="{{ ($key % 4) * 100 + 100 }}">
                                <a href="{{ route('site.services.details', $service->slug) }}" class="stretched-link">
                                    <div class="service-item position-relative">
                                        <div class="icon">
                                            <img src="{{ asset('storage/'.$service->logo) }} " 
                                                alt="{{ $service->title }}" 
                                                width="80" height="60" 
                                                class="rounded" 
                                                style="object-fit: cover;">
                                        </div>
                                        <h4>{{ $service->title }}</h4>
                                        <p class="stretched-link">{{ Str::limit($service->sub_title, 100) }}</p>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="col-12 text-center">
                                <p>{{ __('messages.no_services') }}</p>
                            </div>
                        @endforelse

                        @if($data['services']->where('is_featured', 1)->count() > featuredServicesShowLimit())
                            <div class="col-12 text-center mt-4">
                                <a href="{{ route('site.services.featured') }}" class="btn-read-more text-success">
                                    {{ __('messages.featured_services') ?? 'Featured Services' }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

            </section>
            <!-- /Featured Services Section -->

            <section id="services" class="services section">

                <!-- Section Title -->
                <div class="container section-title" data-aos="fade-up">
                    <h2>{{ __('messages.services') }}</h2>
                    <p>{{ __('messages.tag_services') }}</p>
                </div>
                <!-- End Section Title -->

                <div class="container">

                    <div class="row gy-4">
                        @php
                            $services = $data['services']->take(servicesShowLimit());
                        @endphp

                        @forelse($services as $key => $service)
                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($key % 3) * 100 + 100 }}">
                                <div class="service-item position-relative">
                                    <div class="icon" style="border-radius: 50px; overflow: hidden;">
                                        <img src="{{ asset('storage/'.$service->logo) }}" 
                                            alt="{{ $service->title }}" 
                                            width="80" height="60" 
                                            class="rounded" 
                                            style="object-fit: cover;">
                                    </div>
                                    <a href="{{ route('site.services.details', $service->slug) }}" class="stretched-link">
                                        <h3>{{ $service->title }}</h3>
                                        @if($service->is_featured) <small class="badge bg-success rounded-pill"">{{ __('messages.featured') }}</small>@endif
                                    </a>
                                    <p>{{ Str::limit($service->sub_title, 250) }}</p>
                                </div>
                            </div><!-- End Service Item -->
                        @empty
                            <div class="col-12 text-center">
                                <p>{{ __('messages.no_services') }}</p>
                            </div>
                        @endforelse

                        {{-- Show "All Services" button if more than 6 --}}
                        @if($data['services']->count() > servicesShowLimit())
                            <div class="col-12 text-center mt-4">
                                <a href="{{ route('site.services') }}" class="btn-read-more text-success">
                                    {{ __('messages.all_services') ?? 'All Services' }}
                                </a>
                            </div>
                        @endif

                    </div>
                </div>

            </section>