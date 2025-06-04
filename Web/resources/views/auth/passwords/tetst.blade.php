<form action="{{ route('profil.update', $profil->id) }}" method="POST"
    enctype="multipart/form-data" class="needs-validation" novalidate>
    @csrf
    @method('PUT')

    <input type="email" name="email" class="form-control" value="{{ $profil->email }}" readonly
        hidden>

    <div class="mb-3">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control" id="username"
            value="{{ old('username', $profil->username) }}" required>
    </div>

    <div class="mb-3">
        <label for="jenis_kelamin">Jenis Kelamin</label>
        <select name="harga_pekerjaan" class="form-control" id="jenis_kelamin" required>
            <option value="Laki-laki"
                {{ old('harga_pekerjaan', $profil->harga_pekerjaan) == 'Laki-laki' ? 'selected' : '' }}>
                Laki-laki</option>
            <option value="Perempuan"
                {{ old('harga_pekerjaan', $profil->harga_pekerjaan) == 'Perempuan' ? 'selected' : '' }}>
                Perempuan</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="tanggal_lahir">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir"
            value="{{ old('tanggal_lahir', $profil->tanggal_lahir) }}" required>
        <div id="tanggal-error" class="invalid-feedback">Umur Anda harus minimal 18 tahun!</div>
    </div>

    <div class="mb-3">
        <label for="nomorWA">Nomor WA</label>
        <input type="tel" name="WA" class="form-control" id="nomorWA"
            value="{{ old('WA', $profil->WA) }}" required pattern="^\d{12}$"
            title="Nomor WA harus terdiri dari 12 angka" maxlength="12">
        <div class="invalid-feedback">Nomor WA harus terdiri dari 12 angka.</div>
    </div>

    <div class="mb-3">
        <label for="kecamatan">Kecamatan</label>
        <select name="kecamatan" class="form-control" id="kecamatan" required>
            @foreach (['Ajibata', 'Balige', 'Bonatua Lunasi', 'Borbor', 'Habinsaran', 'Laguboti', 'Lumban Julu', 'Nassau', 'Parmaksian', 'Pintu Pohan Meranti', 'Porsea', 'Siantar Narumonda', 'Sigumpar', 'Silaen', 'Tampahan', 'Uluan'] as $kecamatan)
                <option value="{{ $kecamatan }}"
                    {{ old('kecamatan', $profil->kecamatan) == $kecamatan ? 'selected' : '' }}>
                    {{ $kecamatan }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="desa">Desa</label>
        <input type="text" name="desa" class="form-control" id="desa"
            value="{{ old('desa', $profil->desa) }}" required>
    </div>

    <div class="mb-3">
        <label for="alamat_lengkap">Alamat Lengkap</label>
        <textarea name="alamat_lengkap" class="form-control" id="alamat_lengkap" required>{{ old('alamat_lengkap', $profil->alamat_lengkap) }}</textarea>
    </div>

    <div class="mb-3">
        <label for="pekerjaan">Pekerjaan</label>
        <input type="text" name="pekerjaan" class="form-control" id="pekerjaan"
            value="{{ old('pekerjaan', $profil->pekerjaan) }}" required>
    </div>

    <div class="mb-3">
        <label for="image">Foto Profil (opsional)</label>
        <input type="file" name="image" class="form-control" id="image">
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary btn-lg">
            <i class="fas fa-save me-2"></i>Simpan Profil
        </button>
    </div>
</form>
