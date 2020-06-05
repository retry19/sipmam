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
                <h3 class="card-title">Menu Baru</h3>
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
                    <label for="harga">Harga</label>
                    <input wire:model="harga" type="number" class="form-control" id="harga" min="1" placeholder="Harga jual">
                    @error('harga')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-row">
                    @if ($fotoMenu)
                        <div class="form-group col-md-4">
                            <img src="{{ $fotoMenu }}" class="img-fluid">
                        </div>
                    @endif
                    <div class="form-group col-md-8">
                        <label for="foto_menu">Foto Menu</label>
                        <input wire:change="$emit('fotoChoosen')" type="file" class="form-control-file" id="foto-menu">
                        @error('fotoMenu')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="float-right">
                    <button class="btn btn-outline-secondary">Reset</button>&nbsp;
                    <button wire:click="storeMenu" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.livewire.on('fotoChoosen', () => {
        let img = document.getElementById('foto-menu').files[0];
        
        let reader = new FileReader();

        reader.onloadend = () => {
            window.livewire.emit('fotoUpload', reader.result);
        }

        reader.readAsDataURL(img);
    });
</script>

@section('title', 'Tambah Menu')
@section('menu', 'active')
@section('menu-add', 'active')
@section('heading', 'Tambah Menu')
