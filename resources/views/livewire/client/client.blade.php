
<x-slot name="header">
    <h2 class="text-center">Clients</h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
            <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                <p class="text-sm">{{ session('message') }}</p>
            </div>
           
            @endif
            @can('ajouter_clients')
                <button wire:click="create()"
                    class="bg-green-700 text-white font-bold py-2 px-4 rounded my-3">Créer nouveau clients</button>
            @endcan
            @if($isModalOpen)
            @include('livewire.client.create_client')
            @endif
            <input type="text" class="justify-content-between" placeholder="Search ..." wire:model="searchTerms"/>
            <table class="table-auto w-full" >
                <thead>
                    <tr class="bg-gray-100">
                        <th >No.</th>
                        <th >CIV</th>
                        <th >Nom</th>
                        <th >Prénom</th>
                        <th >Email</th>
                        <th >Mobile</th>
                        <th >Action</th>
                        <th >Commander</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                    <tr>
                        
                        <td class="border px-4 py-2">{{ $client->id }}</td>
                        <td class="border px-4 py-2">{{ $client->civ }}</td>
                        <td class="border px-4 py-2">{{ $client->nom }}</td>
                        <td class="border px-4 py-2">{{ $client->prenom}}</td>
                        <td class="border px-4 py-2">{{ $client->email}}</td>
                        <td class="border px-4 py-2">{{ $client->mobile}}</td>
                        <td class="border px-4 py-2">
                            @can('modifier_clients')
                            <button wire:click="edit({{ $client->id }})"
                                class="bg-blue-500  text-white font-bold py-1 px-4 rounded">Edit</button>@endcan
                            @can('supprimer_clients')  <button wire:click="delete({{ $client->id }})"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded">Delete</button>@endcan
                           
                        </td>
                        <td class="border px-10 py-2">
                            <button wire:click="gotoCommande({{ $client->id }})"
                                class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-1 rounded">Commander</button>
                        </td>
                    </tr>
                    @endforeach
                    {{ $clients->links() }}
                </tbody>
            </table>
        </div>
    </div>
</div>
