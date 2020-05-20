<template>
  <div class="container pt-5">
    <div class="row">
      <div class="col-md-4 col-6 mb-3" v-for="book in bookList" :key="book.id">
        <router-link :to="'/books/' + book.id">
          <div class="card">
            <div class="card-header bg-primary text-text-capitalize d-flex flex-column justify-content-center align-items-center">
              <h1 class="card-title text-center text-light">{{ book.Title }}</h1>
            </div>
            <div class="card-body">
              <p>Irure laboris voluptate dolor officia mollit dolore aute qui tempor qui ut consectetur consequat pariatur laborum irure cupidatat minim officia non do do nulla dolore mollit nisi laboris qui officia sunt anim id veniam cupidatat et reprehenderit anim.</p>
            </div>
            <div class="card-footer">
              <span class="font-weight-bolder">Author :<label class="font-font-weight-normal ml-2"> {{ book.Author }} </label></span>
            </div>
          </div>
        </router-link>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "Books",
  data: function() {
    return {
      bookList: []
    }
  },
  mounted: function() {
    this.getBook();
  },
  methods: {
    getBook() {
      axios.get('http://localhost/VUEJS/src/Backend/api.php?action=read')
        .then((res) => {
          if (res.data.error) {
            this.errorMsg = res.data.message;
          } else {
            this.bookList = res.data.books;
          }
        });
    }
  }
}

</script>
<style scoped>
.card{
  transition: all 0.3s ease;
}
.card:hover{
  box-shadow: 1px 0px 25px 0 rgba(189, 189, 185, 0.3);
  transform: translateY(-4px);
}
.card-header {
  height: 165px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
a{
    color: #000;
    text-decoration: none;
  }
a:hover{
  text-decoration: none;
}

</style>
