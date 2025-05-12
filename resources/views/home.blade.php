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
      <!-- Hero Section -->
      <section class="hero min-h-screen bg-base-200">
        <div class="hero-content text-center">
          <div class="max-w-xl">
            <h1 class="text-5xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">
              {{ __("treefy_slogan") }}
            </h1>
            <p class="py-6 text-lg text-gray-600">{{ __("treefy_slogan_desc") }}</p>
            <a href="#" class="btn btn-primary btn-lg">{{ __("get_started") }}</a>
          </div>
        </div>
      </section>
      
      <!-- Features Section -->
      <section id="features" class="py-20">
        <h2 class="text-3xl font-bold text-center mb-12">{{ __("empower_your_app") }}</h2>
        <div class="grid gap-6 grid-cols-1 md:grid-cols-3 max-w-5xl mx-auto px-4">
          @foreach(['AI-Powered Translations', __('human_verification_system'), 'Multi-Platform Support'] as $feature)
            <div class="card bg-base-100 shadow-md">
              <div class="card-body items-center text-center">
                <div class="text-3xl text-green-600">✓</div>
                <h3 class="card-title text-lg">{{ $feature }}</h3>
              </div>
            </div>
          @endforeach
        </div>
      </section>
      
  
      <!-- How It Works Section -->
      <section id="how-it-works" class="container mx-auto px-4 py-20 bg-gradient-to-b from-base-100 to-base-200">
        <div class="text-center mb-12">
          <h2 class="text-3xl md:text-4xl font-bold mb-4">
            How It Works
          </h2>
          <p class="text-lg opacity-80 max-w-2xl mx-auto">Our simple 4-step process ensures accurate and high-quality translations every time</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 max-w-5xl mx-auto">
          <!-- Step 1 -->
          <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all duration-300 border border-base-300">
            <div class="card-body items-center text-center">
              
              <h3 class="card-title text-lg">Upload Your Project</h3>
              <p class="text-sm opacity-70">Upload documents in any format - we support PDFs, Word files, and more</p>
            </div>
          </div>
          
          <!-- Step 2 -->
          <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all duration-300 border border-base-300">
            <div class="card-body items-center text-center">
              
              <h3 class="card-title text-lg">AI-Assisted Translation</h3>
              <p class="text-sm opacity-70">Our advanced AI provides fast, context-aware translations</p>
            </div>
          </div>
          
          <!-- Step 3 -->
          <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all duration-300 border border-base-300">
            <div class="card-body items-center text-center">
              
              <h3 class="card-title text-lg">Human Verification</h3>
              <p class="text-sm opacity-70">Professional linguists review and refine every translation</p>
            </div>
          </div>
          
          <!-- Step 4 -->
          <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all duration-300 border border-base-300">
            <div class="card-body items-center text-center">
            
              <h3 class="card-title text-lg">Export Ready Files</h3>
              <p class="text-sm opacity-70">Download your translated files in the original format</p>
            </div>
          </div>
        </div>
        
        <div class="text-center mt-12">
          <button class="btn btn-primary px-8">Get Started</button>
        </div>
      </section>

  
      <!-- FAQ Section -->
      <section id="faq" class="py-20">
        <h2 class="text-3xl font-bold text-center mb-12">{{ __("f_a_q") }}</h2>
        <div class="max-w-2xl mx-auto space-y-4 px-4">
          @foreach([
              ['Is Treefy free?', 'Yes! Treefy is open-source and free for developers.'],
              ['What is the supported format?', 'JSON'],
              ['Can I customize translations?', 'Absolutely. You can manually edit or review translations anytime.']
          ] as $faq)
          <div class="collapse collapse-arrow bg-base-200">
            <input type="checkbox" />
            <div class="collapse-title font-medium">
              {{ $faq[0] }}
            </div>
            <div class="collapse-content">
              <p>{{ $faq[1] }}</p>
            </div>
          </div>
          @endforeach
        </div>
      </section>
      
  

  </div>


</x-layouts.base>