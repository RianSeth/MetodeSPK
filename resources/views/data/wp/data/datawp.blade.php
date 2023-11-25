@extends('data.wp.wp')

@section('content')
    @if ($datawps->count() > 0)
        <form onsubmit="return confirm('Apakah Anda Yakin Untuk Menghapus Data?');" action="{{ route('datadestroy') }}"
            method="post">
            @csrf
            <button type="submit"
                class="flex items-center w-auto rounded border-2 border-primary px-2 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-primary transition duration-150 ease-in-out hover:border-primary-600 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-primary-600 focus:border-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:border-primary-700 active:text-primary-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10">
                <x-iconpark-deletethree-o class="w-8 h-8" />
            </button>
        </form>
    @endif
    <form action="{{ route('datawpcreate') }}" method="post"
        class="opacity-100 transition-opacity duration-150 ease-linear data-[te-tab-active]:flex flex-col gap-3">
        @csrf
        <button type="submit"
            class="flex items-center w-44 rounded border-2 border-primary px-6 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-primary transition duration-150 ease-in-out hover:border-primary-600 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-primary-600 focus:border-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:border-primary-700 active:text-primary-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10"
            data-te-ripple-init {{ $datawps->count() > 0 ? 'disabled' : '' }}>
            <x-iconpark-plus-o class="mr-1 h-4 w-4" />
            Tambah Data
        </button>
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
                        <table class="min-w-full text-left text-sm font-light">
                            <thead
                                class="border-b bg-neutral-800 font-medium text-center text-white dark:border-neutral-500 dark:bg-neutral-900">
                                <tr>
                                    <th scope="col" class="px-6 py-4">#</th>
                                    <th scope="col" class="px-6 py-4">Alternatif</th>
                                    @foreach ($kriterias as $kriteria)
                                        <th scope="col" class="px-6 py-4">{{ $kriteria->kode }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alternatifs as $alternatif)
                                    <tr class="border-b text-center dark:border-neutral-500 hover:bg-neutral-100">
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">
                                            {{ $loop->iteration }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{ $alternatif->kode }}</td>
                                        @foreach ($kriterias as $kriteria)
                                            @php
                                                $datawp = $datawps
                                                    ->where('kriteriawp_id', $kriteria->id)
                                                    ->where('alternatifwp_id', $alternatif->id)
                                                    ->first();
                                            @endphp
                                            <td class="whitespace-nowrap py-4">
                                                @if ($datawps->count() > 0)
                                                    <input type="number"
                                                        name="data[{{ $alternatif->id }}][{{ $kriteria->id }}][value]"
                                                        value="{{ $datawp->value }}"
                                                        class="block w-24 rounded border-0 border-b-2 bg-transparent px-3 py-[0.32rem] mx-auto"
                                                        readonly>
                                                    <input type="hidden"
                                                        name="data[{{ $alternatif->id }}][{{ $kriteria->id }}][id_alternatif]"
                                                        value="{{ $alternatif->id }}">
                                                    <input type="hidden"
                                                        name="data[{{ $alternatif->id }}][{{ $kriteria->id }}][id_kriteria]"
                                                        value="{{ $kriteria->id }}">
                                                @else
                                                    <input type="number"
                                                        name="data[{{ $alternatif->id }}][{{ $kriteria->id }}][value]"
                                                        value=""
                                                        class="block w-24 rounded border-0 border-b-2 bg-transparent px-3 py-[0.32rem] mx-auto"
                                                        placeholder="{{ $alternatif->kode }} - {{ $kriteria->kode }}">
                                                    <input type="hidden"
                                                        name="data[{{ $alternatif->id }}][{{ $kriteria->id }}][id_alternatif]"
                                                        value="{{ $alternatif->id }}">
                                                    <input type="hidden"
                                                        name="data[{{ $alternatif->id }}][{{ $kriteria->id }}][id_kriteria]"
                                                        value="{{ $kriteria->id }}">
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
