<div class="w-full flex flex-row flex-wrap items-center my-1">
    <label for="{{ $name }}" class="w-full sm:w-3/12">{{ $slot }}</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
        class="w-full sm:w-9/12 p-0 border-2 rounded border-gray-400 focus:border-blue-300" value="{{ $value }}">
</div>
