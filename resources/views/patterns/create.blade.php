<x-app-layout>
    <div class="py-4 px-10" x-data="handler()">
        <!-- component -->
        <div class="bg-gray-200 pt-2 font-mono my-16 rounded">
            <div class="container mx-auto">
                <div class="inputs w-full max-w-2xl p-6 mx-auto">
                    <h2 class="text-2xl text-gray-900">Создать свой шаблон</h2>
                    <form class="mt-6 border-t border-gray-400 pt-4" method="POST" action="{{ route('sms-patterns.store') }}">
                        @csrf
                        <div class='flex flex-wrap -mx-3 mb-6'>
                            <div class='w-full md:w-full px-3 mb-6'>
                                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' for='grid-text-1'>Тема сообщения:</label>
                                <input class='appearance-none block w-full bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-gray-500' id='grid-text-1' name="theme" type='text' placeholder='Тема сообщения' required>
                            </div>

                            <div class='w-full md:w-full px-3 mb-6'>
                                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' for='grid-text-2'>Тег:</label>
                                <input class='appearance-none block w-full bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-gray-500' id='grid-text-2' name="tag" type='text' placeholder='Тег' required>
                            </div>

                            <div class='w-full md:w-full px-3 mb-6'>
                                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'>Текст(для Viber):</label>
                                <textarea class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" name="viber_text" rows="4"></textarea>
                            </div>

                            <div class='w-full md:w-full px-3 mb-6'>
                                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'>Текст(для SMS):</label>
                                <textarea class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" name="sms_text" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <span class="pr-4">
                                <button @click.prevent="cancelBtn()" class="btn-secondary">Отменить</button>
                            </span>
                            <span>
                                <button class="btn-save" type="submit">Сохранить</button>
                            </span>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function handler() {
        return {
            cancelBtn: function (){
                window.location.replace('/sms-patterns')
            }
        }
    }
</script>
