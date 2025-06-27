@push('scripts')
    <script src="{{ asset('js/script.js') }}"></script>
@endpush


<div class="col-xl-8">
    <div class="card mb-3">

        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Jabatan</h5>
        </div>
        <hr class="mt-0 mb-3">

        <div class="mx-4 mb-3 d-flex align-items-center justify-content-between">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <select wire:model.live="perPage" class="form-select">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="input-group input-group-merge px-4 mb-3">
            <span class="input-group-text"><i class="bx bx-search"></i></span>
            <input type="text" class="form-control" wire:model="search" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31" />
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th class="text-center">Akses</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($positions as $index => $position)
                        <tr>
                            <td>{{ $positions->firstItem() + $index }}</td>
                            <td>
                                <span class="fw-medium">{{ $position->name }}</span>
                            </td>
                            <td class="text-center">
                                @if ($position->role_as == 1)
                                    <span class="badge rounded-pill bg-label-primary">Yes</span>
                                @elseif ($position->role_as == 0)
                                    <span class="badge rounded-pill bg-label-secondary">No</span>
                                @else
                                    <span class="badge rounded-pill bg-label-warning">unknown</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="mt-0">
                                    <button  wire:click="getPosition({{ $position->id }})"  class="scroll-position btn btn-sm btn-icon btn-outline-secondary">
                                        <i class='bx bxs-edit'></i>
                                    </button>
                                    <button wire:click="deleteConfirm({{ $position->id }})" type="button" class="btn btn-sm btn-icon btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#backDropModal">
                                        <i class='bx bx-trash' ></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                <h4 class="text-muted my-3">
                                Tidak ada data ditemukan !
                                </h4>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <caption>
            <div class="d-flex align-items-center justify-content-center mt-3">
                <small class="pagination-sm">{{ $positions->links() }}</small>
            </div>
        </caption>
    </div>

<!-- Modal -->
    <div  wire:ignore.self class="modal fade " id="backDropModal" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body d-flex justify-content-center mt-4 align-items-center ">
                    <div class="text-center">
                        <h5 class="text-muted">Apakah anda yakin !</h5>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between align-items-center">
                    <button wire:loading wire:loading.attr="disabled" class="btn btn-outline-secondary float-end" data-bs-dismiss="modal">
                        <span class="spinner-border spinner-border-sm text-secondary mx-3" role="status"></span>
                    </button>
                    <div wire:loading.remove>
                        <button type="reset" wire:click="cancel()" class="btn btn-outline-secondary float-end" data-bs-dismiss="modal">Batal</button>
                    </div>


                    <button wire:loading wire:loading.attr="disabled" class="btn btn-primary">
                        <span class="spinner-border spinner-border-sm text-white mx-3" role="status"></span>
                    </button> 
                    <div wire:loading.remove>
                        <button type="button" data-bs-dismiss="modal" wire:click="destroy()" class="btn btn-primary">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>