<script type="text/javascript">
    $(document).ready(function() {

        //Harga yang ditampilin di view
        var harga_S = 'Rp. 198.000'
        var harga_M = 'Rp. 208.000'
        var harga_L = 'Rp. 218.000'
        var harga_XL = 'Rp. 228.000'
        var harga_XXL = 'Rp. 238.000'

        //Harga yang dikirim ke database
        var vHarga_S = 198000
        var vHarga_M = 208000
        var vHarga_L = 218000
        var vHarga_XL = 228000
        var vHarga_XXL = 238000

        $('#ukuran').change(function() {
            console.log('changed!')
            if (this.value == 'S') {
                $('#hargaShow').html(harga_S)
                $('#hargaValue').val(vHarga_S)
            } else if (this.value == 'M') {
                $('#hargaShow').html(harga_M)
                $('#hargaValue').val(vHarga_M)
            } else if (this.value == 'L') {
                $('#hargaShow').html(harga_L)
                $('#hargaValue').val(vHarga_L)
            } else if (this.value == 'XL') {
                $('#hargaShow').html(harga_XL)
                $('#hargaValue').val(vHarga_XL)
            } else if (this.value == 'XXL') {
                $('#hargaShow').html(harga_XXL)
                $('#hargaValue').val(vHarga_XXL)
            }
        })
    })
</script>