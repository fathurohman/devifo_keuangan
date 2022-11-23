<div class="table-responsive">
    <table id="table_des" class="table align-items-center table-flush" style="text-align: center">
        <thead class="thead-light">
            <th style="width: 50%">Tanggal</th>
            <th style="width: 50%">Despresiasi Balance</th>

        </thead>
        <tbody>
            @foreach ($des as $x)
                <tr>
                    <td>{{$x->trans_date}}</td>
                    <td>{{ number_format((float) $x->ending_balance, 2, '.', ',') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
    <script src="{{ asset('argon') }}/datatable/datatables.min.js" type="text/javascript"></script>
    <script type="text/javascript">
    $(document).ready(function() {
     $('#table_des').DataTable();
    });
    </script>

