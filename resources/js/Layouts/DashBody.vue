<template>


    <div class="p-4 sm:ml-64">

        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <Toast v-if="$page.props.flash.success" :message="$page.props.flash.success">

            </Toast>
<slot></slot>
        </div>

    </div>





</template>



<script>


   import Layout from "./Layout.vue";
   import Toast from "../Components/Toast.vue";
   import {initFlowbite} from "flowbite";

    export default {
        name:'DashBody',
        layout:Layout,
        components:{
            Toast
        },
        mounted() {
            initFlowbite();
            var chart = new ApexCharts(el, options);

            chart.updateSeries([{
                data: [342, 442, 311, 421, 212]
            }]);
        },
    }

</script>
