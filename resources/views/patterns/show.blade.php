<x-app-layout>

    <div x-data="showHandler()" class="py-4 px-10">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 border-b border-gray-200 sm:px-6 flex justify-between items-center flex-wrap">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Тема: {{$pattern->theme}}
                </h3>
                <div>
                    <button @click="goEditRoute($event)" id="{{$pattern->id}}" class="btn-save">Редактировать</button>
                </div>
            </div>

            <div class="px-4 py-5 sm:p-0">
                <dl>
                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 sm:py-5 border-b border-gray-200 pb-5">
                        <dt class="text-sm leading-5 font-medium text-gray-600">
                            Тэг
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            {{$pattern->tag}}
                        </dd>
                    </div>
                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 sm:py-5 border-b border-gray-200 pb-5">
                        <dt class="text-sm leading-5 font-medium text-gray-600">
                            Текст(Вайбер)
                        </dt>
                        <dd id="test" class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2 whitespace-pre-line">{{$pattern->viber_text}}</dd>
                    </div>
                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 sm:py-5 border-b border-gray-200 pb-5">
                        <dt class="text-sm leading-5 font-medium text-gray-600">
                            Текст(SMS)
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2 whitespace-pre-line">{{$pattern->sms_text}}</dd>
                    </div>
                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 sm:py-5 border-b border-gray-200 pb-5">
                        <dt class="text-sm leading-5 font-medium text-gray-600">
                            Статус
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            @if($pattern->is_active)
                                <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium leading-5 bg-green-100 text-green-800">
                                 Активный
                            </span>
                            @else
                                <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium leading-5 bg-red-100 text-red-800">
                                 Неактивен
                            </span>
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
<p>
</p>
</x-app-layout>
<script>
    function showHandler(){
        return {
            goEditRoute: function (event){
                const id = event.target.id;
                window.location.replace(`/patterns/${id}/edit`);
            }
        }
    }
</script>
