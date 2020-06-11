<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Akun</h3>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="saveUser(Object.fromEntries(new FormData($event.target)))">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" id="nama" value="{{ $user->nama }}" required>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No. Hp</label>
                        <input type="text" name="no_hp" class="form-control" id="no_hp" value="{{ $user->no_hp }}" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select id="role" name="role" class="form-control" required>
                            <option value="">Pilih role</option>
                            <option value="pelayan">Pelayan</option>
                            <option value="koki">Koki</option>
                            <option value="kasir">Kasir</option>
                            <option value="owner">Owner</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" value="{{ $user->username }}" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <div class="div">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
