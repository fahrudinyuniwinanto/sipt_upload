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
                    <h2><b>List User</b></h2>
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
                <?php echo anchor(site_url('user/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            
            
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('user/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('user'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered table-hover table-condensed" style="margin-bottom: 10px">
            <thead class="thead-light">
            <tr>
                <th class="text-center">No</th>
		<th class="text-center">Nama</th>
		<th class="text-center">Puskesmas</th>
		<th class="text-center">Program</th>
		<th class="text-center">User</th>
		<th class="text-center">Password</th>
		<th class="text-center">Status</th>
		<th class="text-center">Last Online</th>
		<th class="text-center">Online</th>
		<th class="text-center">Job Status</th>
		<th class="text-center">Temporari</th>
		<th class="text-center">Nama Petugas</th>
		<th class="text-center">Nip Petugas</th>
		<th class="text-center">Action</th>
            </tr>
            </thead>
			<tbody><?php
            foreach ($user_data as $user)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $user->nama ?></td>
			<td><?php echo $user->puskesmas ?></td>
			<td><?php echo $user->program ?></td>
			<td><?php echo $user->user ?></td>
			<td><?php echo $user->password ?></td>
			<td><?php echo $user->status ?></td>
			<td><?php echo $user->last_online ?></td>
			<td><?php echo $user->online ?></td>
			<td><?php echo $user->job_status ?></td>
			<td><?php echo $user->temporari ?></td>
			<td><?php echo $user->nama_petugas ?></td>
			<td><?php echo $user->nip_petugas ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('user/read/'.$user->id),'Read','class="text-navy"'); 
				echo ' | '; 
				echo anchor(site_url('user/update/'.$user->id),'Update','class="text-navy"'); 
				echo ' | '; 
				echo anchor(site_url('user/delete/'.$user->id),'Delete','class="text-navy" onclick="javascript: return confirm(\'Yakin hapus data?\')"'); 
				?>
			</td>
		</tr>
                
                <?php
            }
            ?>
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('user/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
        </div>
    </div>
    </div>
    </div>
    </body>
</html>