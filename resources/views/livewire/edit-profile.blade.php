@push('scripts')
    <script src="{{ asset('js/script.js') }}"></script>
@endpush

<div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
    @include('layouts.components.nav-user')
    
    <div class="card mb-4">
        <h5 class="card-header">Ubah Profile</h5>
        <hr class="my-0">
        <div class="card-body">
            <form wire:submit.prevent="update" enctype="multipart/form-data">
                @csrf
                <div class="d-flex align-items-start align-items-sm-center mb-4 pb-4 border-bottom gap-4">
                    @if ($avatar)
                        <img src="{{ $avatar->temporaryUrl() }}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                    @else
                        <img src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                    @endif
                    <div class="button-wrapper">
                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Unggah</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input type="file" id="upload" wire:model.defer="avatar" class="@error('avatar') is-invalid @enderror account-file-input" hidden="" accept="image/png, image/jpeg">
                        </label>
                        <button type="button" wire:click="resetAvatar()" class="btn btn-outline-secondary account-image-reset mb-4">
                            <i class="bx bx-reset d-block d-sm-none"></i>
                            <span class="d-none d-sm-block" >Batal</span>
                        </button>

                        <p class="text-muted mb-0">
                            <small wire:loading wire.target="avatar">
                                <span class="spinner-border spinner-border-sm text-secondary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </span>
                                Loading...
                            </small>
                            <small wire:loading.remove class="@error('avatar') text-danger @enderror">JPG atau PNG. Max 1MB</small>
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Nama</label>
                        <input wire:model.defer="name" class="form-control @error('name') is-invalid @enderror" type="text">
                    
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <span>{{ $message }}</span>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Email</label>
                        <input wire:model.defer="email" class="form-control  @error('email') is-invalid @enderror" type="text" disabled>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <span>{{ $message }}</span>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Alamat</label>
                        <input wire:model.defer="adress" class="form-control  @error('adress') is-invalid @enderror" type="text">

                        @error('adress')
                            <span class="invalid-feedback" role="alert">
                                <span>{{ $message }}</span>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Telepon</label>
                        <input wire:model.defer="telepon" min="0" class="form-control  @error('telepon') is-invalid @enderror" type="number">

                        @error('telepon')
                            <span class="invalid-feedback" role="alert">
                                <span>{{ $message }}</span>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="mt-2">
                    <button wire:loading wire:loading.attr="disabled" type="submit" class="float-end btn btn-primary">
                        <span class="spinner-border spinner-border-sm text-white mx-3" role="status"></span>
                    </button>
                    <button wire:loading.remove type="submit" class="float-end btn btn-primary">
                        <span>Simpan</span>
                    </button>

                    <button wire:loading wire:loading.attr="disabled" class="me-2 float-end btn btn-secondary">
                        <span class="spinner-border spinner-border-sm text-white mx-3" role="status"></span>
                    </button>
                    <div wire:loading.remove>
                        <button type="button" wire:click="cancel()" class="me-2 float-end btn btn-secondary">
                            <span>Batal</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
