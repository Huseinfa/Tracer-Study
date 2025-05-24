<x-layout bodyClass="bg-gradient-blue">

    <main class="main-content min-vh-100 d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 d-flex justify-content-center">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="img-fluid" style="max-width: 312px;">
                </div>
                <div class="col-md-6 text-center">
                    <div class="glass-card">
                        <h4 class="text-white text-center mb-4">Login</h4>
                        <form role="form" method="POST" action="{{ route('login') }}" class="text-start">
                            @csrf
                            @if (Session::has('status'))
                            <div class="alert alert-success alert-dismissible text-dark" role="alert">
                                <span class="text-sm">{{ Session::get('status') }}</span>
                                <button type="button" class="btn-close text-lg py-3 opacity-10"
                                    data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            @endif
                            <div class="mb-4 d-flex align-items-center">
                                <input type="text" class="form-control flex-grow-1" name="username" value="{{ old('username') }}" autocomplete="username" placeholder="Username">
                                <i class="fas fa-envelope text-white ms-2" style="font-size: 20px;"></i>
                            </div>
                            @error('username')
                            <p class="text-danger inputerror text-center">{{ $message }}</p>
                            @enderror
                            <div class="mb-4 d-flex align-items-center">
                                <input type="password" class="form-control flex-grow-1" name="password" value="{{ old('password') }}" placeholder="Password">
                                <i class="fas fa-lock text-white ms-2" style="font-size: 20px;"></i>
                            </div>
                            @error('password')
                            <p class="text-danger inputerror text-center">{{ $message }}</p>
                            @enderror
                            <div class="text-center mt-4">
                                <button type="submit" class="btn-login">LOGIN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @push('js')
    <script src="{{ asset('assets') }}/js/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Placeholder behavior
            $('input').each(function() {
                const $input = $(this);
                const placeholder = $input.attr('placeholder');
                if ($input.val() === '') {
                    $input.attr('placeholder', placeholder);
                }

                $input.on('focus', function() {
                    if ($input.val() === '') {
                        $input.attr('placeholder', '');
                    }
                });

                $input.on('blur', function() {
                    if ($input.val() === '') {
                        $input.attr('placeholder', placeholder);
                    }
                });
            });
        });
    </script>
    @endpush
</x-layout>