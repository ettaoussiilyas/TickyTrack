<footer class="bg-gray-800 text-white">
    <div class="container mx-auto px-6 py-8">
        <div class="flex flex-col md:flex-row justify-between">
            <div class="mb-6 md:mb-0">
                <h3 class="text-lg font-semibold">{{ config('app.name', 'Laravel') }}</h3>
                <p class="mt-2 text-gray-400">Making the world a better place</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-8">
                <div>
                    <h4 class="text-sm font-semibold mb-4">Resources</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Documentation</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Support</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-sm font-semibold mb-4">Company</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">About</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-sm font-semibold mb-4">Legal</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Privacy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Terms</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-700 mt-8 pt-8 text-sm text-gray-400 text-center">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
        </div>
    </div>
</footer>
