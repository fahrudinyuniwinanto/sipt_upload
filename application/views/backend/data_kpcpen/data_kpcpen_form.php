<!doctype html>
<!--Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode-->
<html>
    <head>
        <title></title>
    </head>
    <body>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h2 style="margin-top:0px"><?php echo $button ?> Data_kpcpen </h2>
                </div>
        
        <form action="<?php echo $action; ?>" method="post">
        <div class="ibox-content">
	    <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nik <?php echo form_error('nik') ?></label>
            <input type="text" class="form-control" name="nik" id="nik" placeholder="Nik" value="<?php echo $nik; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Jenis Kelamin <?php echo form_error('jenis_kelamin') ?></label>
            <input type="text" class="form-control" name="jenis_kelamin" id="jenis_kelamin" placeholder="Jenis Kelamin" value="<?php echo $jenis_kelamin; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Tiket Vaksin <?php echo form_error('tiket_vaksin') ?></label>
            <input type="text" class="form-control" name="tiket_vaksin" id="tiket_vaksin" placeholder="Tiket Vaksin" value="<?php echo $tiket_vaksin; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Faskes <?php echo form_error('faskes') ?></label>
            <input type="text" class="form-control" name="faskes" id="faskes" placeholder="Faskes" value="<?php echo $faskes; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Kelompok Usia <?php echo form_error('kelompok_usia') ?></label>
            <input type="text" class="form-control" name="kelompok_usia" id="kelompok_usia" placeholder="Kelompok Usia" value="<?php echo $kelompok_usia; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Kategori <?php echo form_error('kategori') ?></label>
            <input type="text" class="form-control" name="kategori" id="kategori" placeholder="Kategori" value="<?php echo $kategori; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Sub Kategori <?php echo form_error('sub_kategori') ?></label>
            <input type="text" class="form-control" name="sub_kategori" id="sub_kategori" placeholder="Sub Kategori" value="<?php echo $sub_kategori; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Vaksinasi <?php echo form_error('vaksinasi') ?></label>
            <input type="text" class="form-control" name="vaksinasi" id="vaksinasi" placeholder="Vaksinasi" value="<?php echo $vaksinasi; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Jenis Vaksin <?php echo form_error('jenis_vaksin') ?></label>
            <input type="text" class="form-control" name="jenis_vaksin" id="jenis_vaksin" placeholder="Jenis Vaksin" value="<?php echo $jenis_vaksin; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Kab <?php echo form_error('kab') ?></label>
            <input type="text" class="form-control" name="kab" id="kab" placeholder="Kab" value="<?php echo $kab; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Prov <?php echo form_error('prov') ?></label>
            <input type="text" class="form-control" name="prov" id="prov" placeholder="Prov" value="<?php echo $prov; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Tanggal <?php echo form_error('tanggal') ?></label>
            <input type="text" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal" value="<?php echo $tanggal; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Created By <?php echo form_error('created_by') ?></label>
            <input type="text" class="form-control" name="created_by" id="created_by" placeholder="Created By" value="<?php echo $created_by; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Update By <?php echo form_error('update_by') ?></label>
            <input type="text" class="form-control" name="update_by" id="update_by" placeholder="Update By" value="<?php echo $update_by; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">Created At <?php echo form_error('created_at') ?></label>
            <input type="text" class="form-control" name="created_at" id="created_at" placeholder="Created At" value="<?php echo $created_at; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">Update At <?php echo form_error('update_at') ?></label>
            <input type="text" class="form-control" name="update_at" id="update_at" placeholder="Update At" value="<?php echo $update_at; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Isactive <?php echo form_error('isactive') ?></label>
            <input type="text" class="form-control" name="isactive" id="isactive" placeholder="Isactive" value="<?php echo $isactive; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('data_kpcpen') ?>" class="btn btn-default">Cancel</a>
	</div>
            </form>
        </div>
        </div>
    </body>
</html>