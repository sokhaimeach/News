<?php
require_once "src/data/db.php";

function renderDetail($id) {
    global $categories;
    $newsItem = getNewsById(intval($id));

    if (!$newsItem) {
        echo "<p class='text-3xl koulen-regular text-center text-gray-900 w-full h-[500px] flex items-center justify-center'>មិនមានព័ត៌មានទេសម្រាប់ប្រភេទនេះទេ</p>";
        return;
    }

    $catKey = array_search($newsItem['category'], $categories);

    $images = $newsItem['image'];
    $paragraphs = explode("\n", trim($newsItem['content']));
    $imageIndex = 0;
    $newsByCategory = getNewsByCategory($newsItem['category']);
?>

<div class="w-full bg-white">
    <div class="w-full max-w-[1024px] mx-auto mt-4 md:mt-6 px-4 md:px-0">
        <!-- breadcrumb -->
        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-4 siemreap-regular">
            <a href="" class="hover:text-red-700 transition-colors">ទំព័រដើម</a>
            <i class="bi bi-chevron-right text-[10px]"></i>
            <a href="all/<?= $catKey ?: $newsItem['category'] ?>" class="hover:text-red-700 transition-colors"><?= htmlspecialchars($newsItem['category'], ENT_QUOTES) ?></a>
            <i class="bi bi-chevron-right text-[10px]"></i>
            <span class="text-gray-700 truncate max-w-[200px]"><?= htmlspecialchars($newsItem['title'], ENT_QUOTES) ?></span>
        </nav>
    </div>

    <!-- Article header image & slider -->
    <div class="relative w-full max-w-[1024px] mx-auto px-4 md:px-0">
        <div class="relative rounded-2xl overflow-hidden shadow-lg bg-gray-100">
            <!-- slider -->
            <div class="relative w-full aspect-[16/9] md:aspect-[21/9] overflow-hidden" id="slider-container">
                <div id="slidelist" class="flex h-full transition-transform duration-700 ease-in-out">
                    <?php foreach($images as $image): ?>
                        <div class="w-full h-full shrink-0 basis-full">
                            <img class="w-full h-full object-cover" src="<?= htmlspecialchars($image, ENT_QUOTES) ?>" alt="">
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- gradients -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent pointer-events-none"></div>

                <!-- arrow controls -->
                <button id="prev-slide" class="absolute left-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/20 backdrop-blur-sm text-white hover:bg-white/40 transition-all duration-200 flex items-center justify-center z-10 opacity-0 group-hover:opacity-100">
                    <i class="bi bi-chevron-left text-lg"></i>
                </button>
                <button id="next-slide" class="absolute right-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/20 backdrop-blur-sm text-white hover:bg-white/40 transition-all duration-200 flex items-center justify-center z-10 opacity-0 group-hover:opacity-100">
                    <i class="bi bi-chevron-right text-lg"></i>
                </button>

                <!-- slider dots -->
                <ul class="absolute bottom-4 left-0 w-full flex justify-center gap-2 z-10">
                    <?php foreach($images as $i => $image): ?>
                        <li class="w-2.5 h-2.5 rounded-full bg-white/50 cursor-pointer transition-all duration-300 dot <?= $i === 0 ? 'bg-white w-6' : '' ?>" data-index="<?= $i ?>"></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- Title & meta -->
    <div class="w-full max-w-[1024px] mx-auto mt-4 md:mt-6 px-4 md:px-0">
        <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl koulen-regular text-gray-900 leading-[1.4] md:leading-[1.3]">
            <?= $newsItem['title'] ?>
        </h1>

        <div class="flex flex-wrap items-center gap-4 mt-3 pb-4 border-b border-gray-200">
            <div class="flex items-center gap-2 text-sm text-gray-500">
                <i class="bi bi-clock-fill text-amber-400"></i>
                <span><?= formatKhmerDate($newsItem['date']) ?></span>
            </div>
            <div class="flex items-center gap-2 text-sm text-gray-500">
                <i class="bi bi-stopwatch text-amber-400"></i>
                <span><?= timeAgoKhmer($newsItem['date']) ?></span>
            </div>
            <div class="flex items-center gap-2 text-sm text-red-700">
                <i class="bi bi-folder2"></i>
                <a href="all/<?= $catKey ?? $newsItem['category'] ?>" class="hover:underline"><?= $newsItem['category'] ?></a>
            </div>
        </div>
    </div>

    <!-- Article content -->
    <div class="w-full max-w-[1024px] mx-auto mt-6 px-4 md:px-0">
        <div class="md:flex md:gap-8">
            <!-- Share sidebar (desktop) -->
            <div class="hidden md:flex flex-col items-center gap-3 pt-2 sticky top-24 self-start">
                <span class="text-xs text-gray-400 koulen-regular">ចែករំលែក</span>
                <a href=""
                    class="w-10 h-10 rounded-full bg-gray-100 hover:bg-blue-600 hover:text-white flex items-center justify-center text-gray-600 transition-all duration-200">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href=""
                    class="w-10 h-10 rounded-full bg-gray-100 hover:bg-sky-500 hover:text-white flex items-center justify-center text-gray-600 transition-all duration-200">
                    <i class="bi bi-twitter"></i>
                </a>
                <a href="" onclick="navigator.clipboard.writeText(window.location.href);alert('បានចម្លងតំណភ្ជាប់!');return false;"
                    class="w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-800 hover:text-white flex items-center justify-center text-gray-600 transition-all duration-200">
                    <i class="bi bi-link-45deg"></i>
                </a>
            </div>

            <!-- Body -->
            <div class="flex-1 min-w-0">
                <div class="prose prose-gray max-w-none siemreap-regular text-base md:text-lg leading-8 md:leading-9 text-gray-800">
                    <?php $imageIndex = 0; ?>
                    <?php foreach($paragraphs as $paraIndex => $paragraph): ?>
                        <p class="mb-5">
                            <?= htmlspecialchars($paragraph, ENT_QUOTES) ?>
                        </p>

                        <?php if(($paraIndex + 1) % 2 == 0 && isset($images[$imageIndex])): ?>
                            <figure class="my-6">
                                <img src="<?= $images[$imageIndex] ?>" class="w-full rounded-xl shadow-md" alt="">
                                <figcaption class="text-sm text-gray-400 mt-2 text-center">រូបភាពពីប្រភព</figcaption>
                            </figure>
                            <?php $imageIndex++; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    <?php if (count($images) > $imageIndex): ?>
                        <?php for ($i = $imageIndex + 1; $i < count($images); $i++): ?>
                            <figure class="my-6">
                                <img src="<?= $images[$i] ?>" class="w-full rounded-xl shadow-md" alt="">
                                <figcaption class="text-sm text-gray-400 mt-2 text-center">រូបភាពពីប្រភព</figcaption>
                            </figure>
                        <?php endfor; ?>
                    <?php endif; ?>
                </div>

                <!-- Share buttons (mobile) -->
                <div class="flex md:hidden items-center gap-3 mt-6 pt-4 border-t border-gray-200">
                    <span class="text-sm text-gray-500 koulen-regular">ចែករំលែក៖</span>
                    <a href="#"
                        class="w-9 h-9 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#"
                        class="w-9 h-9 rounded-full bg-sky-100 text-sky-600 flex items-center justify-center hover:bg-sky-500 hover:text-white transition-all">
                        <i class="bi bi-twitter"></i>
                    </a>
                    <a href="#" onclick="navigator.clipboard.writeText(window.location.href);alert('បានចម្លងតំណភ្ជាប់!');return false;"
                        class="w-9 h-9 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center hover:bg-gray-800 hover:text-white transition-all">
                        <i class="bi bi-link-45deg"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Similar articles -->
    <section class="w-full bg-gray-50 mt-10 py-8 md:py-12">
        <div class="max-w-[1024px] mx-auto px-4 md:px-0">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-red-700 rounded-xl flex items-center justify-center shadow-md">
                    <i class="bi bi-collection text-white"></i>
                </div>
                <h2 class="text-xl md:text-2xl koulen-regular text-gray-900">អត្ថបទផ្សេងទៀត</h2>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4">
                <?php foreach($newsByCategory as $item): ?>
                    <?php renderCard($item); ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const slideList = document.getElementById("slidelist");
    const dots = document.querySelectorAll(".dot");
    const prevBtn = document.getElementById("prev-slide");
    const nextBtn = document.getElementById("next-slide");

    if (!slideList || dots.length === 0) return;

    const totalSlides = dots.length;
    let index = 0;
    let autoPlay;

    const firstClone = slideList.children[0].cloneNode(true);
    slideList.appendChild(firstClone);

    function moveTo(i) {
        slideList.style.transition = "transform 0.7s ease-in-out";
        slideList.style.transform = `translateX(-${i * 100}%)`;
        index = i;
        updateDots();
    }

    function updateDots() {
        dots.forEach((dot, i) => {
            dot.classList.remove("bg-white", "w-6");
            dot.classList.add("bg-white/50", "w-2.5");
        });

        const active = index % totalSlides;
        dots[active].classList.remove("bg-white/50", "w-2.5");
        dots[active].classList.add("bg-white", "w-6");
    }

    function nextSlide() {
        let next = index + 1;
        moveTo(next);

        if (next === totalSlides) {
            setTimeout(() => {
                slideList.style.transition = "none";
                index = 0;
                slideList.style.transform = "translateX(0)";
                updateDots();
            }, 700);
        }
    }

    function prevSlide() {
        if (index === 0) {
            slideList.style.transition = "none";
            index = totalSlides;
            slideList.style.transform = `translateX(-${index * 100}%)`;
            setTimeout(() => {
                moveTo(index - 1);
            }, 50);
        } else {
            moveTo(index - 1);
        }
    }

    function startAutoPlay() {
        stopAutoPlay();
        autoPlay = setInterval(nextSlide, 4000);
    }

    function stopAutoPlay() {
        clearInterval(autoPlay);
    }

    if (prevBtn) prevBtn.addEventListener("click", () => { prevSlide(); startAutoPlay(); });
    if (nextBtn) nextBtn.addEventListener("click", () => { nextSlide(); startAutoPlay(); });

    dots.forEach(dot => {
        dot.addEventListener("click", function () {
            const i = parseInt(this.dataset.index);
            if (i !== index % totalSlides) {
                if (i < index % totalSlides && index % totalSlides !== 0) {
                    moveTo(index - ((index % totalSlides) - i));
                } else {
                    moveTo(index + (i - (index % totalSlides)));
                }
            }
            startAutoPlay();
        });
    });

    const container = document.getElementById("slider-container");
    if (container) {
        container.addEventListener("mouseenter", stopAutoPlay);
        container.addEventListener("mouseleave", startAutoPlay);
    }

    startAutoPlay();
    updateDots();
});
</script>

<?php
}
?>