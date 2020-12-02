<x-app-layout>
    <div class="py-4 px-10">
        <div class="flex justify-end py-2 mb-4">
            <button class="btn-primary" x-data="goCreate()" @click="redirectMe()">
                Создать
            </button>
        </div>
{{--        --}}
{{--        <section class="">--}}

{{--        </section>--}}
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
