<div class="min-h-screen bg-gradient-to-br from-slate-50 to-indigo-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                <div class="flex items-center mb-4">
                    <a href="<?= site_url('teacher/assignments/submissions/' . $assignment->id); ?>" class="flex items-center text-sm text-gray-500 hover:text-gray-700">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Kembali ke Daftar Pengumpulan
                    </a>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Beri Nilai</h1>
                <p class="text-xl text-gray-600"><?= htmlspecialchars($assignment->title, ENT_QUOTES, 'UTF-8'); ?></p>
                <div class="mt-4 flex items-center space-x-4">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                            <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900"><?= htmlspecialchars($submission->nama_lengkap, ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="text-sm text-gray-500">Siswa</p>
                        </div>
                    </div>
                    <span class="text-sm text-gray-500">
                        Dikumpulkan: <?= date('d M Y, H:i', strtotime($submission->submitted_at)); ?>
                    </span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Submission Details -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white">Detail Pengumpulan</h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <div>
                            <h4 class="font-medium text-sm text-gray-500 mb-2">Waktu Pengumpulan</h4>
                            <div class="flex items-center text-gray-900">
                                <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <?= date('d M Y, H:i', strtotime($submission->submitted_at)); ?>
                            </div>
                        </div>
                        
                        <?php if($submission->submission_content): ?>
                        <div>
                            <h4 class="font-medium text-sm text-gray-500 mb-2">Jawaban Teks</h4>
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <div class="prose prose-sm max-w-none">
                                    <?= $submission->submission_content; ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <?php if($submission->submission_file): ?>
                        <div>
                            <h4 class="font-medium text-sm text-gray-500 mb-2">File Terlampir</h4>
                            <a href="<?= base_url('uploads/submissions/' . $submission->submission_file); ?>" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
                                </svg>
                                Download File
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Grading Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-600 to-emerald-600 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white">Form Penilaian</h3>
                    </div>
                    <div class="p-6">
                        <?php echo form_open('teacher/assignments/grade/' . $submission->id, ['class' => 'space-y-6']); ?>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="grade" class="block text-sm font-medium text-gray-700 mb-2">Nilai (0-100)</label>
                                    <div class="relative">
                                        <input type="number" name="grade" id="grade" min="0" max="100" 
                                               class="block w-full pr-12 border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" 
                                               value="<?= set_value('grade', $submission->grade); ?>" required>
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                            <span class="text-gray-500 sm:text-sm">/100</span>
                                        </div>
                                    </div>
                                    <?php echo form_error('grade', '<p class="text-red-500 text-xs mt-1">', '</p>'); ?>
                                </div>
                                
                                <div>
                                    <label for="grade_status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                    <select name="grade_status" id="grade_status" class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                        <option value="graded" <?= $submission->status == 'graded' ? 'selected' : '' ?>>Sudah Dinilai</option>
                                        <option value="pending" <?= $submission->status == 'pending' ? 'selected' : '' ?>>Menunggu Penilaian</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label for="feedback" class="block text-sm font-medium text-gray-700 mb-2">Feedback</label>
                                <div class="bg-gray-50 rounded-lg p-1">
                                    <div id="editor-container" class="prose max-w-none"></div>
                                </div>
                                <input type="hidden" name="feedback" id="feedback">
                                <p class="text-xs text-gray-500 mt-1">Berikan feedback konstruktif untuk siswa</p>
                            </div>

                            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                                <div class="text-sm text-gray-500">
                                    Terakhir diperbarui: <?= date('d M Y, H:i', strtotime($submission->updated_at ?? $submission->submitted_at)); ?>
                                </div>
                                <div class="flex space-x-3">
                                    <a href="<?= site_url('teacher/assignments/submissions/' . $assignment->id); ?>" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Batal
                                    </a>
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-600 to-emerald-600 text-white text-sm font-medium rounded-lg shadow-md hover:from-green-700 hover:to-emerald-700 transition-all duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Simpan Nilai
                                    </button>
                                </div>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quill JS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var quill = new Quill('#editor-container', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, false] }],
                    ['bold', 'italic', 'underline'],
                    ['link', 'blockquote', 'code-block'],
                    [{'list': 'ordered'}, {'list': 'bullet'}],
                    ['clean']
                ]
            }
        });

        // Set initial content for the editor
        var initialFeedback = `<?= addslashes($submission->feedback); ?>`;
        if (initialFeedback) {
            quill.root.innerHTML = initialFeedback;
        }

        var form = document.querySelector('form');
        form.onsubmit = function() {
            var feedback = document.querySelector('input[name=feedback]');
            feedback.value = quill.root.innerHTML;
        };
    });
</script>
