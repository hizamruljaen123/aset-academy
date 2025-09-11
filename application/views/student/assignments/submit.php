<div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Pengumpulan: <?= htmlspecialchars($assignment->title, ENT_QUOTES, 'UTF-8'); ?></h1>
        <a href="<?= site_url('student/assignments/view_class/' . $assignment->class_id . '/' . $assignment->class_type); ?>" class="text-sm text-blue-600 hover:underline">&larr; Kembali ke Daftar Tugas</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Assignment Details -->
        <div class="lg:col-span-1">
            <div class="bg-white shadow-lg rounded-xl p-6 sticky top-6">
                <h3 class="text-lg font-semibold border-b pb-3 mb-4">Detail Tugas</h3>
                <div class="space-y-4">
                    <div>
                        <h4 class="font-medium text-sm text-gray-500">Batas Waktu</h4>
                        <p class="text-gray-800 font-semibold"><?= $assignment->due_date ? date('d M Y, H:i', strtotime($assignment->due_date)) : 'Tidak ada'; ?></p>
                    </div>
                    <div>
                        <h4 class="font-medium text-sm text-gray-500">Deskripsi</h4>
                        <div class="prose max-w-none text-sm mt-1">
                            <?= $assignment->description; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submission Form / Details -->
        <div class="lg:col-span-2">
            <div class="bg-white shadow-lg rounded-xl p-6">
                <?php if ($submission): // If already submitted ?>
                    <h3 class="text-lg font-semibold mb-4">Pengumpulan Anda</h3>
                    <div class="space-y-6">
                        <div>
                            <h4 class="font-medium text-sm text-gray-500">Waktu Pengumpulan</h4>
                            <p class="text-gray-800"><?= date('d M Y, H:i', strtotime($submission->submitted_at)); ?></p>
                        </div>
                        <?php if($submission->submission_content): ?>
                        <div>
                            <h4 class="font-medium text-sm text-gray-500">Jawaban Teks Anda</h4>
                            <div class="prose max-w-none text-sm mt-1 p-3 bg-gray-50 rounded-md border">
                                <?= $submission->submission_content; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if($submission->submission_file): ?>
                        <div>
                            <h4 class="font-medium text-sm text-gray-500">File Terlampir</h4>
                            <a href="<?= base_url('uploads/submissions/' . $submission->submission_file); ?>" target="_blank" class="text-blue-600 hover:underline flex items-center mt-1">
                                <i class="fas fa-download mr-2"></i> Download File Anda
                            </a>
                        </div>
                        <?php endif; ?>
                        
                        <!-- Grade and Feedback -->
                        <?php if($submission->status == 'graded'): ?>
                        <div class="pt-6 border-t">
                             <h3 class="text-lg font-semibold mb-4 text-green-700">Nilai dan Feedback</h3>
                             <div>
                                <h4 class="font-medium text-sm text-gray-500">Nilai</h4>
                                <p class="text-2xl font-bold text-green-600"><?= $submission->grade; ?></p>
                            </div>
                            <?php if($submission->feedback): ?>
                            <div class="mt-4">
                                <h4 class="font-medium text-sm text-gray-500">Feedback dari Guru</h4>
                                <div class="prose max-w-none text-sm mt-1 p-3 bg-green-50 rounded-md border border-green-200">
                                    <?= $submission->feedback; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                <?php else: // If not yet submitted ?>
                    <h3 class="text-lg font-semibold mb-4">Formulir Pengumpulan</h3>
                    <?php echo form_open_multipart('student/assignments/submit/' . $assignment->id); ?>
                        <div class="space-y-6">
                            <div>
                                <label for="submission_content" class="block text-sm font-medium text-gray-700">Jawaban Teks (Opsional)</label>
                                <div id="editor-container" class="mt-1"></div>
                                <input type="hidden" name="submission_content" id="submission_content">
                            </div>
                            <div>
                                <label for="submission_file" class="block text-sm font-medium text-gray-700">Unggah File (Opsional)</label>
                                <input type="file" name="submission_file" id="submission_file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
                                <p class="text-xs text-gray-500 mt-1">Maks. ukuran file: 2MB.</p>
                            </div>
                        </div>
                        <div class="flex justify-end mt-8 pt-5 border-t">
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-700">Kumpulkan Tugas</button>
                        </div>
                    <?php echo form_close(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Quill JS -->
<?php if (!$submission): ?>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var quill = new Quill('#editor-container', {
            theme: 'snow',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline'],
                    ['link', 'blockquote', 'code-block'],
                    [{'list': 'ordered'}, {'list': 'bullet'}]
                ]
            }
        });
        var form = document.querySelector('form');
        form.onsubmit = function() {
            var content = document.querySelector('input[name=submission_content]');
            content.value = quill.root.innerHTML;
        };
    });
</script>
<?php endif; ?>
