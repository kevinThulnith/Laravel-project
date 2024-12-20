<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Delete Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section class="space-y-6">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Delete Product Permanantly') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Deleting a product is a permanent action that cannot be undone. Once deleted, all related data, such as sales records, customer reviews, and inventory tracking, will be lost, and the product will no longer be available for purchase or reference. Ensure that you have backed up any necessary information and verified that the product is no longer needed before proceeding. Carefully review the implications of this action to avoid disruptions or unintended consequences for your business operations.') }}
                            </p>
                        </header>
                        <form id="submitForm">
                            <button type="submit"
                                class="bg-red-600 text-sm text-white py-1 px-4 rounded inline-block text-center hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">Delete</button>
                        </form>
                        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
                        <script>
                            document.getElementById('submitForm').addEventListener('submit', async function(e) {
                                e.preventDefault();

                                const formData = new FormData(e.target);

                                try {
                                    const response = await axios.delete('/api/products/{{ $product->id }}', {
                                        headers: {
                                            'Authorization': `Bearer ${localStorage.getItem('token')}`, // Replace with your token
                                            'Accept': 'application/json', // Ensure the server knows to return JSON
                                            'Content-Type': 'application/json' // Explicitly set content type
                                        }
                                    });

                                    alert('Product deleted succesfully');
                                } catch (error) {
                                    console.error('Error submitting form:', error.response?.data || error.message);
                                    alert('Error submitting form');
                                }
                            });
                        </script>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
