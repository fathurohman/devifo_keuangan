<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('admin.transaksi', 'App\Policies\UserPolicy@Transaksi');
        Gate::define('admin.transaksi-order', 'App\Policies\UserPolicy@Transaksi_Order');
        Gate::define('admin.barang', 'App\Policies\UserPolicy@Barang');
        // Gate::define('admin.hakakses', 'App\Policies\UserPolicy@Hak_Akses');
        Gate::define('admin.laporan-offline', 'App\Policies\UserPolicy@Laporan_Offline');
        Gate::define('admin.report-lapoff', 'App\Policies\UserPolicy@Report_lapoff');
        Gate::define('admin.report-transaksiorder', 'App\Policies\UserPolicy@Report_TransaksiOrder');
        // Gate::define('admin.history-sales-data', 'App\Policies\UserPolicy@History_Sales_Data');
        // Gate::define('admin.pickup-job', 'App\Policies\UserPolicy@Pickup_Job');
        // Gate::define('admin.report-profit', 'App\Policies\UserPolicy@Report_Profit');
        //
    }
}
