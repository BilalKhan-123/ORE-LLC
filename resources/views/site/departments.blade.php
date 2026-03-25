<section id="departments" class="tabs section">

                <!-- Section Title -->
                <div class="container section-title" data-aos="fade-up">
                    <h2>{{ __('messages.departments') }}</h2>
                    <p>{{ __('messages.tag_departments') }}</p>
                </div><!-- End Section Title -->

                <div class="container" data-aos="fade-up" data-aos-delay="100">

                    <div class="row">
                    <div class="col-lg-3">
                        <ul class="nav nav-tabs flex-column">
                        @forelse($data['departments'] as $key => $department)
                        <li class="nav-item">
                            <a class="nav-link {{ $key == 0 ? 'active show' : '' }}" data-bs-toggle="tab" href="#tabs-tab-{{ $key + 1 }}">{{ $department->title }}</a>
                        </li>
                        @empty
                        <li class="nav-item">
                            <span class="text-muted">{{ __('messages.no_departments') }}</span>
                        </li>
                        @endforelse
                        </ul>
                    </div>
                    <div class="col-lg-9 mt-4 mt-lg-0">
                        <div class="tab-content">
                        @forelse($data['departments'] as $key => $department)
                        <div class="tab-pane {{ $key == 0 ? 'active show' : '' }}" id="tabs-tab-{{ $key + 1 }}">
                            <div class="row">
                            <div class="col-lg-8 details order-2 order-lg-1">
                                <h3>{{ $department->title }}</h3>
                                <p class="fst-italic">{{ $department->sub_title ?? 'Professional department' }}</p>
                                {{-- <p>{!! $department->description ?? '' !!}</p> --}}
                            </div>
                            <div class="col-lg-4 text-center order-1 order-lg-2">
                                @if($department->main_image)
                                    <img src="{{ asset('storage/'.$department->main_image) }}" alt="{{ $department->title }}" class="img-fluid">
                                @else
                                    <img src="assets/img/departments-{{ $key + 1 }}.jpg" alt="{{ $department->title }}" class="img-fluid">
                                @endif
                            </div>
                            </div>
                        </div>
                        @empty
                        <div class="tab-pane active show">
                            <p class="text-left text-muted">{{ __('messages.no_departments') }}</p>
                        </div>
                        @endforelse
                        </div>
                    </div>
                    </div>

                </div>

            </section>