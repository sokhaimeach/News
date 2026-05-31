<?php
require_once "src/data/db.php";

function isActive($currentCategory, $url) {
    $path = trim(parse_url($url, PHP_URL_PATH), "/");
    $segments = explode("/", $path);
    $category = end($segments);

    // For home page: path is empty or just "News"
    if ($currentCategory === "News") {
        return ($category === "" || $category === "News") ? "active" : "";
    }

    return $category === $currentCategory ? "active" : "";
}

function renderNavbar($url){
    global $categories, $icons;
    $path = trim(parse_url($url, PHP_URL_PATH), "/");
    $segments = explode("/", $path);
    $currentCategory = end($segments);
?>

<nav id="navbar" class="w-full h-[65px] bg-red-700 flex items-center justify-between top-0 px-4 md:px-6 fixed left-0 z-50 transition-all duration-300">
    <!-- mobile menu -->
    <div class="sm:hidden">
        <label class="flex flex-col gap-2 w-8" id="menu-btn">
            <input class="peer hidden" type="checkbox" />
            <div class="rounded-2xl h-[3px] w-1/2 bg-white duration-500 peer-checked:rotate-[225deg] origin-right peer-checked:-translate-x-[12px] peer-checked:-translate-y-[1px]"></div>
            <div class="rounded-2xl h-[3px] w-full bg-white duration-500 peer-checked:-rotate-45"></div>
            <div class="rounded-2xl h-[3px] w-1/2 bg-white duration-500 place-self-end peer-checked:rotate-[225deg] origin-left peer-checked:translate-x-[12px] peer-checked:translate-y-[1px]"></div>
        </label>
    </div>

    <!-- logo -->
    <a href="" class="flex items-center gap-2 group">
        <div class="relative w-[42px] h-[42px] md:w-[48px] md:h-[48px]">
            <div class="absolute inset-0 rounded-xl bg-white/30 blur-md opacity-70 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative bg-white/10 rounded-xl w-full h-full flex items-center justify-center border border-white/20">
                <img src="./assets/logo.png" alt="រំដួលថ្ងៃនេះ" class="w-[26px] h-[26px] md:w-[30px] md:h-[30px] group-hover:scale-110 transition-transform duration-300">
            </div>
        </div>
        <h1 class="text-xl md:text-2xl koulen-regular hidden md:block text-white tracking-wide">រំដួលថ្ងៃនេះ</h1>
    </a>

    <div class="flex items-center gap-2 md:gap-5">
        <!-- desktop menu -->
        <ul class="hidden sm:flex items-center gap-1 koulen-regular">
            <li>
                <a href=""
                    class="px-3 py-1.5 rounded-lg text-sm md:text-base transition-all duration-200 <?= isActive("News", $url) === "active" ? 'bg-white/15 text-amber-300' : 'text-white/90 hover:bg-white/10 hover:text-white' ?>">
                    ទំព័រដើម
                </a>
            </li>
            <?php foreach($categories as $category => $label): ?>
                <li>
                    <a href="all/<?= $category ?>"
                        class="px-3 py-1.5 rounded-lg text-sm md:text-base transition-all duration-200 <?= isActive($category, $url) === "active" ? 'bg-white/15 text-amber-300' : 'text-white/90 hover:bg-white/10 hover:text-white' ?>">
                        <?= $label ?>
                    </a>
                </li>
            <?php endforeach ?>
        </ul>

        <!-- search icon -->
        <a href="search?search=" class="w-9 h-9 md:w-10 md:h-10 flex items-center justify-center rounded-full text-white hover:bg-white/15 transition-all duration-200">
            <i class="bi bi-search text-lg md:text-xl"></i>
        </a>
    </div>
</nav>

<!-- breaking news ticker -->
<div id="ticker" class="fixed top-[65px] left-0 right-0 z-40 bg-red-800 transition-all duration-300 ease-in-out">
    <div class="flex items-center max-w-[1280px] mx-auto px-4 py-1.5">
        <span class="inline-flex items-center gap-1.5 bg-amber-400 text-red-900 text-xs font-bold px-2.5 py-1 rounded-md koulen-regular shrink-0 me-3">
            <span class="w-1.5 h-1.5 bg-red-700 rounded-full animate-pulse"></span>
            ព័ត៌មានថ្មី
        </span>
        <div class="overflow-hidden flex-1">
            <div class="flex animate-scroll shrink-0 gap-10 text-white/80 text-xs sm:text-sm siemreap-regular" id="ticker-text">
                <span class="whitespace-nowrap">សូមស្វាគមន៍មកកាន់ រំដួលថ្ងៃនេះ! ដឹង! លឺ! គ្រប់ព័ត៌មាន</span>
            </div>
        </div>
    </div>
</div>


<!-- mobile drawer overlay -->
<div id="drawer-navigation"
    class="fixed left-0 z-40 w-full sm:w-[320px] h-screen overflow-y-auto transition-transform -translate-x-full duration-300 bg-[#1b1b1b] shadow-2xl shadow-black/50"
    tabindex="-1">

    <div class="p-5 pt-8 mt-[50px]">
        <div class="border-b border-white/10 mb-5"></div>

        <ul class="space-y-1">
            <li>
                <a href=""
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 <?= isActive("News", $url) === "active" ? 'bg-red-700/30 text-amber-300' : 'text-white/80 hover:bg-white/5 hover:text-white' ?>">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center text-sm <?= isActive("News", $url) === "active" ? 'bg-red-700' : 'bg-white/10' ?>">
                        <i class="bi bi-house"></i>
                    </div>
                    <span class="koulen-regular text-sm">ទំព័រដើម</span>
                </a>
            </li>
            <?php foreach($categories as $category => $label): ?>
            <li>
                <a href="all/<?= $category ?>"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 <?= isActive($category, $url) === "active" ? 'bg-red-700/30 text-amber-300' : 'text-white/80 hover:bg-white/5 hover:text-white' ?>">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center text-sm <?= isActive($category, $url) === "active" ? 'bg-red-700' : 'bg-white/10' ?>">
                        <i class="<?= $icons[$category] ?>"></i>
                    </div>
                    <span class="koulen-regular text-sm"><?= $label ?></span>
                </a>
            </li>
            <?php endforeach ?>
        </ul>
    </div>
</div>

<div class="mb-30"></div>

<style>
    @keyframes scrollLeft {
        0% { transform: translateX(100%); }
        100% { transform: translateX(-100%); }
    }
    .animate-scroll {
        animation: scrollLeft 20s linear infinite;
    }
</style>

<script>
    const menuBtn = document.getElementById('menu-btn');
    const drawerEl = document.getElementById('drawer-navigation');
    const navbar = document.getElementById('navbar');
    const ticker = document.getElementById('ticker');
    let lastScroll = 0;
    let ticking = false;

    const drawer = new Drawer(drawerEl, {
        placement: 'left',
        backdrop: true,
        keyboard: true,
        scroll: true,
    });

    menuBtn.addEventListener('click', () => {
        const checkbox = menuBtn.querySelector('input');
        if (checkbox.checked) {
            drawer.show();
        } else {
            drawer.hide();
        }
    });

    window.addEventListener("scroll", () => {
        if (!ticking) {
            window.requestAnimationFrame(() => {
                const currentScroll = window.pageYOffset;

                if (currentScroll > lastScroll) {
                    navbar.classList.remove("top-0");
                    navbar.classList.add("top-[-65px]");

                    ticker.classList.remove("top-[65px]");
                    ticker.classList.add("top-0");
                } else {
                    navbar.classList.remove("top-[-65px]");
                    navbar.classList.add("top-0");

                    ticker.classList.remove("top-0");
                    ticker.classList.add("top-[65px]");
                }

                lastScroll = currentScroll;
                ticking = false;
            });
            ticking = true;
        }
    });
</script>

<?php } ?>