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
                    <h2><b>Sinkronisasi Data Vaksin</b></h2>
                    <?php if ($this->session->userdata('message') != '') { ?>
                        <div class="alert alert-success alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <?= $this->session->userdata('message') ?> <a class="alert-link" href="#"></a>
                        </div>
                    <?php } ?>
                </div>
                <div class="ibox-content">
                    <div class="row" style="margin-bottom: 10px">
                        

                        <div class="col-md-12 text-left">
                        <a href="#" class="btn btn-primary"><i class="fa fa-download"></i> Download Excel</a>
                        <a href="#" class="btn btn-primary">Jumlah Data : <?php echo $total_rows ?></a>
                        </div>
                        <div class="col-md-12">
                        <form action="<?php echo site_url('laporan/index'); ?>" class="form-inline" method="get">
                        <div class="form-group">
                        <label>Tanggal </label>
                        <div class="input-group">
                        <input type="date" name="qstart" id="qstart" class="form-control" title="Tanggal Mulai">
                        <span class="input-group-addon disabled">s/d</span>
                        <input type="date" name="qend" id="qend" class="form-control" title="Tanggal Selesai">
                    </div>
                    </div>
                    <br>
                         <div class="form-group">
                        <label>Sudah Vaksin</label>
                        <select name="qisvaksin" id="qisvaksin" class="form-control">
                            <option value="">>> Pilih</option>
                            <option value="BLM12">BELUM 1 DAN 2</option>
                            <option value="BLM2">SUDAH 1 DAN BELUM 2 (BELUM LEWAT TGL)</option>
                            <option value="BLM2EXP">SUDAH 1 DAN BELUM 2 (LEWAT TANGGAL)</option>
                            <option value="SDH12">SUDAH 1 DAN 2</option>
                        </select>
                    </div>
                         <div class="form-group">
                            <label>Nama</label>
                        <input type="text" class="form-control" name="qnama" value="<?php echo $qnama; ?>">
                    </div>
                    <div class="form-group">
                        <label>kecamatan</label>
                        <?=form_dropdown('qkec', $datakec, "", array('class'=>'form-control','id'=>'qkec','onchange'=>'setKec()'));?>
                    </div>
                    <div class="form-group">
                        <label>Desa</label>
                        <select name="qdesa" id="qdesa" class="form-control">
                            <!-- DATA DESA -->
                        </select>
                    </div>
                          <button class="btn btn-primary" type="submit">Search</button>
                          <button class="btn btn-primary" type="button" onclick="window.location.href='<?=base_url()?>laporan'">Refresh</button>
                </form>
                    </div>
                    
                    </div>
                    <table class="table table-bordered table-hover table-condensed" style="margin-bottom: 10px">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Lengkap</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Desa</th>
                                <th class="text-center">Kecamatan</th>
                                <th class="text-center">Faskes/Kelompok Usia</th>
                                <th class="text-center">Data Vaksin</th>
                                
                                <th class="text-center">Keterangan</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody><?php
                                foreach ($sync_capil_data as $sync_capil) {
                                ?>
                                <tr>
                                    <td width="80px"><?php echo ++$qstart ?></td>
                                    <td><?php echo $sync_capil->nama_lengkap ?></td>
                                    <td><?php echo $sync_capil->alamat ?></td>
                                    <td><?php echo $sync_capil->desa ?></td>
                                    <td><?php echo $sync_capil->kecamatan ?></td>
                                    <td><?php if ($sync_capil->nik_capil = $sync_capil->nik_kpcpen ){
                                        echo $sync_capil->faskes; 
                                        echo " / ";
                                        echo $sync_capil->kelompok_usia ;
                                    } else {
                                        echo "<button class='btn btn-outline btn-danger dim' ><i class='fa fa-times'></i> Belum Vaksin </button>";
                                    } ?></td>
                                    
                                    <td><?php if ($sync_capil->nik_capil = $sync_capil->nik_kpcpen ){
                                        echo " Data :<br> ";
                                        echo $sync_capil->vaksin2 ;
                                    } else {
                                        echo "<button class='btn btn-outline btn-danger dim' > <i class='fa fa-times'></i> Belum Vaksin </button>";
                                    } ?>
                                    </td>

                                    <td style="text-align:center">
                                    
                                        <?php if ($sync_capil->nik_capil = $sync_capil->nik_kpcpen ) {
                                            echo "<button class='btn btn-outline btn-primary dim btn-xs'> <i class='fa fa-check'></i> Sudah Vaksin </button>";
                                        } else {
                                            echo "<button class='btn btn-outline btn-danger dim btn-xs'> <i class='fa fa-times'></i> Belum Vaksin </button>";
                                        }
                                        
                                        ?>
                                    </td>

                                    <td style="text-align:center" width="200px">
                                    
                                        <?php if ($sync_capil->nik_capil = $sync_capil->nik_kpcpen ) {
                                            echo anchor(site_url('data_kpcpen/read/' . $sync_capil->id),'<i class="fa fa-search"></i> Lihat Data KPCPEN', 'class="btn btn-outline btn-warning dim btn-xs"');
                                            
                                        } else {
                                            echo "<button class='btn btn-outline btn-danger dim btn-xs'> <i class='fa fa-times'></i> Belum Vaksin </button>";
                                        }
                                        
                                        ?>
                                    </td>
                                </tr>

                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    
                    <div class="row">
                        
                        <div class="col-md-6 text-right">
                            <?php echo $pagination ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        function setKec() {
            var kec = $("#qkec").val();
            $.ajax({
                url:"<?=base_url()?>Laporan/setKec/"+kec,
                type:"POST",
                dataType:"html",
                data:{},
                success:function(data){
                    $("#qdesa").html(data);
                }
            })
        }
        function thisFileUpload() {
            document.getElementById("file").click();
        };
    </script>
</body>

</html>