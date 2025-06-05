<x-layout bodyClass="bg-gray-200">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <x-navbars.navs.guest></x-navbars.navs.guest>
            </div>
        </div>
    </div>
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-100"
            style="background-image: url('{{ asset('assets') }}/img/joshua-hoehne-iggWDxHTAUQ-unsplash.jpg');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container-fluid my-auto">
                <div class="row signin-margin">
                    <div class="card col-md-6 mx-auto">
                        <div class="z-index-0 fadeIn3 fadeInBottom">
                            <div class="row">
                                <div class="col">
                                    <div class="card-head">
                                        <div class="bg-gradient-info position-relative z-index-2 shadow p-5" style="margin: -2rem -2rem -2rem -2rem; border-radius: 1.5rem;">
                                            <img src="{{ asset('assets') }}/img/logo.png" alt="logo-tracer" class="w-100">
                                        </div>
                                    </div>
                                </div>

                                <div class="col d-flex flex-column justify-content-center">
                                    <form role="form" method="POST" action="{{ route('login') }}" class="text-start px-4">
                                        @csrf
                                        @if (Session::has('status'))
                                        <div class="alert alert-success alert-dismissible text-white" role="alert">
                                            <span class="text-sm">{{ Session::get('status') }}</span>
                                            <button type="button" class="btn-close text-lg py-3 opacity-10"
                                                data-bs-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @endif
                                        <h4 class="text-center">Sign In</h4>
                                        <div class="input-group input-group-outline my-4">
                                            <label class="form-label">Username</label>
                                            <input type="text" class="form-control" name="username" value="{{ old('username') }}">
                                        </div>
                                        @error('username')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                        <div class="input-group input-group-outline my-4">
                                            <label class="form-label">Password</label>
                                            <input type="password" class="form-control" name="password" value='{{ old('password') }}'>
                                        </div>
                                        @error('password')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-info w-100 my-4 mb-2">Sign
                                                in</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.guest></x-footers.guest>
        </div>
    </main>
</x-layout>

@push('js')
    <script src="{{ asset('assets') }}/js/jquery.min.js"></script>
    <script>
        $(function() {
            var text_val = $(".input-group input").val();
            if (text_val === "") {
                $(".input-group").removeClass('is-filled');
            } else {
                $(".input-group").addClass('is-filled');
            }
        });
    </script>
@endpush
