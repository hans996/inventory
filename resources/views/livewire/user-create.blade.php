<div class="col-xl">
    <div class="card mb-3">
        <h5 class="card-header">Tambahkan Pengguna</h5>
        <hr class="mt-0 mb-0">

        <div class="card-body mt-0">
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
                    <label class="form-label" for="password">Password</label>
                    <input wire:model.defer="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password_confirmation">Konfirmasi password</label>
                    <input wire:model.defer="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Konfirmasi password">

                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <span>{{ $message }}</span>
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
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>

                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <button wire:loading wire:loading.attr="disabled"  type="submit" class="btn btn-primary float-end">
                            <span class="spinner-border spinner-border-sm text-white mx-4" role="status"></span>
                        </button>
                    </div>
                    <div class="col-sm-10">
                        <button wire:loading.remove type="submit" class="btn btn-primary float-end">Tambahkan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>