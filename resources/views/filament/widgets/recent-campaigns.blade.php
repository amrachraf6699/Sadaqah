<x-filament::widget>
    <x-filament::card>
        <h2 class="text-lg font-bold mb-4">Recent Campaigns</h2>
        <ul>
            @foreach ($campaigns as $campaign)
                <li class="mb-4 border-b pb-2">
                    <div class="font-semibold text-primary">{{ $campaign->title }}</div>
                    <div>{{ $campaign->description }}</div>
                    <div class="mt-2">
                        <span class="text-sm text-gray-500">Goal: ${{ $campaign->goal_amount }}</span> |
                        <span class="text-sm text-gray-500">Current: ${{ $campaign->current_amount }}</span>
                    </div>
                    <div class="text-sm text-gray-500">Created {{ $campaign->created_at->diffForHumans() }} by {{ $campaign->user->name }}</div>
                </li>
            @endforeach
        </ul>
        <div class="mt-4 text-right">
            <a href="{{ route('filament.admin.resources.campaigns.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">View All Campaigns</a>
        </div>
    </x-filament::card>
</x-filament::widget>
