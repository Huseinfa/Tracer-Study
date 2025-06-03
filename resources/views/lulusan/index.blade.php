<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="lulusan" />
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Manajemen Lulusan" />

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3">Daftar Lulusan</h6>
                            </div>
                        </div>
                        <div class="me-3 my-3 text-end">
                            <a class="btn bg-gradient-dark mb-0" href="{{ route('lulusan.create') }}">
                                <i class="material-icons text-sm">add</i> Add New Lulusan
                            </a>
                            <a class="btn bg-gradient-success mb-0 mx-2" href="{{ route('lulusan.export.form') }}">
                                <i class="material-icons text-sm">file_download</i> Export
                            </a>
                            <a class="btn bg-gradient-primary mb-0" href="{{ route('lulusan.import.form') }}">
                                <i class="material-icons text-sm">file_upload</i> Import
                            </a>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIM</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Program Studi</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nomor HP</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Lulus</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lulusan as $item)
                                            <tr>
                                                <td>{{ $item->id_lulusan }}</td>
                                                <td>{{ $item->nim }}</td>
                                                <td>{{ $item->nama_lulusan }}</td>
                                                <td>{{ $item->prodi->nama_prodi ?? '-' }}</td>
                                                <td>{{ $item->email_lulusan }}</td>
                                                <td>{{ $item->no_hp_lulusan }}</td>
                                                <td>{{ $item->tanggal_lulus }}</td>
                                                <td class="align-middle text-center">
                                                <a class="btn btn-info btn-link" href="{{ route('lulusan.show', $item->id_lulusan) }}" title="Lihat Detail">
                                                    <i class="material-icons">visibility</i>
                                                </a>
                                                <a class="btn btn-success btn-link" href="{{ route('lulusan.edit', $item->id_lulusan) }}" title="Edit">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                <form action="{{ route('lulusan.destroy', $item->id_lulusan) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-link" title="Hapus" onclick="return confirm('Yakin ingin menghapus lulusan ini?');">
                                                        <i class="material-icons">delete</i>
                                                    </button>
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
            <x-footers.auth />
        </div>
</x-layout>
