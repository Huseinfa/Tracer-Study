<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="admin"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Admin Details"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3">Admin Details</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <p><strong>ID admin:</strong> {{ $admin->id_user }}</p>
                                    <p><strong>Username:</strong> {{ $admin->username }}</p>
                                    <p><strong>Nama User:</strong> {{ $admin->nama_user }}</p>
                                    <tr>
                                        <th>Password</th>
                                        <td>********</td>
                                    </tr>
                                </div>
                            </div>
                            <a href="{{ route('admin.index') }}" class="btn btn-default">Back to List</a>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
</x-layout>