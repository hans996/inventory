<div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
  <div class="card mb-4">
    <div class="card-body">
      <div class="user-avatar-section">
        <div class=" d-flex align-items-center flex-column">
          <img class="img-fluid rounded my-4 overflow-hidden" src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}" height="200" width="200" alt="User avatar">
          <div class="user-info text-center">
            <h4 class="mb-2">{{ Auth::user()->name }}</h4>
            @if ( Auth::user()->position->role_as == 1 )
              <span class="badge bg-label-primary">{{ Auth::user()->position->name }}</span>
            @else
              <span class="badge bg-label-secondary">{{ Auth::user()->position->name }}</span>
            @endif
          </div>
        </div>
      </div>
      <h5 class="pb-2 border-bottom mb-4">Detail</h5>
      <div class="info-container">
        <ul class="list-unstyled">
          <li class="mb-3">
            <span>
              <span class="fw-medium me-2">Email :</span>
              <span>{{ Auth::user()->email }}</span>
            </span>
          </li>
          <li class="mb-3">
            <span >
              <span class="fw-medium me-2">Alamat :</span>
              <span>{{ $email = auth()->user()->adress ?? '-' }}</span>
            </span>
          </li>
          <li class="mb-4">
            <span>
              <span class="fw-medium me-2">Telepon :</span>
            <span>{{ $email = auth()->user()->telepon ?? '-' }}</span>
          </span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
