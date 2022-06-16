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

            <button type="submit" class="btn" style="padding:0;margin:0;float:left;">
                <i class="fas fa-edit" style="color:orange"></i>
            </button>
        </form>
        <button wire:click.prevent="destroy" class="btn" style="padding:0;margin:0;float:left;"><i class="fas fa-trash text-danger"></i></button>
    </td>
</tr>
