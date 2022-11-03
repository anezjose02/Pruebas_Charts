<template>
    <div>
        <canvas ref="my-canvas">

        </canvas>
    </div>
</template>

<script>
import Chart from 'chart.js/auto'

export default {
    props: ['prelabels','predatasets'],
    data(){
        return {
            
            labels: [
                'Red',
                'Blue',
                'Yellow'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [300, 50, 100],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
            }],
        }
    },
    mounted(){
        if (this.prelabels) {
            this.labels = JSON.parse(this.prelabels);
        }
        if (this.predatasets) {
            this.datasets = JSON.parse(this.predatasets);
        }

        let data = {
            labels:this.labels,
            datasets:this.datasets
        };

        let config={
            type: 'doughnut',
            data: data
        };

        let canvas = this.$refs['my-canvas'];
        const grafica = new Chart(
            canvas,
            config
        );
    },
}
</script>

<style>

</style>