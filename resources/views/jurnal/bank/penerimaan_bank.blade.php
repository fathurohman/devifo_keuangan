@extends('layouts.app', ['activePage' => 'kas_bank'])
@push('css')
    <link href="{{ asset('argon') }}/datatable/datatables.min.css" rel="stylesheet">
    <link href="{{ asset('argon') }}/css/dt.css" rel="stylesheet">
@endpush
@section('content')
    @include('users.partials.header', [
        'class' => 'col-lg-7',
    ])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Add Cash Bank') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('store.coa') }}" autocomplete="off" id="form-order">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">{{ __('Fill this form') }}</h6>

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('status_coa') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                            for="input-status_coa">{{ __('status_coa') }}</label>
                                        <select name="status_coa_id" id="status_coa_id"
                                            class="form-control form-control-alternative{{ $errors->has('status_coa') ? ' is-invalid' : '' }}"
                                            aria-label="status_coa:">
                                            <option selected>Open this select menu</option>
                                            <option value="penerimaan">Penerimaan</option>
                                            <option value="pengeluaran">Pengeluaran</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('no_coa') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-no_coa">{{ __('no_coa') }}</label>
                                        <input type="text" name="no_coa" id="input-no_coa"
                                            class="form-control form-control-alternative{{ $errors->has('no_coa') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('no_coa') }}" required readonly>
                                        @if ($errors->has('no_coa'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('no_coa') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-control-label" for="input-coa">{{ __('coa') }}</label>
                                    <div class="input-group">
                                        <input id="coa-field" type="text" class="form-control" placeholder="coa"
                                            aria-label="coa" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#coaList">
                                                Find
                                            </button>
                                        </div>
                                    </div>
                                    <input id="coa-field-id" type="text" class="form-control" placeholder="coa"
                                        name="coa_id" hidden>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('voucher_no') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                            for="input-voucher_no">{{ __('voucher_no') }}</label>
                                        <input type="text" name="voucher_no" id="input-voucher_no"
                                            class="form-control form-control-alternative{{ $errors->has('voucher_no') ? ' is-invalid' : '' }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div style="display:none" id="cheque" class="form-group">
                                        <label class="form-control-label"
                                            for="input-cheque_no">{{ __('cheque_no') }}</label>
                                        <input type="text" name="cheque_no" id="input-cheque_no"
                                            class="form-control form-control-alternative">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-Date">{{ __('Date') }}</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input id="Date" name="Date" class="form-control datepicker"
                                                placeholder="Select date" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <label class="form-control-label" for="input-memo">{{ __('memo') }}</label>
                                    <textarea name="memo" class="form-control" id="memo" rows="3" placeholder="Catatan tambahan..."></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div style="display:none" id="payee" class="col-lg-8 col-md-8 col-sm-12">
                                    <label class="form-control-label" for="input-payee">{{ __('payee') }}</label>
                                    <textarea name="payee" class="form-control" id="payee" rows="3" placeholder="Catatan tambahan..."></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-amount">{{ __('amount') }}</label>
                                        <input type="text" id="input-amount"
                                            class="form-control form-control-alternative"
                                            placeholder="{{ __('amount') }}" required>
                                        <input type="text" name="amount" id="input-amount-real"
                                            class="form-control form-control-alternative"
                                            placeholder="{{ __('amount') }}" hidden>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-control-label"
                                            for="input-kurs_idr">{{ __('Kurs IDR') }}</label>
                                        <input type="text" id="input-kurs-idr"
                                            class="form-control form-control-alternative"
                                            placeholder="{{ __('kurs_idr') }}" required>
                                        <input type="text" name="kurs_idr" id="input-kurs-idr-real"
                                            class="form-control form-control-alternative" hidden>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-total">{{ __('Total') }}</label>
                                        <input type="text" id="input-total"
                                            class="form-control form-control-alternative"
                                            placeholder="{{ __('total') }}" readonly>
                                        <input type="text" name="total" id="input-total-real"
                                            class="form-control form-control-alternative" hidden>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label class="form-control-label" for="input-account">{{ __('Account') }}</label>
                                    <div>
                                        <table id="account" class="table-selling align-items-center table-flush">
                                            <thead class="thead-light">
                                                <th>Account No</th>
                                                <th>Account Name</th>
                                                <th>Amount</th>
                                                <th>Memo</th>
                                                <th>Department</th>
                                                <th>Project</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody class="account">
                                                <tr class="row-account">
                                                    <td><input class="form-control account_no" type="text"
                                                            id="account_no" name="account_no[]" readonly>
                                                    </td>
                                                    <td><input class="form-control autosuggest ui-widget" type="text"
                                                            id="account_name" name="account_name[]">
                                                        <input class="form-control account_id" type="text"
                                                            id="account_id" name="account_id[]" hidden>
                                                    </td>
                                                    <td><input class="form-control amount_c" type="text"
                                                            id="amount_c">
                                                        <input class="form-control amount_real" type="text"
                                                            id="amount_real" name="amount_c[]" hidden>
                                                    </td>
                                                    <td><input class="form-control memo" type="text" id="memo"
                                                            name="memo_c[]">
                                                    </td>
                                                    <td><input class="form-control department" id="department"
                                                            name="department[]">
                                                    </td>
                                                    <td><input type="text" id="project" class="form-control project"
                                                            name="project[]">
                                                    </td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-sm"
                                                            id="addkolom"><i class="fa fa-plus"></i></a>
                                                        <a href="#" id="refreshkolom"
                                                            class="btn btn-warning btn-sm refresh"><i
                                                                class="fa fa-spinner"></i></a>
                                                        <a href="#" id="removekolom"
                                                            class="btn btn-danger btn-sm remove"><i
                                                                class="fa fa-times"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                <a href="#" type="button" class="btn btn-info mt-4">{{ __('Back') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('jurnal.bank.jurnalbanklist')
    @include('layouts.footers.auth')
@endsection
@push('js')
    <script src="/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('argon') }}/datatable/datatables.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('argon/js/bank.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $('tbody').on('focus', ".autosuggest", function() {
                var tr = $(this).parent().parent();
                // console.log(tipeatk);
                $(this).autocomplete({
                    source: "{{ URL('coa/autocomplete') }}",
                    // source: "{{ URL('search/autocompletenama') }}",
                    minLength: 1,
                    select: function(event, ui) {
                        // tr.find('.qty').val("");
                        // $('#selectnip').val(ui.item.value);
                        tr.find('.account_no').val(ui.item.kode);
                        tr.find('.autosuggest').val(ui.item.value);
                        tr.find('.account_id').val(ui.item.id);
                    }
                })
            })
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#coa').DataTable({
                processing: true,
                serverSide: true,
                drawCallback: function(settings) {
                    $('.infoU').click(function() {
                        $currID = $(this).attr("data-id");
                        $('#input-no_coa').val('');
                        $('#coa-field').val('');
                        $('#coa-field-id').val('');
                        // alert($currID);
                        $.get('/coa_data?pid=' + $currID, function(data) {
                            $('#input-no_coa').val(data.kd_aktiva);
                            $('#coa-field').val(data.jns_trans);
                            $('#coa-field-id').val(data.id);
                            // console.log(data);
                            // For debugging purposes you can add : console.log(data); to see the output of your request
                        });
                        $('#coaList').modal('toggle');
                        // $('#coa-field').val($currID);
                    });
                },
                ajax: '{!! route('listcoa') !!}',
                columns: [{
                        data: 'kd_aktiva',
                        name: 'kd_aktiva'
                    },
                    {
                        data: 'jns_trans',
                        name: 'jns_trans'
                    },
                    {
                        data: 'Action',
                        name: 'Action',
                        searchable: false,
                        orderable: false
                    },
                ]
            });
        });
    </script>
@endpush
