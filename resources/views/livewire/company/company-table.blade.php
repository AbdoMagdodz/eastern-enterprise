<div class="card-body">
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Symbol</th>
                <th class="px-4 py-2">Description</th>
                <th class="px-4 py-2">Address</th>
                <th class="px-4 py-2">Phone Number</th>
                <th class="px-4 py-2">Postal Code</th>
                <th class="px-4 py-2">Logo</th>
                <th class="px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($companies as $company)
                <tr>
                    <td class="border px-4 py-2">{{ $company->name }}</td>
                    <td class="border px-4 py-2 text-bold">{{ $company->symbol }}</td>
                    <td class="border px-4 py-2">{{ $company->description }}</td>
                    <td class="border px-4 py-2">{{ "$company->street, $company->country" }}</td>
                    <td class="border px-4 py-2">{{ $company->phoneNumber  }}</td>
                    <td class="border px-4 py-2">{{ $company->postalCode  }}</td>
                    <td class="border px-4 py-2">
                        <img src="{{ asset('storage/logos/' . $company->logo) }}" alt="{{ $company->name }}"
                            class="rounded" width="100%">
                    </td>
                    <td class="border px-4 py-2">
                        <button wire:click="showDetails('{{ $company->symbol }}')" onClick="document.getElementById('modal').classList.toggle('hidden');"
                            class="block bg-blue-500 text-sm hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Show NASDAQ Details
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
