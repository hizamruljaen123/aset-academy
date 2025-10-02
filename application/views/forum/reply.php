<?php $this->load->view('forum/viewers_modal'); ?>

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-2 md:space-x-4 bg-white/80 backdrop-blur-sm rounded-xl p-3 shadow-sm border border-white/20">
                <li class="inline-flex items-center">
                    <a href="<?php echo site_url('forum'); ?>" class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-700 transition-colors duration-300">
                        <i class="fas fa-home mr-2 text-indigo-500"></i>
                        Forum
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 text-sm mx-2"></i>
                        <a href="<?php echo site_url('forum/category/' . $category->slug); ?>" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700 transition-colors duration-300">
                            <?php echo html_escape($category->name); ?>
                        </a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 text-sm mx-2"></i>
                        <a href="<?php echo site_url('forum/thread/' . $thread->id); ?>" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700 transition-colors duration-300">
                            <?php echo html_escape($thread->title); ?>
                        </a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 text-sm mx-2"></i>
                        <span class="text-sm font-semibold text-gray-700 bg-gradient-to-r from-indigo-100 to-purple-100 px-3 py-1 rounded-full">Balas Komentar</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Original Post -->
        <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-xl overflow-hidden mb-8 border border-white/20">
            <div class="px-8 py-6 border-b border-gray-200/50">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                    <i class="far fa-comment mr-3 text-indigo-600"></i>
                    <span>Komentar yang Dibalas</span>
                </h2>
            </div>
            <div class="px-8 py-6">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white font-bold text-lg shadow-lg">
                            <?= strtoupper(substr(($post->nama_lengkap ?? 'U'), 0, 1)); ?>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center space-x-3 mb-2">
                            <h4 class="font-semibold text-gray-900"><?php echo html_escape($post->nama_lengkap ?? 'User Tidak Dikenal'); ?></h4>
                            <time class="text-sm text-gray-500" datetime="<?php echo $post->created_at; ?>">
                                <?php echo timespan(strtotime($post->created_at), time()) . ' yang lalu'; ?>
                            </time>
                        </div>
                        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                            <?php echo $post->content; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reply Form -->
        <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-xl overflow-hidden border border-white/20">
            <div class="px-8 py-6 border-b border-gray-200/50">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                    <i class="far fa-reply mr-3 text-indigo-600"></i>
                    <span>Tulis Balasan</span>
                </h2>
            </div>
            <div class="px-8 py-6">
                <?php echo form_open('forum/create_post/' . $thread->id, ['class' => 'space-y-4']); ?>
                    <input type="hidden" name="parent_id" value="<?php echo $post->id; ?>">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                <?= strtoupper(substr(($this->session->userdata('nama_lengkap') ?? 'U'), 0, 1)); ?>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="mb-4">
                                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Balasan Anda</label>
                                <textarea id="content" name="content" rows="8" class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 resize-vertical" placeholder="Tulis balasan Anda di sini..." required></textarea>
                            </div>
                            <div class="flex justify-end space-x-3">
                                <a href="<?php echo site_url('forum/thread/' . $thread->id); ?>" class="px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200">
                                    Batal
                                </a>
                                <button type="submit" class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl shadow-lg hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 transition-all duration-300 transform hover:scale-105">
                                    <i class="far fa-paper-plane mr-2"></i>
                                    Kirim Balasan
                                </button>
                            </div>
                        </div>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

* {
    font-family: 'Inter', sans-serif;
}

body {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    min-height: 100vh;
}

.prose {
    color: #475569;
    line-height: 1.7;
}

.prose h1, .prose h2, .prose h3 {
    color: #1e293b;
    font-weight: 700;
}

.prose p {
    margin-bottom: 1rem;
    color: #64748b;
}

/* Enhanced Scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: rgba(248, 250, 252, 0.5);
    border-radius: 12px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(45deg, #6366f1, #a855f7);
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(45deg, #4f46e5, #9333ea);
}

/* Glassmorphism */
.glass {
    background: rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.18);
}

/* Animations */
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-8px); }
}

.float-animation {
    animation: float 4s ease-in-out infinite;
}

@keyframes pulse-glow {
    0%, 100% { box-shadow: 0 0 0 0 rgba(99, 102, 241, 0.4); }
    50% { box-shadow: 0 0 0 20px rgba(99, 102, 241, 0); }
}

/* Card Hover Effects */
.hover\:shadow-2xl:hover {
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    transform: translateY(-4px);
}

/* Button Enhancements */
button {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

button::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.6s;
}

button:hover::before {
    left: 100%;
}

/* Form Focus States */
input:focus, textarea:focus {
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    border-color: #6366f1;
    transform: translateY(-1px);
}

/* Responsive */
@media (max-width: 768px) {
    .container {
        padding-left: 1.5rem;
        padding-right: 1.5rem;
    }

    .prose {
        font-size: 0.95rem;
    }

    h1 {
        font-size: 2rem;
    }
}

/* Dark Mode */
@media (prefers-color-scheme: dark) {
    body {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        color: #f1f5f9;
    }

    .glass {
        background: rgba(15, 23, 42, 0.5);
        border: 1px solid rgba(148, 163, 184, 0.2);
        color: #f1f5f9;
    }

    .prose {
        color: #cbd5e1;
    }

    .prose h1, .prose h2, .prose h3 {
        color: #f8fafc;
    }
}
</style>
