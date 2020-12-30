<template>

    <!--<div class="p-6 max-w-sm mx-auto mb-6 bg-white rounded-xl shadow-md flex justify-center">-->
        <!--<div>-->
            <!--<div class="text-xl font-medium text-black">Ooohh Weather is a Place on Mars</div>-->
        <!--</div>-->
    <!--</div>-->

<!--    <div class="flex flex-row m-0 m-auto w-full h-screen">-->
<!--        <img class="w-full opacity-80 object-cover" :src="photo.compressed_url" />-->
<!--        <p class="absolute text-white text-5xl inset-1/2">Test</p>-->
<!--    </div>    -->

    <!--    <div class="flex flex-row m-0 m-auto w-full h-screen">-->
    <!--        <img class="w-full opacity-80 object-cover" :src="photo.compressed_url" />-->
    <!--        <p class="absolute text-white text-5xl">Test</p>-->
    <!--    </div>-->
    <div class="m-0 m-auto w-full h-screen" :style="backgroundStyles">
        <h1 class="text-white text-center text-5xl">Weather is a Place on Mars</h1>
        <div class="flex flex-row h-full">

            <div class="flex-1 m-auto text-center">
                <p class="text-white text-5xl">Test</p>
            </div>

            <div class="flex-1 m-auto text-center">
                <p class="text-white text-5xl">Test</p>
            </div>

            <div class="flex-1 m-auto text-center">
                <p class="text-white text-5xl">Test</p>
            </div>

            <div class="flex-1 m-auto text-center">
                <p class="text-white text-5xl">Test</p>
            </div>

        </div>
    </div>
    <!--<div class="flex justify-center">-->
        <!--<iframe width="760" height="600" :src="photo.url"></iframe>-->
    <!--</div>-->

</template>

<script>
    export default {
        data() {
            return {
                photo: {},
                photoLoaded: false,
                backgroundStyles: {}
            }
        },

        watch: {
            photo: function(val) {
                this.backgroundStyles = {
                    backgroundImage: `url('${this.photo.compressed_url}')`,
                    backgroundSize: 'cover',
                    backgroundPosition: 'center'
                }
            }
        },

        // computed: {
        //   backgroundStyles() {
        //       return {
        //           backgroundImage: `url('${this.photo.compressed_url}')`,
        //           backgroundSize: 'cover',
        //           backgroundPosition: 'center'
        //       }
        //   }
        // },
        async mounted() {
            console.log('Component mounted');
            window.axios.get('/api/weather').then(response => {
                console.log('weather', response.data);
            })

            window.axios.get('/api/media').then(response => {
                this.photo = response.data;
                this.photoLoaded = true;
            })
        }
    }
</script>
