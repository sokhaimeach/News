<?php
function renderFooter(){
?>

<footer class="w-full bg-[#1b1b1b] text-white z-50 relative">
    <div class="grid md:grid-cols-3 md:grid-rows-1 gap-4 p-5 w-full container mx-auto">
        <!-- contact -->
        <div class="md:order-1 order-2 mt-5 max-md:flex max-md:flex-col max-md:justify-center">
            <h2 class="text-2xl font-bold mb-4 koulen-regular text-white max-md:text-center">ទំនាក់ទំនង</h2>

            <!-- phone -->
            <div class="mb-6 flex gap-2 items-center siemreap-regular text-white max-md:justify-center max-md:justify-center">
                <div class="w-8 h-8 rounded-lg bg-white/10 border border-white/20 flex justify-center items-center">
                    <i class="bi bi-telephone-fill"></i>
                </div>
                 +855 123 456 789
            </div>

            <!-- email -->
            <div class="mb-6 flex gap-2 items-center siemreap-regular text-white max-md:justify-center">
                <div class="w-8 h-8 rounded-lg bg-white/10 border border-white/20 flex justify-center items-center">
                    <i class="bi bi-envelope-fill"></i>
                </div>
                 romdultoday@gmail.com
            </div>

            <!-- address -->
            <div class="mb-6 flex gap-2 items-center siemreap-regular text-white max-md:justify-center">
                <div class="w-8 h-8 rounded-lg bg-white/10 border border-white/20 flex justify-center items-center">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                 ផ្លូវលេខ 271 សង្កាត់ បឹងទំពុន ខណ្ឌ មានជ័យ រាជធានី ភ្នំពេញ
            </div>

        </div>
        
        <!-- logo animation -->
        <div class="md:order-2 order-1 flex justify-center flex flex-col gap-30 h-[300px]">
            <div class="relative top-20">
                <a href="">
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[120px] h-[120px] rounded-full bg-red-700/40 animate-ping"></div>
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[160px] h-[160px] rounded-full bg-red-700/10"></div>
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[130px] h-[130px] rounded-full bg-red-700/10"></div>
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-red-700 w-[100px] h-[100px] flex justify-center items-center rounded-full">
                        <img src="./assets/logo.png" alt="logo" class="w-[50px] object-cover rounded-full">
                    </div>
                </a>
            </div>
            <h1 class="text-center text-2xl koulen-regular mt-20 text-white leading-[42px]">សារព័ត៌មាន <span class="text-amber-500">រំដួលថ្ងៃនេះ</span><br>ដឹង! លឺ! គ្រប់ព័ត៌មាន</h1>
            
        </div>

        <!-- social media -->
        <div class="md:order-3 order-3 max-sm:mb-10 mt-5">
            <h1 class="text-center text-2xl koulen-regular text-white">បណ្ដាញសង្គម</h1>
            <div class="flex justify-center gap-4 mt-4">
                <a href="" class="w-10 h-10 rounded-lg bg-white/10 border border-white/20 flex justify-center items-center hover:bg-white/20 transition-colors duration-300 text-white">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="" class="w-10 h-10 rounded-lg bg-white/10 border border-white/20 flex justify-center items-center hover:bg-white/20 transition-colors duration-300 text-white">
                    <i class="bi bi-twitter"></i>
                </a>
                <a href="" class="w-10 h-10 rounded-lg bg-white/10 border border-white/20 flex justify-center items-center hover:bg-white/20 transition-colors duration-300 text-white">
                    <i class="bi bi-instagram"></i>
                </a>
            </div>
        </div>
    </div>

</footer>

<?php
}
?>