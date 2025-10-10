<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-shield-alt"></i> Akses Ditolak
                    </h4>
                </div>
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="fas fa-exclamation-triangle text-danger" style="font-size: 4rem;"></i>
                    </div>

                    <h5 class="card-title text-danger mb-3">Akses Tidak Diizinkan</h5>

                    <p class="card-text text-muted mb-4">
                        <?php echo htmlspecialchars($message); ?>
                    </p>

                    <div class="alert alert-warning">
                        <small>
                            <strong>Alasan yang mungkin:</strong><br>
                            • Link yang Anda akses sudah kadaluarsa<br>
                            • Anda tidak memiliki izin untuk mengakses halaman ini<br>
                            • Sesi login Anda telah berakhir<br>
                            • Link tidak valid atau telah dimodifikasi
                        </small>
                    </div>

                    <div class="d-grid gap-2">
                        <?php if (!$this->session->userdata('logged_in')): ?>
                            <a href="<?php echo site_url('auth/login'); ?>" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </a>
                        <?php else: ?>
                            <a href="<?php echo site_url('student'); ?>" class="btn btn-primary">
                                <i class="fas fa-home"></i> Kembali ke Dashboard
                            </a>
                            <a href="<?php echo site_url('payment/orders'); ?>" class="btn btn-outline-primary">
                                <i class="fas fa-list"></i> Lihat Pembayaran Saya
                            </a>
                        <?php endif; ?>

                        <a href="<?php echo site_url(); ?>" class="btn btn-link">
                            <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                        </a>
                    </div>

                    <hr class="my-4">

                    <div class="text-start">
                        <small class="text-muted">
                            <strong>Butuh bantuan?</strong><br>
                            Jika Anda merasa ini adalah kesalahan, silakan hubungi administrator sistem.
                        </small>
                    </div>
                </div>
                <div class="card-footer text-muted text-center">
                    <small>
                        <i class="fas fa-clock"></i>
                        Waktu: <?php echo date('d/m/Y H:i:s'); ?>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-refresh page after 30 seconds for expired tokens
<?php if (isset($error_type) && $error_type === 'security'): ?>
setTimeout(function() {
    window.location.href = '<?php echo site_url(); ?>';
}, 30000);
<?php endif; ?>
</script>
