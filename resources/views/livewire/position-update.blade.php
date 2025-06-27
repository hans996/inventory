<div class="col-xl" id="position">
    <div class="card mb-3">
        <h5 class="card-header">Ubah Jabatan</h5>
        <hr class="my-0">

        <div class="card-body">
            <form wire:submit.prevent="update">
                @csrf
                <input type="hidden" wire:model.defer="positionId">
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nama</label>
                    <input wire:model.defer="name" type="text" class="form-control  @error('name') is-invalid @enderror" placeholder="Nama">

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>
                <div class="form-check mt-3">
                    <input checked class="form-check-input" wire:model.defer="role_as" type="checkbox">
                    <label class="form-check-label" for="defaultCheck1"> Administrator </label>
                </div>
                <div class="mt-0">

                    <button wire:loading wire:loading.attr="disabled" type="submit" class="float-end btn btn-primary">
                        <span class="spinner-border spinner-border-sm text-white mx-3" role="status"></span>
                    </button>
                    <button wire:loading.remove type="submit" class="float-end btn btn-primary">
                        <span>Simpan</span>
                    </button>

                    <button wire:loading wire:loading.attr="disabled" class="me-2 float-end btn btn-secondary">
                        <span class="spinner-border spinner-border-sm text-white mx-3" role="status"></span>
                    </button>
                    <div  wire:loading.remove>
                        <button type="reset" wire:click="cancel()" class="me-2 float-end btn btn-secondary">
                            <span>Batal</span>
                        </button>
                    </div>
                </div>
                </form>
        </div>
    </div>
</div>