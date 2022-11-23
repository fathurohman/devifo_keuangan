<div class="dropdown">
    <a class="btn btn-sm btn-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">More
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
        {{-- <a href="#" data-id="{{ $data['id'] }}" class="dropdown-item details" data-toggle="modal"
            data-target="#details">Details </a> --}}
            @if ($data['elektronik'] == 1)
                <a href="#" data-id="{{ $data['id'] }}" class="dropdown-item despresiasi" data-toggle="modal"
                data-target="#des">Despresiasi </a>
                <a href="#" data-id="{{ $data['id'] }}" class="dropdown-item spesifikasi" data-toggle="modal"
                data-target="#spek">Spesifikasi </a>
            @else
                <a href="#" data-id="{{ $data['id'] }}" class="dropdown-item spesifikasi" data-toggle="modal"
                data-target="#spek">Spesifikasi </a>
            @endif



    </div>

</div>
