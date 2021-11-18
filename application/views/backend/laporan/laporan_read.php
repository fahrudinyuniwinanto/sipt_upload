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
				<h2 style="margin-top:0px">Data_kpcpen Read</h2>
				<div class="ibox-tools">
				</div>
			</div>
			<div class="ibox-content">

				<table class="table">
					<tr>
						<td>Nama</td>
						<td><?php echo $nama_lengkap; ?></td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td><?php echo $jenis_kelamin=="L"?"Laki-laki":"Perempuan"; ?></td>
					</tr>
					<tr>
						<td>Tanggal Lahir</td>
						<td><?php echo $tgl_lahir; ?></td>
					</tr>
					
					<tr>
						<td>Data Vaksin</td>
						<td>
							<?php
							foreach ($data_vaksin as $d) {
							?>
								<table class="table table-bordered table-hovered table-striped">
									<tr>
                                    <tr class="danger">
										<td>Vaksinasi</td>
										<td>
											<strong><?php echo $d->vaksinasi ?></strong>
										</td>
									</tr>
										<td>Tanggal</td>
										<td>
											<?php echo $d->tanggal ?>
										</td>
									</tr>
									<tr>
										<td>Kategori</td>
										<td>
											<?php echo $d->kategori." | ".$d->sub_kategori ?>
										</td>
									</tr>
									<tr>
										<td>Tiket Vaksin</td>
										<td>
											<?php echo $d->tiket_vaksin ?>
										</td>
									</tr>
									<tr>
										<td>Faskes (Tempat Vaksinasi)</td>
										<td>
											<?php echo $d->faskes ?>
										</td>
									</tr>
									
									<tr>
										<td>Jenis Vaksin</td>
										<td>
											<?php echo $d->jenis_vaksin ?>
										</td>
									</tr>
								</table>
							<?php } ?>

						</td>

					</tr>
					<tr>
						<td></td>
						<td><a href="<?php echo $_SERVER['HTTP_REFERER'] ?>" class="btn btn-info">Tutup</a></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	</div>
</body>

</html>