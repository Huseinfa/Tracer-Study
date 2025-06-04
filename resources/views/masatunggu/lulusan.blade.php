<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="masa-tunggu" />
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Lulusan" />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3">Lulusan</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="p-3">
                                <form method="GET" action="{{ route('masa-tunggu.lulusan') }}">
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" name="search" id="search" class="form-control" placeholder="Cari nama lulusan..." value="{{ request('search') }}">
                                        <button type="submit" class="btn btn-primary ms-2">
                                            <i class="material-icons">search</i> Cari
                                        </button>
                                        @if(request('search'))
                                            <a href="{{ route('masa-tunggu.lulusan') }}" class="btn btn-outline-secondary ms-2">
                                                <i class="material-icons">clear</i> Reset
                                            </a>
                                        @endif
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIM</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Program Studi</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Lulus</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Pertama Bekerja</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Masa Tunggu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($lulusan->items() as $lulus)
                                            <tr>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $lulus->nim }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $lulus->nama_lulusan }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $lulus->prodi->nama_prodi ?? '-' }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $lulus->tanggal_lulus }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $lulus->kuisionerlulusan->tanggal_pertama_berkerja ?? '-' }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        @if($lulus->kuisionerlulusan && $lulus->kuisionerlulusan->tanggal_pertama_berkerja)
                                                            {{ \Carbon\Carbon::parse($lulus->tanggal_lulus)->diffInMonths($lulus->kuisionerlulusan->tanggal_pertama_berkerja) }} bulan
                                                        @else
                                                            -
                                                        @endif
                                                    </p>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-secondary">Belum ada data lulusan yang tersedia.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="p-3">
                                {{ $lulusan->appends(request()->query())->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth />
        </div>
    </main>
</x-layout>