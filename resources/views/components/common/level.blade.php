@props(['level' => 0, 'percentage' => '0%'])

<div class="" style="width:150px">
    <div class="flex justify-between items-center mb-2">
        <span class="text-sm font-semibold text-gray-800">
            {{ "df_Level $level" }}
        </span>
    </div>
    <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
        <div class="bg-blue-500 h-full rounded-full" style="width: {{ $percentage }}"></div>
    </div>
</div>