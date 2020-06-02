<template>
  <div id="app" ref="content">
    <header class="container-fluid">
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
          <button class="btn btn-success" @click="exportPDF">
            <i class="fas fa-file-pdf mr-2"></i>
            <span>Download book as PDF</span>
          </button>
        </ul>
      </div>
    </header>
    <router-view></router-view>
  </div>
</template>
<script>
import jsPDF from 'jspdf';
import DomToImage from 'dom-to-image';
import EditBook from "./Components/EditBook";
import Books from "./Components/Books";
export default {
  name: "App",

  components: {
    EditBook,
    Books
  },
  methods: {
    exportPDF() {
      DomToImage.toPng(this.$refs.content)
        .then(function(dataUrl) {
          var img = new Image();
          img.src = dataUrl;
          const doc = new jsPDF({
            orientation: "portrait",
            format: [1300, 1366]
          });
          doc.addImage(img, "PNG", 20, 20);
          doc.save("book.pdf");
        })
        .catch(function(error) {
          console.error("something went wrong!", error);
        });
    }
  }
};
</script>

<style scoped>
img {
  width: 70px;
}
</style>

<style>
header {
  box-shadow: 4px 8px 12px 0 rgba(0, 0, 0, 0.3);
}
ul {
  margin: 1rem 0;
  padding: 0;
}
li {
  list-style: none;
  margin-right: 24px;
}
li a {
  color: #000;
  font-size: 18px;
  font-weight: 600;
  text-decoration: none;
}
li a:hover {
  color: #dd0c29;
  text-decoration: none;
}
</style>
