<x-app-layout>

    <div class="card-body">
        <div class="card mb-4">
            <x-card-header title="Transactions" action='create' titleLink="Create transaction" />
            <x-lists.transactions-list :data=$transactions />
        </div>
    </div>
</x-app-layout>