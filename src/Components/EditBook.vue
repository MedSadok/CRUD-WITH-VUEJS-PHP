<template>
  <div class="book-table">
    <h1 class="text-light text-center bg-dark py-3">CRUD operations using VUE.JS</h1>
    <div class="container-fluid">
      <div class="d-flex justify-content-between">
        <h2 class="text-info">Books</h2>
        <button class="btn btn-info" @click="showAddModal=true">
          <i class="fas fa-user mr-2"></i>
          <span>add book</span>
        </button>
      </div>
      <hr class="bg-info">
      <div class="alert alert-success" v-if="successMsg">
        <span>{{ successMsg }}</span>
      </div>
      <div class="alert alert-danger" v-if="errorMsg">
        <span>{{ errorMsg }}</span>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="table-responsive">
            <table class="table table-bordered table-striped d-table ">
              <thead>
                <tr class="text-center text-light text-info bg-primary">
                  <th class="d-table-cell">ID</th>
                  <th>Title</th>
                  <th>Author</th>
                  <th>Price</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="book in books" :key="book.id" class="text-center">
                  <td> {{ book.id }} </td>
                  <td> {{ book.Title }} </td>
                  <td> {{ book.Author }} </td>
                  <td> {{ book.Price}} </td>
                  <td>
                    <a href="#" class="text-success" @click="showEditModal=true; selectBook(book);">
                      <i class="fas fa-edit"></i>
                    </a>
                  </td>
                  <td>
                    <a href="#" class="text-danger" @click="showDeleteModal=true; selectBook(book);">
                      <i class="fas fa-trash"></i>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- ADD NEW BOOK -->
    <div id="overlay" v-show="showAddModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add new book</h5>
            <button type="button" class="close" @click="showAddModal=false">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body p-4">
            <form method="post" action="#">
              <div class="form-group">
                <span>Title :</span>
                <input type="text" name="title" class="form-control mt-2" placeholder="name" v-model="newBook.Title">
              </div>
              <div class="form-group">
                <span>Author :</span>
                <input type="text" name="author" class="form-control mt-2" placeholder="author" v-model="newBook.Author">
              </div>
              <div class="form-group">
                <span>Price :</span>
                <input type="text" name="price" class="form-control mt-2" placeholder="price" v-model="newBook.Price">
              </div>
              <button class="btn btn-info btn-block" @click.prevent="showAddModal=false; addBook();">ADD</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- EDIT BOOK -->
    <div id="overlay" v-show="showEditModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit book</h5>
            <button type="button" class="close" @click="showEditModal=false">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body p-4">
            <form method="post" action="#">
              <div class="form-group">
                <span>Title :</span>
                <input type="text" name="title" class="form-control mt-2" v-model="currentBook.Title">
              </div>
              <div class="form-group">
                <span>Author :</span>
                <input type="text" name="author" class="form-control mt-2" v-model="currentBook.Author">
              </div>
              <div class="form-group">
                <span>Price :</span>
                <input type="text" name="price" class="form-control mt-2" v-model="currentBook.Price">
              </div>
              <div class="form-group">
                <button class="btn btn-info btn-block" @click.prevent="showEditModal=false; editBook();">EDIT</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- DELETE BOOK -->
    <div id="overlay" v-show="showDeleteModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete book</h5>
            <button type="button" class="close" @click="showDeleteModal=false">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body p-4">
            <h4 class="text-danger">Are you sure you want to delete this book ?</h4>
            <h6>You are deleting {{ currentBook.name }}</h6>
            <hr class="bg-info">
            <button class="btn btn-info btn-block" @click="showDeleteModal=false; deleteBook()">DELETE</button>
            <button class="btn btn-danger btn-block" @click="showDeleteModal=false">CANCEL</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "Homepage",
  data: function() {
    return {
      successMsg: false,
      errorMsg: false,
      showAddModal: false,
      showEditModal: false,
      showDeleteModal: false,
      books: [],
      newBook: { Title: "", Author: "", Price: "" },
      currentBook: {}
    }
  },
  mounted: function() {
    this.getAllBooks();
  },
  methods: {
    getAllBooks() {
      axios.get('http://localhost/VUEJS/src/Backend/api.php?action=read')
        .then((res) => {
          if (res.data.error) {
            this.errorMsg = res.data.message;
          } else {
            this.books = res.data.books;
          }
        });
    },
    addBook() {
      var formData = this.toFormData(this.newBook);
      axios.post('http://localhost/VUEJS/src/Backend/api.php?action=create', formData)
        .then((res) => {
          this.newBook = { Title: "", Author: "", Price: "" };
          if (res.data.error) {
            this.errorMsg = res.data.message;
          } else {
            this.successMsg = res.data.message;
            this.getAllBooks();
          }
        });
    },
    editBook() {
      var formData = this.toFormData(this.currentBook);
      axios.post('http://localhost/VUEJS/src/Backend/api.php?action=update', formData)
        .then((res) => {
          this.currentBook = {};
          if (res.data.error) {
            this.errorMsg = res.data.message;
          } else {
            this.successMsg = res.data.message;
            this.getAllBooks();
          }
        });
    },
    deleteBook() {
      var formData = this.toFormData(this.currentBook);
      axios.post('http://localhost/VUEJS/src/Backend/api.php?action=delete', formData)
        .then((res) => {
          this.currentBook = {};
          if (res.data.error) {
            this.errorMsg = res.data.message;
          } else {
            this.successMsg = res.data.message;
            this.getAllBooks();
          }
        });
    },
    toFormData(obj) {
      var fd = new FormData();
      for (var i in obj) {
        fd.append(i, obj[i]);
      }
      return fd;
    },
    selectBook(book) {
      this.currentBook = book;
    }
  }
}

</script>



<style scoped>
  #overlay{
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0,0,0,0.6);
  }
  td a{
    color: #000;
    text-decoration: none;
  }
  td a:hover{
    color: #dd0c29;
    text-decoration: none;
  }
</style>