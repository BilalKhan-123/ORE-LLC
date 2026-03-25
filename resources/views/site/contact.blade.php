
    <section id="contact" class="contact section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>{{ __('messages.contact') }}</h2>
            <p>{{ __('messages.tag_contact') }}</p>
        </div>
        @if(!empty($data['contacts']) && $data['contacts']->is_show == 1)
        <!-- End Section Title -->
        <div class="mb-5" data-aos="fade-up" data-aos-delay="200">
           <div class="mb-5" data-aos="fade-up" data-aos-delay="200"> 
                @if(!empty($data['contacts']->map))
                     <iframe style="border:0; width: 100%; height: 370px;" src="{{ $data['contacts']->map  }}" frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                @else
                    <p class="text-center text-muted">No map URL provided.</p>
                @endif
            </div>
        <!-- End Google Maps -->
        </div>
        <!-- End Google Maps -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">
                <div class="col-lg-12 ">
                    <div class="row gy-4">
                    
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
                    <div class="col-lg-12">
                        <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
                        <i class="bi bi-geo-alt"></i>
                        <h3>{{ __('messages.address') }}</h3>
                        <p>{{ $data['contacts']->address ?? '' }}</p>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="col-md-6">
                        <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
                        <i class="bi bi-telephone"></i>
                        <h3>{{ __('messages.call_us') }}</h3>
                        <p>{{ !empty($phones) ? implode(' | ', $phones) : __('messages.phone_number') }}</p>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="col-md-6">
                        <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400">
                        <i class="bi bi-envelope"></i>
                        <h3>{{ __('messages.email_us') }}</h3>
                        <p>{{ !empty($emails) ? implode(' | ', $emails) : __('messages.email_address') }}</p>
                        </div>
                    </div><!-- End Info Item -->

                    </div>
                </div>

            {{-- <div class="col-lg-6">
                <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="500">
                <div class="row gy-4">
                    <h3><strong>{{ __('messages.contact_form_title') }}</strong></h3>
                    <div class="col-md-6">
                    <input type="text" name="name" class="form-control" placeholder="{{ __('messages.your_name') }}" required="">
                    </div>

                    <div class="col-md-6 ">
                    <input type="email" class="form-control" name="email" placeholder="{{ __('messages.your_email') }}" required="">
                    </div>

                    <div class="col-md-12">
                    <input type="text" class="form-control" name="subject" placeholder="{{ __('messages.subject') }}" required="">
                    </div>

                    <div class="col-md-12">
                    <textarea class="form-control" name="message" rows="4" placeholder="{{ __('messages.message') }}" required=""></textarea>
                    </div>

                    <div class="col-md-12 text-center">
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your message has been sent. Thank you!</div>

                    <button type="submit">{{ __('messages.send_message') }}</button>
                    </div>

                </div>
                </form>
            </div> --}}
            <!-- End Contact Form -->

            </div>

        </div>
        @else
            <div class="col-12 text-center">
                <p>{{ __('messages.no_record_found') }}</p>
            </div>

        @endif

    </section>
