<x-app-layout>
    <div class="py-4 px-10">
        <div class="flex justify-end py-2 mb-4">
            <button class="btn-primary" x-data="goCreate()" @click="redirectMe()">
                Создать
            </button>
        </div>
        @if(count($patterns) > 0)
{{--        TABLE STARTS--}}
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8">
            <div class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg">
                <table class="min-w-full">
                    <thead>
                    <tr>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">№</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Тема сообщения</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Текст(Вайбер)</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Тег</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Текст(SMS)</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300"></th>
                    </tr>
                    </thead>
                    <tbody class="bg-white">
                    @foreach($patterns as $pattern)
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                            <div class="flex items-center">
                                <div>
                                    <div class="text-sm leading-5 text-gray-800">{{$pattern->id}}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                            <div class="text-sm leading-5 text-blue-900">{{$pattern->theme}}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5 truncate">{{$pattern->viber_text}}</td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">{{$pattern->tag}}</td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">{{$pattern->sms_text}}</td>
                        <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                            <button class="px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">View Details</button>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="mt-2">
                    {{$patterns->links()}}
                </div>

                <div class="sm:flex-1 sm:flex sm:items-center sm:justify-between mt-4 work-sans">
                    <div>
                        <nav class="relative z-0 inline-flex shadow-sm">
                            <div>

                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        @else
            <div
                class="w-full shadow rounded bg-white text-center text-xl font-medium p-4"
            >
                <span>Нет шаблонов для отображения.</span>
            </div>
        @endif
{{--    TABLE ENDS--}}
    </div>
</x-app-layout>
<script>
    function goCreate() {
        return {
            redirectMe: function (){
                window.location.replace('/sms-patterns/create');
            },
        }
    }
</script>
