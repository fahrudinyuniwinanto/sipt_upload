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
                    <h2 style="margin-top:0px"><?php echo $button ?> Tbnilaidata_gizi </h2>
                </div>
        
        <form action="<?php echo $action; ?>" method="post">
        <div class="ibox-content">
	    <div class="form-group">
            <label for="double">ID <?php echo form_error('ID') ?></label>
            <input type="text" class="form-control" name="ID" id="ID" placeholder="ID" value="<?php echo $ID; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">NILAI <?php echo form_error('NILAI') ?></label>
            <input type="text" class="form-control" name="NILAI" id="NILAI" placeholder="NILAI" value="<?php echo $NILAI; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">SUMBERDATA <?php echo form_error('SUMBERDATA') ?></label>
            <input type="text" class="form-control" name="SUMBERDATA" id="SUMBERDATA" placeholder="SUMBERDATA" value="<?php echo $SUMBERDATA; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">KODE <?php echo form_error('KODE') ?></label>
            <input type="text" class="form-control" name="KODE" id="KODE" placeholder="KODE" value="<?php echo $KODE; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">TAHUN <?php echo form_error('TAHUN') ?></label>
            <input type="text" class="form-control" name="TAHUN" id="TAHUN" placeholder="TAHUN" value="<?php echo $TAHUN; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">BULAN <?php echo form_error('BULAN') ?></label>
            <input type="text" class="form-control" name="BULAN" id="BULAN" placeholder="BULAN" value="<?php echo $BULAN; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">PUSKESMAS <?php echo form_error('PUSKESMAS') ?></label>
            <input type="text" class="form-control" name="PUSKESMAS" id="PUSKESMAS" placeholder="PUSKESMAS" value="<?php echo $PUSKESMAS; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">DESA <?php echo form_error('DESA') ?></label>
            <input type="text" class="form-control" name="DESA" id="DESA" placeholder="DESA" value="<?php echo $DESA; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">TGL ENTRY <?php echo form_error('TGL_ENTRY') ?></label>
            <input type="text" class="form-control" name="TGL_ENTRY" id="TGL_ENTRY" placeholder="TGL ENTRY" value="<?php echo $TGL_ENTRY; ?>" />
        </div>
	    <input type="hidden" name="" value="<?php echo $; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('tbnilaidata_gizi') ?>" class="btn btn-default">Cancel</a>
	</div>
            </form>
        </div>
        </div>
    </body>
</html>