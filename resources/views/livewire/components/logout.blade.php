<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    @if (Auth::user()->isAdmin())
                    <a href="{{ route('dashboard') }}" class="btn btn-light mr-1">Admin Panel</a>
                    
    @endif
    <a href="#" wire:click="logout" class="btn btn-light mr-1"> Logout</a>
</div>
