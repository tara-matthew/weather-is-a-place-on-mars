<template>

    <div class="p-6 max-w-sm mx-auto bg-white rounded-xl shadow-md flex justify-center">
        <div>
            <div class="text-xl font-medium text-black">Ooohh Weather is a Place on Mars</div>
        </div>
    </div>

</template>

<script>
    export default {
        async mounted() {
            console.log('Component mounted');
            window.axios.get('/api/weather').then(response => {
                console.log(response.data);
            })
        }
    }
</script>