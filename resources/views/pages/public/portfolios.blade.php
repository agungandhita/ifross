<x-layouts.public title="Portofolio | {{ App\Models\Site\SiteSetting::get('meta_title', 'IFROSS MULTIMEDIA') }}">
    
    <!-- Header -->
    <section class="bg-primary-dark py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl sm:text-4xl font-bold text-white mb-4">Portofolio & Event</h1>
            <p class="text-primary-light max-w-2xl mx-auto text-lg">Dokumentasi dan hasil karya dari berbagai event yang telah mempercayakan kebutuhan multimedianya kepada kami.</p>
        </div>
    </section>

    <!-- Content -->
    <section class="py-12 section-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <livewire:public.portfolio-gallery />
            
        </div>
    </section>

</x-layouts.public>
