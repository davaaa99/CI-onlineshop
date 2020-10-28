<section>
<?php 
			foreach($penjualan as $key => $p) : 
		?>
<table width="100%" style="text-align:center;margin: 40px 0;" class="table">
    <tr>
        <th style="width:5%;text-align:center">No Penjualan</th>
        <th style="width:10%;text-align:center">Tanggal Penjualan</th>
        <th style="width:15%;text-align:center">Nama Pemesan</th>
        <th style="width:10%;text-align:center">No Hp</th>
        <th style="width:10%;text-align:center">Alamat</th>
        <th style="width:10%;text-align:center">Kota</th>
        <th style="width:10%;text-align:center">Kodepos</th>
        <th style="width:10%;text-align:center">Total</th>
        <th style="width:15%;text-align:center">Status</th>
        
    </tr>


    <tr>
        <td><?php echo $p->NoPjl?></td>
        <td><?php echo $p->tgl?></td>
        <td><?php echo $p->nama?></td>
        <td><?php echo $p->hp?></td>
        <td><?php echo $p->alamat?></td>
        <td><?php echo $p->kota?></td>
        <td><?php echo $p->kodepos?></td>
        <td><?php echo $p->total?></td>
        <td>
        <?php if($p->status == "unpaid"){?>
        <form action="<?=site_url('status')?>" method="post">
                <input type="hidden" name="NoPjl" value=<?php echo $p->NoPjl?>>
                <input type="hidden" name="status" value="paid">
                <button type="submit" class="btn btn-danger"> Belum Bayar</button>
        <?php } else if ($p->status == "paid") {?>
            <form action="<?=site_url('status')?>" method="post">
                <input type="hidden" name="NoPjl" value=<?php echo $p->NoPjl?>>
                <input type="hidden" name="status" value="send">
                <button type="submit" class="btn btn-success"> Sudah Bayar</button>
        <?php }else{?>
            <button type="submit" class="btn btn-success" disabled> Sudah Dikirim</button>
            <?php } ?>
            </form>
    </tr>
    </table>
    <?php endforeach; ?>
 </section>