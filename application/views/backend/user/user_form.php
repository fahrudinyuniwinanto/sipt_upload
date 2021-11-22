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
                    <h2 style="margin-top:0px"><?php echo $button ?> User </h2>
                </div>
        
        <form action="<?php echo $action; ?>" method="post">
        <div class="ibox-content">
	    <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Puskesmas <?php echo form_error('puskesmas') ?></label>
            <input type="text" class="form-control" name="puskesmas" id="puskesmas" placeholder="Puskesmas" value="<?php echo $puskesmas; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Program <?php echo form_error('program') ?></label>
            <input type="text" class="form-control" name="program" id="program" placeholder="Program" value="<?php echo $program; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">User <?php echo form_error('user') ?></label>
            <input type="text" class="form-control" name="user" id="user" placeholder="User" value="<?php echo $user; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Password <?php echo form_error('password') ?></label>
            <input type="text" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Status <?php echo form_error('status') ?></label>
            <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Last Online <?php echo form_error('last_online') ?></label>
            <input type="text" class="form-control" name="last_online" id="last_online" placeholder="Last Online" value="<?php echo $last_online; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Online <?php echo form_error('online') ?></label>
            <input type="text" class="form-control" name="online" id="online" placeholder="Online" value="<?php echo $online; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Job Status <?php echo form_error('job_status') ?></label>
            <input type="text" class="form-control" name="job_status" id="job_status" placeholder="Job Status" value="<?php echo $job_status; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Temporari <?php echo form_error('temporari') ?></label>
            <input type="text" class="form-control" name="temporari" id="temporari" placeholder="Temporari" value="<?php echo $temporari; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama Petugas <?php echo form_error('nama_petugas') ?></label>
            <input type="text" class="form-control" name="nama_petugas" id="nama_petugas" placeholder="Nama Petugas" value="<?php echo $nama_petugas; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nip Petugas <?php echo form_error('nip_petugas') ?></label>
            <input type="text" class="form-control" name="nip_petugas" id="nip_petugas" placeholder="Nip Petugas" value="<?php echo $nip_petugas; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('user') ?>" class="btn btn-default">Cancel</a>
	</div>
            </form>
        </div>
        </div>
    </body>
</html>