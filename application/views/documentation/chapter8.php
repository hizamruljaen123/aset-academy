<div class="min-h-screen bg-gray-50">
    <!-- Chapter Header -->
    <section class="bg-gradient-to-r from-yellow-600 to-yellow-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <nav class="flex mb-4" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <a href="<?= base_url('documentation') ?>" class="text-yellow-200 hover:text-white inline-flex items-center">
                                    <i data-feather="home" class="w-4 h-4 mr-2"></i>
                                    Dokumentasi
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <i data-feather="chevron-right" class="w-4 h-4 text-yellow-200 mx-2"></i>
                                    <span class="text-white font-medium">Bab 8</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <h1 class="text-3xl md:text-4xl font-bold mb-4">Version Control dengan Git</h1>
                    <p class="text-xl text-yellow-100 max-w-3xl">Mengelola kode dengan Git dan GitHub untuk kolaborasi tim dan version control yang efektif.</p>
                </div>
                <div class="hidden md:block">
                    <i data-feather="git-branch" class="w-24 h-24 text-yellow-200 opacity-50"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Progress Indicator -->
    <div class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-500">Progress:</span>
                    <div class="w-32 bg-gray-200 rounded-full h-2">
                        <div class="bg-yellow-600 h-2 rounded-full" style="width: 80%"></div>
                    </div>
                    <span class="text-sm text-gray-600">Bab 8 dari 10</span>
                </div>
                <div class="flex space-x-2">
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-sm rounded-full">Menengah</span>
                    <span class="px-3 py-1 bg-amber-100 text-amber-800 text-sm rounded-full">20-25 menit</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar Navigation -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                    <h3 class="font-semibold text-gray-900 mb-4">Daftar Isi</h3>
                    <nav class="space-y-2">
                        <a href="#pengenalan-git" class="block text-sm text-gray-600 hover:text-yellow-600 py-1">8.1 Pengenalan Git</a>
                        <a href="#git-basics" class="block text-sm text-gray-600 hover:text-yellow-600 py-1">8.2 Git - Dasar</a>
                        <a href="#github-remote" class="block text-sm text-gray-600 hover:text-yellow-600 py-1">8.3 GitHub dan Remote</a>
                        <a href="#branching-merging" class="block text-sm text-gray-600 hover:text-yellow-600 py-1">8.4 Branching dan Merging</a>
                        <a href="#kolaborasi-tim" class="block text-sm text-gray-600 hover:text-yellow-600 py-1">8.5 Kolaborasi Tim</a>
                        <a href="#praktik-git" class="block text-sm text-gray-600 hover:text-yellow-600 py-1">8.6 Praktik Git</a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-3 space-y-12">
                <!-- Section 8.1 -->
                <section id="pengenalan-git" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-yellow-100 text-yellow-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">8.1</span>
                        Pengenalan Git
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Git adalah sistem version control yang membantu developer melacak perubahan kode, berkolaborasi dengan tim, dan mengelola project secara efisien. Git memungkinkan Anda untuk kembali ke versi sebelumnya jika terjadi error.
                        </p>

                        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-6 mb-6">
                            <h4 class="font-semibold text-yellow-900 mb-2">Mengapa Git Penting?</h4>
                            <ul class="list-disc list-inside text-yellow-800 space-y-1">
                                <li><strong>Version Control:</strong> Melacak setiap perubahan kode</li>
                                <li><strong>Collaboration:</strong> Bekerja sama dengan developer lain</li>
                                <li><strong>Backup:</strong> Kode tersimpan di multiple lokasi</li>
                                <li><strong>Experimentation:</strong> Bebas mencoba fitur baru tanpa takut merusak yang lama</li>
                                <li><strong>History:</strong> Lihat siapa yang membuat perubahan dan kapan</li>
                            </ul>
                        </div>

                        <div class="bg-gradient-to-r from-orange-50 to-yellow-50 rounded-lg p-6 mb-6">
                            <h4 class="font-semibold text-gray-900 mb-4">Perbedaan Git vs GitHub</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-white rounded-lg p-4">
                                    <h5 class="font-semibold text-orange-900 mb-3 flex items-center">
                                        <i data-feather="git-commit" class="w-5 h-5 mr-2"></i>
                                        Git (Local)
                                    </h5>
                                    <ul class="space-y-2 text-sm text-gray-700">
                                        <li>• Sistem version control</li>
                                        <li>• Berjalan di komputer lokal</li>
                                        <li>• Command line tool</li>
                                        <li>• Gratis dan open source</li>
                                    </ul>
                                </div>
                                
                                <div class="bg-white rounded-lg p-4">
                                    <h5 class="font-semibold text-blue-900 mb-3 flex items-center">
                                        <i data-feather="github" class="w-5 h-5 mr-2"></i>
                                        GitHub (Remote)
                                    </h5>
                                    <ul class="space-y-2 text-sm text-gray-700">
                                        <li>• Hosting platform untuk Git</li>
                                        <li>• Berbasis web (cloud)</li>
                                        <li>• Interface grafis</li>
                                        <li>• Collaboration features</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 8.2 -->
                <section id="git-basics" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-yellow-100 text-yellow-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">8.2</span>
                        Git - Dasar
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Mari kita mulai dengan konfigurasi Git dan perintah-perintah dasar yang paling sering digunakan dalam pengembangan software.
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-blue-50 rounded-lg p-6">
                                <h4 class="font-semibold text-blue-900 mb-4">Instalasi dan Konfigurasi</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div># Instalasi Git</div>
                                    <div># Windows: Download dari git-scm.com</div>
                                    <div># MacOS: brew install git</div>
                                    <div># Linux: sudo apt install git</div>
                                    <div></div>
                                    <div># Konfigurasi Git</div>
                                    <div>git config --global user.name "Nama Anda"</div>
                                    <div>git config --global user.email "email@anda.com"</div>
                                    <div>git config --global init.defaultBranch main</div>
                                    <div></div>
                                    <div># Cek konfigurasi</div>
                                    <div>git config --list</div>
                                </div>
                            </div>

                            <div class="bg-green-50 rounded-lg p-6">
                                <h4 class="font-semibold text-green-900 mb-4">Git Workflow Dasar</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div># 1. Inisialisasi repository</div>
                                    <div>git init</div>
                                    <div></div>
                                    <div># 2. Cek status</div>
                                    <div>git status</div>
                                    <div></div>
                                    <div># 3. Tambahkan file ke staging</div>
                                    <div>git add nama_file.py</div>
                                    <div>git add . # Tambah semua file</div>
                                    <div></div>
                                    <div># 4. Commit perubahan</div>
                                    <div>git commit -m "Deskripsi perubahan"</div>
                                    <div></div>
                                    <div># 5. Lihat history</div>
                                    <div>git log --oneline</div>
                                </div>
                            </div>

                            <div class="bg-purple-50 rounded-lg p-6">
                                <h4 class="font-semibold text-purple-900 mb-4">Git Status File States</h4>
                                <div class="bg-white rounded p-4">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div class="text-center">
                                            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                                <i data-feather="file" class="w-6 h-6 text-red-600"></i>
                                            </div>
                                            <h5 class="font-medium text-red-900 mb-1">Untracked</h5>
                                            <p class="text-xs text-gray-600">File baru, belum di-track</p>
                                        </div>
                                        <div class="text-center">
                                            <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                                <i data-feather="clock" class="w-6 h-6 text-yellow-600"></i>
                                            </div>
                                            <h5 class="font-medium text-yellow-900 mb-1">Modified</h5>
                                            <p class="text-xs text-gray-600">File berubah, belum di-stage</p>
                                        </div>
                                        <div class="text-center">
                                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                                <i data-feather="check-circle" class="w-6 h-6 text-green-600"></i>
                                            </div>
                                            <h5 class="font-medium text-green-900 mb-1">Staged</h5>
                                            <p class="text-xs text-gray-600">Siap untuk di-commit</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 8.3 -->
                <section id="github-remote" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-yellow-100 text-yellow-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">8.3</span>
                        GitHub dan Remote
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            GitHub adalah platform hosting untuk repository Git yang memungkinkan kolaborasi tim dan backup kode di cloud. Mari kita belajar cara menghubungkan repository lokal dengan GitHub.
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-blue-50 rounded-lg p-6">
                                <h4 class="font-semibold text-blue-900 mb-4">Setup GitHub Repository</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div># 1. Buat repository di GitHub (via web)</div>
                                    <div># 2. Dapatkan URL repository</div>
                                    <div>#    Contoh: https://github.com/username/nama-repo.git</div>
                                    <div></div>
                                    <div># 3. Hubungkan repository lokal dengan remote</div>
                                    <div>git remote add origin https://github.com/username/nama-repo.git</div>
                                    <div></div>
                                    <div># 4. Push kode ke GitHub</div>
                                    <div>git push -u origin main</div>
                                    <div></div>
                                    <div># 5. Clone repository (jika belum punya lokal)</div>
                                    <div>git clone https://github.com/username/nama-repo.git</div>
                                </div>
                            </div>

                            <div class="bg-green-50 rounded-lg p-6">
                                <h4 class="font-semibold text-green-900 mb-4">Workflow dengan Remote</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div># Sinkronisasi dengan remote</div>
                                    <div>git pull origin main  # Download perubahan terbaru</div>
                                    <div>git push origin main  # Upload perubahan lokal</div>
                                    <div></div>
                                    <div># Lihat remote repositories</div>
                                    <div>git remote -v</div>
                                    <div></div>
                                    <div># Hapus remote</div>
                                    <div>git remote remove origin</div>
                                    <div></div>
                                    <div># Tambah remote baru</div>
                                    <div>git remote add origin https://github.com/username/repo-baru.git</div>
                                </div>
                            </div>

                            <div class="bg-yellow-50 rounded-lg p-6">
                                <h4 class="font-semibold text-yellow-900 mb-4">GitHub Features Penting</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-yellow-900 mb-2">Issues</h5>
                                        <p class="text-sm text-gray-600">Pelacakan bug dan fitur request</p>
                                    </div>
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-yellow-900 mb-2">Pull Requests</h5>
                                        <p class="text-sm text-gray-600">Review kode sebelum merge</p>
                                    </div>
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-yellow-900 mb-2">Wiki</h5>
                                        <p class="text-sm text-gray-600">Dokumentasi project</p>
                                    </div>
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-yellow-900 mb-2">Actions</h5>
                                        <p class="text-sm text-gray-600">Automation dan CI/CD</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Continue with more sections... -->
                <!-- I'll add the remaining sections in a similar pattern -->

                <!-- Navigation -->
                <div class="flex justify-between items-center bg-white rounded-lg shadow-md p-6">
                    <div>
                        <a href="<?= base_url('documentation/chapter7') ?>" class="text-gray-600 hover:text-gray-800 flex items-center">
                            <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i>
                            Kembali ke Bab 7
                        </a>
                    </div>
                    <div class="text-center">
                        <span class="text-sm text-gray-500">Bab 8 dari 10</span>
                        <div class="flex space-x-1 mt-1">
                            <div class="w-3 h-3 bg-yellow-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-yellow-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-yellow-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-yellow-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-yellow-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-yellow-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-yellow-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-yellow-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-gray-300 rounded-full"></div>
                        </div>
                    </div>
                    <div>
                        <a href="<?= base_url('documentation/chapter9') ?>" class="bg-yellow-600 hover:bg-yellow-700 text-white px-6 py-2 rounded-lg flex items-center">
                            Lanjut ke Bab 9
                            <i data-feather="arrow-right" class="w-4 h-4 ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Initialize Feather Icons -->
    <script>
        feather.replace();
    </script>