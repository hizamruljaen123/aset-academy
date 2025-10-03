<!-- KELAS DETAIL – LAYOUT PROFESIONAL ala Udemy
Author: ChatGPT x Hizam
Notes:
- Gunakan TailwindCSS + Font Awesome. 
- Struktur: header → grid 3/1 (konten utama + sidebar sticky) → tabs (Kurikulum/Deskripsi/Ulasan) → Instruktor → Jadwal → Materi → (Admin Only) Statistik & Progress.
- Seluruh variabel PHP mengikuti struktur di kode lama ($kelas, $is_enrolled, $is_admin, $teachers, $jadwal, $materi, $attendance_stats, $student_progress).
- Simpan file ini sebagai view pengganti, lalu pastikan kelas_detail.css & kelas_detail.js tetap dipanggil jika perlu.
-->

<div class="p-4 md:p-6 lg:p-8">
  <!-- Breadcrumbs -->
  <nav aria-label="Breadcrumb" class="mb-4 text-sm text-gray-500">
    <ol class="flex items-center gap-2">
      <li><a href="<?= site_url('/') ?>" class="hover:text-gray-800">Home</a></li>
      <li class="text-gray-400">/</li>
      <li><a href="<?= site_url('kelas') ?>" class="hover:text-gray-800">Kelas</a></li>
      <li class="text-gray-400">/</li>
      <li class="font-semibold text-gray-700 truncate max-w-[50vw]"><?= $kelas->nama_kelas ?></li>
    </ol>
  </nav>

  <!-- Header / Hero simple & fokus konten -->
  <header class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 md:p-8 mb-6">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
      <div class="flex items-start gap-4">
        <div class="rounded-xl bg-gray-100 p-4 shrink-0">
          <i class="fas fa-code text-2xl text-indigo-600"></i>
        </div>
        <div>
          <div class="flex items-center gap-2 flex-wrap">
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800 border border-yellow-200">
              <?= $kelas->bahasa_program ?>
            </span>
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700 border border-gray-200">
              Level: <span class="ml-1 font-semibold"><?= $kelas->level ?></span>
            </span>
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700 border border-gray-200">
              Durasi: <span class="ml-1 font-semibold"><?= $kelas->durasi ?> jam</span>
            </span>
          </div>
          <h1 class="mt-2 text-2xl md:text-3xl font-bold leading-tight text-gray-900">
            <?= $kelas->nama_kelas ?>
          </h1>
          <p class="mt-2 text-gray-600 max-w-3xl">
            <?= $kelas->deskripsi ?>
          </p>
        </div>
      </div>

      <!-- CTA utama -->
      <div class="flex flex-wrap gap-3">
        <?php if ($is_enrolled): ?>
          <?php if (!empty($kelas->online_meet_link)): ?>
            <a href="<?= $kelas->online_meet_link ?>" target="_blank" class="inline-flex items-center justify-center px-4 py-2 text-white bg-green-600 hover:bg-green-700 rounded-lg font-semibold shadow focus:outline-none focus:ring-2 focus:ring-green-500">
              <i class="fas fa-video mr-2"></i> Join Meeting
            </a>
          <?php else: ?>
            <a href="<?= site_url('student/premium_learn/' . $kelas->id) ?>" class="inline-flex items-center justify-center px-4 py-2 text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg font-semibold shadow focus:outline-none focus:ring-2 focus:ring-indigo-500">
              <i class="fas fa-book-open mr-2"></i> Lanjutkan Belajar
            </a>
          <?php endif; ?>
        <?php else: ?>
          <a href="<?= site_url('payment/initiate/' . $kelas->id) ?>" class="inline-flex items-center justify-center px-4 py-2 text-white bg-purple-600 hover:bg-purple-700 rounded-lg font-semibold shadow focus:outline-none focus:ring-2 focus:ring-purple-500">
            <i class="fas fa-shopping-cart mr-2"></i> Pesan Kelas
          </a>
        <?php endif; ?>
        <a href="<?= site_url('kelas') ?>" class="inline-flex items-center justify-center px-4 py-2 bg-white text-gray-700 hover:bg-gray-50 rounded-lg font-medium border border-gray-200">
          <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
      </div>
    </div>
  </header>

  <!-- GRID: Konten Utama & Sidebar -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- MAIN -->
    <main class="lg:col-span-2 space-y-6">
      <!-- Tabs ala Udemy: Kurikulum | Deskripsi | Info -->
      <div class="bg-white rounded-2xl border border-gray-200 shadow-sm">
        <div class="border-b border-gray-200">
          <div class="flex gap-1 p-2 overflow-x-auto">
            <button data-tab="kurikulum" class="tab-btn px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 active">
              Kurikulum
            </button>
            <button data-tab="deskripsi" class="tab-btn px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50">
              Deskripsi
            </button>
            <button data-tab="info" class="tab-btn px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50">
              Informasi
            </button>
          </div>
        </div>

        <section id="tab-kurikulum" class="p-6 space-y-4">
          <?php if (!empty($materi)): ?>
            <!-- Accordion Kurikulum -->
            <?php foreach ($materi as $mIndex => $item): ?>
              <details class="group border border-gray-200 rounded-xl overflow-hidden">
                <summary class="flex items-center justify-between cursor-pointer select-none px-4 py-3 bg-gray-50 hover:bg-gray-100">
                  <div class="flex items-center gap-3">
                    <i class="fas fa-folder text-gray-500"></i>
                    <h3 class="font-semibold text-gray-800"><?= $item['judul'] ?></h3>
                  </div>
                  <div class="flex items-center gap-3 text-sm text-gray-500">
                    <span><?= count($item['parts']) ?> bagian</span>
                    <i class="fas fa-chevron-down group-open:rotate-180 transition-transform"></i>
                  </div>
                </summary>
                <div class="bg-white divide-y divide-gray-100">
                  <?php foreach (($item['parts'] ?? []) as $pIndex => $part): ?>
                    <div class="flex items-center justify-between px-4 py-3 hover:bg-gray-50">
                      <div class="flex items-center gap-3">
                        <i class="fas fa-play-circle text-indigo-500"></i>
                        <div>
                          <p class="font-medium text-gray-800 leading-tight"><?= $part['judul'] ?? ('Part ' . ($pIndex+1)) ?></p>
                          <?php if (!empty($part['deskripsi'])): ?>
                            <p class="text-xs text-gray-500 line-clamp-1"><?= $part['deskripsi'] ?></p>
                          <?php endif; ?>
                        </div>
                      </div>
                      <div class="flex items-center gap-2">
                        <?php if ($is_enrolled): ?>
                          <a href="<?= site_url('materi/part/' . ($part['id'] ?? 0)) ?>" class="text-indigo-600 hover:underline text-sm">Lihat</a>
                        <?php else: ?>
                          <span class="text-xs text-gray-400">Terkunci</span>
                        <?php endif; ?>
                      </div>
                    </div>
                  <?php endforeach; ?>
                  <?php if ($is_admin): ?>
                    <div class="px-4 py-3 bg-gray-50">
                      <a href="<?= site_url('materi/detail/' . $item['id']) ?>" class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-700">
                        <i class="fas fa-cog mr-2"></i> Kelola Materi
                      </a>
                    </div>
                  <?php endif; ?>
                </div>
              </details>
            <?php endforeach; ?>
          <?php else: ?>
            <div class="text-center py-10">
              <i class="fas fa-book-open text-3xl text-gray-400"></i>
              <p class="mt-2 text-gray-600">Belum ada materi.</p>
              <?php if ($is_admin): ?>
                <a href="<?= site_url('materi/create/' . $kelas->id) ?>" class="mt-3 inline-flex items-center px-4 py-2 rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 font-semibold">
                  <i class="fas fa-plus mr-2"></i> Buat Materi Pertama
                </a>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </section>

        <section id="tab-deskripsi" class="p-6 hidden">
          <article class="prose prose-indigo max-w-none">
            <h3>Ringkasan</h3>
            <p><?= nl2br(htmlentities($kelas->deskripsi)) ?></p>
            <h3>Apa yang akan Anda pelajari</h3>
            <ul>
              <li>Konsep inti sesuai silabus kelas.</li>
              <li>Praktik langsung dengan studi kasus.</li>
              <li>Tips & best‑practice industri.</li>
              <li>Persiapan portofolio/proyek akhir.</li>
            </ul>
            <h3>Persyaratan</h3>
            <ul>
              <li>Komputer/laptop & koneksi internet stabil.</li>
              <li>Pengetahuan dasar sesuai level kelas.</li>
            </ul>
          </article>
        </section>

        <section id="tab-info" class="p-6 hidden">
          <div class="grid sm:grid-cols-2 gap-4">
            <div class="border border-gray-200 rounded-xl p-4">
              <div class="text-sm text-gray-500">Harga</div>
              <div class="text-lg font-bold">Rp <?= number_format($kelas->harga, 0, ',', '.') ?></div>
            </div>
            <div class="border border-gray-200 rounded-xl p-4">
              <div class="text-sm text-gray-500">Status</div>
              <div class="text-lg font-semibold text-gray-800"><?= $kelas->status ?></div>
            </div>
            <div class="border border-gray-200 rounded-xl p-4">
              <div class="text-sm text-gray-500">Bahasa Program</div>
              <div class="text-lg font-semibold text-gray-800"><?= $kelas->bahasa_program ?></div>
            </div>
            <div class="border border-gray-200 rounded-xl p-4">
              <div class="text-sm text-gray-500">Link Meeting</div>
              <div class="text-sm text-gray-700 truncate"><?= !empty($kelas->online_meet_link) ? $kelas->online_meet_link : 'Tidak ada' ?></div>
            </div>
          </div>
        </section>
      </div>

      <!-- Instruktor (tampil untuk enrolled/admin) -->
      <?php if ($is_enrolled || $is_admin): ?>
      <section class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
        <div class="flex items-center gap-3 mb-4">
          <i class="fas fa-chalkboard-teacher text-indigo-600"></i>
          <h2 class="text-xl font-bold text-gray-900">Instruktor</h2>
        </div>
        <?php if (!empty($teachers)): ?>
          <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($teachers as $teacher): ?>
              <div class="border border-gray-200 rounded-xl p-4">
                <div class="flex items-center gap-3">
                  <img src="<?= base_url('uploads/profiles/' . ($teacher->foto_profil ?? 'default.jpg')) ?>" alt="<?= $teacher->nama_lengkap ?>" class="w-14 h-14 rounded-full object-cover">
                  <div>
                    <div class="font-semibold text-gray-900"><?= $teacher->nama_lengkap ?></div>
                    <div class="text-xs text-gray-500">Guru <?= $kelas->bahasa_program ?></div>
                  </div>
                </div>
                <div class="mt-3 text-sm text-gray-600">
                  <i class="fas fa-envelope mr-1 text-gray-400"></i> <?= $teacher->email ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <p class="text-gray-600">Belum ada guru ditugaskan.</p>
        <?php endif; ?>
      </section>
      <?php endif; ?>

      <!-- Jadwal (enrolled/admin) -->
      <?php if ($is_enrolled || $is_admin): ?>
      <section class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
        <div class="flex items-center gap-3 mb-4">
          <i class="fas fa-calendar-alt text-indigo-600"></i>
          <h2 class="text-xl font-bold text-gray-900">Jadwal Kelas</h2>
        </div>
        <?php if (!empty($jadwal)): ?>
          <ul class="space-y-3">
            <?php foreach ($jadwal as $j): ?>
              <li class="border border-gray-200 rounded-xl p-4">
                <div class="font-semibold text-gray-900">Pertemuan <?= $j['pertemuan_ke'] ?>: <?= $j['judul_pertemuan'] ?></div>
                <div class="text-sm text-gray-600 mt-1">
                  <?= date('d M Y', strtotime($j['tanggal_pertemuan'])) ?> | <?= date('H:i', strtotime($j['waktu_mulai'])) ?> - <?= date('H:i', strtotime($j['waktu_selesai'])) ?>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php else: ?>
          <p class="text-gray-600">Belum ada jadwal untuk kelas ini.</p>
        <?php endif; ?>
      </section>
      <?php endif; ?>

      <!-- (Admin Only) Statistik & Progress -->
      <?php if ($is_admin): ?>
      <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
          <div class="flex items-center gap-3 mb-4">
            <i class="fas fa-chart-pie text-indigo-600"></i>
            <h2 class="text-xl font-bold text-gray-900">Statistik Absensi</h2>
          </div>
          <div class="h-64"><canvas id="attendanceChart"></canvas></div>
          <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-4">
            <div class="text-center border border-gray-200 rounded-xl p-3">
              <div class="text-2xl font-bold"><?= $attendance_stats['Hadir'] ?? 0 ?></div>
              <div class="text-xs text-gray-500">Hadir</div>
            </div>
            <div class="text-center border border-gray-200 rounded-xl p-3">
              <div class="text-2xl font-bold"><?= $attendance_stats['Sakit'] ?? 0 ?></div>
              <div class="text-xs text-gray-500">Sakit</div>
            </div>
            <div class="text-center border border-gray-200 rounded-xl p-3">
              <div class="text-2xl font-bold"><?= $attendance_stats['Izin'] ?? 0 ?></div>
              <div class="text-xs text-gray-500">Izin</div>
            </div>
            <div class="text-center border border-gray-200 rounded-xl p-3">
              <div class="text-2xl font-bold"><?= $attendance_stats['Alpa'] ?? 0 ?></div>
              <div class="text-xs text-gray-500">Alpa</div>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
          <div class="flex items-center gap-3 mb-4">
            <i class="fas fa-users text-indigo-600"></i>
            <h2 class="text-xl font-bold text-gray-900">Progress Siswa</h2>
          </div>
          <?php if (!empty($student_progress)): ?>
            <div class="space-y-4">
              <?php foreach ($student_progress as $student): ?>
                <?php $pct = ($student['total_materi']>0) ? round(($student['completed_materi']/$student['total_materi'])*100) : 0; ?>
                <div class="border border-gray-200 rounded-xl p-4">
                  <div class="flex items-center justify-between">
                    <div>
                      <div class="font-semibold text-gray-900"><?= $student['nama_lengkap'] ?></div>
                      <div class="text-xs text-gray-500">NIS: <?= $student['nis'] ?></div>
                    </div>
                    <div class="text-right">
                      <div class="text-xl font-bold text-gray-900"><?= $pct ?>%</div>
                      <div class="text-xs text-gray-500">Progress</div>
                    </div>
                  </div>
                  <div class="mt-2 text-xs text-gray-600">Materi selesai: <?= $student['completed_materi'] ?>/<?= $student['total_materi'] ?></div>
                  <div class="mt-2 w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                    <div class="bg-indigo-600 h-2 rounded-full" style="width: <?= $pct ?>%"></div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <p class="text-gray-600">Belum ada data progress.</p>
          <?php endif; ?>
        </div>
      </section>
      <?php endif; ?>
    </main>

    <!-- SIDEBAR STICKY ala Udemy -->
    <aside class="lg:col-span-1">
      <div class="lg:sticky lg:top-6 space-y-4">
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
          <!-- Preview cover / thumbnail (opsional) -->
          <div class="aspect-video bg-gray-100 flex items-center justify-center">
            <i class="fas fa-photo-video text-3xl text-gray-400"></i>
          </div>
          <div class="p-5">
            <div class="flex items-baseline gap-2">
              <div class="text-2xl font-bold text-gray-900">Rp <?= number_format($kelas->harga, 0, ',', '.') ?></div>
              <div class="text-xs text-gray-500 line-through"></div>
            </div>
            <div class="mt-3 space-y-2">
              <?php if ($is_enrolled): ?>
                <a href="<?= site_url('student/premium_learn/' . $kelas->id) ?>" class="w-full inline-flex items-center justify-center px-4 py-2 text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg font-semibold shadow">
                  <i class="fas fa-book-open mr-2"></i> Lanjutkan Belajar
                </a>
              <?php else: ?>
                <a href="<?= site_url('payment/initiate/' . $kelas->id) ?>" class="w-full inline-flex items-center justify-center px-4 py-2 text-white bg-purple-600 hover:bg-purple-700 rounded-lg font-semibold shadow">
                  <i class="fas fa-shopping-cart mr-2"></i> Beli Sekarang
                </a>
                <a href="<?= site_url('kelas/checkout/' . $kelas->id) ?>" class="w-full inline-flex items-center justify-center px-4 py-2 bg-white text-gray-700 hover:bg-gray-50 rounded-lg font-medium border border-gray-200">
                  <i class="fas fa-credit-card mr-2"></i> Tambah ke Keranjang
                </a>
              <?php endif; ?>
            </div>
            <ul class="mt-4 space-y-2 text-sm text-gray-700">
              <li class="flex items-center gap-2"><i class="far fa-play-circle text-gray-400"></i> Video on‑demand</li>
              <li class="flex items-center gap-2"><i class="far fa-file-alt text-gray-400"></i> Materi & lampiran</li>
              <li class="flex items-center gap-2"><i class="far fa-infinity text-gray-400"></i> Akses selamanya</li>
              <li class="flex items-center gap-2"><i class="far fa-certificate text-gray-400"></i> Sertifikat kelulusan</li>
            </ul>
          </div>
        </div>

        <!-- Kotak info ringkas -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
          <h3 class="font-semibold text-gray-900 mb-3">Info singkat</h3>
          <dl class="text-sm text-gray-700 space-y-2">
            <div class="flex justify-between"><dt>Level</dt><dd class="font-medium"><?= $kelas->level ?></dd></div>
            <div class="flex justify-between"><dt>Durasi</dt><dd class="font-medium"><?= $kelas->durasi ?> jam</dd></div>
            <div class="flex justify-between"><dt>Bahasa</dt><dd class="font-medium"><?= $kelas->bahasa_program ?></dd></div>
            <div class="flex justify-between"><dt>Status</dt><dd class="font-medium"><?= $kelas->status ?></dd></div>
          </dl>
        </div>
      </div>
    </aside>
  </div>
</div>

<!-- Modal Parts (reusable) -->
<div id="parts-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
  <div class="fixed inset-0 bg-black/60" onclick="closeModal()"></div>
  <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-lg max-h-[90vh] overflow-auto z-10">
    <div class="p-5 border-b border-gray-200 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <i class="fas fa-list-ul text-indigo-600"></i>
        <h3 id="modal-title" class="text-lg font-bold text-gray-900"></h3>
      </div>
      <button onclick="closeModal()" class="p-2 rounded-lg hover:bg-gray-100"><i class="fas fa-times"></i></button>
    </div>
    <div id="modal-body" class="p-5"></div>
  </div>
</div>

<link rel="stylesheet" href="<?= base_url('assets/css/kelas_detail.css') ?>">
<script src="<?= base_url('assets/js/kelas_detail.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0"></script>

<script>
// Tabs sederhana
const tabBtns = document.querySelectorAll('.tab-btn');
const panels = {
  kurikulum: document.getElementById('tab-kurikulum'),
  deskripsi: document.getElementById('tab-deskripsi'),
  info: document.getElementById('tab-info')
};

function activateTab(name){
  tabBtns.forEach(b=>{
    const on = b.dataset.tab===name;
    b.classList.toggle('bg-gray-100', on);
    b.classList.toggle('active', on);
  });
  Object.entries(panels).forEach(([k,el])=>{
    if(!el) return; el.classList.toggle('hidden', k!==name);
  });
}

tabBtns.forEach(b=> b.addEventListener('click', ()=> activateTab(b.dataset.tab)));
activateTab('kurikulum');

// Modal parts (kompatibel dengan fungsi lama)
function viewParts(parts, title){
  const modal = document.getElementById('parts-modal');
  const body = document.getElementById('modal-body');
  const ttl  = document.getElementById('modal-title');
  ttl.textContent = title || 'Parts';
  body.innerHTML = '';
  if(Array.isArray(parts) && parts.length){
    const list = document.createElement('div');
    list.className = 'space-y-3';
    parts.forEach((p,idx)=>{
      const row = document.createElement('div');
      row.className = 'border border-gray-200 rounded-xl p-3 flex items-center justify-between';
      row.innerHTML = `
        <div>
          <div class="font-medium text-gray-900">${p.judul || ('Part '+(idx+1))}</div>
          ${p.deskripsi ? `<div class=\"text-xs text-gray-500\">${p.deskripsi}</div>`:''}
        </div>
        ${<?= json_encode($is_enrolled) ?> ? `<a class=\"text-indigo-600 text-sm hover:underline\" href=\"<?= site_url('materi/part/') ?>${p.id || 0}\">Buka</a>` : '<span class="text-xs text-gray-400">Terkunci</span>'}
      `;
      list.appendChild(row);
    });
    body.appendChild(list);
  } else {
    body.innerHTML = '<p class="text-gray-600">Belum ada parts.</p>';
  }
  modal.classList.remove('hidden');
  modal.classList.add('flex');
}

function closeModal(){
  const modal = document.getElementById('parts-modal');
  modal.classList.add('hidden');
  modal.classList.remove('flex');
}

// ChartJS (admin only)
<?php if ($is_admin): ?>
  const ctx = document.getElementById('attendanceChart');
  if (ctx){
    const data = {
      labels: ['Hadir','Sakit','Izin','Alpa'],
      datasets: [{
        label: 'Absensi',
        data: [<?= (int)($attendance_stats['Hadir'] ?? 0) ?>, <?= (int)($attendance_stats['Sakit'] ?? 0) ?>, <?= (int)($attendance_stats['Izin'] ?? 0) ?>, <?= (int)($attendance_stats['Alpa'] ?? 0) ?>],
      }]
    };
    new Chart(ctx, {type:'doughnut', data});
  }
<?php endif; ?>
</script>