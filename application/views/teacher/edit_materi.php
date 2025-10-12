<!-- Quill JS CSS & JS -->
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.7/quill.js"></script>
<!-- Sortable.js for Drag & Drop -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<style>
    .part-item {
        transition: all 0.3s ease;
        cursor: move;
    }
    
    .part-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    
    .part-item.sortable-ghost {
        opacity: 0.4;
        background: #f3f4f6;
    }
    
    .part-item.sortable-drag {
        opacity: 0.8;
    }

    .btn-action {
        transition: all 0.2s ease;
    }

    .btn-action:hover {
        transform: scale(1.05);
    }

    .modal {
        backdrop-filter: blur(5px);
    }

    .badge-part-type {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .fade-in {
        animation: fadeIn 0.3s ease-in;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Info Cards Animation */
    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .info-card {
        animation: slideInDown 0.5s ease-out forwards;
        opacity: 0;
    }

    .info-card:nth-child(1) { animation-delay: 0.1s; }
    .info-card:nth-child(2) { animation-delay: 0.2s; }
    .info-card:nth-child(3) { animation-delay: 0.3s; }
    .info-card:nth-child(4) { animation-delay: 0.4s; }

    /* Part Item Enhanced */
    .part-item {
        position: relative;
        overflow: hidden;
    }

    .part-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(6, 182, 212, 0.1), transparent);
        transition: left 0.5s;
    }

    .part-item:hover::before {
        left: 100%;
    }

    /* Number Badge */
    .part-number {
        background: linear-gradient(135deg, #1f2937, #374151);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Quill Editor Professional Styling */
    .editor-container {
        background: #ffffff;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .editor-container:focus-within {
        border-color: #06b6d4;
        box-shadow: 0 0 0 3px rgba(6, 182, 212, 0.1);
    }

    .ql-toolbar.ql-snow {
        border: none;
        border-bottom: 2px solid #f1f5f9;
        background: linear-gradient(to bottom, #fafbfc, #f8fafc);
        padding: 12px 16px;
    }

    .ql-container.ql-snow {
        border: none;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        font-size: 15px;
        line-height: 1.6;
    }

    .ql-editor {
        min-height: 200px;
        max-height: 400px;
        padding: 20px 24px;
        overflow-y: auto;
        color: #1f2937;
    }

    .ql-editor.ql-blank::before {
        color: #9ca3af;
        font-style: italic;
        left: 24px;
        right: 24px;
    }

    /* Toolbar buttons styling */
    .ql-snow .ql-stroke {
        stroke: #64748b;
        transition: stroke 0.2s ease;
    }

    .ql-snow .ql-fill {
        fill: #64748b;
        transition: fill 0.2s ease;
    }

    .ql-snow .ql-picker-label {
        color: #475569;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 4px 8px;
        transition: all 0.2s ease;
    }

    .ql-snow .ql-picker-label:hover {
        background: #f1f5f9;
        border-color: #cbd5e1;
    }

    .ql-toolbar button {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        transition: all 0.2s ease;
    }

    .ql-toolbar button:hover,
    .ql-toolbar button.ql-active {
        background: linear-gradient(135deg, #06b6d4, #0891b2);
        color: white !important;
    }

    .ql-toolbar button:hover .ql-stroke,
    .ql-toolbar button.ql-active .ql-stroke {
        stroke: white !important;
    }

    .ql-toolbar button:hover .ql-fill,
    .ql-toolbar button.ql-active .ql-fill {
        fill: white !important;
    }

    .ql-snow.ql-toolbar button.ql-active .ql-stroke {
        stroke: white !important;
    }

    .ql-snow.ql-toolbar button.ql-active .ql-fill {
        fill: white !important;
    }

    /* Scrollbar styling */
    .ql-editor::-webkit-scrollbar {
        width: 8px;
    }

    .ql-editor::-webkit-scrollbar-track {
        background: #f8fafc;
        border-radius: 4px;
    }

    .ql-editor::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }

    .ql-editor::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* Content styling */
    .ql-editor h1 {
        font-size: 2em;
        font-weight: 700;
        color: #0f172a;
        margin-top: 1em;
        margin-bottom: 0.5em;
    }

    .ql-editor h2 {
        font-size: 1.5em;
        font-weight: 600;
        color: #1e293b;
        margin-top: 0.8em;
        margin-bottom: 0.4em;
    }

    .ql-editor h3 {
        font-size: 1.25em;
        font-weight: 600;
        color: #334155;
        margin-top: 0.6em;
        margin-bottom: 0.3em;
    }

    .ql-editor p {
        margin-bottom: 1em;
    }

    .ql-editor ul,
    .ql-editor ol {
        padding-left: 1.5em;
        margin-bottom: 1em;
    }

    .ql-editor li {
        margin-bottom: 0.5em;
    }

    .ql-editor blockquote {
        border-left: 4px solid #06b6d4;
        padding-left: 16px;
        margin: 16px 0;
        color: #475569;
        font-style: italic;
        background: #f8fafc;
        padding: 12px 16px;
        border-radius: 0 8px 8px 0;
    }

    .ql-editor pre {
        background: #1e293b;
        color: #e2e8f0;
        padding: 16px;
        border-radius: 8px;
        overflow-x: auto;
        margin: 16px 0;
        font-family: 'Monaco', 'Menlo', 'Courier New', monospace;
        font-size: 14px;
        line-height: 1.5;
    }

    .ql-editor a {
        color: #0891b2;
        text-decoration: none;
        border-bottom: 1px solid transparent;
        transition: border-color 0.2s ease;
    }

    .ql-editor a:hover {
        border-bottom-color: #0891b2;
    }

    .ql-editor img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 16px 0;
    }

    /* Deskripsi editor styling - Full Width */
    #deskripsi-editor-container {
        min-height: 350px;
    }

    #deskripsi-editor-container .ql-editor {
        min-height: 280px;
        max-height: 450px;
    }

    /* Part content editor styling */
    #part-content-editor-container {
        min-height: 400px;
    }

    #part-content-editor-container .ql-editor {
        min-height: 300px;
        max-height: 500px;
    }

    /* Hide original textarea */
    textarea#deskripsi,
    textarea#part_content {
        display: none;
    }

    /* Editor label with icon */
    .editor-label {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
        font-weight: 600;
        color: #374151;
    }

    .editor-label i {
        color: #06b6d4;
    }

    /* Character count */
    .char-count {
        text-align: right;
        font-size: 12px;
        color: #6b7280;
        margin-top: 8px;
        padding: 0 8px;
    }
</style>

<div class="container mx-auto px-4 py-8 max-w-8xl">
    <!-- Header -->
    <div class="bg-gradient-to-r from-cyan-500 to-teal-500 rounded-2xl shadow-2xl p-8 mb-8 text-white">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="bg-white/20 p-4 rounded-xl backdrop-blur-sm">
                    <i class="fas fa-edit fa-3x"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold mb-2">Edit Materi</h1>
                    <p class="text-sm opacity-90">
                        <i class="fas fa-graduation-cap mr-2"></i>
                        Kelas: <?php echo $materi->nama_kelas; ?>
                    </p>
                </div>
            </div>
            <div class="flex space-x-2">
                <a href="<?php echo site_url('teacher/materi_detail/' . $materi->id); ?>" 
                   class="bg-white/20 hover:bg-white/30 px-6 py-3 rounded-lg font-semibold transition-all backdrop-blur-sm">
                    <i class="fas fa-eye mr-2"></i>Preview
                </a>
                <a href="<?php echo site_url('teacher/materi'); ?>" 
                   class="bg-white/20 hover:bg-white/30 px-6 py-3 rounded-lg font-semibold transition-all backdrop-blur-sm">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    <div id="alert-container" class="mb-6"></div>

    <!-- Info Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <!-- Info Card 1 -->
        <div class="info-card bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-90 mb-1">Total Bagian</p>
                    <p class="text-3xl font-bold"><?php echo count($parts); ?></p>
                </div>
                <div class="bg-white/20 p-4 rounded-lg">
                    <i class="fas fa-puzzle-piece fa-2x"></i>
                </div>
            </div>
        </div>

        <!-- Info Card 2 -->
        <div class="info-card bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-90 mb-1">ID Materi</p>
                    <p class="text-2xl font-bold">#<?php echo str_pad($materi->id, 5, '0', STR_PAD_LEFT); ?></p>
                </div>
                <div class="bg-white/20 p-4 rounded-lg">
                    <i class="fas fa-hashtag fa-2x"></i>
                </div>
            </div>
        </div>

        <!-- Info Card 3 -->
        <div class="info-card bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-90 mb-1">Dibuat</p>
                    <p class="text-lg font-semibold"><?php echo date('d M Y', strtotime($materi->created_at)); ?></p>
                </div>
                <div class="bg-white/20 p-4 rounded-lg">
                    <i class="fas fa-calendar fa-2x"></i>
                </div>
            </div>
        </div>

        <!-- Info Card 4 -->
        <div class="info-card bg-gradient-to-br from-orange-500 to-red-500 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-90 mb-1">Update Terakhir</p>
                    <p class="text-lg font-semibold"><?php echo date('d M Y', strtotime($materi->updated_at)); ?></p>
                </div>
                <div class="bg-white/20 p-4 rounded-lg">
                    <i class="fas fa-clock fa-2x"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Form Section - Full Width -->
    <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-edit mr-3 text-cyan-500"></i>
                Edit Informasi Materi
            </h2>
            <button onclick="confirmDeleteMateri()" 
                    class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg font-semibold transition-all shadow-md hover:shadow-lg transform hover:scale-105">
                <i class="fas fa-trash-alt mr-2"></i>Hapus Materi
            </button>
        </div>

        <form id="updateMateriForm">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div>
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-heading mr-1"></i>Judul Materi
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="judul" 
                               name="judul" 
                               value="<?php echo htmlspecialchars($materi->judul); ?>"
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                               placeholder="Masukkan judul materi..."
                               required>
                    </div>
                </div>

                <!-- Right Column - Submit Button -->
                <div class="flex items-end justify-end">
                    <button type="submit" 
                            class="bg-gradient-to-r from-cyan-500 to-teal-500 text-white px-8 py-3 rounded-lg font-semibold hover:from-cyan-600 hover:to-teal-600 transition-all shadow-lg hover:shadow-xl transform hover:scale-105 h-fit">
                        <i class="fas fa-save mr-2"></i>Simpan Perubahan
                    </button>
                </div>
            </div>

            <!-- Full Width Deskripsi Editor -->
            <div class="mt-6">
                <div class="editor-label">
                    <i class="fas fa-align-left"></i>
                    <span>Deskripsi Materi</span>
                    <span class="text-red-500">*</span>
                </div>
                <p class="text-sm text-gray-600 mb-3">
                    Tulis deskripsi lengkap tentang materi ini. Gunakan toolbar untuk formatting teks.
                </p>
                <!-- Quill Editor Container untuk Deskripsi -->
                <div class="editor-container" id="deskripsi-editor-container"></div>
                <!-- Hidden textarea untuk form submission -->
                <textarea id="deskripsi" 
                          name="deskripsi" 
                          required><?php echo htmlspecialchars($materi->deskripsi); ?></textarea>
                <div id="deskripsi-char-count" class="char-count">0 karakter</div>
            </div>
        </form>
    </div>

    <!-- Bagian Materi Section - Full Width -->
    <div class="bg-white rounded-2xl shadow-xl p-8">
        <div class="flex items-center justify-between mb-6 flex-wrap gap-4">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-puzzle-piece mr-3 text-cyan-500"></i>
                Bagian Materi
                <span class="ml-3 bg-cyan-100 text-cyan-600 px-4 py-1.5 rounded-full text-sm font-semibold">
                    <?php echo count($parts); ?> Bagian
                </span>
            </h2>
            <button onclick="openAddPartModal()" 
                    class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-8 py-3 rounded-lg font-semibold hover:from-green-600 hover:to-emerald-600 transition-all shadow-lg hover:shadow-xl transform hover:scale-105">
                <i class="fas fa-plus-circle mr-2"></i>Tambah Bagian Baru
            </button>
        </div>

        <div class="mb-6 bg-gradient-to-r from-blue-50 to-cyan-50 border-l-4 border-blue-500 p-4 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-info-circle text-blue-600 text-xl mr-3"></i>
                <div>
                    <p class="text-sm font-semibold text-blue-800 mb-1">Tips: Drag & Drop untuk Mengubah Urutan</p>
                    <p class="text-xs text-blue-700">Klik dan tahan icon grip (☰) lalu geser ke posisi yang diinginkan</p>
                </div>
            </div>
        </div>

        <!-- Parts List -->
        <div id="parts-list" class="space-y-4">
            <?php if (empty($parts)): ?>
                <div class="text-center py-20 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl border-2 border-dashed border-gray-300">
                    <div class="inline-block bg-white p-8 rounded-full shadow-lg mb-6">
                        <i class="fas fa-inbox fa-5x text-gray-300"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Belum Ada Bagian Materi</h3>
                    <p class="text-gray-500 mb-8 max-w-md mx-auto">
                        Mulai tambahkan bagian materi untuk melengkapi pembelajaran. Setiap bagian bisa berisi teks, video, atau kode.
                    </p>
                    <button onclick="openAddPartModal()" 
                            class="inline-flex items-center bg-gradient-to-r from-cyan-500 to-teal-500 text-white px-8 py-4 rounded-lg font-semibold hover:from-cyan-600 hover:to-teal-600 transition-all shadow-lg hover:shadow-xl transform hover:scale-105">
                        <i class="fas fa-plus-circle mr-2 text-xl"></i>Tambah Bagian Pertama
                    </button>
                </div>
            <?php else: ?>
                <?php foreach ($parts as $index => $part): ?>
                    <div class="part-item bg-gradient-to-br from-white to-gray-50 rounded-xl border-2 border-gray-200 p-6 shadow-md hover:shadow-xl transition-all" 
                         data-part-id="<?php echo $part->id; ?>">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex items-start space-x-4 flex-1">
                                <div class="bg-gradient-to-br from-cyan-500 to-teal-500 text-white rounded-lg p-3 cursor-move hover:shadow-lg transition-shadow flex-shrink-0">
                                    <i class="fas fa-grip-vertical fa-lg"></i>
                                </div>
                                <div class="flex-shrink-0 bg-gradient-to-br from-gray-700 to-gray-900 text-white rounded-lg px-4 py-2 font-bold text-lg">
                                    #{<?php echo $index + 1; ?>}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center space-x-3 mb-3 flex-wrap">
                                        <h4 class="text-xl font-bold text-gray-800">
                                            <?php echo htmlspecialchars($part->part_title); ?>
                                        </h4>
                                        <span class="badge-part-type <?php echo $part->part_type == 'video' ? 'bg-red-100 text-red-600' : ($part->part_type == 'text' ? 'bg-blue-100 text-blue-600' : 'bg-purple-100 text-purple-600'); ?>">
                                            <i class="fas fa-<?php echo $part->part_type == 'video' ? 'video' : ($part->part_type == 'text' ? 'file-alt' : 'code'); ?>"></i>
                                            <?php echo ucfirst($part->part_type); ?>
                                        </span>
                                    </div>
                                    <div class="text-sm text-gray-600 line-clamp-3 leading-relaxed">
                                        <?php echo substr(strip_tags($part->part_content), 0, 200); ?>
                                        <?php if (strlen(strip_tags($part->part_content)) > 200) echo '...'; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col space-y-2 flex-shrink-0">
                                <button onclick="editPart(<?php echo $part->id; ?>)" 
                                        class="btn-action bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md flex items-center justify-center gap-2" 
                                        title="Edit">
                                    <i class="fas fa-edit"></i>
                                    <span class="text-sm font-medium">Edit</span>
                                </button>
                                <button onclick="deletePart(<?php echo $part->id; ?>)" 
                                        class="btn-action bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow-md flex items-center justify-center gap-2" 
                                        title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                    <span class="text-sm font-medium">Hapus</span>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal for Add/Edit Part -->
<div id="partModal" class="modal fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50" onclick="closeModalOnOutsideClick(event)">
    <div class="bg-white rounded-2xl shadow-2xl max-w-3xl w-full mx-4 max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">
        <div class="sticky top-0 bg-gradient-to-r from-cyan-500 to-teal-500 text-white p-6 rounded-t-2xl z-10">
            <div class="flex items-center justify-between">
                <h3 class="text-2xl font-bold flex items-center">
                    <i class="fas fa-layer-group mr-3"></i>
                    <span id="modalTitle">Tambah Bagian Materi</span>
                </h3>
                <button onclick="closePartModal()" class="text-white hover:bg-white/20 p-2 rounded-lg transition-all">
                    <i class="fas fa-times fa-lg"></i>
                </button>
            </div>
        </div>
        
        <form id="partForm" class="p-6">
            <input type="hidden" id="part_id" name="part_id">
            
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-heading mr-1"></i>Judul Bagian *
                </label>
                <input type="text" 
                       id="part_title" 
                       name="part_title" 
                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                       placeholder="Masukkan judul bagian"
                       required>
            </div>

            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-tag mr-1"></i>Tipe Konten *
                </label>
                <div class="grid grid-cols-3 gap-3">
                    <label class="relative">
                        <input type="radio" name="part_type" value="text" class="peer sr-only" checked>
                        <div class="p-4 border-2 border-gray-200 rounded-lg cursor-pointer transition-all peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:border-blue-300 text-center">
                            <i class="fas fa-file-alt text-2xl text-blue-500 mb-2"></i>
                            <p class="font-semibold text-sm">Teks</p>
                        </div>
                    </label>
                    <label class="relative">
                        <input type="radio" name="part_type" value="video" class="peer sr-only">
                        <div class="p-4 border-2 border-gray-200 rounded-lg cursor-pointer transition-all peer-checked:border-red-500 peer-checked:bg-red-50 hover:border-red-300 text-center">
                            <i class="fas fa-video text-2xl text-red-500 mb-2"></i>
                            <p class="font-semibold text-sm">Video</p>
                        </div>
                    </label>
                    <label class="relative">
                        <input type="radio" name="part_type" value="code" class="peer sr-only">
                        <div class="p-4 border-2 border-gray-200 rounded-lg cursor-pointer transition-all peer-checked:border-purple-500 peer-checked:bg-purple-50 hover:border-purple-300 text-center">
                            <i class="fas fa-code text-2xl text-purple-500 mb-2"></i>
                            <p class="font-semibold text-sm">Kode</p>
                        </div>
                    </label>
                </div>
            </div>

            <div class="mb-5">
                <div class="editor-label">
                    <i class="fas fa-align-left"></i>
                    <span>Konten Bagian</span>
                    <span class="text-red-500">*</span>
                </div>
                <!-- Quill Editor Container untuk Part Content -->
                <div class="editor-container" id="part-content-editor-container"></div>
                <!-- Hidden textarea untuk form submission -->
                <textarea id="part_content" 
                          name="part_content" 
                          required></textarea>
                <div id="part-content-char-count" class="char-count">0 karakter</div>
            </div>

            <div class="flex space-x-3">
                <button type="submit" 
                        class="flex-1 bg-gradient-to-r from-cyan-500 to-teal-500 text-white py-3 px-6 rounded-lg font-semibold hover:from-cyan-600 hover:to-teal-600 transition-all shadow-lg hover:shadow-xl">
                    <i class="fas fa-check-circle mr-2"></i>Simpan
                </button>
                <button type="button" 
                        onclick="closePartModal()" 
                        class="flex-1 bg-gray-200 text-gray-700 py-3 px-6 rounded-lg font-semibold hover:bg-gray-300 transition-all">
                    <i class="fas fa-times-circle mr-2"></i>Batal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
const MATERI_ID = <?php echo $materi->id; ?>;
let deskripsiQuill = null;
let partContentQuill = null;
let sortableInstance = null;

// Quill toolbar configuration
const quillToolbarOptions = [
    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
    [{ 'font': [] }],
    [{ 'size': ['small', false, 'large', 'huge'] }],
    ['bold', 'italic', 'underline', 'strike'],
    [{ 'color': [] }, { 'background': [] }],
    [{ 'script': 'sub' }, { 'script': 'super' }],
    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
    [{ 'indent': '-1' }, { 'indent': '+1' }],
    [{ 'direction': 'rtl' }],
    [{ 'align': [] }],
    ['blockquote', 'code-block'],
    ['link', 'image', 'video'],
    ['clean']
];

// Initialize Quill Editor for Deskripsi
function initDeskripsiEditor() {
    const container = document.getElementById('deskripsi-editor-container');
    if (!container) return;
    
    deskripsiQuill = new Quill('#deskripsi-editor-container', {
        theme: 'snow',
        placeholder: 'Tulis deskripsi materi di sini... Gunakan toolbar untuk formatting.',
        modules: {
            toolbar: quillToolbarOptions
        }
    });
    
    // Load existing content
    const existingContent = document.getElementById('deskripsi').value;
    if (existingContent) {
        deskripsiQuill.root.innerHTML = existingContent;
    }
    
    // Update hidden textarea and character count on change
    deskripsiQuill.on('text-change', function() {
        document.getElementById('deskripsi').value = deskripsiQuill.root.innerHTML;
        updateCharCount('deskripsi', deskripsiQuill);
    });
    
    // Initial character count
    updateCharCount('deskripsi', deskripsiQuill);
}

// Initialize Quill Editor for Part Content
function initPartContentEditor(initialContent = '') {
    const container = document.getElementById('part-content-editor-container');
    if (!container) return;
    
    // Destroy previous instance if exists
    if (partContentQuill) {
        container.innerHTML = '';
    }
    
    partContentQuill = new Quill('#part-content-editor-container', {
        theme: 'snow',
        placeholder: 'Tulis konten bagian materi di sini... Anda dapat menambahkan teks, gambar, video, dan kode.',
        modules: {
            toolbar: quillToolbarOptions
        }
    });
    
    // Set initial content if provided
    if (initialContent) {
        partContentQuill.root.innerHTML = initialContent;
    }
    
    // Update hidden textarea and character count on change
    partContentQuill.on('text-change', function() {
        document.getElementById('part_content').value = partContentQuill.root.innerHTML;
        updateCharCount('part-content', partContentQuill);
    });
    
    // Initial character count
    updateCharCount('part-content', partContentQuill);
}

// Update character count
function updateCharCount(editorId, quillInstance) {
    const text = quillInstance.getText().trim();
    const charCount = text.length;
    const countElement = document.getElementById(`${editorId}-char-count`);
    
    if (countElement) {
        countElement.textContent = `${charCount.toLocaleString('id-ID')} karakter`;
        
        // Add color based on content length
        if (charCount === 0) {
            countElement.style.color = '#9ca3af';
        } else if (charCount < 100) {
            countElement.style.color = '#f59e0b';
        } else {
            countElement.style.color = '#10b981';
        }
    }
}

// Initialize Sortable for drag & drop
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Deskripsi Editor
    initDeskripsiEditor();
    
    // Initialize Sortable for parts list
    const partsList = document.getElementById('parts-list');
    
    if (partsList && partsList.children.length > 0) {
        sortableInstance = new Sortable(partsList, {
            animation: 150,
            handle: '.fa-grip-vertical',
            ghostClass: 'sortable-ghost',
            dragClass: 'sortable-drag',
            onEnd: function(evt) {
                updatePartOrder();
            }
        });
    }
});

// Show alert message
function showAlert(message, type = 'success') {
    const alertContainer = document.getElementById('alert-container');
    const alertClass = type === 'success' ? 'bg-green-100 border-green-500 text-green-800' : 'bg-red-100 border-red-500 text-red-800';
    const icon = type === 'success' ? 'check-circle' : 'exclamation-circle';
    
    const alertHTML = `
        <div class="fade-in ${alertClass} border-l-4 p-4 rounded-lg shadow-md flex items-center justify-between">
            <div class="flex items-center">
                <i class="fas fa-${icon} mr-3 text-xl"></i>
                <span class="font-medium">${message}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-xl opacity-70 hover:opacity-100">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    alertContainer.innerHTML = alertHTML;
    setTimeout(() => alertContainer.innerHTML = '', 5000);
}

// Update materi info
document.getElementById('updateMateriForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    // Update deskripsi dari Quill editor
    if (deskripsiQuill) {
        document.getElementById('deskripsi').value = deskripsiQuill.root.innerHTML;
    }
    
    // Validate deskripsi content
    const deskripsiText = deskripsiQuill ? deskripsiQuill.getText().trim() : '';
    if (!deskripsiText || deskripsiText.length === 0) {
        showAlert('Deskripsi tidak boleh kosong!', 'error');
        return;
    }
    
    const formData = new FormData(this);
    
    try {
        const response = await fetch('<?php echo site_url('teacher/update_materi/' . $materi->id); ?>', {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        
        if (result.success) {
            showAlert(result.message, 'success');
        } else {
            showAlert(result.message, 'error');
        }
    } catch (error) {
        showAlert('Terjadi kesalahan saat menyimpan data', 'error');
    }
});

// Modal functions
function openAddPartModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Bagian Materi';
    document.getElementById('partForm').reset();
    document.getElementById('part_id').value = '';
    document.getElementById('partModal').classList.remove('hidden');
    document.getElementById('partModal').classList.add('flex');
    
    // Initialize Quill editor for part content
    setTimeout(() => {
        initPartContentEditor('');
    }, 100);
}

function closePartModal() {
    document.getElementById('partModal').classList.add('hidden');
    document.getElementById('partModal').classList.remove('flex');
    
    // Cleanup Quill instance
    if (partContentQuill) {
        const container = document.getElementById('part-content-editor-container');
        if (container) {
            container.innerHTML = '';
        }
        partContentQuill = null;
    }
}

function closeModalOnOutsideClick(event) {
    if (event.target.id === 'partModal') {
        closePartModal();
    }
}

// Edit part
async function editPart(partId) {
    try {
        const response = await fetch(`<?php echo site_url('teacher/get_part/'); ?>${partId}`);
        const part = await response.json();
        
        if (part) {
            document.getElementById('modalTitle').textContent = 'Edit Bagian Materi';
            document.getElementById('part_id').value = part.id;
            document.getElementById('part_title').value = part.part_title;
            
            // Set radio button
            document.querySelector(`input[name="part_type"][value="${part.part_type}"]`).checked = true;
            
            document.getElementById('partModal').classList.remove('hidden');
            document.getElementById('partModal').classList.add('flex');
            
            // Initialize Quill with existing content
            setTimeout(() => {
                initPartContentEditor(part.part_content);
            }, 100);
        }
    } catch (error) {
        showAlert('Gagal memuat data bagian', 'error');
    }
}

// Submit part form
document.getElementById('partForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    // Get content from Quill Editor
    if (partContentQuill) {
        const content = partContentQuill.root.innerHTML;
        document.getElementById('part_content').value = content;
    }
    
    // Validation: check if content is not empty
    const contentText = partContentQuill ? partContentQuill.getText().trim() : '';
    if (!contentText || contentText.length === 0) {
        showAlert('Konten tidak boleh kosong!', 'error');
        return;
    }
    
    const partId = document.getElementById('part_id').value;
    const url = partId 
        ? `<?php echo site_url('teacher/update_materi_part/'); ?>${partId}`
        : `<?php echo site_url('teacher/add_materi_part/'); ?>${MATERI_ID}`;
    
    const formData = new FormData(this);
    
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        
        if (result.success) {
            showAlert(result.message, 'success');
            closePartModal();
            setTimeout(() => location.reload(), 1000);
        } else {
            showAlert(result.message, 'error');
        }
    } catch (error) {
        showAlert('Terjadi kesalahan saat menyimpan data', 'error');
    }
});

// Delete part
async function deletePart(partId) {
    if (!confirm('Apakah Anda yakin ingin menghapus bagian ini?')) {
        return;
    }
    
    try {
        const response = await fetch(`<?php echo site_url('teacher/delete_materi_part/'); ?>${partId}`, {
            method: 'POST'
        });
        
        const result = await response.json();
        
        if (result.success) {
            showAlert(result.message, 'success');
            setTimeout(() => location.reload(), 1000);
        } else {
            showAlert(result.message, 'error');
        }
    } catch (error) {
        showAlert('Terjadi kesalahan saat menghapus data', 'error');
    }
}

// Update part order after drag & drop
async function updatePartOrder() {
    const parts = document.querySelectorAll('.part-item');
    const orders = {};
    
    parts.forEach((part, index) => {
        const partId = part.getAttribute('data-part-id');
        orders[partId] = index + 1;
    });
    
    try {
        const formData = new FormData();
        formData.append('materi_id', MATERI_ID);
        formData.append('orders', JSON.stringify(orders));
        
        const response = await fetch('<?php echo site_url('teacher/reorder_materi_parts'); ?>', {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        
        if (result.success) {
            showAlert(result.message, 'success');
        } else {
            showAlert(result.message, 'error');
        }
    } catch (error) {
        showAlert('Terjadi kesalahan saat mengupdate urutan', 'error');
    }
}

// Delete materi
function confirmDeleteMateri() {
    if (confirm('Apakah Anda yakin ingin menghapus seluruh materi ini? Semua bagian materi akan ikut terhapus!')) {
        window.location.href = '<?php echo site_url('teacher/delete_materi/' . $materi->id); ?>';
    }
}

// Get part data for edit (need to add this method in controller)
</script>

