<div class="dropdown">
    <a class="btn btn-sm btn-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">More
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
        <a href="#" data-id="{{ $data['id'] }}" class="dropdown-item details" data-toggle="modal"
            data-target="#details">Details </a>
            <a href="{{ route('add_assets_spek', $data['id'])  }}" class="dropdown-item">Add Spesifikasi </a>
            {{-- <a href="{{ route('edit_assets', $data['id'])  }}" class="dropdown-item">Edit </a> --}}
    </div>

</div>
