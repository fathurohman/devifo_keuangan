<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
	return view('auth.login');
});
Auth::routes();

// Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('roleuser', 'RoleUserController');
	Route::resource('user', 'UserController');
	Route::resource('permission', 'PermissionController');
	Route::resource('role', 'RoleController');
	Route::resource('items', 'ItemsController');
	Route::get('search/autocomplete_username', 'RoleUserController@autocomplete_username')->name('autocomplete_username');
	//job order routes
	Route::resource('job_order', 'JobOrderController');
	Route::resource('sales_order', 'SalesOrderController');
	Route::get('/customer_data', 'JobOrderController@getdata');
	Route::get('/job_data', 'JobOrderController@getdataorder');
	Route::get('/tipe_order', 'JobOrderController@gettipeorder');
	Route::get('/set_tipe', 'JobOrderController@settipeorder');
	Route::get('/job_detail/{id}', 'JobOrderController@showDetail');
	Route::get('/listcustomer', 'JobOrderController@listcustomer')->name('listcustomer');
	Route::get('/listorder', 'JobOrderController@listorder')->name('listorder');
	Route::get('/listordershow', 'JobOrderController@listordershow')->name('listordershow');
	//history routes
	Route::get('/hist_job_order', 'HistoryJobController@hist_job_order')->name('hist_job_order');
	Route::get('/hist_tipe_order', 'HistoryJobController@gettipeorder');
	Route::get('/hist_job_detail/{id}', 'HistoryJobController@showDetail');
	Route::get('/hist_job_pickup/{id}', 'HistoryJobController@pickup')->name('job_pickup');
	Route::get('/listorderhist', 'HistoryJobController@listorderhist')->name('listorderhist');
	Route::post('/hist_post', 'HistoryJobController@hist_post')->name('hist_post');
	Route::get('/history_modal', 'HistoryController@getdatahist_m');
	//sales order routes
	Route::get('/listsalesshow', 'SalesOrderController@listsalesshow')->name('listsalesshow');
	Route::get('/sales_selling_detail/{id}', 'SalesOrderController@showDetailSelling');
	Route::get('/sales_buying_detail/{id}', 'SalesOrderController@showDetailBuying');
	Route::get('/sales_profit_detail/{id}', 'SalesOrderController@showDetailProfit');
	Route::get('/sales_dp_detail/{id}', 'SalesOrderController@showDetailDP');
	Route::get('/job_data_sales', 'SalesOrderController@getdataordersales');
	Route::get('/listordersales', 'SalesOrderController@listordersales')->name('listordersales');
	Route::resource('sales_order', 'SalesOrderController');
	Route::get('search/autocomplete/', 'SalesOrderController@autocomplete_desc');
	Route::get('search/autocomplete_remark/', 'SalesOrderController@autocomplete_remark');
	Route::get('search/autocomplete_client/', 'SalesOrderController@autocomplete_client');
	Route::put('send/{id}', 'SalesOrderController@sendtofinance')->name('sales_order.send');
	Route::get('datasales', 'SalesOrderController@data_sales')->name('data_sales');
	Route::get('/listojobrdersalesshow', 'SalesOrderController@listojobrdersalesshow')->name('listojobrdersalesshow');
	Route::get('pickup/{id}', 'SalesOrderController@pickup')->name('pickup');
	//vendor client routes
	Route::resource('client', 'ClientController');
	Route::resource('vendor_data', 'VendorController');
	// barang routes
	Route::resource('barang', 'BarangController');
	Route::get('/vendor_detail/{id}', 'VendorController@showTracking');
	Route::get('/client_detail/{id}', 'ClientController@showTracking');
	Route::get('profile', 'ProfileController@edit')->name('profile.edit');
	Route::put('profile/update', 'ProfileController@update')->name('profile.update');
	//finance routes
	Route::get('/finance', 'FinanceController@index')->name('finance.index');
	Route::get('/listinvoiceshow', 'FinanceController@listinvoiceshow')->name('listinvoiceshow');
	Route::get('/modal_cetak_invoice/{id}/{tipe}', 'FinanceController@modal_cetak_invoice');
	// Route::get('/cetak_invoice/{id}/{tipe}', 'FinanceController@cetak_invoice');
	Route::post('/cetak_invoice_dua', 'FinanceController@cetak_invoice_dua')->name('cetak_invoice_dua');
	Route::put('return/{id}', 'FinanceController@returntosales')->name('finance.return');
	Route::put('pembukuan/{id}', 'FinanceController@pembukuan')->name('finance.pembukuan');
	//end
	//history routes
	Route::get('/history_orders', 'HistoryController@history_index')->name('history_orders');
	Route::get('/historyinvoiceshow', 'HistoryController@historyinvoiceshow')->name('historyinvoiceshow');
	//modal pas create sales order
	Route::get('/historyinvoicemodal', 'HistoryController@historyinvoicemodal')->name('historyinvoicemodal');
	//end
	//reports
	Route::post('/datamonthly', 'HistoryController@export')->name('export');
	Route::post('/datamonthlyreport', 'HistoryController@export_profit')->name('export_profit');
	Route::get('/daily_home', 'HistoryController@daily_home')->name('report');
	Route::get('/tarik_profit', 'HistoryController@tarik_profit')->name('tarik_profit');
	Route::put('profile/password', 'ProfileController@password')->name('profile.password');
	//history routes
	Route::get('/listsaleshistory', 'HistorySalesController@listsaleshistory')->name('listsaleshistory');
	Route::get('/history_sales', 'HistorySalesController@index')->name('history_sales');
	//BOL Routes
	Route::resource('bol', 'BOLController');
	Route::get('getdatabol', 'BOLController@getdatabol')->name('getdatabol');
	Route::get('listbol', 'BOLController@listbol')->name('listbol');
	Route::get('cetakbol/{id}', 'BOLController@Cetak')->name('cetakbol');
	Route::get('/bol_data', 'BOLController@getdataorder');
	//ajax profit
	Route::get('/getprofit', 'HomeController@getprofit')->name('getprofit');
	//jurnal routes
	Route::get('/jurnal', 'JurnalController@index')->name('jurnal');
	Route::post('/export_jurnal', 'JurnalController@export_jurnal')->name('export_jurnal');
	//chart routes
	Route::get('/monthly-chart-data', 'ChartController@getMonthlyProfitData');
	//kas bank routes
	Route::get('jurnal_bank', 'BankController@index')->name('jurnal_bank');
	Route::get('listjurnalbank', 'BankController@listjurnalbank')->name('listjurnalbank');

	Route::get('/jurnal_bank_detail/{id}', 'BankController@showDetailJurnalBank');
	Route::get('/jurnal_bank_child/{id}', 'BankController@showChildJurnalBank');

	Route::get('penerimaan_kas', 'BankController@penerimaan')->name('penerimaan_kas');

	//pettycash
	Route::get('pettycash', 'PettycashController@index_pettycash')->name('pettycash');
	Route::get('create_pettycash', 'PettycashController@create_pettycash')->name('create_pettycash');
	Route::post('/store/pettycash', 'PettycashController@store_pettycash')->name('store.pettycash');
	Route::get('/listpettycash', 'PettycashController@listpettycash')->name('listpettycash');
	Route::get('/pettycash_detail/{id}', 'PettycashController@showDetailPettyCash');

	Route::get('/listcoa', 'BankController@listcoa')->name('listcoa');
	Route::get('/listcoa/pemasukan', 'BankController@listcoa_pemasukan')->name('listcoa.pemasukan');
	Route::get('/listcoa/pengeluaran', 'BankController@listcoa_pengeluaran')->name('listcoa.pengeluaran');

	//assets
	Route::get('asset', 'AssetController@index_assets')->name('asset');
	Route::get('create_asset', 'AssetController@create_assets')->name('create_asset');
	Route::get('edit_asset/{id}', 'AssetController@edit_assets')->name('edit_assets');

	Route::get('add_asset_spek/{id}', 'AssetController@add_assets_spek')->name('add_assets_spek');

	Route::post('add_assets', 'AssetController@add_assets')->name('add.add_assets');
	Route::put('/update/asset/{id}', 'AssetController@update_assets')->name('update.asset');

	Route::post('/store/asset', 'AssetController@store_asset')->name('store.asset');
	Route::get('/listasset', 'AssetController@listasset')->name('listasset');
	Route::get('/report_listasset', 'AssetController@report_listasset')->name('report_listasset');
	Route::get('/asset_detail/{id}', 'AssetController@showDetailAsset');
	Route::get('/asset_detail_report/{id}', 'AssetController@showDetailSpek');
	Route::get('/asset_detail_des/{id}', 'AssetController@showDetailDes');
	Route::get('/listnamabarang', 'AssetController@listnamabarang')->name('listnamabarang');
	Route::get('/data_barang', 'AssetController@getdatabarang');

	Route::get('create_asset_penyusutan', 'AssetController@create_asset_penyusutan')->name('create_asset_penyusutan');
	Route::post('/store/asset_penyusutan', 'AssetController@store_penyusutan')->name('store_penyusutan');

	Route::get('/report_assets', 'AssetController@report_assets')->name('report.assets');

	Route::post('/export_report_asset', 'AssetController@export_report_asset')->name('export_report_asset');

	//profloss routes
	Route::get('/profloss', 'ProfitLossController@prof_loss')->name('prof_loss');
	Route::get('/profloss_json', 'ProfitLossController@prof_loss_json')->name('prof_loss_json');
	Route::post('/export_profitloss', 'ProfitLossController@export_profitloss')->name('export_profitloss');

	Route::get('/neraca', 'NeracaController@neraca')->name('neraca');
	Route::get('/neraca_json', 'NeracaController@neraca_json')->name('neraca_json');
	Route::post('/export_neraca', 'NeracaController@export_neraca')->name('export_neraca');

	Route::get('/coa_data', 'BankController@getdatacoa');

	Route::get('coa/autocomplete/', 'BankController@autocomplete_coa');
	Route::get('br/autocomplete/', 'BankController@autocomplete_barang');
	Route::post('/store/coa', 'BankController@store')->name('store.coa');


	Route::get('/skomak', 'FinanceController@skomak')->name('finance.skomak');
	Route::get('/hapok', 'ProfitLossController@hapok');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
