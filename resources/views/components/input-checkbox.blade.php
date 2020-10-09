<div class="w-full flex flex-row flex-wrap">
    <label for="{{ $name }}" class="w-full sm:w-3/12">{{ $slot }}</label>
    <input type="checkbox" name="{{ $name }}" id="{{ $name }}" {{ $published ? "checked" : "" }}
        class="rounded p-2 border-2 border-gray-400 focus:border-blue-300 block" />
</div>
