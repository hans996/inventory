<div class="col-xl">
    <div class="card mb-3">
        <h5 class="card-header">Tambahkan Jabatan</h5>
        <hr class="my-0">

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
                    <div class="form-check mt-3">
                        <input class="form-check-input" wire:model.defer="role_as" type="checkbox">
                        <label class="form-check-label" for="defaultCheck1"> Administrator </label>
                    </div>
                </div>
                <button wire:loading wire:loading.attr="disabled" type="submit" class="float-end btn btn-primary">
                    <span class="spinner-border spinner-border-sm text-white mx-4" role="status"></span>
                </button>
                <button wire:loading.remove type="submit" class="float-end btn btn-primary">
                    <span>Tambahkan</span>
                </button>
            </form>
        </div>
    </div>
</div>