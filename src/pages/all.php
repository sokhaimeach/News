<?php
require_once "src/data/db.php";
require_once "src/components/card.php";

global $categories, $news;

function renderAll($category, $baseHref) {
    $newsByCategory = getNewsByCategory($category);

    if (empty($newsByCategory)) {
        echo "<p class='text-3xl koulen-regular text-center text-gray-500 w-full h-[500px] flex items-center justify-center'>មិនមានព័ត៌មានទេសម្រាប់ប្រភេទនេះទេ</p>";
        return;
    }
?>
    <div class="w-full mx-auto max-w-[1024px]">

        <div class="grid w-full lg:w-[1024px] mx-auto gap-4 bg-slate-50 p-4 grid-cols-2 lg:grid-cols-4">
            <?php
            foreach($newsByCategory as $index => $newsItem) {

                if ($index < 2) echo "<div class='col-span-2'>";
                renderCard($newsItem);
                if ($index < 2) echo "</div>";
            }
            ?>
        </div>

    </div>

<?php
}
?>