@extends('layouts.app', ['activePage' => 'pos']) @push('css')
    <link href="{{ asset('argon') }}/datatable/datatables.min.css" rel="stylesheet">
@endpush
@section('content')
    @include('users.partials.header', ['class' => 'col-lg-7'])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0"> <a href="{{ route('pos.index') }}" type="button"
                                    class="btn btn-sm btn-info">{{ __('Back') }}</a> Order
                                    @if ($order->selesai == 1)
                                        <span class="badge badge-success">Selesai</span>
                                    @else
                                        <span class="badge badge-danger">Belum Selesai</span>
                                    @endif </h3>
                                <p>Kode : <b>{{ $order->kode_nota}}</b> <br>
                                    Nama : <b>{{ $order->nama_pembeli}}</b> <br>
                                    No.HP : <b>{{ $order->no_pembeli}}</b>
                                </p>

                            </div>
                            <div class="col-4 text-right">

                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-right mb-2">
                        {{-- @if ($order->selesai == 0)
                        <form method="post" id="update-form-{{ $order->id }}"
                            action="{{ route('update_selesai.order', $order->id) }}"
                            style="display: none">
                            {{ csrf_field() }} {{ method_field('PUT') }}
                        </form>
                        <a class="btn btn-sm btn-success" href=""
                            onclick="if(confirm('Transaksi sudah selesai?'))
                            {
                                event.preventDefault();document.getElementById('update-form-{{ $order->id }}').submit();
                            }
                            else{
                                event.preventDefault();
                            }"><i class="fas fa-check"></i> Selesai
                        </a>
                        @else

                        @endif --}}

                        @if ($order->selesai == 0)
                        <a href="#" class="btn btn-sm btn-success" data-toggle="modal"
                        data-target="#selesai"><i class="fas fa-check"></i> Selesai</a>
                        @else

                        @endif
                        <a target="_blank" href="{{ route('print.order' , $order->id)}}" class="btn btn-sm btn-success" > <i class="fas fa-print"></i> Print </a>
                        <a href="#" class="btn btn-sm btn-primary" data-toggle="modal"
                        data-target="#add_barang">Add Barang</a>

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
                                    @foreach ($data as $x)
                                        <tr>
                                            <td> {{ $x->barangs->kode_barang }} </td>
                                            <td>{{ $x->barangs->nama_barang }} </td>
                                            <td> Rp. {{ number_format((float) $x->barangs->harga_barang) }}</td>
                                            <td>{{ $x->jumlah}}</td>
                                            <td>Rp. {{ number_format((float) $x->total) }}</td>
                                            <td class="text-center">
                                                @if ($order->selesai == 1)
                                                    <span class="badge badge-success">-</span>
                                                @else
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
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4" style="text-align: center;font-size: 12pt;font-weight: 700">
                                            TOTAL JUMLAH
                                        </td>
                                        <td style="font-size: 15pt;font-weight: 700">
                                            Rp. {{ number_format((float) $sum) }}
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
    @include('pos.modal.modal_order_index')
    @include('pos.modal.modal_selesai')
@endsection
@push('js')
    <script src="{{ asset('argon') }}/datatable/datatables.min.js" type="text/javascript"></script>
    {{-- <script type="text/javascript">
        $('#myTable').DataTable();
    </script> --}}
@endpush
