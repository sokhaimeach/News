<?php
require_once "src/data/db.php";

function renderSearchPage() {
    
    $search = $_GET['search'] ?? '';
    $newsItems = searchNews($search);

?>

<section class="min-h-[60vh]">
    <!-- search bar -->
    <div class="max-w-[640px] mx-auto mt-20 mb-8 px-4">
        <h1 class="text-2xl md:text-3xl koulen-regular text-center text-gray-900 mb-6">ស្វែងរកព័ត៌មាន</h1>
        <form action="search" method="GET" class="relative">
            <div class="flex items-center bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden focus-within:ring-2 focus-within:ring-red-700/20 focus-within:border-red-300 transition-all duration-200">
                <div class="pl-4 text-gray-400">
                    <i class="bi bi-search text-lg"></i>
                </div>
                <input type="text" name="search" value="<?= htmlspecialchars($search, ENT_QUOTES) ?>"
                    placeholder="ស្វែងរកព័ត៌មាន..." 
                    class="w-full px-3 py-3.5 text-gray-900 outline-none border-none bg-transparent siemreap-regular">
                <button type="submit"
                    class="bg-red-700 hover:bg-red-800 transition-all duration-200 text-white px-5 py-3.5 koulen-regular text-sm">
                    ស្វែងរក
                </button>
            </div>
        </form>
    </div>

    <!-- search results -->
    <div class="max-w-[1024px] mx-auto px-4">
        <?php if (!empty($search) && !empty($newsItems)): ?>
            <p class="text-sm text-gray-500 mb-4 flex items-center gap-2">
                <i class="bi bi-files"></i>
                ឃើញ <strong class="text-gray-900"><?= count($newsItems) ?></strong> លទ្ធផលសម្រាប់ "<span class="text-red-700 font-medium"><?= htmlspecialchars($search, ENT_QUOTES) ?></span>"
            </p>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4">
                <?php foreach($newsItems as $index => $item): ?>
                    <?php if ($index < 2): ?>
                        <div class="col-span-2">
                            <?php renderCard($item); ?>
                        </div>
                    <?php else: ?>
                        <?php renderCard($item); ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

        <?php elseif (!empty($search) && empty($newsItems)): ?>
            <div class="flex flex-col items-center justify-center py-20 text-gray-400">
                <i class="bi bi-search text-6xl mb-4"></i>
                <p class="text-xl koulen-regular text-gray-600">រកមិនឃើញ</p>
                <p class="text-gray-500 mt-1">គ្មានលទ្ធផលសម្រាប់ "<span class="text-amber-500 font-medium"><?= htmlspecialchars($search, ENT_QUOTES) ?></span>" ទេ</p>
            </div>

        <?php else: ?>
            <div class="flex flex-col items-center justify-center py-20 text-gray-400">
                <i class="bi bi-search text-6xl mb-4"></i>
                <p class="text-lg text-gray-500">សូមបញ្ចូលពាក្យស្វែងរក</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php } ?>