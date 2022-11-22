<div class="table-responsive">
    <table id="tablechild" style="width: 100%" id="coa" class="table align-items-center table-flush">
        <thead class="thead-light">
            <th>Trans Date</th>
            <th>Project</th>
            <th>Inv_no</th>
            <th>COA</th>
            <th>Debit</th>
            <th>Credit</th>
            <th>Ending Balance</th>
            <th>Inv US</th>
            <th>Kurs IDR</th>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{$item->trans_date}}</td>
                <td>{{$item->project}}</td>
                <td>{{$item->inv_no}}</td>
                <td>{{$item->coa->jns_trans}}</td>
                <td>{{ number_format((float) $item->debit, 2, '.', ',') }}</td>
                <td>{{ number_format((float) $item->credit, 2, '.', ',') }}</td>
                <td>{{ number_format((float) $item->ending_balance, 2, '.', ',') }}</td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>

