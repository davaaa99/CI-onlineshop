<section>
<form action= <?php echo site_url('/deleteAll') ?> method="post">
            <button type="submit" class="btn btn-danger" style="float:right; margin:20px; "> Delete </button>
            </form>
<table width="100%" style="text-align:center;margin: 40px 0;" class="table">
    <tr>
        <th style="width:10%;text-align:center">Id</th>
        <th style="width:20%;text-align:center">Nama Barang</th>
        <th style="width:10%;text-align:center">Berat</th>
        <th style="width:10%;text-align:center">Qty</th>
        <th style="width:10%;text-align:center">Harga</th>
        <th style="width:10%;text-align:center">Total Berat</th>
        <th style="width:20%;text-align:center">SubTotal</th>
        <th style="width:10%;text-align:center"> </th>
        <th style="width:10%;text-align:center"></th>
    </tr>
<?php
    foreach ($this->cart->contents() as $row){
?>
    <tr>
        <td><?php echo $row['id']?></td>
        <td><?php echo $row['name']?></td>
        <td><?php echo $row['berat'].'gr'?></td>
        <td><?php echo $row['qty']?></td>
        <td><?php echo 'Rp.'.$row['price']?></td>
        <td><?php echo $row['berat'] * $row['qty'].'gr'?></td>
        <td><?php echo 'Rp.'.$row['price'] * $row['qty']?>
        <td><form action= <?php echo site_url('/delete') ?> method="post">
            <input type="hidden" name="id" value=<?php echo $row['rowid'];?>>
            <button type="submit" class="btn btn-warning"> Delete </button>
            </form>
        </td>
    </tr>
    <?php
        }
    ?>
    
</table>
    
    <div>
    <p style="text-align:right; margin-right: 80px "><strong>Total &nbsp;</strong> Rp. <?php echo $this->cart->format_number($this->cart->total()); ?></p>
    </div>
    <div>
    <form action= <?php echo site_url('/beli') ?> method="post">
            <input type="hidden" name="id" >
            <button type="submit" class="btn btn-primary" style="float:right; margin-right:85px;width:100px"> Beli </button>
    </form>
    </div> 
    </table>
    </section>
    