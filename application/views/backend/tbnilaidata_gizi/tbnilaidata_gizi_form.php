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
                    <h2 style="margin-top:0px"><?php echo $button ?> <?php $prog=substr($this->session->userdata('id_program'),0,1) ?>
                    <?=getLabelProgram($prog)?></h2>
                </div>
        
        <form action="<?php echo $action; ?>" method="post">
        <div class="ibox-content">
        <div class="row">
        <div class="col-lg-6">
	    <div class="form-group">
            <label for="double">ID <?php echo form_error('ID') ?></label>
            <input type="text" class="form-control" name="ID" id="ID" placeholder="ID" value="<?php echo $ID; ?>" readonly/>
        </div>
	    <div class="form-group">
            <label for="int">NILAI <?php echo form_error('NILAI') ?></label>
            <input type="text" class="form-control" name="NILAI" id="NILAI" placeholder="NILAI" value="<?php echo $NILAI; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">SUMBERDATA <?php echo form_error('SUMBERDATA') ?></label>
            <input type="text" class="form-control" name="SUMBERDATA" id="SUMBERDATA" placeholder="SUMBERDATA" value="<?php echo $SUMBERDATA; ?>" readonly/>
        </div>
        
	    <div class="form-group">
            <label for="int">KODE <?php echo form_error('KODE') ?></label>
            <input type="text" class="form-control" name="KODE" id="KODE" placeholder="KODE" value="<?php echo $KODE; ?>" readonly />
        </div>
        </div>
        <div class="col-lg-6">
	    <div class="form-group">
            <label for="int">TAHUN <?php echo form_error('TAHUN') ?></label>
            <select class="form-control" name="tahun">
                            <option value="">>> Pilih Tahun</option>
                            <?php for ($i=2000; $i <date('Y')+1 ; $i++) { ?>
                                <option <?php if($TAHUN==$i){echo "selected";}?> value="<?=$i?>"><?=$i?></option>
                            <?php } ?>
                            </select>
        </div>
        
	    <div class="form-group">
            <label for="int">BULAN <?php echo form_error('BULAN') ?></label>
            <select class="form-control" name="bulan">
                            <option value="">>> Pilih Bulan</option>
                            <?php for ($i=1; $i <13 ; $i++) { ?>
                                <option <?php if($BULAN==$i){echo "selected";}?> value="<?=$i?>"><?=str_bulan($i)?></option>
                            <?php } ?>
                            </select>
        </div>
	   
	    <div class="form-group">
            <label for="datetime">TGL ENTRY <?php echo form_error('TGL_ENTRY') ?></label>
            <input type="text" class="form-control" name="TGL_ENTRY" id="TGL_ENTRY" placeholder="TGL ENTRY" value="<?php echo $TGL_ENTRY; ?>" readonly/>
        </div>
        <input type="hidden" name="" value="<?php echo $ID; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('tbnilaidata_gizi') ?>" class="btn btn-default">Cancel</a>
        </div>
	   
	</div>
	</div>
            </form>
        </div>
        </div>
    </body>
</html>