<template>
    <div id="saver-form">
        <h3>{{ title }}</h3>
        <input v-model="telemetryData">
        <button v-on:click="send">Send</button>
    </div>
</template>

<script>
    import axios from "axios";
    export default {
        name: "Saver",
        data: function () {
            return{
                title: "Input your telemetry(Api)",
                telemetryData: ""
            }
        },
        methods:{
            send: function (event) {
                alert('Привет Андрей ' + this.telemetryData);
                axios.post("/api/telemetry/create", {"telemetry": this.telemetryData}, {
                    headers: {
                        'Authorization' : 'Bearer ef8724dmsr'
                    }
                })
                    .then(response => (this.info = response))
                    .catch(error => console.log(error));
                // axios({
                //     method: "post",
                //     url: "/api/telemetry/create",
                //     body: {"telemetry":"secondregergewfwef"},
                //     headers: {
                //         'Authorization' : 'Bearer ef8724dmsr'
                //     }
                // })
                //     .then(response => (this.info = response))
                //     .catch(error => console.log(error));
                // axios.get("/api/telemetry")
                //    .then(response => (this.info = response));
            }
        }
    }
</script>

<style scoped>

</style>