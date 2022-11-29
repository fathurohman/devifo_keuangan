<?php

namespace App\Http\Controllers;

use App\Exports\JPembelianExport;
use App\Exports\JPenjualanExport;
use App\Exports\MultiExport;
use App\Model\JurnalPembelian;
use App\Model\JurnalPenjualan;
use App\Model\SalesOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class JurnalController extends Controller
{
    public function index()
    {
        return view('jurnal.jurnal');
    }

    public function export_jurnal(Request $request)
    {
        $start = $request->start;
        $end = $request->end;
        $this->tarik_penjualan($start, $end);
        $this->tarik_pembelian($start, $end);
        $download = Excel::download(new MultiExport($start, $end), 'JURNAL.xlsx');
        return $download;
    }

    public function tarik_penjualan($start, $end)
    {
        $sales = SalesOrder::whereBetween('inv_date', [$start, $end])
            ->where([
                ['printed', '=', '1'],
                ['published', '=', '1'],
                ['booked', '=', '1'],
            ])->get();
        foreach ($sales as $x) {
            $sum_idr = 0;
            $sum_usd = 0;
            $id = $x->id;
            $j_penjualan = JurnalPenjualan::where('sales_order_id', $id)->get();
            if ($j_penjualan->isEmpty()) {
                if (empty($x->vat)) {
                    $pajak = 0;
                } else {
                    $pajak = $x->vat;
                }
                $tanggal_inv = $x->inv_date;
                // $date_inv = date('d-F-Y', strtotime($tanggal_inv));
                $no_inv = $x->nomor_invoice;
                $ptng = sprintf('%03d', $no_inv);
                $sub_string = substr($no_inv, strpos($no_inv, "/") + 1);
                $trans_no = "$ptng/$sub_string";
                $description = $x->job_orders->order_id;
                $selling = SalesOrder::find($id)->sellings;
                foreach ($selling as $y) {
                    $curr = $y->curr;
                    $sub_total = $y->sub_total;
                    if ($curr == 'IDR') {
                        $sum_usd = 0;
                        $sum_idr += $sub_total;
                    } elseif ($curr == 'USD') {
                        $sum_idr = 0;
                        $sum_usd += $sub_total;
                    } else {
                        $sum_idr = 0;
                        $sum_usd = 0;
                    }
                    $customer = $y->name;
                }
                // $status_bayar = "-";
                // $tgl_pay = "-";
                if ($x->tipe == 'I') {
                    $vat = $pajak / 100;
                    $total_pajak = $sum_idr * $vat;
                    $total_charge = $sum_idr + $total_pajak;
                    $no_faktur = "-";
                    $ppn = array(
                        'sales_order_id' => $id,
                        'trans_date' => $tanggal_inv,
                        'Customer' => $customer,
                        'inv_No' => $trans_no,
                        'description' => $description,
                        'coa_id' => '6',
                        'debit' => '0',
                        'credit' => $total_pajak,
                        'ending_balance' => $total_pajak,
                        'inv_us' => $sum_usd,
                        'kurs_idr' => '0',
                        'bs_pl' => 'BS',
                        'no_faktur' => $no_faktur,
                        // 'status_bayar' => $status_bayar,
                        // 'tgl_pay' => $tgl_pay,
                    );
                } else {
                    $vat = 0;
                    $total_pajak = 0;
                    $total_charge = $sum_idr;
                    $no_faktur = "DEBIT NOTE";
                    $ppn = NULL;
                }
                $piutang = array(
                    'sales_order_id' => $id,
                    'trans_date' => $tanggal_inv,
                    'Customer' => $customer,
                    'inv_No' => $trans_no,
                    'description' => $description,
                    'coa_id' => '4',
                    'debit' => $total_charge,
                    'credit' => '0',
                    'ending_balance' => $total_charge,
                    'inv_us' => $sum_usd,
                    'kurs_idr' => '0',
                    'no_faktur' => $no_faktur,
                    'bs_pl' => 'BS',
                    // 'status_bayar' => $status_bayar,
                    // 'tgl_pay' => $tgl_pay,
                );
                $penjualan = array(
                    'sales_order_id' => $id,
                    'trans_date' => $tanggal_inv,
                    'Customer' => $customer,
                    'inv_No' => $trans_no,
                    'description' => $description,
                    'coa_id' => '31',
                    'debit' => '0',
                    'credit' => $sum_idr,
                    'ending_balance' => $sum_idr,
                    'inv_us' => $sum_usd,
                    'kurs_idr' => '0',
                    'no_faktur' => $no_faktur,
                    'bs_pl' => 'PL',
                    // 'status_bayar' => $status_bayar,
                    // 'tgl_pay' => $tgl_pay,
                );
                // echo var_dump($ppn) . "<br>";

                // echo var_dump($piutang) . "<br>";

                // dd($penjualan);
                JurnalPenjualan::insert($piutang);
                JurnalPenjualan::insert($penjualan);
                if (!empty($ppn)) {
                    JurnalPenjualan::insert($ppn);
                }
            } else {
                return 'data available';
            }
        }
    }

    public function data_sum_buying($start, $end)
    {
        return DB::select('SELECT buying_orders.curr AS curr, sum(buying_orders.sub_total ) AS sub_total,
        buying_orders.name AS customers, sales_orders.inv_date as inv_date,
				sales_orders.nomor_invoice AS nomor_invoice, sales_orders.job_order_id,
				buying_orders.sales_order_id as sales_id, sales_orders.tipe as tipe
        FROM sales_orders
        INNER JOIN buying_orders ON sales_orders.id=buying_orders.sales_order_id
		where sales_orders.created_at between "' . $start . '" and "' . $end . '"
        and sales_orders.booked = 1
		GROUP BY buying_orders.curr,buying_orders.name, sales_orders.inv_date, sales_orders.nomor_invoice,
        sales_orders.job_order_id,buying_orders.sales_order_id, sales_orders.tipe');
    }
    public function tarik_pembelian($start, $end)
    {
        $buying = $this->data_sum_buying($start, $end);
        // dd($buying);
        foreach ($buying as $y) {
            $id = $y->sales_id;
            $curr = $y->curr;
            $sub_total = $y->sub_total;
            $customer = $y->customers;
            $tanggal_inv = $y->inv_date;
            $tipe = $y->tipe;
            $description = $y->job_order_id;
            // $date_inv = date('d-F-Y', strtotime($tanggal_inv));
            $no_inv = $y->nomor_invoice;
            $ptng = sprintf('%03d', $no_inv);
            $sub_string = substr($no_inv, strpos($no_inv, "/") + 1);
            $trans_no = "$ptng/$sub_string";
            $vat = 1.1 / 100;
            $pph = $sub_total * (2 / 100);
            $total_pajak = $sub_total * $vat;
            $total_charge = $sub_total + $total_pajak;
            $j_pembelian = JurnalPembelian::where('sales_order_id', $id)->where('nilai_trans', $sub_total)->count();
            if ($j_pembelian == '0') {
                if ($curr == 'IDR') {
                    $nilai_usd = '0';
                    if ($tipe == 'I') {
                        $Admin = array(
                            'sales_order_id' => $id,
                            'job_order_id' => $description,
                            'trans_date' => $tanggal_inv,
                            'inv_No' => $trans_no,
                            'description' => "A/p $customer",
                            'coa_id' => '35',
                            'debit' => $pph,
                            'credit' => '0',
                            'ending_balance' => $pph,
                            'inv_usd' => '0',
                            'nilai_trans' => $sub_total,
                            'bs_pl' => 'PL',
                        );
                        $hutang_pajak = array(
                            'sales_order_id' => $id,
                            'job_order_id' => $description,
                            'trans_date' => $tanggal_inv,
                            'inv_No' => $trans_no,
                            'description' => "A/p $customer",
                            'coa_id' => '22',
                            'debit' => '0',
                            'credit' => $pph,
                            'ending_balance' => $pph,
                            'inv_usd' => '0',
                            'nilai_trans' => $sub_total,
                            'bs_pl' => 'BS',
                        );
                        $ppn = array(
                            'sales_order_id' => $id,
                            'job_order_id' => $description,
                            'trans_date' => $tanggal_inv,
                            'inv_No' => $trans_no,
                            'description' => "A/p $customer",
                            'coa_id' => '51',
                            'debit' => $total_pajak,
                            'credit' => '0',
                            'ending_balance' => $total_pajak,
                            'inv_usd' => '0',
                            'nilai_trans' => $sub_total,
                            'bs_pl' => 'PL',
                        );
                    } else {
                        $Admin = NULL;
                        $hutang_pajak = NULL;
                        $ppn = NULL;
                        $total_charge = $sub_total;
                        $nilai_usd = '0';
                    }
                } else {
                    $Admin = NULL;
                    $hutang_pajak = NULL;
                    $ppn = NULL;
                    $total_charge = $this->skomak($sub_total);
                    $nilai_usd = $sub_total;
                }
                $pembelian = array(
                    'sales_order_id' => $id,
                    'job_order_id' => $description,
                    'trans_date' => $tanggal_inv,
                    'inv_No' => $trans_no,
                    'description' => "A/p $customer",
                    'coa_id' => '33',
                    'debit' => $total_charge,
                    'credit' => '0',
                    'ending_balance' => $total_charge,
                    'inv_usd' => $nilai_usd,
                    'nilai_trans' => $sub_total,
                    'bs_pl' => 'PL',
                );
                $hutang = array(
                    'sales_order_id' => $id,
                    'job_order_id' => $description,
                    'trans_date' => $tanggal_inv,
                    'inv_No' => $trans_no,
                    'description' => "A/p $customer",
                    'coa_id' => '18',
                    'debit' => '0',
                    'credit' => $total_charge,
                    'ending_balance' => $total_charge,
                    'inv_usd' => $nilai_usd,
                    'nilai_trans' => $sub_total,
                    'bs_pl' => 'BS',
                );
                // dd($hutang);
                JurnalPembelian::insert($pembelian);
                JurnalPembelian::insert($hutang);
                if (!empty($ppn) && !empty($Admin) && !empty($hutang_pajak)) {
                    JurnalPembelian::insert($ppn);
                    JurnalPembelian::insert($Admin);
                    JurnalPembelian::insert($hutang_pajak);
                }
            } else {
                return 'data available';
            }
            $sub_total = 0;
        }
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
