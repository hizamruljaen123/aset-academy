<?php include(APPPATH . 'views/templates/header.php'); ?>

<div class="max-w-4xl mx-auto p-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Test Form Input Styles</h1>
        
        <form class="space-y-6">
            <!-- Basic Input Test -->
            <div class="form-group">
                <label class="form-label required" for="test_nama">Nama Lengkap</label>
                <input type="text" id="test_nama" class="form-input" placeholder="Masukkan nama lengkap Anda">
                <p class="form-help">Nama harus sesuai dengan KTP</p>
            </div>

            <!-- Email with Error -->
            <div class="form-group">
                <label class="form-label required" for="test_email">Email</label>
                <input type="email" id="test_email" class="form-input error" placeholder="user@example.com" value="invalid-email">
                <p class="form-error">Format email tidak valid</p>
            </div>

            <!-- Success State -->
            <div class="form-group">
                <label class="form-label" for="test_username">Username</label>
                <input type="text" id="test_username" class="form-input success" value="johndoe123">
                <p class="form-success">Username tersedia</p>
            </div>

            <!-- Textarea -->
            <div class="form-group">
                <label class="form-label" for="test_alamat">Alamat</label>
                <textarea id="test_alamat" class="form-textarea" rows="4" placeholder="Masukkan alamat lengkap"></textarea>
            </div>

            <!-- Select -->
            <div class="form-group">
                <label class="form-label required" for="test_kelas">Pilih Kelas</label>
                <select id="test_kelas" class="form-select">
                    <option value="">-- Pilih Kelas --</option>
                    <option value="basic">Basic Programming</option>
                    <option value="intermediate">Intermediate</option>
                    <option value="advanced">Advanced</option>
                </select>
            </div>

            <!-- Input Sizes -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="form-group">
                    <label class="form-label">Small Input</label>
                    <input type="text" class="form-input form-input-sm" placeholder="Small">
                </div>
                <div class="form-group">
                    <label class="form-label">Default Input</label>
                    <input type="text" class="form-input" placeholder="Default">
                </div>
                <div class="form-group">
                    <label class="form-label">Large Input</label>
                    <input type="text" class="form-input form-input-lg" placeholder="Large">
                </div>
            </div>

            <!-- Input Group -->
            <div class="form-group">
                <label class="form-label">Harga</label>
                <div class="input-group">
                    <span class="input-group-prepend">Rp</span>
                    <input type="number" class="form-input" placeholder="0">
                    <span class="input-group-append">.00</span>
                </div>
            </div>

            <!-- Floating Label -->
            <div class="form-floating form-group">
                <input type="text" class="form-input" placeholder=" " id="test_floating">
                <label class="form-label" for="test_floating">Nama Depan</label>
            </div>

            <!-- Checkbox -->
            <div class="form-group">
                <label class="custom-checkbox">
                    <input type="checkbox" name="test_terms">
                    <span class="checkmark"></span>
                    <span class="ml-2">Saya menyetujui syarat dan ketentuan</span>
                </label>
            </div>

            <!-- Radio Buttons -->
            <div class="form-group">
                <label class="form-label">Pilih Metode Pembayaran</label>
                <div class="space-y-2">
                    <label class="custom-radio">
                        <input type="radio" name="test_payment" value="transfer">
                        <span class="radiomark"></span>
                        <span class="ml-2">Transfer Bank</span>
                    </label>
                    <label class="custom-radio">
                        <input type="radio" name="test_payment" value="ewallet">
                        <span class="radiomark"></span>
                        <span class="ml-2">E-Wallet</span>
                    </label>
                </div>
            </div>

            <!-- Search -->
            <div class="form-group">
                <label class="form-label">Cari Materi</label>
                <input type="search" class="form-search" placeholder="Ketik kata kunci...">
            </div>

            <!-- Date -->
            <div class="form-group">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-date">
            </div>

            <!-- File Upload -->
            <div class="form-group">
                <label class="form-label">Upload Foto</label>
                <input type="file" class="form-file-input" accept="image/*">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                Submit Test
            </button>
        </form>
    </div>
</div>

<?php include(APPPATH . 'views/templates/footer.php'); ?>
