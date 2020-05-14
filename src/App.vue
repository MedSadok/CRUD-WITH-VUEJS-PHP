<template>
  <div id="app">
    <ul class="d-flex">
      <li>
        <router-link to="/">Edit Books</router-link>
      </li>
      <li>
        <router-link to="/books">Book List</router-link>
      </li>
    </ul>
    <router-view></router-view>
  </div>
</template>
<script>
  import Homepage from "./Components/Homepage";
  import Books from "./Components/Books";
  import Book from "./Components/Book";
  export default {
    name: "App",
    
    components: {
      Homepage,
      Books,
      Book
    }
  }

</script>

<style>
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


