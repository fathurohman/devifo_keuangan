<a class="btn btn-sm btn-success" href="{{ route('pos.order_index', $data['id'] )}}" role="button" data-id="{{ $data['id'] }}">
    Order | {{ $data['child']}}
    </a>
<div class="dropdown">
    <a class="btn btn-sm btn-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">More
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
        <a href="#" data-id="{{ $data['id'] }}" class="dropdown-item details" data-toggle="modal"
            data-target="#details">Details </a>
        <a href="{{ route('edit.order', $data['id'])}}" data-id="{{ $data['id'] }}" class="dropdown-item" >Edit </a>

        @if ($data['child'] > 0)

        @else
            <form method="post" id="delete-form-{{ $data['id'] }}"
                action="{{ route('delete.order', $data['id'])}}"
                style="display: none">
                {{ csrf_field() }} {{ method_field('DELETE') }}
            </form>
            <a class="dropdown-item" href=""
                onclick="if(confirm('Are you sure?'))
                {
                    event.preventDefault();document.getElementById('delete-form-{{ $data['id'] }}').submit();
                }
                else{
                    event.preventDefault();
                }">Hapus
            </a>
        @endif




    </div>

</div>
