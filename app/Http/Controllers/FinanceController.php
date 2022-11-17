<?php

namespace App\Http\Controllers;

use App\Model\Client;
use App\Model\job_order;
use App\Model\jurnal_pembelian_bank;
use App\Model\jurnal_penjualan_bank;
use App\Model\SalesOrder;
use App\Model\Settings;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Terbilang;

class FinanceController extends BaseController
{
    public function index()
    {
        return view('finance.show');
    }

    public function listinvoiceshow()
    {
        $query = SalesOrder::where('published', '1')->where('booked', '0')->orderBy('created_at', 'desc');
        return Datatables::of(
            $query
        )->editColumn('job_order_id', function ($row) {
            return $row->job_orders->order_id;
        })->editColumn('tipe', function ($row) {
            return $row->job_orders->tipe_order;
        })->editColumn('notes', function ($row) {
            return $row->notes;
        })->addColumn('More', function ($row) {
            $data = [
                'id' => $row->id
            ];
            return view('finance.dt.act_list_more', compact('data'));
        })->addColumn('Action', function ($row) {
            $tipe = $row->tipe;
            $printed = $row->printed;
            $data = [
                'id' => $row->id,
                'tipe' => $tipe,
                'printed' => $printed,
            ];
            return view('finance.dt.act_list_cetak', compact('data'));
        })->rawColumns(['action', 'More'])->toJson();
    }

    public function modal_cetak_invoice($id, $tipe)
    {
        $settings = Settings::all();
        $sales_data = SalesOrder::find($id);
        $tipe_cetak = $tipe;
        $date = $sales_data->inv_date;
        return view('finance.detail_invoice', compact('settings', 'sales_data', 'tipe_cetak', 'date'));
    }



    function convertNumber($number)
    {
        list($integer, $fraction) = explode(".", (string) $number);

        $output = "";

        if ($integer[0] == "-") {
            $output = "negative ";
            $integer    = ltrim($integer, "-");
        } else if ($integer[0] == "+") {
            $output = "positive ";
            $integer    = ltrim($integer, "+");
        }

        if ($integer[0] == "0") {
            $output .= "zero";
        } else {
            $integer = str_pad($integer, 36, "0", STR_PAD_LEFT);
            $group   = rtrim(chunk_split($integer, 3, " "), " ");
            $groups  = explode(" ", $group);

            $groups2 = array();
            foreach ($groups as $g) {
                $groups2[] = $this->convertThreeDigit($g[0], $g[1], $g[2]);
            }

            for ($z = 0; $z < count($groups2); $z++) {
                if ($groups2[$z] != "") {
                    $output .= $groups2[$z] . $this->convertGroup(11 - $z) . ($z < 11
                        && !array_search('', array_slice($groups2, $z + 1, -1))
                        && $groups2[11] != ''
                        && $groups[11][0] == '0'
                        ? " and "
                        : ", "
                    );
                }
            }

            $output = rtrim($output, ", ");
        }

        if ($fraction > 0) {
            $output .= " dollars point";
            for ($i = 0; $i < strlen($fraction); $i++) {
                $output .= " " . $this->convertDigit($fraction[$i]);
            }
        }

        return $output . ' cents';
    }

    function convertGroup($index)
    {
        switch ($index) {
            case 11:
                return " decillion";
            case 10:
                return " nonillion";
            case 9:
                return " octillion";
            case 8:
                return " septillion";
            case 7:
                return " sextillion";
            case 6:
                return " quintrillion";
            case 5:
                return " quadrillion";
            case 4:
                return " trillion";
            case 3:
                return " billion";
            case 2:
                return " million";
            case 1:
                return " thousand";
            case 0:
                return "";
        }
    }

    function convertThreeDigit($digit1, $digit2, $digit3)
    {
        $buffer = "";

        if ($digit1 == "0" && $digit2 == "0" && $digit3 == "0") {
            return "";
        }

        if ($digit1 != "0") {
            $buffer .= $this->convertDigit($digit1) . " hundred";
            if ($digit2 != "0" || $digit3 != "0") {
                $buffer .= " and ";
            }
        }

        if ($digit2 != "0") {
            $buffer .= $this->convertTwoDigit($digit2, $digit3);
        } else if ($digit3 != "0") {
            $buffer .= $this->convertDigit($digit3);
        }

        return $buffer;
    }

    function convertTwoDigit($digit1, $digit2)
    {
        if ($digit2 == "0") {
            switch ($digit1) {
                case "1":
                    return "ten";
                case "2":
                    return "twenty";
                case "3":
                    return "thirty";
                case "4":
                    return "forty";
                case "5":
                    return "fifty";
                case "6":
                    return "sixty";
                case "7":
                    return "seventy";
                case "8":
                    return "eighty";
                case "9":
                    return "ninety";
            }
        } else if ($digit1 == "1") {
            switch ($digit2) {
                case "1":
                    return "eleven";
                case "2":
                    return "twelve";
                case "3":
                    return "thirteen";
                case "4":
                    return "fourteen";
                case "5":
                    return "fifteen";
                case "6":
                    return "sixteen";
                case "7":
                    return "seventeen";
                case "8":
                    return "eighteen";
                case "9":
                    return "nineteen";
            }
        } else {
            $temp = $this->convertDigit($digit2);
            switch ($digit1) {
                case "2":
                    return "twenty-$temp";
                case "3":
                    return "thirty-$temp";
                case "4":
                    return "forty-$temp";
                case "5":
                    return "fifty-$temp";
                case "6":
                    return "sixty-$temp";
                case "7":
                    return "seventy-$temp";
                case "8":
                    return "eighty-$temp";
                case "9":
                    return "ninety-$temp";
            }
        }
    }

    function convertDigit($digit)
    {
        switch ($digit) {
            case "0":
                return "zero";
            case "1":
                return "one";
            case "2":
                return "two";
            case "3":
                return "three";
            case "4":
                return "four";
            case "5":
                return "five";
            case "6":
                return "six";
            case "7":
                return "seven";
            case "8":
                return "eight";
            case "9":
                return "nine";
        }
    }

    public function order_row($tipe, $month, $year)
    {
        // inv_date sebelumnya crated_at

        $jml_by_month = SalesOrder::whereMonth('inv_date', $month)->whereYear('inv_date', $year)
            ->where([
                ['tipe', '=', $tipe],
            ])
            ->count();
        $urutan = SalesOrder::select('order_row')->where('tipe', $tipe)
            ->whereMonth('inv_date', $month)->whereYear('inv_date', $year)->get();
        $results = array();
        foreach ($urutan as $query) {
            $order_row = $query->order_row;
            array_push($results, $order_row);
        }
        $max = max($results);
        if ($jml_by_month == '0') {
            $order_month = '1';
        } else {
            //ini ambil nilai max di kolom
            $order_month = $max + 1;
        }
        return $order_month;
    }

    public function cetak_invoice_dua(Request $request)
    {
        $date = $request->inv_date;
        $id = $request->id_sales;
        if (empty($date)) {
            $now = Carbon::now()->format('Y-m-d');
        } else {
            $now = $date;
        }
        //update inv date di awal
        SalesOrder::where('id', $id)->update([
            'inv_date' => $now,
        ]);

        $tipe = $request->tipe_cetak;
        $pajak = $request->tipe_pajak;
        $sum = 0;
        $sales_order = SalesOrder::find($id);
        $tipe = $sales_order->tipe;
        //no invoice
        // $year = Carbon::now()->format('Y');
        // $tahun = Carbon::now()->format('y');
        // $month = Carbon::now()->format('m');
        $tahun = $sales_order->created_at->format('y');
        $year = $sales_order->created_at->format('Y');
        // $month = $request->inv_date;
        // mengambil format inv_date
        $month = Carbon::createFromFormat('Y-m-d', $now)->format('m');



        // $order_month = $jml_by_month + 1;
        if ($sales_order->printed == '1') {
            $order_month = $sales_order->order_row;
        } else {
            $order_month = $this->order_row($tipe, $month, $year);
        }
        //check inv
        if ($sales_order->nomor_invoice == '-') {
            $inv = "$order_month/SGM/$tipe/$month/$tahun";
        } else {
            $inv = $sales_order->nomor_invoice;
        }
        //end no invoice
        //update invoice dan status
        SalesOrder::where('id', $id)->update([
            'printed' => '1',
            'vat' => $pajak,
            'order_row' => $order_month,
            'nomor_invoice' => $inv,
            // 'inv_date' => $now,
        ]);
        //end update
        $ptng = sprintf('%03d', $inv);
        $sub_string = substr($inv, strpos($inv, "/") + 1);
        $inv_fix = "$ptng/$sub_string";
        $sales_job = $sales_order->job_orders;
        // dd($selling);
        // $createdAt = Carbon::parse($sales_order->inv_date);
        $tanggal = date('M d,Y', strtotime($now));
        // $tanggal = $createdAt->format('M d,Y');
        $ETD = $sales_job->ETD;
        $ETA = $sales_job->ETA;
        $id_job = $sales_job->id;
        job_order::where('id', $id_job)->update([
            'printed' => '1',
        ]);
        $x_etd = date('M d,Y', strtotime($ETD));
        $x_eta = date('M d,Y', strtotime($ETA));
        // $customer = $sales_job->client_id;
        // $list_customer = Client::find($customer);
        $selling = SalesOrder::find($id)->sellings;
        $jumlah_penjualan = count($selling);
        foreach ($selling as $x) {
            $sub_total = $x->sub_total;
            $sum += $sub_total;
            $curr = $x->curr;
            $customer = $x->name;
        }
        // $pajak = Settings::where('name', 'Pajak')->first();
        // $nilai_pajak = $pajak->value;
        $vat = $pajak / 100;
        $itung_pajak = $sum * $vat;
        if ($curr == 'IDR') {
            $total_pajak = (int)$itung_pajak;
            $total_charge = $sum + $total_pajak;
            $terbilang = ucwords(Terbilang::make($total_charge, ' rupiah'));
            $terbilang_dn = ucwords(Terbilang::make($sum, ' rupiah'));
        } else {
            App::setLocale('en');
            $total_pajak = $itung_pajak;
            $total_charge = $sum + $total_pajak;
            $cek_sen = count(explode(".", $sum));
            if ($cek_sen == '1') {
                $terbilang = ucwords(Terbilang::make($total_charge, ' dollars#', '# '));
                $terbilang_dn = ucwords(Terbilang::make($sum, ' dollars#', '# '));
            } else {
                $sum_dec = number_format((float) $sum, 2, '.', '');
                $terbilang = $this->convertNumber($total_charge);
                $terbilang_dn = $this->convertNumber($sum_dec);
            }
        }
        $list_customer = Client::where('COMPANY_NAME', $customer)->first();
        $name = Auth::user()->name;
        // $terbilang = Terbilang::make(2858250, ' rupiah');
        $data = array(
            'inv' => $inv_fix,
            'sales_order' => $sales_order,
            'sales_job' => $sales_job,
            'selling' => $selling,
            'tanggal' => $tanggal,
            'ETD' => $x_etd,
            'ETA' => $x_eta,
            'customer' => $list_customer,
            'terbilang' => $terbilang,
            'terbilang_dn' => $terbilang_dn,
            'sum' => $sum,
            'nilai_pajak' => $pajak,
            'total_pajak' => $total_pajak,
            'total_charge' => $total_charge,
            'curr' => $curr,
            'name' => $name,
            'jumlah_penjualan' => $jumlah_penjualan,
        );
        if ($tipe == 'I') {
            $view = View('pdf.invoice_pdf', ['data' => $data]);
        } else {
            $view = View('pdf.invoice_dn', ['data' => $data]);
        }
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view->render())->setPaper('a4', 'portrait');
        return $pdf->stream();
    }

    public function returntosales($id)
    {
        SalesOrder::where('id', $id)->update(['published' => '0']);
        return redirect()->back();
    }

    public function data_sum_buying($id)
    {
        return DB::select('SELECT buying_orders.curr AS curr, sum(buying_orders.sub_total ) AS sub_total,
        buying_orders.name AS customers, sales_orders.inv_date as inv_date,
    			sales_orders.nomor_invoice AS nomor_invoice, sales_orders.job_order_id,
    			buying_orders.sales_order_id as sales_id
        FROM sales_orders
        INNER JOIN buying_orders ON sales_orders.id=buying_orders.sales_order_id
    	where sales_orders.booked = 1 and sales_orders.id = "' . $id . '"
        GROUP BY buying_orders.curr,buying_orders.name, sales_orders.inv_date, sales_orders.nomor_invoice,
        sales_orders.job_order_id,buying_orders.sales_order_id');
    }

    public function pembukuan($id)
    {
        SalesOrder::where('id', $id)->update(['booked' => '1']);
        $sales = SalesOrder::where([
            ['id', '=', $id],
            ['booked', '=', '1'],
        ])->first();
        $sum_idr = 0;
        $sum_usd = 0;
        $sum_usd_total = 0;
        $id = $sales->id;
        if (empty($sales->vat)) {
            $pajak = 0;
        } else {
            $pajak = $sales->vat;
        }
        $tanggal_inv = $sales->inv_date;
        $no_inv = $sales->nomor_invoice;
        $ptng = sprintf('%03d', $no_inv);
        $sub_string = substr($no_inv, strpos($no_inv, "/") + 1);
        $trans_no = "$ptng/$sub_string";
        $description = $sales->job_orders->order_id;
        //pembelian bank
        $j_bank_pembelian = jurnal_pembelian_bank::where('sales_order_id', $id)->count();
        if ($j_bank_pembelian == '0') {
            $buying = $this->data_sum_buying($id);
            foreach ($buying as $y) {
                $curr_b = $y->curr;
                $sub_total_b = $y->sub_total;
                if ($curr_b == 'IDR') {
                    $nilai_usd = '0';
                } else {
                    $nilai_usd = $this->skomak($sub_total_b);
                }
                $customer_b = $y->customers;
                if ($sales->tipe == 'I') {
                    $vat_b = 1.11 / 100;
                    $pph_b = $sub_total_b * (2 / 100);
                    $total_pajak_b = $sub_total_b * $vat_b;
                    $pok_penjualan = $sub_total_b - $total_pajak_b;
                    $Admin = array(
                        'sales_order_id' => $id,
                        'trans_date' => $tanggal_inv,
                        'inv_No' => $trans_no,
                        'Customer' => $customer_b,
                        'description' => "A/p JOB $description",
                        'coa_id' => '386',
                        'debit' => $pph_b,
                        'credit' => '0',
                        'ending_balance' => $pph_b,
                        'inv_us' => '0',
                        'bs_pl' => 'PL',
                    );
                    $hutang_pajak = array(
                        'sales_order_id' => $id,
                        'trans_date' => $tanggal_inv,
                        'inv_No' => $trans_no,
                        'Customer' => $customer_b,
                        'description' => "A/p JOB $description",
                        'coa_id' => '195',
                        'debit' => '0',
                        'credit' => $pph_b,
                        'ending_balance' => $pph_b,
                        'inv_us' => '0',
                        'bs_pl' => 'BS',
                    );
                    $ppn = array(
                        'sales_order_id' => $id,
                        'trans_date' => $tanggal_inv,
                        'inv_No' => $trans_no,
                        'Customer' => $customer_b,
                        'description' => "A/p JOB $description",
                        'coa_id' => '189',
                        'debit' => $total_pajak_b,
                        'credit' => '0',
                        'ending_balance' => $total_pajak_b,
                        'inv_us' => '0',
                        'bs_pl' => 'PL',
                    );
                } else {
                    $Admin = NULL;
                    $hutang_pajak = NULL;
                    $ppn = NULL;
                    $total_charge = '0';
                }
                $hutang_dagang = array(
                    'sales_order_id' => $id,
                    'trans_date' => $tanggal_inv,
                    'inv_No' => $trans_no,
                    'Customer' => $customer_b,
                    'description' => "A/p JOB $description",
                    'coa_id' => '155',
                    'debit' => $nilai_usd,
                    'credit' => '0',
                    'ending_balance' => $nilai_usd,
                    'inv_us' => $nilai_usd,
                    'bs_pl' => 'PL',
                );
                $pokok = array(
                    'sales_order_id' => $id,
                    'trans_date' => $tanggal_inv,
                    'inv_No' => $trans_no,
                    'Customer' => $customer_b,
                    'description' => "A/p JOB $description",
                    'coa_id' => '253',
                    'debit' => $pok_penjualan,
                    'credit' => '0',
                    'ending_balance' => $pok_penjualan,
                    'inv_us' => $nilai_usd,
                    'bs_pl' => 'PL',
                );
                $bca = array(
                    'sales_order_id' => $id,
                    'trans_date' => $tanggal_inv,
                    'inv_No' => $trans_no,
                    'Customer' => $customer_b,
                    'description' => "A/p JOB $description",
                    'coa_id' => '155',
                    'debit' => '0',
                    'credit' => $sub_total_b,
                    'ending_balance' => $sub_total_b,
                    'inv_us' => $nilai_usd,
                    'bs_pl' => 'BS',
                );
                if ($curr_b == 'IDR') {
                    jurnal_pembelian_bank::insert($pokok);
                    jurnal_pembelian_bank::insert($bca);
                    if (!empty($ppn) && !empty($Admin) && !empty($hutang_pajak)) {
                        jurnal_pembelian_bank::insert($ppn);
                        jurnal_pembelian_bank::insert($Admin);
                        jurnal_pembelian_bank::insert($hutang_pajak);
                    }
                } else {
                    jurnal_pembelian_bank::insert($hutang_dagang);
                }
            }
        }
        //penjualan bank
        $j_bank_penjualan = jurnal_penjualan_bank::where('sales_order_id', $id)->count();
        if ($j_bank_penjualan == '0') {
            // $date_inv = date('d-F-Y', strtotime($tanggal_inv));
            $selling = SalesOrder::find($id)->sellings;
            foreach ($selling as $y) {
                $curr = $y->curr;
                $sub_total = $y->sub_total;
                if ($curr == 'IDR') {
                    $sum_usd = 0;
                    $sum_idr += $sub_total;
                } elseif ($curr == 'USD') {
                    $sum_idr = 0;
                    $sum_usd_total += $sub_total;
                    $sum_usd = $this->skomak($sum_usd_total);
                } else {
                    $sum_idr = 0;
                    $sum_usd = 0;
                }
                $customer = $y->name;
            }
            if ($sales->tipe == 'I') {
                $vat = $pajak / 100;
                $pph = $sum_idr * (2 / 100);
                $total_pajak = $sum_idr * $vat;
                $total_charge = $sum_idr + $total_pajak;
                $with_pajak = $total_charge - $pph;
                $no_faktur = "-";
                $pph = array(
                    'sales_order_id' => $id,
                    'trans_date' => $tanggal_inv,
                    'Customer' => $customer,
                    'inv_No' => 'SGM/BCA IDR/IX/xx/xx',
                    'description' => "A/R $description $trans_no ($description)",
                    'coa_id' => '87',
                    'debit' => $pph,
                    'credit' => '0',
                    'ending_balance' => $pph,
                    'inv_us' => $sum_usd,
                    'kurs_idr' => '0',
                    'bs_pl' => 'BS',
                    'no_faktur' => $no_faktur,
                );
                $penjualan = array(
                    'sales_order_id' => $id,
                    'trans_date' => $tanggal_inv,
                    'Customer' => $customer,
                    'inv_No' => 'SGM/BCA IDR/IX/xx/xx',
                    'description' => "A/R $description $trans_no ($description)",
                    'coa_id' => '14',
                    'debit' => $with_pajak,
                    'credit' => '0',
                    'ending_balance' => $with_pajak,
                    'inv_us' => $sum_usd,
                    'kurs_idr' => '0',
                    'no_faktur' => $no_faktur,
                    'bs_pl' => 'PL',
                );
            } else {
                $vat = 0;
                $pph = 0;
                $total_charge = $sum_idr;
                $no_faktur = "DEBIT NOTE";
                $pph = NULL;
            }
            if ($curr == 'IDR') {
                $piutang = array(
                    'sales_order_id' => $id,
                    'trans_date' => $tanggal_inv,
                    'Customer' => $customer,
                    'inv_No' => 'SGM/BCA IDR/IX/xx/xx',
                    'description' => "A/R $description $trans_no ($description)",
                    'coa_id' => '38',
                    'debit' => '0',
                    'credit' => $total_charge,
                    'ending_balance' => $total_charge,
                    'inv_us' => $sum_usd,
                    'kurs_idr' => '0',
                    'no_faktur' => $no_faktur,
                    'bs_pl' => 'BS',
                );
            } else {
                $piutang = array(
                    'sales_order_id' => $id,
                    'trans_date' => $tanggal_inv,
                    'Customer' => $customer,
                    'inv_No' => 'SGM/BCA USD/IX/xx/xx',
                    'description' => "A/R $description $trans_no ($description)",
                    'coa_id' => '38',
                    'debit' => '0',
                    'credit' => $sum_usd,
                    'ending_balance' => $sum_usd,
                    'inv_us' => $sum_usd,
                    'kurs_idr' => '0',
                    'no_faktur' => $no_faktur,
                    'bs_pl' => 'BS',
                );
            }

            // echo var_dump($pph) . "<br>";

            // echo var_dump($piutang) . "<br>";

            // dd($penjualan);
            jurnal_penjualan_bank::insert($piutang);
            if (!empty($penjualan)) {
                jurnal_penjualan_bank::insert($penjualan);
            }
            if (!empty($pph)) {
                jurnal_penjualan_bank::insert($pph);
            }
        } else {
            return 'data available';
        }
        return redirect()->back();
    }


    public function skomak($usd)
    {
        // Fetching JSON
        $req_url = 'https://api.exchangerate-api.com/v4/latest/USD';
        $response_json = file_get_contents($req_url);

        // Continuing if we got a result
        if (false !== $response_json) {

            // Try/catch for json_decode operation
            try {

                // Decoding
                $response_object = json_decode($response_json);

                // YOUR APPLICATION CODE HERE, e.g.
                $base_price = $usd; // Your price in USD
                $IDR_price = round(($base_price * $response_object->rates->IDR), 2);
                return $IDR_price;
            } catch (Exception $e) {
                return 'error';
            }
        }
    }
}
