<x-guest-layout>
    <main>
        <!-- Main content -->
        <section>
            {{-- Headings --}}
            <div class="flex justify-center">
                <div class="py-20 px-12 flex flex-col gap-12">
                    <h1 class="font-medium text-amber-900 text-7xl">Sylvie Buatois</h1>
                    <h2 class="font-medium text-4xl">N'hésitez pas à me contacter pour tout renseignement.</h2>
                    {{-- <h2 class="font-medium text-3xl">Pour tout renseignement.</h2> --}}
                    <h3 class="font-regular text-xl">En remplissant ce formulaire.</h3>
                </div>
            </div>

            <!-- Form -->
            <div class="flex justify-center">
                <form id="contact" class="flex flex-col items-center gap-10 px-20 pb-10">
                    @csrf
                    <!-- Name -->
                    <div class="flex flex-col items-center gap-2">
                        <label for="name">Nom*</label>
                        <input type="text" id="name" name="name"
                            class="block w-60 md:w-96 hover:shadow-sm rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            required>
                    </div>

                    <div class="flex flex-col items-center gap-2">
                        <label for="email">Email*</label>
                        <input type="email" id="email" name="email"
                            class="block w-60 md:w-96 hover:shadow-sm rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            required>
                    </div>

                    <div class="flex flex-col items-center gap-2">
                        <label for="subject">Sujet*</label>
                        <input type="text" id="subject" name="subject"
                            class="block w-60 md:w-96 hover:shadow-sm rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            required>
                    </div>

                    <div class="flex flex-col items-center gap-2">
                        <label for="message">Votre message*</label>
                        <textarea id="message" name="message"
                            class="block h-44 w-80 md:w-96 hover:shadow-sm rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            required></textarea>
                    </div>

                    {{-- Privacy checkbox --}}

                    <div class="flex gap-4 items-center">
                        <input type="checkbox" name="privacy" id="privacy">
                        <label for="privacy">En cochant cette case, j'accepte que mes données soient traitées conformément à la <span class="underline decoration-gray-500 text-gray-700 hover:text-gray-800"><a href="{{ route('privacypolicy') }}" target="_blank">politique de confidentialité</a></span>.</label>
                    </div>

                    <button type="submit"
                        class="rounded-md py-1.5 w-32 border-2 bg-slate-50 hover:bg-slate-600 hover:text-gray-200 transition duration-300 ease-in">Envoyer</button>
                </form>
            </div>

            <div class="flex justify-center py-5 mb-12">
                <p class="italic">*Ces champs sont requis</p>
            </div>
        </section>

        {{-- Form send modal --}}
        <div x-data="{ showAlert: false, message: '' }" x-show="showAlert" x-transition x-cloak class="fixed left-0 top-0 w-full h-screen flex justify-center items-center" @custom-alert.window="showAlert = true; message = $event.detail.message;">
            {{-- Overlay --}}
            <div class="absolute top-0 left-0 w-full h-screen bg-black/20"></div>

            {{-- Modal --}}
            <div @click.outside="showAlert = false" class="bg-gray-100 w-1/4 z-10 flex flex-col gap-10 items-center px-16 py-12 border border-gray-300 rounded-lg">
                <p x-text="message" class="font-semibold font-anek"></p>

                <button @click="showAlert = false" class="rounded-md py-1.5 w-28 border-2 bg-slate-50 hover:bg-slate-600 hover:text-gray-200 transition duration-300 ease-in">
                    OK
                </button>
            </div>
        </div>
    </main>
</x-guest-layout>
