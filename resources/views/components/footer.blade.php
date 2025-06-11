<!-- Footer -->
<footer class="py-12 mt-16 w-[90%] mx-auto">
    <div class="max-w-screen-xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-10">
        <!-- Brand -->
        <div class="space-y-4">
            <h2 class="text-2xl font-bold text-gray-800">WCoffee</h2>
            <p class="text-gray-600 text-sm leading-relaxed">
                Nikmati kopi terbaik dari petani lokal Indonesia. Kami hadirkan rasa, aroma, dan kualitas dalam
                setiap tegukan.
            </p>
        </div>

        <!-- Links -->
        <div>
            <h3 class="text-lg font-semibold mb-4 text-gray-800">Menu</h3>
            <ul class="space-y-4">
                <li><a href="{{ route('home') }}" class="text-gray-600 hover:text-green-600 transition duration-300">Home</a></li>
                <li><a href="{{ route('course') }}" class="text-gray-600 hover:text-green-600 transition duration-300">Shop</a></li>
                <li><a href="{{ route('join-us') }}" class="text-gray-600 hover:text-green-600 transition duration-300">Join Us</a></li>
            </ul>
        </div>

        <!-- Social -->
        <div>
            <h3 class="text-lg font-semibold mb-4 text-gray-800">Ikuti Kami</h3>
            <div class="space-y-4">
                <a href="#" class="block text-gray-600 hover:text-green-600 transition duration-300">Instagram</a>
                <a href="#" class="block text-gray-600 hover:text-green-600 transition duration-300">Facebook</a>
                <a href="#" class="block text-gray-600 hover:text-green-600 transition duration-300">X</a>
            </div>
        </div>

        <!-- Contact -->
        <div>
            <h3 class="text-lg font-semibold mb-4 text-gray-800">Kontak</h3>
            <div class="space-y-4 text-gray-600">
                <p class="text-sm">Email: support@wcoffee.id</p>
                <p class="text-sm">Telp: +62 812-3456-7890</p>
                <p class="text-sm">Jl. Aroma Kopi No.10, Jember</p>
            </div>
        </div>
    </div>

    <div class="mt-12 pt-6 border-t border-gray-200 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} WCoffee. All rights reserved.
    </div>
</footer>