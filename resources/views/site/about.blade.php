 <!-- About Section -->
            <section id="about" class="about section">

                <!-- Section Title -->
                <div class="container section-title" data-aos="fade-up">
                    <h2>{{ __('messages.about_us') }}<br></h2>
                    <p>{{  __('messages.tag_about') }}</p>
                </div><!-- End Section Title -->

                @if(!empty($data['about']) && $data['about']->is_show == 1)  
                <div class="container">
                    <div class="row gy-4">
                        <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="100">
                            @if($data['about']->main_image)
                                {{-- <img src="{{ asset(globalImageURL().'about/' . $data['about']->main_image) }}" class="img-fluid" alt="About Image"> --}}
                                <img src="{{ asset('storage/'.$data['about']->main_image) }}" class="img-fluid" alt="About Image">
                            @else
                                <img src="assets/img/about.jpg" class="img-fluid" alt="">
                            @endif
                            @if($data['about']->video_url)
                                <a href="{{ $data['about']->video_url }}" class="glightbox pulsating-play-btn"></a>
                            @endif
                        </div>
                        <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="200">
                            <h3>{{ $data['about']->title ?? 'About Our Organization' }}</h3>
                            <p class="fst-italic py-3">
                            {{ $data['about']->sub_title ?? 'Discover what makes us unique' }}
                            </p>
                           @if(!empty($data['about']->description))
                                @php
                                    $description = $data['about']->first()->description;
                                    $wordCount = str_word_count(strip_tags($description));
                                    $preview = \Illuminate\Support\Str::words(strip_tags($description), 100, '...');
                                @endphp

                                <div class="about-description">
                                    {!! nl2br(e($preview)) !!}
                                </div>

                                @if($wordCount > 100)
                                    <a href="{{ route('site.about') }}" class="btn-read-more text-success">
                                        {{ __('messages.read_more') }}
                                    </a>
                                @endif
                            @endif



                        </div>
                    </div>

                </div>
                @else
                    <<div class="container">
                        <div class="row gy-4">
                            <div class="col-12 text-center">
                                <p>{{ __('messages.no_record_found') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

            </section>
            <!-- /About Section -->