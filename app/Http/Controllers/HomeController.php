<?php

namespace App\Http\Controllers;

use App\Model\SellingOrder;
use App\Model\order;
use App\Model\child_order;
use App\Model\lap_offline;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function data_sum_selling($month, $year, $params)
    {
        return DB::select('SELECT selling_orders.curr AS curr, sum(selling_orders.sub_total ) AS sub_total
        FROM sales_orders
        INNER JOIN selling_orders ON sales_orders.id=selling_orders.sales_order_id
		where MONTH(sales_orders.created_at) = ' . $month . '
        and YEAR(sales_orders.created_at) = ' . $year . '
        and sales_orders.printed = 1
		' . $params . '
		GROUP BY selling_orders.curr');
    }

    public function data_sum_buying($month, $year, $params)
    {
        return DB::select('SELECT buying_orders.curr AS curr, sum(buying_orders.sub_total ) AS sub_total
        FROM sales_orders
        INNER JOIN buying_orders ON sales_orders.id=buying_orders.sales_order_id
		where MONTH(sales_orders.created_at) = ' . $month . '
        and YEAR(sales_orders.created_at) = ' . $year . '
        and sales_orders.printed = 1
		' . $params . '
		GROUP BY buying_orders.curr');
    }

    public function data_sum_profits($month, $year, $params)
    {
        return DB::select('SELECT profits.currency AS curr, sum(profits.profit ) AS sub_total
        FROM sales_orders
        INNER JOIN profits ON sales_orders.id=profits.sales_order_id
		where MONTH(sales_orders.created_at) = ' . $month . '
        and YEAR(sales_orders.created_at) = ' . $year . '
        and sales_orders.printed = 1
        and profits.deleted_at is null
		' . $params . '
		GROUP BY profits.currency');
    }

    public function rankings($month, $year, $curr)
    {
        return DB::select('SELECT sum(profits.profit ) AS sub_total,
        sales_orders.created_by as user_id FROM sales_orders
        INNER JOIN profits ON sales_orders.id=profits.sales_order_id
		where MONTH(sales_orders.created_at) = ' . $month . '
        and YEAR(sales_orders.created_at) = ' . $year . '
        and sales_orders.printed = 1
        and profits.deleted_at is null
        and profits.currency = "' . $curr . '"
		GROUP BY sales_orders.created_by
		ORDER BY sub_total DESC');
    }

    public function getprofit(Request $request)
    {
        $bulan = $request->get('bulan');
        $id = $request->get('sales_id');
        if ($id == 'All') {
            $sales_id = $id;
        } else {
            $user = User::find($id);
            $dept = $user->department;
            if ($dept == 'super-admin') {
                $sales_id = "All";
            } else {
                $sales_id = $id;
            }
        }
        $year = Carbon::now()->format('Y');
        if ($sales_id == "All") {
            $params = '';
            $sales_name = "ALL";
        } else {
            $params = 'and sales_orders.created_by = ' . $sales_id . '';
            $sales = User::find($sales_id);
            $sales_name = $sales->name;
        }
        $data_selling = $this->data_sum_selling($bulan, $year, $params);
        $data_buying = $this->data_sum_buying($bulan, $year, $params);
        $data_profits = $this->data_sum_profits($bulan, $year, $params);
        $data = array(
            'data_selling' => $data_selling,
            'data_buying' => $data_buying,
            'data_profits' => $data_profits,
            'sales_name' => $sales_name,
        );
        $html = view('reports.table_prof')->with(compact('data'))->render();
        return response()->json(['success' => true, 'html' => $html]);
        // return json_encode($data);
    }
    public function lempar_curr($jumlah)
    {
        $curr = 'IDR,USD,SGD,EUR';
        $isicurr = explode(',', $curr);
        if ($jumlah == '1') {
            unset($isicurr[0]);
        } elseif ($jumlah == '2') {
            unset($isicurr[0], $isicurr[1]);
        } elseif ($jumlah == '3') {
            unset($isicurr[0], $isicurr[1], $isicurr[2]);
        } elseif ($jumlah == '4') {
            unset($isicurr);
        } else {
            $isicurr;
        }
        return $isicurr;
    }

    public function index()
    {

        return view('dashboard');
    }

    public function get_dashboard(Request $request)
    {
        $start = $request->start;
        $end = $request->end;

        $sum_debit = lap_offline::whereBetween('date', [$start , $end])->sum('debit');
        $sum_credit = lap_offline::whereBetween('date', [$start , $end])->sum('credit');

        $tor = child_order::whereBetween('date', [$start , $end])->sum('total');


        $cash = order::where('bayar', 'cash')->get();
        $bayar_cash = 0;
        foreach ($cash as $c) {

            $sum_cash = child_order::where('order_id', $c->id)->sum('total');

            $bayar_cash += $sum_cash;

        }

        $transfer = order::where('bayar', 'transfer')->get();
        $bayar_transfer = 0;
        foreach ($transfer as $t) {

            $sum_transfer = child_order::where('order_id', $t->id)->sum('total');

            $bayar_transfer += $sum_transfer;

        }


        $html = view('home.table_dashboard')->with(compact('tor','sum_debit','sum_credit','bayar_cash', 'bayar_transfer'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }
}
