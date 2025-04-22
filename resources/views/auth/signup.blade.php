<x-layouts.app>
    <div class="bg-gray-100 flex items-center justify-center min-h-screen">
    
        <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-2xl shadow-xl">
            <h1 class="text-3xl font-bold text-center text-gray-800">df_sign_up</h1>
            
            <form action="" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">df_name</label>
                    <input type="text" name="name" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">df_email</label>
                    <input type="email" name="email" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
    
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">df_password</label>
                    <input type="password" name="password" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
    
                <div>
                    <button type="submit" class="w-full px-4 py-2 font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-200">
                        df_sign_up
                    </button>
                </div>
            </form>
            <div>df_have_account: <a href="/login" class="text-green-500">df_login</a></div>
    
            <div class="relative text-center">
                <span class="absolute inset-x-0 top-1/2 transform -translate-y-1/2 h-px bg-gray-300"></span>
                <span class="relative bg-white px-2 text-sm text-gray-500">df_OR</span>
            </div>
    
            <a href="{{ url('auth/google') }}" class="block">
                <button class="w-full flex items-center justify-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="w-5 h-5">
                    df_sign_up_with_google
                </button>
            </a>
        </div>
    
    </div>
    </x-layouts.app>
    