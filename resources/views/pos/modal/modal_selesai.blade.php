{{-- Details --}}
<div class="modal fade" id="selesai" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">Confirm</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <div class="text-center" style="color: white">
                        <form action="{{ route('update_transfer.order', $order->id)}}" method="post">
                            {{ csrf_field() }} {{ method_field('PUT') }}
                            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Transfer</button>
                        </form><br>
                        <form action="{{ route('update_cash.order', $order->id)}}" method="post">
                            {{ csrf_field() }} {{ method_field('PUT') }}
                            @foreach($data as $x)
                                <input type="hidden" name="name[]" value="{{$x->barangs->nama_barang}}" />
                                <input type="hidden" name="debit[]" value="{{$x->total}}" />
                                <input type="hidden" name="order_id[]" value="{{$x->order_id}}" />
                            @endforeach

                            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Cash</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
