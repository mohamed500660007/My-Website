<section id="contact" class="py-32 bg-secondary/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div x-data="{ show: false }" x-intersect.once="show = true"
            class="text-center mb-16 transition-all duration-600"
            :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
            <span class="font-ui text-sm text-primary font-semibold tracking-wide mb-3 block">ابدأ مشروعك</span>
            <h2 class="font-heading text-4xl md:text-5xl font-bold mb-4">تواصل معايا</h2>
            <p class="font-subheading text-xl text-muted-foreground max-w-2xl mx-auto">
                عندك فكرة مشروع؟ يلا نتكلم ونشوف ازاي نحققها سوا
            </p>
        </div>

        <div class="max-w-2xl mx-auto"
            x-data="{ submitted: false, name: '', email: '', message: '' }">

            <!-- Success Message -->
            <div x-show="submitted" x-cloak
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100"
                class="bg-card border border-border rounded-2xl p-12 text-center">
                <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-primary/10 border border-primary/20 flex items-center justify-center">
                    <i data-lucide="message-square" class="w-10 h-10 text-primary"></i>
                </div>
                <h3 class="font-heading text-2xl font-bold mb-3">شكرًا على رسالتك!</h3>
                <p class="font-body text-muted-foreground">هرد عليك في أقرب وقت ممكن 🚀</p>
            </div>

            <!-- Form -->
            <div x-show="!submitted"
                x-data="{ show: false }" x-intersect.once="show = true"
                class="bg-card border border-border rounded-2xl p-8 md:p-12 shadow-xl transition-all duration-600"
                :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                <form @submit.prevent="submitted = true; setTimeout(() => { submitted = false; name = ''; email = ''; message = '' }, 3000)"
                    class="space-y-6">
                    <div>
                        <label for="name" class="font-subheading block text-sm font-semibold mb-2">الاسم</label>
                        <input type="text" id="name" name="name" x-model="name" required
                            class="font-ui w-full px-4 py-3 rounded-xl bg-background border border-border focus:outline-none focus:ring-2 focus:ring-primary text-right"
                            placeholder="اكتب اسمك" />
                    </div>
                    <div>
                        <label for="email" class="font-subheading block text-sm font-semibold mb-2">الإيميل</label>
                        <input type="email" id="email" name="email" x-model="email" required
                            class="font-ui w-full px-4 py-3 rounded-xl bg-background border border-border focus:outline-none focus:ring-2 focus:ring-primary text-right"
                            placeholder="بريدك الإلكتروني" />
                    </div>
                    <div>
                        <label for="message" class="font-subheading block text-sm font-semibold mb-2">الرسالة</label>
                        <textarea id="message" name="message" x-model="message" required rows="6"
                            class="font-body w-full px-4 py-3 rounded-xl bg-background border border-border focus:outline-none focus:ring-2 focus:ring-primary resize-none text-right"
                            placeholder="احكيلي عن مشروعك أو فكرتك"></textarea>
                    </div>
                    <button type="submit"
                        class="group font-ui w-full px-8 py-4 bg-primary text-white rounded-xl hover:bg-primary/90 transition-all hover:shadow-xl hover:shadow-primary/20 flex items-center justify-center gap-2 font-bold text-lg">
                        ابعتلي
                        <i data-lucide="send" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                    </button>
                </form>

                <div class="mt-8 pt-8 border-t border-border text-center">
                    <p class="font-body text-muted-foreground mb-4">أو راسلني مباشرة على</p>
                    <a href="mailto:hello@example.com"
                        class="font-ui inline-flex items-center gap-2 text-primary hover:text-primary/80 transition-colors">
                        <i data-lucide="mail" class="w-5 h-5"></i>
                        hello@example.com
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
