<template>
  <div id="app">
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
	                <th>Name</th>
	                <th>Author</th>
	                <th>Price</th>
	                <th>Edit</th>
	                <th>Delete</th>
	              </tr>
	            </thead>
	            <tbody>
	            	<tr v-for="(book, index) in books" class="text-center">
	            		<td> {{ book.id }} </td>
	            		<td><a href="#"> {{ book.name }} </a></td>
	            		<td> {{ book.author }} </td>
	            		<td> {{ book.price}} </td>
	            		<td>
	            			<a href="#" class="text-success" @click="showEditModal=true">
	            				<i class="fas fa-edit"></i>	
			        		</a>
			        	</td>
			        	<td>
	            			<a href="#" class="text-danger" @click="showDeleteModal=true">
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
    						<span>Name :</span>
    						<input type="text" name="name" class="form-control mt-2" placeholder="name">
    					</div>
    					<div class="form-group">
    						<span>Author :</span>
    						<input type="text" name="author" class="form-control mt-2" placeholder="author">
    					</div>
    					<div class="form-group">
    						<span>Price :</span>
    						<input type="text" name="price" class="form-control mt-2" placeholder="price">
    					</div>
    					<button class="btn btn-info btn-block" @click="showAddModal=false">ADD</button>
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
    						<span>Name :</span>
    						<input type="text" name="name" class="form-control mt-2" placeholder="name">
    					</div>
    					<div class="form-group">
    						<span>Author :</span>
    						<input type="text" name="author" class="form-control mt-2" placeholder="author">
    					</div>
    					<div class="form-group">
    						<span>Price :</span>
    						<input type="text" name="price" class="form-control mt-2" placeholder="price">
    					</div>
    					<div class="form-group">
    						<button class="btn btn-info btn-block">EDIT</button>
    						<button class="btn btn-danger btn-block">CANCEL</button>    						
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
    				<h6>You are deleting "book.name "</h6>
    				<hr class="bg-info">
					<button class="btn btn-info btn-block" @click="deleteBook(index)">DELETE</button>
					<button class="btn btn-danger btn-block" @click="showDeleteModal=false">CANCEL</button>	
    			</div>
    		</div>
    	</div>
    </div>
  </div>
</template>
<script>
export default {
  name: "App",
  data: function() {
    return {
      successMsg: false,
      errorMsg: false,
      showAddModal: false,
      showEditModal: false,
      showDeleteModal: false,
      books: [],
      newBook: {name: "", author: "", price: ""},
      currentBook: {}
    }
  },
  mounted: function(){
    this.getAllBooks();
  },
  methods: {
      getAllBooks(){
        axios.get('http://localhost/crud-vuejs/src/Backend/api.php?action=read')
       .then(res => console.log(res))
      }
  }
}

</script>

<style>
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
