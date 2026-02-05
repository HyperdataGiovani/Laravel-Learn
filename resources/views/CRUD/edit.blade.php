<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="bg-slate-900 py-10 px-6 min-h-screen flex items-center justify-center" >
    <div class="max-w-2xl w-full bg-slate-800 shadow-2xl rounded-2xl border border-gray-700 p-8">
        
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-white">Update User</h2>
            <p class="text-gray-400 text-sm">Fill in the details below to update a new information account.</p>
        </div>

        <form action="{{ route('admin.user.update', ['id' => $data->id]) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="username" class="block mb-2 text-sm font-semibold text-gray-300">Username</label>
                <input type="text" id="username" name="username" value="{{ $data->username }}"
                    class="w-full px-4 py-3 rounded-lg bg-slate-900 border border-gray-700 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition-all placeholder-gray-500"
                    placeholder="example">
            </div>
            <div>
                <label for="name" class="block mb-2 text-sm font-semibold text-gray-300">Full Name</label>
                <input type="text" id="name" name="name" value="{{ $data->name }}"
                    class="w-full px-4 py-3 rounded-lg bg-slate-900 border border-gray-700 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition-all placeholder-gray-500"
                    placeholder="Just Example" >
            </div>
            <div>
                <label for="email" class="block mb-2 text-sm font-semibold text-gray-300">Email Address</label>
                <input type="email" id="email" name="email" value="{{ $data->email }}"
                    class="w-full px-4 py-3 rounded-lg bg-slate-900 border border-gray-700 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition-all placeholder-gray-500"
                    placeholder="example@example.com" >
            </div>
            <div>
                <label for="password" class="block mb-2 text-sm font-semibold text-gray-300">Password</label>
                <input type="password" id="password" name="password" 
                    class="w-full px-4 py-3 rounded-lg bg-slate-900 border border-gray-700 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition-all placeholder-gray-500"
                    placeholder="*******" >
            </div>
            <div class="flex items-center justify-end gap-4 mt-8 pt-4 border-t border-gray-700">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white px-8 py-3 rounded-xl font-bold shadow-lg shadow-indigo-500/20 transition-all transform active:scale-95">
                    Save
                </button>
                <a href="/" class="text-gray-400 hover:text-white transition-colors text-sm font-medium">
                    Cancel
                </a>
            </div>

        </form>
    </div>
</div>
</x-layout>