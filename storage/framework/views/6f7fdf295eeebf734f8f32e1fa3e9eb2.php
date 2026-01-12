<?php $__env->startSection("css"); ?>
<link rel="stylesheet" href="<?php echo e(asset("assets/css/servis.css")); ?>">
<style>
    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 2000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.7);
        padding-top: 60px;
        transition: opacity 0.3s;
    }

    .modal-content {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        margin: 5% auto;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        width: 90%;
        height:fit-content;
        max-width: 600px;
        position: relative;
        border: 1px solid rgba(44, 66, 87, 0.2);
        transform: translateY(20px);
        opacity: 0;
        transition: all 0.4s ease;
    }

    .modal-content.show {
        transform: translateY(0);
        opacity: 1;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 15px;
        border-bottom: 2px solid #2c4257;
        margin-bottom: 20px;
    }

    .modal-title {
        color: #2c4257;
        font-size: 24px;
        font-weight: 700;
        margin: 0;
    }

    .close-modal {
        color: #2c4257;
        font-size: 32px;
        font-weight: bold;
        cursor: pointer;
        transition: transform 0.2s;
        background: none;
        border: none;
        padding: 0 5px;
    }

    .close-modal:hover {
        transform: rotate(90deg);
        color: #572c2c;
    }

    .modal-body {
        margin: 20px 0;
    }

    .paket-price {
        font-size: 28px;
        font-weight: 800;
        color: #2c4257;
        text-align: center;
        margin: 15px 0;
        background: linear-gradient(45deg, #2c4257, #572c2c);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 2px 4px rgba(44, 66, 87, 0.1);
    }

    .paket-items {
        list-style-type: none;
        padding: 0;
        margin: 20px 0;
    }

    .paket-items li {
        background: white;
        margin: 8px 0;
        padding: 12px 15px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        border-left: 3px solid #2c4257;
        transition: all 0.2s;
        font-weight: 500;
        color: #333;
    }

    .paket-items li:hover {
        transform: translateX(5px);
        box-shadow: 0 3px 8px rgba(0,0,0,0.1);
    }

    .modal-footer {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid rgba(44, 66, 87, 0.1);
    }

    .btn-modal {
        flex: 1;
        padding: 14px;
        border-radius: 10px;
        font-size: 18px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }

    .btn-pesan {
        background: linear-gradient(45deg, #2c4257, #1b2c3d);
        color: white;
    }

    .btn-pesan:hover {
        background: linear-gradient(45deg, #1b2c3d, #101a24);
        box-shadow: 0 6px 15px rgba(44, 66, 87, 0.4);
        transform: translateY(-2px);
    }

    .btn-kembali {
        background: linear-gradient(45deg, #572c2c, #3e1f1f);
        color: white;
    }

    .btn-kembali:hover {
        background: linear-gradient(45deg, #3e1f1f, #2a1515);
        box-shadow: 0 6px 15px rgba(87, 44, 44, 0.4);
        transform: translateY(-2px);
    }

    @media (max-width: 600px) {
        .modal-content {
            width: 95%;
            padding: 20px;
            margin: 10% auto;
        }
        
        .modal-title {
            font-size: 20px;
        }
        
        .paket-price {
            font-size: 24px;
        }
        
        .btn-modal {
            font-size: 16px;
            padding: 12px;
        }
        
        .modal-footer {
            flex-direction: column;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
    <div class="section-detail-layanan">
        <div class="detail-layanan">
            <div class="gambar-layanan">
                <?php
                    $image = App\Models\DetailLayananFoto::where("id_layanan_foto", $datas['layanan_foto']->id_layanan_foto)->get();
                ?>
                <div class="gambar-utama">
                   <?php $__currentLoopData = $image; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <div id="gambar-utama" style="background-image:url(<?php echo e(asset('storage/' . $i->gambar)); ?>)">

                   </div>
                   <?php break; ?>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="gambar">
                    <?php $__currentLoopData = $image; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div onclick="gantiGambarUtama(this)" src-image='<?php echo e(asset('storage/' . $i->gambar)); ?>' style="background-image:url(<?php echo e(asset('storage/' . $i->gambar)); ?>)">
                        
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div class="detail">
                <h1 style="color:#2C4257"><?php echo e($datas['layanan_foto']->nama_layanan_foto); ?></h1>
                <p ><?php echo e($datas['layanan_foto']->deskripsi); ?></p>
                <br>
                <p>Durasi Paket:</p>
                <?php
                $paket = App\Models\Paket::where("id_layanan_foto", $datas['layanan_foto']->id_layanan_foto)->get();
                ?>

                <?php $__currentLoopData = $paket; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p><?php echo e($p->nama_paket); ?> : <?php echo e($p->durasi_pemotretan); ?> menit</p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <div class="section-paket-layanan" style="padding-bottom: 40px">
        <div class="paket-layanan-list">
            <?php $__currentLoopData = $paket; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="paket" style="color:#2C4257; cursor: pointer;" 
                 onclick="openPaketModal(
                     '<?php echo e($p->nama_paket); ?>',
                     <?php echo e($p->harga); ?>,
                     '<?php echo e(addslashes($p->deskripsi)); ?>',
                     '<?php echo e(route('form-pemesanan-index', ['slug' => $datas['layanan_foto']->slug])); ?>?nama_paket=<?php echo e(urlencode($p->nama_paket)); ?>'
                 )">
                <h5 style="padding: 5px; padding-bottom:10px" align='center'><?php echo e($p->nama_paket); ?></h5>
                <center>
                    <?php $__currentLoopData = $image; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <img src="<?php echo e(asset("storage/".$i->gambar)); ?>" alt="">
                        <?php break; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </center>
                <div>
                    <span style="font-weight:bold; font-size:18px; color:#2C4257"><?php echo e('Rp ' . number_format((int)$p->harga, 0, ',', '.')); ?></span>
                </div>
            </div>            
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <!-- Modal Detail Paket -->
    <div id="paketModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalPaketTitle">Nama Paket</h2>
                <button class="close-modal" onclick="closePaketModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="paket-price" id="modalPaketPrice">Rp 0</div>
                <h3 style="color:#2c4257; text-align:center; margin:15px 0 10px">Detail Paket:</h3>
                <ul class="paket-items" id="modalPaketItems">
                    <!-- Items will be populated by JavaScript -->
                </ul>
            </div>
            <div class="modal-footer">
                <button class="btn-modal btn-kembali" onclick="closePaketModal()">
                    <i class="fa fa-arrow-left"></i> Kembali
                </button>
                <button class="btn-modal btn-pesan" id="btnPesanModal">
                    <i class="fa fa-shopping-cart"></i> Pesan Sekarang
                </button>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("js"); ?>
<script>
    headerStatus = true;
    
    // Global variable to store current package URL
    let currentPaketUrl = '';
    
    function gantiGambarUtama(element) {
        const srcImage = element.getAttribute('src-image');
        document.getElementById('gambar-utama').style.backgroundImage = `url('${srcImage}')`;
    }
    
    function openPaketModal(namaPaket, harga, deskripsi, urlPesan) {
        // Set global URL for pesan button
        currentPaketUrl = urlPesan;
        
        // Set modal content
        document.getElementById('modalPaketTitle').textContent = namaPaket;
        document.getElementById('modalPaketPrice').textContent = 'Rp ' + parseInt(harga).toLocaleString('id-ID');
        
        // Parse and display items
        const items = deskripsi.split(',');
        const itemsContainer = document.getElementById('modalPaketItems');
        itemsContainer.innerHTML = '';
        
        items.forEach(item => {
            if (item.trim()) {
                const li = document.createElement('li');
                li.textContent = item.trim();
                itemsContainer.appendChild(li);
            }
        });
        
        // Show modal with animation
        const modal = document.getElementById('paketModal');
        modal.style.display = 'block';
        
        // Trigger animation
        setTimeout(() => {
            document.querySelector('.modal-content').classList.add('show');
        }, 10);
        
        // Prevent scrolling when modal is open
        document.body.style.overflow = 'hidden';
    }
    
    function closePaketModal() {
        const modal = document.getElementById('paketModal');
        const modalContent = document.querySelector('.modal-content');
        
        // Remove animation class first
        modalContent.classList.remove('show');
        
        // Close modal after animation
        setTimeout(() => {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }, 300);
    }
    
    // Close modal when clicking outside content
    window.onclick = function(event) {
        const modal = document.getElementById('paketModal');
        if (event.target === modal) {
            closePaketModal();
        }
    };
    
    // Handle pesan button click
    document.getElementById('btnPesanModal').addEventListener('click', function() {
        if (currentPaketUrl) {
            window.location.href = currentPaketUrl;
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'URL tidak valid untuk paket ini',
                confirmButtonText: 'OK'
            });
        }
    });
    
    // Handle ESC key to close modal
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closePaketModal();
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mainLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\code\unlockis\resources\views/content/Main/servis.blade.php ENDPATH**/ ?>