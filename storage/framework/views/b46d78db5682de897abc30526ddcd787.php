<?php $__env->startSection('title', 'Layanan Foto'); ?>

<?php $__env->startSection("urgentStyle"); ?>
<style>
  #delete-image {
    opacity: 0; /* Set initial visibility to hidden */
  }
  #delete-image:hover {
    opacity: 1;
  }

  .container-image-layanan {
    display: grid;
    grid-template-columns:  auto auto auto;
    justify-content: space-around
  }

  .gambar-layanan {
    width:130px;
    height:130px;
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
  }
  .gambar-layanan-detail {
    width:220px;
    height:190px;
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
  }
</style>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="modal fade" id="modal-post-layanan-foto" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel4">Tambah Layanan Foto Baru</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="<?php echo e(Route("layanan-foto-post")); ?>" enctype="multipart/form-data">
        <div class="modal-body">
         <div class="row">
          <div class="card">
                <div class="card-body">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field("POST"); ?>
                      <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="layanan_foto">Nama</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="nama_layanan_foto" id="layanan_foto" placeholder="Masukkan Nama Layanan Foto Baru" />
                        </div>

                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="deskripsi">Deskripsi</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="5"></textarea>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="gambar">Gambar</label>
                        <div class="col-sm-10">
                          <input class="form-control" type="file" name="gambar[]" id="gambar" accept=".png, .jpg" multiple>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </div>
</form>
</div>
    </div>

<div class="row gy-4">
    <div>
        <button data-bs-toggle="modal" data-bs-target="#modal-post-layanan-foto" class="btn btn-primary">Tambah Baru</button>
    </div>
    <div class="card">
        <h5 class="card-header">Data Layanan Foto</h5>
        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead>
              <tr>
                <th class="text-truncate">Nama Layanan Foto</th>
                <th class="text-truncate">Gambar</th>
                <th class="text-truncate">Aksi</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">

             <?php $__currentLoopData = $datas[0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $layanan_foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            <?php
            $layanan_foto_detail = App\Models\LayananFoto::find($layanan_foto->id_layanan_foto);
            ?>
             <div class="modal fade" id="modal-edit-layanan-foto-<?php echo e($layanan_foto->id_layanan_foto); ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="exampleModalLabel4">Edit Layanan Foto Baru</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="<?php echo e(Route("layanan-foto-edit", $layanan_foto_detail->id_layanan_foto)); ?>" enctype="multipart/form-data">
                    <div class="modal-body">
                     <div class="row">
                      <div class="card">
                            <div class="card-body">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field("PUT"); ?>
                                  <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="layanan_foto">Nama</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" value="<?php echo e($layanan_foto_detail->nama_layanan_foto); ?>" name="nama_layanan_foto" id="layanan_foto" placeholder="Masukkan Nama Layanan Foto Baru" />
                                    </div>
                                  </div>
                                  <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="deskripsi">Deskripsi</label>
                                    <div class="col-sm-10">
                                      <textarea class="form-control" value="}" name="deskripsi" id="deskripsi" cols="30" rows="5"><?php echo e($layanan_foto_detail->deskripsi); ?></textarea>
                                    </div>
                                  </div>
                                  <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="gambar">Gambar</label>
                                    <div class="col-sm-10">
                                      <input class="form-control" type="file" name="gambar[]" id="gambar" accept=".png, .jpg" multiple>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </div>
            </form>
            </div>
                </div>
                
                
                <div class="modal fade" id="modal-gambar-<?php echo e($layanan_foto->id_layanan_foto); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Gambar Layanan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="d-flex justify-content-center">
                          <div class="container-image-layanan">
                            <?php $__currentLoopData = App\Models\DetailLayananFoto::where("id_layanan_foto", $layanan_foto->id_layanan_foto)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div  style="cursor: pointer;position:relative">
                              <a href="<?php echo e(Route("layanan-detail-foto-delete", $g->id_detail_layanan_foto)); ?>" id="delete-image" style="background-color:rgba(0, 0, 0, 0.358);width:220px;height:190px;position: absolute;display:flex;justify-content:center;align-items:center">
                                <i style="color:white;font-size:30px" class="fa fa-trash" aria-hidden="true"></i>
                              </a>
                              <div style="    background-image:url('<?php echo e(asset('storage/' . $g->gambar)); ?>');" class="gambar-layanan-detail">

                              </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <p class="text-truncate"><b>Hover ke gambar untuk menghapus gambar</b></p>
                      </div>
                    </div>
                  </div>
                </div>
                
                <tr>
                    <td class="text-truncate"><?php echo e($layanan_foto->nama_layanan_foto); ?></td>
                    <td class="text-truncate" >
                        <?php if((App\Models\DetailLayananFoto::where("id_layanan_foto", $layanan_foto->id_layanan_foto)->get()->isEmpty())): ?>
                        Belum Ada Gambar
                        <?php else: ?>
                          <?php $__currentLoopData = App\Models\DetailLayananFoto::where("id_layanan_foto", $layanan_foto->id_layanan_foto)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <span data-bs-toggle="modal" data-bs-target="#modal-gambar-<?php echo e($layanan_foto->id_layanan_foto); ?>" style="cursor: pointer">
                            <div style="    background-image:url('<?php echo e(asset('storage/' . $g->gambar)); ?>');" class="gambar-layanan">

                            </div>
                          </span>
                            <?php break; ?>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endif; ?>
                    </td>
                    <td class="d-flex gap-2">
                        <button data-bs-toggle="modal" data-bs-target="#modal-edit-layanan-foto-<?php echo e($layanan_foto->id_layanan_foto); ?>" class="btn btn-success">Edit</button>
                        <form action="<?php echo e(Route("layanan-foto-delete", $layanan_foto->id_layanan_foto)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field("DELETE"); ?>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </tbody>
          </table>
        </div>
      </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/contentNavbarLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\code\unlockis\resources\views/content/pemesanan/layanan_foto.blade.php ENDPATH**/ ?>