<div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full"
    style="width: 70%">
    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left p-8">
        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4 underline">
            NASDAQ Information for <span class="font-bold">{{ $companySymbol ?? 'loading...' }}</span>
        </h3>
        <table class="table-auto w-full w-100">
            <thead>
                <tr>
                    <th class="px-4 py-2">Open Price</th>
                    <th class="px-4 py-2">High Price</th>
                    <th class="px-4 py-2">Low Price</th>
                    <th class="px-4 py-2">Close Price</th>
                    <th class="px-4 py-2">Latest Price</th>
                    <th class="px-4 py-2">Average Total Volume</th>
                </tr>
            </thead>
            <tbody>

                @if ($stockData)
                    <tr>
                        <td class="border px-4 py-2">{{ $stockData['iexOpen'] ?? 'N/A' }}</td>
                        <td class="border px-4 py-2">{{ $stockData['high'] ?? 'N/A' }}</td>
                        <td class="border px-4 py-2">{{ $stockData['low'] ?? 'N/A' }}</td>
                        <td class="border px-4 py-2">{{ $stockData['iexClose'] ?? 'N/A' }}</td>
                        <td class="border px-4 py-2">{{ $stockData['latestPrice'] ?? 'N/A' }}</td>
                        <td class="border px-4 py-2">{{ $stockData['avgTotalVolume'] ?? 'N/A' }}</td>
                    </tr>
                @else
                    <tr>
                        <td class="border px-4 py-2" colspan="6">No NASDAQ information
                            available
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <button type="button" wire:click="showCompanyDetails('')" onClick="document.getElementById('modal').classList.toggle('hidden');"
            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
            Close
        </button>
    </div>
</div>
