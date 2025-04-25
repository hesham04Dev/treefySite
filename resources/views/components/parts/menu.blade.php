<?php
$menu = [
  ["name" => "Dashboard", "href" => "/dashboard"],
  ["name" => "Profile", "href" => "/profile"],
  ["name" => "Projects", "href" => "/projects"],
];

if(Auth::check()){
  $menu[] = ["name" => "Logout", "href" => "/logout"];
} else {
  // hide everything else
  $menu= [["name" => "Login", "href" => "/login"],
  ["name" => "Register", "href" => "/signup"]];
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
  <ul class="flex space-x-6">
    @foreach ($menu as $item)
    <li><a href="{{ $item["href"] }}" class="text-gray-700 hover:text-blue-600">{{$item['name']}}</a></li>
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