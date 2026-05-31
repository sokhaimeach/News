<?php
require_once "src/data/db.php";

function renderCard($newsItem, $num = 50) {
?>
    <div class="group w-full bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden flex flex-col siemreap-regular cursor-pointer transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
        <a href="detail/<?= $newsItem['id'] ?>">
            <div class="relative overflow-hidden aspect-[4/3]">
                <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                    src="<?= htmlspecialchars($newsItem['image'][0], ENT_QUOTES) ?>"
                    alt="<?= htmlspecialchars($newsItem['title'], ENT_QUOTES) ?>"
                    loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <span class="absolute top-2 left-2 bg-red-700 text-white text-[10px] px-2 py-0.5 rounded-md koulen-regular shadow-md">
                    <?= htmlspecialchars($newsItem['category'], ENT_QUOTES) ?>
                </span>
            </div>
            <div class="p-3">
                <h3 class="text-gray-900 text-sm sm:text-base leading-relaxed line-clamp-2 group-hover:text-red-700 transition-colors duration-200">
                    <?= truncate($newsItem['title'], $num) ?>
                </h3>
                <div class="mt-3 pt-3 border-t border-gray-100 flex items-center gap-2 text-xs text-gray-500">
                    <i class="bi bi-clock-fill text-amber-400"></i>
                    <span><?= timeAgoKhmer($newsItem['date']) ?></span>
                </div>
            </div>
        </a>
    </div>
<?php
}
?>