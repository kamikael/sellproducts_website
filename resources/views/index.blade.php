@extends('layouts.app')

@section('title', 'Accueil - Eat&Drink')

@section('content')
    {{-- Hero Section --}}

    <section class="relative bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-20 md:py-28 mb-20">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <div class="flex justify-center mb-8">
                <span class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 shadow-lg animate-bounce">
                    <i class="bi bi-cup-hot text-4xl text-white"></i>
                </span>
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">
                Mangez, buvez, aimez. <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Eat&Drink</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-600 mb-10">
                Découvrez une expérience culinaire unique avec nos stands de restauration et nos boissons rafraîchissantes. Une aventure gastronomique vous attend !
            </p>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
                <div class="bg-white/80 rounded-xl p-6 shadow hover:shadow-lg transition">
                    <div class="text-3xl font-bold text-blue-600 mb-1">15+</div>
                    <div class="uppercase text-xs text-gray-500 tracking-wider">Stands</div>
                </div>
                <div class="bg-white/80 rounded-xl p-6 shadow hover:shadow-lg transition">
                    <div class="text-3xl font-bold text-blue-600 mb-1">50+</div>
                    <div class="uppercase text-xs text-gray-500 tracking-wider">Produits</div>
                </div>
                <div class="bg-white/80 rounded-xl p-6 shadow hover:shadow-lg transition">
                    <div class="text-3xl font-bold text-blue-600 mb-1">100%</div>
                    <div class="uppercase text-xs text-gray-500 tracking-wider">Satisfaction</div>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row justify-center gap-4 mt-8">
                {{-- Boutons retirés --}}
            </div>
        </div>
    </section>
    <div class="flex flex-col space-y-8">
    </div>
    {{-- Features Section --}}
    <section class="py-20 md:py-28 mb-20">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid gap-12 md:grid-cols-3">
                <div class="bg-white rounded-2xl shadow hover:shadow-xl transition p-8 text-center flex flex-col items-center">
                    <span class="inline-flex items-center justify-center w-16 h-16 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 mb-4 shadow">
                        <i class="bi bi-shop text-3xl text-white"></i>
                    </span>
                    <h5 class="font-bold text-lg mb-2 text-gray-900">Stands Variés</h5>
                    <p class="text-gray-600">
                        Explorez une diversité de stands proposant des cuisines du monde entier, des plats traditionnels aux créations innovantes.
                    </p>
                </div>
                <div class="bg-white rounded-2xl shadow hover:shadow-xl transition p-8 text-center flex flex-col items-center">
                    <span class="inline-flex items-center justify-center w-16 h-16 rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 mb-4 shadow">
                        <i class="bi bi-cart-check text-3xl text-white"></i>
                    </span>
                    <h5 class="font-bold text-lg mb-2 text-gray-900">Commande Facile</h5>
                    <p class="text-gray-600">
                        Commandez en quelques clics avec notre système de panier intuitif. Paiement sécurisé et livraison rapide.
                    </p>
                </div>
                <div class="bg-white rounded-2xl shadow hover:shadow-xl transition p-8 text-center flex flex-col items-center">
                    <span class="inline-flex items-center justify-center w-16 h-16 rounded-xl bg-gradient-to-br from-yellow-400 to-orange-500 mb-4 shadow">
                        <i class="bi bi-star-fill text-3xl text-white"></i>
                    </span>
                    <h5 class="font-bold text-lg mb-2 text-gray-900">Qualité Premium</h5>
                    <p class="text-gray-600">
                        Des ingrédients frais et de qualité, préparés avec passion par nos entrepreneurs locaux talentueux.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Stands Section --}}
    <section class="py-20 bg-white mt-24">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">Nos Stands</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-indigo-500 mx-auto rounded-full"></div>
            </div>
            <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($stands as $stand)
                <div class="bg-blue-50 rounded-2xl shadow hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col border border-blue-100 p-8">
                    <div class="relative h-44 bg-gradient-to-br from-blue-100 to-indigo-50 flex items-center justify-center mb-6">
                        @if(!empty($stand->image_url))
                            <img src="{{ $stand->image_url }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Image du stand {{ $stand->nom_stand }}">
                        @else
                            <i class="bi bi-shop text-5xl text-blue-400"></i>
                        @endif
                    </div>
                    <div class="flex flex-col flex-1">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">{{ $stand->nom_stand }}</h3>
                        <p class="text-gray-600 mb-6 flex-1">{{ Str::limit($stand->description, 80) }}</p>
                        <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mb-6">
                            <i class="bi bi-person-circle mr-1"></i>
                            {{ $stand->user?->name ?? 'Non attribué' }}
                        </div>
                        <a href="{{ route('vitrine.stand', $stand->id) }}" style="text-decoration:none!important" class="block w-full text-center bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            Voir le stand <i class="bi bi-arrow-right-short ml-2"></i>
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-full">
                    <div class="text-center py-12 bg-blue-50 rounded-2xl border-2 border-dashed border-blue-200">
                        <i class="bi bi-emoji-frown text-4xl text-blue-300 mb-4"></i>
                        <p class="text-blue-500 font-medium">Aucun stand disponible pour le moment.</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <div class="flex justify-center my-8">
        <a href="{{ route('register') }}" class="flex items-center justify-center bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl px-4 py-3 shadow hover:shadow-lg transition duration-300">
          <i class="bi bi-person-plus mr-2 text-xl"></i>
        </a>
      </div>
      <div class="text-center text-lg font-semibold text-gray-700">
        Rejoignez Eat&Drink
      </div>


@endsection
