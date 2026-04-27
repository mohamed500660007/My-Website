<section class="py-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div x-data="{ show: false }" x-intersect.once="show = true"
            class="relative overflow-hidden transition-all duration-600"
            :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">

            <div class="absolute inset-0 bg-gradient-to-br from-primary/10 via-primary/3 to-primary/5 rounded-3xl animate-gradient"></div>
            <div class="relative glass rounded-3xl p-12 md:p-16 border border-border/50">
                <div x-data="{ submitted: false, email: '' }" class="max-w-3xl mx-auto text-center">

                    <div class="w-20 h-20 mx-auto mb-8 rounded-2xl bg-primary/10 border border-primary/20 flex items-center justify-center">
                        <i data-lucide="mail" class="w-10 h-10 text-primary"></i>
                    </div>

                    <h2 class="font-heading text-3xl md:text-4xl font-bold mb-4">خليك على اطلاع دايمًا</h2>
                    <p class="font-subheading text-xl text-muted-foreground mb-8">
                        سيب إيميلك وهبعتلك كل جديد أول بأول - مقالات، نصائح، ومشاريع جديدة
                    </p>

                    <!-- Success State -->
                    <div x-show="submitted" x-cloak
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-90"
                        x-transition:enter-end="opacity-100 scale-100"
                        class="p-6 rounded-2xl bg-primary/10 border border-primary/20">
                        <p class="font-subheading text-primary font-semibold text-lg">شكرًا! تم الاشتراك بنجاح 🎉</p>
                    </div>

                    <!-- Form -->
                    <form x-show="!submitted"
                        @submit.prevent="submitted = true; setTimeout(() => { submitted = false; email = '' }, 3000)"
                        class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                        <input
                            type="email"
                            x-model="email"
                            placeholder="بريدك الإلكتروني"
                            required
                            class="font-ui flex-1 px-6 py-4 rounded-xl bg-background border border-border focus:outline-none focus:ring-2 focus:ring-primary text-right"
                        />
                        <button type="submit"
                            class="group font-ui px-8 py-4 bg-primary text-white rounded-xl hover:bg-primary/90 transition-all hover:shadow-xl hover:shadow-primary/20 flex items-center justify-center gap-2 font-bold">
                            اشترك
                            <i data-lucide="send" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                        </button>
                    </form>

                    <p class="font-body text-sm text-muted-foreground mt-4">مش هبعت spam أبدًا. وعد! 🤝</p>
                </div>
            </div>
        </div>
    </div>
</section>
