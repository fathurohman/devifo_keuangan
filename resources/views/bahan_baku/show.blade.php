@extends('layouts.app', ['activePage' => 'bahan baku']) @push('css')
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
                                <h3 class="mb-0">Bahan Baku</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('bahan_baku.create') }}" class="btn btn-sm btn-primary">Add
                                    Bahan Baku</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                    </div>
                    <div class="mx-3">
                        <div class="table-responsive">
                            <table id="myTable" class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Nama Bahan Baku</th>
                                        <th scope="col">Stock</th>
                                        <th class="text-center" scope="col">Action</th>
                                        {{-- <th scope="col">Delete</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $x)
                                        <tr>
                                            <td>
                                                {{ $x->nama_bahan }}
                                            </td>
                                            <td>
                                                {{ $x->stock }} {{$x->satuan}}
                                            </td>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <a class="btn btn-primary btn-sm" href="#" role="button"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">Action
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item"
                                                            href="{{ route('bahan_baku.edit', $x->id) }}">Edit</a>
                                                        <form method="post" id="delete-form-{{ $x->id }}"
                                                            action="{{ route('bahan_baku.destroy', $x->id) }}"
                                                            style="display: none">
                                                            {{ csrf_field() }} {{ method_field('DELETE') }}
                                                        </form>
                                                        <a class="dropdown-item" href=""
                                                            onclick="if(confirm('Are you sure?'))
                                                            {
                                                                event.preventDefault();document.getElementById('delete-form-{{ $x->id }}').submit();
                                                            }
                                                            else{
                                                                event.preventDefault();
                                                            }">Hapus
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
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
@endsection
@push('js')
    <script src="{{ asset('argon') }}/datatable/datatables.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $('#myTable').DataTable();
    </script>
@endpush
