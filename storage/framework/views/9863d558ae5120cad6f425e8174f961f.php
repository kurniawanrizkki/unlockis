<h1>Pemesanan Baru</h1>
<p>Detail Pemesanan:</p>
<ul>
    <li>Nama: <?php echo e($pemesanan->pelanggan->nama_lengkap); ?></li>
    <li>No Whatsapp: <?php echo e($pemesanan->pelanggan->no_wa); ?></li>
    <li>Instagram: <?php echo e($pemesanan->pelanggan->instagram); ?></li>
    <li>Rekening: <?php echo e($pemesanan->pelanggan->no_rekening); ?> (<?php echo e($pemesanan->pelanggan->nama_bank); ?>)</li>
    <li>Paket Pilihan: <?php echo e($pemesanan->paket->nama_paket); ?></li>
    <li>Jam Booking: <?php echo e($pemesanan->jam_booking); ?></li>
    <li>Tanggal Booking: <?php echo e($pemesanan->tanggal_booking); ?></li>
    <li>Total Orang Foto: <?php echo e($pemesanan->total_orang_foto); ?></li>
    <li>Catatan: <?php echo e($pemesanan->catatan); ?></li>
    <li>Total Harga: <?php echo e('Rp ' . number_format((int) $pemesanan->total_harga, 0, ',', '.')); ?></li>
</ul>
<?php /**PATH C:\code\unlockis\resources\views/emails/notification.blade.php ENDPATH**/ ?>