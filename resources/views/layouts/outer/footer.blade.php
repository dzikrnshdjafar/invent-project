<footer class="text-white bg-[#001C0B] mt-10 relative z-10">
    <div class="container mx-auto p-6 grid grid-cols-1 md:grid-cols-3 gap-4 py-24 px-20">
        <!-- Kontak Kami Section -->
        <div class="mb-8">
            <h3 class="font-bold text-lg mb-4 title-with-border">Kontak Kami</h3>
            <p class="mb-2">Jl. Moh Van Gobel No. 270</p>
            <p><a href="mailto:bsip.gorontalo@pertanian.go.id" class="underline">bsip.gorontalo@pertanian.go.id</a></p>
        </div>
        
        <div class="mb-8">
            <h3 class="font-bold text-lg mb-4 title-with-border">Statistik Web</h3>
            <p class="mb-2">Total Pengunjung: <span class="font-bold">{{ $totalVisitors }}</span></p>
            <p class="mb-2">Hari ini: <span class="font-bold">{{ $todayVisitors }}</span></p>
            <p>Kemarin: <span class="font-bold">{{ $yesterdayVisitors }}</span></p>
        </div>
        
        
    
        <!-- Map Section -->
        <div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d249.3520490752413!2d123.11686579872014!3d0.5525554164294187!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x327ed5a6d6802eed%3A0x56bdf0afcf4fd9b0!2sBadan%20Standardisasi%20Intrumen%20Pertanian%20(BSIP)%20Gorontalo!5e0!3m2!1sid!2sid!4v1723743899093!5m2!1sid!2sid" height="203" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="rounded-2xl md:w-96 "></iframe>
        </div>
    </div>
    

    <div class="border-t border-grey p-3">
        <div class="container mx-auto p-4 flex justify-between items-center px-20">
            <!-- Copyright Section -->
            <p class="text-sm">
                Copyrights © 2024 - <span class="font-bold">Badan Standardisasi Instrumen Pertanian, <br>Kementerian Pertanian Gorontalo</span>, all Rights Reserved.
            </p>
            <!-- Social Media Links -->
            <div class="flex space-x-4">
                <a href="#" class="hover:underline">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="w-5 h-5 rounded-md">
                        <path d="M22.675 0h-21.35C.597 0 0 .597 0 1.326v21.348C0 23.403.597 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.892-4.788 4.655-4.788 1.325 0 2.463.099 2.795.143v3.243h-1.918c-1.503 0-1.794.714-1.794 1.763v2.31h3.587l-.467 3.622h-3.12V24h6.117c.728 0 1.325-.597 1.325-1.326V1.326C24 .597 23.403 0 22.675 0z"/>
                    </svg>
                    
                </a>
                <a href="#" class="hover:underline">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="w-5 h-5 rounded-md">
                        <path d="M23.954 4.569c-.885.392-1.83.656-2.825.775 1.014-.608 1.793-1.574 2.163-2.723-.951.566-2.005.978-3.127 1.2a4.512 4.512 0 00-7.691 4.116c-3.746-.188-7.066-1.979-9.293-4.707a4.511 4.511 0 001.399 6.04 4.481 4.481 0 01-2.044-.567v.056a4.518 4.518 0 003.617 4.425c-.5.137-1.028.211-1.571.211-.382 0-.754-.038-1.112-.106a4.516 4.516 0 004.215 3.126 9.05 9.05 0 01-6.69 1.876 12.822 12.822 0 006.92 2.036c8.307 0 12.847-6.874 12.847-12.847 0-.196-.004-.392-.012-.587a9.192 9.192 0 002.25-2.338z"/>
                    </svg>
                    
                </a>
                <a href="#" class="hover:underline">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="w-5 h-5 rounded-md">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.17.056 1.96.244 2.416.418a4.925 4.925 0 011.69 1.09 4.925 4.925 0 011.09 1.69c.174.456.362 1.246.418 2.416.058 1.267.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.056 1.17-.244 1.96-.418 2.416a4.92 4.92 0 01-1.09 1.69 4.926 4.926 0 01-1.69 1.09c-.456.174-1.246.362-2.416.418-1.267.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.17-.056-1.96-.244-2.416-.418a4.922 4.922 0 01-1.69-1.09 4.922 4.922 0 01-1.09-1.69c-.174-.456-.362-1.246-.418-2.416-.058-1.267-.07-1.646-.07-4.85s.012-3.584.07-4.85c.056-1.17.244-1.96.418-2.416a4.922 4.922 0 011.09-1.69 4.922 4.922 0 011.69-1.09c.456-.174 1.246-.362 2.416-.418C8.416 2.175 8.796 2.163 12 2.163zm0-2.163C8.735 0 8.333.013 7.052.073 5.772.132 4.752.324 3.91.632a7.084 7.084 0 00-2.49 1.645A7.09 7.09 0 00.632 3.91c-.308.842-.5 1.862-.559 3.142C.013 8.333 0 8.735 0 12s.013 3.667.073 4.948c.059 1.28.251 2.3.559 3.142a7.093 7.093 0 001.645 2.49 7.084 7.084 0 002.49 1.645c.842.308 1.862.5 3.142.559C8.333 23.987 8.735 24 12 24s3.667-.013 4.948-.073c1.28-.059 2.3-.251 3.142-.559a7.084 7.084 0 002.49-1.645 7.084 7.084 0 001.645-2.49c.308-.842.5-1.862.559-3.142.06-1.281.073-1.683.073-4.948s-.013-3.667-.073-4.948c-.059-1.28-.251-2.3-.559-3.142a7.084 7.084 0 00-1.645-2.49 7.084 7.084 0 00-2.49-1.645C19.333.132 18.313.13 17.032.073 15.751.013 15.349 0 12 0zm0 5.838a6.162 6.162 0 00-6.162 6.162A6.162 6.162 0 0012 18.162 6.162 6.162 0 0018.162 12 6.162 6.162 0 0012 5.838zm0 10.123a3.961 3.961 0 110-7.923 3.961 3.961 0 010 7.923zm6.406-11.845a1.44 1.44 0 11-2.88 0 1.44 1.44 0 012.88 0z"/>
                    </svg>
                                     
                </a>
            </div>
        </div>
    </div>
</footer>