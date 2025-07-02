{{-- resources/views/owner/dashboard.blade.php --}}

<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl border border-gray-100 dark:border-gray-700">

                <div class="bg-gradient-to-r from-purple-600 via-fuchsia-600 to-pink-600 p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold mb-2">Dashboard Owner</h3>
                            <p class="text-sm opacity-90">Pantau perkembangan referral website Anda.</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl font-bold mb-4">Statistik Referral</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-5 rounded-xl shadow-md border border-blue-200 dark:border-blue-800 text-center">
                            <p class="text-sm text-blue-700 dark:text-blue-300">Total User Direferral:</p>
                            <p class="text-4xl font-extrabold text-blue-800 dark:text-blue-200">{{ $totalUsersWithReferral }}</p>
                        </div>
                        {{-- Bisa tambahkan statistik lain di sini --}}
                    </div>

                    <h2 class="text-xl font-bold mb-4 mt-8">Top 10 Pemberi Referral Terbanyak</h2>
                    @if ($topReferrers->isEmpty())
                        <p class="text-gray-600 dark:text-gray-400">Belum ada user yang direferral.</p>
                    @else
                        <div class="bg-white dark:bg-gray-700 rounded-xl shadow-md overflow-hidden border border-gray-100 dark:border-gray-600 mb-8">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama Pemberi Referral</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Kode Referral</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Jumlah User Direferral</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($topReferrers as $referrer)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $referrer->referrerUser->name ?? 'N/A' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300 font-mono">{{ $referrer->referred_by }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">{{ $referrer->total_referred_users }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <h2 class="text-xl font-bold mb-4 mt-8">Detail Referral per User</h2>
                    @if ($myReferrals->isEmpty())
                        <p class="text-gray-600 dark:text-gray-400">Belum ada user yang mereferral orang lain.</p>
                    @else
                        <div class="space-y-6">
                            @foreach ($myReferrals as $referralInfo)
                                <div class="bg-gray-50 dark:bg-gray-700 p-5 rounded-xl shadow-md border border-gray-100 dark:border-gray-600">
                                    <h3 class="text-lg font-semibold text-indigo-700 dark:text-indigo-300 mb-2">
                                        {{ $referralInfo['referrer_user']->name }} (Kode: <span class="font-mono">{{ $referralInfo['referrer_user']->referral_code }}</span>)
                                        <span class="text-sm text-gray-500 dark:text-gray-400 ml-2">({{ $referralInfo['referred_users_count'] }} user direferral)</span>
                                    </h3>
                                    <ul class="list-disc list-inside text-sm text-gray-700 dark:text-gray-300 space-y-1">
                                        @foreach ($referralInfo['referred_users_list'] as $referredUser)
                                            <li>
                                                {{ $referredUser['name'] }} ({{ $referredUser['email'] ?? $referredUser['phone_number'] }})
                                                @if ($referredUser['first_transaction_awarded'])
                                                    <span class="text-green-600 dark:text-green-400 font-medium ml-2">(Transaksi Pertama Dikonfirmasi: Poin Diberikan)</span>
                                                @else
                                                    <span class="text-yellow-600 dark:text-yellow-400 font-medium ml-2">(Menunggu Transaksi Pertama)</span>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>