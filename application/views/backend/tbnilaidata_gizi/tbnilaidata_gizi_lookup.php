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
                    <h2><b>List Tbnilaidata_gizi</b></h2>
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
                <form action="<?php echo site_url('tbnilaidata_gizi/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" id="q" value="<?php echo @$_GET['q']; ?>">
                        <span class="input-group-btn">
                          <button type="button" class="btn btn-success" onclick="lookup('<?php echo base_url()?>tbnilaidata_gizi/lookup')" >Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered table-hover table-condensed" style="margin-bottom: 10px">
            <thead class="thead-light">
            <tr>
                <th class="text-center">No</th>
		<th class="text-center">ID</th>
		<th class="text-center">NILAI</th>
		<th class="text-center">SUMBERDATA</th>
		<th class="text-center">KODE</th>
		<th class="text-center">TAHUN</th>
		<th class="text-center">BULAN</th>
		<th class="text-center">PUSKESMAS</th>
		<th class="text-center">DESA</th>
		<th class="text-center">TGL ENTRY</th></tr>
            </thead>
			<tbody><?php
            foreach ($tbnilaidata_gizi_data as $tbnilaidata_gizi)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $tbnilaidata_gizi->ID ?></td>
			<td><?php echo $tbnilaidata_gizi->NILAI ?></td>
			<td><?php echo $tbnilaidata_gizi->SUMBERDATA ?></td>
			<td><?php echo $tbnilaidata_gizi->KODE ?></td>
			<td><?php echo $tbnilaidata_gizi->TAHUN ?></td>
			<td><?php echo $tbnilaidata_gizi->BULAN ?></td>
			<td><?php echo $tbnilaidata_gizi->PUSKESMAS ?></td>
			<td><?php echo $tbnilaidata_gizi->DESA ?></td>
			<td><?php echo $tbnilaidata_gizi->TGL_ENTRY ?></td>
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