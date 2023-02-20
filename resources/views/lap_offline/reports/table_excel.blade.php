<table>
    <thead>
        <tr>
            <td colspan="6" style="font-size: 15pt;font-weight: 700;text-align: center">LAPORAN</td>

        </tr>
        <tr>
            <td colspan="6" style="font-size: 12pt;font-weight: 600;text-align: center">
                {{ Carbon\Carbon::parse($start)->format('d F Y') }} s/d {{ Carbon\Carbon::parse($end)->format('d F Y') }}</td>

        </tr>
        <tr>
            <th scope="col" style="font-size: 12pt;font-weight: 700;text-align: center">TANGGAL</th>
            <th width="250px" scope="col" style="font-size: 12pt;font-weight: 700;text-align: center">NAMA</th>
            <th width="300px" scope="col" style="font-size: 12pt;font-weight: 700;text-align: center">KETERANGAN</th>
            <th width="150px" scope="col" style="font-size: 12pt;font-weight: 700;text-align: center">DEBIT</th>
            <th width="150px" scope="col" style="font-size: 12pt;font-weight: 700;text-align: center">CREDIT</th>
            <th width="300px" scope="col" style="font-size: 12pt;font-weight: 700;text-align: center">SALDO</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $x)
            <tr>
                <td style="text-align: center">{{ Carbon\Carbon::parse($x->created_at)->format('d/m/Y')  }}</td>
                <td>{{ $x->name }}</td>
                <td style="text-align: center">{{ $x->keterangan }}</td>
                <td style="text-align: right">
                    @if ($x->debit)
                    Rp. {{ number_format((float) $x->debit) }}
                    @else

                    @endif

                </td>
                <td style="text-align: right">
                    @if ($x->credit)
                        {{ number_format((float) $x->credit) }}
                    @else

                    @endif
                    </td>
                <td style="text-align: right">{{ number_format((float) $x->saldo)}}</td>
            </tr>
        @endforeach
            <tr>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td style="font-size: 15pt;font-weight: 700;text-align: center" colspan="3"> TOTAL </td>
                <td style="text-align: right">{{ number_format((float) $sum_debit) }}</td>
                <td style="text-align: right">{{ number_format((float) $sum_credit) }}</td>
                <td style="text-align: right;font-size: 15pt;font-weight: 700">{{ number_format((float) $total = $sum_debit - $sum_credit) }}</td>
            </tr>

    </tbody>
</table>
