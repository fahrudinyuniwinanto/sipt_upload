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
                    <h2><b>List Sync_capil</b></h2>
                    <?php if ($this->session->userdata('message') != '') {?>
                    <div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <?=$this->session->userdata('message')?> <a class="alert-link" href="#"></a>
                    </div>
                 <?php }?>
                </div>
                <div class="ibox-content">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-8">
               
            </div>
            
            
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('sync_capil/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" id="q" value="<?php echo @$_GET['q']; ?>">
                        <span class="input-group-btn">
                          <button type="button" class="btn btn-success" onclick="lookup('<?php echo base_url()?>sync_capil/lookup')" >Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered table-hover table-condensed" style="margin-bottom: 10px">
            <thead class="thead-light">
            <tr>
                <th class="text-center">No</th>
		<th class="text-center">Nama Lengkap</th>
		<th class="text-center">Tgl Lahir</th>
		<th class="text-center">Alamat</th>
		<th class="text-center">Desa</th>
		<th class="text-center">Kecamatan</th>
		<th class="text-center">Ket1</th>
		<th class="text-center">Ket2</th>
		<th class="text-center">Ket3</th>
		<th class="text-center">Created By</th>
		<th class="text-center">Update By</th>
		<th class="text-center">Created At</th>
		<th class="text-center">Update At</th>
		<th class="text-center">Isactive</th></tr>
            </thead>
			<tbody><?php
            foreach ($sync_capil_data as $sync_capil)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $sync_capil->nama_lengkap ?></td>
			<td><?php echo $sync_capil->tgl_lahir ?></td>
			<td><?php echo $sync_capil->alamat ?></td>
			<td><?php echo $sync_capil->desa ?></td>
			<td><?php echo $sync_capil->kecamatan ?></td>
			<td><?php echo $sync_capil->ket1 ?></td>
			<td><?php echo $sync_capil->ket2 ?></td>
			<td><?php echo $sync_capil->ket3 ?></td>
			<td><?php echo $sync_capil->created_by ?></td>
			<td><?php echo $sync_capil->update_by ?></td>
			<td><?php echo $sync_capil->created_at ?></td>
			<td><?php echo $sync_capil->update_at ?></td>
			<td><?php echo $sync_capil->isactive ?></td>
		</tr>
                
                <?php
            }
            ?>
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
        </div>
        </div>
    </div>
    </div>
    </div>
    </body>
</html>