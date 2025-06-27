@push('scripts')
    <script src="{{ asset('js/script.js') }}"></script>
@endpush

<div class="col-xl">

    @livewire('widget-request')

    <div class="card mb-3">

        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Permintaan</h5>
        </div>
        <hr class="mt-0 mb-3">

        <div class="mx-4 d-flex align-items-center justify-content-between">
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

        <div class="card-header d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
            <div class="col-md-4">
                <select class="form-select" wire:model.live="filterPageStatus" aria-label="Default select example">
                    <option selected value="">
                        --All Status--
                    </option>
                    <option value="1">
                        Pending
                    </option>
                    <option value="2">
                        Diproses
                    </option>
                    <option value="3">
                        Selesai
                    </option>
                </select>
            </div>
            <div class="col-md-4">
                <select wire:model.live="filterPageUser" class="form-select text-capitalize">
                    <option value="">--All User--</option>
                    @foreach ($users as $data)
                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <select wire:model.live="filterPageJenis" class="form-select text-capitalize">
                    <option selected value="">
                        --All Jenis--
                    </option>
                    <option value="1">
                        Sarana
                    </option>
                    <option value="2">
                        Prasarana
                    </option>
                    <option value="3">
                        Lainnya
                    </option>
                </select>
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
                        <th>ID</th>
                        <th>Nama</th>
                        <th class="text-end">Jumlah</th>
                        <th class="text-center">Jenis</th>
                        <th>User</th>
                        <th class="text-center">Dibuat</th>
                        <th class="text-center">Diperbarui</th>
                        <th>Status</th>
                        <th class="text-center">Detail</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($submissions as $index => $submission)
                        <tr>
                        <tr>
                            <td>{{ $submissions->firstItem() + $index }}</td>
                            <td>
                                <span class="fw-medium">{{ $submission->kode_permintaan }}</span>
                            </td>
                            <td>
                                <span class="fw-medium">{{ $submission->inventory->name }}</span>
                            </td>
                            <td class="text-end">
                                <span class="fw-medium">{{ $submission->jumlah }} pcs</span>
                            </td>
                            <td class="text-center">
                                @if ( $submission->inventory->jenis == '1' )
                                    <span class="badge rounded-pill bg-label-primary">Sarana</span>
                                @elseif( $submission->inventory->jenis == '2' )
                                    <span class="badge rounded-pill bg-label-success">Prasarana</span>
                                @elseif ($submission->inventory->jenis == '3')
                                    <span class="badge rounded-pill bg-label-info">Lainnya</span>
                                @else
                                    <span class="badge rounded-pill bg-label-secondary">nothing</span>
                                @endif
                            </td>
                            <td>
                                @if ( $submission->user->name != null)
                                    <span class="fw-medium">{{ $submission->user->name }}</span>
                                @else
                                    <span class="fw-medium">unknown</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <span class="fw-medium">
                                {{ \Carbon\Carbon::parse($submission->created_at)->isoFormat('dddd, D MMMM YYYY', 'ID') }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="fw-medium">
                                {{ \Carbon\Carbon::parse($submission->updated_at)->isoFormat('dddd, D MMMM YYYY', 'ID') }}
                                </span>
                            </td>
                            <td>  
                                @if ( $submission->status == '1' )
                                    <span class="badge bg-warning">pending</span>
                                @elseif ( $submission->status == '2' ) 
                                    <span class="badge bg-info">diproses</span>
                                @elseif ( $submission->status == '3' ) 
                                    <span class="badge bg-success">selesai</span>
                                @else
                                    <span class="badge bg-secondary">nothing</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button wire:click="detail({{ $submission->id }})" type="button" class="btn btn-sm btn-icon btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#backDropModalX">
                                    <span class="tf-icons bx bx-show"></span>
                                </button>
                            </td>
                            <td class="text-center">
                                <div class="mt-0">
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu px-2 mx-auto">
                                            <div class="mx-auto mt-0">
                                                <button class="btn mt-2 btn-sm btn-outline-secondary w-100"  data-bs-toggle="modal" data-bs-target="#backDropModalP" wire:click="getSubmissionP({{ $submission->id }})">Pending</button>
                                            </div>
                                            <div class="mx-auto">
                                                <button class="btn mt-2 btn-sm btn-outline-secondary w-100"  data-bs-toggle="modal" data-bs-target="#backDropModal" wire:click="getSubmission({{ $submission->id }})">Proses</button>
                                            </div>

                                            <div class="mx-auto">
                                                <button class="btn mt-2 btn-sm btn-outline-secondary w-100"  data-bs-toggle="modal" data-bs-target="#backDropModalS" wire:click="getSubmissionS({{ $submission->id }})">Selesai</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center">
                                <h4 class="text-muted my-3">
                                Tidak ada data ditemukan !
                                </h4>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <caption >
            <div class="mt-3 d-flex align-items-center justify-content-center">
                <small class="pagination-sm">{{ $submissions->links() }}</small>
            </div>
        </caption>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="backDropModalX" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content my-0">
                <div class="modal-header border-bottom d-flex justify-content-center py-4">
                    <h4 class="modal-title" id="backDropModalTitle">Detail</h4>
                </div>
            <div class="modal-body mb-0">

                    <ul class="list-unstyled mb-0">
                        <li>
                            <span class="fw-medium">Status :
                            <span class="mx-2">
                                @if ( $status == '1' )
                                    <span class="badge bg-warning">pending</span>
                                @elseif ( $status == '2' ) 
                                    <span class="badge bg-info">diproses</span>
                                @elseif ( $status == '3' ) 
                                    <span class="badge bg-success">selesai</span>
                                @else
                                    <span class="badge bg-secondary">nothing</span>
                                @endif
                                </span>
                            </span>
                        </li>
                        <hr class="my-2">
                        <li>
                            <span class="fw-medium">ID :
                                <span class="mx-2">
                                    {{ $kode_permintaan }}
                                </span>
                            </span>
                        </li>
                        <hr class="my-2">
                        <li>
                            <span class="fw-medium">Nama :
                                <span class="mx-2">
                                    {{ !empty($name) ? $name : '-' }}
                                </span>
                            </span>
                        </li>
                        <hr class="my-2">
                        <li>
                            <span class="fw-medium">Nama :
                                <span class="mx-2">
                                    {{ !empty($user) ? $user : '-' }}
                                </span>
                            </span>
                        </li>
                        <hr class="my-2">
                        <li>
                            <span class="fw-medium">Jumlah :
                            <span class="mx-2">
                                    {{ !empty($jumlah) ? $jumlah . ' pcs' : '-' }}
                                </span>
                            </span>
                        </li>
                        <hr class="my-2">
                        <li>
                            <span class="fw-medium">Keterangan :
                            <span class="mx-2">
                                    {{ !empty($keterangan) ? $keterangan : '-' }}
                                </span>
                            </span>
                        </li>
                        <hr class="my-2">
                        <li>
                            <span class="fw-medium">Jenis :
                                <span class="mx-2">
                                    @if ( $jenis == '1' )
                                        <span>Sarana</span>
                                    @elseif( $jenis == '2' )
                                        <span>Prasarana</span>
                                    @elseif ($jenis == '3')
                                        <span>Lainnya</span>
                                    @else
                                        <span>nothing</span>
                                    @endif
                                </span>
                            </span>
                        </li>
                        <hr class="my-2">
                        <li>
                            <span class="fw-medium">Dibuat :
                                <span class="mx-2">
                                    {{ $created_at }}
                                </span>
                            </span>
                        </li>
                        <hr class="my-2">
                        <li>
                            <span class="fw-medium">Diperbarui :
                            <span class="mx-2">
                                    {{ !empty($updated_at) ? $updated_at : '-' }}
                                </span>
                            </span>
                        </li>
                        <hr class="mb-0">
                    </ul>

                @if ($kode_barang)
                    <div class="alert alert-primary mb-0 mt-3" role="alert">
                        Barang telah tersedia, cek inventaris. Kode barang <span class="fw-bold">{{ $kode_barang }}</span>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="cancel()" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
            </div>
        </div>
    </div>

    @livewire('acc-status')
    @livewire('pending-status')
    @livewire('sucsess-status')

</div>