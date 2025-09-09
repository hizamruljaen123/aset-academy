<div class="p-4 sm:p-6 lg:p-8">
    <div class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white rounded-2xl p-6 mb-8 shadow-lg">
        <h1 class="text-3xl font-bold"><?= $title; ?></h1>
    </div>

    <div class="bg-white rounded-2xl shadow-md p-6">
        <form action="<?= site_url('admin/materi/store'); ?>" method="post" class="space-y-6">
            <input type="hidden" name="kelas_id" value="<?= $kelas_id; ?>">
            
            <div>
                <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Materi</label>
                <input type="text" name="judul" id="judul" class="w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            
            <div>
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat</label>
                <textarea name="deskripsi" id="deskripsi" rows="3" class="w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Konten Materi</label>
                <div id="editor-container" style="height: 300px;"></div>
                <input type="hidden" name="content" id="content">
            </div>
            
            <div class="flex justify-end pt-4">
                <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg shadow-md transition-colors">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Materi
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Quill editor
    const quill = new Quill('#editor-container', {
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{ 'header': 1 }, { 'header': 2 }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['link', 'image', 'video'],
                ['clean']
            ]
        },
        theme: 'snow',
        placeholder: 'Tulis konten materi di sini...'
    });
    
    // Handle form submission
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        document.getElementById('content').value = quill.root.innerHTML;
    });
});
</script>
