<section>
    <div id="container" style="margin: 100px">
        <legend> Form Data Pembeli </legend>
        <form action="<?=site_url('konfirmasi')?>" method="post">
        <div class="form-group">
            <label for="Nama">Nama</label>
            <input type="text" class="form-control" name="name" placeholder="Nama">
        </div>
        <div class="form-group">
            <label for="No Hp">No Handphone</label>
            <input type="text" class="form-control" name="phonenumber" placeholder="No Handphone">
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" name="address" placeholder="Alamat">
        </div>
        <div class="form-group">
            <label for="kota">Kota</label>
            <select name="city" class="form-control">
            <?php
                foreach($cities as $r){
            ?>
                <option value="<?php echo($r->city_id);?>"><?php echo($r->type)?> <?php echo($r->city_name);?></option>
            <?php
            }
            ?>
            </select>
        </div>
        <div class="form-group">
            <label for="Kodepos">Kodepos</label>
            <input type="text" class="form-control" name="zipcode" placeholder="Kodepos">
        </div>
        <button type="submit" class="btn btn-primary"> Beli </button>
        </form>
    </div>
</section>