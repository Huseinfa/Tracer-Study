<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="masa-tunggu" />
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Rata-rata Masa Tunggu" />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3">Rata-rata Masa Tunggu</h6>
                            </div>
                        </div>
                        </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="p-3">
                                <form method="GET" action="{{ route('masa-tunggu.rata-rata') }}">
                                        <div class="d-flex align-items-center">
                                            <div class="input-group input-group-outline mb-0 me-2" style="width: 200px;">
                                                <select name="year" id="year" class="form-control">
                                                    <option value="">Semua Tahun</option>
                                                    @foreach($years as $year)
                                                    <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="material-icons">filter_list</i> Filter
                                            </button>
                                            @if($selectedYear)
                                                <a href="{{ route('masa-tunggu.rata-rata') }}" class="btn btn-outline-secondary ms-2">
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
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tahun Lulus</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah Lulusan</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah Lulusan yang Terlacak</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rata-rata Waktu Tunggu (Bulan)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data as $row)
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $row->tahun_lulus }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $row->jumlah_lulusan }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $row->jumlah_terlacak }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ number_format($row->rata_rata_tunggu ?? 0, 2) }}</p>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-secondary">Belum ada data rata-rata masa tunggu yang tersedia.</td>
                                        </tr>
                                        @endforelse
                                        <tr class="table-secondary">
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0"><strong>Jumlah</strong></p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $totals['jumlah_lulusan'] }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $totals['jumlah_terlacak'] }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ number_format($totals['rata_rata_tunggu'] ?? 0, 2) }}</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth />
        </div>
    </main>
</x-layout>