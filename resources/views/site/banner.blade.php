 <!-- Hero Section -->
            <section id="hero" class="hero section">

                <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
                    @if($data['banners']->isEmpty() || $data['banners']->count() > 0)   
                        @foreach($data['banners'] as $key => $banner)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            @if($banner->main_image)
                                {{-- <img src="{{ asset(globalImageURL().'hero-carousel/' . $banner->main_image) }}" alt="{{ $banner->title ?? 'Banner Image' }}" class="d-block w-100"> --}}
                                <img src="{{ asset('storage/'.$banner->main_image) }} " alt="Banner Image" class="d-block w-100">
                            @else
                                <img src="assets/img/hero-carousel/hero-carousel-{{ $key + 1 }}.jpg" alt="{{ $banner->title ?? 'Banner Image' }}" class="d-block w-100">
                            @endif
                            <div class="container">
                                <h2>{{ $banner->title ?? 'Welcome to Medicio' }}</h2>
                                <p>{{ $banner->description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.' }}</p>
                                <a href="{{ route('site.about') }}" class="btn-get-started">{{ __('messages.about') }}</a>
                            </div>
                        </div><!-- End Carousel Item -->
                        @endforeach
                    @endif
                    
                    <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
                    </a>

                    <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
                    </a>

                    <ol class="carousel-indicators"></ol>

                </div>

            </section>
            <!-- /Hero Section -->