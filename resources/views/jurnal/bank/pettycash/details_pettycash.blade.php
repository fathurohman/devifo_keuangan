<div class="table-responsive">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <th>BS_PL</th>
            <th>Debit</th>
            <th>Credit</th>
            <th>Ending Balance</th>
            <th>Dk</th>
        </thead>
        <tbody>
            @foreach ($data as $x)
                <tr>
                    <td>{{ $x->bs_pl }}</td>
                    <td>{{ number_format((float) $x->debit, 2, '.', ',') }}</td>
                    <td>{{ number_format((float) $x->credit, 2, '.', ',') }}</td>
                    <td>{{ number_format((float) $x->ending_balance, 2, '.', ',') }}</td>
                    <td>{{ $x->dk }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
