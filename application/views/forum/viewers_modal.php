<div id="viewers-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md max-h-[80vh] flex flex-col">
        <div class="flex justify-between items-center p-4 border-b">
            <h3 class="font-bold text-lg">Dilihat oleh</h3>
            <button id="close-viewers-modal" class="text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
        </div>
        <div id="viewers-list" class="p-4 overflow-y-auto"> 
            <!-- Viewers will be loaded here -->
        </div>
    </div>
</div>
