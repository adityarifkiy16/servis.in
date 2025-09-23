@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="hero min-h-screen bg-gradient-to-br from-primary/20 to-secondary/20">
        <div class="hero-overlay bg-opacity-60"></div>
        <div class="hero-content text-center text-neutral-content">
            <div class="max-w-2xl">
                <!-- Logo/Icon -->
                <div class="mb-8">
                    <div class="w-24 h-24 mx-auto mb-4 bg-primary rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                </div>

                <!-- Main Content -->
                <h1
                    class="text-6xl font-bold mb-6 bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                    Welcome to Laravel
                </h1>
                <p class="text-xl mb-8 text-base-content/80">
                    Modern web application with Laravel, TailwindCSS & DaisyUI.
                    Build something amazing today!
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button class="btn btn-primary btn-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4" />
                        </svg>
                        Get Started
                    </button>
                    <button class="btn btn-outline btn-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Documentation
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <section class="py-20 bg-base-100">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Built with Modern Stack</h2>
                <p class="text-xl text-base-content/70">Powerful tools for rapid development</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Laravel Card -->
                <div class="card bg-base-200 shadow-xl hover:shadow-2xl transition-all duration-300">
                    <div class="card-body text-center">
                        <div class="w-16 h-16 mx-auto mb-4 bg-red-500 rounded-lg flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.642 5.43a.364.364 0 01.014.1v5.149c0 .135-.073.26-.189.326l-4.323 2.49v4.934a.378.378 0 01-.188.326L9.93 23.949a.316.316 0 01-.066.017c-.008.002-.016.002-.023.002-.015 0-.030-.002-.045-.007l-.01-.003L.78 18.755a.38.38 0 01-.189-.326V8.93c0-.02.002-.04.005-.058a.025.025 0 01.006-.018c.003-.012.007-.023.013-.033l.005-.01L9.652.764a.378.378 0 01.378 0l9.033 5.2a.381.381 0 01.095.082c.005.007.009.015.013.022zM9.74 2.016L2.543 6.324l7.197 4.135 7.197-4.135L9.74 2.016zm8.501 16.338v-4.501l-3.005 1.732-.94.542v4.501l3.945-2.274zm1.024-10.654l-7.177 4.125v8.184l7.177-4.125V7.7z" />
                            </svg>
                        </div>
                        <h3 class="card-title justify-center">Laravel</h3>
                        <p>Elegant PHP framework for web artisans. Build anything with expressive, elegant syntax.</p>
                        <div class="card-actions justify-center">
                            <div class="badge badge-outline">PHP</div>
                            <div class="badge badge-outline">MVC</div>
                            <div class="badge badge-outline">Artisan</div>
                        </div>
                    </div>
                </div>

                <!-- TailwindCSS Card -->
                <div class="card bg-base-200 shadow-xl hover:shadow-2xl transition-all duration-300">
                    <div class="card-body text-center">
                        <div class="w-16 h-16 mx-auto mb-4 bg-cyan-500 rounded-lg flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12.001,4.8c-3.2,0-5.2,1.6-6,4.8c1.2-1.6,2.6-2.2,4.2-1.8c0.913,0.228,1.565,0.89,2.288,1.624 C13.666,10.618,15.027,12,18.001,12c3.2,0,5.2-1.6,6-4.8c-1.2,1.6-2.6,2.2-4.2,1.8c-0.913-0.228-1.565-0.89-2.288-1.624 C16.337,6.182,14.976,4.8,12.001,4.8z M6.001,12c-3.2,0-5.2,1.6-6,4.8c1.2-1.6,2.6-2.2,4.2-1.8c0.913,0.228,1.565,0.89,2.288,1.624 C7.666,17.818,9.027,19.2,12.001,19.2c3.2,0,5.2-1.6,6-4.8c-1.2,1.6-2.6,2.2-4.2,1.8c-0.913-0.228-1.565-0.89-2.288-1.624 C10.337,13.382,8.976,12,6.001,12z" />
                            </svg>
                        </div>
                        <h3 class="card-title justify-center">TailwindCSS</h3>
                        <p>Utility-first CSS framework for rapid UI development. Build custom designs without leaving your
                            HTML.</p>
                        <div class="card-actions justify-center">
                            <div class="badge badge-outline">CSS</div>
                            <div class="badge badge-outline">Utility</div>
                            <div class="badge badge-outline">Responsive</div>
                        </div>
                    </div>
                </div>

                <!-- DaisyUI Card -->
                <div class="card bg-base-200 shadow-xl hover:shadow-2xl transition-all duration-300">
                    <div class="card-body text-center">
                        <div class="w-16 h-16 mx-auto mb-4 bg-purple-500 rounded-lg flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M12,6A6,6 0 0,1 18,12A6,6 0 0,1 12,18A6,6 0 0,1 6,12A6,6 0 0,1 12,6M12,8A4,4 0 0,0 8,12A4,4 0 0,0 12,16A4,4 0 0,0 16,12A4,4 0 0,0 12,8Z" />
                            </svg>
                        </div>
                        <h3 class="card-title justify-center">DaisyUI</h3>
                        <p>Most popular component library for TailwindCSS. Beautiful components, semantic class names.</p>
                        <div class="card-actions justify-center">
                            <div class="badge badge-outline">Components</div>
                            <div class="badge badge-outline">Themes</div>
                            <div class="badge badge-outline">Semantic</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-base-200">
        <div class="container mx-auto px-4">
            <div class="stats stats-vertical lg:stats-horizontal shadow-lg w-full">
                <div class="stat">
                    <div class="stat-figure text-primary">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="stat-title">Responsive</div>
                    <div class="stat-value text-primary">100%</div>
                    <div class="stat-desc">Mobile-first design</div>
                </div>

                <div class="stat">
                    <div class="stat-figure text-secondary">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div class="stat-title">Performance</div>
                    <div class="stat-value text-secondary">Fast</div>
                    <div class="stat-desc">Optimized for speed</div>
                </div>

                <div class="stat">
                    <div class="stat-figure text-accent">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                    <div class="stat-title">Quality</div>
                    <div class="stat-value text-accent">A+</div>
                    <div class="stat-desc">Production ready</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-primary to-secondary">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold text-white mb-6">Ready to Start Building?</h2>
            <p class="text-xl text-white/80 mb-8 max-w-2xl mx-auto">
                Your Laravel application is ready. Start creating amazing features with this modern stack.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button class="btn btn-accent btn-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 20l4-16m-4 4l4 4-4 4" />
                    </svg>
                    Start Coding
                </button>
                <button class="btn btn-outline btn-lg text-white border-white hover:bg-white hover:text-primary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    View Examples
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer footer-center p-10 bg-base-200 text-base-content rounded">
        <div class="grid grid-flow-col gap-4">
            <a class="link link-hover">About us</a>
            <a class="link link-hover">Contact</a>
            <a class="link link-hover">Documentation</a>
            <a class="link link-hover">GitHub</a>
        </div>
        <div>
            <div class="grid grid-flow-col gap-4">
                <a class="text-2xl hover:text-primary transition-colors">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                    </svg>
                </a>
                <a class="text-2xl hover:text-primary transition-colors">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z" />
                    </svg>
                </a>
                <a class="text-2xl hover:text-primary transition-colors">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.347-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.74-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.017.001z" />
                    </svg>
                </a>
            </div>
        </div>
        <div>
            <p>© 2025 Laravel App - Built with ❤️ using Laravel, TailwindCSS & DaisyUI</p>
        </div>
    </footer>
@endsection
