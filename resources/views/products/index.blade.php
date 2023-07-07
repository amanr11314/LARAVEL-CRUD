{{-- @extends('layouts.products') --}}
@extends('layouts.app')
@section('main')
    @php
        $isSearch = isset($results);
        if ($isSearch) {
            $products = $results;
        }
        $q = isset($query) ? $query : '';
        $order = isset($sortOrder) ? $sortOrder : 'asc';
        
        $searchParams = [];
        if (isset($sortOrder)) {
            $searchParams['sortOrder'] = $order;
            $searchParams['sortKey'] = 'name';
        }
    @endphp
    <div class="container px-4 py-2">
        <div class="wrapper-header-toolbar">

            {{-- Searchbar --}}
            <label for="searchInput" class="sr-only">Search</label>
            <div class="relative">
                <div class="wrapper-icon-search">
                    <svg class="icon-search-container" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>

                <form id="searchForm" action="/search" method="get" onsubmit="return validateForm()">
                    <input type="text" id="query" class="input-search-box" placeholder="Search Product"
                        name="query" value="{{ $q }}">
                    @foreach ($searchParams as $currentParam => $currentParamvalue)
                        <input type="hidden" name="{{ $currentParam }}" value="{{ $currentParamvalue }}">
                    @endforeach
                </form>

                <div id="btnClearForm" class="wrapper-icon-search-reset" onclick="clearForm()">
                    <svg class="icon-search-reset-container" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </div>

            </div>

            {{-- Add new product --}}
            <div class="text-right">
                <a href="products/create" class="mt-2 btn-action-primary">New
                    Product</a>
            </div>
        </div>
        <x-products-table :products="$products" :isSearch="$isSearch" :sortOrder="$order" :query="$q" />
    </div>
    @verbatim
        <script>
            var btnClearForm = document.getElementById("btnClearForm");
            var queryInput = document.getElementById("query");
            var skipValidation = false; // Flag to indicate if validation should be skipped

            function toggleClearButton() {
                if (queryInput.value === "") {
                    btnClearForm.style.display = "none"; // Hide the clear button
                } else {
                    btnClearForm.style.display = "flex"; // Show the clear button
                }
            }

            function validateForm() {
                if (!skipValidation) {
                    // var queryInput = document.getElementById("query");
                    if (queryInput.value.trim() === "") {
                        return false; // Prevent form submission
                    }
                }
                return true; // Allow form submission
            }

            function clearForm() {
                console.log('cleared form');
                var queryInput = document.getElementById("query");
                queryInput.value = ""; // Clear the input value
                toggleClearButton(); // Toggle the visibility of the clear button


                var form = document.getElementById("searchForm");
                form.action = "/"; // Set the new action URL with query parameters
                skipValidation = true; // Set the flag to skip validation in case other parameters are set
                queryInput.removeAttribute(
                    "name"); // Remove the 'name' attribute from the input element to prevent empty query from submititng too
                form.submit(); // Submit the form
            }
            queryInput.addEventListener("input",
                toggleClearButton); // Add event listener to toggle the clear button on input changes
            toggleClearButton();
        </script>
    @endverbatim
@endsection
