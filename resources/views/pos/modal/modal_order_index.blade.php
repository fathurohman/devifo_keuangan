<div class="modal fade" id="add_barang" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">Add Barang</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="post" action="{{ route('store.store_child') }}" autocomplete="off">
                    @csrf
                <input name="order_id" value="{{$order->id}}" type="hidden"/>
                <div class="form-group">
                <label class="form-control-label">{{ __('Barang') }}</label>
                    <select name="barangs_id" class="selectpicker form-control" data-live-search="true" required>
                        <option value="" selected>- Pilih Barang -</option>
                        @foreach ($barangs as $br)
                            <option value="{{ $br->id}}">{{$br->nama_barang}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-control-label">{{ __('Jumlah') }}</label>
                    <input type="number" name="jumlah" class="form-control" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-2">{{ __('Save') }}</button>

                </div>
            </form>
            </div>

        </div>
    </div>
</div>
