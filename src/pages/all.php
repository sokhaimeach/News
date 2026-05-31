<?php
require_once "src/data/db.php";
require_once "src/components/card.php";

function renderAll($category, $baseHref) {
    global $categories, $news, $icons;

    $newsByCategory = getNewsByCategory($category);
    $catLabel = $categories[$category] ?? $category;
    $icon = $icons[$category] ?? 'bi bi-newspaper';
?>
    <div class="w-full max-w-[1024px] mx-auto mt-6 px-4 md:px-0">

        <!-- breadcrumb -->
        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-4 siemreap-regular">
            <a href="" class="hover:text-red-700 transition-colors">ទំព័រដើម</a>
            <i class="bi bi-chevron-right text-[10px]"></i>
            <span class="text-gray-900 koulen-regular"><?= htmlspecialchars($catLabel, ENT_QUOTES) ?></span>
        </nav>

        <!-- category header -->
        <div class="flex items-center gap-4 mb-6 pb-4 border-b border-gray-200">
            <div class="w-12 h-12 bg-red-700 rounded-xl flex items-center justify-center shadow-md shadow-red-700/20">
                <i class="<?= $icon ?> text-white text-lg"></i>
            </div>
            <div>
                <h1 class="text-2xl md:text-3xl koulen-regular text-gray-900 leading-none"><?= htmlspecialchars($catLabel, ENT_QUOTES) ?></h1>
                <p class="text-sm text-gray-500 mt-1 flex items-center gap-1">
                    <i class="bi bi-file-text"></i>
                    <?= count($newsByCategory) ?> អត្ថបទ
                </p>
            </div>
        </div>

        <?php if (empty($newsByCategory)): ?>
        <div class="flex flex-col items-center justify-center h-[400px] text-gray-400">
            <i class="bi bi-inbox text-6xl mb-4"></i>
            <p class="text-xl koulen-regular">មិនមានព័ត៌មានទេសម្រាប់ប្រភេទនេះទេ</p>
        </div>
        <?php else: ?>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4">
            <?php foreach($newsByCategory as $index => $newsItem): ?>
                <?php if ($index < 2): ?>
                    <div class="col-span-2">
                        <?php renderCard($newsItem, 125); ?>
                    </div>
                <?php else: ?>
                    <?php renderCard($newsItem); ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

    </div>

<?php
}
?>