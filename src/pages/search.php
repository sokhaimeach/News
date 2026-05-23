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
        class="flex items-center bg-white shadow-sm rounded-full overflow-hidden border border-gray-200 w-full max-w-xl">
        
            <!-- Search Input -->
            <input 
            type="text" 
            name="search"
            value="<?= $search ?>"
            placeholder="ស្វែងរកព័ត៌មាន..." 
            class="w-full px-5 pb-3 pt-4 text-gray-700 outline-none focus:outline-none focus:ring-0 border-none">
        
            <!-- Search Button -->
            <button type="submit"
                class="bg-sky-800 hover:bg-sky-900 transition-colors duration-300 text-white px-6 h-full pb-3 pt-4 koulen-regular">
                ស្វែងរក
            </button>
        
        </form>
    </div>

    <!-- search result -->
    <div class="w-full mx-auto max-w-[1024px]">
        
        <?php if(!empty($newsItems)){ ?>
        <div class="grid w-full lg:w-[1024px] mx-auto gap-4 bg-slate-50 p-4 grid-cols-2 lg:grid-cols-4">
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
            echo "<p class='h-[250px] text-3xl koulen-regular text-center'>រកមិនឃើញ <span class='text-rose-500'>$search</span> ទេ</p>";
        }
        ?>

    </div>


</section>


<?php } ?>