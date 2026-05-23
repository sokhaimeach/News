<?php
require_once "src/data/db.php";

function renderCard($newsItem) {
?>
<!-- card -->
    <div class="w-full h-fit bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col siemreap-regular cursor-pointer">
        <a href="detail/<?= $newsItem['id'] ?>">
            <!-- Image -->
            <div class="overflow-hidden aspect-[5/3]">
                <img class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
                    src="<?= htmlspecialchars($newsItem['image'][0], ENT_QUOTES) ?>"
                    alt="Beautiful landscape">
            </div>
            <div class="p-2">
                <!-- title -->
                <p class="text-gray-700 mb-4 text-sm sm:text-base leading-relaxed">
                    <?= truncate($newsItem['title']) ?>
                </p>
                <footer class="text-sm text-gray-500/50 flex flex-wrap items-center gap-2 sm:gap-3">
                    <i class="bi bi-clock-fill"></i>
                    <p><?= timeAgoKhmer($newsItem['date']) ?></p>
                </footer>
            </div>
        </a>
    </div>
<?php
}
?>