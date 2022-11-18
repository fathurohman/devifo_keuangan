<table>
    <thead>
        <tr>
            <th style="background-color:#6DCCEC">Trans_Date</th>
            <th style="background-color:#6DCCEC">Bulan</th>
            <th style="background-color:#6DCCEC">Sumber Jurnal</th>
            <th style="background-color:#6DCCEC">Customer</th>
            <th style="background-color:#6DCCEC">Trans No</th>
            <th style="background-color:#6DCCEC">Description</th>
            <th style="background-color:#6DCCEC">Chart Of Account</th>
            <th style="background-color:#6DCCEC">BS/PL</th>
            <th style="background-color:#6DCCEC">Debit</th>
            <th style="background-color:#6DCCEC">Credit</th>
            <th style="background-color:#6DCCEC">Ending Balance</th>
            <th style="background-color:#6DCCEC">NOMINAL INV US</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data_penjualan as $x)
            <tr>
                <td>{{ date('d-F-Y', strtotime($x->trans_date)) }}</td>
                <td>{{ date('m', strtotime($x->trans_date)) }}</td>
                <td>{{ 'PENJUALAN' }}</td>
                <td>{{ $x->Customer }}</td>
                <td>{{ $x->inv_No }}</td>
                <td>{{ $x->description }}</td>
                <td>{{ $x->coa->jns_trans }}</td>
                <td>{{ $x->bs_pl }}</td>
                <td>{{ number_format($x->debit, 2) }}</td>
                <td>{{ number_format($x->credit, 2) }}</td>
                <td>{{ number_format($x->ending_balance, 2) }}</td>
                <td>{{ $x->inv_us }}</td>
                <td>{{ $x->kurs_idr }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
