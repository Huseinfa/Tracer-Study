<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="stakeholder"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Stakeholder Details"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3">Stakeholder Details</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <p><strong>ID Stakeholder:</strong> {{ $stakeholder->id_stakeholder }}</p>
                                    <p><strong>Nama Atasan:</strong> {{ $stakeholder->nama_atasan }}</p>
                                    <p><strong>Instansi:</strong> {{ $stakeholder->instansi }}</p>
                                    <p><strong>Jabatan:</strong> {{ $stakeholder->jabatan }}</p>
                                    <p><strong>Email:</strong> {{ $stakeholder->email }}</p>
                                </div>
                            </div>
                            <a href="{{ route('stakeholder.index') }}" class="btn btn-default">Back to List</a>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
</x-layout>