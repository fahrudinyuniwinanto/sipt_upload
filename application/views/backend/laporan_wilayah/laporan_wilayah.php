<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Laporan Per-Desa</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-striped margin bottom">
                            <thead>
                                <tr>
                                    <th style="width: 1%" class="text-center">No.</th>
                                    <th>Desa</th>
                                    <th>Kecamatan</th>
                                    <th class="text-right">Jumlah Sudah Vaksin Dosis 1</th>
                                    <th class="text-right">Jumlah Sudah Vaksin Dosis 2</th>
                                    <th class="text-right">Jumlah Belum Vaksin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($dataPerDesa as $k => $desa) {
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $k + 1; ?></td>
                                        <td> <?php echo $desa->desa ?>
                                        </td>
                                        <td> <?php echo $desa->kecamatan; ?>
                                        </td>
                                        <td class="text-right"><?php echo $desa->jml_sdh_vaksin_1 ?></td>
                                        <td class="text-right"><?php echo $desa->jml_sdh_vaksin_2 ?></td>
                                        <td class="text-right"><?php echo $desa->jml_blm_vaksin ?></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Laporan Per-Kecamatan</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-striped margin bottom">
                            <thead>
                                <tr>
                                    <th style="width: 1%" class="text-center">No.</th>
                                    <th>Kecamatan</th>
                                    <th class="text-right">Jumlah Sudah Vaksin Dosis 1</th>
                                    <th class="text-right">Jumlah Sudah Vaksin Dosis 2</th>
                                    <th class="text-right">Jumlah Belum Vaksin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($dataPerKecamatan as $k2 => $kecamatan) {
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $k2 + 1; ?></td>
                                        <td> <?php echo $kecamatan->kecamatan; ?>
                                        </td>
                                        <td class="text-right"><?php echo $kecamatan->jml_sdh_vaksin_1 ?></td>
                                        <td class="text-right"><?php echo $kecamatan->jml_sdh_vaksin_2 ?></td>
                                        <td class="text-right"><?php echo $kecamatan->jml_blm_vaksin ?></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Laporan Kabupaten</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-striped margin bottom">
                            <thead>
                                <tr>
                                    <th class="text-right">Jumlah Sudah Vaksin Dosis 1</th>
                                    <th class="text-right">Jumlah Sudah Vaksin Dosis 2</th>
                                    <th class="text-right">Jumlah Belum Vaksin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($dataKabupaten as $k3 => $kabupaten) {
                                ?>
                                    <tr>
                                        <td class="text-right"><?php echo $kabupaten->jml_sdh_vaksin_1 ?></td>
                                        <td class="text-right"><?php echo $kabupaten->jml_sdh_vaksin_2 ?></td>
                                        <td class="text-right"><?php echo $kabupaten->jml_blm_vaksin ?></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>