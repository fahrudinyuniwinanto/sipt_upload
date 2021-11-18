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
                    <h2><b>List Data_kpcpen</b></h2>
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
                <form action="<?php echo site_url('data_kpcpen/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" id="q" value="<?php echo @$_GET['q']; ?>">
                        <span class="input-group-btn">
                          <button type="button" class="btn btn-success" onclick="lookup('<?php echo base_url()?>data_kpcpen/lookup')" >Search</button>
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
		<th class="text-center">Nik</th>
		<th class="text-center">Jenis Kelamin</th>
		<th class="text-center">Tiket Vaksin</th>
		<th class="text-center">Faskes</th>
		<th class="text-center">Kelompok Usia</th>
		<th class="text-center">Kategori</th>
		<th class="text-center">Sub Kategori</th>
		<th class="text-center">Vaksinasi</th>
		<th class="text-center">Jenis Vaksin</th>
		<th class="text-center">Kab</th>
		<th class="text-center">Prov</th>
		<th class="text-center">Tanggal</th>
		<th class="text-center">Created By</th>
		<th class="text-center">Update By</th>
		<th class="text-center">Created At</th>
		<th class="text-center">Update At</th>
		<th class="text-center">Isactive</th></tr>
            </thead>
			<tbody><?php
            foreach ($data_kpcpen_data as $data_kpcpen)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $data_kpcpen->nama ?></td>
			<td><?php echo $data_kpcpen->nik ?></td>
			<td><?php echo $data_kpcpen->jenis_kelamin ?></td>
			<td><?php echo $data_kpcpen->tiket_vaksin ?></td>
			<td><?php echo $data_kpcpen->faskes ?></td>
			<td><?php echo $data_kpcpen->kelompok_usia ?></td>
			<td><?php echo $data_kpcpen->kategori ?></td>
			<td><?php echo $data_kpcpen->sub_kategori ?></td>
			<td><?php echo $data_kpcpen->vaksinasi ?></td>
			<td><?php echo $data_kpcpen->jenis_vaksin ?></td>
			<td><?php echo $data_kpcpen->kab ?></td>
			<td><?php echo $data_kpcpen->prov ?></td>
			<td><?php echo $data_kpcpen->tanggal ?></td>
			<td><?php echo $data_kpcpen->created_by ?></td>
			<td><?php echo $data_kpcpen->update_by ?></td>
			<td><?php echo $data_kpcpen->created_at ?></td>
			<td><?php echo $data_kpcpen->update_at ?></td>
			<td><?php echo $data_kpcpen->isactive ?></td>
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