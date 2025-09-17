<div class="min-h-screen bg-gray-50">
    <!-- Chapter Header -->
    <section class="bg-gradient-to-r from-orange-600 to-orange-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <nav class="flex mb-4" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <a href="<?= base_url('documentation') ?>" class="text-orange-200 hover:text-white inline-flex items-center">
                                    <i data-feather="home" class="w-4 h-4 mr-2"></i>
                                    Dokumentasi
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <i data-feather="chevron-right" class="w-4 h-4 text-orange-200 mx-2"></i>
                                    <span class="text-white font-medium">Bab 4</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <h1 class="text-3xl md:text-4xl font-bold mb-4">Bahasa Pemrograman Dasar</h1>
                    <p class="text-xl text-orange-100 max-w-3xl">Mengenal berbagai bahasa pemrograman dan sintaks dasar untuk memulai coding.</p>
                </div>
                <div class="hidden md:block">
                    <i data-feather="terminal" class="w-24 h-24 text-orange-200 opacity-50"></i>
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
                        <div class="bg-orange-600 h-2 rounded-full" style="width: 40%"></div>
                    </div>
                    <span class="text-sm text-gray-600">Bab 4 dari 10</span>
                </div>
                <div class="flex space-x-2">
                    <span class="px-3 py-1 bg-orange-100 text-orange-800 text-sm rounded-full">Pemula</span>
                    <span class="px-3 py-1 bg-purple-100 text-purple-800 text-sm rounded-full">30-35 menit</span>
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
                        <a href="#pengenalan-bahasa" class="block text-sm text-gray-600 hover:text-orange-600 py-1">4.1 Pengenalan Bahasa Pemrograman</a>
                        <a href="#python-dasar" class="block text-sm text-gray-600 hover:text-orange-600 py-1">4.2 Python - Sintaks Dasar</a>
                        <a href="#javascript-dasar" class="block text-sm text-gray-600 hover:text-orange-600 py-1">4.3 JavaScript - Sintaks Dasar</a>
                        <a href="#java-dasar" class="block text-sm text-gray-600 hover:text-orange-600 py-1">4.4 Java - Sintaks Dasar</a>
                        <a href="#php-dasar" class="block text-sm text-gray-600 hover:text-orange-600 py-1">4.5 PHP - Sintaks Dasar</a>
                        <a href="#memilih-bahasa" class="block text-sm text-gray-600 hover:text-orange-600 py-1">4.6 Memilih Bahasa Pemrograman</a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-3 space-y-12">
                <!-- Section 4.1 -->
                <section id="pengenalan-bahasa" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-orange-100 text-orange-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">4.1</span>
                        Pengenalan Bahasa Pemrograman
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Bahasa pemrograman adalah alat untuk berkomunikasi dengan komputer. Setiap bahasa memiliki sintaks, kelebihan, dan penggunaan yang berbeda-beda. Memilih bahasa yang tepat sangat penting untuk keberhasilan project Anda.
                        </p>

                        <div class="bg-orange-50 border-l-4 border-orange-500 p-6 mb-6">
                            <h4 class="font-semibold text-orange-900 mb-2">Kategori Bahasa Pemrograman</h4>
                            <ul class="list-disc list-inside text-orange-800 space-y-1">
                                <li><strong>High-level language:</strong> Mendekati bahasa manusia (Python, JavaScript)</li>
                                <li><strong>Low-level language:</strong> Mendekati bahasa mesin (Assembly, C)</li>
                                <li><strong>Scripting language:</strong> Untuk otomatisasi tugas (Python, Bash)</li>
                                <li><strong>Object-oriented:</strong> Berbasis objek (Java, C++)</li>
                                <li><strong>Functional:</strong> Berbasis fungsi (Haskell, Lisp)</li>
                            </ul>
                        </div>

                        <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-lg p-6 mb-6">
                            <h4 class="font-semibold text-gray-900 mb-4">Bahasa Pemrograman Populer 2024</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                <div class="bg-white rounded-lg p-4 text-center">
                                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <i data-feather="code" class="w-8 h-8 text-blue-600"></i>
                                    </div>
                                    <h5 class="font-semibold text-blue-900 mb-1">Python</h5>
                                    <p class="text-xs text-gray-600">AI/ML, Web, Data Science</p>
                                </div>
                                
                                <div class="bg-white rounded-lg p-4 text-center">
                                    <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <i data-feather="globe" class="w-8 h-8 text-yellow-600"></i>
                                    </div>
                                    <h5 class="font-semibold text-yellow-900 mb-1">JavaScript</h5>
                                    <p class="text-xs text-gray-600">Web Development</p>
                                </div>
                                
                                <div class="bg-white rounded-lg p-4 text-center">
                                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <i data-feather="coffee" class="w-8 h-8 text-red-600"></i>
                                    </div>
                                    <h5 class="font-semibold text-red-900 mb-1">Java</h5>
                                    <p class="text-xs text-gray-600">Enterprise, Android</p>
                                </div>
                                
                                <div class="bg-white rounded-lg p-4 text-center">
                                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <i data-feather="server" class="w-8 h-8 text-purple-600"></i>
                                    </div>
                                    <h5 class="font-semibold text-purple-900 mb-1">PHP</h5>
                                    <p class="text-xs text-gray-600">Web Backend</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 4.2 -->
                <section id="python-dasar" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-orange-100 text-orange-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">4.2</span>
                        Python - Sintaks Dasar
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Python adalah bahasa pemrograman yang mudah dipelajari dan powerful. Sintaksnya yang sederhana membuatnya ideal untuk pemula.
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-blue-50 rounded-lg p-6">
                                <h4 class="font-semibold text-blue-900 mb-4">Hello World dan Variabel</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div># Program sederhana Python</div>
                                    <div>print("Hello, World!")</div>
                                    <div></div>
                                    <div># Variabel dan tipe data</div>
                                    <div>nama = "Budi"  # String</div>
                                    <div>umur = 25      # Integer</div>
                                    <div>tinggi = 175.5  # Float</div>
                                    <div>is_mahasiswa = True  # Boolean</div>
                                    <div></div>
                                    <div># Output dengan f-string</div>
                                    <div>print(f"Nama: {nama}, Umur: {umur}")</div>
                                </div>
                            </div>

                            <div class="bg-green-50 rounded-lg p-6">
                                <h4 class="font-semibold text-green-900 mb-4">Struktur Kontrol</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div># If-else statement</div>
                                    <div>nilai = 85</div>
                                    <div></div>
                                    <div>if nilai >= 80:</div>
                                    <div>    print("Grade: A")</div>
                                    <div>elif nilai >= 70:</div>
                                    <div>    print("Grade: B")</div>
                                    <div>elif nilai >= 60:</div>
                                    <div>    print("Grade: C")</div>
                                    <div>else:</div>
                                    <div>    print("Grade: D")</div>
                                    <div></div>
                                    <div># Loop (perulangan)</div>
                                    <div>for i in range(5):</div>
                                    <div>    print(f"Iterasi ke-{i}")</div>
                                    <div></div>
                                    <div># While loop</div>
                                    <div>count = 0</div>
                                    <div>while count < 3:</div>
                                    <div>    print(f"Count: {count}")</div>
                                    <div>    count += 1</div>
                                </div>
                            </div>

                            <div class="bg-purple-50 rounded-lg p-6">
                                <h4 class="font-semibold text-purple-900 mb-4">Fungsi (Function)</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div># Definisi fungsi</div>
                                    <div>def luas_persegi_panjang(panjang, lebar):</div>
                                    <div>    """Menghitung luas persegi panjang"""</div>
                                    <div>    luas = panjang * lebar</div>
                                    <div>    return luas</div>
                                    <div></div>
                                    <div>def sapa(nama):</div>
                                    <div>    """Menyapa seseorang"""</div>
                                    <div>    return f"Halo, {nama}! Apa kabar?"</div>
                                    <div></div>
                                    <div># Pemanggilan fungsi</div>
                                    <div>hasil = luas_persegi_panjang(10, 5)</div>
                                    <div>print(f"Luas: {hasil}")</div>
                                    <div></div>
                                    <div>pesan = sapa("Alice")</div>
                                    <div>print(pesan)</div>
                                </div>
                            </div>

                            <div class="bg-yellow-50 rounded-lg p-6">
                                <h4 class="font-semibold text-yellow-900 mb-4">Python Data Structures</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div># List (array dinamis)</div>
                                    <div>angka = [1, 2, 3, 4, 5]</div>
                                    <div>buah = ["apel", "mangga", "jeruk"]</div>
                                    <div>buah.append("pisang")  # Tambah elemen</div>
                                    <div>print(buah[0])  # Akses elemen pertama</div>
                                    <div></div>
                                    <div># Dictionary (hash map)</div>
                                    <div>siswa = {"nama": "Budi", "umur": 20, "jurusan": "TI"}</div>
                                    <div>print(siswa["nama"])  # Akses value</div>
                                    <div>siswa["nilai"] = 85  # Tambah key-value</div>
                                    <div></div>
                                    <div># Tuple (immutable)</div>
                                    <div>koordinat = (10, 20)</div>
                                    <div>x, y = koordinat  # Unpacking</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 4.3 - JavaScript Dasar -->
                <section id="javascript-dasar" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-orange-100 text-orange-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">4.3</span>
                        JavaScript - Sintaks Dasar
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            JavaScript adalah bahasa pemrograman untuk web development. Ini adalah bahasa yang wajib dikuasai untuk frontend development dan semakin populer untuk backend (Node.js).
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-blue-50 rounded-lg p-6">
                                <h4 class="font-semibold text-blue-900 mb-4">JavaScript di Browser</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div><!-- HTML dengan JavaScript --></div>
                                    <div><!DOCTYPE html></div>
                                    <div><html></div>
                                    <div><head></div>
                                    <div>    <title>JavaScript Demo</title></div>
                                    <div></head></div>
                                    <div><body></div>
                                    <div>    <h1 id="judul">Hello World</h1></div>
                                    <div>    <button onclick="ubahTeks()">Klik Saya</button></div>
                                    <div>    </div>
                                    <div>    <script></div>
                                    <div>        function ubahTeks() {</div>
                                    <div>            document.getElementById("judul").innerHTML = "Halo JavaScript!";</div>
                                    <div>        }</div>
                                    <div>    </script></div>
                                    <div></body></div>
                                    <div></html></div>
                                </div>
                            </div>

                            <div class="bg-green-50 rounded-lg p-6">
                                <h4 class="font-semibold text-green-900 mb-4">Variabel dan Tipe Data</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div>// Variabel dengan let dan const</div>
                                    <div>let nama = "Budi";</div>
                                    <div>let umur = 25;</div>
                                    <div>const PI = 3.14;</div>
                                    <div></div>
                                    <div>// Array</div>
                                    <div>let buah = ["apel", "mangga", "jeruk"];</div>
                                    <div>buah.push("pisang");</div>
                                    <div></div>
                                    <div>// Object</div>
                                    <div>let siswa = {</div>
                                    <div>    nama: "Alice",</div>
                                    <div>    umur: 20,</div>
                                    <div>    jurusan: "TI"</div>
                                    <div>};</div>
                                    <div>console.log(siswa.nama);</div>
                                </div>
                            </div>

                            <div class="bg-purple-50 rounded-lg p-6">
                                <h4 class="font-semibold text-purple-900 mb-4">DOM Manipulation</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div>// Memilih element</div>
                                    <div>const button = document.querySelector("#myButton");</div>
                                    <div>const input = document.getElementById("namaInput");</div>
                                    <div></div>
                                    <div>// Event listener</div>
                                    <div>button.addEventListener("click", function() {</div>
                                    <div>    const nama = input.value;</div>
                                    <div>    alert(`Halo, ${nama}!`);</div>
                                    <div>});</div>
                                    <div></div>
                                    <div>// Membuat element baru</div>
                                    <div>const pBaru = document.createElement("p");</div>
                                    <div>pBaru.textContent = "Element baru ditambahkan!";</div>
                                    <div>document.body.appendChild(pBaru);</div>
                                </div>
                            </div>

                            <div class="bg-yellow-50 rounded-lg p-6">
                                <h4 class="font-semibold text-yellow-900 mb-4">Async JavaScript (Promises)</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div>// Fetch API untuk HTTP request</div>
                                    <div>fetch('https://api.example.com/data')</div>
                                    <div>    .then(response => response.json())</div>
                                    <div>    .then(data => {</div>
                                    <div>        console.log("Data diterima:", data);</div>
                                    <div>    })</div>
                                    <div>    .catch(error => {</div>
                                    <div>        console.error("Error:", error);</div>
                                    <div>    });</div>
                                    <div></div>
                                    <div>// Async/Await (ES2017)</div>
                                    <div>async function ambilData() {</div>
                                    <div>    try {</div>
                                    <div>        const response = await fetch('https://api.example.com/data');</div>
                                    <div>        const data = await response.json();</div>
                                    <div>        return data;</div>
                                    <div>    } catch (error) {</div>
                                    <div>        console.error("Error:", error);</div>
                                    <div>    }</div>
                                    <div>}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 4.4 - Java Dasar -->
                <section id="java-dasar" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-orange-100 text-orange-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">4.4</span>
                        Java - Sintaks Dasar
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Java adalah bahasa pemrograman yang strongly-typed dan platform-independent. Sangat populer untuk enterprise applications dan Android development.
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-blue-50 rounded-lg p-6">
                                <h4 class="font-semibold text-blue-900 mb-4">Struktur Dasar Java</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div>// Hello World Java</div>
                                    <div>public class HelloWorld {</div>
                                    <div>    public static void main(String[] args) {</div>
                                    <div>        System.out.println("Hello, World!");</div>
                                    <div>    }</div>
                                    <div>}</div>
                                    <div></div>
                                    <div>// Variabel dengan tipe data eksplisit</div>
                                    <div>int umur = 25;</div>
                                    <div>double tinggi = 175.5;</div>
                                    <div>String nama = "Budi";</div>
                                    <div>boolean isActive = true;</div>
                                </div>
                            </div>

                            <div class="bg-green-50 rounded-lg p-6">
                                <h4 class="font-semibold text-green-900 mb-4">OOP Concepts in Java</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div>// Class definition</div>
                                    <div>public class Mahasiswa {</div>
                                    <div>    // Fields/Attributes</div>
                                    <div>    private String nama;</div>
                                    <div>    private int umur;</div>
                                    <div>    </div>
                                    <div>    // Constructor</div>
                                    <div>    public Mahasiswa(String nama, int umur) {</div>
                                    <div>        this.nama = nama;</div>
                                    <div>        this.umur = umur;</div>
                                    <div>    }</div>
                                    <div>    </div>
                                    <div>    // Methods</div>
                                    <div>    public void displayInfo() {</div>
                                    <div>        System.out.println("Nama: " + nama);</div>
                                    <div>        System.out.println("Umur: " + umur);</div>
                                    <div>    }</div>
                                    <div>    </div>
                                    <div>    // Getter & Setter</div>
                                    <div>    public String getNama() {</div>
                                    <div>        return nama;</div>
                                    <div>    }</div>
                                    <div>}</div>
                                </div>
                            </div>

                            <div class="bg-purple-50 rounded-lg p-6">
                                <h4 class="font-semibold text-purple-900 mb-4">Collections Framework</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div>// ArrayList (dinamis array)</div>
                                    <div>List<String> buah = new ArrayList<>();</div>
                                    <div>buah.add("Apel");</div>
                                    <div>buah.add("Mangga");</div>
                                    <div>buah.add("Jeruk");</div>
                                    <div></div>
                                    <div>// HashMap (key-value pairs)</div>
                                    <div>Map<String, Integer> nilai = new HashMap<>();</div>
                                    <div>nilai.put("Matematika", 85);</div>
                                    <div>nilai.put("Fisika", 90);</div>
                                    <div></div>
                                    <div>// Iterasi</div>
                                    <div>for (String b : buah) {</div>
                                    <div>    System.out.println(b);</div>
                                    <div>}</div>
                                </div>
                            </div>

                            <div class="bg-yellow-50 rounded-lg p-6">
                                <h4 class="font-semibold text-yellow-900 mb-4">Exception Handling</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div>try {</div>
                                    <div>    int result = 10 / 0;</div>
                                    <div>    System.out.println("Hasil: " + result);</div>
                                    <div>} catch (ArithmeticException e) {</div>
                                    <div>    System.out.println("Error: Pembagian oleh nol!");</div>
                                    <div>} catch (Exception e) {</div>
                                    <div>    System.out.println("Error umum: " + e.getMessage());</div>
                                    <div>} finally {</div>
                                    <div>    System.out.println("Finally block selalu dieksekusi");</div>
                                    <div>}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 4.5 - PHP Dasar -->
                <section id="php-dasar" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-orange-100 text-orange-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">4.5</span>
                        PHP - Sintaks Dasar
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            PHP (Hypertext Preprocessor) adalah bahasa server-side yang sangat populer untuk web development. Integrasinya yang baik dengan HTML membuatnya ideal untuk membuat website dinamis.
                        </p>

                         <div class="space-y-6 mb-6">
                            <div class="bg-blue-50 rounded-lg p-6">
                                <h4 class="font-semibold text-blue-900 mb-4">PHP Basic Syntax</h4>
                                <pre class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm overflow-x-auto">
                            <code>&lt;?php
                            // Hello World PHP
                            echo "Hello, World!";

                            // Variabel (diawali dengan $)
                            $nama = "Budi";
                            $umur = 25;
                            $tinggi = 175.5;
                            $isActive = true;

                            // String interpolation
                            echo "Nama: $nama, Umur: $umur";
                            echo 'Nama: ' . $nama . ', Umur: ' . $umur;
                            ?&gt;</code>
                                </pre>
                            </div>
                            </div>

                            <div class="bg-green-50 rounded-lg p-6">
                                <h4 class="font-semibold text-green-900 mb-4">PHP Arrays</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div>// Indexed array</div>
                                    <div>$buah = array("apel", "mangga", "jeruk");</div>
                                    <div>$buah[] = "pisang"; // Tambah elemen</div>
                                    <div>echo $buah[0]; // Output: apel</div>
                                    <div></div>
                                    <div>// Associative array</div>
                                    <div>$siswa = array(</div>
                                    <div>    "nama" => "Alice",</div>
                                    <div>    "umur" => 20,</div>
                                    <div>    "jurusan" => "TI"</div>
                                    <div>);</div>
                                    <div>echo $siswa["nama"]; // Output: Alice</div>
                                    <div></div>
                                    <div>// Multidimensional array</div>
                                    <div>$kelas = array(</div>
                                    <div>    array("nama" => "Budi", "nilai" => 85),</div>
                                    <div>    array("nama" => "Ani", "nilai" => 90)</div>
                                    <div>);</div>
                                </div>
                            </div>

                            <div class="bg-purple-50 rounded-lg p-6">
  <h4 class="font-semibold text-purple-900 mb-4">Form Handling</h4>
  <pre class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm overflow-x-auto">
<code>// form.html
&lt;form method="POST" action="proses.php"&gt;
    &lt;input type="text" name="nama" placeholder="Nama"&gt;
    &lt;input type="email" name="email" placeholder="Email"&gt;
    &lt;input type="submit" value="Kirim"&gt;
&lt;/form&gt;

// proses.php
&lt;?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = htmlspecialchars($_POST["nama"]);
    $email = htmlspecialchars($_POST["email"]);

    // Validasi
    if (empty($nama) || empty($email)) {
        echo "Semua field harus diisi!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email tidak valid!";
    } else {
        echo "Halo, $nama! Email Anda: $email";
    }
}
?&gt;</code>
  </pre>
</div>

<div class="bg-yellow-50 rounded-lg p-6">
  <h4 class="font-semibold text-yellow-900 mb-4">Database Connection (MySQL)</h4>
  <pre class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm overflow-x-auto">
<code>&lt;?php
// Koneksi ke database
$host = "localhost";
$username = "root";
$password = "";
$database = "sekolah";

$conn = new mysqli($host, $username, $password, $database);

// Cek koneksi
if ($conn-&gt;connect_error) {
    die("Koneksi gagal: " . $conn-&gt;connect_error);
}

// Query data
$sql = "SELECT * FROM siswa WHERE nilai &gt; 80";
$result = $conn-&gt;query($sql);

if ($result-&gt;num_rows &gt; 0) {
    while($row = $result-&gt;fetch_assoc()) {
        echo "Nama: " . $row["nama"] . " - Nilai: " . $row["nilai"] . "&lt;br&gt;";
    }
}

$conn-&gt;close();
?&gt;</code>
  </pre>
</div>

                        </div>
                    </div>
                </section>

                <!-- Section 4.6 - Memilih Bahasa Pemrograman -->
                <section id="memilih-bahasa" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-orange-100 text-orange-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">4.6</span>
                        Memilih Bahasa Pemrograman
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Memilih bahasa pemrograman yang tepat sangat penting untuk kesuksesan karier Anda. Setiap bahasa memiliki kekuatan dan kelemahan yang berbeda.
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-blue-50 rounded-lg p-6">
                                <h4 class="font-semibold text-blue-900 mb-4">Pertimbangan Pemilihan Bahasa</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-blue-900 mb-2">Faktor Teknis</h5>
                                        <ul class="text-sm text-gray-700 space-y-1">
                                            <li>• Tujuan project (web, mobile, desktop)</li>
                                            <li>• Performance requirements</li>
                                            <li>• Ekosistem dan library</li>
                                            <li>• Learning curve</li>
                                            <li>• Community support</li>
                                        </ul>
                                    </div>
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-blue-900 mb-2">Faktor Karier</h5>
                                        <ul class="text-sm text-gray-700 space-y-1">
                                            <li>• Demand di pasar kerja</li>
                                            <li>• Gaji dan benefit</li>
                                            <li>• Growth opportunities</li>
                                            <li>• Company preferences</li>
                                            <li>• Location flexibility</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-green-50 rounded-lg p-6">
                                <h4 class="font-semibold text-green-900 mb-4">Roadmap Pembelajaran</h4>
                                <div class="bg-white rounded p-4">
                                    <ol class="list-decimal list-inside space-y-3 text-gray-700">
                                        <li><strong>Start with Python:</strong> Untuk pemula, Python adalah pilihan terbaik karena sintaks yang sederhana</li>
                                        <li><strong>Master satu bahasa:</strong> Kuasai satu bahasa sampai intermediate level sebelum pindah</li>
                                        <li><strong>Tambahkan JavaScript:</strong> Essential untuk web development</li>
                                        <li><strong>Pilih spesialisasi:</strong> Pilih bahasa sesuai dengan karier goals (Java untuk enterprise, PHP untuk web, dll)</li>
                                        <li><strong>Keep learning:</strong> Technology terus berkembang, stay updated</li>
                                    </ol>
                                </div>
                            </div>

                            <div class="bg-yellow-50 rounded-lg p-6">
                                <h4 class="font-semibold text-yellow-900 mb-4">Tips untuk Pemula</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-yellow-900 mb-2">✅ Lakukan</h5>
                                        <ul class="text-sm text-gray-700 space-y-1">
                                            <li>• Mulai dengan Python atau JavaScript</li>
                                            <li>• Fokus pada konsep, bukan syntax</li>
                                            <li>• Buat project kecil setiap minggu</li>
                                            <li>• Join komunitas dan forum</li>
                                            <li>• Read other people's code</li>
                                        </ul>
                                    </div>
                                    <div class="bg-white rounded p-4">
                                        <h5 class="font-medium text-red-900 mb-2">❌ Hindari</h5>
                                        <ul class="text-sm text-gray-700 space-y-1">
                                            <li>• Language hopping terlalu cepat</li>
                                            <li>• Tutorial hell (hanya nonton tanpa praktek)</li>
                                            <li>• Membandingkan bahasa terlalu keras</li>
                                            <li>• Menunda praktek karena "belum siap"</li>
                                            <li>• Ignoring fundamentals</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-purple-600 text-white rounded-lg p-6">
                            <h4 class="font-semibold mb-3 flex items-center">
                                <i data-feather="lightbulb" class="w-5 h-5 mr-2"></i>
                                Kesimpulan
                            </h4>
                            <p class="mb-3">Tidak ada bahasa pemrograman yang "terbaik" - yang ada adalah bahasa yang tepat untuk kebutuhan Anda. Fokuslah pada:</p>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                <div class="bg-purple-500 rounded p-3">
                                    <strong>Learning Path:</strong> Python → JavaScript → Spesialisasi
                                </div>
                                <div class="bg-purple-500 rounded p-3">
                                    <strong>Practice:</strong> Build projects, solve problems
                                </div>
                                <div class="bg-purple-500 rounded p-3">
                                    <strong>Growth:</strong> Never stop learning
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Navigation -->
                <div class="flex justify-between items-center bg-white rounded-lg shadow-md p-6">
                    <div>
                        <a href="<?= base_url('documentation/chapter3') ?>" class="text-gray-600 hover:text-gray-800 flex items-center">
                            <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i>
                            Kembali ke Bab 3
                        </a>
                    </div>
                    <div class="text-center">
                        <span class="text-sm text-gray-500">Bab 4 dari 10</span>
                        <div class="flex space-x-1 mt-1">
                            <div class="w-3 h-3 bg-orange-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-orange-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-orange-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-orange-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-orange-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-orange-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-orange-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-orange-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-gray-300 rounded-full"></div>
                        </div>
                    </div>
                    <div>
                        <a href="<?= base_url('documentation/chapter5') ?>" class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-2 rounded-lg flex items-center">
                            Lanjut ke Bab 5
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