<section class="relative min-h-screen flex items-center justify-center overflow-hidden pt-16">

    {{-- Animated gradient background --}}
    <div class="absolute inset-0 -z-10">
        <div class="absolute inset-0 bg-gradient-to-br from-primary/5 via-background to-accent/10 animate-gradient"></div>
    </div>

    {{-- Floating particles --}}
    <div class="hero-particles absolute inset-0 -z-5 overflow-hidden">
        <div class="particle w-2 h-2 bg-primary/30 top-[15%] right-[10%]" style="--duration:7s;--delay:0s"></div>
        <div class="particle w-3 h-3 bg-primary/20 top-[25%] right-[80%]" style="--duration:9s;--delay:1s"></div>
        <div class="particle w-1.5 h-1.5 bg-primary/40 top-[60%] right-[20%]" style="--duration:6s;--delay:2s"></div>
        <div class="particle w-2.5 h-2.5 bg-primary/25 top-[70%] right-[70%]" style="--duration:10s;--delay:0.5s"></div>
        <div class="particle w-2 h-2 bg-primary/35 top-[40%] right-[50%]" style="--duration:8s;--delay:3s"></div>
        <div class="particle w-1 h-1 bg-primary/50 top-[80%] right-[40%]" style="--duration:5s;--delay:1.5s"></div>
        <div class="particle w-3 h-3 bg-primary/15 top-[10%] right-[60%]" style="--duration:11s;--delay:4s"></div>
        <div class="particle w-1.5 h-1.5 bg-primary/30 top-[50%] right-[90%]" style="--duration:7s;--delay:2.5s"></div>
    </div>

    {{-- Large gradient orbs --}}
    <div class="absolute top-20 right-20 w-80 h-80 bg-primary/8 rounded-full blur-[100px] animate-float"></div>
    <div class="absolute bottom-20 left-20 w-96 h-96 bg-primary/5 rounded-full blur-[120px] animate-float-delayed"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-primary/3 rounded-full blur-[160px] animate-pulse-glow"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 pt-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center"
            x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 100)"
        >
            {{-- Right Side: Content --}}
            <div class="order-1 text-right">
                {{-- Badge --}}
                <div
                    class="inline-flex items-center gap-3 px-5 py-2.5 rounded-full glass border-primary/20 mb-8 transition-all duration-700"
                    :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                >
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-primary"></span>
                    </span>
                    <span class="text-sm font-ui text-primary font-semibold font-reading">متاح للمشاريع الجديدة</span>
                </div>

                {{-- Headline with small decorative image --}}
                <div class="relative mb-8 transition-all duration-700 delay-100" :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                    <h1 class="font-heading text-4xl md:text-6xl lg:text-7xl font-bold leading-[1.2] relative z-10">
                        بنبني منتجات رقمية
                        <span class="block text-gradient mt-2">تصنع الفرق</span>
                    </h1>
                    {{-- Small decorative image --}}
                    <div class="absolute -top-6 -right-12 w-20 h-20 bg-primary/5 rounded-2xl rotate-12 flex items-center justify-center border border-primary/10 backdrop-blur-sm -z-1 animate-float">
                        <i data-lucide="sparkles" class="w-10 h-10 text-primary/40"></i>
                    </div>
                </div>

                {{-- Subheading --}}
                <p
                    class="font-body text-lg md:text-xl text-muted-foreground mb-10 max-w-xl ml-auto leading-relaxed transition-all duration-700 delay-200"
                    :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                >
                    مطور برمجيات متخصص في بناء تطبيقات ويب حديثة وأنظمة SaaS بتقنيات عالمية. نحول أفكارك إلى واقع رقمي ملموس.
                </p>

                {{-- CTA Buttons --}}
                <div
                    class="flex flex-wrap gap-4 transition-all duration-700 delay-300"
                    :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                >
                    <a
                        href="#projects"
                        class="group font-ui px-8 py-4 bg-primary text-white rounded-2xl hover:bg-primary/90 transition-all hover:shadow-2xl hover:shadow-primary/25 hover:-translate-y-0.5 inline-flex items-center justify-center gap-3 font-bold text-lg"
                    >
                        شوف مشاريعي
                        <i data-lucide="arrow-left" class="w-5 h-5 group-hover:-translate-x-1 transition-transform"></i>
                    </a>
                    <a
                        href="#contact"
                        class="font-ui px-8 py-4 glass text-foreground rounded-2xl hover:bg-secondary/80 transition-all hover:shadow-lg hover:-translate-y-0.5 inline-flex items-center justify-center font-bold text-lg border border-border"
                    >
                        تواصل معايا
                    </a>
                </div>
            </div>

            {{-- Left Side: Lottie Animation --}}
            <div 
                class="order-2 transition-all duration-1000"
                :class="show ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-12'"
            >
                <div class="relative group flex items-center justify-center">
                    {{-- Decorative glow behind animation --}}
                    <div class="absolute inset-0 bg-primary/10 rounded-full blur-[100px] group-hover:bg-primary/20 transition-all duration-700"></div>
                    
                    <div class="relative w-full max-w-[500px] aspect-square flex items-center justify-center">
                        <dotlottie-wc 
                            src="https://lottie.host/bd20e6c9-c4e8-42a0-bf76-0a4fe26e91b9/MCSfb6gpCr.lottie" 
                            style="width: 100%; height: 100%;" 
                            autoplay 
                            loop>
                        </dotlottie-wc>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
        <div class="w-7 h-11 rounded-full border-2 border-muted-foreground/20 flex items-start justify-center p-2">
            <div class="w-1.5 h-3 rounded-full bg-primary/60 animate-pulse"></div>
        </div>
    </div>
</section>
