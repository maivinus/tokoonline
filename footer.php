  
    <script>
        $(document).ready(function(){
            getCart();
        });

        function addToCart(id){
            $.ajax({
                url: 'cart.php',
                data: 'id=' + id,
                type: 'GET',
                success: function(result){
                    if(result === '1'){
                        alert('Produk berhasil ditambahkan.');
                        getCart();
                    }
                }
            });
        }

        function getCart(){
            $.ajax({
                url: 'cart.php',
                type: 'GET',
                success: function(result){
                    $('#item-cart').html(result);
                }
            });
        }

        function hapusCart(id){
            if(confirm('Yakin hapus produk ini ?')){
                $.ajax({
                    url: 'cart.php',
                    type: 'GET',
                    data: 'id=' + id + '&tipe=hapus',
                    success: function(result){
                        if(result === '1'){
                            alert('Produk berhasil dihapus.');
                            location.reload();
                        }
                    }
                });
            }
        }

        function updateCart(id, tipe){
            $.ajax({
                url: 'cart.php',
                type: 'GET',
                data: 'id=' + id + '&tipe=' + tipe,
                success: function(result){
                    if(result === '1'){
                        location.reload();
                    }
                }
            });
        }
    </script>
  </body>
</html>
