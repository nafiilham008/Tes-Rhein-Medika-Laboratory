<div class="modal d-block" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $product_id ? 'Edit' : 'Tambah' }} Produk</h5>
                <button wire:click="closeModal()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label for="name">Nama</label>
                    <input wire:model="name" type="text" class="form-control" id="name">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="price">Harga</label>
                    <input wire:model="price" type="text" class="form-control" id="price">
                    @error('price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="stock">Stok</label>
                    <input wire:model="stock" type="number" class="form-control" id="stock">
                    @error('stock')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <div class="modal-footer">
                <button wire:click.prevent="store()"
                    class="btn btn-primary">{{ $product_id ? 'Update' : 'Simpan' }}</button>
                <button wire:click.prevent="closeModal()" class="btn btn-outline-secondary"
                    data-dismiss="modal">Batal</button>

            </div>
        </div>
    </div>
</div>
