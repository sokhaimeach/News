<?php
require_once "src/data/db.php";

function renderDetail($id) {
    $newsItem = getNewsById(intval($id));

    if (!$newsItem) {
        echo "<p class='text-3xl koulen-regular text-center text-gray-500 w-full h-[500px] flex items-center justify-center'>មិនមានព័ត៌មានទេសម្រាប់ប្រភេទនេះទេ</p>";
        return;
    }

    $images = $newsItem['image'];
    $paragraphs = explode("\n", trim($newsItem['content']));
    $imageIndex = 0;
?>

<section class="text-white max-w-[1360px] mx-auto siemreap-regular">
        <div class="grid grid-cols-1 lg:grid-cols-3 sm:gap-6 bg-[#1b1b1b] sm:p-4 md:p-6">

            <!-- Left News -->
            <div class="lg:col-span-1 flex flex-col justify-between max-sm:fixed max-sm:inset-0">
                <!-- slider -->
                <div class="relative w-full h-[500px] md:h-[600px] max-sm:fixed max-sm:inset-0 max-sm:w-screen max-sm:h-screen overflow-hidden">
                    <div id="slidelist" class="flex h-full transition-transform duration-700 ease-in-out">
                        <?php foreach($images as $image): ?>
                            <div class="w-full h-full shrink-0 basis-full">
                                <img class="w-full h-full object-cover" src="<?= htmlspecialchars($image, ENT_QUOTES) ?>">
                            </div>
                        <?php endforeach; ?>
                     </div>

                    <!-- dots -->
                    <ul class="absolute max-sm:top-[100px] sm:bottom-5 left-0 w-full flex justify-center gap-3 z-20">
                        <?php foreach($images as $image): ?>
                            <li class="dot w-4 h-4 rounded-full bg-white opacity-50 cursor-pointer"></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="khmer mt-16 hidden sm:flex items-center gap-2 text-lg">
                    <i class="bi bi-clock-fill"></i>
                    <span><?= formatKhmerDate($newsItem['date']) ?></span>
                </div>
            </div>

            <!-- Main News -->
            <div
                class="lg:col-span-2 z-10 max-sm:h-screen max-sm:flex max-sm:flex-col max-sm:justify-end max-sm:px-2 max-sm:bg-gradient-to-t max-sm:from-black/95 max-sm:to-transparent">
                <img src="<?= htmlspecialchars($newsItem['image'][0], ENT_QUOTES) ?>" class="w-full h-[500px] object-cover rounded  hidden sm:block"
                    alt="">

                <!-- title -->
                <h1 class="koulen text-xl sm:text-3xl lg:text-4xl leading-[1.6] mt-5">
                    <?= htmlspecialchars($newsItem['title'], ENT_QUOTES) ?>
                </h1>

                <div class="khmer flex items-center justify-end mt-6 text-lg text-gray-200">

                    <div class="flex items-center gap-2 hidden sm:flex">
                        <i class="bi bi-clock-fill"></i>
                        <span><?= timeAgoKhmer($newsItem['date']) ?></span>
                    </div>
                </div>
                <div class="border-t border-white sm:hidden"></div>

                <p class="khmer text-sm sm:text-lg leading-9 mt-8 text-gray-100">
                    <?= truncate($newsItem['content'], 170); ?>
                </p>

            </div>

            <!-- content for mobile -->
            <div class="w-full z-10 bg-white p-4 khmer leading-7 sm:hidden">

                <?php foreach($paragraphs as $index => $paragraph): ?>

                    <p class="mb-4 text-gray-700 seimreap-regular">
                        <?= $paragraph ?>
                    </p>

                    <?php if(($index + 1) % 2 == 0 && isset($images[$imageIndex])): ?>
                        <img
                            src="<?= $images[$imageIndex] ?>"
                            class="w-full rounded my-4"
                            alt=""
                        >

                        <?php $imageIndex++; ?>
                    <?php endif; ?>

                <?php endforeach; ?>
                
                
                <!-- check if there are still images left to display after the last paragraph -->
                <?php if (count($images) > $imageIndex): ?>
                    <?php for ($i = $imageIndex + 1; $i < count($images); $i++): ?>
                        <img
                            src="<?= $images[$i] ?>"
                            class="w-full rounded my-2"
                            alt=""
                        >
                    <?php endfor; ?>
                <?php endif; ?>
            </div>

        </div>

        <!-- content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 sm:gap-6 sm:p-4 md:p-6 hidden sm:grid">
            <div class="lg:col-span-1"></div>            

            <div class="lg:col-span-2 p-4 khmer leading-7">
                <?php $imageIndex = 0; ?>
                <?php foreach($paragraphs as $index => $paragraph): ?>

                    <p class="mb-4 text-gray-700 seimreap-regular">
                        <?= $paragraph ?>
                    </p>

                    <?php if(($index + 1) % 2 == 0 && isset($images[$imageIndex])): ?>
                        <img
                            src="<?= $images[$imageIndex] ?>"
                            class="w-full rounded my-4"
                            alt=""
                        >

                        <?php $imageIndex++; ?>
                    <?php endif; ?>

                <?php endforeach; ?>
                
                
                <!-- check if there are still images left to display after the last paragraph -->
                <?php if (count($images) > $imageIndex): ?>
                    <?php for ($i = $imageIndex + 1; $i < count($images); $i++): ?>
                        <img
                            src="<?= $images[$i] ?>"
                            class="w-full rounded my-2"
                            alt=""
                        >
                    <?php endfor; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php
}
?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const slideList = document.getElementById("slidelist");
    const dots = document.querySelectorAll(".dot");

    if (!slideList || dots.length === 0) return;

    const totalSlides = dots.length;
    let index = 0;

    // clone first image
    const firstSlide = slideList.children[0].cloneNode(true);
    slideList.appendChild(firstSlide);

    function moveSlide() {
        slideList.style.transition = "transform 0.7s ease-in-out";
        slideList.style.transform = `translateX(-${index * 100}%)`;
    }

    function updateDots() {
        dots.forEach(dot => {
            dot.classList.remove("opacity-100", "w-8");
            dot.classList.add("opacity-50", "w-4");
        });

        dots[index % totalSlides].classList.remove("opacity-50", "w-4");
        dots[index % totalSlides].classList.add("opacity-100", "w-8");
    }

    setInterval(() => {
        index++;
        moveSlide();
        updateDots();

        if (index === totalSlides) {
            setTimeout(() => {
                slideList.style.transition = "none";
                index = 0;
                slideList.style.transform = "translateX(0)";
            }, 700);
        }
    }, 3000);

    updateDots();
});
</script>