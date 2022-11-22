<div class="table-responsive">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <th>Debit</th>
            <th>Credit</th>
            <th>Ending Balance</th>

        </thead>
        <tbody>
            @foreach ($data as $x)
                <tr>
                    <td>{{ number_format((float) $x->debit, 2, '.', ',') }}</td>
                    <td>{{ number_format((float) $x->credit, 2, '.', ',') }}</td>
                    <td>{{ number_format((float) $x->ending_balance, 2, '.', ',') }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
