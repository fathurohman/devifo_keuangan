<table>
    <thead>
        <tr>
            <th scope="col">Tanggal</th>
            <th scope="col">Name</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Debit</th>
            <th scope="col">Credit</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $x)
            <tr>
                <td>{{ Carbon\Carbon::parse($x->created_at)->format('d-m-Y')  }}</td>
                <td>{{ $x->name }}</td>
                <td>{{ $x->keterangan }}</td>
                <td>Rp. {{ number_format((float) $x->debit) }}</td>
                <td>Rp. {{ number_format((float) $x->credit) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
