
@if (empty($data->nota))
<span>Tidak ada bukti nota</span>
@else
<img style="width: 80%"
    src="{{ url('storage/invoice/' . $data->nota) }}">
@endif

