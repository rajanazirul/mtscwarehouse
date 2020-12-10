<template>
    <div>
        <h1>the number is : {{counter}}</h1>
        <button @click="UpdateCounter(1)">Increase</button>
        <button @click="UpdateCounter(-1)">Deacrease</button>
    </div>
</template>

<script>
    export default {
        data() {
            return{
                counter: 0
            }
        },
        methods: {
            UpdateCounter(number){
                this.counter += number
            }
        }
    }
</script>