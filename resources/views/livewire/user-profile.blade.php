<div class=" mx-auto p-6 bg-base-100 rounded-box ">
    <h2 class="text-2xl font-bold mb-6 text-center">{{__("User Profile")}}</h2>

    {{-- @if (session()->has('message'))
        <div class="alert alert-success mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('message') }}</span>
        </div>
    @endif --}}

    <div class="space-y-8 flex md:flex-row flex-col gap-2 items-end justify-center">
        <form wire:submit.prevent="updateProfile" class="card bg-base-200 p-6">
            <div class="card-body p-0 space-y-4">
                <h3 class="text-lg font-semibold">{{__("profile_info")}}</h3>
                
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">{{__("Name")}}</span>
                    </label>
                    <input wire:model="name" type="text" class="input input-bordered w-full">
                    @error('name') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                </div>
                
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">{{__('Language')}}</span>
                    </label>
                    <select wire:model="default_lang" class="select select-bordered w-full">
                        <option disabled selected></option>
                        @foreach($languages as $language)
                            <option value="{{ $language->id }}">{{ $language->name }} ({{ $language->code }})</option>
                        @endforeach
                    </select>
                    @error('default_lang') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                </div>
                
                <div class="card-actions justify-end mt-4">
                    <button type="submit" class="btn btn-primary">{{__('save')}}</button>
                </div>
            </div>
        </form>

        <form wire:submit.prevent="updatePassword" class="card bg-base-200 p-6">
            <div class="card-body p-0 space-y-4">
                <h3 class="text-lg font-semibold">{{__("change_password")}}</h3>
                
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">{{__("old")}}</span>
                    </label>
                    <input wire:model="oldPassword" type="password" class="input input-bordered w-full">
                    @error('oldPassword') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                </div>
                
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">{{__("new")}}</span>
                    </label>
                    <input wire:model="newPassword" type="password" class="input input-bordered w-full">
                    @error('newPassword') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                </div>
                
                <div class="card-actions justify-end mt-4">
                    <button type="submit" class="btn btn-primary">{{__("save")}}</button>
                </div>
            </div>
        </form>
    </div>
</div>