@props([
    'title' => 'Settings',
    'translations' => collect([]),
    'selectedTranslationId' => null,
])

<div x-data="{ open: false }" x-show="open" {{-- Prevent component appear briefly when loading --}} x-cloak
    x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
    x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
    x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
    x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
    @keydown.escape.window="open = false" class="fixed inset-0 overflow-hidden z-50" aria-labelledby="slide-over-title"
    role="dialog" aria-modal="true" @open-sidebar.window="open = true">
    <div class="absolute inset-0 overflow-hidden">
        <!-- Background overlay -->
        {{-- Disable dulu sbb taklawo sbb dia slide in sekali dengan sidebar --}}
        {{-- <div
            x-show="open"
            x-transition:enter="ease-in-out duration-500"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in-out duration-500"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
            @click="open = false"
            aria-hidden="true"
        ></div> --}}

        <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
            <div class="pointer-events-auto w-screen max-w-md">
                <div class="flex h-full flex-col overflow-y-scroll backdrop-blur-sm bg-white/70 dark:bg-zinc-600/70 ">
                    <div class="px-4 py-8 sm:px-6">
                        <div class="flex items-start justify-between">
                            <h2 class="text-xl font-medium text-gray-900 dark:text-gray-100" id="slide-over-title">
                                {{ $title }}
                            </h2>
                            <div class="ml-3 flex h-7 items-center">
                                <button type="button"
                                    class="rounded-md bg-white dark:bg-gray-800 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                    @click="open = false">
                                    <span class="sr-only">Close panel</span>
                                    <x-heroicon-o-x-mark class="h-6 w-6" />
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="relative mt-6 flex-1 px-4 sm:px-6">
                        <!-- Sidebar content -->
                        <div class="space-y-6">
                            <!-- Theme Section -->
                            {{-- TODO: Implement theming --}}
                            {{-- <div>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Theme</h3>
                                <div class="mt-2 flex space-x-2">
                                    @foreach (['Auto', 'Light', 'Sepia', 'Dark'] as $theme)
                                        <button class="px-3 py-2 bg-gray-200 dark:bg-gray-700 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300">
                                            {{ $theme }}
                                        </button>
                                    @endforeach
                                </div>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                    The system theme automatically adapts to your light/dark mode settings
                                </p>
                            </div> --}}

                            <!-- Quran Font Section -->
                            {{-- <div>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Quran Font</h3>
                                <div class="mt-2 flex space-x-2">
                                    @foreach (['Uthmani', 'IndoPak', 'Tajweed'] as $font)
                                        <button class="px-3 py-2 bg-gray-200 dark:bg-gray-700 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300">
                                            {{ $font }}
                                        </button>
                                    @endforeach
                                </div>
                            </div> --}}

                            {{-- Tajwid Section --}}
                            {{-- Usage: In the page this will be used, add their own implementation of toggle tajwid. See
                            /views/quran/page/show.blade.php for example --}}
                            <div x-data="fontToggle">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Tajwid</h3>
                                <div class="mt-2 flex items-center">
                                    <span class="text-sm text-gray-700 dark:text-gray-300">Off</span>
                                    <label for="tajwid-toggle"
                                        class="ml-3 relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" @change="toggleTajwid" id="tajwid-toggle"
                                            :checked="isTajwidEnabled" class="sr-only peer">
                                        <div
                                            class="w-11 h-6 bg-zinc-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-indigo-500 dark:bg-zinc-700 rounded-full peer dark:peer-focus:ring-indigo-600 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600">
                                        </div>
                                    </label>
                                    <span class="ml-3 text-sm text-gray-700 dark:text-gray-300">On</span>
                                </div>
                                <p class="py-2 text-gray-900 dark:text-gray-100 text-muted">
                                    Preview
                                </p>

                                <div :class="isTajwidEnabled ? 'QCF4_Hafs_01_W_COLOR' : 'QCF4_Hafs_01_W'"
                                    class="text-right p-2 bg-zinc-50/90 dark:bg-zinc-800/80 rounded leading-[2] text-black dark:text-white text-3xl"
                                    dir="rtl">
                                    ‮                 
                                </div>
                                <template x-if="isTajwidEnabled">
                                    <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                                        Tajwid font is currently in development, some surah will not have the tajwid
                                        variant yet.
                                    </p>
                                </template>
                            </div>

                            <!-- Style Section -->
                            {{-- <div>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Style</h3>
                                <select class="mt-2 block w-full rounded-md border-gray-300 dark:border-gray-600 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                    <option>With Tajwid</option>
                                    <option>Simple</option>
                                    <option>Classic</option>
                                </select>
                            </div> --}}

                            <!-- Font Size Section -->
                            {{-- TODO: Complete implementation --}}
                            @if (request()->is('surah/*'))
                                <div x-data="fontSize" class="p-4">
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Font size</h3>
                                    <div class="mt-2 flex items-center space-x-4">
                                        <button @click="decreaseFontSize"
                                            class="p-2 rounded-full bg-zinc-200 dark:bg-zinc-700 focus:outline-none"
                                            :class="fontSizeIndex === 0 ? 'text-gray-300 dark:text-gray-600' :
                                                'text-gray-700 dark:text-gray-300'"
                                            :disabled="fontSizeIndex === 0">
                                            <x-heroicon-o-minus class="w-6 h-6" />
                                        </button>
                                        <span class="text-xl font-medium text-gray-900 dark:text-gray-100">
                                            <span x-text="fontSizeLabel"></span>
                                        </span>
                                        <button @click="increaseFontSize"
                                            class="p-2 rounded-full bg-zinc-200 dark:bg-zinc-700 focus:outline-none"
                                            :class="fontSizeIndex === fontSizes.length - 1 ?
                                                'text-gray-300 dark:text-gray-600' : 'text-gray-700 dark:text-gray-300'"
                                            :disabled="fontSizeIndex === fontSizes.length - 1">
                                            <x-heroicon-o-plus class="w-6 h-6" />
                                        </button>
                                    </div>
                                </div>
                            @endif

                            <!-- Translation Section -->
                            @if (request()->is('surah/*') && $translations->isNotEmpty())
                                <div x-data="translationSelector">
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Translation</h3>
                                    <div class="relative">
                                        <select @change="changeTranslation($event.target.value)"
                                            x-model="selectedTranslation" :disabled="isLoading"
                                            class="mt-2 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm disabled:opacity-50 disabled:cursor-not-allowed">
                                            <option value="">No Translation</option>
                                            @foreach ($translations as $translation)
                                                <option value="{{ $translation->id }}"
                                                    {{ $selectedTranslationId == $translation->id ? 'selected' : '' }}>
                                                    {{ Str::title($translation->authority) }}
                                                    ({{ strtoupper($translation->language_code) }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <div x-show="isLoading"
                                            class="absolute right-3 top-1/2 transform -translate-y-1/2 mt-1">
                                            <svg class="animate-spin h-5 w-5 text-indigo-600"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                                    stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor"
                                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                        <span x-show="!isLoading">Select a translation to display alongside the Quranic
                                            text</span>
                                        <span x-show="isLoading" class="text-indigo-600 dark:text-indigo-400">Loading
                                            translation...</span>
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
