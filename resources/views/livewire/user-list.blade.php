@push('scripts')
    <script src="{{ asset('js/script.js') }}"></script>
@endpush

<div class="col-xl-8">
    <div class="card mb-3">

        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Pengguna</h5>
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
                        <th>Email</th>
                        <th class="text-end">Status</th>
                        <th>Jabatan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse  ($users as $index => $user)
                        <tr>
                            <td>{{ $users->firstItem() + $index }}</td>
                            <td>
                                <img src="{{ asset('storage/avatars/' . $user->avatar) }}" class="rounded-pill " width="30" height="30"></img>
                                <span class="fw-medium ms-2">{{ $user->name }}</span>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td class="text-end">
                                @if ( $user->status == '1' )
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                @if ( $user->position->role_as == '1' )
                                    <span class="badge bg-primary">{{ $user->position->name }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ $user->position->name }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="mt-0">
                                    <button wire:click="detail({{ $user->id }})" type="button" class="btn btn-sm btn-icon btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#backDropModalX">
                                        <span class="tf-icons bx bx-show"></span>
                                    </button>
                                    <button wire:click="getUser({{ $user->id }})" class="scroll-user btn btn-sm btn-icon btn-outline-secondary">
                                        <i class='bx bxs-edit'></i>
                                    </button>
                                    {{-- <button wire:click="deleteConfirm({{ $user->id }})" type="button" class="btn btn-sm btn-icon btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#backDropModal">
                                        <i class='bx bx-trash' ></i>
                                    </button> --}}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
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
            <div class="mt-3 d-flex align-items-center justify-content-center">
                <small class="pagination-sm">{{ $users->links() }}</small>
            </div>
        </caption>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="backDropModalX" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content my-0">
                <div class="modal-body mb-0">
                    <div class="user-avatar-section">
                        <div class=" d-flex align-items-center flex-column">
                        <img class="img-fluid rounded my-4 overflow-hidden" src="{{ asset('storage/avatars/' . $avatar) }}" height="200" width="200" alt="User avatar">
                        <div class="user-info text-center mb-2">
                            <h4 class="mb-2">{{ $name }}</h4>
                            @if ( $positionRole == 1 )
                            <span class="badge bg-label-primary">{{ $positionName }}</span>
                            @else
                            <span class="badge bg-label-secondary">{{ $positionName }}</span>
                            @endif

                            @if ( $status == '1' )
                                <span class="badge bg-success">Aktif</span>
                            @elseif ( $status == '0')
                                <span class="badge bg-danger">Nonaktif</span>
                            @endif
                        </div>
                        </div>
                    </div>
                    <h5 class="pb-2 border-bottom mb-4">Detail</h5>
                    <div class="info-container mb-0">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-3">
                                <span>
                                <span class="fw-medium me-2">Email :</span>
                                <span>{{ $email }}</span>
                                </span>
                            </li>
                            <li class="mb-3">
                                <span >
                                <span class="fw-medium me-2">Alamat :</span>
                                <span>{{ $alamat = $alamat ?? '-' }}</span>
                                </span>
                            </li>
                            <li class="mb-0">
                                <span>
                                    <span class="fw-medium me-2">Telepon :</span>
                                    <span>{{ $telepon = $telepon ?? '-' }}</span>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer mt-0">

                    <button wire:loading wire:loading.attr="disabled" type="button" class="w-100 btn btn-danger">
                        <span class="spinner-border spinner-border-sm text-white mx-3" role="status"></span>
                    </button>
                    <button wire:loading wire:loading.attr="disabled" type="button" class="w-100 btn btn-outline-secondary">
                        <span class="spinner-border spinner-border-sm text-dark mx-3" role="status"></span>
                    </button>

                    @if ( $status == 1)
                        <button data-bs-toggle="modal" type="button" wire:loading.remove data-bs-target="#backDropModalXX" class="w-100 btn btn-danger">
                            <span>Nonaktifkan Akun</span>
                        </button>
                    @elseif ( $status == 0)
                        <button data-bs-toggle="modal" type="button" wire:loading.remove data-bs-target="#backDropModalXX" class="w-100 btn btn-primary">
                            <span>Aktifkan Akun</span>
                        </button>
                    @endif
                    <span wire:loading.remove class="w-100">
                    <button type="button" wire:click="cancel()" class="w-100 btn btn-outline-secondary" data-bs-dismiss="modal">
                        <span>Tutup</span>
                    </button>
                    </span>
                </div>
            </div>
        </div>
    </div>

<!-- Modal -->
    <div  wire:ignore.self class="modal fade " id="backDropModalXX" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form wire:submit.prevent="update">
                @csrf
                    <div class="modal-body d-flex justify-content-center mt-4 align-items-center ">
                        <div class="text-center">
                                <h5 class="text-muted">Apakah anda yakin !</h5>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between align-items-center">
                        <button wire:loading wire:loading.attr="disabled" class="btn btn-outline-secondary float-end" data-bs-target="#backDropModalX" data-bs-toggle="modal">
                            <span class="spinner-border spinner-border-sm text-secondary mx-3" role="status"></span>
                        </button>
                        <div wire:loading.remove>
                            <button type="button" class="btn btn-outline-secondary float-end" data-bs-toggle="modal" data-bs-target="#backDropModalX">Batal</button>
                        </div>


                        <button wire:loading wire:loading.attr="disabled" class="btn btn-primary">
                            <span class="spinner-border spinner-border-sm text-white mx-3" role="status"></span>
                        </button> 
                        <div wire:loading.remove>

                    @if ( $status == 1)
                        <button type="submit" data-bs-dismiss="modal" wire:loading.remove class="btn btn-danger">
                            <span>Nonaktifkan</span>
                        </button>
                    @elseif ( $status == 0)
                        <button type="submit" data-bs-dismiss="modal" wire:loading.remove class="btn btn-primary">
                            <span>Aktifkan</span>
                        </button>
                    @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- Modal -->
    <div  wire:ignore.self class="modal fade " id="backDropModal" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body d-flex justify-content-center mt-4 align-items-center ">
                    <div class="text-center">
                            <i class="fa-solid fa-5x fa-triangle-exclamation mb-2"></i>
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