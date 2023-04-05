<template>
    <div>
        <header>
            <Navbar/>
        </header>

        <main>
            <router-view></router-view>
        </main>
    </div>
</template>

<script>
import Navbar from './components/Navbar';

export default {
  name: 'App',
  components: {
    Navbar,
  },
}
</script>

<style lang="scss">
    @import '~bootstrap/scss/bootstrap';

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body{
        background-color:rgb(245, 245, 245);
    }

    main {
        margin-top: 100px;
    }


</style>

<!-- LBnYIIJKuwBHbW3xyrFE1uXJSVAINMJW    API KEY TOM TOM-->
