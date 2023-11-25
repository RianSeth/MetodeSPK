<x-app-layout>
    {{-- Card WP --}}
    <div class="container mx-auto my-2 p-2 text-center rounded shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] bg-white"
        id="tab-wp">
        <!--Tabs navigation-->
        <ul class="mb-5 flex list-none flex-row flex-wrap border-b-0 pl-0">
            <li class="flex-grow basis-0 text-center">
                <a href="{{ route('krwp') }}"
                    class="my-2 block border-x-0 border-b-2 border-t-0 px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 {{ Route::is('krwp') ? 'border-blue-400' : 'border-transparent' }}">
                    Kriteria</a>
            </li>
            <li class="flex-grow basis-0 text-center">
                <a href="{{ route('alwp') }}"
                    class="my-2 block border-x-0 border-b-2 border-t-0 px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 {{ Route::is('alwp') ? 'border-blue-400' : 'border-transparent' }}">
                    Alternatif</a>
            </li>
            <li class="flex-grow basis-0 text-center">
                <a href="{{ route('datawp') }}"
                    class="my-2 block border-x-0 border-b-2 border-t-0 px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 {{ Route::is('datawp') ? 'border-blue-400' : 'border-transparent' }}">
                    Data</a>
            </li>
        </ul>

        <!--Tabs content-->
        <div class="mb-6 px-2 ">
            @yield('content')
        </div>
    </div>
    {{-- Card WP --}}

</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js">
    import {
        Input,
        initTE,
    } from "tw-elements";

    initTE({
        Input
    });
</script>
