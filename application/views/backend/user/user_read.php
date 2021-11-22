<!doctype html>
<!--Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode-->
<html>
    <head>
        <title></title>
    </head>
    <body>
    <div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h2 style="margin-top:0px">User Read</h2>
            <div class="ibox-tools">
            </div>
        </div>
        <div class="ibox-content">
        
        <table class="table">
	    <tr><td>Nama</td><td><?php echo $nama; ?></td></tr>
	    <tr><td>Puskesmas</td><td><?php echo $puskesmas; ?></td></tr>
	    <tr><td>Program</td><td><?php echo $program; ?></td></tr>
	    <tr><td>User</td><td><?php echo $user; ?></td></tr>
	    <tr><td>Password</td><td><?php echo $password; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
	    <tr><td>Last Online</td><td><?php echo $last_online; ?></td></tr>
	    <tr><td>Online</td><td><?php echo $online; ?></td></tr>
	    <tr><td>Job Status</td><td><?php echo $job_status; ?></td></tr>
	    <tr><td>Temporari</td><td><?php echo $temporari; ?></td></tr>
	    <tr><td>Nama Petugas</td><td><?php echo $nama_petugas; ?></td></tr>
	    <tr><td>Nip Petugas</td><td><?php echo $nip_petugas; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('user') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
            </div>
        </div>
    </div>
    </div>
    </body>
</html>