<br>
<div class="row">
    <div class="col-xl-6 col-md-6">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="text-uppercase ls-1 mb-1">Laporan Offline</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="col">
                    <div class="card mb-3 border-0 text-black">

                        <p style="font-size: 18pt;font-weight: 600">Debit :  Rp. {{ number_format((float) $sum_debit) }} </p>
                        <p style="font-size: 18pt;font-weight: 600"> Credit :  Rp. {{ number_format((float) $sum_credit) }} </p><hr>
                        <p style="font-size: 18pt;font-weight: 600">Total :  Rp. {{ number_format((float) $sum_debit-$sum_credit) }} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-md-6">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="text-uppercase ls-1 mb-1">Transaksi Order</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="col">
                    <div class="card mb-3 border-0">
                      <p style="font-size: 18pt;font-weight: 600">  Rp. {{ number_format((float) $tor) }} </p>
                      <hr>
                      <p style="font-size: 18pt;font-weight: 600"> Cash : Rp. {{ number_format((float) $bayar_cash) }} </p>
                      <p style="font-size: 18pt;font-weight: 600"> Transfer : Rp. {{ number_format((float) $bayar_transfer) }} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
