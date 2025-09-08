<div class="bg-white rounded-lg shadow-md p-6 mb-6 fade-in">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Progress Siswa</h2>
            <p class="text-gray-600"><?php echo $enrollment->title; ?></p>
        </div>
        <a href="<?php echo site_url('admin/free_classes/students/' . $enrollment->class_id); ?>" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Daftar Siswa
        </a>
    </div>

    <!-- Student Info -->
    <div class="bg-gray-50 p-6 rounded-lg mb-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between">
            <div class="flex items-center mb-4 md:mb-0">
                <div class="h-16 w-16 rounded-full bg-blue-600 flex items-center justify-center text-white text-xl font-bold mr-4">
                    <?php 
                    $student_name = $this->db->select('nama_lengkap')->where('id', $enrollment->student_id)->get('users')->row()->nama_lengkap;
                    echo strtoupper(substr($student_name, 0, 1)); 
                    ?>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800"><?php echo $student_name; ?></h3>
                    <p class="text-gray-600">Terdaftar sejak: <?php echo date('d F Y', strtotime($enrollment->enrollment_date)); ?></p>
                </div>
            </div>
            <div class="flex flex-col items-end">
                <div class="flex items-center mb-2">
                    <span class="text-sm font-medium text-gray-700 mr-2">Progress Keseluruhan:</span>
                    <span class="text-lg font-bold text-blue-600"><?php echo $enrollment->progress; ?>%</span>
                </div>
                <div class="w-48 bg-gray-200 rounded-full h-2.5">
                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: <?php echo $enrollment->progress; ?>%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress List -->
    <div class="mb-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Detail Progress Materi</h3>
        
        <?php if (empty($progress)): ?>
            <div class="bg-gray-50 p-6 rounded-lg text-center">
                <i class="fas fa-book text-gray-400 text-4xl mb-3"></i>
                <p class="text-gray-500">Belum ada materi yang tersedia untuk kelas ini.</p>
            </div>
        <?php else: ?>
            <div class="space-y-4">
                <?php foreach ($progress as $item): ?>
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <div class="flex items-center justify-between p-4 bg-gray-50">
                            <div class="flex items-center">
                                <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 mr-3">
                                    <?php echo $item->order; ?>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-800"><?php echo $item->title; ?></h4>
                                    <p class="text-xs text-gray-500">
                                        <?php 
                                        if ($item->content_type == 'text') echo '<i class="fas fa-file-alt mr-1"></i> Teks';
                                        elseif ($item->content_type == 'video') echo '<i class="fas fa-video mr-1"></i> Video';
                                        elseif ($item->content_type == 'pdf') echo '<i class="fas fa-file-pdf mr-1"></i> PDF';
                                        else echo '<i class="fas fa-link mr-1"></i> Link';
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <span class="px-2 py-1 text-xs rounded-full mr-3
                                    <?php 
                                    if ($item->status == 'Completed') echo 'bg-green-100 text-green-800';
                                    elseif ($item->status == 'In Progress') echo 'bg-blue-100 text-blue-800';
                                    else echo 'bg-gray-100 text-gray-800';
                                    ?>">
                                    <?php 
                                    if ($item->status == 'Completed') echo 'Selesai';
                                    elseif ($item->status == 'In Progress') echo 'Sedang Dipelajari';
                                    else echo 'Belum Dimulai';
                                    ?>
                                </span>
                                
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" class="text-gray-600 hover:text-gray-900">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                        <div class="py-1" role="none">
                                            <form action="<?php echo site_url('admin/free_classes/update_material_progress'); ?>" method="post">
                                                <input type="hidden" name="enrollment_id" value="<?php echo $enrollment->id; ?>">
                                                <input type="hidden" name="material_id" value="<?php echo $item->material_id; ?>">
                                                <input type="hidden" name="status" value="Not Started">
                                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Tandai Belum Dimulai</button>
                                            </form>
                                            
                                            <form action="<?php echo site_url('admin/free_classes/update_material_progress'); ?>" method="post">
                                                <input type="hidden" name="enrollment_id" value="<?php echo $enrollment->id; ?>">
                                                <input type="hidden" name="material_id" value="<?php echo $item->material_id; ?>">
                                                <input type="hidden" name="status" value="In Progress">
                                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Tandai Sedang Dipelajari</button>
                                            </form>
                                            
                                            <form action="<?php echo site_url('admin/free_classes/update_material_progress'); ?>" method="post">
                                                <input type="hidden" name="enrollment_id" value="<?php echo $enrollment->id; ?>">
                                                <input type="hidden" name="material_id" value="<?php echo $item->material_id; ?>">
                                                <input type="hidden" name="status" value="Completed">
                                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Tandai Selesai</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-4 bg-white">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Terakhir Diakses</p>
                                    <p class="text-sm">
                                        <?php echo $item->last_accessed ? date('d M Y H:i', strtotime($item->last_accessed)) : '-'; ?>
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Tanggal Selesai</p>
                                    <p class="text-sm">
                                        <?php echo $item->completion_date ? date('d M Y H:i', strtotime($item->completion_date)) : '-'; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Actions -->
    <div class="flex justify-between items-center pt-4 border-t border-gray-200">
        <div>
            <span class="text-sm text-gray-500">Status Pendaftaran:</span>
            <span class="ml-2 px-2 py-1 text-xs rounded-full
                <?php 
                if ($enrollment->status == 'Completed') echo 'bg-green-100 text-green-800';
                elseif ($enrollment->status == 'Enrolled') echo 'bg-blue-100 text-blue-800';
                else echo 'bg-red-100 text-red-800';
                ?>">
                <?php 
                if ($enrollment->status == 'Completed') echo 'Selesai';
                elseif ($enrollment->status == 'Enrolled') echo 'Terdaftar';
                else echo 'Keluar';
                ?>
            </span>
        </div>
        
        <div class="flex space-x-2">
            <form action="<?php echo site_url('admin/free_classes/update_student_status/' . $enrollment->id); ?>" method="post">
                <input type="hidden" name="status" value="Completed">
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-300 hover:scale-105">
                    <i class="fas fa-check-circle mr-2"></i>
                    Tandai Selesai
                </button>
            </form>
        </div>
    </div>
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
