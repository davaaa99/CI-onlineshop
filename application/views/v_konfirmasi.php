<section>
    <div id="container" style="margin: 100px">
        
        <div class="col-md-12">
        <div class="row">
            <div id="col-md-8">
            <legend><strong>Form Data Pembeli</strong></legend>
                <label> Nama : </label>
                <?php echo $nama ?><br>
                <label> No Handphone : </label>
                <?php echo $hp ?><br>
                <label> Alamat : </label>
                <?php echo $alamat ?><br>
                <label> Kota : </label>
                <?php echo $kota ?><br>
                <label> Kodepos : </label>
                <?php echo $kodepos ?><br>
            </div>
        </div>
        </div>
                <table width="100%" style="text-align:center;margin: 40px 0;" class="table">
            <tr>
                <th style="width:10%;text-align:center">Id</th>
                <th style="width:20%;text-align:center">Nama Barang</th>
                <th style="width:20%;text-align:center">Qty</th>
                <th style="width:10%;text-align:center">Berat </th>
                <th style="width:20%;text-align:center">Harga</th>
                <th style="width:20%;text-align:center">Total</th>

            </tr>
        <?php
            foreach ($this->cart->contents() as $row){
        ?>
            <tr>
                <td><?php echo $row['id']?></td>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['qty']?></td>
                <td><?php echo $row['berat'] * $row['qty'].' gr'?></td>
                <td><?php echo 'Rp.'.$row['price']?></td>
                <td><?php echo 'Rp.'.$row['price'] * $row['qty']?>
                <td><form action= <?php echo site_url('/delete') ?> method="post">
                    <input type="hidden" name="id" value=<?php echo $row['rowid'];?>>
                    </form>
                </td>
            </tr>
            <?php
                }
            ?>
            
        </table>
        <div class="col-md-12 text-right">
                <legend><strong>Informasi Pembayaran</strong></legend>
                <label> <strong>Total Harga : </strong></label>
                 Rp.
                <?php echo $this->cart->total();?><br>
                <label> <strong>Total Ongkos Kirim : </strong></label>
                <?php echo 'Rp. '.$ongkir ?><br>
                <label> <strong>Total Pembayaran :</strong> </label>
                Rp.
                <?php $totalprice = $this->cart->total() + $ongkir?>
                <?php echo $totalprice?>

            
            </div>
        <form action="<?=site_url('checkout')?>" method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="name"  value="<?php echo $nama?>" hidden>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="phonenumber" value="<?php echo $hp?>" hidden>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="address" value="<?php echo $alamat?>" hidden>
        </div>
        <div class="form-group">
            <input name="city" class="form-control" value="<?php echo $kota?>" hidden>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="zipcode" value="<?php echo $kodepos?>" hidden>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="ongkir" value="<?php echo $ongkir?>" hidden>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="totalbayar" value="<?php echo $totalprice?>" hidden>
        </div>
        <button type="submit" class="btn btn-primary" style="float:right"> Beli </button>
        </form>
    </div>
</section>