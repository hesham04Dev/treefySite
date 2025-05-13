<x-layouts.base class="flex items-center justify-center">
    {{-- <div class="bg-base-200 flex items-center justify-center min-h-screen p-4"> --}}
        <div class="w-full max-w-md p-8 space-y-6 bg-base-100 rounded-2xl shadow-lg">
            <h1 class="text-3xl font-bold text-center">{{ __('Sign Up') }}</h1>
            
            <form action="" method="POST" class="space-y-4">
                @csrf
                <div class="form-control">
                    <label for="name" class="label">
                        <span class="label-text">{{ __('Name') }}</span>
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        class="input input-bordered w-full focus:input-primary" 
                        required
                    >
                </div>

                <div class="form-control">
                    <label for="email" class="label">
                        <span class="label-text">{{ __('Email') }}</span>
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        class="input input-bordered w-full focus:input-primary" 
                        required
                    >
                </div>
    
                <div class="form-control">
                    <label for="password" class="label">
                        <span class="label-text">{{ __('Password') }}</span>
                    </label>
                    <input 
                        type="password" 
                        name="password" 
                        class="input input-bordered w-full focus:input-primary" 
                        required
                    >
                </div>
    
                <div>
                    <button type="submit" class="btn btn-primary w-full mt-6">
                        {{ __('Sign Up') }}
                    </button>
                </div>
            </form>

            <div class="text-center">
                {{ __('Already have an account?') }} 
                <a href="/login" class="link link-primary">{{ __('Login') }}</a>
            </div>
    
            <div class="divider">{{ __('OR') }}</div>
    
            <a href="{{ url('auth/google') }}" class="block">
                <button class="btn btn-outline w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    </svg>
                    {{ __('Sign up with Google') }}
                </button>
            </a>
        </div>
    {{-- </div> --}}
</x-layouts.base>