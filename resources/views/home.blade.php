<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="bg-slate-900 py-10 px-6 min-h-screen">
        <div class="max-w-6xl mx-auto">
            <div class="overflow-x-auto shadow-md sm:rounded-lg"
                x-data="{openDelete: false, deleteUrl: '', userName: ''}">
                <table class="w-full text-sm text-left text-gray-400">
                    <thead class="text-xs text-gray-300 uppercase bg-slate-800 border-b border-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-semibold">Username</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Name</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Email</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Action</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-700 bg-slate-900">
                        @foreach ($data as $d)
                            <tr class="hover:bg-slate-800 transition-colors">
                                <td class="px-6 py-4 font-bold text-white whitespace-nowrap">
                                    {{ $d->username }}
                                </td>
                                <td class="px-6 py-4 text-gray-300">
                                    {{ $d->name }}
                                </td>
                                <td class="px-6 py-4 text-gray-400">
                                    {{ $d->email }}
                                </td>
                                <td class="px-3 py-4 text-left">
                                    <a href="{{ route('admin.user.edit', ['id' => $d->id]) }}"
                                        class="font-medium text-indigo-400 hover:text-indigo-300">
                                        Edit
                                    </a>
                                    |
                                    <button @click="openDelete = true; userName = '{{ $d->name }}'"
                                        class="font-medium text-red-400 hover:text-red-300">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <div x-show="openDelete" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm"
                                x-cloak>
                                <div @click.away="openDelete = false"
                                    class="max-w-md w-full bg-slate-800 border border-gray-700 rounded-2xl p-6 text-center shadow-2xl">
                                    <h3 class="text-xl font-bold text-white mb-2">Konfirmasi Hapus</h3>
                                    <p class="text-gray-400 text-sm mb-6">
                                        Apakah Anda yakin ingin menghapus user <span class="text-white font-bold"
                                            x-text="userName"></span>?
                                    </p>

                                    <form action="{{ route('admin.user.delete', ['id' => $d->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <div class="flex gap-3 justify-center">
                                            <button type="button" @click="openDelete = false"
                                                class="px-5 py-2.5 text-gray-300 hover:bg-slate-700 rounded-lg transition">
                                                Batal
                                            </button>
                                            <button type="submit"
                                                class="px-5 py-2.5 bg-red-600 hover:bg-red-500 text-white rounded-lg font-bold shadow-lg transition">
                                                Ya, Hapus
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</x-layout>