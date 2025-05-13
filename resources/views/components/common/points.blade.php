<div class="p-4 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg text-white shadow-md text-center flex flex items-center justify-center gap-2">
    <div class="text-lg font-medium">{{__("your_points")}}</div>
    <div class="text-3xl font-bold mt-1">
        <x-common.animated-number :to="$points" :duration="1"/>
    </div>
 </div>
