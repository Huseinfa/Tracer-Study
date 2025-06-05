@extends('layoutkuisioner.template')

@section('content')
    <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="card-header p-2">
            <h4>Tracer Study</h4>
        </div>
        <div class="card-body p-3">
            <div class="text-center">
                <h4>Terima kasih telah mengisi survey kami.</h4>
                <p>Jawaban yang Anda berikan sangat bermanfaat bagi kami.</p>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            @if (session('error'))
                Swal.fire({
                    icon: 'info',
                    title: 'Perhatian!',
                    text: '{{ session('error') }}',
                    confirmButtonText: 'Tutup',
                    customClass: {
                        confirmButton: 'bg-gradient-secondary'
                    }
                });
            @endif
        });
    </script>
@endpush