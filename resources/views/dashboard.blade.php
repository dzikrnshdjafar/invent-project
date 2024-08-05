<!-- resources/views/dashboard.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="row">
        <x-statistics.info-card 
            :title="'Total Items'" 
            :value="$totalItems" 
            :iconColor="'green'" 
            :iconClass="'fas fa-boxes'" 
        />

        <x-statistics.info-card 
            :title="'Total Rooms'" 
            :value="$totalRooms" 
            :iconColor="'blue'" 
            :iconClass="'fas fa-door-open'" 
        />

        <x-statistics.info-card 
            :title="'Total Loans'" 
            :value="$totalLoans" 
            :iconColor="'orange'" 
            :iconClass="'fas fa-handshake'" 
        />

        <x-statistics.info-card 
            :title="'Pending Loans'" 
            :value="$pendingLoansCount" 
            :iconColor="'red'" 
            :iconClass="'fas fa-hourglass-half'" 
        />
    </div>

    <!-- Include chart-card component wrapping chart-bar component -->
    <x-statistics.chart-card title="Grafik Jumlah Barang Berdasarkan Ruangan">
        <x-chart-bar
            chartID="chartItemsEachRoomsCount"
            :series="$charts['items_each_rooms_count']['series']"
            :categories="$charts['items_each_rooms_count']['categories']"
            :colors="$charts['items_each_rooms_count']['colors']"
        />
    </x-statistics.chart-card>
</x-app-layout>
