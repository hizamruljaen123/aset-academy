<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="p-4 sm:p-6 lg:p-8">
  <!-- Breadcrumbs -->
  <nav aria-label="Breadcrumb" class="mb-6 text-sm text-gray-500">
    <ol class="flex items-center gap-2">
      <li><a href="<?= site_url('admin/dashboard') ?>" class="hover:text-gray-800">Dashboard</a></li>
      <li class="text-gray-400">/</li>
      <li><a href="<?= site_url('admin/free_classes') ?>" class="hover:text-gray-800">Kelas Gratis</a></li>
      <li class="text-gray-400">/</li>
      <li class="font-semibold text-gray-700 truncate max-w-[50vw]"><?= $free_class->title ?></li>
    </ol>
  </nav>

  <!-- Header / Hero -->
  <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 md:p-8 mb-6">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
      <div class="flex items-start gap-4">
        <div class="relative w-20 h-20 rounded-xl bg-gray-100 overflow-hidden flex-shrink-0">
          <?php if (!empty($free_class->thumbnail)): ?>
            <img src="<?= base_url($free_class->thumbnail) ?>" alt="<?= $free_class->title ?>" class="w-full h-full object-cover">
          <?php else: ?>
            <div class="w-full h-full flex items-center justify-center text-gray-400">
              <i class="fas fa-image text-2xl"></i>
            </div>
          <?php endif; ?>
        </div>
        <div>
          <div class="flex items-center gap-2 flex-wrap">
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-800 border border-indigo-200">
              <?= $free_class->category ?>
            </span>
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700 border border-gray-200">
              Level: <span class="ml-1 font-semibold"><?= $free_class->level ?></span>
            </span>
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700 border border-gray-200">
              Durasi: <span class="ml-1 font-semibold"><?= $free_class->duration ?> menit</span>
            </span>
          </div>
          <h1 class="mt-2 text-2xl md:text-3xl font-bold leading-tight text-gray-900">
            <?= $free_class->title ?>
          </h1>
          
        </div>
      </div>

      <div class="flex flex-wrap gap-3">
        <a href="<?= site_url('admin/free_classes/edit/' . $free_class->id) ?>" class="inline-flex items-center justify-center px-4 py-2 text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg font-semibold shadow focus:outline-none focus:ring-2 focus:ring-indigo-500">
          <i class="fas fa-edit mr-2"></i> Edit Kelas
        </a>
        <a href="<?= site_url('admin/free_classes') ?>" class="inline-flex items-center justify-center px-4 py-2 bg-white text-gray-700 hover:bg-gray-50 rounded-lg font-medium border border-gray-200">
          <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
      <!-- Tabs -->
      <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="border-b border-gray-200">
          <nav class="flex -mb-px">
            <button type="button" data-tab="deskripsi" class="tab-button py-4 px-6 text-center border-b-2 font-medium text-sm border-indigo-500 text-indigo-600">
              Deskripsi
            </button>
            <button type="button" data-tab="materi" class="tab-button py-4 px-6 text-center border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
              Materi (<?= count($materials) ?>)
            </button>
            <button type="button" data-tab="siswa" class="tab-button py-4 px-6 text-center border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
              Siswa Terdaftar (<?= $enrolled_count ?>)
            </button>
          </nav>
        </div>

        <!-- Tab Content -->
        <div class="p-6">
          <!-- Deskripsi Tab -->
          <div id="tab-deskripsi" class="tab-content">
            <div class="prose max-w-none quill-content">
              <?php if (!empty($free_class->description)): ?>
                <?= html_entity_decode($free_class->description) ?>
              <?php else: ?>
                <p class="text-gray-500 italic">Tidak ada deskripsi</p>
              <?php endif; ?>
            </div>
          </div>

          <!-- Materi Tab -->
          <div id="tab-materi" class="tab-content hidden">
            <?php if (!empty($materials)): ?>
              <div class="space-y-4">
                <?php foreach ($materials as $material): ?>
                  <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <div class="bg-gray-50 px-4 py-3 flex justify-between items-center">
                      <h3 class="font-medium text-gray-900"><?= $material->title ?></h3>
                      <div class="flex items-center gap-2">
                        <a href="<?= site_url('admin/free_classes/edit_material/' . $material->id) ?>" class="text-indigo-600 hover:text-indigo-800">
                          <i class="fas fa-edit"></i>
                        </a>
                      </div>
                    </div>
                    <div class="p-4">
                      <p class="text-sm text-gray-600 mb-3"><?= $material->description ?></p>
                      <div class="text-xs text-gray-500">
                        <span class="inline-flex items-center">
                          <i class="fas fa-file-alt mr-1"></i> <?= ucfirst($material->content_type) ?>
                        </span>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php else: ?>
              <div class="text-center py-8 text-gray-500">
                <i class="fas fa-inbox text-4xl mb-2 text-gray-300"></i>
                <p>Belum ada materi untuk kelas ini</p>
                <a href="<?= site_url('admin/free_classes/add_material/' . $free_class->id) ?>" class="inline-flex items-center mt-3 text-indigo-600 hover:text-indigo-800">
                  <i class="fas fa-plus mr-1"></i> Tambah Materi
                </a>
              </div>
            <?php endif; ?>
          </div>

          <!-- Siswa Terdaftar Tab -->
          <div id="tab-siswa" class="tab-content hidden">
            <?php if (!empty($enrolled_students)): ?>
              <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-gray-50">
                    <tr>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Daftar</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($enrolled_students as $student): ?>
                      <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                          <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                              <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <div class="ml-4">
                              <div class="text-sm font-medium text-gray-900"><?= $student->nama_lengkap ?></div>
                            </div>
                          </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                          <?= $student->email ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                          <?= date('d M Y', strtotime($student->enrolled_at)) ?>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            <?php else: ?>
              <div class="text-center py-8 text-gray-500">
                <i class="fas fa-users-slash text-4xl mb-2 text-gray-300"></i>
                <p>Belum ada siswa yang terdaftar</p>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
      <!-- Informasi Kelas -->
      <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Informasi Kelas</h2>
        <div class="space-y-4">
          <div class="flex items-start">
            <div class="flex-shrink-0 h-5 w-5 text-gray-400">
              <i class="fas fa-user-tie"></i>
            </div>
            <div class="ml-3">
              <p class="text-sm text-gray-500">Mentor</p>
              <p class="text-sm font-medium text-gray-900"><?= $free_class->mentor_name ?></p>
            </div>
          </div>
          <div class="flex items-start">
            <div class="flex-shrink-0 h-5 w-5 text-gray-400">
              <i class="fas fa-layer-group"></i>
            </div>
            <div class="ml-3">
              <p class="text-sm text-gray-500">Kategori</p>
              <p class="text-sm font-medium text-gray-900"><?= $free_class->category ?></p>
            </div>
          </div>
          <div class="flex items-start">
            <div class="flex-shrink-0 h-5 w-5 text-gray-400">
              <i class="fas fa-signal"></i>
            </div>
            <div class="ml-3">
              <p class="text-sm text-gray-500">Level</p>
              <p class="text-sm font-medium text-gray-900"><?= $free_class->level ?></p>
            </div>
          </div>
          <div class="flex items-start">
            <div class="flex-shrink-0 h-5 w-5 text-gray-400">
              <i class="far fa-clock"></i>
            </div>
            <div class="ml-3">
              <p class="text-sm text-gray-500">Durasi</p>
              <p class="text-sm font-medium text-gray-900"><?= $free_class->duration ?> menit</p>
            </div>
          </div>
          <div class="flex items-start">
            <div class="flex-shrink-0 h-5 w-5 text-gray-400">
              <i class="fas fa-calendar-alt"></i>
            </div>
            <div class="ml-3">
              <p class="text-sm text-gray-500">Tanggal Mulai</p>
              <p class="text-sm font-medium text-gray-900"><?= date('d M Y', strtotime($free_class->start_date)) ?></p>
            </div>
          </div>
          <?php if (!empty($free_class->end_date)): ?>
            <div class="flex items-start">
              <div class="flex-shrink-0 h-5 w-5 text-gray-400">
                <i class="fas fa-calendar-times"></i>
              </div>
              <div class="ml-3">
                <p class="text-sm text-gray-500">Tanggal Berakhir</p>
                <p class="text-sm font-medium text-gray-900"><?= date('d M Y', strtotime($free_class->end_date)) ?></p>
              </div>
            </div>
          <?php endif; ?>
          <div class="flex items-start">
            <div class="flex-shrink-0 h-5 w-5 text-gray-400">
              <i class="fas fa-users"></i>
            </div>
            <div class="ml-3">
              <p class="text-sm text-gray-500">Siswa Terdaftar</p>
              <p class="text-sm font-medium text-gray-900"><?= $enrolled_count ?> siswa</p>
            </div>
          </div>
          <div class="flex items-start">
            <div class="flex-shrink-0 h-5 w-5 text-gray-400">
              <i class="fas fa-tag"></i>
            </div>
            <div class="ml-3">
              <p class="text-sm text-gray-500">Status</p>
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $free_class->status === 'Published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' ?>">
                <?= $free_class->status ?>
              </span>
            </div>
          </div>
        </div>
      </div>

      <!-- Aksi Cepat -->
      <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h2>
        <div class="space-y-3">
          <a href="<?= site_url('admin/free_classes/edit/' . $free_class->id) ?>" class="w-full flex items-center justify-between px-4 py-2 border border-gray-200 rounded-lg hover:bg-gray-50">
            <span class="text-gray-700">
              <i class="fas fa-edit mr-2 text-indigo-600"></i>
              Edit Kelas
            </span>
            <i class="fas fa-chevron-right text-gray-400"></i>
          </a>
          <a href="<?= site_url('admin/free_classes/add_material/' . $free_class->id) ?>" class="w-full flex items-center justify-between px-4 py-2 border border-gray-200 rounded-lg hover:bg-gray-50">
            <span class="text-gray-700">
              <i class="fas fa-plus-circle mr-2 text-green-600"></i>
              Tambah Materi
            </span>
            <i class="fas fa-chevron-right text-gray-400"></i>
          </a>
          <a href="<?= site_url('admin/free_classes') ?>" class="w-full flex items-center justify-between px-4 py-2 border border-gray-200 rounded-lg hover:bg-gray-50">
            <span class="text-gray-700">
              <i class="fas fa-arrow-left mr-2 text-gray-600"></i>
              Kembali ke Daftar
            </span>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
/* Quill Content Styles */
.quill-content {
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
  line-height: 1.6;
  color: #374151;
}

.quill-content h1,
.quill-content h2,
.quill-content h3,
.quill-content h4,
.quill-content h5,
.quill-content h6 {
  margin-top: 1.5em;
  margin-bottom: 0.75em;
  font-weight: 600;
  color: #111827;
}

.quill-content h1 { font-size: 1.875rem; }
.quill-content h2 { font-size: 1.5rem; }
.quill-content h3 { font-size: 1.25rem; }
.quill-content h4 { font-size: 1.125rem; }

.quill-content p {
  margin-top: 1em;
  margin-bottom: 1em;
}

.quill-content ul,
.quill-content ol {
  padding-left: 1.5em;
  margin: 1em 0;
}

.quill-content ul {
  list-style-type: disc;
}

.quill-content ol {
  list-style-type: decimal;
}

.quill-content a {
  color: #3b82f6;
  text-decoration: none;
  transition: color 0.2s;
}

.quill-content a:hover {
  color: #2563eb;
  text-decoration: underline;
}

.quill-content blockquote {
  border-left: 4px solid #e5e7eb;
  padding-left: 1em;
  margin: 1em 0;
  color: #6b7280;
  font-style: italic;
}

.quill-content code {
  font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace;
  background-color: #f3f4f6;
  padding: 0.2em 0.4em;
  border-radius: 0.25rem;
  font-size: 0.875em;
}

.quill-content pre {
  background-color: #1e293b;
  color: #f8fafc;
  padding: 1em;
  border-radius: 0.375rem;
  overflow-x: auto;
  margin: 1em 0;
}

.quill-content pre code {
  background-color: transparent;
  padding: 0;
  border-radius: 0;
  color: inherit;
  font-size: 0.875em;
}

.quill-content img {
  max-width: 100%;
  height: auto;
  border-radius: 0.375rem;
  margin: 1em 0;
}

.quill-content .ql-align-center {
  text-align: center;
}

.quill-content .ql-align-right {
  text-align: right;
}

.quill-content .ql-align-justify {
  text-align: justify;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Tab functionality
  const tabButtons = document.querySelectorAll('.tab-button');
  const tabContents = document.querySelectorAll('.tab-content');

  function showTab(tabId) {
    // Hide all tab contents
    tabContents.forEach(content => {
      content.classList.add('hidden');
    });

    // Remove active class from all buttons
    tabButtons.forEach(button => {
      button.classList.remove('border-indigo-500', 'text-indigo-600');
      button.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
    });

    // Show the selected tab content
    const selectedTab = document.getElementById(`tab-${tabId}`);
    if (selectedTab) {
      selectedTab.classList.remove('hidden');
    }

    // Add active class to the clicked button
    const activeButton = document.querySelector(`[data-tab="${tabId}"]`);
    if (activeButton) {
      activeButton.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
      activeButton.classList.add('border-indigo-500', 'text-indigo-600');
    }
  }

  // Add click event to tab buttons
  tabButtons.forEach(button => {
    button.addEventListener('click', function() {
      const tabId = this.getAttribute('data-tab');
      showTab(tabId);
    });
  });

  // Show the first tab by default
  if (tabButtons.length > 0) {
    const firstTabId = tabButtons[0].getAttribute('data-tab');
    showTab(firstTabId);
  }
});
</script>
