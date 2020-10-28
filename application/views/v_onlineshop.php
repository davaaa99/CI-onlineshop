<section>
        <?php 
			foreach($barang as $key => $b) : 
		?>
        <div class="card" style="width: 16rem;display: inline-block; margin-left: 50px;margin-top:50px">
            <img src="<?php echo base_url() . 'assets/img/'.$b->filebr  ?>" class="card-img-top" alt="" >
            <div class="card-body">
                <h5 class="card-title"><?php echo $b->nama ?></h5>
                <p class="card-text"><?php echo 'Harga : Rp. '.$b->harga ?></p>
                <p class="card-text"><?php echo 'Stock : '.$b->stock ?></p>
                <p class="card-text"><?php echo $b->keterangan ?></p>
                <a href="<?php echo base_url().index_page().'/tambah/'.$b->kode?>"><button class="btn btn-sm btn-success"></i> Add to Cart</button></a>
                 
            </div>
        </div>
            <?php endforeach; ?>
</section>