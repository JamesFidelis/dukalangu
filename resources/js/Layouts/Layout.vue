<template>


    <header>
        <DashNav/>
    </header>


    <main>
        <slot></slot>
    </main>



</template>



<script>

    import DashNav from "./DashNav.vue";
    import Sidebar from "./Sidebar.vue";

    export default {
        name:'Layout',

        components:{
            DashNav,
            Sidebar
        },
    }

</script>
