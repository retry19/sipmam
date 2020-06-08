<div class="row">
    <div class="col-md-6">
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {!! session('success') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card shadow-none">
            <div class="card-header">
                <h3 class="card-title">Edit Menu</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="nama_menu">Nama Menu</label>
                    <input wire:model="namaMenu" type="text" class="form-control" id="nama_menu" placeholder="Masukan nama menu">
                    @error('namaMenu')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jenis_menu">Jenis</label>
                    <select wire:model="jenisMenu" id="jenis_menu" class="custom-select">
                        <option>Pilih jenis menu</option>
                        <option value="makanan">Makanan</option>
                        <option value="minuman">Minuman</option>
                    </select>
                    @error('jenisMenu')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jml_tersedia">Jumlah Stok</label>
                    <input wire:model="jmlTersedia" type="number" class="form-control" id="jml_tersedia" min="1" placeholder="Jumlah stok tersedia">
                    @error('jmlTersedia')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jml_dipesan">Jumlah Dipesan</label>
                    <input wire:model="jmlDipesan" type="number" class="form-control" id="jml_dipesan" min="0" placeholder="Jumlah dipesan">
                    @error('jmlDipesan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input wire:model="harga" type="number" class="form-control" id="harga" min="1" placeholder="Harga jual">
                    @error('harga')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group form-check">
                    <input wire:model="kosong" type="checkbox" class="form-check-input" id="kosong">
                    <label for="kosong" class="form-check-label">Kosong</label>
                    @error('kosong')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <img src="{{ $fotoMenu ? $fotoMenu : asset('storage/'.$fotoMenuOld) }}" class="img-fluid">
                    </div>
                    <div class="form-group col-md-8">
                        <label for="foto_menu">Foto Menu</label>
                        <input wire:change="$emit('fotoUpdateChoosen')" type="file" class="form-control-file" id="foto-menu">
                        @error('fotoMenu')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="float-right">
                    <button class="btn btn-outline-secondary">Reset</button>&nbsp;
                    <button wire:click="updateMenu" wire:target="updateMenu" wire:loading.attr="disabled" class="btn btn-primary">
                        <span wire:loading wire:target="updateMenu" class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        <span wire:target="updateMenu" wire:loading.remove>Simpan</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.livewire.on('fotoUpdateChoosen', () => {
        let img = document.getElementById('foto-menu').files[0];
        
        let reader = new FileReader();

        reader.onloadend = () => {
            window.livewire.emit('fotoUpdateUpload', reader.result);
        }

        reader.readAsDataURL(img);
    });
</script>

@section('title', 'Edit Menu')
@section('menu', 'active')
@section('menu-add', 'active')
@section('heading', 'Edit Menu')
