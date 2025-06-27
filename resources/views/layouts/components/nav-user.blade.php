@push('scripts')
    <script src="{{ asset('scripts/script.js') }}"></script>
@endpush
<ul class="nav nav-pills flex-column flex-md-row mb-3">
    <li class="nav-item">
      <a class="nav-link {{ Request::is('edit-profile') ? 'active' : '' }}" href="{{ url('edit-profile') }}"><i class='menu-icon bx bx-user' ></i>Ubah Profile</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ Request::is('edit-password') ? 'active' : '' }}" href="{{ url('edit-password') }}"><i class='menu-icon bx bx-key' ></i>Ubah Password</a>
    </li>
</ul>