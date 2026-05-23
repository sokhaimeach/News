<?php
require_once "src/data/db.php";
require_once "src/components/card.php";

global $categories, $news;

function mapArray($array, $category) {
    $result = [];
    foreach ($array as $item) {
        if ($item['category'] === $category) {
            $result[] = $item;
        }
    }
    return $result;
}

// find category as english name
function findEnCategoryName($khName) {
    global $categories;

    foreach($categories as $category => $label) {
        if ($label == $khName) {
            return $category;
        }
    }
}

$newsByCategory = [];

echo "<br>";

foreach ($categories as $category => $label) {
    $newsByCategory[$label] = mapArray($news, $label);
}

foreach ($newsByCategory as $category => $newsItems) {
    $newsItems = orderByDate($newsItems);
?>
    <div class="w-full mx-auto max-w-[1024px] mt-8">
        <div class="w-full flex items-center justify-between px-4 md:px-0">
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 transition duration-75 group-hover:text-fg-brand bg-sky-900 rounded-xl justify-center items-center flex">
                    <i class="bi bi-house-door text-white"></i>
                </div>

                <h1 class="koulen-regular text-xl font-bold text-center"><?= $category ?></h1>
            </div>

            <a 
            href="all/<?= findEnCategoryName($category) ?>"
            class="h-10 w-fit p-2 border-2 border-black/50 koulen-regular rounded-xl cursor-pointer">
                ទាំងអស់
            </a>
        </div>

        <div class="grid w-full lg:w-[1024px] mx-auto gap-4 p-4 grid-cols-2 lg:grid-cols-4">
            <?php
            foreach($newsItems as $index => $newsItem) {

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