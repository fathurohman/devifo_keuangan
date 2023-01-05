
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $x)
                                <tr>
                                    <td>{{ Carbon\Carbon::parse($x->created_at)->format('d-m-Y')  }}</td>
                                    <td>{{ $x->name }}</td>
                                    <td>{{ $x->keterangan }}</td>
                                    <td>Rp. {{ number_format((float) $x->debit) }}</td>
                                    <td>Rp. {{ number_format((float) $x->credit) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
