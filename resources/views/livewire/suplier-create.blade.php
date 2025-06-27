<div class="col-xl">
    <div class="card mb-3">
        <h5 class="card-header">Tambah Suplier</h5>
        <hr class="mt-0 mb-0">

        <div class="card-body">
            <form wire:submit.prevent="store">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nama</label>
                    <input wire:model.defer="name" type="text" class="form-control  @error('name') is-invalid @enderror" placeholder="Nama">

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-company">Email</label>
                    <input wire:model.defer="email" type="email" class="form-control  @error('email') is-invalid @enderror" placeholder="Email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Telepon</label>
                    <input wire:model.defer="telepon" type="number" min="1" class="form-control phone-mask  @error('telepon') is-invalid @enderror" placeholder="Telepon">

                    @error('telepon')
                        <span class="invalid-feedback" role="alert">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                <label class="form-label" for="basic-default-message">Alamat</label>
                <textarea wire:model.defer="alamat" class="form-control  @error('alamat') is-invalid @enderror" placeholder="Alamat"></textarea>
                @error('alamat')
                    <span class="invalid-feedback" role="alert">
                        <span>{{ $message }}</span>
                    </span>
                @enderror
                </div>
                <button type="submit" wire:loading wire:loading.attr="disabled" class="float-end btn btn-primary">
                    <span class="spinner-border spinner-border-sm text-white mx-4" role="status"></span>
                </button>
                <button wire:loading.remove type="submit" class="float-end btn btn-primary">
                    <span>Tambahkan</span>
                </button>
            </form>
        </div>
    </div>
</div>