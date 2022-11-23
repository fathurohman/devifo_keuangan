<div class="table-responsive">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <th>BS_PL</th>
            <th>Debit</th>
            <th>Credit</th>
            <th>Ending Balance</th>

        </thead>
        <tbody>
            @foreach ($data as $x)
                <tr>
                    <td>{{ $x->bs_pl }}</td>
                    <td>{{ number_format((float) $x->debit, 2, '.', ',') }}</td>
                    <td>{{ number_format((float) $x->credit, 2, '.', ',') }}</td>
                    <td>{{ number_format((float) $x->ending_balance, 2, '.', ',') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

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
