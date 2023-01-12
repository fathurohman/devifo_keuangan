
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="myTable" class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Name</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Debit</th>
                                <th scope="col">Credit</th>
                                <th scope="col">Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $x)
                                <tr>
                                    <td>{{ Carbon\Carbon::parse($x->created_at)->format('d-m-Y')  }}</td>
                                    <td>{{ $x->name }}</td>
                                    <td>{{ $x->keterangan }}</td>
                                    <td>
                                        @if ($x->debit)
                                            Rp. {{ number_format((float) $x->debit) }}
                                        @else

                                        @endif
                                        </td>
                                    <td>
                                        @if ($x->credit)
                                            {{ number_format((float) $x->credit) }}
                                        @else

                                        @endif
                                    </td>
                                    <td>{{ number_format((float) $x->saldo)}}</td>
                                </tr>
                            @endforeach
                            @if ($sum_debit2 || $sum_credit2 > 0)
                            <tr>
                                <td colspan="6"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 12pt;font-weight: 700;text-align: center" colspan="3"> TOTAL </td>
                                <td style="font-size: 12pt;font-weight: 700">{{ number_format((float) $sum_debit2) }}</td>
                                <td style="font-size: 12pt;font-weight: 700">{{ number_format((float) $sum_credit2) }}</td>
                                <td style="font-size: 15pt;font-weight: 700">{{ number_format((float) $total = $sum_debit2 - $sum_credit2) }}</td>
                            </tr>
                            @else

                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
