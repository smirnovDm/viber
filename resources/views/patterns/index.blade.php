<x-app-layout>
    <div class="py-4 px-10">
        <div class="flex justify-end py-2 mb-4">
            <button class="btn-primary" x-data="indexHandler()" @click="goCreateRoute()">
                Создать
            </button>
        </div>
        @if(count($patterns) > 0)
{{--        TABLE STARTS--}}
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8">
            <div class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg">
                <table class="min-w-full table-fixed">
                    <thead>
                    <tr>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">№</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Автор</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Тема сообщения</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Статус</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Текст(Вайбер)</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Тег</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Текст(SMS)</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300"></th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Действия</th>

                    </tr>
                    </thead>
                    <tbody class="bg-white">
                    @foreach($patterns as $pattern)
                    <tr x-data="indexHandler()" >
                            <td class="px-3 py-4 whitespace-no-wrap border-b border-gray-500">
                                <div class="flex items-center">
                                    <div>
                                        <div class="text-sm leading-5 text-gray-800">{{$pattern->id}}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">{{$pattern->user->name ?? '-'}}</td>
                        <td class="px-3 py-4 whitespace-no-wrap border-b border-gray-500">
                            <div class="text-sm leading-5 text-blue-900">{{$pattern->theme}}</div>
                        </td>
                        <td class="px-3 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">
                            @if($pattern->is_active)
                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium leading-5 bg-green-100 text-green-800">
                                 Активный
                            </span>
                            @else
                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium leading-5 bg-red-100 text-red-800">
                                 Неактивен
                            </span>
                            @endif
                        </td>
                        <td class="px-3 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">{{$pattern->viber_text}}</td>
                        <td class="px-3 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">{{$pattern->tag}}</td>
                        <td class="px-3 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">{{$pattern->sms_text}}</td>
                        <td class="px-3 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                            <button @click="goShowRoute($event)" id="{{$pattern->id}}" class="px-6 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">View Details</button>
                        </td>
                        <td class="px-3 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                            <div class="flex justify-between">
                                <div class="w-6 h-6 ml-2 cursor-pointer">
                                    <a href="{{route('patterns.edit', $pattern)}}">
                                        <svg aria-hidden="true"
                                             focusable="false"
                                             data-prefix="fas"
                                             data-icon="edit"
                                             class="svg-inline--fa fa-edit fa-w-18"
                                             role="img" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 576 512">
                                            <path fill="currentColor"
                                                  d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z">
                                            </path>
                                        </svg>
                                    </a>
                                </div>
                                <div @click="deletePattern($event, {{$pattern->id}})" class="w-5 h-5 mr-2 cursor-pointer">
                                    <svg aria-hidden="true"
                                         focusable="false"
                                         data-prefix="fas"
                                         data-icon="trash"
                                         class="svg-inline--fa fa-trash fa-w-14"
                                         role="img"
                                         xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 448 512">
                                        <path fill="currentColor"
                                              d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z">
                                        </path>
                                    </svg>
                                </div>
                            </div>

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
    function indexHandler() {
        return {
            goCreateRoute: function (){
                window.location.replace('/patterns/create');
            },
            goShowRoute: function (event) {
                const id = event.target.id;
                window.location.replace(`patterns/${id}`);
            },
            deletePattern: function (event ,id){
              const el = this.$el;
              if(confirm('Вы точно хотите удалить этот шаблон?')){
                  axios
                      .delete(`/patterns/${id}`)
                      .then(response => {
                            location.reload()
                      })
                      .catch(e => {console.log(e)})
              }
            },
        }
    }
</script>
