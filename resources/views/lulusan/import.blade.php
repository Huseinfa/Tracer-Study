<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="lulusan" />
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Import Lulusan" />

        <div class="container-fluid py-4">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card my-4">
                        <div class="card-header bg-gradient-primary text-white">
                            <h6 class="mb-0">Import Data Lulusan</h6>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('lulusan.import.form') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="file">Pilih File Excel / CSV</label>
                                    <input type="file" name="file" class="form-control" accept=".xls,.xlsx,.csv" required>
                                    <small class="text-muted">Format file yang didukung: .xls, .xlsx, .csv</small>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <button type="submit" class="btn bg-gradient-primary">Import</button>
                                    <a href="{{ route('lulusan.index') }}" class="btn btn-secondary">Kembali</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>
