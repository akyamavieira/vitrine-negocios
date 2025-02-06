<div>
    <div class="relative mt-6">
        <input type="text" id="social_media" placeholder="Redes Sociais" wire:model="social_media"
            class="peer mt-1 w-full border-2 border-gray-300 px-4 py-2 rounded-md placeholder:text-transparent focus:border-blue-600 focus:outline-none" />
        <label for="social_media"
            class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 left-2 origin-left bg-white px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-1/2 peer-focus:scale-75 peer-focus:-translate-y-4 peer-focus:text-blue-600">
            Redes Sociais
        </label>
        @error('social_media')
            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>
    <div class="relative mt-6">
        <input type="text" id="website" placeholder="Website" wire:model="website"
            class="peer mt-1 w-full border-2 border-gray-300 px-4 py-2 rounded-md placeholder:text-transparent focus:border-blue-600 focus:outline-none" />
        <label for="website"
            class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 left-2 origin-left bg-white px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-1/2 peer-focus:scale-75 peer-focus:-translate-y-4 peer-focus:text-blue-600">
            Website
        </label>
        @error('website')
            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>
</div>