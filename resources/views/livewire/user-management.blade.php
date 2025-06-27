<div class="row">
    @livewire('user-list')

    @if ($userUpdateStatus)
        @livewire('user-update')
    @else
        @livewire('user-create')
    @endif
</div>