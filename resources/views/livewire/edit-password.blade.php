@push('scripts')
    <script src="{{ asset('js/script.js') }}"></script>
@endpush

<div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
  @include('layouts.components.nav-user')

  <div class="card mb-4">
    <h5 class="card-header">Ubah Password</h5>
    <hr class="my-0">
    <div class="card-body">
      <form wire:submit.prevent="update">
        @csrf
        <div class="row">
          <div class="mb-3 col-md-6">
            <label class="form-label">Password lama</label>
            <input wire:model.defer="current_password" class="form-control @error('current_password') is-invalid @enderror" type="password" placeholder="Password lama">

            @error('current_password')
              <span class="invalid-feedback" role="alert">
              <span>{{ $message }}</span>
              </span>
            @enderror
          </div>
        </div>
        <div class="row">
          <div class="mb-3 col-md-6">
            <label class="form-label">Password baru</label>
            <input wire:model.defer="new_password" class="form-control @error('new_password') is-invalid @enderror" type="password" placeholder="Password baru">
            
            @error('new_password')
            <span class="invalid-feedback" role="alert">
              <span>{{ $message }}</span>
            </span>
            @enderror
          </div>
          <div class="mb-3 col-md-6">
            <label class="form-label">Konfirmasi password</label>
            <input wire:model.defer="confirm_new_password" class="form-control @error('confirm_new_password') is-invalid @enderror" type="password" placeholder="Konfirmasi password">
    
            @error('confirm_new_password')
              <span class="invalid-feedback" role="alert">
              <span>{{ $message }}</span>
              </span>
            @enderror
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
          <div  wire:loading.remove>
              <button type="button" wire:click="cancel()" class="me-2 float-end btn btn-secondary">
                  <span>Batal</span>
              </button>
          </div>
        </div>
      </form>
    </div>
  </div>

</div>