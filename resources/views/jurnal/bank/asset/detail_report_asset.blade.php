<div class="table-responsive">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <th>Nama</th>
            <th>Details</th>
            <th>Penggunaan</th>

        </thead>
        <tbody>
            @foreach ($spek as $x)
                <tr>
                    <td>{{ $x->nama }}</td>
                    <td>{{ $x->detail }}</td>
                    <td>{{ $x->penggunaan}}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
