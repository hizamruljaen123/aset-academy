<div class="min-h-screen bg-gray-50">
    <!-- Chapter Header -->
    <section class="bg-gradient-to-r from-red-600 to-red-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <nav class="flex mb-4" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <a href="<?= base_url('documentation') ?>" class="text-red-200 hover:text-white inline-flex items-center">
                                    <i data-feather="home" class="w-4 h-4 mr-2"></i>
                                    Dokumentasi
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <i data-feather="chevron-right" class="w-4 h-4 text-red-200 mx-2"></i>
                                    <span class="text-white font-medium">Bab 5</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <h1 class="text-3xl md:text-4xl font-bold mb-4">Struktur Data Dasar</h1>
                    <p class="text-xl text-red-100 max-w-3xl">Memahami array, list, stack, queue, dan struktur data fundamental lainnya.</p>
                </div>
                <div class="hidden md:block">
                    <i data-feather="database" class="w-24 h-24 text-red-200 opacity-50"></i>
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
                        <div class="bg-red-600 h-2 rounded-full" style="width: 50%"></div>
                    </div>
                    <span class="text-sm text-gray-600">Bab 5 dari 10</span>
                </div>
                <div class="flex space-x-2">
                    <span class="px-3 py-1 bg-red-100 text-red-800 text-sm rounded-full">Pemula</span>
                    <span class="px-3 py-1 bg-indigo-100 text-indigo-800 text-sm rounded-full">25-30 menit</span>
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
                        <a href="#pengenalan-struktur-data" class="block text-sm text-gray-600 hover:text-red-600 py-1">5.1 Pengenalan Struktur Data</a>
                        <a href="#array-list" class="block text-sm text-gray-600 hover:text-red-600 py-1">5.2 Array dan List</a>
                        <a href="#stack-queue" class="block text-sm text-gray-600 hover:text-red-600 py-1">5.3 Stack dan Queue</a>
                        <a href="#dictionary-map" class="block text-sm text-gray-600 hover:text-red-600 py-1">5.4 Dictionary dan Map</a>
                        <a href="#tree-graph" class="block text-sm text-gray-600 hover:text-red-600 py-1">5.5 Tree dan Graph</a>
                        <a href="#praktik-struktur-data" class="block text-sm text-gray-600 hover:text-red-600 py-1">5.6 Praktik Struktur Data</a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-3 space-y-12">
                <!-- Section 5.1 -->
                <section id="pengenalan-struktur-data" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-red-100 text-red-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">5.1</span>
                        Pengenalan Struktur Data
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Struktur data adalah cara menyimpan dan mengorganisasi data dalam komputer agar dapat digunakan secara efisien. Pemilihan struktur data yang tepat sangat penting untuk performa program.
                        </p>

                        <div class="bg-red-50 border-l-4 border-red-500 p-6 mb-6">
                            <h4 class="font-semibold text-red-900 mb-2">Mengapa Struktur Data Penting?</h4>
                            <ul class="list-disc list-inside text-red-800 space-y-1">
                                <li><strong>Efisiensi:</strong> Menggunakan memori secara optimal</li>
                                <li><strong>Kecepatan:</strong> Akses dan manipulasi data lebih cepat</li>
                                <li><strong>Organisasi:</strong> Data terstruktur dan mudah dikelola</li>
                                <li><strong>Skalabilitas:</strong> Menangani data dalam jumlah besar</li>
                                <li><strong>Algoritma:</strong> Dasar dari algoritma yang efisien</li>
                            </ul>
                        </div>

                        <div class="bg-gradient-to-r from-blue-50 to-red-50 rounded-lg p-6 mb-6">
                            <h4 class="font-semibold text-gray-900 mb-4">Klasifikasi Struktur Data</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-white rounded-lg p-4">
                                    <h5 class="font-semibold text-blue-900 mb-3 flex items-center">
                                        <i data-feather="list" class="w-5 h-5 mr-2"></i>
                                        Linear Data Structures
                                    </h5>
                                    <ul class="space-y-2 text-sm text-gray-700">
                                        <li>• Array</li>
                                        <li>• Linked List</li>
                                        <li>• Stack</li>
                                        <li>• Queue</li>
                                    </ul>
                                </div>
                                
                                <div class="bg-white rounded-lg p-4">
                                    <h5 class="font-semibold text-green-900 mb-3 flex items-center">
                                        <i data-feather="git-branch" class="w-5 h-5 mr-2"></i>
                                        Non-Linear Data Structures
                                    </h5>
                                    <ul class="space-y-2 text-sm text-gray-700">
                                        <li>• Tree</li>
                                        <li>• Graph</li>
                                        <li>• Hash Table</li>
                                        <li>• Heap</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 5.2 -->
                <section id="array-list" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-red-100 text-red-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">5.2</span>
                        Array dan List
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Array adalah struktur data yang menyimpan elemen-elemen dengan tipe data yang sama dalam lokasi memori yang berurutan. List adalah struktur data yang lebih fleksibel yang dapat menyimpan elemen dengan tipe data berbeda.
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-blue-50 rounded-lg p-6">
                                <h4 class="font-semibold text-blue-900 mb-4">Operasi Dasar Array</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div># Array dalam Python</div>
                                    <div>angka = [10, 20, 30, 40, 50]</div>
                                    <div>nama = ["Alice", "Bob", "Charlie"]</div>
                                    <div></div>
                                    <div># Akses elemen</div>
                                    <div>print(angka[0])  # Output: 10</div>
                                    <div>print(nama[2])   # Output: Charlie</div>
                                    <div></div>
                                    <div># Modifikasi elemen</div>
                                    <div>angka[1] = 25</div>
                                    <div>print(angka)     # Output: [10, 25, 30, 40, 50]</div>
                                    <div></div>
                                    <div># Menambah elemen</div>
                                    <div>angka.append(60)</div>
                                    <div>nama.insert(1, "David")</div>
                                    <div></div>
                                    <div># Menghapus elemen</div>
                                    <div>angka.remove(30)</div>
                                    <div>del nama[0]</div>
                                </div>
                            </div>

                            <div class="bg-green-50 rounded-lg p-6">
                                <h4 class="font-semibold text-green-900 mb-4">Multidimensional Array</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div># Matrix 3x3</div>
                                    <div>matrix = [</div>
                                    <div>    [1, 2, 3],</div>
                                    <div>    [4, 5, 6],</div>
                                    <div>    [7, 8, 9]</div>
                                    <div>]</div>
                                    <div></div>
                                    <div># Akses elemen matrix</div>
                                    <div>print(matrix[0][0])  # Output: 1</div>
                                    <div>print(matrix[1][2])  # Output: 6</div>
                                    <div>print(matrix[2][1])  # Output: 8</div>
                                    <div></div>
                                    <div># Iterasi through matrix</div>
                                    <div>for row in matrix:</div>
                                    <div>    for col in row:</div>
                                    <div>        print(col, end=" ")</div>
                                    <div>    print()</div>
                                </div>
                            </div>

                            <div class="bg-purple-50 rounded-lg p-6">
                                <h4 class="font-semibold text-purple-900 mb-4">Array Operations</h4>
                                <div class="bg-white rounded p-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <h5 class="font-medium text-purple-900 mb-2">Searching</h5>
                                            <div class="bg-gray-800 rounded p-2 text-green-400 font-mono text-xs">
                                                <div>angka = [10, 20, 30, 40, 50]</div>
                                                <div>if 30 in angka:</div>
                                                <div>    print("Ditemukan!")</div>
                                                <div></div>
                                                <div># Linear search</div>
                                                <div>for i, val in enumerate(angka):</div>
                                                <div>    if val == 30:</div>
                                                <div>        print(f"Index: {i}")</div>
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="font-medium text-purple-900 mb-2">Sorting</h5>
                                            <div class="bg-gray-800 rounded p-2 text-green-400 font-mono text-xs">
                                                <div>angka = [50, 20, 40, 10, 30]</div>
                                                <div></div>
                                                <div># Sort ascending</div>
                                                <div>angka.sort()</div>
                                                <div>print(angka)  # [10, 20, 30, 40, 50]</div>
                                                <div></div>
                                                <div># Sort descending</div>
                                                <div>angka.sort(reverse=True)</div>
                                                <div>print(angka)  # [50, 40, 30, 20, 10]</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 5.3 -->
                <section id="stack-queue" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-red-100 text-red-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">5.3</span>
                        Stack dan Queue
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Stack dan Queue adalah struktur data linear yang mengikuti prinsip tertentu dalam penambahan dan penghapusan elemen.
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-orange-50 rounded-lg p-6">
                                <h4 class="font-semibold text-orange-900 mb-4">Stack (LIFO - Last In First Out)</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div># Stack dalam Python</div>
                                    <div>stack = []</div>
                                    <div></div>
                                    <div># Push - menambah elemen</div>
                                    <div>stack.append("A")</div>
                                    <div>stack.append("B")</div>
                                    <div>stack.append("C")</div>
                                    <div>print(stack)  # Output: ['A', 'B', 'C']</div>
                                    <div></div>
                                    <div># Pop - mengambil elemen terakhir</div>
                                    <div>item = stack.pop()</div>
                                    <div>print(f"Diambil: {item}")  # Output: C</div>
                                    <div>print(stack)  # Output: ['A', 'B']</div>
                                    <div></div>
                                    <div># Peek - melihat elemen terakhir</div>
                                    <div>if stack:</div>
                                    <div>    print(f"Elemen terakhir: {stack[-1]}")  # Output: B</div>
                                </div>
                            </div>

                            <div class="bg-teal-50 rounded-lg p-6">
                                <h4 class="font-semibold text-teal-900 mb-4">Queue (FIFO - First In First Out)</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div># Queue menggunakan collections.deque</div>
                                    <div>from collections import deque</div>
                                    <div>queue = deque()</div>
                                    <div></div>
                                    <div># Enqueue - menambah elemen</div>
                                    <div>queue.append("Pertama")</div>
                                    <div>queue.append("Kedua")</div>
                                    <div>queue.append("Ketiga")</div>
                                    <div>print(list(queue))  # Output: ['Pertama', 'Kedua', 'Ketiga']</div>
                                    <div></div>
                                    <div># Dequeue - mengambil elemen pertama</div>
                                    <div>item = queue.popleft()</div>
                                    <div>print(f"Diambil: {item}")  # Output: Pertama</div>
                                    <div>print(list(queue))  # Output: ['Kedua', 'Ketiga']</div>
                                </div>
                            </div>

                            <div class="bg-indigo-50 rounded-lg p-6">
                                <h4 class="font-semibold text-indigo-900 mb-4">Aplikasi Stack dan Queue</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="bg-white rounded-lg p-4">
                                        <h5 class="font-semibold text-orange-900 mb-3 flex items-center">
                                            <i data-feather="layers" class="w-5 h-5 mr-2"></i>
                                            Stack Applications
                                        </h5>
                                        <ul class="space-y-2 text-sm text-gray-700">
                                            <li>• Undo/Redo functionality</li>
                                            <li>• Browser back/forward buttons</li>
                                            <li>• Function call stack</li>
                                            <li>• Expression evaluation (postfix, prefix)</li>
                                            <li>• Backtracking algorithms</li>
                                        </ul>
                                    </div>
                                    
                                    <div class="bg-white rounded-lg p-4">
                                        <h5 class="font-semibold text-teal-900 mb-3 flex items-center">
                                            <i data-feather="activity" class="w-5 h-5 mr-2"></i>
                                            Queue Applications
                                        </h5>
                                        <ul class="space-y-2 text-sm text-gray-700">
                                            <li>• Print queue management</li>
                                            <li>• CPU scheduling</li>
                                            <li>• Message queuing systems</li>
                                            <li>• Breadth-first search (BFS)</li>
                                            <li>• Customer service systems</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 5.4 -->
                <section id="dictionary-map" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-red-100 text-red-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">5.4</span>
                        Dictionary dan Map
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Dictionary dan Map adalah struktur data yang menyimpan data dalam pasangan key-value, memungkinkan akses data yang sangat cepat berdasarkan kunci.
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-yellow-50 rounded-lg p-6">
                                <h4 class="font-semibold text-yellow-900 mb-4">Dictionary Operations</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div># Dictionary dalam Python</div>
                                    <div>student = {</div>
                                    <div>    "name": "Alice",</div>
                                    <div>    "age": 20,</div>
                                    <div>    "major": "Computer Science"</div>
                                    <div>}</div>
                                    <div></div>
                                    <div># Akses nilai</div>
                                    <div>print(student["name"])  # Output: Alice</div>
                                    <div>print(student.get("age"))  # Output: 20</div>
                                    <div></div>
                                    <div># Menambah/mengubah nilai</div>
                                    <div>student["gpa"] = 3.8</div>
                                    <div>student["age"] = 21</div>
                                    <div></div>
                                    <div># Menghapus item</div>
                                    <div>del student["major"]</div>
                                    <div>student.pop("gpa")</div>
                                    <div></div>
                                    <div># Iterasi</div>
                                    <div>for key, value in student.items():</div>
                                    <div>    print(f"{key}: {value}")</div>
                                </div>
                            </div>

                            <div class="bg-pink-50 rounded-lg p-6">
                                <h4 class="font-semibold text-pink-900 mb-4">Map Operations</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div># Map dalam JavaScript</div>
                                    <div>const userMap = new Map();</div>
                                    <div></div>
                                    <div># Set pasangan key-value</div>
                                    <div>userMap.set("id", 12345);</div>
                                    <div>userMap.set("username", "john_doe");</div>
                                    <div>userMap.set("email", "john@example.com");</div>
                                    <div></div>
                                    <div># Mendapatkan nilai</div>
                                    <div>console.log(userMap.get("username"));  // Output: john_doe</div>
                                    <div>console.log(userMap.has("email"));    // Output: true</div>
                                    <div></div>
                                    <div># Ukuran map</div>
                                    <div>console.log(userMap.size);  // Output: 3</div>
                                    <div></div>
                                    <div># Iterasi</div>
                                    <div>for (const [key, value] of userMap) {</div>
                                    <div>    console.log(`${key}: ${value}`);</div>
                                    <div>}</div>
                                </div>
                            </div>

                            <div class="bg-purple-50 rounded-lg p-6">
                                <h4 class="font-semibold text-purple-900 mb-4">Hash Table Implementation</h4>
                                <div class="bg-white rounded p-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <h5 class="font-medium text-purple-900 mb-2">Hash Functions</h5>
                                            <div class="bg-gray-800 rounded p-2 text-green-400 font-mono text-xs">
                                                <div>def simple_hash(key):</div>
                                                <div>    hash_value = 0</div>
                                                <div>    for char in str(key):</div>
                                                <div>        hash_value += ord(char)</div>
                                                <div>    return hash_value % 1000</div>
                                                <div></div>
                                                <div># Contoh penggunaan</div>
                                                <div>print(simple_hash("apple"))   # Output: 532</div>
                                                <div>print(simple_hash("banana"))  # Output: 341</div>
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="font-medium text-purple-900 mb-2">Collision Handling</h5>
                                            <div class="bg-gray-800 rounded p-2 text-green-400 font-mono text-xs">
                                                <div># Chaining approach</div>
                                                <div>class HashTable:</div>
                                                <div>    def __init__(self, size):</div>
                                                <div>        self.size = size</div>
                                                <div>        self.table = [[] for _ in range(size)]</div>
                                                <div>    </div>
                                                <div>    def insert(self, key, value):</div>
                                                <div>        index = hash(key) % self.size</div>
                                                <div>        self.table[index].append((key, value))</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 5.5 -->
                <section id="tree-graph" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-red-100 text-red-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">5.5</span>
                        Tree dan Graph
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Tree dan Graph adalah struktur data non-linear yang mampu merepresentasikan hubungan yang kompleks antar elemen.
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-green-50 rounded-lg p-6">
                                <h4 class="font-semibold text-green-900 mb-4">Binary Tree</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div># Binary Tree Node</div>
                                    <div>class TreeNode:</div>
                                    <div>    def __init__(self, value):</div>
                                    <div>        self.value = value</div>
                                    <div>        self.left = None</div>
                                    <div>        self.right = None</div>
                                    <div></div>
                                    <div># Membinary tree</div>
                                    <div>root = TreeNode(1)</div>
                                    <div>root.left = TreeNode(2)</div>
                                    <div>root.right = TreeNode(3)</div>
                                    <div>root.left.left = TreeNode(4)</div>
                                    <div>root.left.right = TreeNode(5)</div>
                                    <div></div>
                                    <div># In-order traversal</div>
                                    <div>def inorder(node):</div>
                                    <div>    if node:</div>
                                    <div>        inorder(node.left)</div>
                                    <div>        print(node.value, end=" ")</div>
                                    <div>        inorder(node.right)</div>
                                    <div></div>
                                    <div># Output: 4 2 5 1 3</div>
                                </div>
                            </div>

                            <div class="bg-blue-50 rounded-lg p-6">
                                <h4 class="font-semibold text-blue-900 mb-4">Graph Representation</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div># Graph menggunakan adjacency list</div>
                                    <div>class Graph:</div>
                                    <div>    def __init__(self):</div>
                                    <div>        self.adjacency_list = {}</div>
                                    <div>    </div>
                                    <div>    def add_vertex(self, vertex):</div>
                                    <div>        if vertex not in self.adjacency_list:</div>
                                    <div>            self.adjacency_list[vertex] = []</div>
                                    <div>    </div>
                                    <div>    def add_edge(self, vertex1, vertex2):</div>
                                    <div>        self.adjacency_list[vertex1].append(vertex2)</div>
                                    <div>        self.adjacency_list[vertex2].append(vertex1)</div>
                                    <div></div>
                                    <div># Contoh penggunaan</div>
                                    <div>graph = Graph()</div>
                                    <div>graph.add_vertex("A")</div>
                                    <div>graph.add_vertex("B")</div>
                                    <div>graph.add_vertex("C")</div>
                                    <div>graph.add_edge("A", "B")</div>
                                    <div>graph.add_edge("B", "C")</div>
                                </div>
                            </div>

                            <div class="bg-cyan-50 rounded-lg p-6">
                                <h4 class="font-semibold text-cyan-900 mb-4">Tree and Graph Algorithms</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="bg-white rounded-lg p-4">
                                        <h5 class="font-semibold text-green-900 mb-3 flex items-center">
                                            <i data-feather="git-branch" class="w-5 h-5 mr-2"></i>
                                            Tree Traversal
                                        </h5>
                                        <ul class="space-y-2 text-sm text-gray-700">
                                            <li>• In-order: Left → Root → Right</li>
                                            <li>• Pre-order: Root → Left → Right</li>
                                            <li>• Post-order: Left → Right → Root</li>
                                            <li>• Level-order: BFS approach</li>
                                            <li>• Applications: Expression trees, BST operations</li>
                                        </ul>
                                    </div>
                                    
                                    <div class="bg-white rounded-lg p-4">
                                        <h5 class="font-semibold text-blue-900 mb-3 flex items-center">
                                            <i data-feather="share-2" class="w-5 h-5 mr-2"></i>
                                            Graph Algorithms
                                        </h5>
                                        <ul class="space-y-2 text-sm text-gray-700">
                                            <li>• BFS: Breadth-First Search</li>
                                            <li>• DFS: Depth-First Search</li>
                                            <li>• Dijkstra: Shortest path</li>
                                            <li>• A*: Pathfinding algorithm</li>
                                            <li>• Topological Sort: DAG ordering</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 5.6 -->
                <section id="praktik-struktur-data" class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="bg-red-100 text-red-800 text-sm font-semibold px-3 py-1 rounded-full mr-3">5.6</span>
                        Praktik Struktur Data
                    </h2>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            Memahami kapan dan bagaimana menggunakan struktur data yang tepat adalah kunci untuk menulis kode yang efisien dan scalable.
                        </p>

                        <div class="space-y-6 mb-6">
                            <div class="bg-red-50 rounded-lg p-6">
                                <h4 class="font-semibold text-red-900 mb-4">Pemilihan Struktur Data yang Tepat</h4>
                                <div class="bg-white rounded p-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <h5 class="font-medium text-red-900 mb-3">Kriteria Pemilihan</h5>
                                            <ul class="space-y-2 text-sm text-gray-700">
                                                <li>• <strong>Jenis operasi:</strong> Insert, delete, search, access</li>
                                                <li>• <strong>Frekuensi operasi:</strong> Sering jarangnya operasi tertentu</li>
                                                <li>• <strong>Ukuran data:</strong> Jumlah elemen yang akan disimpan</li>
                                                <li>• <strong>Memori:</strong> Ketersediaan memori</li>
                                                <li>• <strong>Performa:</strong> Waktu eksekusi yang dibutuhkan</li>
                                            </ul>
                                        </div>
                                        <div>
                                            <h5 class="font-medium text-red-900 mb-3">Use Cases</h5>
                                            <ul class="space-y-2 text-sm text-gray-700">
                                                <li>• <strong>Array:</strong> Data statis, akses acak cepat</li>
                                                <li>• <strong>Linked List:</strong> Insert/delete di tengah</li>
                                                <li>• <strong>Hash Table:</strong> Pencarian cepat O(1)</li>
                                                <li>• <strong>Tree:</strong> Data terstruktur, pencarian efisien</li>
                                                <li>• <strong>Graph:</strong> Hubungan kompleks</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-6">
                                <h4 class="font-semibold text-gray-900 mb-4">Best Practices</h4>
                                <div class="bg-gray-800 rounded p-4 text-green-400 font-mono text-sm">
                                    <div># Contoh implementasi yang baik</div>
                                    <div>class StudentDatabase:</div>
                                    <div>    def __init__(self):</div>
                                    <div>        # Gunakan dictionary untuk akses cepat berdasarkan NIM</div>
                                    <div>        self.students_by_id = {}</div>
                                    <div>        # Gunakan list untuk urutan mahasiswa</div>
                                    <div>        self.students_list = []</div>
                                    <div>        # Gunakan set untuk cek keanggotaan cepat</div>
                                    <div>        self.active_students = set()</div>
                                    <div></div>
                                    <div>    def add_student(self, student):</div>
                                    <div>        self.students_by_id[student.id] = student</div>
                                    <div>        self.students_list.append(student)</div>
                                    <div>        self.active_students.add(student.id)</div>
                                    <div></div>
                                    <div>    def get_student_by_id(self, student_id):</div>
                                    <div>        return self.students_by_id.get(student_id)  # O(1) access</div>
                                    <div></div>
                                    <div>    def is_student_active(self, student_id):</div>
                                    <div>        return student_id in self.active_students  # O(1) check</div>
                                </div>
                            </div>

                            <div class="bg-yellow-50 rounded-lg p-6">
                                <h4 class="font-semibold text-yellow-900 mb-4">Common Pitfalls</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="bg-white rounded-lg p-4">
                                        <h5 class="font-semibold text-yellow-900 mb-3 flex items-center">
                                            <i data-feather="alert-triangle" class="w-5 h-5 mr-2"></i>
                                            Kesalahan Umum
                                        </h5>
                                        <ul class="space-y-2 text-sm text-gray-700">
                                            <li>• Menggunakan array untuk pencarian yang sering</li>
                                            <li>• Menggunakan linked list untuk akses acak</li>
                                            <li>• Over-engineering dengan struktur data kompleks</li>
                                            <li>• Mengabaikan kompleksitas waktu ruang</li>
                                            <li>• Tidak mempertimbangkan kasus edge</li>
                                        </ul>
                                    </div>
                                    
                                    <div class="bg-white rounded-lg p-4">
                                        <h5 class="font-semibold text-green-900 mb-3 flex items-center">
                                            <i data-feather="check-circle" class="w-5 h-5 mr-2"></i>
                                            Solusi yang Baik
                                        </h5>
                                        <ul class="space-y-2 text-sm text-gray-700">
                                            <li>• Pahami kompleksitas Big O</li>
                                            <li>• Profil kode untuk menemukan bottleneck</li>
                                            <li>• Mulai dengan solusi sederhana</li>
                                            <li>• Optimasi berdasarkan kebutuhan aktual</li>
                                            <li>• Dokumentasikan pilihan struktur data</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Navigation -->
                <div class="flex justify-between items-center bg-white rounded-lg shadow-md p-6">
                    <div>
                        <a href="<?= base_url('documentation/chapter4') ?>" class="text-gray-600 hover:text-gray-800 flex items-center">
                            <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i>
                            Kembali ke Bab 4
                        </a>
                    </div>
                    <div class="text-center">
                        <span class="text-sm text-gray-500">Bab 5 dari 10</span>
                        <div class="flex space-x-1 mt-1">
                            <div class="w-3 h-3 bg-red-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-red-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-red-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-red-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-red-600 rounded-full"></div>
                            <div class="w-3 h-3 bg-gray-300 rounded-full"></div>
                        </div>
                    </div>
                    <div>
                        <a href="<?= base_url('documentation/chapter6') ?>" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg flex items-center">
                            Lanjut ke Bab 6
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