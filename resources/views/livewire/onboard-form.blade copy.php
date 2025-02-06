<form wire:submit.prevent="completeOnboarding">
    @csrf
    <!-- Campos hidden para os dados do usuário -->
    <input type="hidden" wire:model="user_id">
    <input type="hidden" wire:model="user_nickname">
    <input type="hidden" wire:model="user_name">
    <input type="hidden" wire:model="user_email">
    <!-- Formulário de Onboarding -->
    <!-- Fluxograma -->
    <div>
        <h2 class="text-xl font-bold">Complete seu cadastro</h2>
        <p class="text-sm text-gray-600">Algumas informações já foram preenchidas. Por favor, forneça os dados restantes
            para concluir seu cadastro.</p>

        <!-- Fluxograma -->
        <div class="flex justify-center items-center mt-4">
            <div class="flex items-center relative">
                <!-- Primeira bolinha com SVG de check -->
                <div
                    class="relative flex items-center justify-center w-7 h-7 bg-white border border-gray-300 rounded-full">
                    <img src="{{ asset('img/check.svg') }}" class="w-3 h-3" alt="Check">
                </div>
                <div class="w-8 h-px bg-gray-300"></div>

                <!-- Segunda bolinha destacada -->
                <div
                    class="relative flex items-center justify-center w-7 h-7 bg-white border-8 border-gray-300 rounded-full">
                </div>
                <div class="absolute top-8 transform translate-x-1/2 text-xs font-bold text-gray-600">
                    Visão Geral do Negócio
                </div>
                <div class="w-8 h-px bg-gray-300"></div>
                <!-- Terceira bolinha condicional -->
                <div class="relative flex items-center justify-center w-7 h-7 bg-white rounded-full 
                    border border-gray-300 ">
                </div>
            </div>
        </div>
        <!-- Campos do formulário de onboarding -->
        <div class="relative mt-6">
            <input type="text" id="company_name" placeholder="Nome da Empresa" wire:model="company_name"
                class="peer mt-1 w-full border-2 border-gray-300 px-4 py-2 rounded-md placeholder:text-transparent focus:border-blue-600 focus:outline-none" />
            <label for="company_name"
                class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 left-2 origin-left bg-white px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-1/2 peer-focus:scale-75 peer-focus:-translate-y-4 peer-focus:text-blue-600">
                Nome da Empresa
            </label>
            @error('company_name')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="relative mt-6">
            <input type="text" id="cnpj" placeholder="CNPJ" wire:model="cnpj"
                class="peer mt-1 w-full border-2 border-gray-300 px-4 py-2 rounded-md placeholder:text-transparent focus:border-blue-600 focus:outline-none" />
            <label for="cnpj"
                class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 left-2 origin-left bg-white px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-1/2 peer-focus:scale-75 peer-focus:-translate-y-4 peer-focus:text-blue-600">
                CNPJ
            </label>
            @error('cnpj')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="relative mt-6">
            <select id="size" wire:model="size"
                class="peer mt-1 w-full border-2 border-gray-300 px-4 py-2 rounded-md placeholder:text-transparent focus:border-blue-600 focus:outline-none">
                <option value="" disabled selected hidden>Escolha o porte da sua empresa</option>
                <option value="Grande Empresa">Grande Empresa</option>
                <option value="Média Empresa">Média Empresa</option>
                <option value="Empresa de Pequeno Porte - EPP">Empresa de Pequeno Porte - EPP</option>
                <option value="Microempresa - ME">Microempresa - ME</option>
                <option value="Microempreendedor Individual- MEI">Microempreendedor Individual- MEI</option>
                <option value="Produtor Rural">Produtor Rural</option>
                <option value="Cooperativa">Cooperativa</option>
                <option value="Associação">Associação</option>
                <option value="Artesão">Artesão</option>
            </select>
            <label for="size"
                class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 left-2 origin-left bg-white px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-1/2 peer-focus:scale-75 peer-focus:-translate-y-4 peer-focus:text-blue-600">
                Porte
            </label>
            @error('size')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="relative mt-6">
            <input type="text" id="industry" placeholder="Área de Atuação" wire:model="industry"
                class="peer mt-1 w-full border-2 border-gray-300 px-4 py-2 rounded-md placeholder:text-transparent focus:border-blue-600 focus:outline-none" />
            <label for="industry"
                class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 left-2 origin-left bg-white px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-1/2 peer-focus:scale-75 peer-focus:-translate-y-4 peer-focus:text-blue-600">
                Área de Atuação
            </label>
            @error('industry')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="relative mt-6">
            <textarea id="about" placeholder="Sobre a Empresa" wire:model="about"
                class="peer mt-1 w-full border-2 border-gray-300 px-4 py-2 rounded-md placeholder:text-transparent focus:border-blue-600 focus:outline-none"></textarea>
            <label for="about"
                class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 left-2 origin-left bg-white px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-1/2 peer-focus:scale-75 peer-focus:-translate-y-4 peer-focus:text-blue-600">
                Sobre a Empresa
            </label>
            @error('about')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-center">
            <button type="button" wire:click="completeOnboarding"
                class="mt-4 px-4 py-2 bg-[#1F64BD] text-white rounded-md flex items-center justify-between">
                <span class="font-bold uppercase">Continue</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
    </div>
</form>