<?php
// memasukkan header halaman
include '.includes/header.php';
// menyertakan file untuk menampilkan notifikasi (jika ada)
include '.includes/toast_notification.php';
?>

<div class="container-xxl flex-groe-1 container-p-y">
    <!-- tabel data dokter -->
     <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Data Dokter</h4>
            <!-- tombol untuk menambah dokter baru -->
             <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDokter">
                Tambah
             </button>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table id="datatable" class="table table-hover">
                    <thead>
                        <tr class="text-center">
                            <th width="50px">#</th>
                            <th width="150px">Nama Dokter</th>
                            <th width="150px">Spesialisasi</th>
                            <th width="150px">Pilihan</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <!-- mengambil data dokter dari database -->
                     <?php
                     $index = 1;
                     $query = "SELECT * FROM dokter";
                     $exec = mysqli_query($conn, $query);
                     while ($dokter = mysqli_fetch_assoc($exec)) :
                        ?>
                        <tr>
                            <!-- menampilkan nomor, nama dokter, spesialisasi, dan opsi -->
                             <td><?= $index++; ?></td>
                             <td><?= $dokter['nama_dokter']; ?></td>
                             <td><?= $dokter['spesialisasi']; ?></td>
                             <td>
                                <!-- dropdown untuk opsi edit dan delete -->
                                 <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle 
                                    hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#editDokter_<?= $dokter['dokter_id']; ?>">
                                        <i class="bx bx-edit-alt me-2"></i>Edit</a>
                                        <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#deleteDokter_<?= $dokter['dokter_id']; ?>">
                                    <i class="bx bx-trash me-2"></i>Delete</a>
                                    </div>
                                 </div>
                             </td>
                        </tr>
                        <!-- modal untuk hapus data dokter -->
                          <div class="modal fade" id="deleteDokter_<?= $dokter['dokter_id']; ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Hapus Dokter?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="proses_dokter.php" method="POST">
                                            <div>
                                                <p>Tindakan ini tidak bisa dibatalkan.</p>
                                                <input type="hidden" name="dokter_id" value="<?= $dokter['dokter_id']; ?>">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" name="delete" class="btn btn-primary">Hapus</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                          </div>
                        <!-- modal untuk update data dokter -->
                         <div id="editDokter_<?= $dokter['dokter_id']; ?>" class="modal fade" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Update Data Dokter</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="proses_dokter.php" method="POST">
                                            <!-- input untuk nama  dokter -->
                                             <input type="hidden" name="dokter_id" value="<?= $dokter['dokter_id']; ?>">

                                             <!-- Update nama dokter -->
                                             <div class="form-group mb-3">
                                             <label>Update Nama Dokter</label>
                                             <select name="nama_dokter" class="form-control" required>
                                                <option value="">-- Update Nama Dokter --</option>
                                                <option value="dr. Nining Septika, S.Ked." <?= ($dokter['nama_dokter'] == 'dr. Nining Septika, S.Ked.') ? 'selected' : ''; ?>>dr. Nining Septika, S.Ked.</option>
                                                <option value="dr. Anita Cintya, Sp.A." <?= ($dokter['nama_dokter'] == 'dr. Anita Cintya, Sp.A.') ? 'selected' : ''; ?>>dr. Anita Cintya, Sp.A.</option>
                                                <option value="dr. Alex, Sp.B." <?= ($dokter['nama_dokter'] == 'dr. Alex, Sp.B.') ? 'selected' : ''; ?>>dr. Alex, Sp.B.</option>
                                                <option value="dr. Zayn Usman, drg." <?= ($dokter['nama_dokter'] == 'dr. Zayn Usman, drg.') ? 'selected' : ''; ?>>dr. Zayn Usman, drg.</option>
                                                <option value="dr. Alana, Sp.OG." <?= ($dokter['nama_dokter'] == 'dr. Alana, Sp.OG.') ? 'selected' : ''; ?>>dr. Alana, Sp.OG.</option>
                                                <option value="dr. Raka, Sp.M." <?= ($dokter['nama_dokter'] == 'dr. Raka, Sp.M.') ? 'selected' : ''; ?>>dr. Raka, Sp.M.</option>
                                                <option value="dr. Lestari, Sp.G." <?= ($dokter['nama_dokter'] == 'dr. Lestari, Sp.G.') ? 'selected' : ''; ?>>dr. Lestari, Sp.G.</option>
                                                <option value="dr. Bagas Setyawan, Sp.S." <?= ($dokter['nama_dokter'] == 'dr. Bagas Setyawan, Sp.S.') ? 'selected' : ''; ?>>dr. Bagas Setyawan, Sp.S.</option>
                                             </select>
                                             </div>

                                             <!-- Update spesialisasi dokter -->
                                             <div class="form-group mb-3">
                                             <label>Update Spesialisasi</label>
                                             <select name="spesialisasi" class="form-control" required>
                                                <option value="">-- Update Spesialisasi --</option>
                                                <option value="Umum" <?= ($dokter['spesialisasi'] == 'Umum') ? 'selected' : ''; ?>>Umum</option>
                                                <option value="Anak" <?= ($dokter['spesialisasi'] == 'Anak') ? 'selected' : ''; ?>>Anak</option>
                                                <option value="Bedah" <?= ($dokter['spesialisasi'] == 'Bedah') ? 'selected' : ''; ?>>Bedah</option>
                                                <option value="Gigi" <?= ($dokter['spesialisasi'] == 'Gigi') ? 'selected' : ''; ?>>Gigi</option>
                                                <option value="Kandungan" <?= ($dokter['spesialisasi'] == 'Kandungan') ? 'selected' : ''; ?>>Kandungan</option>
                                                <option value="Mata" <?= ($dokter['spesialisasi'] == 'Mata') ? 'selected' : ''; ?>>Mata</option>
                                                <option value="Gizi" <?= ($dokter['spesialisasi'] == 'Gizi') ? 'selected' : ''; ?>>Gigi</option>
                                                <option value="Saraf" <?= ($dokter['spesialisasi'] == 'Saraf') ? 'selected' : ''; ?>>Saraf</option>
                                             </select>
                                             </div>

                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" name="update" class="btn btn-warning">Update</button>
                                             </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                         </div>
                        <?php endwhile; ?>
                </tbody>
                </table>
            </div>
        </div>
     </div>
</div>
<?php include '.includes/footer.php'; ?>

<!-- modal untuk tambah data dokter -->
 <div class="modal fade" id="addDokter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-tittle">Tambah Dokter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="proses_dokter.php" method="POST">

                <!-- nama dokter-->
                <div class="form-group mb-3">
                    <label for="dokter" class="form-label">Dokter</label>
                    <select name="nama_dokter" class="form-control" required>
                        <option value="">-- Pilih Dokter --</option>
                        <?php
                        $daftar_dokter = [
                            'dr. Nining Septika, S.Ked.',
                            'dr. Anita Cintya, Sp.A.',
                            'dr. Alex, Sp.B.',
                            'dr. Zayn Usman, drg.',
                            'dr. Alana, Sp.OG.',
                            'dr. Raka, Sp.M.',
                            'dr. Lestari, Sp.G.',
                            'dr. Bagas Setyawan, Sp.S.'
                        ];
                        foreach ($daftar_dokter as $nama_dokter) {
                            $selected = ($dokter['dokter'] ?? '') == $nama_dokter ? 'selected' : '';
                            echo "<option value=\"$nama_dokter\" $selected>$nama_dokter</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- spesialisasi dokter -->
                <div class="form-group mb-3">
                    <label for="dokter" class="form-label">Spesialisasi</label>
                    <select name="spesialisasi" class="form-control" required>
                        <option value="">-- Pilih Spesialisasi --</option>
                        <?php
                        $daftar_dokter = [
                            'Umum',
                            'Anak',
                            'Bedah',
                            'Gigi',
                            'Kandungan',
                            'Mata',
                            'Gizi',
                            'Saraf'
                        ];
                        foreach ($daftar_dokter as $nama_dokter) {
                            $selected = ($dokter['dokter'] ?? '') == $nama_dokter ? 'selected' : '';
                            echo "<option value=\"$nama_dokter\" $selected>$nama_dokter</option>";
                        }
                        ?>
                    </select>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 </div>