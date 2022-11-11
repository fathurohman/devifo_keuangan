<div class="table-responsive">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <th>Debit</th>
            <th>Credit</th>
            <th>Ending Balance</th>
            <th>Paye</th>
            <th>Kurs Rupiah</th>
            <th>Bs_pl</th>
            <th>Dk</th>
        </thead>
        <tbody>
            @foreach ($data as $x)
                <tr>
                    <td>{{ number_format((float) $x->debit, 2, '.', ',') }}</td>
                    <td>{{ number_format((float) $x->credit, 2, '.', ',') }}</td>
                    <td>{{ number_format((float) $x->ending_balance, 2, '.', ',') }}</td>
                    <td>{{ $x->paye }}</td>
                    <td>{{ $x->kurs_rupiah }}</td>
                    <td>{{ $x->bs_pl }}</td>
                    <td>{{ $x->dk }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
