<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="admin" />
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Admin Management" />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3">Daftar Admin</h6>
                            </div>
                        </div>
                        <div class="me-3 my-3 text-end">
                            <a class="btn bg-gradient-dark mb-0" href="{{ route('admin.create') }}">
                                <i class="material-icons text-sm">add</i> Add New Administrator
                            </a>
                            <a class="btn bg-gradient-success mb-0 mx-2" href="{{ route('admin.export') }}">
                                <i class="material-icons text-sm">file_download</i> Export
                            </a>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-sm fw-semibold ps-2">ID</th>
                                            <th class="text-uppercase text-secondary text-sm fw-semibold ps-2">Username</th>
                                            <th class="text-uppercase text-secondary text-sm fw-semibold ps-2">Nama User</th>
                                            <th class="text-center text-uppercase text-secondary text-sm fw-semibold">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($admins as $admin)
                                            <tr>
                                                <td class="ps-2">{{ $admin->id_user }}</td>
                                                <td class="ps-2">{{ $admin->username }}</td>
                                                <td class="ps-2">{{ $admin->nama_user }}</td>
                                                <td class="align-middle text-center">
                                                    <a class="btn btn-info btn-link" href="{{ route('admin.show', $admin->id_user) }}" title="Lihat Detail">
                                                        <i class="material-icons">visibility</i>
                                                    </a>
                                                    <a class="btn btn-success btn-link" href="{{ route('admin.edit', $admin->id_user) }}" title="Edit">
                                                        <i class="material-icons">edit</i>
                                                    </a>
                                                    <form action="{{ route('admin.destroy', $admin->id_user) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-link" title="Hapus" onclick="return confirm('Yakin ingin menghapus admin ini?');">
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
    </main>
</x-layout>