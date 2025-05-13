<?php
$menu = [
  ["name" => __("Dashboard"), "href" => "/dashboard"],
  ["name" => __("Profile"), "href" => "/profile"],
  ["name" => __("Projects"), "href" => "/projects"],
  ["name" => __("Points"), "href" => "/points"],
];

if(Auth::check()){
  if(auth()->user()->isTranslator()){
    // $menu[] = ["name" => "Verification", "href" => route("verify")];
  }
  $menu[] = ["name" => __("Logout"), "href" => "/logout"];
  
} else {
  // hide everything else
  $menu= [["name" => __("Login"), "href" => "/login"],
  ["name" => __("Register"), "href" => "/signup"]];
}


?>
<!-- Burger Button (Mobile) -->
<button class="md:hidden text-gray-700 focus:outline-none" @click="open = !open" >
  <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"
    stroke-linejoin="round">
    <path d="M4 6h16M4 12h16M4 18h16" />
  </svg>
</button>



<!-- Menu (Desktop) -->
<nav class="hidden md:block">
  <ul class="flex ">
    @foreach ($menu as $item)
    <li><a href="{{ $item["href"] }}" class="text-gray-700 hover:text-blue-600 mx-2">{{$item['name']}}</a></li>
  @endforeach
  </ul>
</nav>
</div>

<!-- Menu (Mobile) -->
<nav class="mt-4 md:hidden" x-show="open" x-transition>
  <ul class="flex flex-col space-y-2">
    @foreach ($menu as $item)
    <li><a href="{{ $item["href"] }}" class="text-gray-700 hover:text-blue-600">{{$item['name']}}</a></li>
  @endforeach
  </ul>
</nav>