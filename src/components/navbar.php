<?php
require_once "src/data/db.php";

// check acctive route
function isActive($currentCategory, $url) {

    $path = trim(parse_url($url, PHP_URL_PATH), "/");

    $segments = explode("/", $path);

    $category = end($segments);

    return $category === $currentCategory
        ? "text-amber-500"
        : "text-white";
}

function renderNavbar($url){
    global $categories;
?>

<nav
id="navbar" 
class="w-full h-[70px] bg-sky-900 flex items-center justify-between px-5 fixed top-0 left-0 z-50 transition-transform duration-300">
    <!-- menu button for mobile -->
    <div class="sm:hidden">
        <!-- From Uiverse.io by Shubh0408 -->
        <label class="flex flex-col gap-2 w-8" id="menu-btn">
            <input class="peer hidden" type="checkbox" />
            <div
                class="rounded-2xl h-[3px] w-1/2 bg-white duration-500 peer-checked:rotate-[225deg] origin-right peer-checked:-translate-x-[12px] peer-checked:-translate-y-[1px]">
            </div>
            <div class="rounded-2xl h-[3px] w-full bg-white duration-500 peer-checked:-rotate-45"></div>
            <div
                class="rounded-2xl h-[3px] w-1/2 bg-white duration-500 place-self-end peer-checked:rotate-[225deg] origin-left peer-checked:translate-x-[12px] peer-checked:translate-y-[1px]">
            </div>
        </label>

    </div>

    <!-- logo -->
    <div class="logo">
        <a href="" class="text-white text-lg font-bold flex items-center gap-2">
            <div class="relative w-[50px] h-[50px]">
                <div class="absolute inset-0 rounded-2xl">
                    <div class="absolute -inset-1 rounded-2xl 
                            bg-white/50
                            blur-lg opacity-80 animate-spin">
                    </div>
                </div>

                <div
                    class="relative bg-sky-900 rounded-2xl w-full h-full flex items-center justify-center border-3 border-gradient-to-r from-blue-500 to-purple-500 border-white/70 rounded-lg">
                    <img src="./assets/koh-web-logo.svg" alt="Logo" class="w-[32px] h-[32px]">
                </div>
            </div>
            <h1 class="text-2xl koulen-regular hidden md:block">កោះសន្តិភាព</h1>
        </a>
    </div>

    <div class="flex items-center gap-4">
        <!-- menu -->
        <ul class="flex koulen-regular hidden sm:flex">
            <li class="ml-6">
                <a 
                href=""
                class="hover:<?= isActive("News", $url) ?>/80 <?= isActive("News", $url) ?>">
                    ទំព័រដើម
                </a>
            </li>
            <?php foreach($categories as $category => $label): ?>
                <li class="ml-6">
                    <a 
                    href="all/<?= $category ?>"
                    class="hover:<?= isActive($category, $url) ?>/80 <?= isActive($category, $url) ?>">
                        <?= $label ?>
                    </a>
                </li>
            <?php endforeach ?>
        </ul>

        <!-- search icon -->
        <a href="search?search=">
            <i class="bi bi-search text-white text-2xl md:ms-6 cursor-pointer hover:text-amber-500/80"></i>
        </a>

    </div>

</nav>

<!-- Off canvas menu for mobile, show/hide based on off-canvas menu state -->
<div id="drawer-navigation"
    class="fixed top-[70px] bottom-0 left-0 z-40 w-full p-4 overflow-y-auto transition-transform -translate-x-full duration-800 bg-black text-white koulen-regular"
    tabindex="-1" aria-labelledby="drawer-navigation-label">

    <div class="pt-2 overflow-y-auto mt-[70px]">
        <!-- menu content -->
        <ul class="space-y-2 font-medium">
            <!-- news list -->
            <li>
                <a href=""
                    class="flex items-center px-2 py-1.5 text-body rounded-base hover:bg-neutral-tertiary hover:text-fg-brand group">
                    <div
                        class="w-8 h-8 transition duration-75 group-hover:text-fg-brand bg-sky-900 rounded-xl justify-center items-center flex">
                        <i class="bi bi-newspaper"></i>
                    </div>
                    <span class="ms-3  <?= isActive("News", $url) ?>">ទំព័រដើម</span>
                </a>
            </li>
            <?php foreach($categories as $category => $label): ?>
            <li>
                <a href="all/<?= $category ?>"
                    class="flex items-center px-2 py-1.5 text-body rounded-base hover:bg-neutral-tertiary hover:text-fg-brand group">
                    <div
                        class="w-8 h-8 transition duration-75 group-hover:text-fg-brand bg-sky-900 rounded-xl justify-center items-center flex">
                        <i class="bi bi-newspaper"></i>
                    </div>
                    <span class="ms-3  <?= isActive($category, $url) ?>"><?= $label ?></span>
                </a>
            </li>
            <?php endforeach ?>
        </ul>
    </div>
</div>

<div class="mb-[70px]"></div>


<script>
    const menuBtn = document.getElementById('menu-btn');
    const drawerEl = document.getElementById('drawer-navigation');
    const navbar = document.getElementById('navbar');
    let lastScroll = 0;

    const drawer = new Drawer(drawerEl, {
        placement: 'left',
        backdrop: true,
        keyboard: true,
        scroll: true,
    });

    menuBtn.addEventListener('click', () => {
        if (menuBtn.querySelector('input').checked) {
            drawer.show();
        } else {
            drawer.hide();
        }
    })

    // navbar scroll beheavior
    window.addEventListener("scroll", () => {
        let currentScroll = window.pageYOffset;

        // check scroll down
        if (currentScroll > lastScroll) {
            navbar.classList.add("-translate-y-full");
        }else{
            // check scroll up
            navbar.classList.remove("-translate-y-full");
        }

        lastScroll = currentScroll;
    });
</script>

<?php } ?>