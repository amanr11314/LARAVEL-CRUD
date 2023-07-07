@if (count($products) > 0)
    <div class="mt-4 overflow-x-auto shadow-md sm:rounded-lg">
        @php
            $myRoute = 'products.index';
            $params = ['sortOrder' => $sortOrder === 'asc' ? 'desc' : 'asc', 'sortKey' => 'name'];
            if ($isSearch) {
                $params['query'] = $query;
                $myRoute = 'products.find';
            }
        @endphp
        <table class="table-container">
            <thead class="table-col-container">
                <tr>
                    <th scope="col" class="table-col">
                        Id
                    </th>
                    {{-- <th scope="col" class="table-col">
                                    Image
                                </th> --}}
                    <th scope="col" class="table-col">

                        <div class="flex items-center">
                            Name
                            <a href="{{ route($myRoute, $params) }}"><svg class="w-3 h-3 ml-1.5" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                </svg></a>
                        </div>

                    </th>
                    <th scope="col" class="table-col">
                        Action
                    </th>

                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="bg-white border-b hover:bg-gray-400">
                        <td class="px-6 py-4 font-semibold text-gray-900">
                            {{-- {{ $loop->iteration }} --}}
                            {{ $product->id }}
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-900">
                            <a href="products/{{ $product->id }}/show">{{ $product->name }}</a>
                        </td>

                        <td class="px-6 py-4 ">

                            <div class="flex">
                                <a href="products/{{ $product->id }}/edit" class="btn-action-blue">Edit</a>
                                {{-- <form action="products/{{ $product->id }}/delete" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Delete</button>
                                </form> --}}
                                <button type="button" id="{{ $product->id }}" data-modal-target="popup-modal"
                                    data-modal-toggle="popup-modal"
                                    class="btn-delete focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Delete</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- pagination  --}}
        {{ $products->links('vendor.pagination.default') }}
        @verbatim
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"
                integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
            <script>
                $(document).ready(function() {
                    $('button.btn-delete').click(function (){
                    var deleteProuctId = $(this).attr('id');
                        console.log('clicked ',deleteProuctId)
                        var actionUrlOnDelete = `products/${deleteProuctId}/delete`;
                        $('#deleteProductForm').attr('action',actionUrlOnDelete);
                    });
                });
            </script>
        @endverbatim
    </div>
@else
    @if ($isSearch)
        <section class="section-no-result">
            <div class="wrapper-no-result">
                <div class="container-no-result">
                    <p class="title-no-result">No
                        results found</p>
                    <p class="subtitle-no-result">Sorry, No results match your
                        query in database </p>
                    <a href="/" class="btn-action-blue">Back
                        to Homepage</a>

                </div>
            </div>
        </section>
    @else
        <section class="section-no-result">
            <div class="wrapper-no-result">
                <div class="container-no-result">
                    <p class="title-no-result">No
                        results
                        found</p>
                    <p class="subtitle-no-result">Database is empty, add more
                        products
                        to see here </p>
                </div>
            </div>
        </section>
    @endif
@endif
