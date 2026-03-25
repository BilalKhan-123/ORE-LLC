 <section id="testimonials" class="testimonials section">

                <!-- Section Title -->
                <div class="container section-title" data-aos="fade-up">
                    <h2>Testimonials</h2>
                    <p>What our clients are saying about us</p>
                </div><!-- End Section Title -->

                <div class="container" data-aos="fade-up" data-aos-delay="100">

                    <div class="swiper init-swiper" data-speed="600" data-delay="5000" data-breakpoints="{ &quot;320&quot;: { &quot;slidesPerView&quot;: 1, &quot;spaceBetween&quot;: 40 }, &quot;1200&quot;: { &quot;slidesPerView&quot;: 3, &quot;spaceBetween&quot;: 40 } }">
                    <script type="application/json" class="swiper-config">
                        {
                        "loop": true,
                        "speed": 600,
                        "autoplay": {
                            "delay": 5000
                        },
                        "slidesPerView": "auto",
                        "pagination": {
                            "el": ".swiper-pagination",
                            "type": "bullets",
                            "clickable": true
                        },
                        "breakpoints": {
                            "320": {
                            "slidesPerView": 1,
                            "spaceBetween": 40
                            },
                            "1200": {
                            "slidesPerView": 3,
                            "spaceBetween": 20
                            }
                        }
                        }
                    </script>
                    <div class="swiper-wrapper">

                        @forelse($data['testimonials'] as $testimonial)
                        <div class="swiper-slide">
                        <div class="testimonial-item">
                        <p>
                        <i class="bi bi-quote quote-icon-left"></i>
                            <span>{{ $testimonial->comment }}</span>
                            <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                            @if($testimonial->image)
                                <img src="{{ asset('storage/' . $testimonial->image) }}" class="testimonial-img" alt="{{ $testimonial->name }}">
                            @else
                                <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="{{ $testimonial->name }}">
                            @endif
                            <h3>{{ $testimonial->name }}</h3>
                            <h4>{{ $testimonial->position ?? 'Client' }}</h4>
                        </div>
                        </div><!-- End testimonial item -->
                        @empty
                        <div class="swiper-slide">
                        <div class="testimonial-item">
                            <p class="text-center text-muted">No testimonials available at the moment.</p>
                        </div>
                        </div>
                        @endforelse

                    </div>
                    <div class="swiper-pagination"></div>
                    </div>

                </div>

            </section>