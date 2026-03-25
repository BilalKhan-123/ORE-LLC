<section id="gallery" class="gallery section">

                <!-- Section Title -->
                <div class="container section-title" data-aos="fade-up">
                    <h2>{{ __('messages.gallery') }}<br></h2>
                    <p>{{ __('messages.tag_gallery') }}</p>
                </div><!-- End Section Title -->

                <div class="container" data-aos="fade-up" data-aos-delay="100">
                    <style>
                        .gallery-img {
                            width: 100%;          /* fill container width */
                            height: 200px;        /* fixed height (adjust as needed) */
                            object-fit: cover;    /* crop to fit without distortion */
                            border-radius: 6px;   /* optional styling */
                        }

                    </style>
                    <div class="swiper init-swiper">
                    <script type="application/json" class="swiper-config">
                        {
                        "loop": true,
                        "speed": 600,
                        "autoplay": {
                            "delay": 5000
                        },
                        "slidesPerView": "auto",
                        "centeredSlides": true,
                        "pagination": {
                            "el": ".swiper-pagination",
                            "type": "bullets",
                            "clickable": true
                        },
                        "breakpoints": {
                            "320": {
                            "slidesPerView": 1,
                            "spaceBetween": 0
                            },
                            "768": {
                            "slidesPerView": 3,
                            "spaceBetween": 20
                            },
                            "1200": {
                            "slidesPerView": 5,
                            "spaceBetween": 20
                            }
                        }
                        }
                    </script>
                    <div class="swiper-wrapper align-items-center">
                        {{-- <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/gallery-1.jpg"><img src="assets/img/gallery/gallery-1.jpg" class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/gallery-2.jpg"><img src="assets/img/gallery/gallery-2.jpg" class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/gallery-3.jpg"><img src="assets/img/gallery/gallery-3.jpg" class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/gallery-4.jpg"><img src="assets/img/gallery/gallery-4.jpg" class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/gallery-5.jpg"><img src="assets/img/gallery/gallery-5.jpg" class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/gallery-6.jpg"><img src="assets/img/gallery/gallery-6.jpg" class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/gallery-7.jpg"><img src="assets/img/gallery/gallery-7.jpg" class="img-fluid" alt=""></a></div>
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/gallery-8.jpg"><img src="assets/img/gallery/gallery-8.jpg" class="img-fluid" alt=""></a></div>
                         --}}
                        @if($data['galleries']->isEmpty() || $data['galleries']->count() > 0)   
                            @foreach($data['galleries'] as $gallery)
                                <div class="swiper-slide">
                                    <a class="glightbox" data-gallery="images-gallery" href="{{ asset('storage/'.$gallery->main_image) }}">
                                        {{-- <img src="{{ asset($gallery->main_image) }}" 
                                            class="gallery-img" 
                                            alt="{{ $gallery->title ?? 'Gallery Image' }}"> --}}
                                         <img src="{{ asset('storage/'.$gallery->main_image) }}" 
                                            class="gallery-img" 
                                            alt="{{ $gallery->title ?? 'Gallery Image' }}">
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <div class="swiper-slide">
                                <span class="text-muted">No gallery images available.</span>    
                        @endif
                    </div>
                    <div class="swiper-pagination"></div>
                    </div>

                </div>

            </section>