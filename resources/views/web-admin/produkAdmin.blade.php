@extends('web-admin.layout-admin.master')

@section('content-admin')
    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
        id="layout-navbar">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                    <div style="margin-top: 1px">Produk</div>
                </div>
            </div>
            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->


                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            <i class='bx bxs-user-circle'
                                style='color:#ff3131;scale: 2;margin-top: 10px;margin-left: 10px'></i>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">

                                    <div class="flex-grow-1">
                                        <span class="fw-semibold d-block">{{ Auth::user()->username }}</span>
                                        <small class="text-muted">Admin</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/profile">
                                <i class="bx bx-user me-2"></i>
                                <span class="align-middle">Profile Saya</span>
                            </a>
                        </li>

                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <form action="{{ url('/logout') }}" method="POST">
                                @csrf
                                <button
                                    style="background-color: transparent;margin-left: 0rem;border: none;cursor: pointer;display: flex;justify-content: start
                ;align-items: center"
                                    class="dropdown-item" href="auth-login-basic.html">
                                    <i class="bx bx-power-off me-2"></i>
                                    <span class="align-middle">Keluar</span>
                                    </a>
                            </form>
                        </li>
                    </ul>
                </li>
                <!--/ User -->
            </ul>
        </div>
    </nav>
    @if (session('success'))
        <script>
            Toastify({
                text: "{{ session('success') }}",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#006b0c",
                stopOnFocus: true,
            }).showToast();
        </script>
    @endif
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tabel /</span> Tabel Produk</h4>
            <button class="btn mb-3" data-bs-toggle="modal" data-bs-target="#addData"
                style="background-color: #ff3131;color: white">Tambah Produk</button>
            <!-- Modal -->
            <div class="modal fade" id="addData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Produk</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('produk-add-admin') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Foto produk</label>
                                    <input name="foto_produk" required class="form-control" type="file" id="formFile">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Nama Produk</label>
                                    <input name="motif" required type="text" class="form-control"
                                        id="exampleInputPassword1">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Title</label>
                                    <input name="title" required type="text" class="form-control"
                                        id="exampleInputPassword1">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Sub title</label>
                                    <input name="sub_title" required type="text" class="form-control"
                                        id="exampleInputPassword1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Harga</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">IDR</span>
                                        <input name="harga" required type="number" class="form-control"
                                            aria-label="Harga">
                                        <span class="input-group-text"></span>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <h5 class="card-header">Tabel Produk</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Nama Produk</th>
                                <th>Title</th>
                                <th>Subtitle</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($data as $item)
                                <tr>
                                    <td><img src="{{ asset($item->foto_produk) }}" width="30" alt="">

                                    </td>
                                    <td> <strong style="margin-left: 10px">{{ $item->motif }}</strong></td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->sub_title }}</td>
                                    <td>
                                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <button data-bs-toggle="modal"
                                                    data-bs-target="#edit-{{ $item->id }}" style="border: none;
                                                    background: transparent" class="dropdown-item">
                                                    <i class="bx bx-edit me-1"></i> Edit
                                                </button>
                                                <button data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal-{{ $item->id }}"
                                                    style="border: none; background: transparent" class="dropdown-item">
                                                    <i class="bx bx-trash me-1"></i> Delete
                                                </button>


                                            </div>
                                    </td>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal-{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus
                                                        Produk</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus produk ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                    <form action="{{ url('produk-delete-admin/' . $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="edit-{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus
                                                        Produk</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                  <form action="{{ url('produk-update-admin/'.$item->id) }}" method="post" enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf
                                                    <div class="mb-3">
                                                        <label for="formFile" class="form-label">Foto produk</label>
                                                        <input name="foto_produk"  class="form-control"
                                                            type="file" id="formFile">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1"
                                                            class="form-label">Nama Produk</label>
                                                        <input value="{{ $item->motif }}" name="motif" required type="text"
                                                            class="form-control" id="exampleInputPassword1">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1"
                                                            class="form-label">Title</label>
                                                        <input name="title" required type="text"
                                                           value="{{ $item->title }}" class="form-control" id="exampleInputPassword1">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label">Sub
                                                            title</label>
                                                        <input value="{{ $item->sub_title }}" name="sub_title" required type="text"
                                                            class="form-control" id="exampleInputPassword1">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1"
                                                            class="form-label">Harga</label>
                                                        <div class="input-group mb-3">

                                                            <span class="input-group-text">IDR</span>
                                                            <input value="{{ $item->harga }}" name="harga" required type="number"
                                                                class="form-control" aria-label="Harga">
                                                            <span class="input-group-text"></span>
                                                        </div>
                                                    </div>
                                                        <button type="submit" class="btn btn-danger">Edit Data</button>
                                                </form>

                                                </div>
                                              
                                            </div>
                                        </div>
                                    </div>

                </div>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data</td>
                </tr>
                @endforelse





                </tbody>
                </table>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->


        <div class="content-backdrop fade"></div>
    </div>
@endsection
