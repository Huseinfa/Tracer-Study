<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="lulusan"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Lulusan Details"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3">Lulusan Details</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <p><strong>ID Program Studi:</strong> {{ $lulusan->id_program_studi }}</p>
                                    <p><strong>NIM:</strong> {{ $lulusan->nim }}</p>
                                    <p><strong>Nama Lulusan:</strong> {{ $lulusan->nama_lulusan }}</p>
                                    <p><strong>Email:</strong> {{ $lulusan->email }}</p>
                                    <p><strong>Nomor HP:</strong> {{ $lulusan->nomor_hp }}</p>
                                    <p><strong>Tahun Lulus:</strong> {{ $lulusan->tanggal_lulus }}</p>
                                </div>
                            </div>
                            <a href="{{ route('lulusan.index') }}" class="btn btn-default">Back to List</a>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
</x-layout>