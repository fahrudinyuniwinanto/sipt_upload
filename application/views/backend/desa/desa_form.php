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
                    <h2 style="margin-top:0px"><?php echo $button ?> Desa </h2>
                </div>
        
        <form action="<?php echo $action; ?>" method="post">
        <div class="ibox-content">
	    <div class="form-group">
            <label for="int">Id Desa <?php echo form_error('id_desa') ?></label>
            <input type="text" class="form-control" name="id_desa" id="id_desa" placeholder="Id Desa" value="<?php echo $id_desa; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Kecamatan <?php echo form_error('id_kecamatan') ?></label>
            <input type="text" class="form-control" name="id_kecamatan" id="id_kecamatan" placeholder="Id Kecamatan" value="<?php echo $id_kecamatan; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama Desa <?php echo form_error('nama_desa') ?></label>
            <input type="text" class="form-control" name="nama_desa" id="nama_desa" placeholder="Nama Desa" value="<?php echo $nama_desa; ?>" />
        </div>
	    <div class="form-group">
            <label for="col1">Col1 <?php echo form_error('col1') ?></label>
            <textarea class="form-control" rows="3" name="col1" id="col1" placeholder="Col1"><?php echo $col1; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="col2">Col2 <?php echo form_error('col2') ?></label>
            <textarea class="form-control" rows="3" name="col2" id="col2" placeholder="Col2"><?php echo $col2; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="col3">Col3 <?php echo form_error('col3') ?></label>
            <textarea class="form-control" rows="3" name="col3" id="col3" placeholder="Col3"><?php echo $col3; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="col4">Col4 <?php echo form_error('col4') ?></label>
            <textarea class="form-control" rows="3" name="col4" id="col4" placeholder="Col4"><?php echo $col4; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="col5">Col5 <?php echo form_error('col5') ?></label>
            <textarea class="form-control" rows="3" name="col5" id="col5" placeholder="Col5"><?php echo $col5; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="datetime">Created At <?php echo form_error('created_at') ?></label>
            <input type="text" class="form-control" name="created_at" id="created_at" placeholder="Created At" value="<?php echo $created_at; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Created By <?php echo form_error('created_by') ?></label>
            <input type="text" class="form-control" name="created_by" id="created_by" placeholder="Created By" value="<?php echo $created_by; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">Updated At <?php echo form_error('updated_at') ?></label>
            <input type="text" class="form-control" name="updated_at" id="updated_at" placeholder="Updated At" value="<?php echo $updated_at; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Updated By <?php echo form_error('updated_by') ?></label>
            <input type="text" class="form-control" name="updated_by" id="updated_by" placeholder="Updated By" value="<?php echo $updated_by; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Isactive <?php echo form_error('isactive') ?></label>
            <input type="text" class="form-control" name="isactive" id="isactive" placeholder="Isactive" value="<?php echo $isactive; ?>" />
        </div>
	    <input type="hidden" name="" value="<?php echo $; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('desa') ?>" class="btn btn-default">Cancel</a>
	</div>
            </form>
        </div>
        </div>
    </body>
</html>