<x-guest-layout>
    <main>        
        <!-- Toutes les pièces sont modelées en grès -->
        <section>
            <div class="bg-card-orange flex flex-col lg:flex-row items-center rounded-lg px-4 lg:ml-4 justify-around gap-6">
                <div class="max-w-xl">
                    <p class="font-medium leading-relaxed px-6 py-8 text-gray-800 text-2xl">Toutes les pièces sont modelées en grès, puis cuites et enfumées. Mes créations sont toutes des pièces uniques nées de ma rencontre et ma fascination pour l'animal.</p>
                </div>
                {{-- Picture --}}
                <div>
                    <img src="images/travail-sylvie.jpg" class="w-full max-w-4xl" alt="photo de Sylvie Buatois travaillant">
                </div>
            </div>
        </section>
    
        <!-- Section raku -->
        <section class="mb-20 bg-neutral-100 shadow-sm py-16 md:py-20">

            <div class="flex flex-col lg:flex-row-reverse px-6 lg:px-16 items-center gap-12">
                {{-- Text --}}
                <div class="flex flex-col items-center gap-6">
                    <h1 class="font-raleway text-2xl font-normal">Le Raku</h1>
                    <p class="font-medium text-slate-500 p-6 lg:px-8 text-xl">Le Raku est une technique de cuisson ancestrale originaire
                        du Japon. Après une première cuisson qui permet d'obtenir un biscuit, les pièces sont émaillées,
                        remises au four et montées en température jusqu'à la fonte de l'émail. Le four est alors ouvert, les
                        pièces sorties une à une avec des pinces. Un choc thermique se crée, faisant éclater l'émail. C'est
                        alors l'enfumage qui va révéler les fissures sur les sculptures, les rendant uniques.</p>
                </div>

                {{-- Raku pics --}}
                <div class="flex flex-col md:flex-row gap-6">
                    <img src="images/cuisson_1.jpg" alt="cuisson de poterie raku" class="max-w-xs object-cover rounded">
                    <img src="images/cuisson_2.jpg" alt="cuisson de poterie raku" class="max-w-xs rounded">
                </div>
                
            </div>
        </section>
    
        <!-- Expo Avanne -->
        <section class="py-20">
            <div class="flex flex-col lg:flex-row justify-around items-center gap-10">
                <div class="flex flex-col gap-16 py-8 px-4">
                    <h2 class="font-medium text-2xl text-center text-amber-900">Les sculptures mises en décor par l'artiste lors des expositions.</h2>
                    <h2 class="text-center text-xl">Photographie de l'exposition d'Avanne-Aveney en avril 2024.</h2>
                </div>
                <div>
                    <img src="images/avanne.jpg" alt="exposition de Sylvie Buatois à Avanne-Aveney"
                        class="w-full max-w-4xl">
                </div>
            </div>
        </section>
    
    </main>
</x-guest-layout>