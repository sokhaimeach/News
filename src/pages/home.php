<?php
require_once "src/data/db.php";
require_once "src/components/card.php";

global $categories, $news, $icons;

function mapArray($array, $category) {
    $result = [];
    foreach ($array as $item) {
        if ($item['category'] === $category) {
            $result[] = $item;
        }
    }
    return $result;
}

function findEnCategoryName($khName) {
    global $categories;

    foreach($categories as $category => $label) {
        if ($label == $khName) {
            return $category;
        }
    }
}

function renderHome() {
    global $categories, $news, $icons;

    $allNews = orderByDate($news);
    $featured = $allNews[0] ?? null;
    $trending = array_slice($allNews, 1, 2);

    $newsByCategory = [];
    foreach ($categories as $category => $label) {
        $filteredNews = mapArray($news, $label);
        $newsByCategory[$label] = array_slice($filteredNews, 0, 6);
    }
?>

<!-- Hero featured section -->
<?php if ($featured): 
    $catLabel = $featured['category'];
    $catKey = findEnCategoryName($catLabel);
?>
<section class="w-full mx-auto mt-4 px-4 md:px-0">
    <div class="relative w-full max-w-[1024px] mx-auto rounded-2xl overflow-hidden shadow-xl group">
        <a href="detail/<?= $featured['id'] ?>">
            <div class="aspect-[16/9] md:aspect-[21/9]">
                <img src="<?= htmlspecialchars($featured['image'][0], ENT_QUOTES) ?>" 
                    alt="<?= htmlspecialchars($featured['title'], ENT_QUOTES) ?>"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/30 to-transparent"></div>
            <div class="absolute bottom-0 left-0 right-0 p-4 md:p-8">
                <span class="inline-flex items-center gap-1 bg-red-700 text-white text-xs px-3 py-1 rounded-md koulen-regular mb-2 md:mb-3 shadow-lg">
                    <i class="<?= $icons[$catKey] ?? 'bi bi-newspaper' ?>"></i>
                    <?= htmlspecialchars($catLabel, ENT_QUOTES) ?>
                </span>
                <h2 class="text-white text-lg md:text-2xl lg:text-3xl koulen-regular leading-[1.4] line-clamp-2 md:line-clamp-3">
                    <?= htmlspecialchars($featured['title'], ENT_QUOTES) ?>
                </h2>
                <p class="text-white/60 text-xs md:text-sm mt-1 md:mt-2 flex items-center gap-2">
                    <i class="bi bi-clock-fill text-amber-400"></i>
                    <?= timeAgoKhmer($featured['date']) ?>
                </p>
            </div>
        </a>
    </div>
</section>
<?php endif; ?>

<!-- Trending grid (2 latest articles after hero) -->
<?php if (!empty($trending)): ?>
<section class="w-full mx-auto mt-5 px-4 md:px-0">
    <div class="max-w-[1024px] mx-auto grid grid-cols-1 sm:grid-cols-2 gap-4">
        <?php foreach ($trending as $item): 
            $tCatKey = findEnCategoryName($item['category']);
        ?>
        <a href="detail/<?= $item['id'] ?>" class="group relative rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300">
            <div class="aspect-[16/9]">
                <img src="<?= htmlspecialchars($item['image'][0], ENT_QUOTES) ?>" 
                    alt="<?= htmlspecialchars($item['title'], ENT_QUOTES) ?>"
                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
            <div class="absolute bottom-0 left-0 right-0 p-3 md:p-5">
                <span class="inline-block bg-red-700 text-white text-[10px] px-2 py-0.5 rounded koulen-regular mb-1.5">
                    <i class="<?= $icons[$tCatKey] ?? 'bi bi-newspaper' ?>"></i>
                    <?= htmlspecialchars($item['category'], ENT_QUOTES) ?>
                </span>
                <h3 class="text-white text-sm md:text-base koulen-regular leading-[1.4] line-clamp-2">
                    <?= htmlspecialchars($item['title'], ENT_QUOTES) ?>
                </h3>
                <p class="text-white/50 text-xs mt-1 flex items-center gap-1">
                    <i class="bi bi-clock-fill text-amber-400"></i>
                    <?= timeAgoKhmer($item['date']) ?>
                </p>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>

<!-- Category sections -->
<?php 
$sectionIndex = 0;
foreach ($newsByCategory as $category => $newsItems): 
    $newsItems = orderByDate($newsItems);
    $sectionIndex++;
?>
    <section class="w-full mx-auto mt-6 md:mt-10 px-4 md:px-0">
        <div class="max-w-[1024px] mx-auto">

            <!-- Section header -->
            <div class="flex items-center justify-between mb-4 <?= $sectionIndex > 1 ? 'pt-6 md:pt-8 border-t border-gray-200' : '' ?>">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-red-700 rounded-xl flex items-center justify-center shadow-md shadow-red-700/20">
                        <i class="<?= $icons[findEnCategoryName($category)] ?> text-white text-sm"></i>
                    </div>
                    <h2 class="koulen-regular text-xl md:text-2xl text-gray-900"><?= $category ?></h2>
                </div>

                <a href="all/<?= findEnCategoryName($category) ?>"
                    class="h-9 px-4 flex items-center gap-1.5 border border-gray-200 bg-white text-gray-600 hover:text-red-700 hover:border-red-200 koulen-regular text-sm rounded-xl transition-all duration-200 hover:shadow-sm">
                    ទាំងអស់
                    <i class="bi bi-chevron-right text-xs"></i>
                </a>
            </div>

            <!-- News grid -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4">
                <?php foreach($newsItems as $index => $newsItem): ?>
                    <?php if ($index < 2): ?>
                        <div class="col-span-2">
                            <?php renderCard($newsItem, 125); ?>
                        </div>
                    <?php else: ?>
                        <?php renderCard($newsItem); ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

        </div>
    </section>
<?php endforeach; ?>

<?php
}
?>