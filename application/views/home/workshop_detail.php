<?php $this->load->view('home/templates/_header'); ?>
<?php $this->load->view('home/templates/_navbar'); ?>

    <!-- Workshop Detail Hero Section -->
    <section class="pt-20 pb-16 bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-700 relative overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-purple-400/20 rounded-full pulse-blob"></div>
            <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-blue-400/20 rounded-full pulse-blob" style="animation-delay: 2s;"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
                <div class="lg:w-1/2" data-aos="fade-right" data-aos-duration="1000">
                    <div class="flex items-center mb-4">
                        <span class="bg-white/20 text-white px-4 py-2 rounded-full text-sm font-semibold backdrop-blur-sm">
                            <?= $workshop->type == 'workshop' ? 'Workshop' : 'Seminar' ?>
                        </span>
                        <?php if ($workshop->price > 0): ?>
                            <span class="bg-yellow-500 text-yellow-900 px-4 py-2 rounded-full text-sm font-bold ml-2">
                                Rp <?= number_format($workshop->price, 0, ',', '.') ?>
                            </span>
                        <?php else: ?>
                            <span class="bg-green-500 text-white px-4 py-2 rounded-full text-sm font-bold ml-2">
                                Gratis
                            </span>
                        <?php endif; ?>
                    </div>

                    <h1 class="text-3xl md:text-4xl font-bold text-white leading-tight mb-4">
                        <?= html_escape($workshop->title) ?>
                    </h1>

                    <div class="flex flex-wrap items-center gap-4 mb-6 text-white/90">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            <span><?= date('d F Y', strtotime($workshop->start_datetime)) ?></span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock mr-2"></i>
                            <span>
                                <?= date('H:i', strtotime($workshop->start_datetime)) ?> -
                                <?= date('H:i', strtotime($workshop->end_datetime)) ?>
                            </span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span><?= html_escape($workshop->location) ?></span>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <?php if ($is_registered): ?>
                            <div class="bg-green-500 text-white px-6 py-3 rounded-lg font-semibold">
                                <i class="fas fa-check-circle mr-2"></i>
                                Sudah Terdaftar
                            </div>
                        <?php elseif ($this->session->userdata('user_id')): ?>
                            <?php if ($max_participants == 0 || $participant_count < $max_participants): ?>
                                <a href="<?= workshop_register_url($workshop->id) ?>"
                                   class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition-colors font-semibold">
                                    <i class="fas fa-user-plus mr-2"></i>
                                    Daftar Sekarang
                                </a>
                            <?php else: ?>
                                <div class="bg-gray-500 text-white px-6 py-3 rounded-lg font-semibold cursor-not-allowed">
                                    <i class="fas fa-users mr-2"></i>
                                    Kuota Penuh
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="flex items-center gap-3">
                                <a href="<?= site_url('auth/login?redirect=' . urlencode(workshop_detail_url($workshop->id))) ?>"
                                   class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition-colors font-semibold inline-flex items-center">
                                    <i class="fas fa-sign-in-alt mr-2"></i>
                                    Login & Daftar sebagai Member
                                </a>

                                <button type="button" onclick="openGuestModal()"
                                        class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold inline-flex items-center">
                                    <i class="fas fa-user-plus mr-2"></i>
                                    Daftar sebagai Tamu
                                </button>
                            </div>
                        <?php endif; ?>

                        <div class="flex items-center text-white/90">
                            <i class="fas fa-users mr-2"></i>
                            <span>
                                <?php if ($max_participants > 0): ?>
                                    <?= $participant_count ?>/<?= $max_participants ?> Peserta
                                <?php else: ?>
                                    <?= $participant_count ?> Peserta
                                <?php endif; ?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="lg:w-1/2 flex justify-center" data-aos="fade-left" data-aos-duration="1000">
                    <div class="relative">
                        <?php if ($workshop->thumbnail): ?>
                            <img src="<?= base_url($workshop->thumbnail) ?>" alt="<?= html_escape($workshop->title) ?>"
                                 class="w-full max-w-md rounded-xl shadow-2xl">
                        <?php else: ?>
                            <div class="w-full max-w-md h-64 bg-gray-200 rounded-xl shadow-2xl flex items-center justify-center">
                                <i class="fas fa-chalkboard-teacher text-gray-400 text-6xl"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Workshop Details Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <div class="bg-gray-50 rounded-xl p-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Deskripsi</h2>

                        <!-- Thumbnail Image -->
                        <?php if ($workshop->thumbnail): ?>
                        <div class="mb-6">
                            <img src="<?= base_url($workshop->thumbnail) ?>" alt="<?= html_escape($workshop->title) ?>"
                                 class="w-full max-w-md mx-auto rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                        </div>
                        <?php endif; ?>

                        <div class="prose max-w-none text-gray-700">
                            <?= nl2br(html_escape($workshop->description)) ?>
                        </div>
                    </div>

                    <!-- Materials Section -->
                    <?php if (!empty($materials)): ?>
                    <div class="bg-gray-50 rounded-xl p-8 mt-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Materi Yang Akan Dipelajari</h2>
                        <div class="space-y-4">
                            <?php foreach ($materials as $material): ?>
                            <div class="flex items-center p-4 bg-white rounded-lg shadow-sm">
                                <div class="flex-shrink-0">
                                    <?php if ($material->file_type == 'pdf'): ?>
                                        <i class="fas fa-file-pdf text-red-500 text-xl"></i>
                                    <?php elseif ($material->file_type == 'video'): ?>
                                        <i class="fas fa-video text-blue-500 text-xl"></i>
                                    <?php elseif ($material->file_type == 'link'): ?>
                                        <i class="fas fa-link text-green-500 text-xl"></i>
                                    <?php else: ?>
                                        <i class="fas fa-file text-gray-500 text-xl"></i>
                                    <?php endif; ?>
                                </div>
                                <div class="ml-4 flex-1">
                                    <h3 class="font-semibold text-gray-800"><?= html_escape($material->title) ?></h3>
                                    <?php if ($material->description): ?>
                                        <p class="text-sm text-gray-600 mt-1"><?= html_escape($material->description) ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Workshop Info Card -->
                    <div class="bg-gray-50 rounded-xl p-6 mb-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Informasi Workshop</h3>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <i class="fas fa-calendar-alt text-blue-500 w-5"></i>
                                <span class="ml-3 text-sm text-gray-700">
                                    <?= date('d F Y', strtotime($workshop->start_datetime)) ?>
                                </span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-clock text-blue-500 w-5"></i>
                                <span class="ml-3 text-sm text-gray-700">
                                    <?= date('H:i', strtotime($workshop->start_datetime)) ?> -
                                    <?= date('H:i', strtotime($workshop->end_datetime)) ?>
                                </span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-map-marker-alt text-blue-500 w-5"></i>
                                <span class="ml-3 text-sm text-gray-700">
                                    <?= html_escape($workshop->location) ?>
                                </span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-users text-blue-500 w-5"></i>
                                <span class="ml-3 text-sm text-gray-700">
                                    <?php if ($max_participants > 0): ?>
                                        <?= $participant_count ?>/<?= $max_participants ?> Peserta
                                    <?php else: ?>
                                        <?= $participant_count ?> Peserta
                                    <?php endif; ?>
                                </span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-tag text-blue-500 w-5"></i>
                                <span class="ml-3 text-sm text-gray-700">
                                    <?php if ($workshop->price > 0): ?>
                                        Rp <?= number_format($workshop->price, 0, ',', '.') ?>
                                    <?php else: ?>
                                        Gratis
                                    <?php endif; ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Registration Card -->
                    <div class="bg-blue-50 rounded-xl p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Pendaftaran</h3>
                        <?php if ($is_registered): ?>
                            <div class="text-center">
                                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-check-circle text-green-500 text-2xl"></i>
                                </div>
                                <p class="text-green-700 font-semibold">Anda sudah terdaftar!</p>
                                <p class="text-sm text-gray-600 mt-2">
                                    Simpan tanggal workshop ini di kalender Anda
                                </p>
                            </div>
                        <?php elseif ($this->session->userdata('user_id')): ?>
                            <?php if ($max_participants == 0 || $participant_count < $max_participants): ?>
                                <div class="text-center">
                                    <a href="<?= workshop_register_url($workshop->id) ?>"
                                       class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold inline-block">
                                        <i class="fas fa-user-plus mr-2"></i>
                                        Daftar Sekarang
                                    </a>
                                    <p class="text-sm text-gray-600 mt-3">
                                        Kuota tersedia: <?php if ($max_participants > 0) echo $max_participants - $participant_count; else echo 'Unlimited'; ?>
                                    </p>
                                </div>
                            <?php else: ?>
                                <div class="text-center">
                                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i class="fas fa-users text-red-500 text-2xl"></i>
                                    </div>
                                    <p class="text-red-700 font-semibold">Kuota Penuh</p>
                                    <p class="text-sm text-gray-600 mt-2">
                                        Maaf, workshop ini sudah mencapai batas maksimal peserta
                                    </p>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="text-center space-y-3">
                                <!-- Register as Member Button -->
                                <a href="<?= site_url('auth/login?redirect=' . urlencode(workshop_detail_url($workshop->id))) ?>"
                                   class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold inline-block">
                                    <i class="fas fa-sign-in-alt mr-2"></i>
                                    Login & Daftar sebagai Member
                                </a>

                                <!-- Register as Guest Button -->
                                <button onclick="openGuestModal()"
                                        class="w-full bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors font-semibold inline-block">
                                    <i class="fas fa-user-plus mr-2"></i>
                                    Daftar sebagai Tamu
                                </button>

                                <p class="text-sm text-gray-600">
                                    Daftar sebagai tamu tanpa perlu login
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Workshops Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Workshop & Seminar Lainnya</h2>
                <p class="text-xl text-gray-600">Jelajahi workshop dan seminar menarik lainnya</p>
            </div>

            <div class="text-center">
                <a href="<?= site_url('workshops') ?>" class="bg-blue-600 text-white px-8 py-4 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                    Lihat Semua Workshop & Seminar
                </a>
            </div>
        </div>
    </section>

    <!-- Guest Registration Modal -->
    <div id="guestModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <!-- Modal Header -->
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold text-gray-900">Daftar sebagai Tamu</h3>
                    <button onclick="closeGuestModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="mb-6">
                    <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-info-circle text-blue-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-blue-700">
                                    Daftar sebagai tamu untuk workshop <strong>"<?= html_escape($workshop->title) ?>"</strong>.
                                    Isi form di bawah ini dengan data yang benar.
                                </p>
                            </div>
                        </div>
                    </div>

                    <form id="guestForm" action="<?= workshop_register_guest_url($workshop->id) ?>" method="POST">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Lengkap -->
                            <div>
                                <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="nama_lengkap" name="nama_lengkap"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="Masukkan nama lengkap Anda" required>
                            </div>

                            <!-- Asal Kampus/Sekolah -->
                            <div>
                                <label for="asal_kampus_sekolah" class="block text-sm font-medium text-gray-700 mb-2">
                                    Asal Kampus/Sekolah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="asal_kampus_sekolah" name="asal_kampus_sekolah"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="Contoh: Universitas Indonesia" required>
                            </div>

                            <!-- Provinsi -->
                            <div>
                                <label for="province_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Provinsi
                                </label>
                                <select id="province_id" name="province_id"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Provinsi</option>
                                    <!-- Will be populated by JavaScript -->
                                </select>
                            </div>

                            <!-- Kabupaten/Kota -->
                            <div>
                                <label for="regency_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Kabupaten/Kota
                                </label>
                                <select id="regency_id" name="regency_id"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" disabled>
                                    <option value="">Pilih Kabupaten/Kota</option>
                                    <!-- Will be populated by JavaScript -->
                                </select>
                            </div>

                            <!-- Kecamatan -->
                            <div>
                                <label for="district_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Kecamatan
                                </label>
                                <select id="district_id" name="district_id"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" disabled>
                                    <option value="">Pilih Kecamatan</option>
                                    <!-- Will be populated by JavaScript -->
                                </select>
                            </div>

                            <!-- Usia -->
                            <div>
                                <label for="usia" class="block text-sm font-medium text-gray-700 mb-2">
                                    Usia <span class="text-red-500">*</span>
                                </label>
                                <input type="number" id="usia" name="usia" min="10" max="99"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="20" required>
                            </div>

                            <!-- Pekerjaan -->
                            <div>
                                <label for="pekerjaan" class="block text-sm font-medium text-gray-700 mb-2">
                                    Pekerjaan <span class="text-red-500">*</span>
                                </label>
                                <select id="pekerjaan" name="pekerjaan"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="">Pilih Pekerjaan</option>
                                    <option value="Pelajar">Pelajar</option>
                                    <option value="Mahasiswa">Mahasiswa</option>
                                    <option value="Karyawan">Karyawan</option>
                                    <option value="Wirausaha">Wirausaha</option>
                                    <option value="PNS">PNS</option>
                                    <option value="Guru/Dosen">Guru/Dosen</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>

                            <!-- No. WhatsApp/Telegram -->
                            <div class="md:col-span-2">
                                <label for="no_wa_telegram" class="block text-sm font-medium text-gray-700 mb-2">
                                    No. WhatsApp/Telegram <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="no_wa_telegram" name="no_wa_telegram"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="081234567890" required>
                                <p class="text-sm text-gray-500 mt-1">
                                    Masukkan nomor WhatsApp atau Telegram untuk komunikasi dan informasi workshop
                                </p>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="flex justify-end space-x-4 mt-8">
                            <button type="button" onclick="closeGuestModal()"
                                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors">
                                Batal
                            </button>
                            <button type="submit"
                                    class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                <i class="fas fa-user-plus mr-2"></i>
                                Daftar Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openGuestModal() {
            document.getElementById('guestModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            loadProvinces();
        }

        function closeGuestModal() {
            document.getElementById('guestModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        document.getElementById('guestModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeGuestModal();
            }
        });

        // Handle form validation
        document.getElementById('guestForm').addEventListener('submit', function(e) {
            const namaLengkap = document.getElementById('nama_lengkap').value.trim();
            const asalKampus = document.getElementById('asal_kampus_sekolah').value.trim();
            const usia = document.getElementById('usia').value;
            const pekerjaan = document.getElementById('pekerjaan').value;
            const noWa = document.getElementById('no_wa_telegram').value.trim();

            if (!namaLengkap || !asalKampus || !usia || !pekerjaan || !noWa) {
                e.preventDefault();
                alert('Mohon lengkapi semua field yang wajib diisi.');
                return false;
            }

            if (usia < 10 || usia > 99) {
                e.preventDefault();
                alert('Usia harus antara 10-99 tahun.');
                return false;
            }
        });

        // Load provinces on modal open
        function loadProvinces() {
            fetch('<?= site_url('workshops/get_provinces') ?>')
                .then(response => response.json())
                .then(data => {
                    const provinceSelect = document.getElementById('province_id');
                    provinceSelect.innerHTML = '<option value="">Pilih Provinsi</option>';
                    data.forEach(province => {
                        provinceSelect.innerHTML += `<option value="${province.id}">${province.name}</option>`;
                    });
                })
                .catch(error => console.error('Error loading provinces:', error));
        }

        // Load regencies based on selected province
        document.getElementById('province_id').addEventListener('change', function() {
            const provinceId = this.value;
            const regencySelect = document.getElementById('regency_id');
            const districtSelect = document.getElementById('district_id');

            if (provinceId) {
                fetch('<?= site_url('workshops/get_regencies') ?>/' + provinceId)
                    .then(response => response.json())
                    .then(data => {
                        regencySelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
                        data.forEach(regency => {
                            regencySelect.innerHTML += `<option value="${regency.id}">${regency.name}</option>`;
                        });
                        regencySelect.disabled = false;
                        districtSelect.disabled = true;
                        districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                    })
                    .catch(error => console.error('Error loading regencies:', error));
            } else {
                regencySelect.disabled = true;
                districtSelect.disabled = true;
                regencySelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
                districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            }
        });

        // Load districts based on selected regency
        document.getElementById('regency_id').addEventListener('change', function() {
            const regencyId = this.value;
            const districtSelect = document.getElementById('district_id');

            if (regencyId) {
                fetch('<?= site_url('workshops/get_districts') ?>/' + regencyId)
                    .then(response => response.json())
                    .then(data => {
                        districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                        data.forEach(district => {
                            districtSelect.innerHTML += `<option value="${district.id}">${district.name}</option>`;
                        });
                        districtSelect.disabled = false;
                    })
                    .catch(error => console.error('Error loading districts:', error));
            } else {
                districtSelect.disabled = true;
                districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            }
        });

        // Load provinces when modal opens
        document.getElementById('guestModal').addEventListener('show', loadProvinces);

        // Auto-scroll to form if there's an error
        <?php if ($this->session->flashdata('error')): ?>
            document.addEventListener('DOMContentLoaded', function() {
                if (window.location.hash === '#guest-registration') {
                    openGuestModal();
                    loadProvinces();
                }
            });
        <?php endif; ?>
    </script>

<?php $this->load->view('home/templates/_footer'); ?>
