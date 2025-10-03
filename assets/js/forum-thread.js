// Aset Academy - Forum Thread JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Initialize Quill for main reply form
    if (document.getElementById('quill-main')) {
        const quillMain = new Quill('#quill-main', {
            theme: 'snow',
            placeholder: 'Tulis komentar Anda di sini...',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline'],
                    ['link'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['clean']
                ]
            }
        });

        // Update hidden input when content changes
        quillMain.on('text-change', function() {
            const html = quillMain.root.innerHTML;
            const hiddenInput = document.getElementById('content-main-hidden');
            if (hiddenInput) {
                hiddenInput.value = html;
            }
        });

        // Validate content before form submission
        const mainForm = document.querySelector('#reply-form-main form');
        if (mainForm) {
            mainForm.addEventListener('submit', function(e) {
                const content = quillMain.getText().trim();
                if (!content) {
                    e.preventDefault();
                    alert('Komentar tidak boleh kosong');
                    return false;
                }
            });
        }
    }

    // Enhanced Viewers Modal
    const viewersModal = document.getElementById('viewers-modal');
    const openViewersModalBtn = document.getElementById('open-viewers-modal');
    const closeViewersModalBtn = document.getElementById('close-viewers-modal');

    if (openViewersModalBtn) {
        openViewersModalBtn.addEventListener('click', function() {
            const threadId = this.dataset.threadId || document.querySelector('[data-thread-id]')?.dataset.threadId;
            if (!threadId) return;

            fetch(window.siteUrl + 'forum/get_viewers/' + threadId)
                .then(response => response.json())
                .then(data => {
                    const viewersList = document.getElementById('viewers-list');
                    if (viewersList) {
                        viewersList.innerHTML = '';
                        if (data.length > 0) {
                            data.forEach((viewer, index) => {
                                const viewerEl = document.createElement('div');
                                viewerEl.className = `flex items-center space-x-4 p-4 rounded-2xl ${index % 2 === 0 ? 'bg-indigo-50' : 'bg-purple-50'} transition-all duration-200 hover:shadow-md`;
                                viewerEl.innerHTML = `
                                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center text-white font-bold text-sm shadow-lg">
                                        ${viewer.nama_lengkap.charAt(0).toUpperCase()}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="font-semibold text-gray-900">${viewer.nama_lengkap}</div>
                                        <div class="text-sm text-gray-600">${new Date(viewer.viewed_at).toLocaleString('id-ID', {
                                            year: 'numeric',
                                            month: 'long',
                                            day: 'numeric',
                                            hour: '2-digit',
                                            minute: '2-digit'
                                        })}</div>
                                    </div>
                                `;
                                viewersList.appendChild(viewerEl);
                            });
                        } else {
                            viewersList.innerHTML = '<div class="text-center py-8 text-gray-500"><i class="far fa-eye-slash text-3xl mb-2 block"></i><p>Belum ada yang melihat thread ini.</p></div>';
                        }
                    }
                    viewersModal.classList.remove('hidden');
                    viewersModal.querySelector('.modal-content').classList.add('scale-100', 'opacity-100');
                })
                .catch(error => {
                    console.error('Error fetching viewers:', error);
                });
        });
    }

    if (closeViewersModalBtn) {
        closeViewersModalBtn.addEventListener('click', function() {
            viewersModal.classList.add('hidden');
            viewersModal.querySelector('.modal-content').classList.remove('scale-100', 'opacity-100');
        });
    }

    if (viewersModal) {
        viewersModal.addEventListener('click', function(e) {
            if (e.target === viewersModal) {
                viewersModal.classList.add('hidden');
                viewersModal.querySelector('.modal-content').classList.remove('scale-100', 'opacity-100');
            }
        });
    }

    // Keyboard shortcuts
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            const modals = document.querySelectorAll('.hidden');
            modals.forEach(modal => modal.classList.add('hidden'));
        }
    });

    // Auto-scroll to reply form when reply button is clicked
    document.querySelectorAll('[onclick*="scrollIntoView"]').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('onclick').match(/'([^']+)'/)[1];
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
});

// Forum Thread Utilities
window.ForumThread = {
    // Show loading state for buttons
    showLoading: function(button) {
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        button.disabled = true;
        button.dataset.originalText = originalText;
    },

    // Hide loading state for buttons
    hideLoading: function(button) {
        if (button.dataset.originalText) {
            button.innerHTML = button.dataset.originalText;
            button.disabled = false;
        }
    },

    // Format time ago for dynamic content
    timeAgo: function(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const diffInSeconds = Math.floor((now - date) / 1000);

        if (diffInSeconds < 60) return 'baru saja';
        if (diffInSeconds < 3600) return `${Math.floor(diffInSeconds / 60)} menit yang lalu`;
        if (diffInSeconds < 86400) return `${Math.floor(diffInSeconds / 3600)} jam yang lalu`;
        return `${Math.floor(diffInSeconds / 86400)} hari yang lalu`;
    }
};
