<x-app-layout>
    <div class="container mx-auto my-5 text-center">
        <select id="decisionSelect" data-te-select-init data-te-select-filter="true" data-te-select-clear-button="true"
            data-te-select-size="lg">
            <option value="" hidden selected></option>
            <option value="1">WEIGHTED PRODUCT METHOD</option>
            <option value="2">SIMPLE ADDITIVE WEIGHTING METHOD</option>
        </select>
        <label data-te-select-label-ref>Choose Decision Support System</label>
    </div>

    {{-- Card Instruction --}}
    <div class="container hidden mx-auto my-2 p-8 text-center rounded shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] bg-black"
        id="tab-instruct">
        <div class="flex items-center justify-between flex-row gap-5">
            <div class="flex justify-center border-l-2 border-l-white">
                <x-iconpark-one class="w-2/4 text-white" />
            </div>
            <div class="flex flex-col gap-5 w-2/4">
                <span class="text-2xl text-start text-white">Choose the method to be used</span>
                <span class="border-b-2 border-b-white"></span>
                <span class="text-2xl text-end text-white">Enter all the required data</span>
            </div>
            <div class="flex justify-center border-r-2 border-r-white">
                <x-iconpark-data class="w-2/4 text-white" />
            </div>
        </div>
    </div>

    {{-- Card WP --}}
    <div class="container mx-auto my-2 p-2 text-center rounded shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] bg-white"
        id="tab-wp">
        <!--Tabs navigation-->
        <ul class="mb-5 flex list-none flex-row flex-wrap border-b-0 pl-0" role="tablist" data-te-nav-ref>
            <li role="presentation" class="flex-grow basis-0 text-center">
                <a href="#tabs-home02"
                    class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400"
                    data-te-toggle="pill" data-te-target="#tabs-home02" data-te-nav-active role="tab"
                    aria-controls="tabs-home02" aria-selected="true">Kriteria</a>
            </li>
            <li role="presentation" class="flex-grow basis-0 text-center">
                <a href="#tabs-profile02"
                    class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400"
                    data-te-toggle="pill" data-te-target="#tabs-profile02" role="tab" aria-controls="tabs-profile02"
                    aria-selected="false">Alternatif</a>
            </li>
            <li role="presentation" class="flex-grow basis-0 text-center">
                <a href="#tabs-messages02"
                    class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400"
                    data-te-toggle="pill" data-te-target="#tabs-messages02" role="tab"
                    aria-controls="tabs-messages02" aria-selected="false">Data</a>
            </li>
        </ul>

        <!--Tabs content-->
        <div class="mb-6 px-2 ">
            {{-- Tab WP --}}
            <div class="hidden opacity-100 transition-opacity duration-150 ease-linear data-[te-tab-active]:flex flex-col gap-3"
                id="tabs-home02" role="tabpanel" aria-labelledby="tabs-home-tab02" data-te-tab-active>
                @include('data.wp.krwp')
            </div>

            {{-- Tab SAW --}}
            <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
                id="tabs-profile02" role="tabpanel" aria-labelledby="tabs-profile-tab02">
                Tab 2 content
            </div>

            <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
                id="tabs-messages02" role="tabpanel" aria-labelledby="tabs-profile-tab02">
                Tab 3 content
            </div>
        </div>
    </div>
    {{-- Card WP --}}

</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js">
    // Initialization for ES Users
    import {
        Tab,
        Dropdown,
        Ripple,
        Select,
        Input,
        initTE,
    } from "tw-elements";

    initTE({
        Tab,
        Dropdown,
        Ripple,
        Select,
        Input
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Mendapatkan elemen <select> berdasarkan ID
        const selectElement = document.getElementById("decisionSelect");
        const tabInstruct = document.getElementById("tab-instruct");
        const tabWP = document.getElementById("tab-wp");
        const tanSAW = document.getElementById("tab-saw");

        // Menambahkan event listener untuk perubahan dalam <select>
        selectElement.addEventListener("change", function() {
            // Mengambil nilai (value) dari pilihan yang dipilih
            const selectedValue = selectElement.value;

            if (selectedValue === "1") {
                tabInstruct.style.display = "none";
                tabWP.style.display = "block";
                tabSAW.style.display = "none";
            } else if (selectedValue === "2") {
                tabInstruct.style.display = "none";
                tabWP.style.display = "none";
                tabSAW.style.display = "block";
            } else {
                tabInstruct.style.display = "block";
                tabWP.style.display = "none";
                tabSAW.style.display = "none";
            }
        });

        // Inisialisasi tampilan berdasarkan pilihan awal
        const initialOption = selectElement.value;
        if (initialOption === "1") {
            tabInstruct.style.display = "none";
            tabWP.style.display = "block";
            tabSAW.style.display = "none";
        } else if (selectedValue === "2") {
            tabInstruct.style.display = "none";
            tabWP.style.display = "none";
            tabSAW.style.display = "block";
        } else {
            tabInstruct.style.display = "block";
            tabWP.style.display = "none";
            tabSAW.style.display = "none";
        }
    });
</script>
