<template>
  <div class="text-center">
    <h1 class="text-light text-center bg-dark py-3">{{ bookName }}</h1>
    <h2>{{ bookAuthor }}</h2>
    <hr class="bg-info">
    <p>Irure laboris voluptate dolor officia mollit dolore aute qui tempor qui ut consectetur consequat pariatur laborum irure cupidatat minim officia non do do nulla dolore mollit nisi laboris qui officia sunt anim id veniam cupidatat et reprehenderit anim.</p>
  </div>
</template>
<script>
export default {
  name: "book",
  data: function() {
    return {
      id: this.$route.params.id,
      bookName: '',
      bookAuthor: ''
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
            this.bookName = res.data.books[this.id].name;
            this.bookAuthor = res.data.books[this.id].author;
          }
        });
    }
  }
}

</script>
