<x-layouts.base>

{{--     
      <!-- Navbar -->
      <header class="navbar">
        <div class="container">
          <div class="logo">🌳 Treefy</div>
          <nav>
            <a href="#features">Features</a>
            <a href="#how-it-works">How It Works</a>
            <a href="#faq">FAQ</a>
            <a class="button" href="#">Download</a>
          </nav>
        </div>
      </header>
    
      <!-- Hero Section -->
      <section class="hero">
        <div class="container">
          <h1>AI-powered Localization Helper</h1>
          <p>Add, manage, and expand your app’s localizations effortlessly.</p>
          <a href="#" class="button big">Get Started</a>
        </div>
      </section>
    
      <!-- Features Section -->
      <section id="features" class="features">
        <div class="container">
          <h2>Empower Your App to Speak Every Language</h2>
          <div class="features-grid">
            <div class="feature-item">✅ Automatic Language Detection</div>
            <div class="feature-item">✅ AI-Powered Translations</div>
            <div class="feature-item">✅ Human Verification System</div>
            <div class="feature-item">✅ Multi-Platform Support</div>
          </div>
        </div>
      </section>
    
      <!-- How It Works Section -->
      <section id="how-it-works" class="how-it-works">
        <div class="container">
          <h2>How It Works</h2>
          <div class="steps">
            <div class="step">🔹 Upload Your Project</div>
            <div class="step">🔹 AI-Assisted Translation</div>
            <div class="step">🔹 Human Verification</div>
            <div class="step">🔹 Export Ready Files</div>
          </div>
        </div>
      </section>
    
      <!-- FAQ Section -->
      <section id="faq" class="faq">
        <div class="container">
          <h2>FAQ</h2>
          <div class="faq-item">
            <h3>Is Treefy free?</h3>
            <p>Yes! Treefy is open-source and free for developers.</p>
          </div>
          <div class="faq-item">
            <h3>Which frameworks are supported?</h3>
            <p>Flutter, Web, Android, iOS, JSON, ARB, YAML, and CSV formats.</p>
          </div>
          <div class="faq-item">
            <h3>Can I customize translations?</h3>
            <p>Absolutely. You can manually edit or review translations anytime.</p>
          </div>
        </div>
      </section>
    
      <!-- Footer -->
      <footer class="footer">
        <div class="container">
          <p>© 2025 Treefy. Localize Smarter. Grow Faster.</p>
        </div>
      </footer>
    

     --}}
    

     <div>
      <!-- Navbar -->
      <header class="sticky top-0 z-50 w-full border-b bg-white/80 backdrop-blur-sm">
          <div class="container mx-auto px-4">
              <div class="flex h-16 items-center justify-between">
                  <div class="flex items-center">
                      <a href="/" class="flex items-center space-x-2">
                          <span class="text-2xl">🌳</span>
                          <span class="text-xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">
                              Treefy
                          </span>
                      </a>
                  </div>
  
                  <!-- Desktop Navigation -->
                  <nav class="hidden md:flex items-center space-x-8">
                      <a href="#features" class="text-sm font-medium hover:text-green-600 transition-colors">Features</a>
                      <a href="#how-it-works" class="text-sm font-medium hover:text-green-600 transition-colors">How It Works</a>
                      <a href="#faq" class="text-sm font-medium hover:text-green-600 transition-colors">FAQ</a>
                      <a href="#" class="inline-flex items-center justify-center whitespace-nowrap rounded-md bg-gradient-to-r from-green-600 to-emerald-600 px-4 py-2 text-sm font-medium text-white hover:opacity-90 transition-colors">
                          Download
                      </a>
                  </nav>
  
                  <!-- Mobile Menu Button -->
                  <button 
                      class="md:hidden"
                      x-data="{ open: false }"
                      @click="open = !open"
                  >
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-16 6h16" />
                      </svg>
                  </button>
              </div>
  
              <!-- Mobile Navigation -->
              <div 
                  x-data="{ open: false }" 
                  x-show="open" 
                  x-transition:enter="transition ease-out duration-200"
                  x-transition:enter-start="opacity-0 -translate-y-2"
                  x-transition:enter-end="opacity-100 translate-y-0"
                  x-transition:leave="transition ease-in duration-150"
                  x-transition:leave-start="opacity-100 translate-y-0"
                  x-transition:leave-end="opacity-0 -translate-y-2"
                  class="md:hidden py-4"
              >
                  <nav class="flex flex-col space-y-4">
                      <a href="#features" class="text-sm font-medium hover:text-green-600 transition-colors">Features</a>
                      <a href="#how-it-works" class="text-sm font-medium hover:text-green-600 transition-colors">How It Works</a>
                      <a href="#faq" class="text-sm font-medium hover:text-green-600 transition-colors">FAQ</a>
                      <a href="#" class="inline-flex items-center justify-center whitespace-nowrap rounded-md bg-gradient-to-r from-green-600 to-emerald-600 px-4 py-2 text-sm font-medium text-white hover:opacity-90 transition-colors w-full">
                          Download
                      </a>
                  </nav>
              </div>
          </div>
      </header>
  
      <!-- Hero Section -->
      <section class="container mx-auto px-4 py-20 text-center">
          <h1 class="text-5xl md:text-6xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent mb-6 animate-fade-in">
              AI-powered Localization Helper
          </h1>
          <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
              Add, manage, and expand your app's localizations effortlessly with the power of AI.
          </p>
          <a href="#" class="inline-flex items-center justify-center whitespace-nowrap rounded-md bg-gradient-to-r from-green-600 to-emerald-600 px-8 py-6 text-lg font-medium text-white hover:opacity-90 transition-colors">
              Get Started
          </a>
      </section>
  
      <!-- Features Section -->
      <section id="features" class="container mx-auto px-4 py-20">
          <h2 class="text-3xl font-bold text-center mb-12">
              Empower Your App to Speak Every Language
          </h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
              @foreach(['Automatic Language Detection', 'AI-Powered Translations', 'Human Verification System', 'Multi-Platform Support'] as $feature)
                  <div class="p-6 rounded-lg border bg-white/50 backdrop-blur-sm hover:shadow-lg transition-all">
                      <div class="flex items-center space-x-3">
                          <span class="text-green-600 text-xl">✓</span>
                          <h3 class="font-semibold">{{ $feature }}</h3>
                      </div>
                  </div>
              @endforeach
          </div>
      </section>
  
      <!-- How It Works Section -->
      <section id="how-it-works" class="container mx-auto px-4 py-20 bg-gradient-to-b from-white to-gray-50">
          <h2 class="text-3xl font-bold text-center mb-12">
              How It Works
          </h2>
          <div class="grid grid-cols-1 md:grid-cols-4 gap-8 max-w-4xl mx-auto">
              @foreach(['Upload Your Project', 'AI-Assisted Translation', 'Human Verification', 'Export Ready Files'] as $step)
                  <div class="p-6 rounded-lg border bg-white/50 backdrop-blur-sm hover:shadow-lg transition-all text-center">
                      <div class="mb-4 text-2xl">🔹</div>
                      <h3 class="font-semibold">{{ $step }}</h3>
                  </div>
              @endforeach
          </div>
      </section>
  
      <!-- FAQ Section -->
      <section id="faq" class="container mx-auto px-4 py-20">
          <h2 class="text-3xl font-bold text-center mb-12">
              Frequently Asked Questions
          </h2>
          <div class="max-w-2xl mx-auto space-y-4">
              @foreach([
                  ['Is Treefy free?', 'Yes! Treefy is open-source and free for developers.'],
                  ['Which frameworks are supported?', 'Flutter, Web, Android, iOS, JSON, ARB, YAML, and CSV formats.'],
                  ['Can I customize translations?', 'Absolutely. You can manually edit or review translations anytime.']
              ] as $faq)
                  <div 
                      x-data="{ open: false }"
                      class="border rounded-lg"
                  >
                      <button 
                          @click="open = !open"
                          class="flex justify-between w-full px-4 py-3 text-left font-medium focus:outline-none"
                      >
                          <span>{{ $faq[0] }}</span>
                          <svg 
                              class="w-5 h-5 transform transition-transform" 
                              :class="{ 'rotate-180': open }"
                              xmlns="http://www.w3.org/2000/svg" 
                              viewBox="0 0 20 20" 
                              fill="currentColor"
                          >
                              <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                          </svg>
                      </button>
                      <div 
                          x-show="open"
                          x-transition:enter="transition ease-out duration-200"
                          x-transition:enter-start="opacity-0"
                          x-transition:enter-end="opacity-100"
                          x-transition:leave="transition ease-in duration-150"
                          x-transition:leave-start="opacity-100"
                          x-transition:leave-end="opacity-0"
                          class="px-4 pb-3 text-gray-600"
                      >
                          {{ $faq[1] }}
                      </div>
                  </div>
              @endforeach
          </div>
      </section>
  
      <!-- Footer -->
      <footer class="border-t bg-white/80 backdrop-blur-sm">
          <div class="container mx-auto px-4 py-8 text-center text-gray-600">
              <p>© 2025 Treefy. Localize Smarter. Grow Faster.</p>
          </div>
      </footer>
  </div>


</x-layouts.base>