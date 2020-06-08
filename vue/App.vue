<template>
    <div>
<!--        <hello-world :msg="text"></hello-world>-->
        <saver></saver>
    </div>
</template>

<script>
    import HelloWord from "./components/HelloWorld";
    import Saver from "./components/Saver";

    export default {
        components: {
            'hello-world' : HelloWord,
            'saver' : Saver
        },
        name: "App",
        data: function () {
            return{
                text: 'Hello World!!!'
            }
        }
    }
</script>

<style scoped>

</style>