<div class="min-h-screen bg-gradient-to-br from-slate-50 to-indigo-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                <div class="flex items-center mb-4">
                    <a href="<?= site_url('teacher/assignments/view_class/' . $class->id . '/' . $class_type); ?>" class="flex items-center text-sm text-gray-500 hover:text-gray-700">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Kembali ke Daftar Tugas
                    </a>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2"><?= isset($assignment) ? 'Edit Tugas' : 'Buat Tugas Baru'; ?></h1>
                <p class="text-xl text-gray-600"><?= htmlspecialchars($class->nama_kelas ?? 'Kelas Tidak Dikenal', ENT_QUOTES, 'UTF-8'); ?></p>
                <div class="mt-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium <?= $class_type == 'premium' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' ?>">
                        <?= ucfirst($class_type) ?> Class
                    </span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Form Tugas</h2>
                <p class="text-sm text-gray-600 mt-1">Lengkapi informasi tugas untuk kelas ini</p>
            </div>
            
            <div class="p-8">
                <?php echo form_open(isset($assignment) ? 'teacher/assignments/edit/' . $assignment->id : 'teacher/assignments/create/' . $class->id . '/' . $class_type, ['class' => 'space-y-8']); ?>
                    <div class="space-y-8">
                <!-- Judul Tugas -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Judul Tugas</label>
                    <input type="text" name="title" id="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="<?= set_value('title', isset($assignment) ? $assignment->title : ''); ?>" required>
                    <?php echo form_error('title', '<p class="text-red-500 text-xs mt-1">', '</p>'); ?>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <div id="editor-container" class="mt-1"></div>
                    <input type="hidden" name="description" id="description">
                    <?php echo form_error('description', '<p class="text-red-500 text-xs mt-1">', '</p>'); ?>
                </div>

                <!-- Batas Waktu -->
                <div>
                    <label for="due_date" class="block text-sm font-medium text-gray-700">Batas Waktu (Opsional)</label>
                    <input type="datetime-local" name="due_date" id="due_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="<?= set_value('due_date', isset($assignment->due_date) ? date('Y-m-d\TH:i', strtotime($assignment->due_date)) : ''); ?>">
                </div>
            </div>

            <div class="flex justify-end mt-8 pt-5 border-t">
                <a href="<?= site_url('teacher/assignments/view_class/' . $class->id . '/' . $class_type); ?>" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg mr-3 hover:bg-gray-300">Batal</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700"><?= isset($assignment) ? 'Update Tugas' : 'Simpan Tugas'; ?></button>
            </div>
        <?php echo form_close(); ?>
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
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline'],
                    ['link', 'blockquote', 'code-block'],
                    [{'list': 'ordered'}, {'list': 'bullet'}],
                    ['clean']
                ]
            }
        });

                var initialContent = `<?= isset($assignment->description) ? addslashes($assignment->description) : ''; ?>`;
        if(initialContent) {
            quill.root.innerHTML = initialContent;
        }

        var form = document.querySelector('form');
        form.onsubmit = function() {
            var description = document.querySelector('input[name=description]');
            description.value = quill.root.innerHTML;
        };
    });
</script>
