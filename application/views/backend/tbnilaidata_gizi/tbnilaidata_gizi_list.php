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
                    
                    <h2><b>List Nilai <?php $prog=substr($this->session->userdata('id_program'),0,1) ?>
                    <?=($prog=="I"?"Ibu":($prog=="A"?"Anak":($prog=="G"?"Gizi":"-")))?></b></h2>
                    <?php if ($this->session->userdata('message') != '') {?>
                    <div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <?=$this->session->userdata('message')?> <a class="alert-link" href="#"></a>
                    </div>
                 <?php }?>
                </div>
                <div class="ibox-content">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-0">
                <?php //echo anchor(site_url('tbnilaidata_gizi/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <form enctype="multipart/form-data" action="<?= base_url() ?>ReadExcel/importNilai" method="post">
            
                        <div class="col-md-2">
                            <select class="form-control" name="tahun">
                            <option value="">>> Pilih Tahun</option>
                            <?php for ($i=2000; $i <date('Y')+1 ; $i++) { ?>
                                <option value="<?=$i?>"><?=$i?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" name="bulan">
                            <option value="">>> Pilih Bulan</option>
                            <?php for ($i=1; $i <13 ; $i++) { ?>
                                <option value="<?=$i?>"><?=str_bulan($i)?></option>
                            <?php } ?>
                            </select>
                        </div>
            
            <div class="col-md-3 text-right">
                            <select class="form-control" name="desa">
                                <option value="">>> Pilih Desa</option>
                            <?php foreach ($this->db->get_where('desa',['kokec'=>$this->session->userdata('id_puskesmas')])->result() as $k => $v) { ?>
                                <option value="<?=strlen($v->ID)==1?"0".$v->ID:$v->ID?>"><?=$v->nades?></option>
                            <?php } ?>
                            </select>
                </div>
                <div class="col-md-1">
                                
                        </div>
                        <div class="col-md-4">
                                <div class="input-group">
                                    <input type="file" class="form-control" name="filenilai" />
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-info remove">
                                            <span class="glyphicon glyphicon-upload"></span> Upload Excel
                                        </button>
                                    </span>
                                </div>
                        </div>
            </form>
        </div>
        <table class="table table-bordered table-hover table-condensed" style="margin-bottom: 10px">
            <thead class="thead-light">
            <tr>
                <th class="text-center">No</th>
		<!-- <th class="text-center">ID</th> -->
		<th class="text-center">NILAI</th>
		<th class="text-center">SUMBERDATA</th>
		<th class="text-center">KODE</th>
		<th class="text-center">TAHUN</th>
		<th class="text-center">BULAN</th>
		<th class="text-center">PUSKESMAS</th>
		<th class="text-center">DESA</th>
		<th class="text-center">TGL ENTRY</th>
		<th class="text-center">Action</th>
            </tr>
            </thead>
			<tbody><?php
            // print_r($tbnilaidata_gizi_data);die();
            foreach ($tbnilaidata_gizi_data as $tbnilaidata_gizi)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<!-- <td><?php //echo $tbnilaidata_gizi->ID ?></td> -->
			<td><?php echo $tbnilaidata_gizi->NILAI ?></td>
			<td><?php echo $tbnilaidata_gizi->SUMBERDATA ?></td>
			<td><?php echo $tbnilaidata_gizi->KODE ?></td>
			<td><?php echo $tbnilaidata_gizi->TAHUN ?></td>
			<td><?php echo str_bulan($tbnilaidata_gizi->BULAN) ?></td>
			<td><?php echo @$this->db->get_where("puskesmas",["pkid"=>$tbnilaidata_gizi->PUSKESMAS])->row()->puskesmas ?></td>
			<td><?php echo @$this->db->get_where('desa',['kodes'=>$tbnilaidata_gizi->DESA])->row()->nades; ?></td>
			<td><?php echo $tbnilaidata_gizi->TGL_ENTRY ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('tbnilaidata_gizi/read/'.$tbnilaidata_gizi->ID),'Read','class="text-navy"'); 
				echo ' | '; 
				echo anchor(site_url('tbnilaidata_gizi/update/'.$tbnilaidata_gizi->ID),'Update','class="text-navy"'); 
				echo ' | '; 
				echo anchor(site_url('tbnilaidata_gizi/delete/'.$tbnilaidata_gizi->ID),'Delete','class="text-navy" onclick="javascript: return confirm(\'Yakin hapus data?\')"'); 
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
		<?php echo anchor(site_url('tbnilaidata_gizi/excel'), 'Excel', 'class="btn btn-primary"'); ?>
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