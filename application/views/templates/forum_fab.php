<?php
// application/views/templates/forum_fab.php
$forum_pages = ['student_mobile/forum', 'student_mobile/forum/category', 'student_mobile/forum/thread'];
$current_uri = uri_string();
$is_forum_page = false;

foreach ($forum_pages as $page) {
    if (strpos($current_uri, $page) === 0) {
        $is_forum_page = true;
        break;
    }
}

if ($is_forum_page): 
?>
<button id="mobile-fab" 
        onclick="window.location.href='<?= site_url('student_mobile/forum/create') ?>'"
        class="fixed bottom-24 right-4 w-14 h-14 bg-blue-600 text-white rounded-full shadow-lg flex items-center justify-center z-40 transform transition-all duration-300 hover:scale-110 active:scale-95">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
         class="feather feather-plus w-6 h-6">
        <line x1="12" y1="5" x2="12" y2="19"></line>
        <line x1="5" y1="12" x2="19" y2="12"></line>
    </svg>
</button>
<?php endif; ?>
