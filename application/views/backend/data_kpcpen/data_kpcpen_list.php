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
                            <form enctype="multipart/form-data" action="<?= base_url() ?>ReadExcel/importKpc" method="post">
                                <div class="input-group">
                                    <input type="file" class="form-control" name="filekpc" />
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-info remove">
                                            <span class="glyphicon glyphicon-upload"></span> Upload Excel
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-5 text-right">
                            <a target="_blank" href="<?= "assets/format_excel/format_kpcpen.xlsx" ?>" class="btn btn-warning"><i class="fa fa-cloud-download"></i> Download Format Upload</a>
                        </div>
                        <div class="col-md-3 text-right">
                            <form action="<?php echo site_url('data_kpcpen/index'); ?>" class="form-inline" method="get">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                                    <span class="input-group-btn">
                                        <?php
                                        if ($q <> '') {
                                        ?>
                                            <a href="<?php echo site_url('data_kpcpen'); ?>" class="btn btn-default">Reset</a>
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
                                <th class="text-center">Data Diri</th>
                                <th class="text-center">Vaksinasi</th>
                                <th class="text-center">Action</th>

                            </tr>
                        </thead>
                        <tbody><?php
                                foreach ($data_kpcpen_data as $data_kpcpen) {
                                ?>
                                <tr>
                                    <td width="80px"><?php echo ++$start ?></td>
                                    <td> <b><?php echo $data_kpcpen->nama ?></b> <br>
                                        <?php echo $data_kpcpen->jenis_kelamin ?> <br>
                                    </td>
                                    <td><?php echo $data_kpcpen->vaksinasi ?></td>

                                    <td style="text-align:center" width="200px">
                                        <?php
                                        echo anchor(site_url('data_kpcpen/read/' . $data_kpcpen->id), 'Read', 'class="text-navy"');
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
                            <!-- <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a> -->
                            <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
                            <!-- <?php echo anchor(site_url('data_kpcpen/excel'), 'Excel', 'class="btn btn-primary"'); ?> -->
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