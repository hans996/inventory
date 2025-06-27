<div class="col-xl" id="user">
    <div class="card mb-3">
        <h5 class="card-header">Ubah Pengguna</h5>
        <hr class="mt-0 mb-0">

        <div class="card-body">
            <form wire:submit.prevent="update">
                @csrf
                <input type="hidden" wire:model.defer="userId">
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nama</label>
                    <input wire:model.defer="name" type="text" class="form-control  @error('name') is-invalid @enderror" placeholder="Nama">

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-company">Email</label>
                    <input wire:model.defer="email" type="email" class="form-control  @error('email') is-invalid @enderror" placeholder="Email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input wire:model.defer="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">

                    <div class="form-text">
                        Kosongkan jika tidak ingin dirubah
                    </div>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                    <input wire:model.defer="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Konfirmasi password">

                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="basic-default-company">Jabatan</label>

                    <select wire:model.defer="position_id" class="form-select @error('position_id') is-invalid @enderror">
                        <option>--Pilih jabatan--</option>
                        @foreach ($positions as $position)
                            <option value="{{ $position->id }}">{{ $position->name }}</option>
                        @endforeach
                    </select>

                    @error('position_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
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