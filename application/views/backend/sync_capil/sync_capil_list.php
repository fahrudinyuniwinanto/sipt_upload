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
                    <?php if ($this->session->userdata('message') != '') { ?>
                        <div class="alert alert-success alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <?= $this->session->userdata('message') ?> <a class="alert-link" href="#"></a>
                        </div>
                    <?php } ?>
                </div>
                <div class="ibox-content">
                    <div class="row" style="margin-bottom: 10px">

                    <div class="col-md-4">
                            <form enctype="multipart/form-data" action="<?=base_url()?>ReadExcel/importKependudukan" method="post">
                                <div class="input-group">
                                    <input type="file" class="form-control" name="filekependudukan"/>
                                    <span class="input-group-btn">
                                    <button type="submit" class="btn btn-info remove">
                                        <span class="glyphicon glyphicon-upload"></span> Upload Excel

                                    </button>
                    </span>
                                </div>
                            </form>
                        </div>
                      
                        <div class="col-md-5 text-right">
                            <a target="_blank" href="<?= "assets/format_excel/format_dukcapil.xlsx" ?>" class="btn btn-warning"><i class="fa fa-cloud-download"></i> Download Format Upload</a>
                        </div>
                        <div class="col-md-3 text-right">
                            <form action="<?php echo site_url('sync_capil/index'); ?>" class="form-inline" method="get">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                                    <span class="input-group-btn">
                                        <?php
                                        if ($q <> '') {
                                        ?>
                                            <a href="<?php echo site_url('sync_capil'); ?>" class="btn btn-default">Reset</a>
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
                                <th class="text-center">Nama Lengkap</th>
                                <th class="text-center">Tgl Lahir</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Desa</th>
                                <th class="text-center">Kecamatan</th>

                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody><?php
                                foreach ($sync_capil_data as $sync_capil) {
                                ?>
                                <tr>
                                    <td width="80px"><?php echo ++$start ?></td>
                                    <td><?php echo $sync_capil->nama_lengkap ?></td>
                                    <td><?php echo $sync_capil->tgl_lahir ?></td>
                                    <td><?php echo $sync_capil->alamat ?></td>
                                    <td><?php echo $sync_capil->desa ?></td>
                                    <td><?php echo $sync_capil->kecamatan ?></td>

                                    <td style="text-align:center" width="200px">
                                        <?php
                                        echo anchor(site_url('sync_capil/read/' . $sync_capil->nik), 'Read', 'class="text-navy"');
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
        function thisFileUpload() {
            document.getElementById("file").click();
        };
    </script>
</body>

</html>