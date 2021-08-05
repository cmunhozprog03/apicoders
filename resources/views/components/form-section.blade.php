<div {{ $attributes->merge(["class" => "md:grid md:grid-cols-3 md:gap-6"]) }}>
    <div class="px-4 sm:px-0">
        <h1 class="text-lg font-medium text-gray-900">
            {{ $title }}
        </h1>
        <p class="mt-1 text-sm text-gray-600">
            {{ $description }}
        </p>

    </div>
    <div class="mt-5 sm:mt-0 md:col-span-2">
        <div class="px-6 py-5 sm:p-6 bg-gray-300 shadow rounded-tl-md rounded-tr-md">

            {{ $slot }}
        </div>
        <div class="px-6 py-3 bg-gray-100 shadow flex justify-end items-center
            rounded-bl-md rounded-br-md">
            <x-button>
                {{ $actions }}
            </x-button>
        </div>
    </div>
</div>
