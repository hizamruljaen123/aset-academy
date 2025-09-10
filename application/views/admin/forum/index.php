<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">Manajemen Forum</h1>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pembuat</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($threads as $thread): ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap"><a href="<?php echo site_url('forum/thread/' . $thread->id); ?>" class="text-blue-600 hover:underline"><?php echo $thread->title; ?></a></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $thread->category_name; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $thread->nama_lengkap; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo date('d M Y', strtotime($thread->created_at)); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <a href="<?php echo site_url('admin/admin_forum/delete_thread/' . $thread->id); ?>" class="text-red-600 hover:underline" onclick="return confirm('Apakah Anda yakin ingin menghapus topik ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        <?php echo $pagination; ?>
    </div>
</div>
