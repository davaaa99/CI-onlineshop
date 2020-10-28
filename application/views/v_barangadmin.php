<section>
    <div style="margin: 50px">
            <form action="<?=site_url('search')?>" method="post">
        <p>
            <input type="search" name="nama" placeholder="Search Keyword..." class="form-control" style="width: 25%;display: inline-block;"> <input type="submit" value ="Search" class="btn btn-primary">
        </p>
        <table class="table">
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok</th>      
                <th>Keterangan</th>
                <th>Berat</th>
            </tr>
            <?php 
            $no = $this->uri->segment('2') + 1;
            foreach($barang as $key => $b) : 
            ?>
            <tr>
                <td><?php echo $b->kode ?></td>
                <td><?php echo $b->nama ?></td>
                <td><?php echo $b->harga ?></td>
                <td><?php echo $b->stock ?></td>
                <td><?php echo $b->keterangan ?></td>
                <td><?php echo $b->berat ?></td>
            </tr>
             <?php endforeach; ?>
        </table>
        </form>
    </div>
        
  <div class="row">
        <div class="col">
            <!--Tampilkan pagination-->
            <?php echo $pagination; ?>
        </div>
    </div>
</section>
        
       
<!--   <?php
                $no = $this->uri->segment('2') + 1;
                foreach($barang as $key => $b) : 
            ?>
        <div class="card" style="width: 16rem;display: inline-block; margin-left: 50px;margin-top:50px">
            <img src="<?php echo base_url() . 'assets/img/'.$b->filebr  ?>" class="card-img-top" alt="" >
            <div class="card-body">
                <h5 class="card-title"><?php echo $b->nama ?></h5>
                <p class="card-text"><?php echo 'Harga : Rp. '.$b->harga ?></p>
                <p class="card-text"><?php echo 'Stock : '.$b->stock ?></p>
                <p class="card-text"><?php echo $b->keterangan ?></p>
            </div>
        </div>
        <?php endforeach; ?> -->
   