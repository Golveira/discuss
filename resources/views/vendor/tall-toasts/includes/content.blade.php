<div class="pointer-events-auto z-50 cursor-pointer select-none overflow-hidden rounded-md p-5 shadow ltr:border-l-8 rtl:border-r-8"
    x-bind:class="{
        'bg-blue-700': toast.type === 'info',
        'bg-green-700': toast.type === 'success',
        'bg-yellow-600': toast.type === 'warning',
        'bg-red-700': toast.type === 'danger'
    }">
    <div class="flex items-center justify-between space-x-2 rtl:space-x-reverse">
        @include('tall-toasts::includes.icon')

        <div class="flex-1 ltr:mr-2 rtl:ml-2">
            <div class="font-large mb-1 text-lg font-black uppercase tracking-widest text-gray-900 dark:text-gray-100"
                x-html="toast.title" x-show="toast.title !== undefined"></div>

            <div class="font-bold text-white" x-show="toast.message !== undefined" x-html="toast.message">
            </div>
        </div>
    </div>
</div>
