<div class="btn-group">
    @if (Auth::user()->role == 'Admin')
        @if ($user->role == 'Seller' && $user->is_verified == 0)
            <button class="btn btn-sm btn-warning" onclick="verifiedUser({{ $user->id }})">Verifikasi</button>
        @endif
        <button class="btn btn-sm btn-primary" onclick="editUser({{ $user->id }})">Edit</button>
        @if (Auth::user()->id != $user->id)
            <button class="btn btn-sm btn-danger delete-button" onclick="deleteUser({{ $user->id }})">Delete</button>
        @endif
    @endif
</div>
