<div class="btn-group">
    @if (Auth::user()->role == 'Admin')
        <button class="btn btn-sm btn-primary" onclick="editUser({{ $user->id }})">Edit</button>
        @if (Auth::user()->id != $user->id)
            <button class="btn btn-sm btn-danger delete-button" onclick="deleteUser({{ $user->id }})">Delete</button>
        @endif
    @endif
</div>
