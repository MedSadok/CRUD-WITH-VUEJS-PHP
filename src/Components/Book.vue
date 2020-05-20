<template>
  <div class="text-center">
    <h1 class="text-light text-center bg-dark py-3">{{ bookTitle }}</h1>
    <p>LorAute est velit quis exercitation.Voluptate in nisi commodo aute.Nulla sint ut nostrud deserunt.
      Ad et qui amet nulla culpa ex sunt culpa magna consequat quis fugiat aliqua dolore. Elit ex duis laborum veniam sunt do.
      Aliqua mollit fugiat duis non qui elit nulla non occaecat ad reprehenderit.Anim irure nulla reprehenderit nulla officia reprehenderit voluptate excepteur.Culpa exercitation adipisicing cillum ipsum dolor.
      Minim mollit dolor exercitation ex incididunt.Sit ad duis laborum dolore sit commodo voluptate laboris ullamco consequat.
    </p>
    <hr class="bg-info">
    <span>{{ bookAuthor }}</span>
  </div>
</template>
<script>
export default {
  data: function() {
    return {
      id: this.$route.params.id,
      bookTitle: '',
      bookAuthor: ''
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
            // this.bookTitle = res.data.books[this.id].Title;
            this.bookTitle = res.data.books.filter(book => book.id === this.id)[0].Title;
            this.bookAuthor = res.data.books.filter(book => book.id === this.id)[0].Author;
          }
        });
    }
  }
}

</script>
