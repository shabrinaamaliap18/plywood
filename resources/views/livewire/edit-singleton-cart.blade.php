<tr>
    <td>{{ $no }}</td>
    <td>
        <img src="{{ url('assets/jersey') }}/{{ $image }}" class="img-fluid" width="200">
    </td>
    <td>
        {{ $name }}
    </td>

    <td>
        <div class="form-group">
            <input id="jumlah" wire:model="amount" type="number" min="1" class="form-control @error('jumlah_pesanan') is-invalid @enderror" value="{{ $amount }}" autocomplete="jumlah_pesanan">

            {{-- @error('jumlah_pesanan')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror --}}
        </div>
    </td>

    <td id="harga">Rp. {{ number_format($price) }}</td>
    <td id="total"><strong>Rp. {{ number_format($total_price) }}</strong></td>

    <td>
        <form wire:submit.prevent="updates">

            <button type ="submit" type="button" class="btn btn-warning btn-sm" style="padding:0;margin:0.1;float:left;">Update</button>
        </form>
        <button wire:click.prevent="destroy" type="button" class="btn btn-danger btn-sm" style="padding:0;margin:0.1;float:right;">Hapus</button>
    </td>
</tr>
