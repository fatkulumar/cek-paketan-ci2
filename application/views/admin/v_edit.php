
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header bg-success"><strong><h1>Edit Data</strong></div>
          <div class="card-body">

            <form class="mt-3 mb-3" action="<?= base_url('admin/update_data/' . $data->id_paket) ?>" method="POST">
                <input type="hidden" value="<?= date("d-m-Y h:i:s") ?>" name="last_modified">
                <div class="form-group">
                    <label for="no_hp">Hp</label>
                    <input class="form-control" type="number" name="no_hp" value="<?= $data->hp ?>" required placeholder="085">
                </div>

                <div class="form-group">
                    <label for="nama_paket">Nama Paketan</label>
                    <input class="form-control" type="text" name="nama_paket" value="<?= $data->nama_paket ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="penerima">Penerima</label>
                    <select class="form-control" name="penerima" value="<?= $data->penerima ?>" required>
                      <option value="Gasmul">Gasmul</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="jml_paket">Jumlah Paket</label>
                    <select class="form-control" name="jml_paket" value="<?= $data->jml_paket ?>" required>
                    <option value="1" <?php if($data->jml_paket == 1){echo "selected";}?>>1</option>
                      <option value="2" <?php if($data->jml_paket == 2){echo "selected";}?>>2</option>
                      <option value="3" <?php if($data->jml_paket == 3){echo "selected";}?>>3</option>
                      <option value="4" <?php if($data->jml_paket == 4){echo "selected";}?>>4</option>
                      <option value="5" <?php if($data->jml_paket == 5){echo "selected";}?>>5</option>
                      <option value="6" <?php if($data->jml_paket == 6){echo "selected";}?>>6</option>
                      <option value="7" <?php if($data->jml_paket == 7){echo "selected";}?>>7</option>
                      <option value="8" <?php if($data->jml_paket == 8){echo "selected";}?>>8</option>
                      <option value="9" <?php if($data->jml_paket == 9){echo "selected";}?>>9</option>
                      <option value="10" <?php if($data->jml_paket == 10){echo "selected";}?>>10</option>
                    </select>
                </div>
                
                <div class="form-group">
                  <label for="jenis_kirim">Jenis</label>
                  <p>
                    <input type="radio" name="jenis_kirim" value="Langsung" checked="checked" /> Langsung
                    <input type="radio" name="jenis_kirim" value="COD" <?php if($data->jenis_kirim == "COD") {echo "checked";} ?>> COD
                  </p>
                </div>

                <div class="form-group">
                    <label for="pengambil">Pengambil</label>
                    <input class="form-control" type="text" name="pengambil" value="<?= $data->pengambil ?>">
                </div>

                <div>
                    <button class="btn btn-success btn-sm" type="submit" name="edit">Edit Resi</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>