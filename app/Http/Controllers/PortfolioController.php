<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    private $projects = [
        [
            'id'          => 'ai-dashboard',
            'title'       => 'لوحة تحكم AI متقدمة',
            'hook'        => 'نظام ذكي لإدارة البيانات بالذكاء الاصطناعي',
            'description' => 'منصة SaaS متكاملة بتستخدم الذكاء الاصطناعي في تحليل البيانات وتقديم رؤى فورية للشركات',
            'tags'        => ['Laravel', 'AI', 'Dashboard', 'SaaS'],
            'problem'     => 'الشركات بتواجه صعوبة في فهم البيانات الكبيرة وتحليلها بسرعة، والطرق التقليدية بتاخد وقت طويل ومش دقيقة',
            'solution'    => 'بنينا نظام ذكي بيحلل البيانات أوتوماتيك ويديك رؤى واضحة في ثواني. النظام بيتعلم من سلوك المستخدمين وبيقترح أفضل القرارات',
            'features'    => ['تحليل بيانات فوري باستخدام AI', 'تقارير تفاعلية وقابلة للتخصيص', 'تنبيهات ذكية لأي تغييرات مهمة', 'دمج سهل مع أي نظام موجود', 'لوحة تحكم مرنة وسهولة الاستخدام'],
            'techStack'   => ['Laravel 11', 'Vue.js', 'Python ML', 'PostgreSQL', 'Redis', 'TailwindCSS'],
            'demoUrl'     => 'https://ai-dashboard.demo.com',
            'github_url'  => 'https://github.com/example/ai-dashboard',
            'cover_image' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?q=80&w=2070&auto=format&fit=crop',
            'screenshots' => [],
        ],
        [
            'id'          => 'ecommerce-platform',
            'title'       => 'منصة تجارة إلكترونية متكاملة',
            'hook'        => 'حل متكامل للمتاجر الإلكترونية مع نظام دفع آمن',
            'description' => 'منصة شاملة للتجارة الإلكترونية مع إدارة المخزون والطلبات ونظام دفع متعدد',
            'tags'        => ['Laravel', 'E-commerce', 'Payment', 'API'],
            'problem'     => 'أصحاب المتاجر محتاجين نظام متكامل يدير كل حاجة من المنتجات للدفع للشحن، والحلول الموجودة معقدة وغالية',
            'solution'    => 'منصة واحدة بتدير كل حاجة: المنتجات، المخزون، الطلبات، الدفع، والشحن. كل ده بواجهة سهلة وسعر معقول',
            'features'    => ['إدارة منتجات ومخزون ذكية', 'نظام دفع آمن متعدد البوابات', 'تتبع الطلبات والشحن', 'تقارير مبيعات تفصيلية', 'متجاوب مع كل الشاشات'],
            'techStack'   => ['Laravel', 'React', 'Stripe', 'MySQL', 'Livewire', 'Alpine.js'],
            'demoUrl'     => 'https://demo.example.com',
            'github_url'  => 'https://github.com/example/ecommerce-platform',
            'cover_image' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?q=80&w=2070&auto=format&fit=crop',
            'screenshots' => [],
        ],
        [
            'id'          => 'task-automation',
            'title'       => 'أداة أتمتة المهام',
            'hook'        => 'وفر وقتك وخلي الشغل يمشي لوحده',
            'description' => 'نظام أتمتة شامل للمهام المتكررة مع دمج سلس مع أدواتك المفضلة',
            'tags'        => ['Laravel', 'Automation', 'API', 'Webhooks'],
            'problem'     => 'المهام المتكررة بتضيع وقت كتير من الفريق، وربط الأنظمة ببعضها صعب ومحتاج مطورين',
            'solution'    => 'نظام سهل بيخليك تربط أي أداة بأي أداة وتعمل أتمتة لأي مهمة متكررة بدون كود',
            'features'    => ['ربط تلقائي لأكثر من 100 أداة', 'واجهة سحب وإفلات لبناء الأتمتة', 'تنفيذ فوري للمهام', 'سجل كامل لكل العمليات', 'Webhooks و API قوية'],
            'techStack'   => ['Laravel', 'Inertia.js', 'React', 'Queue Jobs', 'Redis', 'Webhooks'],
            'demoUrl'     => 'https://task-automation.demo.com',
            'github_url'  => 'https://github.com/example/task-automation',
            'cover_image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=2015&auto=format&fit=crop',
            'screenshots' => [],
        ],
    ];

    private $blogPosts = [
        [
            'id'       => 1,
            'slug'     => 'build-saas-from-scratch',
            'title'    => 'كيف تبني تطبيق SaaS ناجح من الصفر',
            'excerpt'  => 'دليل شامل لبناء منصة SaaS احترافية باستخدام Laravel و React مع أفضل الممارسات',
            'date'     => '2026-04-15',
            'category' => 'تطوير',
            'readTime' => '8 دقائق',
            'cover_image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=2070&auto=format&fit=crop',
            'content'  => [
                [
                    'type' => 'paragraph',
                    'text' => 'بناء منتج SaaS ناجح مش بس مسألة كتابة كود، ده رحلة كاملة من الفكرة للتنفيذ والنمو. في المقال ده هنتكلم عن كل خطوة بالتفصيل.',
                ],
                [
                    'type'  => 'heading',
                    'text'  => '١. ابدأ بالمشكلة مش بالحل',
                ],
                [
                    'type' => 'paragraph',
                    'text' => 'أول حاجة لازم تعملها قبل ما تكتب سطر واحد من الكود هي إنك تفهم المشكلة اللي بتحاول تحلها كويس. تكلم مع الناس اللي بيعانوا من المشكلة دي، افهم workflow بتاعهم، وشوف إيه اللي بيوجعهم أكتر.',
                ],
                [
                    'type' => 'image',
                    'url'  => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?q=80&w=2070&auto=format&fit=crop',
                    'alt'  => 'Coding workspace',
                ],
                [
                    'type'  => 'heading',
                    'text'  => '٢. اختار التقنيات الصح',
                ],
                [
                    'type' => 'paragraph',
                    'text' => 'Laravel هو الخيار المثالي للـ backend بسبب ecosystem الواسع والسرعة في التطوير. React أو Vue للـ frontend بيديك مرونة كبيرة. وطبعًا Tailwind CSS بيخلي الـ styling أسهل بكتير.',
                ],
                [
                    'type'  => 'heading',
                    'text'  => '٣. ابني MVP أولًا',
                ],
                [
                    'type' => 'paragraph',
                    'text' => 'Minimum Viable Product هو النسخة الأبسط من منتجك اللي بتحل المشكلة الأساسية. ابني ده الأول، اطلقه، واجمع feedback. متكمّلش features كتير قبل ما تتأكد إن الناس فعلًا عايزين المنتج ده.',
                ],
                [
                    'type' => 'image',
                    'url'  => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=2015&auto=format&fit=crop',
                    'alt'  => 'Analytics dashboard',
                ],
                [
                    'type'  => 'heading',
                    'text'  => '٤. التسعير والـ Monetization',
                ],
                [
                    'type' => 'paragraph',
                    'text' => 'Freemium model بيشتغل كويس لأنه بيخلي الناس تجرب بدون risk. بعدين لما يشوفوا القيمة، هيتحولوا لـ paid plan. Stripe بيسهل عليك كل ده بـ subscriptions وكل حاجة.',
                ],
                [
                    'type'  => 'heading',
                    'text'  => '٥. Scale بذكاء',
                ],
                [
                    'type' => 'paragraph',
                    'text' => 'لما منتجك ينجح ويبدأ users يكتروا، هتحتاج تفكر في الـ infrastructure. Redis للـ caching، Queue jobs للعمليات الثقيلة، وCD/CI للـ deployment الأوتوماتيك.',
                ],
            ],
        ],
        [
            'id'       => 2,
            'slug'     => 'ai-in-web-apps',
            'title'    => 'دمج الذكاء الاصطناعي في تطبيقات الويب',
            'excerpt'  => 'تعلم كيف تضيف قدرات AI لتطبيقاتك بشكل عملي وسهل باستخدام APIs حديثة',
            'date'     => '2026-04-10',
            'category' => 'AI',
            'readTime' => '6 دقائق',
            'content'  => [
                [
                    'type' => 'paragraph',
                    'text' => 'الذكاء الاصطناعي بقى accessible أكتر من أي وقت فات. مش محتاج تكون data scientist عشان تضيف AI لتطبيقك. APIs زي OpenAI و Anthropic بتسهل الموضوع كتير.',
                ],
                [
                    'type' => 'heading',
                    'text' => '١. فهم الـ Use Cases',
                ],
                [
                    'type' => 'paragraph',
                    'text' => 'مش كل حاجة محتاجة AI. اتسأل الأول: هل في مشكلة حقيقية AI بيحلها أحسن من الكود العادي؟ Generation، Classification، Summarization، Translation - دي أشهر الاستخدامات.',
                ],
                [
                    'type' => 'heading',
                    'text' => '٢. OpenAI API في Laravel',
                ],
                [
                    'type' => 'paragraph',
                    'text' => 'باستخدام OpenAI PHP package، تقدر تبدأ في دقائق. بس خليك واعي بالتكلفة وعمل rate limiting وcaching للـ responses اللي بتتكرر.',
                ],
                [
                    'type' => 'heading',
                    'text' => '٣. RAG للـ Context',
                ],
                [
                    'type' => 'paragraph',
                    'text' => 'Retrieval Augmented Generation بيخليك تضيف context من بياناتك للـ AI. بدل ما تبعت كل الداتا في الـ prompt، بتبحث في قاعدة بياناتك وتبعت الجزء ذو الصلة بس.',
                ],
            ],
        ],
        [
            'id'       => 3,
            'slug'     => 'api-design-best-practices',
            'title'    => 'أفضل الممارسات في تصميم APIs',
            'excerpt'  => 'خطوات عملية لبناء APIs قوية وآمنة وسهلة الاستخدام',
            'date'     => '2026-04-05',
            'category' => 'Backend',
            'readTime' => '7 دقائق',
            'content'  => [
                [
                    'type' => 'paragraph',
                    'text' => 'API كويس هو اللي بيتكلم عن نفسه. لما developer تاني يشوف الـ API بتاعك، المفروض يفهم ايه بيعمل وازاي يستخدمه بدون ما يتعب.',
                ],
                [
                    'type' => 'heading',
                    'text' => '١. RESTful Design',
                ],
                [
                    'type' => 'paragraph',
                    'text' => 'استخدم HTTP methods صح: GET للقراءة، POST للإنشاء، PUT/PATCH للتعديل، DELETE للحذف. وخلي الـ endpoints بتاعتك resources لا actions.',
                ],
                [
                    'type' => 'heading',
                    'text' => '٢. Versioning',
                ],
                [
                    'type' => 'paragraph',
                    'text' => 'ابدأ بـ versioning من اليوم الأول: /api/v1/. لما تعمل breaking changes مش هتكسر الـ clients اللي بيستخدموا الـ version القديمة.',
                ],
                [
                    'type' => 'heading',
                    'text' => '٣. Authentication & Security',
                ],
                [
                    'type' => 'paragraph',
                    'text' => 'Laravel Sanctum أو Passport للـ authentication. دايمًا validate الـ input، sanitize الـ output، وعمل rate limiting عشان تحمي الـ API من الـ abuse.',
                ],
            ],
        ],
    ];

    public function index()
    {
        return view('index', ['projects' => $this->projects]);
    }

    public function show($id)
    {
        $project = collect($this->projects)->firstWhere('id', $id);
        if (!$project) abort(404);
        
        // Convert techStack array to objects for view compatibility
        $project['technologies'] = collect($project['techStack'] ?? [])->map(function($tech) {
            return (object) ['name' => $tech];
        });
        
        // Add images collection (use cover_image + 2 placeholder images)
        $project['images'] = collect([
            $project['cover_image'] ?? 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?q=80&w=2070&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=2015&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=2070&auto=format&fit=crop'
        ]);
        
        // Add files collection
        $project['files'] = collect([
            (object) ['name' => 'SRS Document', 'url' => '/files/' . $id . '-srs.pdf'],
            (object) ['name' => 'Source Code', 'url' => $project['github_url'] . '/archive/main.zip']
        ]);
        
        return view('projects.show', ['project' => $project]);
    }

    public function showBlog($slug)
    {
        $post = collect($this->blogPosts)->firstWhere('slug', $slug);
        if (!$post) abort(404);
        return view('blog.show', ['post' => $post, 'recentPosts' => collect($this->blogPosts)->where('slug', '!=', $slug)->values()->toArray()]);
    }
}
