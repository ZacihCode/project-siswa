<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Aplikasi Siswa</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h4 class="mb-3">Daftar Siswa</h4>

        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Siswa</button>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIS</th>
                    <th>Kelas</th>
                    <th>Alamat</th>
                    <th width="180">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($siswas as $index => $siswa)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $siswa->nama }}</td>
                    <td>{{ $siswa->nis }}</td>
                    <td>{{ $siswa->kelas }}</td>
                    <td>{{ $siswa->alamat }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#editModal"
                            data-id="{{ $siswa->id }}"
                            data-nama="{{ $siswa->nama }}"
                            data-nis="{{ $siswa->nis }}"
                            data-kelas="{{ $siswa->kelas }}"
                            data-alamat="{{ $siswa->alamat }}">
                            Edit
                        </button>

                        <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data siswa.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="tambahModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('siswa.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Siswa</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>NIS</label>
                        <input type="text" name="nis" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Kelas</label>
                        <input type="text" name="kelas" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" class="modal-content" id="editForm">
                @csrf
                @method('PUT')
                <div class="modal-header bg-warning">
                    <h5 class="modal-title">Edit Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="nama" id="editNama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>NIS</label>
                        <input type="text" name="nis" id="editNis" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Kelas</label>
                        <input type="text" name="kelas" id="editKelas" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Alamat</label>
                        <textarea name="alamat" id="editAlamat" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>
            </form>
        </div>
    </div>

    <footer class="text-center py-3 mt-4">
        © 2025 Aplikasi Siswa. All rights reserved.
    </footer>

    <script>
        const editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const nama = button.getAttribute('data-nama');
            const nis = button.getAttribute('data-nis');
            const kelas = button.getAttribute('data-kelas');
            const alamat = button.getAttribute('data-alamat');

            document.getElementById('editNama').value = nama;
            document.getElementById('editNis').value = nis;
            document.getElementById('editKelas').value = kelas;
            document.getElementById('editAlamat').value = alamat;

            document.getElementById('editForm').action = `/siswa/${id}`;
        });
    </script>
</body>

</html>