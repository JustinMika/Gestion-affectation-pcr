<div class="relative bg-white shadow-md dark:bg-gray-800 sm:rounded-lg mb-3">
    <div class="flex flex-col_  justify-between items-baseline p-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
        <div class="w-full md:w-1/2">
            <form class="flex items-center">
                <!-- Emplacement de slot nommé 'left' -->
                {{ $left ?? '' }}
            </form>
        </div>
        <div class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
            <!-- Emplacement de slot nommé 'right' -->
            {{ $right ?? '' }}
        </div>
    </div>
</div>
