<template>
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-6 mb-3" v-for="book in bookList">
        <router-link :to="{ name: 'book', params: { id : book.id - 1 }}">
          <div class="card">
            <div class="card-header text-light bg-info text-uppercase text-center">
              <h1 class="card-title text-warning">{{ book.name }}</h1>
              <h4>{{ book.author }}</h4>
            </div>
            <div class="card-body">
              <p>Irure laboris voluptate dolor officia mollit dolore aute qui tempor qui ut consectetur consequat pariatur laborum irure cupidatat minim officia non do do nulla dolore mollit nisi laboris qui officia sunt anim id veniam cupidatat et reprehenderit anim.</p>
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
      axios.get('http://localhost/crud-vuejs/src/Backend/api.php?action=read')
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
  border-radius: .87rem;
}
.card:hover{
  box-shadow: 4px 8px 12px 0 rgba(0,0,0,0.3);
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
