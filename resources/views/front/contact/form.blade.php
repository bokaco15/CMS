<main class="col-lg-8">
    <div class="container">
        <form action="{{ route('front.contact.store') }}" method="post" class="commenting-form">
            @csrf

            {{-- SUCCESS --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            {{-- ERROR (npr. mail server fail) --}}
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row">
                {{-- NAME --}}
                <div class="form-group col-md-6">
                    <input type="text"
                           placeholder="Your Name"
                           class="form-control @error('name') is-invalid @enderror"
                           name="name"
                           value="{{ old('name') }}">

                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- EMAIL --}}
                <div class="form-group col-md-6">
                    <input type="email"
                           placeholder="Email Address (will not be published)"
                           name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}">

                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- MESSAGE --}}
                <div class="form-group col-md-12">
                    <textarea placeholder="Type your message"
                              class="form-control @error('message') is-invalid @enderror"
                              rows="20"
                              name="text_message">{{ old('text_message') }}</textarea>

                    @error('text_message')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group col-md-12">
                    <div class="g-recaptcha" data-sitekey="{{env('RECAPTCHA_SITE_KEY')}}"></div>
                </div>

                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-secondary">
                        Submit Your Message
                    </button>
                </div>
            </div>
        </form>
    </div>
</main>
