<?php
// menyertakan header halaman
include '.includes/header.php';
include 'config.php';
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- judul halaman -->
     <div class="row">
        <!-- form untuk menambahkan jadwal baru -->
         <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="POST" action="proses_pasien.php"
                    enctype="multipart/form-data">
                <!-- input untuk mengunggah nama pasien -->
                    <div class="mb-3">
                      <label for="nama_pasien" class="form-label">Nama Anda</label>
                      <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" required>
                    </div>

                <!-- input untuk gender -->
                    <div class="mb-3">
                      <label for="gender" class="form-label">Gender</label>
                      <select class="form-select" id="gender" name="gender" required>
                        <option value="">Pilih Gender</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                      </select>
                    </div>

                <!-- input untuk tanggal lahir -->
                    <div class="mb-3">
                      <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                      <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?= !empty($pasien['tgl_lahir']) ? $pasien['tgl_lahir'] : '' ?>" required>
                    </div>

                  <!-- dropdown untuk memilih dokter -->
                   <div class="mb-3">
                    <label for="dokter_id" class="form-label">Dokter</label>
                    <select class="form-select" id="dokter_id" name="dokter_id" required>
                      <option value="" selected disabled>Select one</option>
                      <?php
                      // mengambil data kategori dari database
                      $queryDokter = "SELECT * FROM dokter";
                      $resultDokter =$conn->query($queryDokter);
                      
                      // menambahkan opsi ke dropdown
                      if ($resultDokter->num_rows > 0) {
                        while ($row = $resultDokter->fetch_assoc()) {
                          // menandai dokter yang sudah di pilih
                          $selected = ($row["dokter_id"] == $post['dokter_id']) ? "selected" : "";
                          echo "<option value='" . $row["dokter_id"] . "' $selected>" . $row["nama_dokter"] . "</option>";
                        }
                      }
                      ?>
                    </select>
                  </div>

                   <!-- input untuk menetukan waktu pertemuan -->
                  <div class="mb-3">
                  <label for="meeting" class="form-label">Tentukan Tanggal Pertemuan</label>
                  <input class="form-control" type="date" id="meetingDate" name="meetingDate" required />
                  </div>

                  <div class="mb-3">
                  <label for="meetingTime" class="form-label">Tentukan Waktu Pertemuan</label>
                  <input class="form-control" type="time" id="meetingTime" name="meetingTime" required />
                  </div>

                   <!-- memasukkan keluhan yang pasien alami -->
                    <div class="mb-3">
                      <label for="content" class="form-label">Keluhan yang di alami pasien</label>
                      <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" required>
                    </div>
                    <!-- tombol submit -->
                     <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                </form>
                </div>
            </div>
         </div>
     </div>
</div>
<?php
// menyertakan footer halaman
include '.includes/footer.php';
?>