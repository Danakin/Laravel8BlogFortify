<div class="w-full flex flex-row flex-wrap">
    <label for="{{ $name }}" class="w-full sm:w-3/12">{{ $slot }}</label>
    <textarea name="{{ $name }}" id="{{ $name }}" cols="30" rows="10"
        class="border-2 rounded p-2 border-gray-400 focus:border-blue-300 w-full sm:w-9/12">{{ $value }}</textarea>
</div>
