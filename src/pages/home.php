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

// find category as english name
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

    $newsByCategory = [];

    foreach ($categories as $category => $label) {
        $filteredNews = mapArray($news, $label);

        // limit to 6 items only
        $newsByCategory[$label] = array_slice($filteredNews, 0, 6);
    }
?>

<br>
<?php foreach ($newsByCategory as $category => $newsItems) {
    $newsItems = orderByDate($newsItems);
?>
    <div class="w-full mx-auto container mt-8 px-4 md:px-0">

        <div class="w-full flex items-center justify-between rounded-xl border border-gray-200 bg-white/90 px-4 py-3 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 transition duration-75 bg-red-700 rounded-xl justify-center items-center flex">
                    <i class="<?= $icons[findEnCategoryName($category)] ?> text-white"></i>
                </div>

                <div>
                    <h1 class="koulen-regular text-xl font-bold text-center text-gray-900"><?= $category ?></h1>
                </div>
            </div>

            <a 
            href="all/<?= findEnCategoryName($category) ?>"
            class="h-10 w-fit px-3 flex items-center border border-gray-200 bg-gray-50 text-gray-900 hover:text-amber-500 koulen-regular rounded-xl cursor-pointer transition-colors duration-300">
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
}
?>