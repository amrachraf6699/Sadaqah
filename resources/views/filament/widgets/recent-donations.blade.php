<x-filament::widget>
    <x-filament::card>
        <h2 class="text-lg font-bold mb-4">Recent Donations</h2>
        <ul>
            @foreach ($donations as $donation)
                <li class="mb-2">
                    <div>
                        <span class="font-semibold">{{ $donation->user->name }}</span> donated
                        <span class="font-semibold text-success">${{ $donation->amount }}</span> to
                        <span class="font-semibold">{{ $donation->campaign->title }}</span>
                    </div>
                    <div class="text-sm text-gray-500">{{ $donation->created_at->diffForHumans() }}</div>
                </li>
            @endforeach
        </ul>
        <a class="text-blue-600 hover:underline text-center" href="{{ route('filament.admin.resources.donations.index') }}">
            <x-filament::button class="mt-4">View All Donations</x-filament::button>
        </a>
    </x-filament::card>
</x-filament::widget>
