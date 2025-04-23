@props(['level' => 0, 'percentage' => '0%'])

<div class="mb-4">
    <div class="flex justify-between items-center mb-2">
        <span class="text-sm font-semibold text-gray-700">
            {{ __("df_Level") }} {{ $level }}
        </span>
        <span class="text-sm text-blue-600 font-medium">{{ $percentage }}</span>
    </div>
    
    <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
        <div class="bg-blue-500 h-full rounded-full transition-all duration-300" style="width: {{ $percentage }}"></div>
    </div>
</div>
