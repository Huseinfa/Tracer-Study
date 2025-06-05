<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="stakeholder"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Stakeholder Management"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3">Stakeholder Management</h6>
                            </div>
                        </div>
                        <div class="me-3 my-3 text-end">
                            <a class="btn bg-gradient-success mb-0 mx-2" href="{{ route('stakeholder.export') }}">
                                <i class="material-icons text-sm">file_download</i> Export
                            </a>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
                                        <tr>
                                            <th class="text-uppercase text-secondary text-sm fw-semibold ps-2">ID</th>
                                            <th class="text-uppercase text-secondary text-sm fw-semibold ps-2">Nama Atasan</th>
                                            <th class="text-uppercase text-secondary text-sm fw-semibold ps-2">Instansi</th>
                                            <th class="text-uppercase text-secondary text-sm fw-semibold ps-2">Jabatan</th>
                                            <th class="text-uppercase text-secondary text-sm fw-semibold ps-2">Email</th>
                                            <th class="text-center text-uppercase text-secondary text-sm fw-semibold">Aksi</th></tr>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($stakeholders as $stakeholder)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="mb-0 text-sm">{{ $stakeholder->id_stakeholder }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $stakeholder->nama_atasan }}</h6>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs text-secondary mb-0">{{ $stakeholder->instansi }}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="text-secondary text-xs font-weight-bold">{{ $stakeholder->jabatan }}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs text-secondary mb-0">{{ $stakeholder->email }}</p>
                                                </td>
                                                <td class="align-middle">
                                                    <a rel="tooltip" class="btn btn-info btn-link" href="{{ route('stakeholder.show', $stakeholder->id_stakeholder) }}" data-original-title="" title="View">
                                                        <i class="material-icons">visibility</i>
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
</x-layout>