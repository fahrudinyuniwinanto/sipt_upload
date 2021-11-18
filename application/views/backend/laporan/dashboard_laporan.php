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
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#formfilter" aria-expanded="false" aria-controls="formfilter">
                    <i class="fa fa-filter"></i> Filter data
                </button>
                <a href="<?=base_url()?>laporan/excel" class="btn btn-warning"><i class="fa fa-cloud-download"></i> Download Excel (<?=$total_rows?> data)</a>
                    <div class="row collapse" id="formfilter" style="margin-bottom: 10px;margin-top:10px;">
                        <form action="<?php echo site_url('laporan/index'); ?>" method="get">
                        <div class="col-md-6">
                         <div class="form-group row">
    <label class="col-sm-2 col-form-label">Status Vaksin</label>
    <div class="col-sm-10">
    <select name="qisvaksin" id="qisvaksin" class="form-control">
                            <option value="">>> Tampilkan semua </option>
                            <option value="B1B2" <?=@$_GET['qisvaksin']=="B1B2"?"selected":""?>>BELUM 1 DAN 2</option>
                            <option value="S1B2" <?=@$_GET['qisvaksin']=="S1B2"?"selected":""?>>SUDAH 1 DAN BELUM 2 (BELUM LEWAT TGL)</option>
                            <option value="S1B2ED" <?=@$_GET['qisvaksin']=="S1B2ED"?"selected":""?>>SUDAH 1 DAN BELUM 2 (LEWAT TANGGAL)</option>
                            <option value="S1S2" <?=@$_GET['qisvaksin']=="S1S2"?"selected":""?>>SUDAH 1 DAN 2</option>
                            <option value="S1S2S3" <?=@$_GET['qisvaksin']=="S1S2S3"?"selected":""?>>SUDAH 1, 2, DAN 3</option>
                            <option value="BLANK" <?=@$_GET['qisvaksin']=="BLANK"?"selected":""?>>DATA BLANK</option>
                        </select>
    </div>
  </div>
                         <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                        <input type="text" class="form-control" name="qnama" value="<?php echo @$_GET['qnama']; ?>">
                    </div>
                    </div>
                   <!--  <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">Faskes</label>
                            <div class="col-sm-10">
                            <?//=form_dropdown('qfaskes', $datafaskes, @$_GET['qfaskes'], array('class'=>'form-control','id'=>'qfaskes'));?>
                    </div>
                    </div> -->
                    
                    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Search</button>
                          <button class="btn btn-primary" type="button" onclick="window.location.href='<?=base_url()?>laporan'"><i class="fa fa-refresh"></i> Refresh</button>
                          
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">Kecamatan</label>
                            <div class="col-sm-10">
                        <?=form_dropdown('qkec', $datakec, @$_GET['qkec'], array('class'=>'form-control','id'=>'qkec','onchange'=>'setKec()'));?>
                    </div>
                    </div>
                    <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">Desa</label>
                            <div class="col-sm-10">
                        <select name="qdesa" id="qdesa" class="form-control">
                            <option value="">>> Semua Desa</option>
                        </select>
                    </div>
                    </div>
                        </div>
                </form>
                    
                    </div>
                    <table class="table table-bordered table-hover table-condensed" style="margin-bottom: 10px">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Lengkap</th>
                                <th class="text-center">Jenis Kelamin</th>
                                <th class="text-center">Kecamatan</th>
                                <th class="text-center">Desa</th>
                                <th class="text-center">Jenis</th>
                                <th class="text-center">Faskes</th>
                                <th class="text-center">Vaksin</th>
                                <th class="text-center">Keterangan</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody><?php
                                foreach ($sync_capil_data as $v) {
                                    $vaksin=@$this->db->query("select count(*) as numvaksin,group_concat(vaksinasi order by tanggal) as vaksinasi,faskes,jenis_vaksin,group_concat(tanggal) as tanggal from data_kpcpen where nik='$v->nik'")->row();
                                    $tanggalvaksin1 = @explode(",",$vaksin->tanggal)[0];
                                    $tanggalvaksin2 = @explode(",",$vaksin->tanggal)[1];
                                    $tanggalvaksin3 = @explode(",",$vaksin->tanggal)[2];
                                    /* if($vaksin->jenis_vaksin=='AstraZeneca'){
                                        $tanggalvaksin2should=strtotime($tanggalvaksin1." + 3 month");
                                    }else{
                                        $tanggalvaksin2should=strtotime($tanggalvaksin1." + 1 month");
                                    } */
                                    $iconsudah="<i style='color:green' class='fa fa-check-circle'></i>";
                                    $iconbelum="<i style='color:red' class='fa fa-minus-circle'></i>";
                                    $iconsilang="<i style='color:red' class='fa fa-times-circle'></i>";
                                    $iconwarning="<i style='color:orange' class='fa fa-warning'></i>";
                                    $iconmenunggu="<i style='color:orange' class='fa fa-clock-o'></i>";
                                    //note
                                    $note="";
                                    if($tanggalvaksin2!=""){//vaksin 2 ada isi
                                        $stat="S1S2";
                                        $note=$iconwarning." Selengkapnya lihat detail";
                                    }else if($tanggalvaksin1==""){//vaksin 1 belum isi
                                        $stat="B1B2";
                                        $note.=$iconwarning." belum vaksin dosis 1 & 2";
                                    }else if($tanggalvaksin1!=""&&$tanggalvaksin2==""){//sudah vaksin 1
                                        $stat="S1B2";
                                        if($vaksin->jenis_vaksin=='AstraZeneca'){
                                            $range="+3 month";
                                        }else{
                                            $range="+1 month";
                                        }
                                        $next=@date("d-m-Y", strtotime($range, strtotime($tanggalvaksin1)));
                                        if(strtotime($next)<strtotime(date("d-m-Y"))){//sudah ED
                                            $note.=$iconwarning." Dosis 2 seharusnya tanggal $next lalu";
                                        }else{
                                            $note.=$iconwarning." Selengkapnya lihat detail";
                                        }
                                    }
                                ?>
                                <tr class='<?=$stat=="B1B2"?"danger":($stat=="S1B2"?"warning":($stat=="S1S2"?"success":""))?>'>
                                    <td width="80px"><?php echo ++$start ?></td>
                                    <td><strong><?php echo $v->nama_lengkap ?></strong></td>
                                    <td><?php echo $v->jenis_kelamin=='L'?"Laki-laki":"Perempuan" ?></td>
                                    <td><?php echo $v->kecamatan ?></td>
                                    <td><?php echo $v->desa ?></td>
                                    <td><?=$vaksin->jenis_vaksin!=""?$vaksin->jenis_vaksin:"-"?></td>
                                    <td><?=$vaksin->faskes!=""?$vaksin->faskes:"-"?></td>
                                    <td><?=$vaksin->vaksinasi==""?"-":"Sudah ".$vaksin->vaksinasi?></td>
                                    <td><?=$note?></td>
                                    <td> <?php 
                                            echo anchor(site_url('laporan/read/' . $v->nik),'<i class="fa fa-search"></i> Lihat Detail', 'class="btn btn-warning dim btn-xs"');
                                        ?></td>
                                    
                                </tr>

                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    
                    <div class="row">
                        <div class="col-md-6">
                        <a href="#" class="btn btn-primary">Jumlah Data : <?php echo $total_rows ?></a>
                        </div>
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