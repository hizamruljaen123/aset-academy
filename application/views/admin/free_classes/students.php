<div class="bg-white rounded-lg shadow-md p-6 mb-6 fade-in">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Siswa Terdaftar</h2>
            <p class="text-gray-600"><?php echo $free_class->title; ?></p>
        </div>
        <a href="<?php echo site_url('admin/free_classes/edit/' . $free_class->id); ?>" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Kelas
        </a>
    </div>

    <div class="mb-6 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-md">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-info-circle text-blue-600"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-blue-700">
                    Total siswa terdaftar: <span class="font-bold"><?php echo count($enrolled_students); ?></span>
                    <?php if ($free_class->max_students): ?>
                        dari <span class="font-bold"><?php echo $free_class->max_students; ?></span> kuota
                    <?php endif; ?>
                </p>
            </div>
        </div>
    </div>

    <?php if (empty($enrolled_students)): ?>
        <div class="bg-gray-50 p-6 rounded-lg text-center">
            <i class="fas fa-users text-gray-400 text-4xl mb-3"></i>
            <p class="text-gray-500">Belum ada siswa yang terdaftar di kelas ini.</p>
        </div>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Siswa</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Daftar</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($enrolled_students as $student): ?>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold">
                                            <?php echo strtoupper(substr($student->nama_lengkap, 0, 1)); ?>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900"><?php echo $student->nama_lengkap; ?></div>
                                        <div class="text-sm text-gray-500"><?php echo $student->email; ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?php echo $student->nis ?? 'Belum terdaftar'; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?php echo $student->jurusan ?? '-'; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?php echo date('d M Y', strtotime($student->enrollment_date)); ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: <?php echo $student->progress; ?>%"></div>
                                </div>
                                <span class="text-xs text-gray-500"><?php echo $student->progress; ?>%</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    <?php 
                                    if ($student->status == 'Enrolled') echo 'bg-green-100 text-green-800';
                                    elseif ($student->status == 'Completed') echo 'bg-blue-100 text-blue-800';
                                    else echo 'bg-red-100 text-red-800';
                                    ?>">
                                    <?php 
                                    if ($student->status == 'Enrolled') echo 'Terdaftar';
                                    elseif ($student->status == 'Completed') echo 'Selesai';
                                    else echo 'Keluar';
                                    ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="<?php echo site_url('admin/free_classes/student_progress/' . $student->id); ?>" class="text-blue-600 hover:text-blue-900" title="Lihat Progress">
                                        <i class="fas fa-chart-line"></i>
                                    </a>
                                    <div class="relative" x-data="{ open: false }">
                                        <button @click="open = !open" class="text-gray-600 hover:text-gray-900" title="Ubah Status">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                            <div class="py-1" role="none">
                                                <?php echo form_open('admin/free_classes/update_student_status/' . $student->id); ?>
                                                    <input type="hidden" name="status" value="Enrolled">
                                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Tandai sebagai Terdaftar</button>
                                                <?php echo form_close(); ?>
                                                
                                                <?php echo form_open('admin/free_classes/update_student_status/' . $student->id); ?>
                                                    <input type="hidden" name="status" value="Completed">
                                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Tandai sebagai Selesai</button>
                                                <?php echo form_close(); ?>
                                                
                                                <?php echo form_open('admin/free_classes/update_student_status/' . $student->id); ?>
                                                    <input type="hidden" name="status" value="Dropped">
                                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Tandai sebagai Keluar</button>
                                                <?php echo form_close(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize intersection observer for fade-in elements
        const fadeElements = document.querySelectorAll('.fade-in');
        
        if (fadeElements.length > 0) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.classList.add('visible');
                        }, 100);
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });
            
            fadeElements.forEach((element, index) => {
                // Add staggered delay based on element index
                element.style.transitionDelay = `${index * 0.1}s`;
                observer.observe(element);
            });
        }
    });
</script>

<style>
    /* Animation styles */
    .fade-in {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }
    
    .fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }
</style>
