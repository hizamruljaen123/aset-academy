<div class="min-h-screen bg-gray-50">
    <!-- Chapter Header -->
    <section class="bg-gradient-to-r from-teal-600 to-teal-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <nav class="flex mb-4" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <a href="<?= base_url('documentation') ?>" class="text-teal-200 hover:text-white inline-flex items-center">
                                    <i data-feather="home" class="w-4 h-4 mr-2"></i>
                                    Dokumentasi
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <i data-feather="chevron-right" class="w-4 h-4 text-teal-200 mx-2"></i>
                                    <span class="text-white font-medium">Bab 7</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <h1 class="text-3xl md:text-4xl font-bold mb-4">Web Development Dasar</h1>
                    <p class="text-xl text-teal-100 max-w-3xl">HTML, CSS, dan JavaScript untuk membangun website modern dan responsive.</p>
                </div>
                <div class="hidden md:block">
                    <i data-feather="globe" class="w-24 h-24 text-teal-200 opacity-50"></i>
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
                        <div class="bg-teal-600 h-2 rounded-full" style="width: 70%"></div>
                    </div>
                    <span class="text-sm text-gray-600">Bab 7 dari 10</span>
                </div>
                <div class="flex space-x-2">
                    <span class="px-3 py-1 bg-teal-100 text-teal-800 text-sm rounded-full">Menengah</span>
                    <span class="px-3 py-1 bg-cyan-100 text-cyan-800 text-sm rounded-full">35-40 menit</span>
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
                        <a href="#pengenalan-web" class="block text-sm text-gray-600 hover:text-teal-600 py-1">7.1 Pengenalan Web Development</a>
                        <a href="#html-dasar" class="block text-sm text-gray-600 hover:text-teal-600 py-1">7.2 HTML - Dasar</a>
                        <a href="#css-styling" class="block text-sm text-gray-600 hover:text-teal-600 py-1">7.3 CSS - Styling</a>
                        <a href="#javascript-interaktif" class="block text-sm text-gray-600 hover:text-teal-600 py-1">7.4 JavaScript - Interaktif</a>
                        <a href="#responsive-design" class="block text-sm text-gray-600 hover:text-teal-600 py-1">7.5 Responsive Design</a>
                        <a href="#praktik-web" class="block text-sm text-gray-600 hover:text-teal-600 py-1">7.6 Praktik Web Development</a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-3 space-y-12">
                <!-- Section 7.1 -->
                <section id="pengenalan-web" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-teal-100 text-teal-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">7.1</span>
                        Pengenalan Web Development
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Web development adalah proses membuat dan memelihatan website. Ada tiga teknologi utama yang menjadi fondasi web modern: HTML untuk struktur, CSS untuk styling, dan JavaScript untuk interaktivitas.
                        </p>

                        <div class="bg-teal-50 border-l-4 border-teal-500 p-6 mb-6">
                            <h4 class="font-semibold text-teal-900 mb-2">Jenis-jenis Web Development</h4>
                            <ul class="list-disc list-inside text-teal-800 space-y-1">
                                <li><strong>Frontend Development:</strong> Bagian yang dilihat user (HTML, CSS, JS)</li>
                                <li><strong>Backend Development:</strong> Server-side logic (PHP, Python, Node.js)</li>
                                <li><strong>Full-stack Development:</strong> Menguasai frontend dan backend</li>
                            </ul>
                        </div>

                        <div class="bg-gradient-to-r from-blue-50 to-teal-50 rounded-lg p-6 mb-6">
                            <h4 class="font-semibold text-gray-900 mb-4">Teknologi Web Modern</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="bg-white rounded-lg p-4 text-center">
                                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <i data-feather="layout" class="w-8 h-8 text-orange-600"></i>
                                    </div>
                                    <h5 class="font-semibold text-orange-900 mb-2">HTML</h5>
                                    <p class="text-sm text-gray-600">Struktur dan konten website</p>
                                </div>
                                
                                <div class="bg-white rounded-lg p-4 text-center">
                                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <i data-feather="palette" class="w-8 h-8 text-blue-600"></i>
                                    </div>
                                    <h5 class="font-semibold text-blue-900 mb-2">CSS</h5>
                                    <p class="text-sm text-gray-600">Styling dan layout</p>
                                </div>
                                
                                <div class="bg-white rounded-lg p-4 text-center">
                                    <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <i data-feather="zap" class="w-8 h-8 text-yellow-600"></i>
                                    </div>
                                    <h5 class="font-semibold text-yellow-900 mb-2">JavaScript</h5>
                                    <p class="text-sm text-gray-600">Interaktivitas dan logic</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-6 mb-6">
                            <h4 class="font-semibold text-gray-900 mb-4">Alur Kerja Web Development</h4>
                            <div class="flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0 md:space-x-4">
                                <div class="text-center">
                                    <div class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold mb-2">1</div>
                                    <h6 class="font-medium text-gray-900">Design</h6>
                                    <p class="text-xs text-gray-600">Wireframe & mockup</p>
                                </div>
                                <i data-feather="arrow-right" class="w-6 h-6 text-gray-400 hidden md:block"></i>
                                <div class="text-center">
                                    <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold mb-2">2</div>
                                    <h6 class="font-medium text-gray-900">HTML</h6>
                                    <p class="text-xs text-gray-600">Struktur konten</p>
                                </div>
                                <i data-feather="arrow-right" class="w-6 h-6 text-gray-400 hidden md:block"></i>
                                <div class="text-center">
                                    <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center text-white font-bold mb-2">3</div>
                                    <h6 class="font-medium text-gray-900">CSS</h6>
                                    <p class="text-xs text-gray-600">Styling & layout</p>
                                </div>
                                <i data-feather="arrow-right" class="w-6 h-6 text-gray-400 hidden md:block"></i>
                                <div class="text-center">
                                    <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center text-white font-bold mb-2">4</div>
                                    <h6 class="font-medium text-gray-900">JavaScript</h6>
                                    <p class="text-xs text-gray-600">Interaktivitas</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 7.2 -->
                <section id="html-dasar" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-teal-100 text-teal-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">7.2</span>
                        HTML - Dasar
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            HTML (HyperText Markup Language) adalah bahasa markup untuk membuat struktur dan konten website. HTML menggunakan tag-tag untuk mendefinisikan elemen-elemen web.
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-orange-50 rounded-lg p-6">
                                <h4 class="font-semibold text-orange-900 mb-4">Struktur Dasar HTML</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div><!DOCTYPE html></div>
                                    <div><html lang="id"></div>
                                    <div><head></div>
                                    <div>    <meta charset="UTF-8"></div>
                                    <div>    <meta name="viewport" content="width=device-width, initial-scale=1.0"></div>
                                    <div>    <title>Website Saya</title></div>
                                    <div></head></div>
                                    <div><body></div>
                                    <div>    <h1>Selamat Datang!</h1></div>
                                    <div>    <p>Ini adalah paragraf pertama saya.</p></div>
                                    <div></body></div>
                                    <div></html></div>
                                </div>
                            </div>

                            <div class="bg-blue-50 rounded-lg p-6">
                                <h4 class="font-semibold text-blue-900 mb-4">Tag HTML Penting</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-blue-900 mb-2">Heading Tags</h5>
                                        <div class="bg-gray-800 rounded p-2 text-green-400 font-mono text-xs">
                                            <div><h1>Judul Utama</h1></div>
                                            <div><h2>Sub Judul</h2></div>
                                            <div><h3>Sub-sub Judul</h3></div>
                                        </div>
                                    </div>
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-blue-900 mb-2">Text Formatting</h5>
                                        <div class="bg-gray-800 rounded p-2 text-green-400 font-mono text-xs">
                                            <div><p>Paragraf</p></div>
                                            <div><strong>Tebal</strong></div>
                                            <div><em>Miring</em></div>
                                            <div><u>Garis Bawah</u></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-green-50 rounded-lg p-6">
                                <h4 class="font-semibold text-green-900 mb-4">Form dan Input</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div><form action="/submit" method="POST"></div>
                                    <div>    <label for="nama">Nama:</label></div>
                                    <div>    <input type="text" id="nama" name="nama" required></div>
                                    <div>    </div>
                                    <div>    <label for="email">Email:</label></div>
                                    <div>    <input type="email" id="email" name="email" required></div>
                                    <div>    </div>
                                    <div>    <label for="pesan">Pesan:</label></div>
                                    <div>    <textarea id="pesan" name="pesan" rows="4"></textarea></div>
                                    <div>    </div>
                                    <div>    <button type="submit">Kirim</button></div>
                                    <div></form></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 7.3 -->
                <section id="css-styling" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-teal-100 text-teal-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">7.3</span>
                        CSS - Styling
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            CSS (Cascading Style Sheets) adalah bahasa styling untuk mengontrol tampilan dan layout website. CSS memungkinkan kita untuk memisahkan konten (HTML) dengan presentasi (styling).
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-blue-50 rounded-lg p-6">
                                <h4 class="font-semibold text-blue-900 mb-4">CSS Selector</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div>/* Element selector */</div>
                                    <div>p {</div>
                                    <div>    color: blue;</div>
                                    <div>    font-size: 16px;</div>
                                    <div>}</div>
                                    <div></div>
                                    <div>/* Class selector */</div>
                                    <div>.highlight {</div>
                                    <div>    background-color: yellow;</div>
                                    <div>    font-weight: bold;</div>
                                    <div>}</div>
                                    <div></div>
                                    <div>/* ID selector */</div>
                                    <div>#header {</div>
                                    <div>    background-color: #333;</div>
                                    <div>    color: white;</div>
                                    <div>}</div>
                                    <div></div>
                                    <div>/* Attribute selector */</div>
                                    <div>input[type="text"] {</div>
                                    <div>    border: 1px solid #ccc;</div>
                                    <div>    padding: 8px;</div>
                                    <div>}</div>
                                </div>
                            </div>

                            <div class="bg-purple-50 rounded-lg p-6">
                                <h4 class="font-semibold text-purple-900 mb-4">CSS Layout</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div>/* Flexbox */</div>
                                    <div>.container {</div>
                                    <div>    display: flex;</div>
                                    <div>    justify-content: space-between;</div>
                                    <div>    align-items: center;</div>
                                    <div>    gap: 20px;</div>
                                    <div>}</div>
                                    <div></div>
                                    <div>/* Grid */</div>
                                    <div>.grid-container {</div>
                                    <div>    display: grid;</div>
                                    <div>    grid-template-columns: repeat(3, 1fr);</div>
                                    <div>    grid-gap: 15px;</div>
                                    <div>}</div>
                                    <div></div>
                                    <div>/* Position */</div>
                                    <div>.sticky-header {</div>
                                    <div>    position: sticky;</div>
                                    <div>    top: 0;</div>
                                    <div>    z-index: 1000;</div>
                                    <div>}</div>
                                </div>
                            </div>

                            <div class="bg-pink-50 rounded-lg p-6">
                                <h4 class="font-semibold text-pink-900 mb-4">CSS Animation</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div>/* Transition */</div>
                                    <div>.button {</div>
                                    <div>    background-color: #007bff;</div>
                                    <div>    color: white;</div>
                                    <div>    padding: 10px 20px;</div>
                                    <div>    border: none;</div>
                                    <div>    border-radius: 5px;</div>
                                    <div>    transition: all 0.3s ease;</div>
                                    <div>}</div>
                                    <div></div>
                                    <div>.button:hover {</div>
                                    <div>    background-color: #0056b3;</div>
                                    <div>    transform: translateY(-2px);</div>
                                    <div>    box-shadow: 0 4px 8px rgba(0,0,0,0.2);</div>
                                    <div>}</div>
                                    <div></div>
                                    <div>/* Keyframe Animation */</div>
                                    <div>@keyframes slideIn {</div>
                                    <div>    from {</div>
                                    <div>        transform: translateX(-100%);</div>
                                    <div>        opacity: 0;</div>
                                    <div>    }</div>
                                    <div>    to {</div>
                                    <div>        transform: translateX(0);</div>
                                    <div>        opacity: 1;</div>
                                    <div>    }</div>
                                    <div>}</div>
                                    <div></div>
                                    <div>.slide-in {</div>
                                    <div>    animation: slideIn 0.5s ease-out;</div>
                                    <div>}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 7.4 -->
                <section id="javascript-interaktif" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-teal-100 text-teal-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">7.4</span>
                        JavaScript - Interaktif
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            JavaScript adalah bahasa pemrograman yang membuat website menjadi interaktif dan dinamis. Dengan JavaScript, kita dapat menambahkan logika, animasi, dan interaksi ke halaman web.
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-yellow-50 rounded-lg p-6">
                                <h4 class="font-semibold text-yellow-900 mb-4">JavaScript Dasar</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div>// Variabel dan Tipe Data</div>
                                    <div>let nama = "Ahmad";</div>
                                    <div>const umur = 25;</div>
                                    <div>let isActive = true;</div>
                                    <div>let nilai = [85, 90, 78, 92];</div>
                                    <div>let mahasiswa = {</div>
                                    <div>    nim: "123456",</div>
                                    <div>    nama: "Ahmad",</div>
                                    <div>    jurusan: "TI"</div>
                                    <div>};</div>
                                    <div></div>
                                    <div>// Fungsi</div>
                                    <div>function sapa(nama) {</div>
                                    <div>    return `Halo, ${nama}!`;</div>
                                    <div>}</div>
                                    <div></div>
                                    <div>console.log(sapa("Ahmad")); // Output: Halo, Ahmad!</div>
                                </div>
                            </div>

                            <div class="bg-orange-50 rounded-lg p-6">
                                <h4 class="font-semibold text-orange-900 mb-4">DOM Manipulation</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div>// Select elements</div>
                                    <div>const button = document.getElementById('myButton');</div>
                                    <div>const elements = document.querySelectorAll('.item');</div>
                                    <div></div>
                                    <div>// Event listeners</div>
                                    <div>button.addEventListener('click', function() {</div>
                                    <div>    alert('Button diklik!');</div>
                                    <div>});</div>
                                    <div></div>
                                    <div>// Modify content</div>
                                    <div>document.getElementById('title').textContent = 'Judul Baru';</div>
                                    <div>document.querySelector('.description').innerHTML = '<strong>Deskripsi baru</strong>';</div>
                                    <div></div>
                                    <div>// Modify styles</div>
                                    <div>document.getElementById('box').style.backgroundColor = 'blue';</div>
                                    <div>document.getElementById('box').style.display = 'none';</div>
                                </div>
                            </div>

                            <div class="bg-green-50 rounded-lg p-6">
                                <h4 class="font-semibold text-green-900 mb-4">AJAX dan Fetch API</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div>// Fetch API</div>
                                    <div>fetch('/api/mahasiswa')</div>
                                    <div>    .then(response => response.json())</div>
                                    <div>    .then(data => {</div>
                                    <div>        console.log(data);</div>
                                    <div>        tampilkanData(data);</div>
                                    <div>    })</div>
                                    <div>    .catch(error => {</div>
                                    <div>        console.error('Error:', error);</div>
                                    <div>    });</div>
                                    <div></div>
                                    <div>// Async/Await</div>
                                    <div>async function loadData() {</div>
                                    <div>    try {</div>
                                    <div>        const response = await fetch('/api/mahasiswa');</div>
                                    <div>        const data = await response.json();</div>
                                    <div>        return data;</div>
                                    <div>    } catch (error) {</div>
                                    <div>        console.error('Error:', error);</div>
                                    <div>    }</div>
                                    <div>}</div>
                                    <div></div>
                                    <div>// POST request</div>
                                    <div>fetch('/api/mahasiswa', {</div>
                                    <div>    method: 'POST',</div>
                                    <div>    headers: {</div>
                                    <div>        'Content-Type': 'application/json'</div>
                                    <div>    },</div>
                                    <div>    body: JSON.stringify({</div>
                                    <div>        nim: '123456',</div>
                                    <div>        nama: 'Ahmad'</div>
                                    <div>    })</div>
                                    <div>});</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 7.5 -->
                <section id="responsive-design" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-teal-100 text-teal-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">7.5</span>
                        Responsive Design
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Responsive design adalah pendekatan untuk membuat website yang dapat menyesuaikan tampilannya dengan berbagai ukuran layar dan perangkat.
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-indigo-50 rounded-lg p-6">
                                <h4 class="font-semibold text-indigo-900 mb-4">Media Queries</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div>/* Mobile-first approach */</div>
                                    <div>/* Default styles for mobile */</div>
                                    <div>.container {</div>
                                    <div>    width: 100%;</div>
                                    <div>    padding: 10px;</div>
                                    <div>}</div>
                                    <div></div>
                                    <div>/* Tablet */</div>
                                    <div>@media (min-width: 768px) {</div>
                                    <div>    .container {</div>
                                    <div>        width: 750px;</div>
                                    <div>        margin: 0 auto;</div>
                                    <div>    }</div>
                                    <div>}</div>
                                    <div></div>
                                    <div>/* Desktop */</div>
                                    <div>@media (min-width: 1024px) {</div>
                                    <div>    .container {</div>
                                    <div>        width: 1000px;</div>
                                    <div>    }</div>
                                    <div>}</div>
                                    <div></div>
                                    <div>/* Large desktop */</div>
                                    <div>@media (min-width: 1440px) {</div>
                                    <div>    .container {</div>
                                    <div>        width: 1200px;</div>
                                    <div>    }</div>
                                    <div>}</div>
                                </div>
                            </div>

                            <div class="bg-cyan-50 rounded-lg p-6">
                                <h4 class="font-semibold text-cyan-900 mb-4">Responsive Units</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div>/* Relative units */</div>
                                    <div>.text-responsive {</div>
                                    <div>    font-size: clamp(16px, 4vw, 24px);</div>
                                    <div>}</div>
                                    <div></div>
                                    <div>/* Viewport units */</div>
                                    <div>.hero-section {</div>
                                    <div>    height: 100vh;</div>
                                    <div>    width: 100vw;</div>
                                    <div>}</div>
                                    <div></div>
                                    <div>/* Flexible layouts */</div>
                                    <div>.flex-container {</div>
                                    <div>    display: flex;</div>
                                    <div>    flex-wrap: wrap;</div>
                                    <div>    gap: 1rem;</div>
                                    <div>}</div>
                                    <div></div>
                                    <div>.flex-item {</div>
                                    <div>    flex: 1 1 300px;</div>
                                    <div>    min-width: 250px;</div>
                                    <div>}</div>
                                </div>
                            </div>

                            <div class="bg-teal-50 rounded-lg p-6">
                                <h4 class="font-semibold text-teal-900 mb-4">Mobile-First Best Practices</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="bg-white rounded-lg p-4">
                                        <h5 class="font-semibold text-teal-900 mb-3 flex items-center">
                                            <i data-feather="smartphone" class="w-5 h-5 mr-2"></i>
                                            Mobile Optimization
                                        </h5>
                                        <ul class="space-y-2 text-sm text-gray-700">
                                            <li>• Optimasi gambar dengan srcset</li>
                                            <li>• Gunakan touch-friendly targets</li>
                                            <li>• Minimize JavaScript execution</li>
                                            <li>• Implement lazy loading</li>
                                            <li>• Test pada berbagai perangkat</li>
                                        </ul>
                                    </div>
                                    
                                    <div class="bg-white rounded-lg p-4">
                                        <h5 class="font-semibold text-teal-900 mb-3 flex items-center">
                                            <i data-feather="monitor" class="w-5 h-5 mr-2"></i>
                                            Desktop Enhancement
                                        </h5>
                                        <ul class="space-y-2 text-sm text-gray-700">
                                            <li>• Tambahkan hover effects</li>
                                            <li>• Gunakan keyboard navigation</li>
                                            <li>• Implement advanced interactions</li>
                                            <li>• Optimize for larger screens</li>
                                            <li>• Add detailed visual elements</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 7.6 -->
                <section id="praktik-web" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-teal-100 text-teal-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">7.6</span>
                        Praktik Web Development
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Praktik terbaik dalam web development sangat penting untuk menciptakan website yang scalable, maintainable, dan performa optimal.
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h4 class="font-semibold text-gray-900 mb-4">Best Practices</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="bg-white rounded-lg p-4">
                                        <h5 class="font-semibold text-gray-900 mb-3 flex items-center">
                                            <i data-feather="code" class="w-5 h-5 mr-2"></i>
                                            Coding Standards
                                        </h5>
                                        <ul class="space-y-2 text-sm text-gray-700">
                                            <li>• Gunakan semantic HTML5 tags</li>
                                            <li>• Follow BEM naming convention</li>
                                            <li>• Organize CSS with methodologies</li>
                                            <li>• Write modular JavaScript</li>
                                            <li>• Use version control (Git)</li>
                                        </ul>
                                    </div>
                                    
                                    <div class="bg-white rounded-lg p-4">
                                        <h5 class="font-semibold text-gray-900 mb-3 flex items-center">
                                            <i data-feather="shield" class="w-5 h-5 mr-2"></i>
                                            Security Practices
                                        </h5>
                                        <ul class="space-y-2 text-sm text-gray-700">
                                            <li>• Implement HTTPS</li>
                                            <li>• Validate user input</li>
                                            <li>• Use Content Security Policy</li>
                                            <li>• Prevent XSS attacks</li>
                                            <li>• Secure API endpoints</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-blue-50 rounded-lg p-6">
                                <h4 class="font-semibold text-blue-900 mb-4">Performance Optimization</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div>// Image optimization</div>
                                    <div><img src="image.jpg" </div>
                                    <div>     srcset="image-320w.jpg 320w,</div>
                                    <div>             image-640w.jpg 640w,</div>
                                    <div>             image-1024w.jpg 1024w"</div>
                                    <div>     sizes="(max-width: 320px) 280px,</div>
                                    <div>            (max-width: 640px) 600px,</div>
                                    <div>            1024px"</div>
                                    <div>     alt="Description"></div>
                                    <div></div>
                                    <div>// Lazy loading</div>
                                    <div><img src="placeholder.jpg" data-src="actual.jpg" loading="lazy"></div>
                                    <div></div>
                                    <div>// Critical CSS inline</div>
                                    <div><style></div>
                                    <div>/* Critical CSS goes here */</div>
                                    <div></style></div>
                                    <div><link rel="stylesheet" href="styles.css"></div>
                                </div>
                            </div>

                            <div class="bg-green-50 rounded-lg p-6">
                                <h4 class="font-semibold text-green-900 mb-4">Development Workflow</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div>// Project structure</div>
                                    <div>project/</div>
                                    <div>├── index.html</div>
                                    <div>├── css/</div>
                                    <div│   ├── main.css</div>
                                    <div│   ├── components/</div>
                                    <div│   │   ├── header.css</div>
                                    <div│   │   ├── navigation.css</div>
                                    <div│   │   └── footer.css</div>
                                    <div>├── js/</div>
                                    <div│   ├── main.js</div>
                                    <div│   ├── components/</div>
                                    <div│   │   ├── slider.js</div>
                                    <div│   │   └── modal.js</div>
                                    <div>├── assets/</div>
                                    <div│   ├── images/</div>
                                    <div│   └── fonts/</div>
                                    <div>└── README.md</div>
                                    <div></div>
                                    <div>// Build tools</div>
                                    <div>// npm install -g parcel</div>
                                    <div>// parcel index.html</div>
                                    <div>// npm install -g webpack</div>
                                    <div>// webpack --mode production</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Navigation -->
                <div class="flex justify-between items-center bg-white rounded-lg shadow-md p-6">
                    <div>
                        <a href="<?= base_url('documentation/chapter6') ?>" class="text-gray-600 hover:text-gray-800 flex items-center">
                            <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i>
                            Kembali ke Bab 6
                        </a>
                    </div>
                    <div class="text-center">
                        <span class="text-sm text-gray-500">Bab 7 dari 10</span>
                        <div class="flex space-x-1 mt-1">
                            <div class="w-3 h-3 bg-teal-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-teal-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-teal-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-teal-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-teal-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-teal-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-teal-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-gray-300 rounded-full"></div>
                        </div>
                    </div>
                    <div>
                        <a href="<?= base_url('documentation/chapter8') ?>" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-lg flex items-center">
                            Lanjut ke Bab 8
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