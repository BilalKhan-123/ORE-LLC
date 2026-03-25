<section id="faq" class="faq section light-background">

                <!-- Section Title -->
                <div class="container section-title" data-aos="fade-up">
                    <h2>{{ __('messages.faq') }}</h2>
                    <p>{{ __('messages.tag_faq') }}</p>
                </div><!-- End Section Title -->

                <div class="container">

                    <div class="row justify-content-center">

                    <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">

                        <div class="faq-container">

                        @forelse($data['faqs'] as $faq)
                        <div class="faq-item">
                            <h3>{{ $faq->question }}</h3>
                            <div class="faq-content">
                            <p>{{ $faq->short_answer ?? '' }}</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->
                        @empty
                        <div class="faq-item">
                            <p class="text-center text-muted">No FAQs available at the moment.</p>
                        </div>
                        @endforelse

                        </div>

                    </div><!-- End Faq Column-->

                    </div>

                </div>

            </section>