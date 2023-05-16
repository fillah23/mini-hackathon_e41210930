@extends('backend/layouts.template')
@section('content')


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="card text-center">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#basicModal">
                                Tambah Budaya
                            </button>
                        </li>
                    </ul>
                    
                    <!-- Show success or error message after form submission -->
                    @if(session('success'))
                    <br>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    {{-- modal tambah --}}
                    <div class="modal fade" id="basicModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Budaya</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form id="budaya_form" method="POST"
                                    action="{{ route('budaya.store') }}">
                                    @csrf
                                    <div class="modal-body">

                                        <div class="form-group mb-3">
                                            <label for="nama">Nama </label>
                                            <input type="text" class="form-control" name="nama" id="nama" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="deskripsi">deskripsi </label>
                                            <input type="text" class="form-control" name="deskripsi" id="deskripsi" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="lokasi">lokasi </label>
                                            <input type="text" class="form-control" name="lokasi" id="lokasi" required>
                                        </div>

                                       

                                        <div class="form-group mb-3">
                                            <label for="tahun_ditemukan">Tahun Ditemukan</label>
                                            <input type="number" class="form-control" name="tahun_ditemukan"
                                                id="tahun_ditemukan" min="1900" max="{{ date('Y') }}" required>
                                        </div>

                                    

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <h5 class="card-title">Pendidikan</h5>
                {{-- data Pendidikan --}}
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama </th>
                                <th>Deskripsi</th>
                                <th>Lokasi</th>
                                <th>Tahun Ditemukan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($budayas as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>
                                    {{ $item->deskripsi }}
                                </td>
                                <td>{{ $item->lokasi }}</td>
                                <td>{{ $item->tahun_ditemukan }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editModal-{{ $item->id }}">
                                        Edit
                                    </button>
                                    <form action="{{ route('budaya.destroy', $item->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            {{-- // modal edit --}}
                            <div class="modal fade" id="editModal-{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Pendidikan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form id="edit_budaya_form" method="POST"
                                            action="{{ route('budaya.update', $item->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">

                                                <div class="form-group mb-3">
                                                    <label for="nama">Nama Budaya</label>
                                                    <input type="text" class="form-control" name="nama" id="nama"
                                                        value="{{ $item->nama }}" required>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="deskripsi">Deskripsi</label>
                                                    <input type="text" class="form-control" name="deskripsi" id="deskripsi"
                                                        value="{{ $item->deskripsi }}" required>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="lokasi">lokasi</label>
                                                    <input type="text" class="form-control" name="lokasi" id="lokasi"
                                                        value="{{ $item->lokasi }}" required>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="tahun_ditemukan">Tahun Ditemukan</label>
                                                    <input type="number" class="form-control" name="tahun_ditemukan"
                                                        id="tahun_ditemukan" min="1900" max="{{ date('Y') }}"
                                                        value="{{ $item->tahun_ditemukan }}" required>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    @endsection
    <section class="section dashboard">
        <div class="row">
            <div class="card">

            </div>
        </div>
    </section>


</main>

@section('scripts')
<script>
    // Initialize form validation on the registration form.
    // It has the name attribute "registration"
    $("form[name='pendidikan_form']").validate({
        // Specify validation rules
        rules: {
            nama: "required",
            jabatan: "required",
            tahun_masuk: {
                required: true,
                digits: true,
                min: 1900,
                max: parseInt(new Date().getFullYear())
            },
            tahun_keluar: {
                required: true,
                digits: true,
                min: 1900,
                max: parseInt(new Date().getFullYear())
            }
        },

        // Specify validation error messages
        messages: {
            nama: "Mohon isi nama perusahaan",
            jabatan: "Mohon isi jabatan",
            tahun_masuk: {
                required: "Mohon isi tahun masuk",
                digits: "Mohon isi tahun dengan angka",
                min: "Tahun masuk tidak valid",
                max: "Tahun masuk tidak valid"
            },
            tahun_keluar: {
                required: "Mohon isi tahun keluar",
                digits: "Mohon isi tahun dengan angka",
                min: "Tahun keluar tidak valid",
                max: "Tahun keluar tidak valid"
            }
        },

        // Specify submit handler
        submitHandler: function (form) {
            // Submit the form via Ajax
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function (response) {
                    // Show success message
                    $('#pendidikan_form')[0].reset();
                    $('.alert-success').fadeIn().html(response.message);
                },
                error: function (xhr) {
                    // Show error message
                    var errors = xhr.responseJSON.errors;
                    var errorString = '';
                    $.each(errors, function (key, value) {
                        errorString += '<li>' + value + '</li>';
                    });
                    $('.alert-danger').fadeIn().html(errorString);
                }
            });
        }
    });
</script>
@endsection