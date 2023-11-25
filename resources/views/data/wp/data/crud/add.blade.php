<div x-show="showAddData" class="absolute left-0 top-0 w-full h-screen mt-2 flex justify-center items-center z-50"">
    <div x-on:click="showAddData = !showAddData" class="fixed left-0 top-0 w-full h-screen bg-black/50"></div>

    <div x-transition
        class="block w-1/2 rounded-lg bg-white p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700 z-50">
        <h5 class="mb-2 text-start text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
            Tambah Data
        </h5>
        <form action="{{ route('datawpcreate') }}" method="post">
            @csrf

            <div class="mb-4 text-base text-neutral-600 dark:text-neutral-200">
                <div class="relative mb-3">
                    <select data-te-select-init data-te-select-filter="true" data-te-select-clear-button="true" name="alternatifwp_id">
                        <option value="">==Select Alternatif==</option>
                        @foreach ($alternatifs as $alternatif)
                        <option value="{{ $alternatif->id }}">{{ $alternatif->kode }} - {{ $alternatif->nama }}</option>
                        @endforeach
                    </select>
                    <label data-te-select-label-ref>Alternatif</label>
                </div>

                <div class="relative mb-3">
                    <select data-te-select-init data-te-select-filter="true" data-te-select-clear-button="true" name="kriteriawp_id">
                        <option value="">==Select Kriteria==</option>
                        @foreach ($kriterias as $kriteria)
                        <option value="{{ $kriteria->id }}">{{ $kriteria->kode }} - {{ $kriteria->kriteria }}</option>
                        @endforeach
                    </select>
                    <label data-te-select-label-ref>Kriteria</label>
                </div>

                <div class="relative mb-3" data-te-input-wrapper-init>
                    <input type="number" name="value"
                        class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                        id="exampleFormControlInputText" placeholder="Masuk Value..." />
                    <label for="exampleFormControlInputText"
                        class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">
                        Value
                    </label>
                </div>

            </div>
            <button type="submit"
                class="inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
                data-te-ripple-init data-te-ripple-color="light">
                Simpan
            </button>
            <button type="button" x-on:click="showAddAl = !showAddAl"
                class="inline-block rounded bg-warning px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-warning-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-warning-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-warning-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
                data-te-ripple-init data-te-ripple-color="light" onclick="event.preventDefault();">
                Kembali
            </button>
        </form>
    </div>
</div>
