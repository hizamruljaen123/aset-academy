<div class="min-h-screen bg-gray-50">
    <!-- Chapter Header -->
    <section class="bg-gradient-to-r from-pink-600 to-pink-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <nav class="flex mb-4" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <a href="<?= base_url('documentation') ?>" class="text-pink-200 hover:text-white inline-flex items-center">
                                    <i data-feather="home" class="w-4 h-4 mr-2"></i>
                                    Dokumentasi
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <i data-feather="chevron-right" class="w-4 h-4 text-pink-200 mx-2"></i>
                                    <span class="text-white font-medium">Bab 9</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <h1 class="text-3xl md:text-4xl font-bold mb-4">Security dan Best Practices</h1>
                    <p class="text-xl text-pink-100 max-w-3xl">Keamanan aplikasi, validasi data, dan praktik terbaik dalam pengembangan software.</p>
                </div>
                <div class="hidden md:block">
                    <i data-feather="shield" class="w-24 h-24 text-pink-200 opacity-50"></i>
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
                        <div class="bg-pink-600 h-2 rounded-full" style="width: 90%"></div>
                    </div>
                    <span class="text-sm text-gray-600">Bab 9 dari 10</span>
                </div>
                <div class="flex space-x-2">
                    <span class="px-3 py-1 bg-pink-100 text-pink-800 text-sm rounded-full">Advanced</span>
                    <span class="px-3 py-1 bg-purple-100 text-purple-800 text-sm rounded-full">25-30 menit</span>
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
                        <a href="#pengenalan-security" class="block text-sm text-gray-600 hover:text-pink-600 py-1">9.1 Pengenalan Security</a>
                        <a href="#validasi-input" class="block text-sm text-gray-600 hover:text-pink-600 py-1">9.2 Validasi dan Sanitasi Input</a>
                        <a href="#autentikasi-authorisasi" class="block text-sm text-gray-600 hover:text-pink-600 py-1">9.3 Autentikasi dan Authorisasi</a>
                        <a href="#enkripsi-security" class="block text-sm text-gray-600 hover:text-pink-600 py-1">9.4 Enkripsi dan Hashing</a>
                        <a href="#owasp-top10" class="block text-sm text-gray-600 hover:text-pink-600 py-1">9.5 OWASP Top 10</a>
                        <a href="#praktik-security" class="block text-sm text-gray-600 hover:text-pink-600 py-1">9.6 Praktik Security</a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-3 space-y-12">
                <!-- Section 9.1 -->
                <section id="pengenalan-security" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-pink-100 text-pink-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">9.1</span>
                        Pengenalan Security
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Security dalam pengembangan software adalah praktik melindungi aplikasi dari ancaman dan serangan yang dapat merusak data, mencuri informasi, atau mengganggu operasi. Keamanan harus menjadi prioritas sejak awal pengembangan.
                        </p>

                        <div class="bg-pink-50 border-l-4 border-pink-500 p-6 mb-6">
                            <h4 class="font-semibold text-pink-900 mb-2">Prinsip Security Dasar</h4>
                            <ul class="list-disc list-inside text-pink-800 space-y-1">
                                <li><strong>Confidentiality:</strong> Data hanya bisa diakses oleh yang berhak</li>
                                <li><strong>Integrity:</strong> Data tidak boleh diubah tanpa izin</li>
                                <li><strong>Availability:</strong> Sistem harus tersedia saat dibutuhkan</li>
                                <li><strong>Authentication:</strong> Memastikan identitas user</li>
                                <li><strong>Authorization:</strong> Memastikan user hanya akses yang diizinkan</li>
                            </ul>
                        </div>

                        <div class="bg-gradient-to-r from-red-50 to-pink-50 rounded-lg p-6 mb-6">
                            <h4 class="font-semibold text-gray-900 mb-4">Jenis-jenis Serangan Umum</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-white rounded-lg p-4">
                                    <h5 class="font-semibold text-red-900 mb-3 flex items-center">
                                        <i data-feather="alert-triangle" class="w-5 h-5 mr-2"></i>
                                        Injection Attacks
                                    </h5>
                                    <ul class="space-y-2 text-sm text-gray-700">
                                        <li>• SQL Injection</li>
                                        <li>• Command Injection</li>
                                        <li>• LDAP Injection</li>
                                    </ul>
                                </div>
                                
                                <div class="bg-white rounded-lg p-4">
                                    <h5 class="font-semibold text-orange-900 mb-3 flex items-center">
                                        <i data-feather="user-x" class="w-5 h-5 mr-2"></i>
                                        Authentication Attacks
                                    </h5>
                                    <ul class="space-y-2 text-sm text-gray-700">
                                        <li>• Brute Force</li>
                                        <li>• Session Hijacking</li>
                                        <li>• Credential Stuffing</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 9.2 -->
                <section id="validasi-input" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-pink-100 text-pink-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">9.2</span>
                        Validasi dan Sanitasi Input
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Validasi input adalah proses memastikan data yang masuk ke sistem sesuai dengan format dan aturan yang ditentukan. Sanitasi adalah proses membersihkan input dari karakter berbahaya.
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-blue-50 rounded-lg p-6">
                                <h4 class="font-semibold text-blue-900 mb-4">Validasi di Frontend</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div><!-- HTML5 Validation --></div>
                                    <div><form></div>
                                    <div>    <input type="email" required 
                                    <div>           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"></div>
                                    <div>    </div>
                                    <div>    <input type="number" min="1" max="100" required></div>
                                    <div>    </div>
                                    <div>    <input type="tel" pattern="[0-9]{10,12}" required></div>
                                    <div>    </div>
                                    <div>    <button type="submit">Submit</button></div>
                                    <div></form></div>
                                </div>
                            </div>

                            <div class="bg-green-50 rounded-lg p-6">
                                <h4 class="font-semibold text-green-900 mb-4">Validasi di Backend (Python)</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div>import re</div>
                                    <div></div>
                                    <div>def validate_email(email):</div>
                                    <div>    pattern = r'^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$'</div>
                                    <div>    return re.match(pattern, email) is not None</div>
                                    <div></div>
                                    <div>def validate_password(password):</div>
                                    <div>    # Minimal 8 karakter, 1 huruf besar, 1 angka</div>
                                    <div>    if len(password) < 8:</div>
                                    <div>        return False</div>
                                    <div>    if not re.search(r'[A-Z]', password):</div>
                                    <div>        return False</div>
                                    <div>    if not re.search(r'[0-9]', password):</div>
                                    <div>        return False</div>
                                    <div>    return True</div>
                                    <div></div>
                                    <div># Usage</div>
                                    <div>if validate_email("user@example.com"):</div>
                                    <div>    print("Email valid")</div>
                                </div>
                            </div>

                            <div class="bg-yellow-50 rounded-lg p-6">
                                <h4 class="font-semibold text-yellow-900 mb-4">Sanitasi Input (PHP)</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div>// Sanitasi string</div>
                                    <div>$nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);</div>
                                    <div></div>
                                    <div>// Sanitasi email</div>
                                    <div>$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);</div>
                                    <div></div>
                                    <div>// Sanitasi integer</div>
                                    <div>$umur = filter_input(INPUT_POST, 'umur', FILTER_SANITIZE_NUMBER_INT);</div>
                                    <div></div>
                                    <div>// Escape output untuk HTML</div>
                                    <div>echo htmlspecialchars($user_input, ENT_QUOTES, 'UTF-8');</div>
                                    <div></div>
                                    <div>// Prepared statements untuk SQL</div>
                                    <div>$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");</div>
                                    <div>$stmt->execute([$email]);</div>
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
                        <a href="<?= base_url('documentation/chapter8') ?>" class="text-gray-600 hover:text-gray-800 flex items-center">
                            <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i>
                            Kembali ke Bab 8
                        </a>
                    </div>
                    <div class="text-center">
                        <span class="text-sm text-gray-500">Bab 9 dari 10</span>
                        <div class="flex space-x-1 mt-1">
                            <div class="w-3 h-3 bg-pink-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-pink-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-pink-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-pink-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-pink-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-pink-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-pink-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-pink-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-pink-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-gray-300 rounded-full"></div>
                        </div>
                    </div>
                    <div>
                        <a href="<?= base_url('documentation/chapter10') ?>" class="bg-pink-600 hover:bg-pink-700 text-white px-6 py-2 rounded-lg flex items-center">
                            Lanjut ke Bab 10
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