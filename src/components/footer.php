<?php
function renderFooter(){
?>

<footer class="w-full bg-[#1b1b1b] text-white z-50 relative mt-5">
    <!-- main footer content -->
    <div class="max-w-[1024px] mx-auto grid md:grid-cols-3 gap-8 md:gap-12 px-5 py-10 md:py-14">

        <!-- contact -->
        <div class="md:order-1">
            <h2 class="text-xl koulen-regular text-white mb-5 flex items-center gap-2">
                <i class="bi bi-info-circle text-amber-400"></i>
                ទំនាក់ទំនង
            </h2>

            <div class="space-y-4">
                <div class="flex gap-3 items-start siemreap-regular text-white/80 text-sm">
                    <div class="w-8 h-8 rounded-lg bg-white/10 border border-white/10 flex justify-center items-center shrink-0 mt-0.5">
                        <i class="bi bi-telephone-fill text-xs"></i>
                    </div>
                    <span>+855 123 456 789</span>
                </div>

                <div class="flex gap-3 items-start siemreap-regular text-white/80 text-sm">
                    <div class="w-8 h-8 rounded-lg bg-white/10 border border-white/10 flex justify-center items-center shrink-0 mt-0.5">
                        <i class="bi bi-envelope-fill text-xs"></i>
                    </div>
                    <span>romdultoday@gmail.com</span>
                </div>

                <div class="flex gap-3 items-start siemreap-regular text-white/80 text-sm">
                    <div class="w-8 h-8 rounded-lg bg-white/10 border border-white/10 flex justify-center items-center shrink-0 mt-0.5">
                        <i class="bi bi-geo-alt-fill text-xs"></i>
                    </div>
                    <span>ផ្លូវលេខ 271 សង្កាត់ បឹងទំពុន ខណ្ឌ មានជ័យ រាជធានី ភ្នំពេញ</span>
                </div>
            </div>
        </div>

        <!-- center logo -->
        <div class="md:order-2 flex flex-col items-center justify-center py-6 md:py-0 border-y md:border-y-0 border-white/10">
            <div class="relative w-[90px] h-[90px] md:w-[100px] md:h-[100px] mb-4">
                <div class="absolute inset-0 rounded-full bg-red-700/30 animate-ping"></div>
                <div class="absolute inset-[-15px] rounded-full bg-red-700/10"></div>
                <div class="absolute inset-[-8px] rounded-full bg-red-700/10"></div>
                <a href="" class="relative bg-red-700 w-full h-full flex justify-center items-center rounded-full shadow-lg shadow-red-700/30">
                    <img src="./assets/logo.png" alt="logo" class="w-[45px] object-cover rounded-full">
                </a>
            </div>
            <h3 class="text-center koulen-regular text-white text-lg leading-7">
                សារព័ត៌មាន <span class="text-amber-500">រំដួលថ្ងៃនេះ</span><br>
                <span class="text-sm text-white/50 siemreap-regular">ដឹង! លឺ! គ្រប់ព័ត៌មាន</span>
            </h3>
        </div>

        <!-- social media -->
        <div class="md:order-3">
            <h2 class="text-xl koulen-regular text-white mb-5 flex items-center gap-2 md:justify-end">
                បណ្ដាញសង្គម
                <i class="bi bi-share text-amber-400"></i>
            </h2>
            <div class="flex md:justify-end gap-3">
                <a href="" class="w-10 h-10 rounded-lg bg-white/10 border border-white/10 flex justify-center items-center hover:bg-[#1877F2] hover:border-[#1877F2] transition-all duration-200 text-white/80 hover:text-white" title="Facebook">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="" class="w-10 h-10 rounded-lg bg-white/10 border border-white/10 flex justify-center items-center hover:bg-[#1DA1F2] hover:border-[#1DA1F2] transition-all duration-200 text-white/80 hover:text-white" title="Twitter">
                    <i class="bi bi-twitter"></i>
                </a>
                <a href="" class="w-10 h-10 rounded-lg bg-white/10 border border-white/10 flex justify-center items-center hover:bg-[#E4405F] hover:border-[#E4405F] transition-all duration-200 text-white/80 hover:text-white" title="Instagram">
                    <i class="bi bi-instagram"></i>
                </a>
            </div>
        </div>

    </div>

    <!-- copyright bar -->
    <div class="border-t border-white/10">
        <div class="max-w-[1024px] mx-auto px-5 py-4 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-white/40 siemreap-regular">
            <span>&copy; <?= date('Y') ?> រំដួលថ្ងៃនេះ។ រក្សាសិទ្ធិគ្រប់យ៉ាង។</span>
            <span>ព័ត៌មាន &amp; បច្ចេកវិទ្យា</span>
        </div>
    </div>
</footer>

<?php
}
?>