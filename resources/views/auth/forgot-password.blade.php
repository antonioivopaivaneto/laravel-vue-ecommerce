<x-app-layout>


    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />


    <form method="POST" action="{{ route('password.email') }}" class="w-[400px] mx-auto p-6 my-16">
        @csrf

        <h2 class="text-2xl font-semibold text-center mb-5">
          Enter your Email to reset password
        </h2>
        <p class="text-center text-gray-500 mb-6">
          or
          <a
            href="{{route('login')}}"
            class="text-purple-600 hover:text-purple-500"
            >login with existing account</a
          >
        </p>

        <div class="mb-3">
          <input
            id="loginEmail"
            type="email"
            name="email"
            placeholder="Your email address"
            class="border-gray-300 focus:border-purple-500 focus:outline-none focus:ring-purple-500 rounded-md w-full"
          />
          <x-input-error :messages="$errors->get('email')" class="mt-2" />

        </div>
        <button
          class="btn-primary bg-emerald-500 hover:bg-emerald-600 active:bg-emerald-700 w-full"
        >
          Submit
        </button>
      </form>
</x-app-layout>
