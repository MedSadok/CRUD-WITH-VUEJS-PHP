<template>
  <div id="app">
    <header class="container-fluid sticky-top bg-white">
        <div class="d-flex justify-content-between py-4">
          <router-link to="/">
            <img :src="require('./assets/books.jpg')" alt="" />
          </router-link>
          <ul class="d-flex">     
            <li>
              <router-link to="/">Book List</router-link>
            </li>
            <li>
              <router-link to="/edit-books">Edit Books</router-link>
            </li>
          </ul> 
        </div>
    </header>
    <router-view />

  </div>
</template>
<script>
  import EditBook from "./Components/EditBook";
  import Books from "./Components/Books";

  export default {
    name: "App",
    
    components: {
      EditBook,
      Books,

    }
  }

</script>


<style scoped>
  img{
    width: 70px;
  }
</style>

<style>
  header{
    box-shadow: 4px 8px 12px 0 rgba(0,0,0,0.3);
  }
  .sticky-top{
    z-index: 99;
  }
  ul{
    margin: 1rem 0;
    padding: 0;
  }
  li{
    list-style: none;
    margin-right: 24px;
  }
  li a{
    color: #000;
    font-size: 18px;
    font-weight: 600;
    text-decoration: none;
  }
  li a:hover{
    color: #dd0c29;
    text-decoration: none;
  }


</style>


