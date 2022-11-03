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
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
            ],
            datasets: [
                {
                    label: 'My First dataset',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [0, 10, 5, 2, 20, 30, 45],
                },
                {
                    label: 'My First dataset',
                    backgroundColor: 'rgb(255, 99, 0)',
                    borderColor: 'rgb(255, 99, 0)',
                    data: [10, 0, 15, 20, 2],
                }
            ],
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
            type: 'line',
            data: data,
            options: {}
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