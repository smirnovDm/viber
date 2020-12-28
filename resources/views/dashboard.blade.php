<x-app-layout>
    <div class="mx-4 card bg-white max-w-md p-10 md:rounded-lg my-20 mx-auto">
        <div class="title mb-5">
            <h1 class="font-bold text-center">Написать сообщение</h1>
        </div>

        <div class="flex flex-col text-sm">
            <label for="title" class="font-bold mb-2">Номер телефона</label>
            <input class="appearance-none border border-gray-200 p-2 focus:outline-none focus:border-gray-500" type="text" placeholder="Введите номер телефона">
        </div>

        <div
            x-data="select(options = [],{placeholder: 'Select a country', value: null})"
            x-init="init()"
            class="relative"
        >
            <span class="inline-block w-full rounded-md shadow-sm">
                <button class="relative z-0 w-full py-2 pl-3 pr-10 text-left transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md cursor-default focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5">
                    <span class="block truncate">Select an option</span>

                    <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                            <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                </button>
            </span>

            <div class="absolute z-10 w-full mt-1 bg-white rounded-md shadow-lg">
                <ul class="py-1 overflow-auto text-base leading-6 rounded-md shadow-xs max-h-60 focus:outline-none sm:text-sm sm:leading-5">
                    <li class="relative py-2 pl-3 text-gray-900 cursor-default select-none pr-9">
                        <span class="block font-normal truncate">Option 1</span>

                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600">
                            <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </li>
                </ul>
            </div>
        </div>


        <div class="form mt-4">
            <div class="text-sm flex flex-col">
                <label for="description" class="font-bold mt-4 mb-2">Description</label>
                <textarea class=" appearance-none w-full border border-gray-200 p-2 h-40 focus:outline-none focus:border-gray-500"  placeholder="Enter your description"></textarea>
            </div>
        </div>

        <div class="submit">
            <button type="submit" class=" w-full bg-blue-600 shadow-lg text-white px-4 py-2 hover:bg-blue-700 mt-8 text-center font-semibold focus:outline-none ">Submit</button>
        </div>
    </div>
</x-app-layout>
<script>
    function select(options,config){
        return {
                options: options,
                value: config.value,
                placeholder: config.placeholder ? config.placeholder : null,
                init: function (){
                  axios.get('/api/active-patterns')
                       .then(response => {
                           this.options = response.data.data;
                       })
                  console.log(this.options);
                },

            }
        }
</script>
