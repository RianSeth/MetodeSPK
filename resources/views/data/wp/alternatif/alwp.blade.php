@extends('data.wp.wp')

@section('content')
    <div x-data="{ showAddAl: false }"
        class="opacity-100 transition-opacity duration-150 ease-linear data-[te-tab-active]:flex flex-col gap-3">
        <button type="button" x-on:click="showAddAl = !showAddAl"
            class="flex items-center w-fit rounded border-2 border-primary px-6 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-primary transition duration-150 ease-in-out hover:border-primary-600 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-primary-600 focus:border-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:border-primary-700 active:text-primary-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10"
            data-te-ripple-init>
            <x-iconpark-plus-o class="mr-1 h-4 w-4" />
            Tambah Alternatif
        </button>
        @include('data.wp.alternatif.crud.add')
        <div class="relative left-3/4 mb-3 w-1/5 flex flex-row justify-between" data-te-input-wrapper-init>
            <div>
                <input type="search"
                    class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                    id="exampleSearch2" placeholder="Type query" />
                <label for="exampleSearch2"
                    class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none">Search</label>
            </div>
            <div class="flex items-center justify-center px-3">
                <x-iconpark-search-o class="h-5 w-5" />
            </div>
        </div>
        <div class="flex flex-col overflow-x-auto">
            <div class="sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                    <div class="overflow-x-auto">
                        @if ($alternatifs->count() > 0)
                            <table class="min-w-full text-left text-sm font-light">
                                <thead
                                    class="border-b bg-neutral-800 font-medium text-center text-white dark:border-neutral-500 dark:bg-neutral-900">
                                    <tr>
                                        <th scope="col" class="px-6 py-4">#</th>
                                        <th scope="col" class="px-6 py-4">Kode</th>
                                        <th scope="col" class="px-6 py-4">Nama</th>
                                        <th scope="col" class="px-6 py-4">Keterangan</th>
                                        <th scope="col" class="px-6 py-4"> - </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alternatifs as $alternatif)
                                        <tr class="border-b text-center dark:border-neutral-500 hover:bg-neutral-100">
                                            <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $loop->iteration }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ $alternatif->kode }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ $alternatif->nama }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ $alternatif->keterangan }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">
                                                <div class="mb-4 flex items-center justify-center">
                                                    <div class="inline-flex rounded-md shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
                                                        role="group">
                                                        <button type="button"
                                                            class="inline-block rounded-l bg-warning px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white transition duration-150 ease-in-out hover:bg-warning-600 focus:bg-warning-600 focus:outline-none focus:ring-0 active:bg-warning-700"
                                                            data-te-ripple-init data-te-ripple-color="light">
                                                            Ubah
                                                        </button>
                                                        <button type="button"
                                                            class="inline-block rounded-r bg-danger px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white transition duration-150 ease-in-out hover:bg-danger-600 focus:bg-danger-600 focus:outline-none focus:ring-0 active:bg-danger-700"
                                                            data-te-ripple-init data-te-ripple-color="light">
                                                            Hapus
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-center font-bold"> === Belum Ada Data === </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
