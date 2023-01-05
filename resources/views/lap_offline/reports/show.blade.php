@extends('layouts.app', ['activePage' => 'reports laporan offline'])
@push('css')
    <link href="{{ asset('argon') }}/datatable/datatables.min.css" rel="stylesheet">
@endpush
@section('content')
    @include('users.partials.header', [
        'class' => 'col-lg-7',
    ])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Reports Laporan Offline</h3>
                            </div>
                        </div>
                    </div>
                    <form method="post" action="{{ route('export_lo') }}" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                    <div class="row mt-5">
                        <div class="col-xl-6 mb-5 mb-xl-0">
                            <div class="card shadow">
                                <div class="card-header border-0">
                                    <label for="inputState">Bulan</label>
                                    <select id="bulan" name="bulan" class="form-control" required>
                                        <option selected value="">Pilih Bulan...</option>
                                        @foreach ($month as $key => $m)
                                            <option value="{{ $key }}">{{ $m }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 mb-5 mb-xl-0">
                            <div class="card shadow">
                                <div class="card-header border-0">
                                    <label for="inputState">Tahun</label>
                                    <input id="tahun" name="tahun" value="{{Carbon\Carbon::now()->format('Y')}}" type="number" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="ml-3 mt-2 col-lg-6 col-md-6 col-sm-6">
                            <button type="submit" class="btn btn-primary">{{ __('Export Excel') }}</button>
                        </div>
                    </div>
                    </form>

                </div>
                <div id="table-lo"></div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script src="{{ asset('argon') }}/datatable/datatables.min.js" type="text/javascript"></script>

    <script type="text/javascript">

            function narikdata(bulan, tahun){
                $.ajax({
                    url: "{{ route('GetLo')}}",
                    method: "GET",
                    dataType: "json",
                    data: {
                        bulan: bulan,
                        tahun:tahun
                    },
                    success: function(data){
                        $('#table-lo').html(data.html);
                        console.log(data);
                    }
                });
            }

            $("#bulan").change(function(){
                    var bulan = $('#bulan').val();
                    var tahun = $('#tahun').val();

                    narikdata(bulan, tahun);
            });
            $("#tahun").change(function(){
                    var bulan = $('#bulan').val();
                    var tahun = $('#tahun').val();

                    narikdata(bulan, tahun);
            });
    </script>


@endpush
