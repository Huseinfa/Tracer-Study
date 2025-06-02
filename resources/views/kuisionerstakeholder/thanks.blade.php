@extends('layoutkuisioner.template')

@section('content')
    <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="card-header p-2">
            <h4>Survey Kepuasan Pengguna Lulusan</h4>
        </div>
        <div class="card-body p-3">
            <div class="text-center">
                <h4>Terima kasih telah mengisi survey kami.</h4>
                <p>Jawaban yang Anda berikan sangat bermanfaat bagi kami.</p>
                @if(session('info'))
                    <div class="alert alert-info">
                        {{ session('info') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
