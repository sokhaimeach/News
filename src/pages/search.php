<?php
require_once "src/data/db.php";

function renderSearchPage() {
    
    $search = $_GET['search'] ?? '';

    $newsItems = searchNews($search);

?>

<section>
    <!-- search -->
    <div class="my-30 flex justify-center siemreap-regular px-4">
        <form 
        action="search"
        method="GET"
        value="<?= htmlspecialchars($search) ?>"
        class="flex items-center bg-white shadow-sm rounded-full overflow-hidden border border-gray-200 w-full max-w-5xl">
        
            <!-- Search Input -->
            <input 
            type="text" 
            name="search"
            value="<?= $search ?>"
            placeholder="ស្វែងរកព័ត៌មាន..." 
            class="w-full px-5 pb-3 pt-4 text-gray-900 outline-none focus:outline-none focus:ring-0 border-none bg-transparent">
        
            <!-- Search Button -->
            <button type="submit"
                class="bg-red-700 hover:bg-red-800 transition-colors duration-300 text-white px-6 h-full pb-3 pt-4 koulen-regular">
                ស្វែងរក
            </button>
        
        </form>
    </div>

    <!-- search result -->
    <div class="w-full mx-auto container">
        
        <?php if(!empty($newsItems)){ ?>
        <div class="grid w-full mx-auto gap-4 bg-gray-50 p-4 grid-cols-2 lg:grid-cols-4">
            <?php
            foreach($newsItems as $index => $item) {

                if ($index < 2) echo "<div class='col-span-2'>";
                renderCard($item);
                if ($index < 2) echo "</div>";
            }
            ?>
        </div>
        <?php 
        } else {
            echo "<p class='h-[250px] text-3xl koulen-regular text-center text-gray-900'>រកមិនឃើញ <span class='text-amber-500'>$search</span> ទេ</p>";
        }
        ?>

    </div>


</section>


<?php } ?>