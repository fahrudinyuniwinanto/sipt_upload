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
                <h2 style="margin-top:0px">Data Bermasalah Read</h2>
                <div class="ibox-tools">
                </div>
            </div>
            <div class="ibox-content">

                <table class="table">
                    <tr>
                        <td>Nik</td>
                        <td><?php echo $nik; ?></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td><?php echo $nama; ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td><?php echo $alamat; ?></td>
                    </tr>
                    <tr>
                        <td>Faskes</td>
                        <td><?php echo $faskes; ?></td>
                    </tr>
                    <tr>
                        <td>Permasalahan</td>
                        <td><?php echo $permasalahan; ?></td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td><?php echo $keterangan; ?></td>
                    </tr>
                    <tr>
                        <td>Sinkronisasi Data Dukcapil</td>
                        <td><?php echo $sinkronisasi_dukcapil; ?></td>
                    </tr>
                    <tr>
                        <td>Perubahan NIK</td>
                        <td><?php echo $perubahan_nik; ?></td>
                    </tr>
                    <tr>
                        <td>Nomor HP</td>
                        <td><?php echo $no_hp; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><a href="<?php echo site_url('sync_data_bermasalah') ?>" class="btn btn-default">Cancel</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    </div>
</body>

</html>