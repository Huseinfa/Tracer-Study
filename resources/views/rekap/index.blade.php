<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="rekap" />
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Rekap Lulusan" />

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3">Sebaran Lingkup Tempat Kerja dan Kesesuaian Profesi</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive px-3">
                                <table class="table table-bordered align-items-center mb-0 text-center" style="table-layout: fixed;">
                                    <thead class="table-primary">
                                        <tr>
                                            <th rowspan="2">Tahun Lulus</th>
                                            <th rowspan="2">Jumlah Lulusan</th>
                                            <th rowspan="2">Terlacak</th>
                                            <th rowspan="2">Bidang Infokom</th>
                                            <th rowspan="2">Non Infokom</th>
                                            <th colspan="3">Lingkup Tempat Kerja</th>
                                        </tr>
                                        <tr>
                                            <th>Multinasional</th>
                                            <th>Nasional</th>
                                            <th>Wirausaha</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total = [
                                                'jumlah_lulusan' => 0, 'terlacak' => 0, 'bidang_infokom' => 0,
                                                'non_infokom' => 0, 'multinasional' => 0, 'nasional' => 0, 'wirausaha' => 0
                                            ];
                                        @endphp

                                        @foreach ($data as $row)
                                            @php
                                                $total['jumlah_lulusan'] += $row->jumlah_lulusan;
                                                $total['terlacak'] += $row->terlacak;
                                                $total['bidang_infokom'] += $row->bidang_infokom;
                                                $total['non_infokom'] += $row->non_infokom;
                                                $total['multinasional'] += $row->multinasional;
                                                $total['nasional'] += $row->nasional;
                                                $total['wirausaha'] += $row->wirausaha;
                                            @endphp
                                            <tr>
                                                <td>{{ $row->tahun }}</td>
                                                <td>{{ $row->jumlah_lulusan }}</td>
                                                <td>{{ $row->terlacak }}</td>
                                                <td>{{ $row->bidang_infokom }}</td>
                                                <td>{{ $row->non_infokom }}</td>
                                                <td>{{ $row->multinasional }}</td>
                                                <td>{{ $row->nasional }}</td>
                                                <td>{{ $row->wirausaha }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="fw-bold bg-light">
                                        <tr>
                                            <td>Jumlah</td>
                                            <td>{{ $total['jumlah_lulusan'] }}</td>
                                            <td>{{ $total['terlacak'] }}</td>
                                            <td>{{ $total['bidang_infokom'] }}</td>
                                            <td>{{ $total['non_infokom'] }}</td>
                                            <td>{{ $total['multinasional'] }}</td>
                                            <td>{{ $total['nasional'] }}</td>
                                            <td>{{ $total['wirausaha'] }}</td>
                                        </tr>
                                    </tfoot>
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