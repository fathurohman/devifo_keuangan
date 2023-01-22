<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link type="text/css" href="{{ public_path('argon') }}/css/invoice.css" rel="stylesheet"> --}}
    <link href="{{ asset('argon') }}/img/brand/favicondevifo.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Extra details for Live View on GitHub Pages -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <!-- Icons -->
    <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
    <link type="text/css" href="{{ asset('argon') }}/css/my.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0"> <a href="{{ route('pos.index') }}" type="button"
                                    class="btn btn-sm btn-info">{{ __('Back') }}</a> Order</h3>
                                <p>Kode : <b>{{ $data['order']->kode_nota}}</b> <br>
                                    Nama : <b>{{ $data['order']->nama_pembeli}}</b> <br>
                                    No.HP : <b>{{ $data['order']->no_pembeli}}</b>
                                </p>

                            </div>
                            <div class="col-4 text-right">

                            </div>
                        </div>
                    </div>


                    <div class="mx-3">
                        <div class="table-responsive">
                            <table id="myTable" class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Kode</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Total</th>
                                        <th class="text-center" scope="col">Action</th>
                                        {{-- <th scope="col">Delete</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['data'] as $x)
                                        <tr>
                                            <td> {{ $x->barangs->kode_barang }} </td>
                                            <td>{{ $x->barangs->nama_barang }} </td>
                                            <td> Rp. {{ number_format((float) $x->barangs->harga_barang) }}</td>
                                            <td>{{ $x->jumlah}}</td>
                                            <td>Rp. {{ number_format((float) $x->total) }}</td>
                                            <td class="text-center">
                                                <form method="post" id="delete-form-{{ $x->id }}"
                                                    action="{{ route('delete_child', $x->id) }}"
                                                    style="display: none">
                                                    {{ csrf_field() }} {{ method_field('DELETE') }}
                                                </form>
                                                <a class="btn btn-sm btn-danger" href=""
                                                    onclick="if(confirm('Are you sure?'))
                                                    {
                                                        event.preventDefault();document.getElementById('delete-form-{{ $x->id }}').submit();
                                                    }
                                                    else{
                                                        event.preventDefault();
                                                    }">Hapus
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4" style="text-align: center;font-size: 12pt;font-weight: 700">
                                            TOTAL JUMLAH
                                        </td>
                                        <td style="font-size: 15pt;font-weight: 700">
                                            Rp. {{ number_format((float) $data['sum']) }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">

                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
